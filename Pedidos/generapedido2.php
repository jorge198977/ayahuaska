<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
session_start();

include("../intranet/funciones/controlador.php");
include('../intranet/funciones/barcode.php');
include("../intranet/funciones/genera_ticket.php");
//include('../intranet/funciones/fpdf/fpdf.php');
date_default_timezone_set('America/Santiago');  

$nombresocio = "";

$socio_id = get_vta_socio_id($_GET['oMov']);

if($socio_id != ""){
  $socio = get_nombre_socio($socio_id);
  $nombresocio = $socio['nombre'];
}


$mesa_id = get_venta_mesa_id($_GET['oMov']);
//$impresora = $_POST['impresora'];
$impresora = "BARRA1";
$mesa = get_mesa_num_by_id($mesa_id);

solicita_ticket($_GET['oMov'], $_GET['oNpedido'], $nombresocio, $_SESSION['id'], $mesa, $impresora);
solicita_ticker_cocina($_GET['oMov'], $_GET['oNpedido'], $nombresocio, $_SESSION['id'], $mesa);
//solicita_ticker_parrilla($_GET['oMov'], $_GET['oNpedido'], $nombresocio, $_SESSION['id'], $mesa);

$cant_happy = get_cant_happy($_GET['oMov'], 0);
//echo "c->".$cant_happy;
if($cant_happy > 0){
	for($i=0; $i < $cant_happy; $i++){  
     	solicita_happy($_GET['oMov'], $_SESSION['id'], $nombresocio, $mesa, $impresora);
  	}
}
   
header('Location:index.php?generado');

?>  