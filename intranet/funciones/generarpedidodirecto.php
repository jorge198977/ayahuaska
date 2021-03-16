<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
//include("controlador.php");
//include("../funciones/genera_ticket.php");
//include('fpdf/fpdf.php');
include('barcode.php');

date_default_timezone_set('America/Santiago');  
function imprime_directo($mov, $usuario_id, $total, $monto_pagado, $fpago){

	$nombresocio = "";

	date_default_timezone_set('America/Santiago');
	$nombrearchivo = $mov."-directo.pdf";
	$usuario = get_usuario_id($usuario_id);
	$venta_detalles = get_ventas_detalles_id_pedido($mov, 1);
	$nombre_usuario = $usuario['nombre']. " ".$usuario['apellido'];
	$formapago = get_forma_pago_id($fpago);
	$pdf=new FPDF();
	$ubicacion = "../../boletas/tickets/".$nombrearchivo;
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(50,7,'SHEOL VENTA DIRECTA',0,0,'C');
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
	$pdf->SetFont('Arial','B',8);


	foreach ($venta_detalles as $key => $venta_detalle) {

          $preparado = get_preparados_id($venta_detalle['preparado_id']);
          $tamdescrip = strlen($preparado['PREPARADOS_NOMBRE']);
          if($tamdescrip > 27){
            $descrip1 = substr($preparado['PREPARADOS_NOMBRE'], 0, 26);
            $descrip2 = substr($preparado['PREPARADOS_NOMBRE'], 26, $tamdescrip);
            $pdf->Cell(100,5, $venta_detalle['cantidad']. " ".utf8_decode($descrip1));
            $pdf->Ln();
            $pdf->Cell(100,5, utf8_decode($descrip2). " = $".number_format($preparado['PREPARADOS_PRECIO'] * ($venta_detalle['cantidad']), 0, ',', '.'),0);
            $pdf->Ln();
          }
          else{
            $pdf->Cell(100,5,$venta_detalle['cantidad']." ".utf8_decode($preparado['PREPARADOS_NOMBRE']). " = $".number_format($preparado['PREPARADOS_PRECIO'] * ($venta_detalle['cantidad']), 0, ',', '.'),0);
            $pdf->Ln();  
          }
       
    }



	$pdf->SetFont('Arial','B',10);
    $pdf->Cell(100,8, "Total: $".number_format($total, 0, ',', '.'),0);
    $pdf->Ln(); 
    $pdf->Cell(100,8, "Pagado:   $".number_format(($monto_pagado), 0, ',', '.'),0);
    $pdf->Ln();
    $pdf->Cell(100,8, "Vuelto:   $".number_format(($monto_pagado - ($total)), 0, ',', '.'),0);
    $pdf->Ln();
    $pdf->SetFont('Arial','B',10); 
    $pdf->Cell(100,7, " Forma de pago: ".utf8_decode($formapago),0);
    $pdf->Ln();
    $pdf->cell(100,7,"_______________________________________",0);
    $pdf->Ln();

	$pdf->SetAutoPageBreak(true, 20);
	//$y = $pdf->GetY();  
	//$codigo = "DIRECTO-".$mov;
	//barcode('codigos/'.$codigo.'.png', $codigo, 20, 'horizontal', 'code128', true);
	//$pdf->Image('codigos/'.$codigo.'.png',10,$y,50,0,'PNG');  
	//$y = $y+15;
	$usuario = get_usuario_id($usuario_id);
	$impresora = get_impresora_url($usuario['impresora_id']);
	$pdf->Output($ubicacion);
	$salida = shell_exec("lpr -P ".$impresora." ".$ubicacion."");

	$cant_happy = get_cant_happy($mov, 0);
	if($cant_happy > 0){
		include("genera_ticket.php");
		for($i=0; $i < $cant_happy; $i++){  
	     	imprimehappy2($mov, $usuario_id, '', '9999');
	  	}
	}

	//$pdf->Output();
	//imprimecover($_GET['mov'], $_SESSION['id']);
	//header("Location:../../Pedidos/cerrarped.php?Mov=".$codigo."");

}





function imprime_cocinadirecto($vta_id, $npedido, $nombre_cliente, $usuario_id, $mesa){

  $cuenta_cocina = 0;
  date_default_timezone_set('America/Santiago');
  $nombrearchivo = $vta_id."-".$npedido.".pdf";

  $venta_detalles = get_ventas_detalles_id_pedido($vta_id, $npedido);
  $usuario = get_usuario_id($usuario_id);


  $nombre_usuario = $usuario['nombre']. " ".$usuario['apellido'];

  $pdf=new FPDF();
  $ubicacion = "../../boletas/tickets/cocina/".$nombrearchivo;
  $pdf->AddPage();

  $pdf->SetFont('Arial','B',14);
  $pdf->Cell(50,7,'SHEOL',0,0,'C');
  $pdf->Ln();
  $pdf->SetFont('Arial','B',13);
  $pdf->Cell(32);
  $pdf->cell(60,7,"Mesa: ".$mesa,0);
  $pdf->Ln();
  $pdf->SetFont('Arial','B',8);
  $pdf->Cell(32);
  $pdf->cell(50,7,"N int: ".$vta_id,0);
  $pdf->Ln();

  if($nombre_cliente != ""){
    $pdf->cell(50,7,"Cliente: ".utf8_decode($nombre_cliente),0);
    $pdf->Ln(); 
  }
  $pdf->cell(50,7,"Fecha: ".date("d-m-y H:i:s"),0);
  $pdf->Ln();
  $pdf->cell(50,7,"Atendido por: ".utf8_decode($nombre_usuario),0);
  $pdf->Ln();
  $pdf->cell(100,7,utf8_decode("DESCRIPCIÓN") ." DEL PEDIDO: ",0);
  $pdf->Ln();
  $pdf->SetFont('Arial','B',7);

  foreach ($venta_detalles as $key => $venta_detalle) {
    $preparado = get_preparados_id($venta_detalle['preparado_id']);
    // SI ES COMINDA  IMPRIME
    if(($preparado['PREPARADOS_FAMILIA'] == 27) || ($preparado['PREPARADOS_FAMILIA'] == 39) || 
      ($preparado['PREPARADOS_FAMILIA'] == 46) || ($preparado['PREPARADOS_FAMILIA'] == 48) ||
      ($preparado['PREPARADOS_FAMILIA'] == 49) || ($preparado['PREPARADOS_FAMILIA'] == 54) 
      || ($preparado['PREPARADOS_FAMILIA'] == 106) || ($preparado['es_cocina'] == 1)){

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

      if($venta_detalle['observacion'] != ""){
          $pdf->SetFont('Arial','B',11); 
          $pdf->Cell(50,5, "*OBSERV: ".utf8_decode($venta_detalle['observacion']),0,0,'C');
          $pdf->Ln();   
            $pdf->SetFont('Arial','B',7);
      }
      $cuenta_cocina++;
    }
    
  }

  if($cuenta_cocina > 0){
    $pdf->Output($ubicacion);
    $salida = shell_exec("lpr -P COCINA ".$ubicacion."");  
  }

}
?> 