<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include 'config.php';
include("genera_pdf.php");
include("manejo_folios.php");
include("../intranet/funciones/controlador.php");
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


function get_pendientes_envio(){
	$datos = get_datos();
	$empresa = $datos['datos']['empresa'];
	$rutemisor = $datos['datos']['rutemisor'];
	$rute = $datos['datos']['rut'];
	$fecha_hoy = date("Y-m-d");
	$config = get_firma2();
	$Firma = new FirmaElectronica($config['firma']);
	$pendientes = get_pendientes_enviar($fecha_hoy);
	if($pendientes != 0){
		foreach ($pendientes as $key => $pendiete) {
			$boleta_ubic = "xml/boletas/TURQUESA/$fecha_hoy/".$pendiete['folio']."_boleta.xml";
			$xml = file_get_contents($boleta_ubic);
			$enviar_boleta = new Utility_EnvioBoleta();
			$respuesta = $enviar_boleta::enviar($rutemisor, $rute, $xml, $Firma);
			if(!actualiza_track_id($pendiete['folio'], $respuesta['trackid'],  $respuesta['estado']))
				echo "ERROR EN ".$pendiete['folio'].", TRACK->".$respuesta['trackid'].", ESTADO->".$respuesta['estado'];
		}
	}
}


get_pendientes_envio();


?>