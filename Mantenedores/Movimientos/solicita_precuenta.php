<?php
session_start();
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
include("../../intranet/funciones/seguridad.php");
if(!validaringreso())
  	header('Location:../index.php?NOCINICIA');
include("../../intranet/funciones/controlador.php");
  //require('../intranet/funciones/fpdf/fpdf.php');
include("../../intranet/phpmailer/sendmail.php");
// CONFIGURACIÓN PREVIA


$movi = $_GET['mov'];
$mesa = $_GET['mesa'];

$venta = get_venta_id($movi);
$mesero = get_usuario_id($venta['usuario_id']);
$nombre_mesero = $mesero['nombre']." ".$mesero['apellido'];

$codigo_comercial = "REAL002";
$total_calculado = 0;

envia_peticion_pre_cuenta($codigo_comercial, $movi, $mesa, $nombre_mesero);

function envia_peticion_pre_cuenta($codigo_comercial, $movi, $mesa, $mesero){
  $cargo_delivery = 0;
	$ventas_detalles = get_ventas_detalles_id($movi);
	foreach ($ventas_detalles as $key => $venta_detalle){
		$cantidad_temporal = get_cantidad_venta_temporal($movi, $venta_detalle['preparado_id'], 0, $venta_detalle['npedido']);
        if($cantidad_temporal == ""){
          $cantidad_temporal = 0;
        }
        if($cantidad_temporal < $venta_detalle['cantidad']){
        	 $preparado = get_preparados_id($venta_detalle['preparado_id']);
           $familia = $preparado['PREPARADOS_FAMILIA'];
            //SI ES DELIVERY
          if($familia == 160)
            $cargo_delivery = 1;
        	 $precio = $preparado['PREPARADOS_PRECIO'];
        	 $cantidad = $venta_detalle['cantidad'] - $cantidad_temporal;
        	 $subtotal = $precio * $cantidad;
           $total_calculado = $total_calculado + $subtotal;
        	 $detalle[] = array('nombre' => utf8_encode(sanear_string($preparado['PREPARADOS_NOMBRE'])) , 'cantidad' => $cantidad, 'precio' => $precio, 'subtotal' => $subtotal);
       	}
    }

    $tot_menos_desc = $total_calculado;
    $propina_calulada = $tot_menos_desc * 0.1;
    $tot_con_prop = $tot_menos_desc + $propina_calulada;


    //$totales[] = array('totalsinprop' => $total, 'descuento' => $descuento, 'descuespecial' => $descu_especial, 'descpuntos' => $desc_puntos, 'total' => $desc, 'propina' =>$prop, 'totalconprop' => $tot);
    $totales[] = array('totalsinprop' => $total_calculado, 'descuento' => 0, 'descuespecial' => 0, 'descpuntos' => 0, 'total' => $tot_menos_desc, 'propina' =>$propina_calulada, 'totalconprop' => $tot_con_prop);

    //print_r($detalle);


	$url = "https://api.notifier.realdev.cl/api/pre_cuenta";
	$parametrosdatos = array('codcomercio' => $codigo_comercial, 'comercio' => 'AYAHUASKA', 'comuna' => 'Ovalle',
      'direccion' => 'OVALLE',
     	'impresora' => 'CAJA',
     	'movimiento' => $movi,
     	'mesa' => $mesa,
     	'mesero' => $mesero,
     	'nombrecli' => $nombre_cliente,
     	'detalle' => $detalle,
     	'totales' => $totales);
  //print_r($parametrosdatos);
	$data = postURL($url, $parametrosdatos);
	$data = json_decode($data);
	return $data;
}

 

header('Location:index.php?Impreso');

?>