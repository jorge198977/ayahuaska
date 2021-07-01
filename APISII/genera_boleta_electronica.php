<?php
include 'config.php';
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

function create_boleta_electronica($detalles, $movi, $propina, $descuento, $esdelivery){
	


	$folio = get_min_folios_disponibles();
	//NO EXISTEN FOLIOS DISPONIBLES SE ENVIA CORREO NOTIFICANDO Y NO SE CREA LA BOLETA
	if($folio == 0)
		return 0;
	actualiza_folios_disponibles($folio, 1);
	$datos = get_datos();
	$empresa = $datos['datos']['empresa'];
	$rutemisor = $datos['datos']['rutemisor'];
	$rute = $datos['datos']['rut'];
	$xml = get_xml_by_folio($folio, $rute);
	$fecha_hoy = date("Y-m-d");
	$folios = [
	    39 => $folio, //BOLET ELECTRONICA
	];
	$config = get_firma();
	$caratula = set_caratula($datos['caratula']);
	$emisor = set_emisor($datos['emisor']);
	$total = 0;


	foreach ($detalles as $key => $detalle) {
		if($detalle['familia'] != 30){
			$cantidad = $detalle['cantidad'];
			$total = $total + ($detalle['precio'] *$cantidad );
		    $det[] = array('NmbItem' => $detalle['nombre'], 'QtyItem' => $cantidad, 'PrcItem' => $detalle['precio']);
		}
		else{
			
			$det[] = array('IndExe' => 1, 'NmbItem' => $detalle['nombre'], 'QtyItem' => $cantidad, 'PrcItem' => $detalle['precio']);
	

		}
		
	}

	if($propina > 0){
		
		$det[] = array('IndExe' => 1, 'NmbItem' => 'PROPINA', 'QtyItem' => 1, 'PrcItem' => $propina);
		

	}

	if($esdelivery == 1){
		
		$det[] = array('IndExe' => 1, 'NmbItem' => 'CARGO POR DELIVERY', 'QtyItem' => 1, 'PrcItem' => 2000);
		
	}


	if($descuento >0){
		$desc[] = array('TpoMov' => 'D', 'TpoValor' => '$', 'GlosaDR' => 'Descuento a cliente', 'ValorDR' => $descuento);

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
		            		$det,
		            'DscRcgGlobal' => $desc
		            
		    ],
		];
	}
	else{
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
	}


	
	


	


	$Firma = new FirmaElectronica($config['firma']);
	foreach ($folios as $tipo => $cantidad)
	    $Folios[$tipo] = new Folios(file_get_contents('../../APISII/xml/empresas/AYAHUASKA/'.$xml));
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
	$dir = "../../APISII/xml/boletas/AYAHUASKA/$fecha_hoy/";
	if (!file_exists($dir)) {
	    mkdir($dir, 0777, true);
	}
	$boleta_ubic = "../../APISII/xml/boletas/AYAHUASKA/$fecha_hoy/".$folio."_boleta.xml";
	file_put_contents($boleta_ubic, $EnvioDTE->generar()); // guardar XML en sistema de archivos

	$xml = file_get_contents($boleta_ubic);
	//$enviar_boleta = new Utility_EnvioBoleta();
	//$respuesta = $enviar_boleta::enviar($rutemisor, $rute, $xml, $Firma);
	//inserta_folio($folio, $total, date("Y-m-d"), date("H:i:s"), $rute, $respuesta['trackid'], $respuesta['estado'], $movi))

	inserta_folio($folio, $total, date("Y-m-d"), date("H:i:s"), $rute, 0, 'PENDIENTE', $movi);
	crea_pdf($xml, $folio, $empresa);
		//return $respuesta;	
	return $folio;
	
}



?>
