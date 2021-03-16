<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
include 'config.php';
require_once 'Clases/FirmaElectronica.php';
require_once 'Clases/EnvioBoleta.php';


function get_estado_by_trackid($empresa, $trackid){

	
	$config = get_firma2();
	
	$Firma = new FirmaElectronica($config['firma']);
	$Boleta = new Utility_EnvioBoleta();
	$respuesta = $Boleta::consultaBoleta($empresa, $Firma, $trackid);
	return $respuesta;
}





?>