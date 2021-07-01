<?php
session_start();
include("../intranet/funciones/controlador.php");
include("../intranet/funciones/genera_ticket.php");
//include('../intranet/funciones/fpdf/fpdf.php');
date_default_timezone_set('America/Santiago');  
$nombresocio = "";
$usuario_id = "-";
if($_SESSION['id'] != ""){
	$usuario_id = $_SESSION['id'];
}

$socio_id = get_vta_socio_id($_GET['mov']);

if($socio_id != ""){
  $socio = get_nombre_socio($socio_id);
  $nombresocio = $socio['nombre']." ".$socio['apellido'];
}

//echo "socio_id->".$socio_id.", nombresocio->".$nombresocio;

$mesa_id = get_venta_mesa_id($_GET['mov']);
$mesa = get_mesa_num_by_id($mesa_id);

$impresora = "BARRA1";
solicita_ticket($_GET['mov'], $_GET['npedido'], $nombresocio, $usuario_id, $mesa, $impresora);
solicita_ticker_cocina($_GET['mov'], $_GET['npedido'], $nombresocio, $usuario_id, $mesa);
//solicita_ticker_parrilla($_GET['mov'], $_GET['npedido'], $nombresocio, $usuario_id, $mesa);

$cant_happy = get_cant_happy($_GET['mov'], 0);
if($cant_happy > 0){
	for($i=0; $i < $cant_happy; $i++){  
     	solicita_happy($_GET['mov'], $usuario_id, $nombresocio, $mesa, $impresora);
  	}
}

   
header('Location:ver_pedido.php?ReImpreso');

?> 