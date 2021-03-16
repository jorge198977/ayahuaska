<?php
include("intranet/funciones/controlador.php");
include("intranet/phpmailer/sendmail.php");


$costos = get_all_costos();
$hoy = date("Y-m-d");
foreach ($costos as $key => $costo) {
	$dias_restantes = dateDiff($hoy, $costo['fecha']); 
	if($dias_restantes == 1){
		//echo $costo['fecha'].", DIF:".$dias_restantes."<br>";
		enviar_correo_vencimiento_costo($costo['id'], $costo['nombre'], $costo['monto'], $costo['usuario_id'], $costo['tipo_costo_id']);
	}
}



function dateDiff($start, $end) { 
	$start_ts = strtotime($start); 
	$end_ts = strtotime($end); 
	$diff = $end_ts - $start_ts; 
	return round($diff / 86400); 
}

?>