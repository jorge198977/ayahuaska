<?php
session_start();
include("../intranet/funciones/controlador.php");
include("../intranet/funciones/genera_ticket.php");
//include('../intranet/funciones/fpdf/fpdf.php');
date_default_timezone_set('America/Santiago');  
$nombresocio = "";
$mov = $_GET['mov'];
if(isset($_GET['socio_id'])){
  $socio = get_nombre_socio($_GET['socio_id']);
  $nombresocio = $socio['nombre']." ".$socio['apellido'];
}

$mesa_id = get_venta_mesa_id($_GET['mov']);
$mesa = get_mesa_num_by_id($mesa_id);

imprime($_GET['mov'], $_GET['npedido'], $nombresocio, $_SESSION['id'], $mesa);
imprime_cocina2($_GET['mov'], $_GET['npedido'], $nombresocio, $_SESSION['id'], $mesa);

$cant_happy = get_cant_happy($_GET['mov'], 0);
if($cant_happy > 0){
	for($i=0; $i < $cant_happy; $i++){  
     	imprimehappy2($_GET['mov'], $_SESSION['id'], $nombresocio, $mesa);
  	}
}
   
header('Location:cuenta.php?Mov='.$mov.'&qrcli&Mesa='.$mesa.'');

?>  