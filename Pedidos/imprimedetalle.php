<html>
<head>
</head>
  <body>
  <?php
  session_start();
  include("../intranet/funciones/seguridad.php");
  if(!validaringreso())
      header('Location:../index.php?NOCINICIA');
  include("../intranet/funciones/controlador.php");
  //require('../intranet/funciones/fpdf/fpdf.php');
  include("../intranet/phpmailer/sendmail.php");
  ?>

  <?php

    class PDF extends FPDF
{
//Cabecera de página
   function Header()
   {
    //Logo
    // $this->Image("images/logocafe-ico.png" , 5 ,4, 18 , 19 , "PNG" ,"");
    //Arial bold 15
    $this->SetFont('Arial','B',14);
    //Movernos a la derecha
    //Título
    $this->Cell(50,15,'SHEOL',0,0,'C');
    $this->Ln();

   }
   
   //Pie de página
   function Footer()
   {
    //Posición: a 1,5 cm del final
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',9);
    //Número de página
    $this->Cell(0,10,'Pag '.$this->PageNo().'/{nb}',0,0,'C');
   }
   //Tabla simple
   function TablaSimple($header, $total, $tot, $prop, $mesa, $movi, $nombre_mesero, $nombre_socio, $descuento, $desc, $descu_especial, $desc_puntos)
   {
    
      $ventas_detalles = get_ventas_detalles_id($movi);
      $nombrearchivo = $movi.".txt";
      $this->SetFont('Arial','B',13);
      $this->Cell(32);
      $this->cell(100,13,"Mesa: ".$mesa,0);
      $this->Ln();
      $this->SetFont('Arial','B',8);
      $this->Cell(32);
      $this->cell(50,7,"N int: ".$movi,0);
      $this->Ln();
      $this->cell(50,7,"Fecha: ".date("d-m-y H:i:s"),0);
      $this->Ln();
      //$this->cell(50,7,"Hora: ".date("H:i:s"),0);
      $this->cell(50,7,"Atendido por: ".utf8_decode($nombre_mesero),0);
      $this->Ln();
      if($nombre_socio != ""){
        $this->cell(50,7,"Nombre Cliente: ".utf8_decode($nombre_socio),0);
        $this->Ln();  
      }
      $this->SetFont('Arial','B',8);
      $this->cell(32,7,utf8_decode("DESCRIPCIÓN") ." DEL CONSUMO: ",0);
      $this->Ln();
      $this->SetFont('Arial','B',7);

      foreach ($ventas_detalles as $key => $venta_detalle) { 
        

        $cantidad_temporal = get_cantidad_venta_temporal($movi, $venta_detalle['preparado_id'], 0, $venta_detalle['npedido']);
        if($cantidad_temporal == ""){
          $cantidad_temporal = 0;
        }
        if($cantidad_temporal < $venta_detalle['cantidad']){
          $preparado = get_preparados_id($venta_detalle['preparado_id']);
          $tamdescrip = strlen($preparado['PREPARADOS_NOMBRE']);
          if($tamdescrip > 27){

            $descrip1 = substr($preparado['PREPARADOS_NOMBRE'], 0, 26);
            $descrip2 = substr($preparado['PREPARADOS_NOMBRE'], 26, $tamdescrip);

            $this->Cell(100,4, $venta_detalle['cantidad']. " ".utf8_decode($descrip1), 0, 0, 'L');
            $this->Ln();
            $this->Cell(100,4, utf8_decode($descrip2),0, 0, 'L');
            $this->Ln();
            $this->Cell(32);
            $this->Cell(50,2, "$".number_format($preparado['PREPARADOS_PRECIO'] * $venta_detalle['cantidad'], 0, ',', '.'),0);
            $this->Ln();


          }
          else{
            $this->Cell(100,4,$venta_detalle['cantidad']." ".utf8_decode($preparado['PREPARADOS_NOMBRE']),0, 0, 'L');
            $this->Ln();
            $this->Cell(32);
            $this->Cell(50,2, "$".number_format($preparado['PREPARADOS_PRECIO'] * $venta_detalle['cantidad'], 0, ',', '.'),0);
            $this->Ln();  
          }
        }
        $this->Ln();
      
      }

      $this->Ln();
      $this->SetFont('Arial','B',10);
      $this->Cell(100,5, "Total Sin Propina: $".number_format($total, 0, ',', '.'),0);
      $this->Ln(); 
      if($descuento > 0){
        $this->Cell(100,5, "Descuento: $".number_format($descuento, 0, ',', '.'),0);
        $this->Ln();
      }
      if($descu_especial > 0){
        $this->Cell(100,5, "Descuento Esp: $".number_format($descu_especial, 0, ',', '.'),0);
        $this->Ln();
      }
      if($desc_puntos > 0){
        $this->Cell(100,5, "Descuento Pts: $".number_format($desc_puntos, 0, ',', '.'),0);
        $this->Ln();
      }
      $this->Cell(100,5, "Total: $".number_format($desc, 0, ',', '.'),0);
      $this->Ln(); 
      $this->Cell(100,5, "Propina sugerida 10%: $".number_format($prop, 0, ',', '.'),0);
      $this->Ln();
      $this->Cell(100,5, "Total Con Propina: $".number_format($tot, 0, ',', '.'),0);
      $this->Ln();
      $this->SetFont('Arial','B',12); 
      $this->SetFont('Arial','B',10); 
      $this->cell(100,7,"_______________________________________",0);
      $this->Ln();
      $pie = get_pie_pagina_estado(0);
      $this->SetFont('Arial','B',7);
      $this->cell(50,7,utf8_decode($pie),0,0,'C');
      $this->Ln();
      
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

    $pdf=new PDF();
    $ubicacion = "../boletas/".$nombrearchivo;
    $pdf->AliasNbPages();
    //Primera página
    $pdf->AddPage();
    $pdf->SetY(18);
    //$pdf->AddPage();
    $pdf->TablaSimple($header, $total, $tot, $prop, $mesa, $movi, $nombre_mesero, $nombresocio, $descuento, $desc, $descu_especial, $desc_puntos);
    $pdf->Output($ubicacion);
    $usuario = get_usuario_id($_SESSION['id']);
    $impresora = get_impresora_url($usuario['impresora_id']);
    $salida = shell_exec("lpr -P ".$impresora." ".$ubicacion."");  

    header('Location:verpedido_detalle.php?Mov='.$movi.'&Impreso');

  ?>

  </body>
</html>
