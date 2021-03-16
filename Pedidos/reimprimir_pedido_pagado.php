<?php
include("../intranet/funciones/controlador.php");
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
 session_start();
 $mov = $_GET['mov'];
 $vta_pago = $_GET['vta_pago'];
 $nombre = $mov."-".$vta_pago.".pdf";
 $direccion = "../boletas/movimientos/".$nombre;
 $usuario = get_usuario_id($_SESSION['id']);
 $impresora = get_impresora_url($usuario['impresora_id']);
 $salida = shell_exec("lpr -P ".$impresora." ".$direccion.""); 
 header('Location:cerrarped.php?Mov='.$mov.'&pedircuenta&ReimpresoPagado');
?>
