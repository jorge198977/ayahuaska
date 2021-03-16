<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();

include("../intranet/funciones/controlador.php");
include('../intranet/funciones/barcode.php');
include("../intranet/funciones/genera_ticket.php");
//include('../intranet/funciones/fpdf/fpdf.php');
date_default_timezone_set('America/Santiago');  

$nombresocio = "";

$socio_id = get_vta_socio_id($_POST['oMov']);

if($socio_id != ""){
  $socio = get_nombre_socio($socio_id);
  $nombresocio = $socio['nombre']." ".$socio['apellido'];
}

//echo "socio_id->".$socio_id.", nombresocio->".$nombresocio;

$mesa_id = get_venta_mesa_id($_POST['oMov']);
$mesa = get_mesa_num_by_id($mesa_id);

imprime($_POST['oMov'], $_POST['oNpedido'], $nombresocio, $_SESSION['id'], $mesa);
imprime_cocina2($_GET['mov'], $_POST['oNpedido'], $nombresocio, $_SESSION['id'], $mesa);

$cant_happy = get_cant_happy($_POST['oMov'], 0);
if($cant_happy > 0){
	for($i=0; $i < $cant_happy; $i++){  
     	imprimehappy2($_POST['oMov'], $_SESSION['id'], $nombresocio, $mesa);
  	}
}
   
header('Location:index.php?generado');

?>  