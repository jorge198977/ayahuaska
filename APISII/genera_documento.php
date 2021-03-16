<?php

// SE CREA EL XML CON EL DETALLE DE BOLETA ELECTRONICA CON EL FORMATO ADECUADO

//include("set_datos.php");
include("genera_pdf.php");
include("manejo_folios.php");
require_once 'Clases/SII/Autenticacion.php';
require_once 'Clases/SII/Folios.php';
require_once 'Clases/FirmaElectronica.php';
require_once 'Clases/I18n.php';
require_once 'Clases/EnvioBoleta.php';
require_once 'Clases/Estado.php';
require_once 'Clases/Sii.php';
require_once 'Clases/Arreglo.php';
require_once 'Clases/Log.php';
require_once 'Clases/SII/Dte.php';
require_once 'Clases/SII/Dte/PDF/DtePdf.php';
require_once 'Clases/SII/EnvioDte.php';



//$empresa, $rutempresa, $rutEmisor,
//genera_documento($folio, $detalle, $sucursal, $caja, $rut, $cli, $nombre);

//FUNCION QUE PERMITE GENERAR EL CUERPO DE LA BOLETA ELECTRONICA A PARTIR DEL FOLIO, NRO INTERNO Y SUCURSAL
// RETORNO EL XML CON LA BOLETA ELECTRONICA
function genera_documento($detalles, $sucursal, $caja, $rut, $cli, $nombre){
	$fecha_hoy = date("Y-m-d");
	
	$folio = get_folio_disponible($sucursal);

	$folios = [
	    39 => $folio, //BOLET ELECTRONICA
	];


	$datos = get_datos($sucursal);
	$empresa = $datos['datos']['empresa'];
	$rutemisor = $datos['datos']['rutemisor'];
	$rut = $datos['datos']['rut'];

	$config = get_firma();

	$caratula = set_caratula($datos['caratula']);
	$emisor = set_emisor($datos['emisor']);
	$total = 0;
	//$ventas_detalles = get_detalle_boleta($nrointerno, $sucursal);

	foreach ($detalles as $key => $detalle) {
		$total = $total + $detalle->valor;
	    $det[] = array('NmbItem' => $detalle->descripcion, 'QtyItem' => 1, 'PrcItem' => $detalle->valor);
	}



	$boleta = [
	    [   
	        'Encabezado' => [
	            'IdDoc' => [
	                'TipoDTE' => 39,
	                'Folio' => $folios[39],
	            ],
	            'Emisor' => $emisor,
	            'Receptor' => [
	                'RUTRecep' => '66666666-6',
	                'RznSocRecep' => 'Sin RUT',
	                'GiroRecep' => 'Particular',
	                'DirRecep' => 'Ovalle',
	                'CmnaRecep' => 'Ovalle',
	            ],
	        ],
	        'Detalle' => 
	            $det
	        
	    ],
	];

	$Firma = new FirmaElectronica($config['firma']);
	foreach ($folios as $tipo => $cantidad)
	    $Folios[$tipo] = new Folios(file_get_contents('xml/folios/'.$tipo.'.xml'));
	$EnvioDTE = new EnvioDte();

	// generar cada DTE, timbrar, firmar y agregar al sobre de EnvioDTE
	foreach ($boleta as $documento) {
	    $DTE = new Dte($documento);
	    if (!$DTE->timbrar($Folios[$DTE->getTipo()])){
	        break;
	    }
	    if (!$DTE->firmar($Firma))
	        break;
	    $EnvioDTE->agregar($DTE);
	}

	$EnvioDTE->setCaratula($caratula);
	$EnvioDTE->setFirma($Firma);
	$dir = "xml/boletas/$empresa/$fecha_hoy/";
	if (!file_exists($dir)) {
	    mkdir($dir, 0777, true);
	}
	$boleta_ubic = "xml/boletas/$empresa/$fecha_hoy/".$folio."_boleta.xml";
	file_put_contents($boleta_ubic, $EnvioDTE->generar()); // guardar XML en sistema de archivos

	$xml = file_get_contents($boleta_ubic);
	$enviar_boleta = new Utility_EnvioBoleta();
	$respuesta = $enviar_boleta::enviar($rutemisor, $rut, $xml, $Firma);
	if(inserta_folio($folio, $total, date("Y-m-d"), date("H:i:s"), $sucursal, $caja, $rut, $respuesta['trackid'], $respuesta['estado'])){
		crea_pdf($xml, $folio, $empresa, $rut, $cli, $nombre);
		return $respuesta;
	}

	else{
		return false;
	}

}





?>