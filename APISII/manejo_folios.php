<?php
//header('Content-type: text/plain; charset=ISO-8859-1');
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once 'Clases/Log.php';
require_once 'Clases/XML.php';
require_once 'Clases/Estado.php';
require_once 'Clases/I18n.php';
require_once 'Clases/Sii.php';
require_once 'Clases/SII/Model_DteFolio.php';
//include("funciones/controlador.php");




function get_folio_disponible(){
	$rutempresa = '76892705-7';
	$folios = get_folios_disponibles($rutempresa);
	if($folios == 0){
		$para = "jorgeuls19@gmail.com";
		$asunto = "ALERTA folios disponibles";
		$mensaje = "Informamos que no existen folios disponibles para la empresa SHEOL, favor cargar nuevos folios en sheolsistema.ddns.net/APISII/guardar_folio.php";
		 
		mail($para, $asunto, $mensaje);
		return 0;
	}
	return min($folios); 
	
}

function set_folios($empresa, $ambiente, $xml, $nombrexml){
	$DteFolio = new Model_DteFolio();
	$respuesta = $DteFolio::guardarFolios($empresa, $ambiente, $xml, $nombrexml);
	return $respuesta;
}

// function get_folios_disponibles($empresa){
// 	$DteFolio = new Model_DteFolio();
// 	$respuesta = $DteFolio::getSinUso($empresa);
// 	if(empty($respuesta)){
// 		return 0;
// 	}
// 	return $respuesta;
// }


?>