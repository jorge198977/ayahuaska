<?php
session_start();
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
include("../intranet/funciones/seguridad.php");
if(!validaringreso())
  	header('Location:../index.php?NOCINICIA');
include("../intranet/funciones/controlador.php");
  //require('../intranet/funciones/fpdf/fpdf.php');
include("../intranet/phpmailer/sendmail.php");
// CONFIGURACIÓN PREVIA


$movi = $_GET['mov'];
$total = $_GET['total'];
$mesa = $_GET['mesa'];
$descuento = $_GET['descu'];
$descu_especial = $_GET['descu_especial'];
$desc_puntos = $_GET['desc_puntos'];
$nombrearchivo = $movi."-ver.pdf";
$desc = $total - $descuento - $descu_especial - $desc_puntos;
$prop = $desc * 0.1;
$tot = $desc + $prop;

if($_GET['Socio_id'] != ""){
  $nombre_socio = get_nombre_socio($_GET['Socio_id']);
  $nombresocio = $nombre_socio['nombre'];
}
else{
  $nombresocio = "";
}
$venta = get_venta_id($movi);
$mesero = get_usuario_id($venta['usuario_id']);
$nombre_mesero = $mesero['nombre']." ".$mesero['apellido'];

$codigo_comercial = "REAL002";

envia_peticion_pre_cuenta($codigo_comercial, $movi, $mesa, $nombre_mesero, $nombresocio, $total, $descuento, $descu_especial, $desc_puntos, $desc, $prop, $tot);

function envia_peticion_pre_cuenta($codigo_comercial, $movi, $mesa, $mesero, $nombre_cliente, $total, $descuento, $descu_especial, $desc_puntos, $desc, $prop, $tot){

	$ventas_detalles = get_ventas_detalles_id($movi);
	foreach ($ventas_detalles as $key => $venta_detalle){
		$cantidad_temporal = get_cantidad_venta_temporal($movi, $venta_detalle['preparado_id'], 0, $venta_detalle['npedido']);
        if($cantidad_temporal == ""){
          $cantidad_temporal = 0;
        }
        if($cantidad_temporal < $venta_detalle['cantidad']){
        	 $preparado = get_preparados_id($venta_detalle['preparado_id']);
        	 $precio = $preparado['PREPARADOS_PRECIO'];
        	 $cantidad = $venta_detalle['cantidad'] - $cantidad_temporal;
        	 $subtotal = $precio * $cantidad;

        	 $detalle[] = array('nombre' => utf8_encode(sanear_string($preparado['PREPARADOS_NOMBRE'])) , 'cantidad' => $cantidad, 'precio' => $precio, 'subtotal' => $subtotal);
       	}
    }

    $totales[] = array('totalsinprop' => $total, 'descuento' => $descuento, 'descuespecial' => $descu_especial, 'descpuntos' => $desc_puntos, 'total' => $desc, 'propina' =>$prop, 'totalconprop' => $tot);



	// $url = "https://api.notifier.realdev.cl/api/pre_cuenta";
	// $parametrosdatos = array('codcomercio' => $codigo_comercial, 'comercio' => 'TURQUESA', 'comuna' => 'Ovalle',
 //      'direccion' => 'KM 5 Camino SOTAQUI',
 //     	'impresora' => 'CAJA',
 //     	'movimiento' => $movi,
 //     	'mesa' => $mesa,
 //     	'mesero' => $mesero,
 //     	'nombrecli' => $nombre_cliente,
 //     	'detalle' => $detalle,
 //     	'totales' => $totales);
 //  print_r($parametrosdatos);
	// $data = postURL($url, $parametrosdatos);
	// $data = json_decode($data);
	// return $data;
}

 

header('Location:verpedido_detalle.php?Mov='.$movi.'&Impreso');

?>