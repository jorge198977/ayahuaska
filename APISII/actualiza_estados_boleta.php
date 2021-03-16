<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include("consulta_estado.php");
include("../intranet/funciones/controlador.php");


function actualiza_estados(){
	$pendientes = get_pendientes_estado();
	$empresa = '76324007-K';
	foreach ($pendientes as $key => $pendiente) {
		$estado = get_estado_by_trackid($empresa, $pendiente['trackid']);
		if($estado['estadistica'][0]['aceptados'] == 1){
			$resp = "ACEPTADO";
		}
		if($estado['estadistica'][0]['rechazados'] == 1){
			$resp = "RECHAZADO";
		}
		if($estado['estadistica'][0]['reparos'] == 1){
			$resp = "REPAROS";
		}
		actualiza_estado_boleta($empresa, $pendiente['folio'], $resp);
	}
}




actualiza_estados();




?>