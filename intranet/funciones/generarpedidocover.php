<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
//include("controlador.php");
//include("../funciones/genera_ticket.php");
//include('fpdf/fpdf.php');
include('barcode.php');

date_default_timezone_set('America/Santiago');  
function imprime_entrada($mov, $usuario_id){

	$nombresocio = "";

	date_default_timezone_set('America/Santiago');
	$nombrearchivo = $mov."-cover.pdf";
	$usuario = get_usuario_id($usuario_id);
	$venta_detalles = get_ventas_detalles_id_pedido($mov, 1);
	$nombre_usuario = $usuario['nombre']. " ".$usuario['apellido'];

	$pdf=new FPDF();
	$ubicacion = "../boletas/tickets/".$nombrearchivo;
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(50,7,'SHEOL COVER',0,0,'C');
	$pdf->Ln();
	$pdf->SetFont('Arial','B',13);
	$pdf->Cell(32);
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(32);
	$pdf->cell(50,7,"N int: ".$mov,0);
	$pdf->Ln();
	$pdf->cell(50,7,"Fecha: ".date("d-m-y H:i:s"),0);
	$pdf->Ln();
	$pdf->cell(50,7,"Atendido por: ".utf8_decode($nombre_usuario),0);
	$pdf->Ln();
	$pdf->cell(100,7,utf8_decode("DESCRIPCIÓN") ." DEL PEDIDO: ",0);
	$pdf->Ln();
	$pdf->SetFont('Arial','B',7);
	foreach ($venta_detalles as $key => $venta_detalle) {
	$preparado = get_preparados_id($venta_detalle['preparado_id']);
	$tamdescrip = strlen($preparado['PREPARADOS_NOMBRE']);
	if($tamdescrip > 35) {
	  $descrip1 = substr($preparado['PREPARADOS_NOMBRE'], 0, 34);
	  $descrip2 = substr($preparado['PREPARADOS_NOMBRE'], 34, $tamdescrip);
	  $pdf->Cell(100,5, $venta_detalle['cantidad']."  ".utf8_decode($descrip1),0);
	  $pdf->Ln();
	  $pdf->Cell(100,5, utf8_decode($descrip2),0);
	  $pdf->Ln();
	}
	else{
	  $pdf->Cell(100,5, $venta_detalle['cantidad']."  ".utf8_decode($preparado['PREPARADOS_NOMBRE']),0);
	  $pdf->Ln();  
	}
	}

	$pdf->SetAutoPageBreak(true, 20);
	$y = $pdf->GetY();  
	$codigo = "ENTRADA-".$mov;
	barcode('codigos/'.$codigo.'.png', $codigo, 20, 'horizontal', 'code128', true);
	$pdf->Image('codigos/'.$codigo.'.png',10,$y,50,0,'PNG');  
	$y = $y+15;
	$pdf->Output($ubicacion);
	$salida = shell_exec("lpr -P CAJAENTRADA ".$ubicacion."");
	//$pdf->Output();
	//imprimecover($_GET['mov'], $_SESSION['id']);
	//header("Location:../../Pedidos/cerrarped.php?Mov=".$codigo."");

}
?> 