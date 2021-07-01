<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
include("../intranet/funciones/seguridad.php");
if(!validaringreso())
  	header('Location:../index.php?NOCINICIA');
include("../intranet/funciones/controlador.php");
  //require('../intranet/funciones/fpdf/fpdf.php');
  include("../intranet/phpmailer/sendmail.php");
// CONFIGURACIÓN PREVIA


class PDF extends FPDF{

	function header(){
		$this->SetFont('Helvetica','',12);
		$this->Cell(60,4,'AYAHUASKA',0,1,'C');
		$this->Cell(60,4,'OVALLE',0,1,'C');
	}

	function set_data($mesa, $nint, $garzon, $cli){
		// DATOS FACTURA        
		$this->Ln(5);
		$this->SetFont('Arial','B',7);
		$this->Cell(60,4,'MESA: '.$mesa.' ',0,1,'');
		$this->Cell(60,4,'MOVI: '.$nint.'',0,1,'');
		$this->Cell(60,4,'FECHA: '.date("d-m-Y H:i:s").'',0,1,'');
		if($cli != ''){
			$this->Cell(60,4,'CLI: '.$cli.'',0,1,'');	
		}
		$this->Cell(60,4,'ATENDIDO POR: '.$garzon.'',0,1,'');
	}


	function set_colums(){
		// COLUMNAS
		$this->SetFont('Helvetica', 'B', 7);
		$this->Cell(30, 10, 'PRODUCTO', 0);
		$this->Cell(5, 10, 'UN',0,0,'R');
		$this->Cell(10, 10, 'PRECIO',0,0,'R');
		$this->Cell(15, 10, 'TOTAL',0,0,'R');
		$this->Ln(8);
		$this->Cell(60,0,'','T');
		$this->Ln(0);
	}


	function set_body($movi, $total, $descuento, $descu_especial, $desc_puntos, $desc, $prop, $tot){
		// PRODUCTOS
		$this->SetFont('Helvetica', '', 7);
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
	        	 $this->MultiCell(30,4,$preparado['PREPARADOS_NOMBRE'],0,'L'); 
	        	 $this->Cell(35, -5, $cantidad,0,0,'R');
	        	 $this->Cell(10, -5, '$ '.number_format($precio, 0, ',', '.'),0,0,'R');
	        	 $this->Cell(15, -5, '$ '.number_format($subtotal, 0, ',', '.'),0,0,'R');
				 $this->Ln(3);
	        }
		}

		$this->Ln(6); $this->Cell(60,0,'','T'); $this->Ln(2); 
		$this->SetFont('Helvetica', 'B', 7);
		$this->Cell(25, 10, 'Total S. Propina.', 0); $this->Cell(20, 10, '', 0);
		$this->Cell(15, 10, '$ '.number_format($total, 0, ',', '.'),0,0,'R'); 
		$this->Ln(3); 
		if($descuento > 0){
			$this->Cell(25, 10, 'Descuento.', 0); $this->Cell(20, 10, '', 0);
			$this->Cell(15, 10, '$ '.number_format($descuento, 0, ',', '.'),0,0,'R'); 
			$this->Ln(3); 
		} 
		if($descu_especial > 0){
	        $this->Cell(25, 10, 'Descuento Esp.', 0); $this->Cell(20, 10, '', 0);
	        $this->Cell(15, 10, '$ '.number_format($descu_especial, 0, ',', '.'),0,0,'R'); 
			$this->Ln(3); 
	    }
	    if($desc_puntos > 0){
	        $this->Cell(25, 10, 'Descuento Pts.', 0); $this->Cell(20, 10, '', 0);
	        $this->Cell(15, 10, '$ '.number_format($desc_puntos, 0, ',', '.'),0,0,'R'); 
			$this->Ln(3); 
	    }
	    $this->Cell(25, 10, 'Total.', 0); $this->Cell(20, 10, '', 0);
	    $this->Cell(15, 10, '$ '.number_format($desc, 0, ',', '.'),0,0,'R'); 
		$this->Ln(3);
		$this->Cell(25, 10, 'Propina sugerida.', 0); $this->Cell(20, 10, '', 0);
		$this->Cell(15, 10, '$ '.number_format($prop, 0, ',', '.'),0,0,'R');
		$this->Ln(3);
		$this->Cell(25, 10, 'Total Con Propina.', 0); $this->Cell(20, 10, '', 0);
		$this->Cell(15, 10, '$ '.number_format($tot, 0, ',', '.'),0,0,'R');
		$this->Ln(3);



       	$this->Ln(6); $this->Cell(60,0,'','T'); $this->Ln(2); 
      	$pie = get_pie_pagina_estado(0);
      	$this->Ln(3); $this->Cell(60,0,utf8_decode($pie),0,1,'C'); 
      	$this->Ln(3);
	}


}



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


$pdf = new PDF('P','mm',array(80,150)); // Tamaño tickt 80mm x 150 mm (largo aprox)
$pdf->AddPage();
$pdf->set_data($mesa, $movi, $nombre_mesero, $nombresocio);
$pdf->set_colums();
$pdf->set_body($movi, $total, $descuento, $descu_especial, $desc_puntos, $desc, $prop, $tot);


// CABECERA

 



 

$movi = $_GET['mov'];
$nombrearchivo = $movi."-ver.pdf";
$ubicacion = "../boletas/".$nombrearchivo;
$pdf->Output($ubicacion);


?>