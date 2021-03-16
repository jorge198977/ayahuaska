<?php
//header('Content-type: text/plain; charset=ISO-8859-1');
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once 'Clases/FirmaElectronica.php';
require_once 'Clases/EnvioBoleta.php';

//$datos['emisor']['rut_emisor'], $config['firma'], $datos['caratula']['rut_recep']
function get_estado_documento($tipodoc, $folio, $monto, $fecha){
	include 'config.php';
	$config = get_firma();
	$datos = get_datos();
	$rutempresa = $datos['datos']['rut'];

	$Firma = new FirmaElectronica($config['firma']);
	$Boleta = new Utility_EnvioBoleta();
	$respuesta = $Boleta::consultaEstadoBoleta($rutempresa, $Firma, $tipodoc, $folio, '66666666-6', $monto, $fecha);
	return $respuesta;
}

?>