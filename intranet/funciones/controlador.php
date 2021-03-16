<?php
include("mysql/conecta.php");
require('fpdf/fpdf.php');
//include("../phpmailer/sendmail.php");
//error_reporting(E_ALL);
//ini_set('display_errors', '1');




conecta();
date_default_timezone_set('America/Santiago');




function postURL($url, $parametros)
{
	//urlify the data for the POST
	$fields_string = http_build_query($parametros);

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_VERBOSE, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
	$response = curl_exec($ch);
	curl_close($ch);

	return $response;
}

function get_pagos_actuales($venta_id){
	$ventas_pagos = null;
	$sql = "select * from ayahuaska.ventas_pagos where venta_id = ".$venta_id."";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$ventas_pagos[] = array('id' => $dat['id'], 'valor' => $dat['valor'], 'fecha' => $dat['fecha'], 'hora' => $dat['hora'], 'forma_pago_id' => $dat['forma_pago_id'], 'usuario_id' => $dat['usuario_id']);
		}
	}
	return $ventas_pagos;
}

function ingresa_nueva_forma_pago($vta_id, $total, $mesa_id, $total_temporal, $propina, $forma_pago_id, $cliente_id, $usuario_id, $montopagado, $vuelto, $boleta_temporal){

	//GENERA TICKET PDF
	class PDF extends FPDF
    {
    //Cabecera de página
       function Header()
       {
        $this->SetFont('Arial','B',14);
        $this->Cell(50,15,'ayahuaska',0,0,'C');
        $this->Ln();

       }
       
       //Pie de página
       function Footer()
       {
        $this->SetY(-15);
        $this->SetFont('Arial','I',9);
        $this->Cell(0,10,'Pag '.$this->PageNo().'/{nb}',0,0,'C');
       }

       //TABLA TEMPORAL
       function TablaSimpleTemporal($total_temporal, $propina, $mesa, $movi, $nombremesero, $fpago, $rutcli, $nombrecli, $montopagado, $nombre_socio, $vuelto){
       		$ventas_detalles_temporal = get_ventas_detalles_temporal_id($movi);
       		$nombrearchivo = $movi.".txt";
	        $this->SetFont('Arial','B',12);
	        $this->Cell(32);
	        $this->cell(100,13,"Mesa: ".$mesa,0);
	        $this->Ln();
	        $this->SetFont('Arial','B',8);
	        $this->Cell(32);
	        $this->cell(50,7,"ABONO N int: ".$movi,0);
	        $this->Ln();
	        $this->cell(50,7,"Fecha: ".date("d-m-y H:i:s"),0);
	        $this->Ln();
	        $this->cell(50,7,"Atendido por: ".utf8_decode($nombremesero),0);
	        $this->Ln();
	        if($rutcli != ""){
	          $this->cell(50,7,"Rut: ".$rutcli,0);
	          $this->Ln();
	          $this->cell(50,7,"Nombre: ".utf8_decode($nombrecli),0);
	          $this->Ln();  
	        }
	        if($nombre_socio != ""){
	          $this->cell(50,7,"Nombre Socio: ".utf8_decode($nombre_socio['nombre']),0);
	          $this->Ln();  
	        }
	        $this->SetFont('Arial','B',8);
	        $this->cell(100,7,utf8_decode("DESCRIPCIÓN") ." DEL CONSUMO: ",0);
	        $this->Ln();
	        $this->SetFont('Arial','B',8);
	        foreach ($ventas_detalles_temporal as $key => $venta_detalle) {

	          	$preparado = get_preparados_id($venta_detalle['preparado_id']);
		          $tamdescrip = strlen($preparado['PREPARADOS_NOMBRE']);
		          if($tamdescrip > 27){
		            $descrip1 = substr($preparado['PREPARADOS_NOMBRE'], 0, 26);
		            $descrip2 = substr($preparado['PREPARADOS_NOMBRE'], 26, $tamdescrip);
		            $this->Cell(100,5, $venta_detalle['cantidad']. " ".utf8_decode($descrip1));
		            $this->Ln();
		            $this->Cell(100,5, utf8_decode($descrip2). " = $".number_format($preparado['PREPARADOS_PRECIO'] * ($venta_detalle['cantidad']), 0, ',', '.'),0);
		            $this->Ln();
		          }
		          else{
		            $this->Cell(100,5,$venta_detalle['cantidad']." ".utf8_decode($preparado['PREPARADOS_NOMBRE']). " = $".number_format($preparado['PREPARADOS_PRECIO'] * ($venta_detalle['cantidad']), 0, ',', '.'),0);
		            $this->Ln();  
		          }
	          
	        }

	        $this->SetFont('Arial','B',10);
	        $this->Cell(100,8, "Total Sin Propina: $".number_format($total_temporal, 0, ',', '.'),0);
	        $this->Ln(); 
	        
	        $this->SetFont('Arial','B',12); 
	        $this->Cell(100,8, "Propina: $".number_format($propina, 0, ',', '.'),0);
	        $this->Ln();
	        $this->Cell(100,8, "Total:   $".number_format(($total_temporal + $propina), 0 ,',', '.'),0);
	        $this->Ln();
	        $this->Cell(100,8, "Pagado:   $".number_format(($montopagado), 0, ',', '.'),0);
	        $this->Ln();
	        $this->Cell(100,8, "Vuelto:   $".number_format(($vuelto), 0, ',', '.'),0);
	        $this->Ln();
	        $this->SetFont('Arial','B',10); 
	        $this->Cell(100,7, " Forma de pago: ".utf8_decode($fpago),0);
	        $this->Ln();
	        $this->cell(100,7,"_______________________________________",0);
	        $this->Ln();

	        $pie = get_pie_pagina_estado(0);
	        $this->SetFont('Arial','B',7);
	        $this->cell(50,7,$pie,0,0,'C');
	        $this->Ln();
       }
       //FIN TABLA TEMPORAÑ
 
    }
	//FIN GENERA TICKET PDF

	$venta = get_venta_id($vta_id);
	if(inserta_vta_pago(($total_temporal+$propina), date("Y-m-d"), date("H:i:s"), $vta_id, $forma_pago_id, $usuario_id, date("Y-m-d H:i:s"))){
		$vta_pago_id = mysql_insert_id();
		$mesero = get_usuario_id($venta['usuario_id']);
    	$nombre_mesero = $mesero['nombre']." ".$mesero['apellido'];
    	//ACTUALIZA NRO DE BOLETA
	    $boleta = 0;
	    if(($boleta_temporal != 0) && ($boleta_temporal != "")){
	      $boleta = $boleta_temporal;
	      inserta_boleta_acutal($vta_id, $boleta, $vta_pago_id);
	      actauliza_bol_actual($boleta);
	    }

		if($propina > 0){
	      inserta_venta_propina($vta_id, $propina, 0, $vta_pago_id);
	    }

		if($forma_pago_id == 3){
	      inserta_cta_cte(date("Y-m-d"), date("H:i:s"), ($total_temporal+$propina), $cliente_id, 1, $vta_id);
	      $cliente = get_cliente_id($cliente_id);
	      $nombrecli = $cliente['nombre'];
	      $rutcli = $cliente['rut'];
	      $correocli = $cliente['correo'];
	      // ENVIAR CORREO NOTIFICANDO DEUDA
	      include("../phpmailer/sendmail.php");
	      generar_correo_carga_cta_cte($nombrecli, $rutcli, $vta_id, ($total_temporal+$propina), date("H:i:s"), $nombre_mesero, $correocli, $vta_pago_id);
	    }
	    $venta_socio = get_vta_socio_id($vta_id);
	    if($venta_socio != ""){
	      $nombre_socio = get_nombre_socio($venta_socio);
	      inserta_compra_socio($vta_id, $venta_socio, 0, ($total_temporal+$propina));
	    }
	    else{
	    	$nombre_socio = "";
	    }

	    //CREAR VOUCHER TEMPORAL CON PRODUCTOS DE TABLE TEMPORAL
	    $mesa = get_mesa_by_id($mesa_id);
		$formapago = get_forma_pago_id($forma_pago_id);
		$pdf=new PDF();
		$nombrearchivo = $vta_id."-".$vta_pago_id.".pdf";
	    $ubicacion = "../../boletas/movimientos/".$nombrearchivo;
	    $pdf->AliasNbPages();
	    //Primera página
	    $pdf->AddPage();
	    $pdf->SetY(19);
	    $pdf->TablaSimpleTemporal($total_temporal, $propina, $mesa, $vta_id, $nombre_mesero, $formapago, $rutcli, $nombrecli, $montopagado, $nombre_socio, $vuelto);
	    $pdf->Output($ubicacion);
	    //FIN CREAR VOUCHER TEMPORAL CON PRODUCTOS DE TABLE TEMPORAL
	    return true;

	}
	else{
		return false;
	}	
	
	
}



function ingresa_nueva_forma_pago2($vta_id, $totalconprop, $mesa_id, $total, $monto_pagado, $propina, $forma_pago_id, $cliente_id, $usuario_id, $boleta){
	//GENERA TICKET PDF
	class PDF extends FPDF
    {
    //Cabecera de página
       function Header()
       {
        $this->SetFont('Arial','B',14);
        $this->Cell(50,15,'ayahuaska',0,0,'C');
        $this->Ln();

       }
       
       //Pie de página
       function Footer()
       {
        $this->SetY(-15);
        $this->SetFont('Arial','I',9);
        $this->Cell(0,10,'Pag '.$this->PageNo().'/{nb}',0,0,'C');
       }

       //Tabla simple
       function TablaSimple($total, $prop, $mesa, $movi, $nombremesero, $fpago, $rutcli, $nombrecli, $montopagado, $nombre_socio){
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
        $this->cell(50,7,"Atendido por: ".utf8_decode($nombremesero),0);
        $this->Ln();
        if($rutcli != ""){
          $this->cell(50,7,"Rut: ".$rutcli,0);
          $this->Ln();
          $this->cell(50,7,"Nombre: ".utf8_decode($nombrecli),0);
          $this->Ln();  
        }
        if($nombre_socio != ""){
          $this->cell(50,7,"Nombre Socio: ".utf8_decode($nombre_socio['nombre']),0);
          $this->Ln();  
        }
        $this->SetFont('Arial','B',8);
        $this->cell(100,7,utf8_decode("DESCRIPCIÓN") ." DEL CONSUMO: ",0);
        $this->Ln();
        $this->SetFont('Arial','B',8);
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
	            $this->Cell(100,5, $venta_detalle['cantidad']-$cantidad_temporal. " ".utf8_decode($descrip1));
	            $this->Ln();
	            $this->Cell(100,5, utf8_decode($descrip2). " = $".number_format($preparado['PREPARADOS_PRECIO'] * ($venta_detalle['cantidad']-$cantidad_temporal), 0, ',', '.'),0);
	            $this->Ln();
	          }
	          else{
	            $this->Cell(100,5,$venta_detalle['cantidad']-$cantidad_temporal." ".utf8_decode($preparado['PREPARADOS_NOMBRE']). " = $".number_format($preparado['PREPARADOS_PRECIO'] * ($venta_detalle['cantidad']-$cantidad_temporal), 0, ',', '.'),0);
	            $this->Ln();  
	          }
	       }
        }

        $this->SetFont('Arial','B',10);
        $this->Cell(100,8, "Total Sin Propina: $".number_format($total, 0, ',', '.'),0);
        $this->Ln(); 
        
        $this->SetFont('Arial','B',12); 
        $this->Cell(100,8, "Propina: $".number_format($prop, 0, ',', '.'),0);
        $this->Ln();
        $this->Cell(100,8, "Total:   $".number_format(($total + $prop), 0 ,',', '.'),0);
        $this->Ln();
        $this->Cell(100,8, "Pagado:   $".number_format(($montopagado), 0, ',', '.'),0);
        $this->Ln();
        $this->Cell(100,8, "Vuelto:   $".number_format(($montopagado - ($total + $prop)), 0, ',', '.'),0);
        $this->Ln();
        $this->SetFont('Arial','B',10); 
        $this->Cell(100,7, " Forma de pago: ".utf8_decode($fpago),0);
        $this->Ln();
        $this->cell(100,7,"_______________________________________",0);
        $this->Ln();

        $pie = get_pie_pagina_estado(0);
        $this->SetFont('Arial','B',7);
        $this->cell(50,7,utf8_decode($pie),0,0,'C');
        $this->Ln();
          
       }
       
       
    }
	//FIN GENERA TICKET PDF

	$venta = get_venta_id($vta_id);
	if(inserta_vta_pago(($totalconprop), date("Y-m-d"), date("H:i:s"), $vta_id, $forma_pago_id, $usuario_id, date("Y-m-d H:i:s"))){
		$vta_pago_id = mysql_insert_id();
		$mesero = get_usuario_id($venta['usuario_id']);
    	$nombre_mesero = $mesero['nombre']." ".$mesero['apellido'];
    	//SI SE PAGA EL TOTAL DE LA MESA

		actualiza_mesa($mesa_id, 0);
		cierra_mesa_venta($vta_id);
		actualiza_boleta_venta($vta_id, $boleta);
	     
	    
	    //ACTUALIZA NRO DE BOLETA

	    if(($boleta != 0) && ($boleta != "")){
	      inserta_boleta_acutal($vta_id, $boleta, $vta_pago_id);
	      actauliza_bol_actual($boleta);
	    }
	    if($propina > 0){
	      inserta_venta_propina($vta_id, $propina, 0, $vta_pago_id);
	    }
	    if($forma_pago_id == 3){
	      inserta_cta_cte(date("Y-m-d"), date("H:i:s"), ($totalconprop), $cliente_id, 1, $vta_id);
	      $cliente = get_cliente_id($cliente_id);
	      $nombrecli = $cliente['nombre'];
	      $rutcli = $cliente['rut'];
	      $correocli = $cliente['correo'];
	      // ENVIAR CORREO NOTIFICANDO DEUDA
	      //include("../phpmailer/sendmail.php");
	      generar_correo_carga_cta_cte($nombrecli, $rutcli, $vta_id, ($totalconprop), date("H:i:s"), $nombre_mesero, $correocli, $vta_pago_id);
	    }
	    $venta_socio = get_vta_socio_id($vta_id);
	    if($venta_socio != ""){
	      $nombre_socio = get_nombre_socio($venta_socio);
	      inserta_compra_socio($vta_id, $venta_socio, 0, ($totalconprop));
	    }
	    else{
	    	$nombre_socio = "";
	    }
	    valida_stock_critico($vta_id);
		
		$mesa = get_mesa_by_id($mesa_id);
		$formapago = get_forma_pago_id($forma_pago_id);


		//NUEVO
		$ventas_detalles = get_ventas_detalles_id($vta_id);
		foreach ($ventas_detalles as $key => $detalle) {
			$preparado = get_preparados_id($detalle['preparado_id']);

			$cantidad_temporal = get_cantidad_venta_temporal($vta_id, $detalle['preparado_id'], 0, $detalle['npedido']);
	        if($cantidad_temporal == ""){
	        	$cantidad_temporal = 0;
	        }

			$total = $total + ($preparado['PREPARADOS_PRECIO'] * ($detalle['cantidad']-$cantidad_temporal));
			$cantidad = $detalle['cantidad']-$cantidad_temporal;
	    	$det[] = array('NmbItem' => utf8_decode($preparado['PREPARADOS_NOMBRE']), 'QtyItem' => $cantidad, 'PrcItem' => ($preparado['PREPARADOS_PRECIO'] * ($detalle['cantidad']-$cantidad_temporal)));
		}

		$emisor = "";
		$boleta = [
		    [   
		        'Encabezado' => [
		            'IdDoc' => [
		                'TipoDTE' => 39,
		                'Folio' => 1,
		            ],
		            'Emisor' => $emisor,
		            'Receptor' => [
		                'RUTRecep' => '66666666-6',
		                'RznSocRecep' => 'Sin RUT',
		                'GiroRecep' => 'Particular',
		                'DirRecep' => 'Ovalle',
		                'CmnaRecep' => 'Ovalle',
		            ],
		        ],
		        'Detalle' => 
		            $det
		        
		    ],
		];
		return true;
		//print_r($boleta);



	 //    $pdf=new PDF();
		// $nombrearchivo = $vta_id."-".$vta_pago_id.".pdf";
	 //    $ubicacion = "../../boletas/movimientos/".$nombrearchivo;
	 //    $pdf->AliasNbPages();
	 //    //Primera página
	 //    $pdf->AddPage();
	 //    $pdf->SetY(19);
	 //    $pdf->TablaSimple($total, $propina, $mesa, $vta_id, $nombre_mesero, $formapago, $rutcli, $nombrecli, $monto_pagado, $nombre_socio);
	 //    $pdf->Output($ubicacion);

	 //    $usuario = get_usuario_id($usuario_id);
	 //    $impresora = get_impresora_url($usuario['impresora_id']);
	 //    if(($impresora == "BARRA1") || ($impresora == "CAJACIELO")){
	 //    	$salida = shell_exec("lpr -P CAJACIELO ".$ubicacion."");
	 //    }
	 //    else{
	 //    	 $salida = shell_exec("lpr -P ".$impresora." ".$ubicacion."");  
	 //    }
	 //    return true;
	}
	else{
		return false;
	}
	
}








if(isset($_GET['elimina_sobrantes'])){
    $sql = "select * from ayahuaska.producto 
	    left join ayahuaska.familias 
	    on (producto.FAMILIA_ID = familias.id)
	    where familias.id is null";
    $res = mysql_query($sql);
    while($dat = mysql_fetch_array($res)){
      $sqlst = "delete from stock where PRODUCTO_ID =".$dat['PRODUCTO_ID']."";
      mysql_query($sqlst);
      $sqlstcomp = "delete from stock_compras where PRODUCTO_ID = ".$dat['PRODUCTO_ID']."";
      mysql_query($sqlstcomp);
      echo "ELIMINANDO: ".$dat['PRODUCTO_NOMBRE']."<br>";
      $sq = "delete from ayahuaska.producto where PRODUCTO_ID = ".$dat['PRODUCTO_ID']."";
      mysql_query($sq);
    }
}


function fecha_bd_normal($fecha)
{

    $anho=substr($fecha,0,4);
    $mes=substr($fecha,5,2);
    $dia=substr($fecha,8,2);

    return $dia."-".$mes."-".$anho;
}

function get_familia($familia){
	$sql = "select nombre from ayahuaska.familias where id=".$familia."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['nombre'];
}

function get_familia_datos($id){
	$sql = "select * from ayahuaska.familias where id=".$id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat;
}

function get_all_familias(){
	$familias = null;
	$sql = "select * from ayahuaska.familias order by nombre asc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$familias[] = array('id' => $dat['id'], 'nombre' => $dat['nombre']);
		}
	}
	return $familias;
}

function ingresa_nueva_familia($nombre){
	$sql = "insert into ayahuaska.familias (nombre) values ('".$nombre."')";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function elimina_familia($id){
	$sql = "delete from ayahuaska.familias where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function actualiza_familia($nombre, $id){
	$sql = "update ayahuaska.familias set nombre = '".$nombre."' where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function get_nombre_tipo_descuento($id){
	$sql = "select TIPO_DESCUENTO_NOMBRE from ayahuaska.tipo_descuento where TIPO_DESCUENTO_ID = ".$id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['TIPO_DESCUENTO_NOMBRE'];
}

function get_tipos_descuentos()
{
  $tipo_descuento = null;
  $sql = "select * from ayahuaska.tipo_descuento";
  $res = mysql_query($sql);
  $tot=mysql_num_rows($res);
  if ($tot!=0) {
    while ($dat=mysql_fetch_array($res)) {
      $tipo_descuento[] = array('id' => $dat['TIPO_DESCUENTO_ID'],
                           'nombre' => $dat['TIPO_DESCUENTO_NOMBRE']
                         );
    }
  }
  return $tipo_descuento;
}


function get_forma_descuento_id($nombre){
	$sql = "select TIPO_DESCUENTO_ID from ayahuaska.tipo_descuento where TIPO_DESCUENTO_NOMBRE = '".$nombre."'";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['TIPO_DESCUENTO_ID'];
}

function inserta_producto($nombre, $forma_comercio, $cantinicial, $tipo_descuento, $capacidad, $stock_minimo, $familia, $costo){
	$sql = "insert into ayahuaska.producto (PRODUCTO_NOMBRE, PRODUCTO_FORMADECOMERCIO, PRODUCTO_UNIDADESINICIAL
				, TIPO_DESCUENTO_ID, PRODUCTO_CAPACIDADPORUNIDAD, FAMILIA_ID, PRODUCTO_STOCKMINIMO, PRODUCTO_COSTO)
		values ('".$_POST['nombreproducto']."', ".$_POST['forma_comercializa'].", '".$_POST['cantinicial']."',
				".$_POST['forma_descuento'].", 1, ".$familia.", ".$_POST['stock_minimo'].", ".$costo.")";
	if($res = mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}
function get_productos(){
	$productos = null;
  	$sql = "select * from ayahuaska.producto order by PRODUCTO_NOMBRE asc";
  	$res = mysql_query($sql);
  	$tot = mysql_num_rows($res);
  	if($tot > 0){
  		while ($dat = mysql_fetch_array($res)) {
        $familia = get_familiaById($dat['FAMILIA_ID']);
        $stockUnidad = stockUnidadBy_idProducto($dat['PRODUCTO_ID']);
        $stockMedida = stockTipoBy_idProducto($dat['PRODUCTO_ID']);
  			$productos[] = array(
  								'id' => $dat['PRODUCTO_ID'],
  								'nombre' => $dat['PRODUCTO_NOMBRE'],
                  'nombreFamilia' => $familia[0]['nombre'],
  								'unidadinicial' => $dat['PRODUCTO_UNIDADESINICIAL'],
  								'tipo_descuento' => $dat['TIPO_DESCUENTO_ID'],
  								'capacidad' => $dat['PRODUCTO_CAPACIDADPORUNIDAD'],
  								'stockPorUnitdad' => $stockUnidad,
  								'stockPorTipo' => $stockMedida,
  								'stock_minimo' => $dat['PRODUCTO_STOCKMINIMO']);
  		}
  	}

  	return $productos;
}

function get_productos_by_tipo_descuento($tipo_descuento){
	$productos = null;
  	$sql = "select * from ayahuaska.producto where TIPO_DESCUENTO_ID = ".$tipo_descuento." 
  			order by PRODUCTO_NOMBRE asc";
  	$res = mysql_query($sql);
  	$tot = mysql_num_rows($res);
  	if($tot > 0){
  		while ($dat = mysql_fetch_array($res)) {
        $familia = get_familiaById($dat['FAMILIA_ID']);
        $stockUnidad = stockUnidadBy_idProducto($dat['PRODUCTO_ID']);
        $stockMedida = stockTipoBy_idProducto($dat['PRODUCTO_ID']);
  			$productos[] = array(
  								'id' => $dat['PRODUCTO_ID'],
  								'nombre' => $dat['PRODUCTO_NOMBRE'],
                  'nombreFamilia' => $familia[0]['nombre'],
  								'unidadinicial' => $dat['PRODUCTO_UNIDADESINICIAL'],
  								'tipo_descuento' => $dat['TIPO_DESCUENTO_ID'],
  								'capacidad' => $dat['PRODUCTO_CAPACIDADPORUNIDAD'],
  								'stockPorUnitdad' => $stockUnidad,
  								'stockPorTipo' => $stockMedida,
  								'stock_minimo' => $dat['PRODUCTO_STOCKMINIMO']);
  		}
  	}

  	return $productos;
}

function get_familiaById($idFamilia)
  {
    $familia = null;
  	$sql = "select * from ayahuaska.familias WHERE id={$idFamilia}";
  	$res = mysql_query($sql);
  	$tot = mysql_num_rows($res);
  	if($tot > 0){
  		while ($dat = mysql_fetch_array($res)) {
  			$familia[] = array(
  								'id' => $dat['id'],
  								'nombre' => $dat['nombre']
                );
  		}
  	}

  	return $familia;
  }

function get_producto($id){
	$sql = "select * from ayahuaska.producto where PRODUCTO_ID =".$id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat;
}

function get_costo_asociado($cantidad_descontada, $costo_producto, $capacidad){
	$costo = ($costo_producto * $cantidad_descontada) / $capacidad;
	//echo "cost prod->".$costo_producto.", canti->".$cantidad_descontada.", cap->".$capacidad."<br>";
	return $costo;
}

function get_id_producto_by_nombre($producto_nombre){
	$sql = "select PRODUCTO_ID from ayahuaska.producto where PRODUCTO_NOMBRE = '".$producto_nombre."' ";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['PRODUCTO_ID'];
}

function get_id_producto_by_id($id){
	$sql = "select * from ayahuaska.producto where PRODUCTO_ID = ".$id." ";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat;
}


function get_producto_familia($familia){
	$productos = null;
	$sql = "select * from ayahuaska.producto where FAMILIA_ID =".$familia."";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while ($dat = mysql_fetch_array($res)) {
			$productos[] = array('id' => $dat['PRODUCTO_ID'], 'nombre' => $dat['PRODUCTO_NOMBRE'],
								'unidadinicial' => $dat['PRODUCTO_UNIDADESINICIAL'],
								'tipo_descuento' => $dat['TIPO_DESCUENTO_ID'],
								'capacidad' => $dat['PRODUCTO_CAPACIDADPORUNIDAD'],
								'stock_minimo' => $dat['PRODUCTO_STOCKMINIMO'],
								'costo' => $dat['PRODUCTO_COSTO']);
		}
	}

	return $productos;
}





function actualiza_producto($nombre, $forma_comercio, $cantinicial, $tipo_descuento, $capacidad, $stock_minimo, $familia, $id, $costo){
	$sql = "update ayahuaska.producto set PRODUCTO_NOMBRE = '".$nombre."', PRODUCTO_FORMADECOMERCIO = ".$forma_comercio.",
			PRODUCTO_UNIDADESINICIAL = ".$cantinicial.", TIPO_DESCUENTO_ID = ".$tipo_descuento.",
			PRODUCTO_CAPACIDADPORUNIDAD = ".$capacidad.", PRODUCTO_STOCKMINIMO=".$stock_minimo.", FAMILIA_ID = ".$familia.", PRODUCTO_COSTO = ".$costo." where PRODUCTO_ID = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function elimina_producto($id){
	$sql1 = "delete from ayahuaska.stock where PRODUCTO_ID = ".$id."";
	mysql_query($sql1);
	$sql2 = "delete from ayahuaska.stock_compras where PRODUCTO_ID = ".$id."";
	mysql_query($sql2);
	$sql = "delete from ayahuaska.producto where PRODUCTO_ID = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function get_all_preparados(){
	$preparados = null ;
	$sql = "select * from ayahuaska.preparados order by PREPARADOS_NOMBRE ASC";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while ($dat = mysql_fetch_array($res)) {
			$preparados[] = array('id' => $dat['PREPARADOS_ID'], 'nombre' => $dat['PREPARADOS_NOMBRE'],
							'familia' => $dat['PREPARADOS_FAMILIA'], 'precio' => $dat['PREPARADOS_PRECIO']);
		}
	}
	return $preparados;
}

function get_preparados_familia($familia){
	$preparados = null ;
	$sql = "select * from ayahuaska.preparados where PREPARADOS_FAMILIA = ".$familia."";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while ($dat = mysql_fetch_array($res)) {
			$preparados[] = array('id' => $dat['PREPARADOS_ID'], 'nombre' => $dat['PREPARADOS_NOMBRE'],
							'familia' => $dat['PREPARADOS_FAMILIA'], 'precio' => $dat['PREPARADOS_PRECIO']);
		}
	}
	return $preparados;
}

function get_preparados_id($id){
	$sql = "select * from ayahuaska.preparados where PREPARADOS_ID = ".$id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat;
}

function get_preparado_nombre($nombre){
	$sql = "select PREPARADOS_ID from ayahuaska.preparados where PREPARADOS_NOMBRE = '".$nombre."'";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['PREPARADOS_ID'];
}


function inserta_producto_preparado($nombre, $precio, $familia, $es_happy, $es_cocina){
	$sql = "insert into ayahuaska.preparados (PREPARADOS_NOMBRE, PREPARADOS_FECHA, PREPARADOS_FAMILIA, PREPARADOS_PRECIO, es_happy, es_cocina)
			values ('".$nombre."', '".date("Y-m-d")."', ".$familia.", ".$precio.", ".$es_happy.", ".$es_cocina.")";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function actualiza_producto_preparado($nombre, $precio, $id, $es_happy, $es_cocina, $familia, $categoria_id){
	$sql = "update ayahuaska.preparados set PREPARADOS_NOMBRE = '".$nombre."', PREPARADOS_FAMILIA = ".$familia.", PREPARADOS_PRECIO = ".$precio.", es_happy = ".$es_happy.", es_cocina = ".$es_cocina.", categoria_id=".$categoria_id."
			 where PREPARADOS_ID = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function elimina_producto_preparado($id){
	$sql = "delete from ayahuaska.preparados where PREPARADOS_ID = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function inserta_descuento_producto_preparado($id_preparado, $id_producto, $cantidad){
	$sql = "insert into ayahuaska.producto_preparados (PRODUCTO_ID, PREPARADOS_ID, PRODUCTO_PREPARADOS_CANTIDADESCUENTO)
			values (".$id_producto.", ".$id_preparado.", ".$cantidad.")";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function get_producto_preparados_id_prep($id){
	$producto_preparados = null;
	$sql = "select * from ayahuaska.producto_preparados where PREPARADOS_ID = ".$id."";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$producto_preparados[] = array('producto_id' => $dat['PRODUCTO_ID'],
									'cantidad' => $dat['PRODUCTO_PREPARADOS_CANTIDADESCUENTO']);
		}
	}
	return $producto_preparados;
}

function elimina_propudcto_preparado_dscto($producto_id, $preparado_id){
	$sql = "delete from ayahuaska.producto_preparados where PRODUCTO_ID=".$producto_id." and PREPARADOS_ID = ".$preparado_id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}


// CONTROLADOR PROVEEDORES
function get_all_proveedores(){
	$proveedores = null;
	$sql = "select * from ayahuaska.proveedores order by nombre asc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$proveedores[] = array('id' => $dat['id'], 'rol' => $dat['rol'], 'nombre' => $dat['nombre'],
								'fono' => $dat['fono'], 'correo' => $dat['correo'], 'estado' => $dat['estado']);
		}
	}
	return $proveedores;
}

function get_proveedor_id($id){
	$sql = "select * from ayahuaska.proveedores where id=".$id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat;
}

function ingresa_nuevo_proveedor($rol, $nombre, $fono, $correo, $estado){
	$sql = "insert into ayahuaska.proveedores (rol, nombre, fono, correo, estado)
			values ('".$rol."', '".$nombre."', '".$fono."', '".$correo."', ".$estado.")";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function actualiza_proveedor($rol, $nombre, $fono, $correo, $id, $estado){
	$sql = "update ayahuaska.proveedores set rol = '".$rol."', nombre = '".$nombre."', fono = '".$fono."',
			correo = '".$correo."', estado = ".$estado." where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function elimina_proveedor($id){
	$sql = "delete from ayahuaska.proveedores where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

// FIN CONTROLADOR PROVEEDORES


// CONTROLADOR USUARIOS
function get_all_usuarios(){
	$usuarios = null;
	$sql = "select * from ayahuaska.usuarios order by id asc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$usuarios[] = array('id' => $dat['id'], 'nombre' => $dat['nombre'], 'apellido' => $dat['apellido'],
								'usuario' => $dat['usuario'], 'clave' => $dat['clave'],
								'correo' => $dat['correo'], 'tipo_usuario' => $dat['tipo_usuario_id'], 'fono' => $dat['fono']
								, 'impresora_id' => $dat['impresora_id'], 'estado' => $dat['estado']);
		}
	}
	return $usuarios;
}

function get_tipos_usuarios()
{
  $tipos_usuarios = null;
  $sql = "select * from ayahuaska.tipos_usuarios order by nombre asc";
  $res = mysql_query($sql);
  $tot=mysql_num_rows($res);
  if ($tot!=0) {
    while ($dat=mysql_fetch_array($res)) {
      $tipos_usuarios[] = array('id' => $dat['id'],
                           'nombre' => $dat['nombre']
                         );
    }
  }
  return $tipos_usuarios;
}

function get_tipo_usuario_nombre_id($id){
	$sql = "select nombre from ayahuaska.tipos_usuarios where id = ".$id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['nombre'];
}

function get_usuario_id($id){
	$sql = "select * from ayahuaska.usuarios where id = ".$id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat;
}

function ingresa_nuevo_usuario($nombre, $apellido, $usuario, $clave, $correo, $tipo_usuario, $fono, $estado){
	$sql = "insert into ayahuaska.usuarios (nombre, apellido, usuario, clave, correo, tipo_usuario_id, fono, estado)
			values ('".$nombre."', '".$apellido."', '".$usuario."', '".md5($clave)."', '".$correo."', ".$tipo_usuario.", '".$fono."',  ".$estado.")";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function actualiza_usuario($nombre, $apellido, $usuario, $correo, $tipo_usuario, $id, $fono, $estado){
	 $sql = "update ayahuaska.usuarios set nombre = '".$nombre."', apellido = '".$apellido."', usuario = '".$usuario."',
			 correo = '".$correo."', tipo_usuario_id = ".$tipo_usuario.", fono = '".$fono."', estado = ".$estado."
			where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function elimina_usuario($id){
	$sql = "delete from ayahuaska.usuarios where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}


function actualiza_usuario_clave($nueva_clave, $id){
	 $sql = "update ayahuaska.usuarios set clave = '".md5($nueva_clave)."' where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}
// FIN CONTROLADOR USUARIOS

// CONTROLADOR CLIENTES

function get_all_clientes(){
	$clientes = null;
	$sql = "select * from ayahuaska.clientes order by id asc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$clientes[] = array('id' => $dat['id'], 'rut' =>$dat['rut'], 'nombre' => $dat['nombre'], 'direccion' => $dat['direccion'],
								'ciudad' => $dat['ciudad'], 'telefono' => $dat['telefono'],
								'correo' => $dat['correo'], 'cupo' => $dat['cupo']);
		}
	}
	return $clientes;
}

function get_cliente_id($id){
	$sql = "select * from ayahuaska.clientes where id = ".$id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat;
}

function get_all_abonos(){
	$abonos = null;
	$sql = "select * from ayahuaska.clientes_abonos order by id desc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$abonos[] = array('id' => $dat['id'], 'nume' =>$dat['nume'], 'fecha' => $dat['fecha'], 'glosa' => $dat['glosa'],
								'abono' => $dat['abono'], 'cliente_id' => $dat['cliente_id']);
		}
	}
	return $abonos;
}

function get_cta_cte_cliente($cliente_id, $tipo){
	$abonos = null;
	$sql = "select * from ayahuaska.cliente_cta_cte where cliente_id = ".$cliente_id." and tipo_abono = ".$tipo."";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$abonos[] = array('id' => $dat['id'], 'cliente_id' =>$dat['cliente_id'], 'fecha' => $dat['fecha'],
							'hora' => $dat['hora'], 'monto' => $dat['monto'], 'venta_id' => $dat['venta_id']);
		}
	}
	return $abonos;
}

function get_monto_adeudado($id){
	// TIPO ABONO 1 = DEUDA
	$debe = 0;
	$abono = 0;
	$sqld = "select SUM(monto) as DEBE from ayahuaska.cliente_cta_cte where cliente_id = ".$id." and tipo_abono = 1";
	$resd = mysql_query($sqld);
	$totd = mysql_num_rows($resd);
	if($totd > 0){
		$datd = mysql_fetch_array($resd);
		$debe = $datd['DEBE'];
	}
	else{
		$debe = 0;
	}

	$sqla = "select SUM(monto) as HABER from ayahuaska.cliente_cta_cte where cliente_id = ".$id." and tipo_abono = 2";
	$resa = mysql_query($sqla);
	$tota = mysql_num_rows($resa);
	if($tota > 0){
		$data = mysql_fetch_array($resa);
		$abono = $data['HABER'];
	}
	else{
		$abono = 0;
	}

	$monto = $debe - $abono;

	return $monto;
}

function get_max_num_cliente_abono($id){
	$num = 1;
	$sql = "select MAX(num) as maxnum from ayahuaska.clientes_abonos where cliente_id = ".$id."";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		$dat = mysql_fetch_array($res);
		$num = $dat['maxnum'];
	}
	return $num;
}

function ingresa_nuevo_cliente($rut, $nombre, $direccion, $ciudad, $telefono, $correo, $cupo){
	$sql = "insert into ayahuaska.clientes (rut, nombre, direccion, ciudad, telefono, correo, cupo)
			values ('".$rut."', '".$nombre."', '".$direccion."', '".$ciudad."', '".$telefono."', '".$correo."', ".$cupo.")";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function actualiza_cliente($rut, $nombre, $direccion, $ciudad, $telefono, $correo, $cupo, $id){
	$sql = "update ayahuaska.clientes set rut = '".$rut."', nombre = '".$nombre."', direccion = '".$direccion."',
			ciudad = '".$ciudad."', telefono = '".$telefono."', correo = '".$correo."', cupo = ".$cupo."
			where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function elimina_cliente($id){
	$sql = "delete from ayahuaska.clientes where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function inserta_cliente_abono($num, $fecha, $glosa, $abono, $cliente, $venta_id){
	$sql = "insert into ayahuaska.clientes_abonos(nume, fecha, glosa, abono, cliente_id, venta_id)
			values (".$num.", '".$fecha."', '".$glosa."', ".$abono.", ".$cliente.", ".$venta_id.")";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function inserta_cta_cte($fecha, $hora, $monto, $cliente, $tipo, $venta_id){
	$sql = "insert into ayahuaska.cliente_cta_cte(fecha, hora, monto, cliente_id, tipo_abono, venta_id)
			values ('".$fecha."', '".$hora."', ".$monto.", ".$cliente.", ".$tipo.", ".$venta_id.")";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function get_detalle_compras_cliente($cliente){
	$compras = null;
	$sql = "select * from ayahuaska.ventas_pagos inner join cliente_cta_cte
			on (ventas_pagos.venta_id = cliente_cta_cte.venta_id)
			where cliente_cta_cte.cliente_id = ".$cliente." and ventas_pagos.forma_pago_id = 3";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$compras[] = array('id' => $dat['id'], 'cliente_id' =>$dat['cliente_id'], 'venta_id' => $dat['venta_id'],
							'usuario_id' => $dat['usuario_id'], 'forma_pago_id' => $dat['forma_pago_id'],
							'fecha' => $dat['fecha'], 'hora' => $dat['hora'], 'monto' => $dat['monto']);
		}
	}
	return $compras;

}


// FIN CONTROLADOR CLIENTES

// CONTROLADOR DE SOCIOS

function get_all_socios(){
	$socios = null;
	$sql = "select * from ayahuaska.socios order by nombre asc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$socios[] = array('id' => $dat['id'], 'rut' =>$dat['rut'], 'nombre' => $dat['nombre'],
							'telefono' => $dat['telefono'], 'correo' => $dat['correo'],
							'direccion' => $dat['direccion']);
		}
	}
	return $socios;

}

function get_socio_id_rut($rut){
	$sql = "select id from ayahuaska.socios where rut = '".$rut."'";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['id'];
}

function get_socio_id_nombre($nombre){
	$sql = "select id from ayahuaska.socios where nombre = '".$nombre."'";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['id'];
}

function get_socio_id($id){
	$sql = "select * from ayahuaska.socios where id = ".$id." ";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat;
}

function get_nombre_socio($id){
	$sql = "select nombre from ayahuaska.socios where id = ".$id." ";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat;
}

function inserta_socio($rut, $nombre, $telefono){
	$sql = "insert into ayahuaska.socios (rut, nombre, telefono)
			values ('".$rut."', '".$nombre."', '".$telefono."')";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function actualiza_socio($rut, $nombre, $telefono, $id){
	$sql = "update ayahuaska.socios set rut = '".$rut."', nombre = '".$nombre."', telefono = '".$telefono."' where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function elimina_socio($id){
	$sql = "delete from ayahuaska.socios where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function inserta_compra_socio($venta_id, $socio_id, $estado, $monto){
	$sql = "insert into ayahuaska.compras_socios (monto, estado, venta_id, socio_id)
			values (".$monto.", ".$estado.", ".$venta_id.", ".$socio_id.")";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}

}
// FIN CONTROLADOR DE SOCIOS

// CONTRALADOR DE VENTAS

function get_count_vta_detalle($vta_id){
	$sql = "select * from ayahuaska.ventas_detalles where venta_id = ".$vta_id."";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		return $tot;
	}
	else{
		return 0;
	}
}

function get_ventas_detalles_id_pedido($vta_id, $npedido){
	$vtas_detalles = null;
	$sql = "select * from ayahuaska.ventas_detalles where venta_id = ".$vta_id." and npedido = ".$npedido."";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$vtas_detalles[] = array('id' => $dat['id'], 'cantidad' =>$dat['cantidad'], 'npedido' => $dat['npedido'],
								'observacion' => $dat['observacion'],
								'preparado_id' => $dat['preparado_id'],
								'fecha' => $dat['fecha'],
								'hora' => $dat['hora'],
								'venta_id' => $dat['venta_id']);
		}
	}
	return $vtas_detalles;
}


function get_ventas_detalles_id($venta_id){
	$vtas_detalles = null;
	$sql = "select * from ayahuaska.ventas_detalles where venta_id = ".$venta_id."";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$vtas_detalles[] = array('id' => $dat['id'], 'cantidad' =>$dat['cantidad'], 'npedido' => $dat['npedido'],
								'observacion' => $dat['observacion'],
								'preparado_id' => $dat['preparado_id'],
								'fecha' => $dat['fecha'],
								'hora' => $dat['hora'],
								'venta_id' => $dat['venta_id']);
		}
	}
	return $vtas_detalles;
}

function get_ventas_detalle_byId($idVentaDetalles)
{
	$vtas_detalles=null;
	$query="select * from ayahuaska.ventas_detalles WHERE id = {$idVentaDetalles}";
	$result=mysql_query($query);
	$tot=mysql_num_rows($result);
	if ($tot!=0) {
	  while ($dat=mysql_fetch_array($result)) {
			$vtas_detalles[] = array(
				'id' => $dat['id'],
				'cantidad' =>$dat['cantidad'],
				'npedido' => $dat['npedido'],
				'observacion' => $dat['observacion'],
				'preparado_id' => $dat['preparado_id'],
				'venta_id' => $dat['venta_id']);
	  }
	}
	return $vtas_detalles;
}

function get_max_npedido_venta_detalle($venta_id){
	$sql = "select max(npedido) as maxpedido from ayahuaska.ventas_detalles where venta_id = ".$venta_id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['maxpedido'];
}


function get_ventas_estado($estado){
	$ventas=null;
	$query="select * from ayahuaska.ventas where estado = ".$estado." order by id desc";
	$result=mysql_query($query);
	$tot=mysql_num_rows($result);
	if ($tot!=0) {
	  while ($dat=mysql_fetch_array($result)) {
			$ventas[] = array(
				'id' => $dat['id'],
				'fecha' =>$dat['fecha'],
				'hora' => $dat['hora'],
				'estado' => $dat['estado'],
				'mesa_id' => $dat['mesa_id'],
				'usuario_id' => $dat['usuario_id']);
	  }
	}
	return $ventas;
}

function get_all_ventas(){
	$ventas=null;
	$query="select * from ayahuaska.ventas order by fecha desc";
	$result=mysql_query($query);
	$tot=mysql_num_rows($result);
	if ($tot!=0) {
	  while ($dat=mysql_fetch_array($result)) {
			$ventas[] = array(
				'id' => $dat['id'],
				'fecha' =>$dat['fecha'],
				'hora' => $dat['hora'],
				'estado' => $dat['estado'],
				'mesa_id' => $dat['mesa_id'],
				'usuario_id' => $dat['usuario_id']);
	  }
	}
	return $ventas;
}

function get_ventas_usuario_estado($usuario_id, $estado){
	$ventas=null;
	$query="select * from ayahuaska.ventas where estado = ".$estado." and usuario_id = ".$usuario_id."";
	$result=mysql_query($query);
	$tot=mysql_num_rows($result);
	if ($tot!=0) {
	  while ($dat=mysql_fetch_array($result)) {
			$ventas[] = array(
				'id' => $dat['id'],
				'fecha' =>$dat['fecha'],
				'hora' => $dat['hora'],
				'estado' => $dat['estado'],
				'mesa_id' => $dat['mesa_id'],
				'usuario_id' => $dat['usuario_id']);
	  }
	}
	return $ventas;
}

function get_venta_id($id){
	$sql = "select * from ayahuaska.ventas where id = ".$id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat;
}

function get_venta_mesa_id($id){
	$sql = "select mesa_id from ayahuaska.ventas where id = ".$id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['mesa_id'];
}

function get_venta_by_mesa_estado($mesa_id, $estado){
	$sql = "select * from ayahuaska.ventas where mesa_id = ".$mesa_id." and estado = ".$estado."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat;
}

function get_descuento_venta($venta_id){
	$sql = "select monto from ayahuaska.descuentos_ventas where venta_id = ".$venta_id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['monto'];
}

function get_all_descuentos(){
	$descuentos=null;
	$sql = "select * from ayahuaska.descuentos_ventas order by id desc";
	$res=mysql_query($sql);
	$tot=mysql_num_rows($res);
	if ($tot!=0) {
	  	while ($dat=mysql_fetch_array($res)) {
			$descuentos[] = array(
				'id' => $dat['id'],
				'fecha' =>$dat['fecha'],
				'hora' => $dat['hora'],
				'monto' => $dat['monto'],
				'venta_id' => $dat['venta_id'],
				'usuario_id' => $dat['usuario_id']);
	  	}
	}
	return $descuentos;
}



function inserta_descuento_venta($venta_id, $monto, $usuario_id){
	$sql = "insert into ayahuaska.descuentos_ventas (monto, fecha, hora, venta_id, usuario_id)
			values (".$monto.", '".date('Y-m-d')."', '".date('H:i:s')."', ".$venta_id.", ".$usuario_id.")";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function inserta_preparados_happy($venta_id, $preparado_id, $cantidad, $venta_detalle_id){
	$sql = "insert into ayahuaska.preparados_happy (cantidad, estado, fecha, hora, venta_id, preparado_id, venta_detalle_id)
			values (".$cantidad.", 0, '".date('Y-m-d')."', '".date('H:i:s')."', ".$venta_id.", ".$preparado_id.", ".$venta_detalle_id.")";

	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function actualiza_preparados_happy($venta_id_nueva, $venta_id_antigua){
	$sql = "update ayahuaska.preparados_happy set venta_id = ".$venta_id_nueva." where venta_id = ".$venta_id_antigua."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function actualiza_preparados_happy_cantidad($venta_id, $cantidad){
	$sql = "update ayahuaska.preparados_happy set cantidad = ".$cantidad." where venta_id = ".$venta_id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function get_cant_happy($venta_id, $estado){
	$sql = "select * from ayahuaska.preparados_happy where venta_id = ".$venta_id." and estado = ".$estado."";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		$dat = mysql_fetch_array($res);
		return $dat['cantidad'];
	}
	else{
		return 0;
	}
}

function get_cant_happy_producto($venta_id, $preparado_id){
    $sql = "select * from ayahuaska.preparados_happy where venta_id = ".$venta_id." and preparado_id = ".$preparado_id."";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		return $tot;
	}
	else{
		return 0;
	}
}

function get_happy_preparados($venta_id, $estado){
	$preparados_happy = null;
	$sql = "select * from ayahuaska.preparados_happy where venta_id = ".$venta_id." and estado = ".$estado."";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if ($tot > 0) {
	  	while ($dat=mysql_fetch_array($res)) {
			$preparados_happy[] = array(
				'id' => $dat['id'],
				'cantidad' =>$dat['cantidad'],
				'estado' => $dat['estado'],
				'fecha' => $dat['fecha'],
				'hora' => $dat['hora'],
				'venta_id' => $dat['venta_id'],
				'preparado_id' => $dat['preparado_id'],
				'venta_detalle_id' => $dat['venta_detalle_id']);
	  	}
	}
	return $preparados_happy;
}


function actualiza_estado_preparado_happy($venta_id, $estado, $preparado_id){
	$sql = "update ayahuaska.preparados_happy set estado = 1 where venta_id = ".$venta_id." and 
			preparado_id = ".$preparado_id." and estado = 0";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function elimina_preparados_happy($venta_id, $preparado_id){
	$sql = "delete from ayahuaska.preparados_happy where venta_id = ".$venta_id." and preparado_id = ".$preparado_id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function elimina_preparados_happy_by_id($venta_id){
	$sql = "delete from ayahuaska.preparados_happy where venta_id = ".$venta_id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function inserta_vta($fecha, $hora, $estado, $mesa, $usuario, $fecha_full, $turno, $comensales){
	$sql = "insert into ayahuaska.ventas(fecha, hora, estado, mesa_id, usuario_id, fecha_full, turno, comensales)
			values ('".$fecha."', '".$hora."', ".$estado.", ".$mesa.", ".$usuario.", '".$fecha_full."', ".$turno.", ".$comensales.")";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function inserta_venta_detalle($cantidad, $npedido, $observacion, $preparado_id, $vta_id, $fecha, $hora){
	$sqle = "select cantidad from ayahuaska.ventas_detalles where venta_id = ".$vta_id." and preparado_id=".$preparado_id."
			and npedido = ".$npedido."";
	$rese = mysql_query($sqle);
	$tote = mysql_num_rows($rese);
	if($tote > 0){
		$date = mysql_fetch_array($rese);
		$totnueva = $cantidad + $date['cantidad'];
		$sql = "update ayahuaska.ventas_detalles set cantidad = ".$totnueva." where venta_id = ".$vta_id." and preparado_id=".$preparado_id."
			and npedido = ".$npedido."";
		if(mysql_query($sql)){
			return true;
		}
		else{
			return false;
		}	
	}
	else{
		echo $sql = "insert into ayahuaska.ventas_detalles(cantidad, npedido, observacion, estado, fecha, hora, preparado_id, venta_id)
			values (".$cantidad.", ".$npedido.", '".$observacion."', 0, '".$fecha."', '".$hora."', 
					".$preparado_id.", ".$vta_id.")";

		if(mysql_query($sql)){
			return true;
		}
		else{
			return false;
		}
	}
}

function get_venta_detalle($venta_id, $preparado_id, $npedido){
	$sql = "select * from ayahuaska.ventas_detalles where venta_id = ".$venta_id."
			and preparado_id = ".$preparado_id." and npedido = ".$npedido."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat;
}

function elimina_vta_detalle_id($id){
	$sql = "delete from ayahuaska.ventas_detalles where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function actualiza_ventas_detalles_preparados($venta_id, $preparado_id, $npedido, $nueva_venta_id){
	$sql = "update ayahuaska.ventas_detalles set venta_id = ".$nueva_venta_id." where venta_id = ".$venta_id."
			and preparado_id = ".$preparado_id." and npedido = ".$npedido."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function actualiza_ventas_detalles_preparados_npedido($venta_id, $preparado_id, $npedido, $nueva_venta_id, $max_npedido){
	$sql = "update ayahuaska.ventas_detalles set venta_id = ".$nueva_venta_id.", npedido = ".$max_npedido."
			where venta_id = ".$venta_id." and preparado_id = ".$preparado_id." and npedido = ".$npedido."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function actualiza_ventas_detalles_cantitdades($venta_id, $preparado_id, $npedido, $cantidad){
	$sql = "update ayahuaska.ventas_detalles set cantidad = ".$cantidad." where venta_id = ".$venta_id."
			and preparado_id = ".$preparado_id." and npedido = ".$npedido."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function actualiza_ventas_detalles_all($venta_id, $nueva_venta_id, $max_npedido){
	$sql = "update ayahuaska.ventas_detalles set venta_id = ".$nueva_venta_id.", npedido = ".$max_npedido."
			where venta_id = ".$venta_id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function obtiene_total_venta($vta_id){
	$total = 0;
	$ventas_detalles = get_ventas_detalles_id($vta_id);
	foreach ($ventas_detalles as $key => $venta_detalle) {
		$preparado = get_preparados_id($venta_detalle['preparado_id']);
		$total = $total + ($preparado['PREPARADOS_PRECIO'] * $venta_detalle['cantidad']);
	}
	return $total;
}

function inserta_vta_pago($monto, $fecha, $hora, $vta_id, $forma_pago, $usuario, $fecha_full){

	$horaparse = substr($hora, 0, 5);
	$sql2 = "insert into ayahuaska.log(texto) values('insert into ayahuaska.ventas_pagos(valor, fecha, hora, venta_id, forma_pago_id, usuario_id, fecha_full)
			values(".$monto.", ".$fecha.", ".$hora.", ".$vta_id.", ".$forma_pago.", ".$usuario.", ".$fecha_full.")')";
    mysql_query($sql2);
    $sql3 = "select id  from ayahuaska.ventas_pagos where valor = ".$monto." and fecha = '".$fecha."' and hora like '".$horaparse."%' and venta_id = ".$vta_id."";
    $res3 = mysql_query($sql3);
    $tot = mysql_num_rows($res3);
    if($tot == 0){
    	$sql = "insert into ayahuaska.ventas_pagos(valor, fecha, hora, venta_id, forma_pago_id, usuario_id, fecha_full)
			values(".$monto.", '".$fecha."', '".$hora."', ".$vta_id.", ".$forma_pago.", ".$usuario.", '".$fecha_full."')";
    
		if(mysql_query($sql)){
			return true;
		}
		else{
			return false;
		}
    }
    else{
    	return false;
    }
}


function inserta_vta_socio($fecha, $hora, $vta_id, $socio_id){
	$sql = "insert into ayahuaska.ventas_socios (fecha, hora, venta_id, socio_id)
			values ('".$fecha."', '".$hora."', ".$vta_id.", ".$socio_id.")";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function elimina_vta_socio($venta_id){
	$sql = "delete from ayahuaska.ventas_socios where venta_id = ".$venta_id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function actualiza_ventas_socios_by_id($vta_id_nueva, $vta_id_antigua){
	$sql = "update ayahuaska.ventas_socios set venta_id = ".$vta_id_nueva." where venta_id = ".$vta_id_antigua."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function inserta_venta_propina($venta_id, $monto, $estado, $venta_pago_id){
	$sql = "insert into ayahuaska.ventas_propinas(monto, estado, venta_id, venta_pago_id)
			values(".$monto.", ".$estado.", ".$venta_id.", ".$venta_pago_id.")";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function get_venta_propina($venta_id, $venta_pago_id){
	$sql = "select * from ayahuaska.ventas_propinas where venta_id = ".$venta_id." and venta_pago_id = ".$venta_pago_id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat;
}

function get_vta_id($fecha, $hora, $estado, $mesa, $usuario){
	$sql = "select id from ayahuaska.ventas where fecha = '".$fecha."' and hora = '".$hora."'
			and estado = ".$estado." and mesa_id = ".$mesa." and usuario_id = ".$usuario."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['id'];
}

function get_vta_socio_id($venta_id){
	$sql = "select socio_id from ayahuaska.ventas_socios where venta_id = ".$venta_id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['socio_id'];
}

function cierra_mesa_venta($id){
	$sql = "update ayahuaska.ventas set estado = 1 where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function actualiza_ventas_mesa_id($venta_id, $mesa_id){
	$sql = "update ayahuaska.ventas set mesa_id = ".$mesa_id." where id = ".$venta_id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function venta_cambia_estado($id, $estado){
	$sql = "update ayahuaska.ventas set estado = ".$estado." where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

// FIN CONTRALADOR DE VENTAS

// CONTROLADOR DE MESAS
function get_mesas_estado($estado){
	$mesas = null;
	$sql = "select * from ayahuaska.mesas where estado = ".$estado." and num <> 7777 order by num asc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$mesas[] = array('id' => $dat['id'], 'num' =>$dat['num']);
		}
	}
	return $mesas;
}

function get_mesa($id){
	$sql = "select * from ayahuaska.mesas where id = ".$id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat;
}

function get_mesa_by_id($id){
	$sql = "select num from ayahuaska.mesas where id = ".$id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['num'];
}

function get_mesa_num_by_id($id){
	$sql = "select num from ayahuaska.mesas where id = ".$id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['num'];
}

function get_mesa_by_num($num){
	$sql = "select id from ayahuaska.mesas where num = ".$num."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['id'];
}

function actualiza_mesa($id, $estado){
	$sql = "update ayahuaska.mesas set estado = ".$estado." where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function actualiza_boleta_venta($id, $boleta){
	$sql = "update ayahuaska.ventas set boleta = ".$boleta." where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}
// FIN CONTROLADOR DE MESAS

// CONTROLADOR HAPPY
function get_hora_happy(){
	$sql = "select * from ayahuaska.horahappy";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat;
}


// FIN CONTROLADOR HAPPY

// CONTROLADOR PSR
function get_hora_psr(){
	$sql = "select * from ayahuaska.horapsr";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat;
}


// FIN CONTROLADOR PSR

//CONTROL DE STOCK
function testo($idPreparado)
{
	echo "Hola, sirvo para testear lo que necesite...";
}

function aumenta_stock($idProducto, $cantidad, $compra_id){
	 mysql_query("insert INTO ayahuaska.stock_compras (PRODUCTO_ID,STOCK_COMPRAS_CANTIDAD, COMPRA_ID) 
		VALUES ('{$idProducto}', '{$cantidad}', '{$compra_id}');");
  	return true;
}

function elimina_stock_compra($idProducto, $compra_id){
	$sql = "delete from ayahuaska.stock_compras where PRODUCTO_ID = ".$idProducto." and COMPRA_ID = ".$compra_id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}



function stockUnidadBy_idProducto($idProducto)
{
  $query="select * from ayahuaska.producto WHERE PRODUCTO_ID={$idProducto}";
  $result=mysql_query($query);
  $tot=mysql_num_rows($result);
  if ($tot!=0) {
    while ($dat=mysql_fetch_array($result)) {
      $totalEntrada = sumaStockCompra_byIdProducto($idProducto);
      $totalSalida = sumaStockSalida_byIdProducto($idProducto);
      if($dat['PRODUCTO_CAPACIDADPORUNIDAD'] > 0){
      	//$totalStock = decimal_2($totalEntrada + $dat['PRODUCTO_UNIDADESINICIAL'] - ($totalSalida/$dat['PRODUCTO_CAPACIDADPORUNIDAD']));	
      	$totalStock = ($totalEntrada + $dat['PRODUCTO_UNIDADESINICIAL'] - ($totalSalida/$dat['PRODUCTO_CAPACIDADPORUNIDAD']));	
      	$totalStock = number_format((float)$totalStock, 2, '.', '');
      	//echo "ID->".$idProducto.", TOT->".$totalStock."<br>";
      }
      else{
      	//$totalStock = decimal_2($totalEntrada + $dat['PRODUCTO_UNIDADESINICIAL'] - ($totalSalida));
      	$totalStock = ($totalEntrada + $dat['PRODUCTO_UNIDADESINICIAL'] - ($totalSalida));		
      	$totalStock = number_format((float)$totalStock, 2, '.', '');
      }
      //$totalStock = ($totalEntrada + $dat['PRODUCTO_UNIDADESINICIAL'] - ($totalSalida/$dat['PRODUCTO_CAPACIDADPORUNIDAD']));	
      return $totalStock;
    }
  }
}

function stockTipoBy_idProducto($idProducto)
{
  $query="select * from ayahuaska.producto WHERE PRODUCTO_ID={$idProducto}";
  $result=mysql_query($query);
  $tot=mysql_num_rows($result);
  if ($tot!=0) {
    while ($dat=mysql_fetch_array($result)) {
      $totalEntrada = sumaStockCompra_byIdProducto($idProducto);
      $totalSalida = sumaStockSalida_byIdProducto($idProducto);
      $totalStock = decimal_2( ($totalEntrada*$dat['PRODUCTO_CAPACIDADPORUNIDAD']) + ($dat['PRODUCTO_UNIDADESINICIAL']*$dat['PRODUCTO_CAPACIDADPORUNIDAD']) - $totalSalida);
      //echo "totalStock->".$totalStock;
      return $totalStock;
    }
  }
}

  function sumaStockCompra_byIdProducto($idProducto)
  {
    $query="select sum(STOCK_COMPRAS_CANTIDAD) as total from ayahuaska.stock_compras WHERE PRODUCTO_ID={$idProducto}";
    $result=mysql_query($query);
    $tot=mysql_num_rows($result);
    if ($tot!=0) {
      while ($dat=mysql_fetch_array($result)) {
        return $dat['total'];
      }
    }else{
      return 0;
    }
  }
  function sumaStockSalida_byIdProducto($idProducto)
  {
    $query="select sum(STOCK_CANTIDAD) as total from ayahuaska.stock WHERE PRODUCTO_ID={$idProducto}";
    $result=mysql_query($query);
    $tot=mysql_num_rows($result);
    if ($tot!=0) {
      while ($dat=mysql_fetch_array($result)) {
        return $dat['total'];
      }
    }else{
      return 0;
    }
  }

  function valida_stock_critico($venta_id){
  	$ventas_detalles = get_ventas_detalles_id($venta_id);
  	foreach ($ventas_detalles as $key => $venta_detalle){
  		$query="select * from ayahuaska.producto_preparados WHERE PREPARADOS_ID={$venta_detalle['preparado_id']}";
	    $result=mysql_query($query);
	    $tot=mysql_num_rows($result);
	    if ($tot!=0) {
	      while ($dat=mysql_fetch_array($result)) {
	        $fechaHoy = fecha_hoy_bd();
	        if(stock_critico($dat['PRODUCTO_ID'])){
	        	$producto = get_id_producto_by_id($dat['PRODUCTO_ID']);
	      		enviarcorreostock($producto['PRODUCTO_NOMBRE'], stockUnidadBy_idProducto($dat['PRODUCTO_ID']), $producto['PRODUCTO_STOCKMINIMO']);
	      	}
	      }
	    }
  	}
  }

  function valida_stock_critico2($venta_id){
  	$ventas_detalles = get_ventas_detalles_id($venta_id);
  	foreach ($ventas_detalles as $key => $venta_detalle){
  		$query="select * from ayahuaska.producto_preparados WHERE PREPARADOS_ID={$venta_detalle['preparado_id']}";
	    $result=mysql_query($query);
	    $tot=mysql_num_rows($result);
	    if ($tot!=0) {
	      while ($dat=mysql_fetch_array($result)) {
	        $fechaHoy = fecha_hoy_bd();
	        if(stock_critico($dat['PRODUCTO_ID'])){
	        	$producto = get_id_producto_by_id($dat['PRODUCTO_ID']);
	      		//enviarcorreostock($producto['PRODUCTO_NOMBRE'], stockUnidadBy_idProducto($dat['PRODUCTO_ID']), $producto['PRODUCTO_STOCKMINIMO']);
	      	}
	      }
	    }
  	}
  }

  if(isset($_GET['test'])){
  	valida_stock_critico2($_GET['test']);
  }

	function descuentaStock_preparados($idPreparado, $cantidad, $movimiento)
  {
    $query="select * from ayahuaska.producto_preparados WHERE PREPARADOS_ID={$idPreparado}";
    $result=mysql_query($query);
    $tot=mysql_num_rows($result);
    if ($tot!=0) {
      while ($dat=mysql_fetch_array($result)) {
        $cantidadDescontada = $cantidad * $dat['PRODUCTO_PREPARADOS_CANTIDADESCUENTO'];
        $fechaHoy = fecha_hoy_bd();
        mysql_query ("insert INTO ayahuaska.stock (PRODUCTO_ID,STOCK_FECHA,STOCK_CANTIDAD, venta_id) VALUES ('{$dat['PRODUCTO_ID']}', '{$fechaHoy}','{$cantidadDescontada}', '{$movimiento}');");
       //  if(stock_critico($dat['PRODUCTO_ID'])){
       //  	$producto = get_id_producto_by_id($dat['PRODUCTO_ID']);
      	// 	enviarcorreostock($producto['PRODUCTO_NOMBRE'], stockUnidadBy_idProducto($dat['PRODUCTO_ID']), $producto['PRODUCTO_STOCKMINIMO']);
      	// }
      }
    }
  }
  function descuentaStock_preparados_revertir($idPreparado, $cantidad)
  {
    $query="select * from ayahuaska.producto_preparados WHERE PREPARADOS_ID={$idPreparado}";
    $result=mysql_query($query);
    $tot=mysql_num_rows($result);
    if ($tot!=0) {
      while ($dat=mysql_fetch_array($result)) {
        $cantidadDescontada = ($cantidad * $dat['PRODUCTO_PREPARADOS_CANTIDADESCUENTO'])*-1;
        $fechaHoy = fecha_hoy_bd();
        // echo $cantidadDescontada;
        mysql_query("insert INTO ayahuaska.stock (PRODUCTO_ID,STOCK_FECHA,STOCK_CANTIDAD) VALUES ('{$dat['PRODUCTO_ID']}', '{$fechaHoy}','{$cantidadDescontada}');");
      }
    }
  }
  function descuentaStock_preparados_revertirByIdVenta($venta_id)
  {
    $query="select * from ayahuaska.ventas_detalles WHERE venta_id={$venta_id}";
    $result=mysql_query($query);
    $tot=mysql_num_rows($result);
    if ($tot!=0) {
      while ($dat=mysql_fetch_array($result)) {
        descuentaStock_preparados_revertir($dat['preparado_id'], $dat['cantidad']);
      }
    }
  }
function stock_critico($idProducto)
{
	$query="select * from ayahuaska.producto WHERE PRODUCTO_ID={$idProducto}";
    $result=mysql_query($query);
	while ($dat=mysql_fetch_array($result)) {
	    if (intval(stockUnidadBy_idProducto($idProducto)) < intval($dat['PRODUCTO_STOCKMINIMO'])) {
	    	return true;
	    }
	}
    
    return false;
}
function actualiza_stock($idProducto, $stockUnidadNuevo, $stockTipoNuevo)
{
  $producto = get_producto($idProducto);
  // $productoCantidadDescuento = $producto['PRODUCTO_CAPACIDADPORUNIDAD'];
  #stock anterior menos stock nuevo (si sale positivo -> la resta x cantidadpoipo)
  // $stockUnidadActual = stockUnidadBy_idProducto($idProducto);
  $stockTipoActual = stockTipoBy_idProducto($idProducto);
  // echo $stockUnidadActual."|".$stockTipoActual;
  // echo "<br>{$stockUnidadNuevo} | {$stockTipoNuevo}";
  // $nuevoStockUnidad = ($stockUnidadActual - $stockUnidadNuevo)*$productoCantidadDescuento;
  // $nuevoStockTipo = $stockTipoActual - $stockTipoNuevo;

  $stockNuevoPorTipo = $stockTipoActual-(($stockUnidadNuevo*$producto['PRODUCTO_CAPACIDADPORUNIDAD'])+$stockTipoNuevo);


  // echo "<br>{$nuevoStockUnidad} | {$nuevoStockTipo} | {$stockNuevoPorTipo}";
  $fechaHoy = fecha_hoy_bd();
  // echo $cantidadDescontada;
  mysql_query("insert INTO ayahuaska.stock (PRODUCTO_ID,STOCK_FECHA,STOCK_CANTIDAD) VALUES ('{$idProducto}', '{$fechaHoy}','{$stockNuevoPorTipo}');");
  return true;

}

function actualiza_stock_unitario($idProducto, $stockActual, $stockAumenta){
	$fechaHoy = fecha_hoy_bd();
	$producto = get_producto($idProducto);
  	notifica_cambio_stock_unitario($producto['PRODUCTO_NOMBRE'], $stockActual, $stockAumenta);
	$stockAumenta = $stockAumenta * -1;
  	mysql_query("insert INTO ayahuaska.stock (PRODUCTO_ID,STOCK_FECHA,STOCK_CANTIDAD) VALUES ('{$idProducto}', '{$fechaHoy}','{$stockAumenta}');");
  	return true;
}

function actualiza_stock_unitario2($idProducto, $stockActual, $stockAumenta, $usuario_id){
	$fechaHoy = fecha_hoy_bd();
	$producto = get_producto($idProducto);
	$usu = get_usuario_id($usuario_id);
	$usu = $usu['nombre']." ".$usu['apellido'];
  	notifica_cambio_stock_unitario2($producto['PRODUCTO_NOMBRE'], $stockActual, $stockAumenta, $usu);
	$stockAumenta = $stockAumenta * -1;
  	$sql = mysql_query("insert INTO ayahuaska.stock (PRODUCTO_ID,STOCK_FECHA,STOCK_CANTIDAD, usuario_id) VALUES ('{$idProducto}', '{$fechaHoy}','{$stockAumenta}', {$usuario_id});");
  	return true;
}

function actualiza_stock_onzas($idProducto, $stockActual, $stockAumenta, $stockOnzas){
	$fechaHoy = fecha_hoy_bd();
	$producto = get_producto($idProducto);
  	notifica_cambio_stock_onzas($producto['PRODUCTO_NOMBRE'], $stockActual, $stockAumenta, $stockOnzas);
	$stockAumenta = $stockAumenta * -1;
  	mysql_query("insert INTO ayahuaska.stock (PRODUCTO_ID,STOCK_FECHA,STOCK_CANTIDAD) VALUES ('{$idProducto}', '{$fechaHoy}','{$stockAumenta}');");
  	return true;
}

function actualiza_stock_onzas2($idProducto, $stockActual, $stockAumenta, $stockOnzas, $usuario_id){
	$fechaHoy = fecha_hoy_bd();
	$producto = get_producto($idProducto);
	$usu = get_usuario_id($usuario_id);
	$usu = $usu['nombre']." ".$usu['apellido'];
  	//notifica_cambio_stock_onzas2($producto['PRODUCTO_NOMBRE'], $stockActual, $stockAumenta, $stockOnzas, $usu);
	$stockAumenta = $stockAumenta * -1;
	echo $sql = "insert INTO ayahuaska.stock (PRODUCTO_ID,STOCK_FECHA,STOCK_CANTIDAD, usuario_id) VALUES ('{$idProducto}', '{$fechaHoy}','{$stockAumenta}', {$usuario_id});";
  	mysql_query($sql);
  	return true;
}

//FIN CONTROL DE STOCK

// MODERADOR FORMA DE PAGO
function get_all_formas_pagos(){
	$formas_pagos = null;
	$sql = "select * from ayahuaska.formas_pagos where (id !=5 and id != 6) order by descripcion asc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$formas_pagos[] = array('id' => $dat['id'], 'descripcion' =>$dat['descripcion']);
		}
	}
	return $formas_pagos;
}

function get_forma_pago_id($id){
	$sql = "select descripcion from ayahuaska.formas_pagos where id = ".$id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['descripcion'];
}
// FINMODERADOR FORMA DE PAGO

// MANTENEDOR BOLETAS
function get_max_boleta_actual(){
	$sql = "select max(numero) as maxboleta from ayahuaska.boletas";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['maxboleta'];
}

function inserta_boleta_acutal($venta_id, $boleta){
	$sql = "insert into ayahuaska.boletas(numero, venta_id) values(".$boleta.", ".$venta_id.")";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}

}

function get_boleta_actual(){
	$sql = "select max(num) as maxboleta from ayahuaska.boleta_actual";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['maxboleta'];
}

function actauliza_bol_actual($num){
	$sql = "update ayahuaska.boleta_actual set num = ".$num." where id = 1";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

// FIN MANTENEDOR BOLETAS

// MANTENEDOR MESAS
function get_all_mesas(){
	$mesas = null;
	$sql = "select * from ayahuaska.mesas where num != 7777 order by num asc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$mesas[] = array('id' => $dat['id'], 'num' =>$dat['num'], 'ubicacion' =>$dat['ubicacion']
							, 'estado' =>$dat['estado']);
		}
	}
	return $mesas;
}

function get_all_mesas2(){
	$mesas = null;
	$sql = "select * from ayahuaska.mesas where num between 1 and 33 order by num asc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$mesas[] = array('id' => $dat['id'], 'num' =>$dat['num'], 'ubicacion' =>$dat['ubicacion']
							, 'estado' =>$dat['estado']);
		}
	}
	return $mesas;
}

function get_mesa_by_numero($num){
	$mesas = null;
	$sql = "select * from ayahuaska.mesas where num != 7777 and num like '%".$num."%' order by num asc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$mesas[] = array('id' => $dat['id'], 'num' =>$dat['num'], 'ubicacion' =>$dat['ubicacion']
							, 'estado' =>$dat['estado']);
		}
	}
	return $mesas;
}

function get_mesa_id($id){
	$sql = "select * from ayahuaska.mesas where id = ".$id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat;
}

function ingresa_nueva_mesa($num, $ubicacion, $estado){
	$sql = "insert into ayahuaska.mesas(id, num, ubicacion, estado) values(".$num.", ".$num.", '".$ubicacion."', ".$estado.")";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function actualiza_datos_mesa($num, $ubicacion, $estado, $id){
	$sql = "update ayahuaska.mesas set num = ".$num.", ubicacion = '".$ubicacion."', estado = ".$estado."
			where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function elimina_mesa($id){
	$sql = "delete from ayahuaska.mesas where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

// FIN MANTENEDOR MESAS

// CONTROLAR LOS TIEMPOS
function actualiza_tiempo_happy($hora_inicial, $hora_final){
	$sql = "update ayahuaska.horahappy set horainicialhappy = '".$hora_inicial."',
			horafinalhappy = '".$hora_final."' where idhorahappy = 1";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function actualiza_tiempo_promocion($hora_inicial, $hora_final){
	$sql = "update ayahuaska.horapsr set horainiciapsr = '".$hora_inicial."',
			horafinpsr = '".$hora_final."' where idhorapsr = 1";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

// FIN CONTROLAR LOS TIEMPOS

function get_all_pies_pagina(){
	$pies = null;
	$sql = "select * from ayahuaska.piepagina";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$pies[] = array('id' => $dat['Id'], 'descrip' =>$dat['descrip'], 'estado' =>$dat['estado']);
		}
	}
	return $pies;
}

function get_pie_pagina_estado($estado){
	$sql = "select * from ayahuaska.piepagina where estado = ".$estado."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['descrip'];
}

function get_pie_by_id($id){
	$sql = "select * from ayahuaska.piepagina where id = ".$id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat;
}

function inserta_pie($descrip, $estado){
	$sql = "insert into ayahuaska.piepagina (descrip, estado) values('".$descrip."', ".$estado.")";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function actualiza_pie($descrip, $estado, $id){
	$sql = "update ayahuaska.piepagina set descrip = '".$descrip."', estado = ".$estado."
			where Id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function elimina_pie($id){
	$sql = "delete from ayahuaska.piepagina where Id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function elimina_pedido($venta_id, $mesa_id, $motivo, $usuario_id){
	venta_cambia_estado($venta_id, -1);
	actualiza_mesa($mesa_id, 0);
	elimina_preparados_happy_by_id($venta_id);
	elimina_vta_socio($venta_id);
	inserta_motivo_eliminacion($venta_id, $motivo, $usuario_id);
	// FALTA AGREGAR LA REPOSICION DEL STOCK
	descuentaStock_preparados_revertirByIdVenta($venta_id);

	return true;
}

function get_all_compras(){
	$compras = null;
	$sql = "select * from ayahuaska.compras order by fecha desc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$compras[] = array('id' => $dat['id'], 'fecha' =>$dat['fecha'], 'fecha_vencimiento' =>$dat['fecha_vencimiento']
								, 'num_factura' =>$dat['num_factura'], 'descuento' =>$dat['descuento'], 'exento' =>$dat['exento']
								, 'iva' =>$dat['iva'], 'ila' =>$dat['ila'], 'iaba' =>$dat['iaba'],
								'impuesto_adicional' =>$dat['impuesto_adicional'],
								'servicio_logistico' =>$dat['servicio_logistico'],'retencion' =>$dat['retencion'],
								'neto' =>$dat['neto'],'total' =>$dat['total'],
								'notificado' =>$dat['notificado'], 'estado' =>$dat['estado'],
								'num_transferencia' =>$dat['num_transferencia'], 'num_cheque' =>$dat['num_cheque'],
								'proveedor_id' =>$dat['proveedor_id'],
								'forma_pago_compra_id' =>$dat['forma_pago_compra_id'], 'usuario_id' =>$dat['usuario_id']);
		}
	}
	return $compras;
}



function get_formas_pagos_compras(){
	$formas_pagos = null;
	$sql = "select * from ayahuaska.formas_pagos_compras order by descripcion asc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$formas_pagos[] = array('id' => $dat['id'], 'descripcion' =>$dat['descripcion']);
		}
	}
	return $formas_pagos;
}

function get_froma_pago_compra_by_id($id){
	$sql = "select descripcion from ayahuaska.formas_pagos_compras where id = ".$id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['descripcion'];
}

function get_compras_estado($estado){
	$compras = null;
	$sql = "select * from ayahuaska.compras where estado = ".$estado."";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$compras[] = array('id' => $dat['id'], 'fecha' =>$dat['fecha'], 'fecha_vencimiento' =>$dat['fecha_vencimiento']
								, 'num_factura' =>$dat['num_factura'], 'descuento' =>$dat['descuento'], 'exento' =>$dat['exento']
								, 'iva' =>$dat['iva'], 'ila' =>$dat['ila'], 'iaba' =>$dat['iaba'],
								'impuesto_adicional' =>$dat['impuesto_adicional'],
								'servicio_logistico' =>$dat['servicio_logistico'],'retencion' =>$dat['retencion'],
								'neto' =>$dat['neto'],'total' =>$dat['total'],
								'notificado' =>$dat['notificado'], 'estado' =>$dat['estado'],
								'num_transferencia' =>$dat['num_transferencia'], 'proveedor_id' =>$dat['proveedor_id'],
								'forma_pago_compra_id' =>$dat['forma_pago_compra_id'], 'usuario_id' =>$dat['usuario_id']);
		}
	}
	return $compras;
}

function get_compra_id($num_fact){
	$sql = "select id from ayahuaska.compras where num_factura = ".$num_fact."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['id'];
}

function get_compra_by_id($id){
	$sql = "select * from ayahuaska.compras where id = ".$id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat;
}

function get_count_compras_detalles($compra_id){
	$sql = "select * from ayahuaska.compras_detalles where compra_id = ".$compra_id."";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		return $tot;
	}
	else{
		return 0;
	}
}



function inserta_compra($num_fact, $proveedor, $fecha, $fecha_vencimiento, $fpago, $usuario_id){
	$sql = "insert into ayahuaska.compras(fecha, fecha_vencimiento, num_factura, estado, proveedor_id, forma_pago_compra_id, usuario_id)
			values ('".$fecha."', '".$fecha_vencimiento."', ".$num_fact.", 0,".$proveedor.", ".$fpago.", ".$usuario_id.")";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function get_cheque_imagen_by_compra_id($compra_id){
	$sql = "select * from ayahuaska.cheques_imagenes where compra_id = ".$compra_id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat;
}

function actualiza_compras($id, $forma_pago_id, $neto, $iva, $imp_adi, $serv_log, $retencion, $iaba, $ila, $desc, $exento,
	$total, $nro_cheque){
	if($nro_cheque == ""){
		$nro_cheque = 0;
	}
	$sql = "update ayahuaska.compras set descuento = ".$desc.", exento = ".$exento.", iva = ".$iva.", ila = ".$ila.",
			iaba = ".$iaba.", impuesto_adicional = ".$imp_adi.", servicio_logistico = ".$serv_log.", neto = ".$neto.",
			total = ".$total.", num_transferencia = ".$nro_cheque." where id = ".$id."";
	if(mysql_query($sql)){
		// if($forma_pago_id == 2){
		// 	$carpetaDestino= "../Compras/Cheques/".$id;
		// 	if($tipo_archivo=="image/jpeg" || $tipo_archivo=="image/pjpeg"
		// 		|| $tipo_archivo=="image/gif" || $tipo_archivo=="image/png"){
		// 		# si exsite la carpeta o se ha creado
  //               if(file_exists($carpetaDestino) || @mkdir($carpetaDestino))
  //               {
		// 			$archivo = basename($archivo_nombre);
	 //                $archivo = str_replace(' ','_',$archivo);
	 //                $origen=$archivo_temporal;
	 //                $destino=$carpetaDestino."//".$archivo;
	 //                $url = "http://caferealsistema.servehttp.com:81/sheol/intranet/Compras/Cheques/".$id."/".$archivo;
	 //                # movemos el archivo
  //                   if(@move_uploaded_file($origen, $destino))
  //                   {
  //                   	$sqlima = "insert into cheques_imagenes(fecha, ubicacion, compra_id)
  //                                   	values ('".date("Y-m-d")."', '".$archivo."', ".$id.")";
  //                       mysql_query($sqlima);

  //                       // ENVIAR CORREO DE RUTA CHEQUE
  //                      enviarcorrecheque($id, $url);
  //                   }
	 //            }
		// 	}
		// }
		return true;
	}
	else{
		return false;
	}
}

function actualiza_compra_notificacion($id){
	$sql = "update ayahuaska.compras set notificado = 1 where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function inserta_compra_detalle($producto_id, $venta_id, $cantidad, $preciou, $multi){
	$sql = "insert into ayahuaska.compras_detalles(cantidad, precio, producto_id, compra_id)
			values(".$cantidad.", ".$preciou.", ".$producto_id.", ".$venta_id.")";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function elimina_compra_detalle($producto_id, $compra_id){
	$sql = "delete from ayahuaska.compras_detalles where compra_id = ".$compra_id." and producto_id = ".$producto_id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function elimina_factura($id){
	$sql = "delete from ayahuaska.compras where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function get_cheques_imagenes_by_compra_id($compra_id){
	$cheques = null;
	$sql = "select * from ayahuaska.cheques_imagenes where compra_id = ".$compra_id."";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$cheques[] = array('id' => $dat['id'], 'fecha' =>$dat['fecha']
									, 'ubicacion' =>$dat['ubicacion'] , 'compra_id' =>$dat['compra_id']);
		}
	}
	return $cheques;
}

function get_all_descuentos_familias(){
	$descuentos_familias = null;
	$sql = "select * from ayahuaska.descuento_familia";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$descuentos_familias[] = array('id' => $dat['id'], 'hora_inicial' =>$dat['hora_inicial']
									, 'hora_final' =>$dat['hora_final'] , 'descuento' =>$dat['descuento']
									, 'familia_id' =>$dat['familia_id'], 'estado' =>$dat['estado']
									, 'fecha_ingreso' =>$dat['fecha_ingreso']);
		}
	}
	return $descuentos_familias;
}

function inserta_descuento_familia($horai, $horaf, $descuento, $familia_id){
	$sql = "insert into ayahuaska.descuento_familia (hora_inicial, hora_final, descuento, familia_id, estado, fecha_ingreso)
			values ('".$horai."', '".$horaf."', ".$descuento.", ".$familia_id.", 0, '".date("Y-m-d")."')";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function get_descuento_familia_by_id($id){
	$sql = "select * from ayahuaska.descuento_familia where id = ".$id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat;
}

function get_descuento_familia_by_familia_id($familia_id){
	$sql = "select * from ayahuaska.descuento_familia where familia_id = ".$familia_id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat;
}

function actualiza_descuento_familia($horai, $horaf, $descuento, $familia_id, $id){
	$sql = "update ayahuaska.descuento_familia set hora_inicial = '".$horai."', hora_final = '".$horaf."',
			descuento = ".$descuento.", familia_id = ".$familia_id." where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function elimina_descuento_familia($id){
	$sql = "delete from ayahuaska.descuento_familia where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

// RETORNA 1 SI ESTA DENTRO DE HORARIO
function dentro_de_horario($hms_inicio, $hms_fin, $hms_referencia=NULL){ // v2011-06-21
    if( is_null($hms_referencia) ){
        $hms_referencia = date('H:i:s');
    }

    list($h, $m, $s) = array_pad(preg_split('/[^\d]+/', $hms_inicio), 3, 0);
    $s_inicio = 3600*$h + 60*$m + $s;

    list($h, $m, $s) = array_pad(preg_split('/[^\d]+/', $hms_fin), 3, 0);
    $s_fin = 3600*$h + 60*$m + $s;

    list($h, $m, $s) = array_pad(preg_split('/[^\d]+/', $hms_referencia), 3, 0);
    $s_referencia = 3600*$h + 60*$m + $s;

    if($s_inicio<=$s_fin){
        return $s_referencia>=$s_inicio && $s_referencia<=$s_fin;
    }else{
        return $s_referencia>=$s_inicio || $s_referencia<=$s_fin;
    }
}

function get_cierres_por_fecha_hora($fecha_inicial, $fecha_final){
	$cierres = null;
	$sql = "select ayahuaska.ventas_pagos.valor, ayahuaska.ventas.fecha as venta_fecha, ayahuaska.ventas.hora as venta_hora,
			ayahuaska.ventas_pagos.venta_id, ayahuaska.ventas_pagos.forma_pago_id, ayahuaska.ventas.usuario_id, 
			ayahuaska.ventas.boleta, 
			ayahuaska.ventas.mesa_id, ayahuaska.ventas.estado, ayahuaska.ventas.fecha_full, ayahuaska.ventas_pagos.id as venta_pago_id
			from ayahuaska.ventas_pagos inner join ayahuaska.ventas
            on (ventas_pagos.venta_id = ventas.id)
            where ((ventas_pagos.fecha_full between '".$fecha_inicial."' and '".$fecha_final."'))
            and ventas.estado <> -1 order by ventas_pagos.venta_id asc";
    $res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$cierres[] = array('valor' => $dat['valor'], 'fecha' =>$dat['venta_fecha']
									, 'hora' =>$dat['venta_hora'] , 'venta_id' =>$dat['venta_id']
									, 'forma_pago_id' =>$dat['forma_pago_id'], 'usuario_id' =>$dat['usuario_id']
									, 'boleta' =>$dat['boleta'], 'mesa_id' =>$dat['mesa_id']
									, 'estado' =>$dat['estado'], 'fecha_full' =>$dat['fecha_full'], 'venta_pago_id' =>$dat['venta_pago_id']);
		}
	}

	return $cierres;
}

function get_cierres_por_fecha_hora_usuario($fecha_inicial, $fecha_final, $usuario_id){
	$cierres = null;
	$sql = "select ayahuaska.ventas_pagos.valor, ayahuaska.ventas.fecha as venta_fecha, ayahuaska.ventas.hora as venta_hora,
			ayahuaska.ventas_pagos.venta_id, ayahuaska.ventas_pagos.forma_pago_id, ayahuaska.ventas.usuario_id, 
			ayahuaska.ventas.boleta, 
			ayahuaska.ventas.mesa_id, ayahuaska.ventas.estado, ayahuaska.ventas.fecha_full, ayahuaska.ventas_pagos.id as venta_pago_id
			from ayahuaska.ventas_pagos inner join ayahuaska.ventas
            on (ventas_pagos.venta_id = ventas.id)
            where ((ventas_pagos.fecha_full between '".$fecha_inicial."' and '".$fecha_final."'))
            and ventas.estado <> -1 and ayahuaska.ventas_pagos.usuario_id = ".$usuario_id." 
             order by ventas_pagos.venta_id asc";
    $res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$cierres[] = array('valor' => $dat['valor'], 'fecha' =>$dat['venta_fecha']
									, 'hora' =>$dat['venta_hora'] , 'venta_id' =>$dat['venta_id']
									, 'forma_pago_id' =>$dat['forma_pago_id'], 'usuario_id' =>$dat['usuario_id']
									, 'boleta' =>$dat['boleta'], 'mesa_id' =>$dat['mesa_id']
									, 'estado' =>$dat['estado'], 'fecha_full' =>$dat['fecha_full'], 'venta_pago_id' =>$dat['venta_pago_id']);
		}
	}

	return $cierres;
}

function get_cierres_por_fecha_hora2($fecha_inicial1, $fecha_final1, $fecha_inicial2, $fecha_final2){
	$cierres = null;
	$sql = "select ayahuaska.ventas_pagos.valor, ayahuaska.ventas.fecha as venta_fecha, ayahuaska.ventas.hora as venta_hora,
			ayahuaska.ventas_pagos.venta_id, ayahuaska.ventas_pagos.forma_pago_id, ayahuaska.ventas.usuario_id, 
			ayahuaska.ventas.boleta, 
			ayahuaska.ventas.mesa_id, ayahuaska.ventas.estado, ayahuaska.ventas.fecha_full, ayahuaska.ventas_pagos.id as venta_pago_id from ayahuaska.ventas_pagos inner join ayahuaska.ventas
            on (ventas_pagos.venta_id = ventas.id)
            where ((ventas_pagos.fecha_full between '".$fecha_inicial1."' and '".$fecha_final1."' or
             ventas_pagos.fecha_full between '".$fecha_inicial2."' and '".$fecha_final2."'))
            and ventas.estado <> -1 order by ventas_pagos.venta_id asc";
    $res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$cierres[] = array('valor' => $dat['valor'], 'fecha' =>$dat['fecha']
									, 'hora' =>$dat['hora'] , 'venta_id' =>$dat['venta_id']
									, 'forma_pago_id' =>$dat['forma_pago_id'], 'usuario_id' =>$dat['usuario_id']
									, 'boleta' =>$dat['boleta'], 'mesa_id' =>$dat['mesa_id']
									, 'estado' =>$dat['estado'], 'fecha_full' =>$dat['fecha_full'], 'venta_pago_id' =>$dat['venta_pago_id']);
		}
	}

	return $cierres;
}

function get_cierres_por_fecha_hora2_usuario($fecha_inicial1, $fecha_final1, $fecha_inicial2, $fecha_final2, $usuario_id){
	$cierres = null;
	$sql = "select ayahuaska.ventas_pagos.valor, ayahuaska.ventas.fecha as venta_fecha, ayahuaska.ventas.hora as venta_hora,
			ayahuaska.ventas_pagos.venta_id, ayahuaska.ventas_pagos.forma_pago_id, ayahuaska.ventas.usuario_id, 
			ayahuaska.ventas.boleta, 
			ayahuaska.ventas.mesa_id, ayahuaska.ventas.estado, ayahuaska.ventas.fecha_full, ayahuaska.ventas_pagos.id as venta_pago_id from ayahuaska.ventas_pagos inner join ayahuaska.ventas
            on (ventas_pagos.venta_id = ventas.id)
            where ((ventas_pagos.fecha_full between '".$fecha_inicial1."' and '".$fecha_final1."' or
             ventas_pagos.fecha_full between '".$fecha_inicial2."' and '".$fecha_final2."'))
            and ventas.estado <> -1 and ventas_pagos.usuario_id = ".$usuario_id." order by ventas_pagos.venta_id asc";
    $res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$cierres[] = array('valor' => $dat['valor'], 'fecha' =>$dat['fecha']
									, 'hora' =>$dat['hora'] , 'venta_id' =>$dat['venta_id']
									, 'forma_pago_id' =>$dat['forma_pago_id'], 'usuario_id' =>$dat['usuario_id']
									, 'boleta' =>$dat['boleta'], 'mesa_id' =>$dat['mesa_id']
									, 'estado' =>$dat['estado'], 'fecha_full' =>$dat['fecha_full'], 'venta_pago_id' =>$dat['venta_pago_id']);
		}
	}

	return $cierres;
}

function get_cierres_por_fecha_by_hora($fecha_inicial, $fecha_final, $hora_inicial, $hora_final){
	$cierres = null;
	 $sql = "select ayahuaska.ventas_pagos.valor, ayahuaska.ventas.fecha as venta_fecha, ayahuaska.ventas.hora as venta_hora,
			ayahuaska.ventas_pagos.venta_id, ayahuaska.ventas_pagos.forma_pago_id, ayahuaska.ventas.usuario_id, 
			ayahuaska.ventas.boleta, 
			ayahuaska.ventas.mesa_id, ayahuaska.ventas.estado, ayahuaska.ventas.fecha_full, ayahuaska.ventas_pagos.id as venta_pago_id from ayahuaska.ventas_pagos inner join ayahuaska.ventas
            on (ventas_pagos.venta_id = ventas.id)
            where ((ventas_pagos.fecha between '".$fecha_inicial."' and '".$fecha_final."')
             and (ventas_pagos.hora between '".$hora_inicial."' and '".$hora_final."'))
            and ventas.estado <> -1 order by ventas_pagos.venta_id asc";
    $res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$cierres[] = array('valor' => $dat['valor'], 'fecha' =>$dat['fecha']
									, 'hora' =>$dat['hora'] , 'venta_id' =>$dat['venta_id']
									, 'forma_pago_id' =>$dat['forma_pago_id'], 'usuario_id' =>$dat['usuario_id']
									, 'boleta' =>$dat['boleta'], 'mesa_id' =>$dat['mesa_id']
									, 'estado' =>$dat['estado'], 'venta_pago_id' =>$dat['venta_pago_id']);
		}
	}

	return $cierres;
}

 function get_cierres_por_fecha_by_hora2($fi1, $fi2, $ff1, $ff2, $hora1, $hora4){
	$cierres = null;
	 $sql = "select * from ayahuaska.ventas_pagos inner join ayahuaska.ventas
            on (ventas_pagos.venta_id = ventas.id)
            where ((ventas_pagos.fecha between '".$fi1."' and '".$fi2."')
             and (ventas_pagos.hora between '".$hora1."' and '".$hora4."'))
			or ((ventas_pagos.fecha between '".$ff1."' and '".$ff2."')
             and (ventas_pagos.hora between '".$hora1."' and '".$hora4."'))
            and ventas.estado <> -1 order by ventas_pagos.venta_id asc";
    $res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$cierres[] = array('valor' => $dat['valor'], 'fecha' =>$dat['fecha']
									, 'hora' =>$dat['hora'] , 'venta_id' =>$dat['venta_id']
									, 'forma_pago_id' =>$dat['forma_pago_id'], 'usuario_id' =>$dat['usuario_id']
									, 'boleta' =>$dat['boleta'], 'mesa_id' =>$dat['mesa_id']
									, 'estado' =>$dat['estado'], 'venta_pago_id' =>$dat['id']);
		}
	}

	return $cierres;
 }


function get_ventas_eliminadas_fecha($fecha_inicial, $fecha_final, $estado){
	$ventas = null;
	 $sql = "select * from ayahuaska.ventas where ((fecha_full between '".$fecha_inicial."' and '".$fecha_final."') )
            and estado = -1 order by id asc";
    $res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$ventas[] = array('id' => $dat['id'], 'fecha' =>$dat['fecha']
									, 'hora' =>$dat['hora'] , 'estado' =>$dat['estado']
									, 'boleta' =>$dat['boleta'], 'mesa_id' =>$dat['mesa_id']
									, 'usuario_id' =>$dat['usuario_id'], 'fecha_full' =>$dat['fecha_full']);
		}
	}

	return $ventas;
}

function get_ventas_eliminadas_fecha_usuario($fecha_inicial, $fecha_final, $estado, $usuario_id){
	$ventas = null;
	 $sql = "select * from ayahuaska.ventas where ((fecha_full between '".$fecha_inicial."' and '".$fecha_final."') )
            and estado = -1 and usuario_id = ".$usuario_id." order by id asc";
    $res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$ventas[] = array('id' => $dat['id'], 'fecha' =>$dat['fecha']
									, 'hora' =>$dat['hora'] , 'estado' =>$dat['estado']
									, 'boleta' =>$dat['boleta'], 'mesa_id' =>$dat['mesa_id']
									, 'usuario_id' =>$dat['usuario_id'], 'fecha_full' =>$dat['fecha_full']);
		}
	}

	return $ventas;
}

function get_ventas_eliminadas_fecha2($fecha_inicial1, $fecha_final1, $fecha_inicial2, $fecha_final2, $estado){
	$ventas = null;
	$sql = "select * from ayahuaska.ventas where ((fecha_full between '".$fecha_inicial1."' and '".$fecha_final1."'
			or fecha_full between '".$fecha_inicial2."' and '".$fecha_final2."' ) )
            and ventas.estado = -1 order by id asc";
    $res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$ventas[] = array('id' => $dat['id'], 'fecha' =>$dat['fecha']
									, 'hora' =>$dat['hora'] , 'estado' =>$dat['estado']
									, 'boleta' =>$dat['boleta'], 'mesa_id' =>$dat['mesa_id']
									, 'usuario_id' =>$dat['usuario_id']);
		}
	}

	return $ventas;
}

function get_ventas_eliminadas_fecha2_usario($fecha_inicial1, $fecha_final1, $fecha_inicial2, $fecha_final2, $estado, $usuario_id){
	$ventas = null;
	$sql = "select * from ayahuaska.ventas where ((fecha_full between '".$fecha_inicial1."' and '".$fecha_final1."'
			or fecha_full between '".$fecha_inicial2."' and '".$fecha_final2."' ) )
            and ventas.estado = -1 and usuario_id = ".$usuario_id." order by id asc";
    $res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$ventas[] = array('id' => $dat['id'], 'fecha' =>$dat['fecha']
									, 'hora' =>$dat['hora'] , 'estado' =>$dat['estado']
									, 'boleta' =>$dat['boleta'], 'mesa_id' =>$dat['mesa_id']
									, 'usuario_id' =>$dat['usuario_id']);
		}
	}

	return $ventas;
}

function get_ventas_eliminadas_by_hora($fecha_inicial, $fecha_final, $hora_inicial, $hora_final, $estado){
	$ventas = null;
	$sql = "select * from ayahuaska.ventas where ((fecha between '".$fecha_inicial."' and '".$fecha_final."')
			and (hora between '".$hora_inicial."' and '".$hora_final."' ) )
            and ventas.estado = -1 order by id asc";
    $res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$ventas[] = array('id' => $dat['id'], 'fecha' =>$dat['fecha']
									, 'hora' =>$dat['hora'] , 'estado' =>$dat['estado']
									, 'boleta' =>$dat['boleta'], 'mesa_id' =>$dat['mesa_id']
									, 'usuario_id' =>$dat['usuario_id']);
		}
	}

	return $ventas;
}

function get_ventas_eliminadas_by_hora2($fi1, $fi2, $ff1, $ff2, $hora1, $hora4, $estado){
	$ventas = null;
	$sql = "select * from ayahuaska.ventas where ((fecha between '".$fi1."' and '".$fi2."')
			and (hora between '".$hora1."' and '".$hora4."' ) )
			or ((fecha between '".$ff1."' and '".$ff2."')
			and (hora between '".$hora1."' and '".$hora4."' ) )
            and ventas.estado = -1 order by id asc";
    $res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$ventas[] = array('id' => $dat['id'], 'fecha' =>$dat['fecha']
									, 'hora' =>$dat['hora'] , 'estado' =>$dat['estado']
									, 'boleta' =>$dat['boleta'], 'mesa_id' =>$dat['mesa_id']
									, 'usuario_id' =>$dat['usuario_id']);
		}
	}

	return $ventas;
}



function get_propinas_estado($estado){
	$propinas = null;
	$sql = "select ventas.usuario_id, SUM(monto) as propina from ayahuaska.ventas_propinas inner join ayahuaska.ventas
			on (ventas_propinas.venta_id = ventas.id)
			where ventas_propinas.estado = ".$estado." group by ventas.usuario_id";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$propinas[] = array('usuario_id' => $dat['usuario_id'], 'propina' =>$dat['propina']);
		}
	}
	return $propinas;
}

function actualiza_propina_estado($estado){
	$sql = "update ayahuaska.ventas_propinas set estado = ".$estado." where estado = 0";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function get_all_ordenes_compras(){
	$ocs = null;
	$sql = "select * from ayahuaska.ordenes_compras where estado = 0 order by fecha desc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$ocs[] = array('id' => $dat['id'], 'fecha' =>$dat['fecha'], 'hora' =>$dat['hora']
							, 'fecha_compra' =>$dat['fecha_compra'] , 'proveedor_id' =>$dat['proveedor_id'] ,
							'usuario_id' =>$dat['usuario_id'], 'forma_pago_id' =>$dat['forma_pago_id']
							);
		}
	}
	return $ocs;
}

function get_orden_compra_by_id($id){
	$sql = "select * from ayahuaska.ordenes_compras where id = ".$id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat;
}

function get_orden_compra($fecha, $hora, $fecha_compra, $proveedor_id, $usuario_id, $forma_pago_id){
	$sql = "select * from ayahuaska.ordenes_compras where fecha = '".$fecha."' and hora = '".$hora."'
			and fecha_compra = '".$fecha_compra."' and proveedor_id = ".$proveedor_id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat;
}

function ingresa_orden_compra($fecha, $hora, $fecha_compra, $proveedor_id, $usuario_id, $forma_pago_id){
	echo $sql = "insert into ayahuaska.ordenes_compras (fecha, hora, fecha_compra, proveedor_id, usuario_id, forma_pago_id)
			values ('".$fecha."', '".$hora."', '".$fecha_compra."', ".$proveedor_id.", ".$usuario_id.",
					".$forma_pago_id.")";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function elimina_orden_compra($id){
	$sql = "update ayahuaska.ordenes_compras set estado = '-1' where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}

	// $sql = "delete from ayahuaska.ordenes_compras where id = ".$id."";
	// if(mysql_query($sql)){
	// 	$sql2 = "delete from ordenes_compras_detalles where orden_compra_id = ".$id."";
	// 	if(mysql_query($sql)){
	// 		return true;
	// 	}
	// 	else{
	// 		return false;
	// 	}
	// }
	// else{
	// 	return false;
	// }
}

function inserta_orden_compra_detalle($cantidad, $producto_id, $orden_compra_id){
	$sql = "insert into ayahuaska.ordenes_compras_detalles (cantidad, producto_id, orden_compra_id)
			values (".$cantidad.", ".$producto_id.", ".$orden_compra_id.")";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function inserta_orden_compra_detalle2($orden_compra_id){
	echo $sql = "select * from ayahuaska.tmp_oc where orden_compra_id = ".$orden_compra_id."";
	$res = mysql_query($sql);
	while ($dat = mysql_fetch_array($res)) {
		echo $sql = "insert into ayahuaska.ordenes_compras_detalles(cantidad, producto_id, orden_compra_id)
			values(".$dat['cantidad'].", ".$dat['producto_id'].", ".$orden_compra_id.")";
		mysql_query($sql);
	}
}



function elimina_orden_compra_detalle($producto_id, $orden_compra_id){
	$sql = "delete from ayahuaska.ordenes_compras_detalles where producto_id = ".$producto_id."
			and orden_compra_id = ".$orden_compra_id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function get_ordenes_compras_detalles_by_ocid($orden_compra_id){
	$ocs_detalles = null;
	$sql = "select * from ayahuaska.ordenes_compras_detalles where orden_compra_id = ".$orden_compra_id."";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$ocs_detalles[] = array('id' => $dat['id'], 'cantidad' =>$dat['cantidad'], 'producto_id' =>$dat['producto_id']
							, 'orden_compra_id' =>$dat['orden_compra_id']);
		}
	}
	return $ocs_detalles;
}

function get_count_orden_compra_detalle($orden_compra_id){
	$sql = "select * from ayahuaska.ordenes_compras_detalles where orden_compra_id = ".$orden_compra_id."";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		return $tot;
	}
	else{
		return 0;
	}
}


// CONTROLADOR DE REPORTES DEL SISTEMA
function get_detalle_ventas_garzones($fecha_inicial, $fecha_final){
	$ventas = null;
	$sql = "select ventas.usuario_id, sum(valor) as Venta
			from ayahuaska.ventas_pagos inner join ayahuaska.ventas
			on (ventas_pagos.venta_id = ventas.id)
			where ventas.fecha between '".$fecha_inicial."' and '".$fecha_final."'
            and  estado=1 group by ventas.usuario_id order by Venta desc; ";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$ventas[] = array('usuario_id' =>$dat['usuario_id'], 'venta' => $dat['Venta']);
		}
	}
	return $ventas;

}

function get_detalle_propinas_garzones($fecha_inicial, $fecha_final){
	$propinas = null;
	$sql = "select sum(monto) as propina, usuario_id
			from ayahuaska.ventas_propinas inner join ayahuaska.ventas
			on (ventas_propinas.venta_id = ventas.id)
			where ventas.fecha between '".$fecha_inicial."' and '".$fecha_final."'
			and ventas.estado = 1 group by usuario_id order by propina desc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$propinas[] = array('propina' =>$dat['propina'], 'usuario_id' => $dat['usuario_id']);
		}
	}
	return $propinas;
}


function get_detalle_propinas_garzones_turno($fecha, $turno){
	$propinas = null;
	$sql = "select sum(monto) as propina, usuario_id
			from ayahuaska.ventas_propinas inner join ayahuaska.ventas
			on (ventas_propinas.venta_id = ventas.id)
			where ventas.fecha = '".$fecha."' and turno = ".$turno."
			and ventas.estado = 1 group by usuario_id order by propina desc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$propinas[] = array('propina' =>$dat['propina'], 'usuario_id' => $dat['usuario_id']);
		}
	}
	return $propinas;
}

function get_detalle_compra_socios($fecha_inicial, $fecha_final){
	$compras = null;
	$sql = "select sum(ventas_pagos.valor) as TOTAL, ventas_socios.socio_id, ventas_socios.fecha,
			ventas_socios.hora
			from ayahuaska.ventas_socios inner join ayahuaska.ventas_pagos on (ventas_socios.venta_id = ventas_pagos.venta_id)
			where ventas_socios.fecha between '".$fecha_inicial."' and '".$fecha_final."'
			group by ventas_socios.socio_id, ventas_socios.fecha,
			ventas_socios.hora order by TOTAL desc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$compras[] = array('total' =>$dat['TOTAL'], 'socio_id' => $dat['socio_id']
								, 'fecha' => $dat['fecha'], 'hora' => $dat['hora']);
		}
	}
	return $compras;
}

function get_detalle_compra_socio_productos($socio_id, $fecha_inicial, $fecha_final){
	$detalles = null;
	$sql = "select * from ayahuaska.ventas_socios
			inner join ayahuaska.ventas_detalles on (ventas_socios.venta_id = ventas_detalles.venta_id)
			inner join ayahuaska.preparados on (ventas_detalles.preparado_id = preparados.PREPARADOS_ID)
			where ventas_socios.socio_id = ".$socio_id."
			and ventas_socios.fecha between '".$fecha_inicial."' and '".$fecha_final."' ";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$detalles[] = array('preparado_nombre' =>$dat['PREPARADOS_NOMBRE'], 'socio_id' => $dat['socio_id']
								,'preparado_precio' =>$dat['PREPARADOS_PRECIO'], 'cantidad' =>$dat['cantidad']
								, 'fecha' => $dat['fecha'], 'hora' => $dat['hora']);
		}
	}
	return $detalles;
}

function get_reportes_familias_fecha($familia, $fecha_inicial, $fecha_final){
	$reportes = null;
	$sql = "select sum(cantidad) as CANT, ventas_detalles.preparado_id,
			preparados.PREPARADOS_NOMBRE, preparados.PREPARADOS_PRECIO
			from ayahuaska.ventas inner join ayahuaska.ventas_detalles on (ventas.id = ventas_detalles.venta_id)
			inner join preparados on (preparados.PREPARADOS_ID = ventas_detalles.preparado_id)
			where ventas.fecha between '".$fecha_inicial."' and '".$fecha_final."'
			and preparados.PREPARADOS_FAMILIA = ".$familia."
			and ventas.estado <> -1
			group by preparados.PREPARADOS_ID order by CANT desc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$reportes[] = array('cantidad' =>$dat['CANT'], 'preparado_id' => $dat['preparado_id']
								, 'preparado_nombre' =>$dat['PREPARADOS_NOMBRE']
								, 'preparado_precio' => $dat['PREPARADOS_PRECIO']);
		}
	}
	return $reportes;
}

function get_reportes_ventas_fecha($fecha_inicial, $fecha_final){
	$reportes = null;
	$sql = "select sum(cantidad) as CANT, ventas_detalles.preparado_id, preparados.PREPARADOS_NOMBRE,
			preparados.PREPARADOS_PRECIO from ayahuaska.ventas inner join ayahuaska.ventas_detalles
			on (ventas.id = ventas_detalles.venta_id)
			inner join preparados on (preparados.PREPARADOS_ID = ventas_detalles.preparado_id)
			where ventas.fecha_full between '".$fecha_inicial."' and '".$fecha_final."'
			and ventas.estado <> -1
			group by preparados.PREPARADOS_ID order by CANT desc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$reportes[] = array('cantidad' =>$dat['CANT'], 'preparado_id' => $dat['preparado_id']
								, 'preparado_nombre' =>$dat['PREPARADOS_NOMBRE']
								, 'preparado_precio' => $dat['PREPARADOS_PRECIO']);
		}
	}
	return $reportes;
}

function get_reportes_ventas_fecha_familia($familia, $fecha_inicial, $fecha_final){
	$reportes = null;
	$sql = "select sum(cantidad) as CANT, ventas_detalles.preparado_id, preparados.PREPARADOS_NOMBRE,
			preparados.PREPARADOS_PRECIO from ayahuaska.ventas inner join ayahuaska.ventas_detalles
			on (ventas.id = ventas_detalles.venta_id)
			inner join ayahuaska.preparados on (preparados.PREPARADOS_ID = ventas_detalles.preparado_id)
			where ventas.fecha between '".$fecha_inicial."' and '".$fecha_final."'
			and preparados.PREPARADOS_FAMILIA = ".$familia." and ventas.estado <> -1
			group by preparados.PREPARADOS_ID order by CANT desc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$reportes[] = array('cantidad' =>$dat['CANT'], 'preparado_id' => $dat['preparado_id']
								, 'preparado_nombre' =>$dat['PREPARADOS_NOMBRE']
								, 'preparado_precio' => $dat['PREPARADOS_PRECIO']);
		}
	}
	return $reportes;
}

function get_reportes_ventas_turnos($fecha_inicial, $fecha_final){
	$reportes = null;
	$sql = "select sum(cantidad) as CANT, ventas_detalles.preparado_id, preparados.PREPARADOS_NOMBRE,
			preparados.PREPARADOS_PRECIO from ayahuaska.ventas inner join ayahuaska.ventas_detalles
			on (ventas.id = ventas_detalles.venta_id)
			inner join preparados on (preparados.PREPARADOS_ID = ventas_detalles.preparado_id)
			where ventas.fecha_full between '".$fecha_inicial."' and '".$fecha_final."'
			and ventas.estado <> -1
			group by preparados.PREPARADOS_ID order by CANT desc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$reportes[] = array('cantidad' =>$dat['CANT'], 'preparado_id' => $dat['preparado_id']
								, 'preparado_nombre' =>$dat['PREPARADOS_NOMBRE']
								, 'preparado_precio' => $dat['PREPARADOS_PRECIO']);
		}
	}
	return $reportes;
}

function get_reportes_ventas_turnos_familia($familia, $fecha_inicial, $fecha_final){
	$reportes = null;
	$sql = "select sum(cantidad) as CANT, ventas_detalles.preparado_id, preparados.PREPARADOS_NOMBRE,
			preparados.PREPARADOS_PRECIO from ayahuaska.ventas inner join ayahuaska.ventas_detalles
			on (ventas.id = ventas_detalles.venta_id)
			inner join preparados on (preparados.PREPARADOS_ID = ventas_detalles.preparado_id)
			where ventas.fecha_full between '".$fecha_inicial."' and '".$fecha_final."'
			and preparados.PREPARADOS_FAMILIA = ".$familia." and ventas.estado <> -1
			group by preparados.PREPARADOS_ID order by CANT desc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$reportes[] = array('cantidad' =>$dat['CANT'], 'preparado_id' => $dat['preparado_id']
								, 'preparado_nombre' =>$dat['PREPARADOS_NOMBRE']
								, 'preparado_precio' => $dat['PREPARADOS_PRECIO']);
		}
	}
	return $reportes;
}

function get_reportes_ventas_turnos_familia_fechas($familia, $fecha_inicial, $fecha_final, $fecha_inicial2, $fecha_final2){
	$reportes = null;
	$sql = "select sum(cantidad) as CANT, ventas_detalles.preparado_id, preparados.PREPARADOS_NOMBRE,
			preparados.PREPARADOS_PRECIO from ayahuaska.ventas inner join ayahuaska.ventas_detalles
			on (ventas.id = ventas_detalles.venta_id)
			inner join preparados on (preparados.PREPARADOS_ID = ventas_detalles.preparado_id)
			where (ventas.fecha_full between '".$fecha_inicial."' and '".$fecha_final."' or
				ventas.fecha_full between '".$fecha_inicial2."' and '".$fecha_final2."' )
			and preparados.PREPARADOS_FAMILIA = ".$familia." and ventas.estado <> -1
			group by preparados.PREPARADOS_ID order by CANT desc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$reportes[] = array('cantidad' =>$dat['CANT'], 'preparado_id' => $dat['preparado_id']
								, 'preparado_nombre' =>$dat['PREPARADOS_NOMBRE']
								, 'preparado_precio' => $dat['PREPARADOS_PRECIO']);
		}
	}
	return $reportes;
}

function get_reportes_ventas_turnos_fechas($fecha_inicial, $fecha_final, $fecha_inicial2, $fecha_final2){
	$reportes = null;
	$sql = "select sum(cantidad) as CANT, ventas_detalles.preparado_id, preparados.PREPARADOS_NOMBRE,
			preparados.PREPARADOS_PRECIO from ayahuaska.ventas inner join ayahuaska.ventas_detalles
			on (ventas.id = ventas_detalles.venta_id)
			inner join preparados on (preparados.PREPARADOS_ID = ventas_detalles.preparado_id)
			where (ventas.fecha_full between '".$fecha_inicial."' and '".$fecha_final."' or
				ventas.fecha_full between '".$fecha_inicial2."' and '".$fecha_final2."')
			and ventas.estado <> -1
			group by preparados.PREPARADOS_ID order by CANT desc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$reportes[] = array('cantidad' =>$dat['CANT'], 'preparado_id' => $dat['preparado_id']
								, 'preparado_nombre' =>$dat['PREPARADOS_NOMBRE']
								, 'preparado_precio' => $dat['PREPARADOS_PRECIO']);
		}
	}
	return $reportes;
}

function get_reportes_compras_proveedor($fechai, $fechaf, $proveedor_id){
	$reportes = null;
	$sql = "select sum(total) as TOTAL, proveedor_id
			from ayahuaska.compras where (fecha between '".$fechai."' and '".$fechaf."')
			and proveedor_id = ".$proveedor_id."
			group by proveedor_id ";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$reportes[] = array('total' =>$dat['TOTAL'], 'proveedor_id' => $dat['proveedor_id']);
		}
	}
	return $reportes;
}

function get_reportes_compras($fechai, $fechaf){
	$reportes = null;
	$sql = "select sum(total) as TOTAL, proveedor_id
			from ayahuaska.compras where (fecha between '".$fechai."' and '".$fechaf."')
			group by proveedor_id ";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$reportes[] = array('total' =>$dat['TOTAL'], 'proveedor_id' => $dat['proveedor_id']);
		}
	}
	return $reportes;
}

function get_reporte_compras_cheque_vencidos($fecha){
	$reportes = null;
	$sql = "select * from ayahuaska.compras where fecha_vencimiento like '".$fecha."'";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$reportes[] = array('id' =>$dat['id'], 'fecha' => $dat['fecha'], 'fecha_vencimiento' => $dat['fecha_vencimiento'], 'num_factura' => $dat['num_factura'], 'descuento' => $dat['descuento'], 'exento' => $dat['exento'], 'iva' => $dat['iva'], 'ila' => $dat['ila'], 'iaba' => $dat['iaba'], 'impuesto_adicional' => $dat['impuesto_adicional'], 'servicio_logistico' => $dat['servicio_logistico'], 'retencion' => $dat['retencion'], 'neto' => $dat['neto'], 'total' => $dat['total'], 'notificado' => $dat['notificado'], 'estado' => $dat['estado'], 'num_transferencia' => $dat['num_transferencia'], 'proveedor_id' => $dat['proveedor_id'], 'forma_pago_compra_id' => $dat['forma_pago_compra_id'], 'usuario_id' => $dat['usuario_id']);
		}
	}
	return $reportes;
}

function get_reporte_compras_estados($fechai, $fechaf, $estado){
	$reportes = null;
	$sql = "select num_factura, total, proveedor_id, fecha, estado, forma_pago_compra_id, num_transferencia
			from ayahuaska.compras where (fecha between '".$fechai."' and '".$fechaf."')
			and estado = ".$estado."
			group by proveedor_id";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$reportes[] = array('num_factura' =>$dat['num_factura'], 'total' =>$dat['total'],'proveedor_id' => $dat['proveedor_id'],'fecha' => $dat['fecha'],'estado' => $dat['estado'],'forma_pago_id' => $dat['forma_pago_id'],'num_transferencia' => $dat['num_transferencia']);
		}
	}
	return $reportes;
}

function get_reporte_ordenes_compra($fechai, $fechaf){
	$reportes = null;
	$sql = "select * from ayahuaska.ordenes_compras where (fecha between '".$fechai."' and '".$fechaf."')
			order by id desc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$reportes[] = array('id' =>$dat['id'], 'fecha' =>$dat['fecha'],'hora' => $dat['hora'],
						'fecha_compra' => $dat['fecha_compra'],'proveedor_id' => $dat['proveedor_id'],
						'forma_pago_id' => $dat['forma_pago_id'],'usuario_id' => $dat['usuario_id']);
		}
	}
	return $reportes;
}


//CONTROLADORES DE COSTOS SISTEMA
function get_costos($tipo_costo){
	$costos = null;
	$sql = "select * from ayahuaska.costos where tipo_costo_id = ".$tipo_costo." 
			order by fecha_ingreso desc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$costos[] = array('id' =>$dat['id'], 'nombre' =>$dat['nombre'],'mes' => $dat['mes'],
						'anio' => $dat['anio'],'fecha_ingreso' => $dat['fecha_ingreso'],
						'total' => $dat['total'],'usuario_id' => $dat['usuario_id']
						,'tipo_costo_id' => $dat['tipo_costo_id']);
		}
	}
	return $costos;
}

function get_costos_by_id($id){
	$sql = "select * from ayahuaska.costos where id = ".$id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat;
}

function get_all_costos(){
	$costos = null;
	$sql = "select * from ayahuaska.costos
			order by fecha desc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$costos[] = array('id' =>$dat['id'], 'nombre' =>$dat['nombre'], 'fecha' => $dat['fecha'], 
				'fecha_vencimiento' => $dat['fecha_vencimiento'], 'monto' => $dat['monto'],'usuario_id' => $dat['usuario_id']
						,'tipo_costo_id' => $dat['tipo_costo_id']);
		}
	}
	return $costos;
}

function get_all_costos_by_tipo($tipo){
	$costos = null;
	$sql = "select * from ayahuaska.costos where tipo_costo_id = ".$tipo."
			order by fecha desc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$costos[] = array('id' =>$dat['id'], 'nombre' =>$dat['nombre'], 'fecha' => $dat['fecha'],
						'monto' => $dat['monto'],'usuario_id' => $dat['usuario_id']
						,'tipo_costo_id' => $dat['tipo_costo_id'], 'fecha_vencimiento' => $dat['fecha_vencimiento'], 
						'forma_pago_id' => $dat['forma_pago_id'], 'factura' => $dat['factura']);
		}
	}
	return $costos;
}

function get_mes_nombre($mes){
	if($mes == 1){return "Enero";}if($mes == 2){return "Febrero";}if($mes == 3){return "Marzo";}
	if($mes == 4){return "Abril";}if($mes == 5){return "Mayo";}if($mes == 6){return "Junio";}
	if($mes == 7){return "Julio";}if($mes == 8){return "Agosto";}if($mes == 9){return "Septiembre";}
	if($mes == 10){return "Octubre";}if($mes == 11){return "Noviembre";}if($mes == 12){return "Diciembre";}

}

function get_numero_mes($mes){
	if($mes == "Enero"){return 1;}if($mes == "Febrero"){return 2;}if($mes == "Marzo"){return 3;}
	if($mes == "Abril"){return 4;}if($mes == "Mayo"){return 5;}if($mes == "Junio"){return 6;}
	if($mes == "Julio"){return 7;}if($mes == "Agosto"){return 8;}if($mes == "Septiembre"){return 9;}
	if($mes == "Octubre"){return 10;}if($mes == "Noviembre"){return 11;}if($mes == "Diciembre"){return 12;}
}

function get_tipos_costos(){
	$tipos_costos = null;
	$sql = "select * from ayahuaska.tipos_costos
			order by nombre asc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$tipos_costos[] = array('id' =>$dat['id'], 'nombre' =>$dat['nombre']);
		}
	}
	return $tipos_costos;
}

function inserta_tipo_costo($nombre){
	$sql = "insert into ayahuaska.tipos_costos (nombre) values ('".$nombre."')";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function get_tipo_costo_id($id){
	$sql = "select * from ayahuaska.tipos_costos where id = ".$id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat;
}



function actualiza_tipo_costo($nombre, $id){
	$sql = "update ayahuaska.tipos_costos set nombre = '".$nombre."' where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function elimina_tipo_costo($id){
	$sql = "delete from ayahuaska.tipos_costos where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}


function inserta_costo($nombre, $monto, $fecha, $fecha_vencimiento, $tipo_costo, $usuario_id, $fpago, $factura){
	if($factura == "")
		$factura = 0;
	 $sql = "insert into ayahuaska.costos (nombre, tipo_costo_id, monto, fecha, usuario_id, fecha_vencimiento, forma_pago_id, factura) 
	values ('".$nombre."', ".$tipo_costo.", ".$monto.", '".$fecha."', ".$usuario_id.", '".$fecha_vencimiento."', $fpago, $factura)";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function actualiza_costo($nombre, $monto, $fecha, $fecha_vencimiento, $tipo_costo, $usuario_id, $id, $fpago, $factura){
	if($factura == "")
		$factura = 0;
	$sql = "update ayahuaska.costos set nombre = '".$nombre."', tipo_costo_id = ".$tipo_costo.", monto = ".$monto.", 
			fecha = '".$fecha."', usuario_id = ".$usuario_id.", fecha_vencimiento = '".$fecha_vencimiento."', forma_pago_id=$fpago, factura=$factura
			 where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}



function elimina_costo($id){
	$sql = "delete from ayahuaska.costos where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}


function get_all_eventos(){
	$eventos = null;
	$sql = "select * from ayahuaska.eventos order by nombre asc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$eventos[] = array('id' => $dat['id'], 'nombre' => $dat['nombre']
							, 'descripcion' => $dat['descripcion'], 'usuario_id' => $dat['usuario_id']
							, 'fecha' => $dat['fecha'], 'hora' => $dat['hora'], 'estado' => $dat['estado']);
		}
	}
	return $eventos;
}

function get_evento_by_id($id){
	$sql = "select * from ayahuaska.eventos where id=".$id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat;
}

function get_eventos_activos($estado){
	$eventos = null;
	$sql = "select * from ayahuaska.eventos where estado = ".$estado."";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$eventos[] = array('id' => $dat['id'], 'nombre' => $dat['nombre']
							, 'descripcion' => $dat['descripcion'], 'usuario_id' => $dat['usuario_id']
							, 'fecha' => $dat['fecha'], 'hora' => $dat['hora'], 'estado' => $dat['estado']);
		}
	}
	return $eventos;
}

function get_imagen_evento($evento_id){
	$sql = "select * from imagenes_eventos where evento_id = ".$evento_id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat;
}

function get_puntos_socio($socio_id, $estado){
	$sql = "select sum(monto) as Tot_consumo from compras_socios 
            where socio_id=".$socio_id." and estado=".$estado."";
    $res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['Tot_consumo'];
}

function get_puntos_canjeados(){
	$puntos = null;
	$sql = "select * from ayahuaska.descuentos_puntos_socios order by fecha asc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$puntos[] = array('id' => $dat['id'], 'monto' => $dat['monto']
							, 'fecha' => $dat['fecha'], 'hora' => $dat['hora']
							, 'socio_id' => $dat['socio_id']);
		}
	}
	return $puntos;
}

function redondeo($numero){
	$unidad = $numero  % 10;
	if($unidad <= 5){
		$numero = $numero - $unidad;
	}
	else if($unidad > 5){
		$numero = $numero + (10 - $unidad);
	}

	return $numero;
}

function inserta_descuento_puntos_socio($socio_id, $monto, $venta_id){
	$sql = "insert into ayahuaska.descuentos_puntos_socios (monto, fecha, hora, socio_id, venta_id) 
			values (".$monto.", '".date("Y-m-d")."', '".date("H:i:s")."', ".$socio_id.", ".$venta_id.")";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function actualiza_puntos_socios($socio_id, $estado){
	$sql = "update ayahuaska.compras_socios set estado = ".$estado." where socio_id = ".$socio_id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function notifica_canjie_puntos($socio_id, $monto, $venta_id, $mesa, $nombre){
	enviarcorreonotificacioncanje($socio_id, $monto, $venta_id, $mesa, $nombre);
}

function get_descuento_puntos($venta_id){
	$sql = "select monto from ayahuaska.descuentos_puntos_socios where venta_id = ".$venta_id."";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		$dat = mysql_fetch_array($res);
		$desc = $dat['monto'];
	}
	else{
		$desc = 0;
	}
	return $desc;
}




function get_ventas_fecha($fecha){
	$cierres = null;
	// $sql = "select ayahuaska.ventas_pagos.valor, ayahuaska.ventas.fecha as venta_fecha, ayahuaska.ventas.hora as venta_hora,
	// 		ayahuaska.ventas_pagos.venta_id, ayahuaska.ventas_pagos.forma_pago_id, ayahuaska.ventas.usuario_id, 
	// 		ayahuaska.ventas.boleta, 
	// 		ayahuaska.ventas.mesa_id, ayahuaska.ventas.estado, ayahuaska.ventas.fecha_full
	// 		from ayahuaska.ventas_pagos inner join ayahuaska.ventas
 //            on (ventas_pagos.venta_id = ventas.id)
 //            where ventas_pagos.fecha like '".$fecha."'
 //            and ventas.estado <> -1 order by ventas_pagos.venta_id asc";

    $sql = "select ayahuaska.ventas_pagos.valor, ayahuaska.ventas.fecha as venta_fecha, ayahuaska.ventas.hora as venta_hora,
			ayahuaska.ventas_pagos.venta_id, ayahuaska.ventas_pagos.forma_pago_id, ayahuaska.ventas.usuario_id, 
			ayahuaska.ventas.boleta, 
			ayahuaska.ventas.mesa_id, ayahuaska.ventas.estado, ayahuaska.ventas.fecha_full, ayahuaska.ventas_pagos.id as venta_pago_id
			from ayahuaska.ventas_pagos inner join ayahuaska.ventas
            on (ventas_pagos.venta_id = ventas.id)
            where ventas_pagos.fecha like '".$fecha."'
            and ventas.estado <> -1 order by ventas_pagos.venta_id asc";
    $res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$cierres[] = array('valor' => $dat['valor'], 'fecha' =>$dat['venta_fecha']
									, 'hora' =>$dat['venta_hora'] , 'venta_id' =>$dat['venta_id']
									, 'forma_pago_id' =>$dat['forma_pago_id'], 'usuario_id' =>$dat['usuario_id']
									, 'boleta' =>$dat['boleta'], 'mesa_id' =>$dat['mesa_id']
									, 'estado' =>$dat['estado'], 'fecha_full' =>$dat['fecha_full'], 'venta_pago_id' =>$dat['venta_pago_id']);
		}
	}

	return $cierres;
}

function get_ventas_eliminadas_by_fecha($fecha, $estado){
	$ventas = null;
	$sql = "select * from ayahuaska.ventas where fecha like '".$fecha."'
            and estado = -1 order by id asc";
    $res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$ventas[] = array('id' => $dat['id'], 'fecha' =>$dat['fecha']
									, 'hora' =>$dat['hora'] , 'estado' =>$dat['estado']
									, 'boleta' =>$dat['boleta'], 'mesa_id' =>$dat['mesa_id']
									, 'usuario_id' =>$dat['usuario_id'], 'fecha_full' =>$dat['fecha_full']);
		}
	}

	return $ventas;
}

function get_movimientos_stock_by_prod($producto_id){
	$stocks = null;
	$sql = "select * from ayahuaska.stock where PRODUCTO_ID = ".$producto_id." 
			order by STOCK_FECHA desc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$stocks[] = array('venta_id' => $dat['venta_id'], 'fecha' =>$dat['STOCK_FECHA']
							, 'cantidad' =>$dat['STOCK_CANTIDAD'], 'usuario_id' =>$dat['usuario_id']);
		}
	}

	return $stocks;
}

function get_movimientos_stock_compra_by_prod($producto_id){
	$stocks = null;
	$sql = "select * from ayahuaska.stock_compras where PRODUCTO_ID = ".$producto_id." ";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$stocks[] = array('compra_id' => $dat['COMPRA_ID']
							, 'cantidad' =>$dat['STOCK_COMPRAS_CANTIDAD']);
		}
	}

	return $stocks;
}

function get_compra_by_stock_compra($compra_id){
	$sql = "select fecha, num_factura, usuario_id from compras where id = ".$compra_id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat;
}


function get_reportes_utilidades_fecha_rango($fecha_inicial, $fecha_final){
	$reportes = null;
	$sql = "select sum(cantidad) as CANT, ventas_detalles.preparado_id,
			preparados.PREPARADOS_NOMBRE, preparados.PREPARADOS_PRECIO
			from ayahuaska.ventas inner join ayahuaska.ventas_detalles on (ventas.id = ventas_detalles.venta_id)
			inner join preparados on (preparados.PREPARADOS_ID = ventas_detalles.preparado_id)
			where ventas.fecha between '".$fecha_inicial."' and '".$fecha_final."'
			and ventas.estado = 1
			group by preparados.PREPARADOS_ID order by CANT desc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$reportes[] = array('cantidad' =>$dat['CANT'], 'preparado_id' => $dat['preparado_id']
								, 'preparado_nombre' =>$dat['PREPARADOS_NOMBRE']
								, 'preparado_precio' => $dat['PREPARADOS_PRECIO']);
		}
	}
	return $reportes;
}

function get_reportes_utilidades_dia($dia){
	$reportes = null;
	$sql = "select sum(cantidad) as CANT, ventas_detalles.preparado_id,
			preparados.PREPARADOS_NOMBRE, preparados.PREPARADOS_PRECIO
			from ayahuaska.ventas inner join ayahuaska.ventas_detalles on (ventas.id = ventas_detalles.venta_id)
			inner join preparados on (preparados.PREPARADOS_ID = ventas_detalles.preparado_id)
			where ventas.fecha = '".$dia."' 
			and ventas.estado = 1
			group by preparados.PREPARADOS_ID order by CANT desc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$reportes[] = array('cantidad' =>$dat['CANT'], 'preparado_id' => $dat['preparado_id']
								, 'preparado_nombre' =>$dat['PREPARADOS_NOMBRE']
								, 'preparado_precio' => $dat['PREPARADOS_PRECIO']);
		}
	}
	return $reportes;
}

function get_reportes_utilidades_mes($mes, $anio){
	if($mes < 10){
		$mes = "0".$mes;
	}
	$fechafiltro = $anio."-".$mes."-%";
	$reportes = null;
	$sql = "select sum(cantidad) as CANT, ventas_detalles.preparado_id,
			preparados.PREPARADOS_NOMBRE, preparados.PREPARADOS_PRECIO
			from ayahuaska.ventas inner join ayahuaska.ventas_detalles on (ventas.id = ventas_detalles.venta_id)
			inner join preparados on (preparados.PREPARADOS_ID = ventas_detalles.preparado_id)
			where ventas.fecha like '".$fechafiltro."'
			and ventas.estado = 1
			group by preparados.PREPARADOS_ID order by CANT desc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$reportes[] = array('cantidad' =>$dat['CANT'], 'preparado_id' => $dat['preparado_id']
								, 'preparado_nombre' =>$dat['PREPARADOS_NOMBRE']
								, 'preparado_precio' => $dat['PREPARADOS_PRECIO']);
		}
	}
	return $reportes;
}


function get_reportes_utilidades_anio($anio){
	$fechafiltro = $anio."-%-%";
	$reportes = null;
	$sql = "select sum(cantidad) as CANT, ventas_detalles.preparado_id,
			preparados.PREPARADOS_NOMBRE, preparados.PREPARADOS_PRECIO
			from ayahuaska.ventas inner join ayahuaska.ventas_detalles on (ventas.id = ventas_detalles.venta_id)
			inner join preparados on (preparados.PREPARADOS_ID = ventas_detalles.preparado_id)
			where ventas.fecha like '".$fechafiltro."'
			and ventas.estado = 1
			group by preparados.PREPARADOS_ID order by CANT desc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$reportes[] = array('cantidad' =>$dat['CANT'], 'preparado_id' => $dat['preparado_id']
								, 'preparado_nombre' =>$dat['PREPARADOS_NOMBRE']
								, 'preparado_precio' => $dat['PREPARADOS_PRECIO']);
		}
	}
	return $reportes;
}



//FIN CONTROLADORES DE COSTOS SISTEMA

// FIN CONTROLADOR DE REPORTES DEL SISTEMA



//NUEVO METODO DE PEDIDO

function inserta_venta_detalle2($preparado_id, $vta_id, $fecha, $hora, $npedido){
	$observacion = "";
	echo $sqle = "select cantidad from ayahuaska.ventas_detalles where venta_id = ".$vta_id." and preparado_id=".$preparado_id."
			and estado = 0 and npedido = ".$npedido."";
	$rese = mysql_query($sqle);
	$tote = mysql_num_rows($rese);
	if($tote > 0){
		$date = mysql_fetch_array($rese);
		$totnueva = 1 + $date['cantidad'];
		$sql = "update ayahuaska.ventas_detalles set cantidad = ".$totnueva." where venta_id = ".$vta_id." and preparado_id=".$preparado_id."
			and estado = 0 and npedido = ".$npedido."";
		if(mysql_query($sql)){
			return true;
		}
		else{
			return false;
		}	
	}
	else{
		echo $sql = "insert into ayahuaska.ventas_detalles(cantidad, npedido, observacion, estado, fecha, hora, preparado_id, venta_id)
			values (1, ".$npedido.", '".$observacion."', 0, '".$fecha."', '".$hora."', 
					".$preparado_id.", ".$vta_id.")";

		if(mysql_query($sql)){
			return true;
		}
		else{
			return false;
		}
	}
}

function get_ventas_detalles_by_id($vta_id){
	$vtas_dtalles = null;
	$sql = "select * from ayahuaska.ventas_detalles where venta_id = ".$vta_id."";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$vtas_dtalles[] = array('cantidad' =>$dat['cantidad'], 'preparado_id' => $dat['preparado_id'], 'id' => $dat['id']);
		}
	}
	return $vtas_dtalles;
}




function get_reportes_costos_mes($mes, $anio){
	if($mes < 10){
		$mes = "0".$mes;
	}
	
	$fechafiltro = $anio."-".$mes."-%";
	$reportes = null;
	$sql = "select sum(monto) as COSTO, nombre, tipo_costo_id
			from ayahuaska.costos where costos.fecha like '".$fechafiltro."'
			group by nombre, tipo_costo_id order by COSTO desc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$reportes[] = array('costo' =>$dat['COSTO']
								, 'nombre' =>$dat['nombre']
								, 'tipo_costo_id' => $dat['tipo_costo_id']);
		}
	}
	return $reportes;
}

function get_reportes_costos_anio($anio){
	$fechafiltro = $anio."-%-%";
	$reportes = null;
	 $sql = "select sum(monto) as COSTO, nombre, tipo_costo_id
			from ayahuaska.costos where costos.fecha like '".$fechafiltro."'
			group by nombre, tipo_costo_id order by COSTO desc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$reportes[] = array('costo' =>$dat['COSTO']
								, 'nombre' =>$dat['nombre']
								, 'tipo_costo_id' => $dat['tipo_costo_id']);
		}
	}
	return $reportes;
}

function get_reportes_costos_general($anio){
	$fechafiltro = $anio."-%-%";
	$reportes = null;
	$sql = "select MONTH(Fecha) Mes, sum(monto) as COSTO
			from ayahuaska.costos where costos.fecha like '".$fechafiltro."'
			group by Mes";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$reportes[] = array('costo' =>$dat['COSTO']
								, 'mes' =>$dat['Mes']
								);
		}
	}
	return $reportes;
}


function get_reportes_utilidades_general($anio){
	$fechafiltro = $anio."-%-%";
	$reportes = null;
	$sql = "select sum(preparados.PREPARADOS_PRECIO*ventas_detalles.cantidad) as UTIL, MONTH(ventas.fecha) Mes
			from ayahuaska.ventas inner join ayahuaska.ventas_detalles on (ventas.id = ventas_detalles.venta_id)
			inner join preparados on (preparados.PREPARADOS_ID = ventas_detalles.preparado_id)
			where ventas.fecha like '".$fechafiltro."'
			and ventas.estado = 1
			group by Mes";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$reportes[] = array('utilidad_bruta' =>$dat['UTIL'], 'mes' => $dat['Mes']
								);
		}
	}
	return $reportes;
}




function get_all_familias_karaokes(){
	$familias_karaokes = null;
	$sql = "select * from ayahuaska.familias_karaokes
			order by nombre asc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$familias_karaokes[] = array('id' =>$dat['id'], 'nombre' =>$dat['nombre']);
		}
	}
	return $familias_karaokes;
}




function inserta_familia_kareaoke($nombre){
	$sql = "insert into ayahuaska.familias_karaokes (nombre) 
	values ('".$nombre."')";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}


function get_familia_karaoke($id){
	$sql = "select * from ayahuaska.familias_karaokes where id = ".$id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat;
}

function actualiza_familia_kareaoke($nombre, $id){
	$sql = "update ayahuaska.familias_karaokes set nombre = '".$nombre."' where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function elimina_familia_kareaoke($id){
	$sql = "delete from ayahuaska.familias_karaokes where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function get_all_canciones_by_familia($familia_id){
	$canciones = null;
	$sql = "select * from ayahuaska.karaokes where familia_karaoke_id = ".$familia_id."
			order by nombre asc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$canciones[] = array('id' =>$dat['id'], 'nombre' =>$dat['nombre']
								, 'artista' =>$dat['artista'] , 'fecha' =>$dat['fecha']
								, 'familia_karaoke_id' =>$dat['familia_karaoke_id']);
		}
	}
	return $canciones;
}

function inserta_cancion($nombre, $artista, $familia){
	$sql = "insert into ayahuaska.karaokes (nombre, artista, fecha, familia_karaoke_id) 
	values ('".$nombre."', '".$artista."', '".date("Y-m-d")."', ".$familia.")";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function get_cancion_by_id($id){
	$sql = "select * from ayahuaska.karaokes where id = ".$id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat;
}

function actualiza_cancion($nombre, $artista, $id){
	$sql = "update ayahuaska.karaokes set nombre = '".$nombre."', artista = '".$artista."' where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function elimina_cancion($id){
	$sql = "delete from ayahuaska.karaokes where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}


function solicitar_cancion($cancion_id, $mesa_id){
	$sqlv = "select mesa_id from karaokes_pedidos where estado = 0 and mesa_id = ".$mesa_id."";
	$resv = mysql_query($sqlv);
	$tot = mysql_num_rows($resv);
	if($tot >= 2){
		return false;
	}
	else{
		$sql = "insert into ayahuaska.karaokes_pedidos (fecha, hora, karaoke_id, mesa_id, estado) 
		values ('".date("Y-m-d")."', '".date("H:i:s")."', ".$cancion_id.", ".$mesa_id.", 0)";
		if(mysql_query($sql)){
			return true;
		}
		else{
			return false;
		}
	}
}

function get_karaokes_by_estado($estado){
	$canciones = null;
	$sql = "select * from ayahuaska.karaokes_pedidos where estado = ".$estado."
			order by id asc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$canciones[] = array('id' =>$dat['id'], 'fecha' =>$dat['fecha']
								, 'hora' =>$dat['hora'] , 'karaoke_id' =>$dat['karaoke_id']
								, 'mesa_id' =>$dat['mesa_id'], 'estado' =>$dat['estado']);
		}
	}
	return $canciones;
}


function cambia_estado_pedido_karaoke($id){
	$sql = "update ayahuaska.karaokes_pedidos set estado = 1 where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}


function get_galeria(){
	$galerias = null;
	$sql = "select * from ayahuaska.galerias order by fecha desc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$galerias[] = array('nombre' =>$dat['nombre'], 'fecha' => $dat['fecha'], 'id' => $dat['id']
								);
		}
	}
	return $galerias;
}


function get_perfil(){
	$perfiles = null;
	$sql = "select * from ayahuaska.perfiles";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$galerias[] = array('nombre' =>$dat['nombre'], 'correo' => $dat['correo'], 'id' => $dat['id']
								, 'telefono' => $dat['telefono'], 'direccion' => $dat['direccion'], 'sitio' => $dat['sitio']
								);
		}
	}
	return $galerias;
}

function get_num_factura(){
	$sql = "select max(id) as maxid from ayahuaska.compras";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['maxid'] + 1;
}

function get_num_oc(){
	$sql = "select max(id) as maxid from ayahuaska.ordenes_compras";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['maxid'] + 1;
}


function inserta_compra2($id, $numerofactura, $proveedor, $fecha, $fecha_vencimiento, $fpago, $usuario_id, $descuento, $iva, $ila, $iaba, $impuesto_adicional, $servicio_logistico, $retencion, $neto, $total, $cheque){
	 $sql = "insert into ayahuaska.compras(id, fecha, fecha_vencimiento, num_factura, descuento, iva, ila, iaba, impuesto_adicional, servicio_logistico, retencion, neto, total,estado, proveedor_id, forma_pago_compra_id, usuario_id, num_cheque)
			values (".$id.", '".$fecha."', '".$fecha_vencimiento."', $numerofactura,  ".$descuento.", ".$iva.", ".$ila.", ".$iaba.", ".$impuesto_adicional.", ".$servicio_logistico.", ".$retencion.", ".$neto.", ".$total.", 0,".$proveedor.", ".$fpago.", ".$usuario_id.", ".$cheque.")";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}





function elimina_tmp($compra_id){
	$sql = "delete from ayahuaska.tmp where compra_id = ".$compra_id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function elimina_tmp_oc($oc){
	$sql = "delete from ayahuaska.tmp_oc where orden_compra_id = ".$oc."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function get_ventas_detalles_by_id_npedido($vta_id, $npedido){
	$vtas_dtalles = null;
	$sql = "select * from ayahuaska.ventas_detalles where venta_id = ".$vta_id." and npedido = ".$npedido."";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$vtas_dtalles[] = array('observacion' =>$dat['observacion'], 'cantidad' =>$dat['cantidad'], 'preparado_id' => $dat['preparado_id'], 'id' => $dat['id']);
		}
	}
	return $vtas_dtalles;
}

function get_comensales($id){
	$sql = "select comensales from ayahuaska.ventas where id = ".$id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['comensales'];
}


function inserta_temp_ventas_detalles($venta_id, $preparado_id, $cantidad_antes, $cantidad_nueva, $npedido){
	$sql = "insert into ayahuaska.temp_ventas_detalles (estado, preparado_id, cantidad, venta_id, npedido) values (0, ".$preparado_id.", ".$cantidad_nueva.", ".$venta_id.", ".$npedido.")";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function get_cantidad_venta_temporal($venta_id, $preparado_id, $estado, $npedido){
	$sql = "select SUM(cantidad) as cant from ayahuaska.temp_ventas_detalles where venta_id = ".$venta_id." and preparado_id= ".$preparado_id." and npedido = ".$npedido."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['cant'];
}

function hay_pago_temporal($venta_id, $estado){
	$sql = "select cantidad from ayahuaska.temp_ventas_detalles where venta_id = ".$venta_id." and estado = ".$estado."";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		return true;
	}
	else{
		return false;
	}
}


function get_ventas_detalles_temporal_id($vta_id){
	$vtas_detalles = null;
	$sql = "select * from ayahuaska.temp_ventas_detalles where venta_id = ".$vta_id." and estado = 0";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$vtas_detalles[] = array('id' => $dat['id'], 'cantidad' =>$dat['cantidad'], 'npedido' => $dat['npedido'],								
								'preparado_id' => $dat['preparado_id'],
								'venta_id' => $dat['venta_id']);
		}
	}
	return $vtas_detalles;
}

function actualiza_estado_temp_ventas_datalles($venta_id, $estado){
	$sql = "update ayahuaska.temp_ventas_detalles set estado = ".$estado." where venta_id = ".$venta_id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}


function inserta_motivo_eliminacion($venta_id, $motivo, $usuario_id){
	$sql = "insert into ayahuaska.ventas_eliminadas (fecha, hora, motivo, venta_id, usuario_id) values ('".date("Y-m-d")."', '".date("H:i:s")."', '".$motivo."', ".$venta_id.", ".$usuario_id.")";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function get_motivo_eliminado($venta_id){
	$sql = "select motivo from ayahuaska.ventas_eliminadas where venta_id = ".$venta_id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['motivo'];
}


function get_ventas_detalles_id2($venta_id, $estado){
	$vtas_detalles = null;
	$sql = "select * from ayahuaska.ventas_detalles where venta_id = ".$venta_id." and estado = ".$estado."";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$vtas_detalles[] = array('id' => $dat['id'], 'cantidad' =>$dat['cantidad'], 'npedido' => $dat['npedido'],
								'observacion' => $dat['observacion'],
								'preparado_id' => $dat['preparado_id'],
								'fecha' => $dat['fecha'],
								'hora' => $dat['hora'],
								'venta_id' => $dat['venta_id']);
		}
	}
	return $vtas_detalles;
}

function actualiza_estado_venta_detalle($venta_id, $estado){
	$sql = "update ayahuaska.ventas_detalles set estado = ".$estado." where venta_id = ".$venta_id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function get_correo_socio($socio_id){
	$sql = "select correo from ayahuaska.socios where id = ".$socio_id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['correo'];
}


function suma_pagos_by_mov($venta_id){
	$sql = "select SUM(valor) as pagado from ayahuaska.ventas_pagos where venta_id = ".$venta_id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['pagado'];
}




// -------------------- FUNCIONES AGREGADAS A SHEOL ---------------------- //

function get_estado_cover($id){
	$sql = "select cover from ayahuaska.ventas where id = ".$id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['cover'];
}

function inserta_vta2($fecha, $hora, $estado, $mesa, $usuario, $fecha_full, $turno, $comensales, $cover){
	$sql = "insert into ayahuaska.ventas(fecha, hora, estado, mesa_id, usuario_id, fecha_full, turno, comensales, cover)
			values ('".$fecha."', '".$hora."', ".$estado.", ".$mesa.", ".$usuario.", '".$fecha_full."', ".$turno.", ".$comensales.", ".$cover.")";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function actualiza_estado_cover($id){
	$sql = "update ayahuaska.ventas set cover = 1 where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}


function get_all_impresoras(){
	$impresoras = null;
	$sql = "select * from ayahuaska.impresoras order by nombre asc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$impresoras[] = array('id' => $dat['id'], 'nombre' => $dat['nombre'], 'visible' => $dat['visible'], 'url' => $dat['url']);
		}
	}
	return $impresoras;
}

function get_impresora_id($id){
	$sql = "select nombre from ayahuaska.impresoras where id = ".$id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['nombre'];
}

function get_impresora_url($id){
	$sql = "select url from ayahuaska.impresoras where id = ".$id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['url'];
}

function get_all_producto(){
	$productos = null;
	$sql = "select * from ayahuaska.producto";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while ($dat = mysql_fetch_array($res)) {
			$productos[] = array('id' => $dat['PRODUCTO_ID'], 'nombre' => $dat['PRODUCTO_NOMBRE'],
								'unidadinicial' => $dat['PRODUCTO_UNIDADESINICIAL'],
								'tipo_descuento' => $dat['TIPO_DESCUENTO_ID'],
								'capacidad' => $dat['PRODUCTO_CAPACIDADPORUNIDAD'],
								'stock_minimo' => $dat['PRODUCTO_STOCKMINIMO'],
								'costo' => $dat['PRODUCTO_COSTO'], 'familia_id' => $dat['FAMILIA_ID']);
		}
	}

	return $productos;
}



function get_vta_detalle_by_estado($vta_id){
	$vtas_detalles = null;
	$sql = "select * from ayahuaska.ventas_detalles where venta_id = ".$vta_id." and estado = 0";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$vtas_detalles[] = array('id' => $dat['id'], 'cantidad' =>$dat['cantidad'], 'npedido' => $dat['npedido'],
								'observacion' => $dat['observacion'],
								'preparado_id' => $dat['preparado_id'],
								'fecha' => $dat['fecha'],
								'hora' => $dat['hora'],
								'venta_id' => $dat['venta_id']);
		}
	}

	return $vtas_detalles;
}

function actualiza_estado_venta_detalle_npedio($vta_id, $estado, $npedido, $preparado_id){
	$sql = "update ayahuaska.ventas_detalles set estado = ".$estado." where venta_id = ".$vta_id." and npedido = ".$npedido." and preparado_id = ".$preparado_id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}


function inserta_preparados_happy_pedidos($venta_id, $preparado_id, $cantidad){
	$sql = "insert into ayahuaska.preparados_happy_pedidos (cantidad, estado, fecha, hora, venta_id, preparado_id)
			values (".$cantidad.", 0, '".date('Y-m-d')."', '".date('H:i:s')."', ".$venta_id.", ".$preparado_id.")";

	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}





function descuentaStock_preparados_happy($idPreparado, $cantidad, $movimiento)
  {
    $query="select * from ayahuaska.producto_preparados WHERE PREPARADOS_ID={$idPreparado}";
    $result=mysql_query($query);
    $tot=mysql_num_rows($result);
    if ($tot!=0) {
      while ($dat=mysql_fetch_array($result)) {
      	if($dat['PRODUCTO_PREPARADOS_CANTIDADESCUENTO'] == 2){
      		$cantidad_descu = $dat['PRODUCTO_PREPARADOS_CANTIDADESCUENTO'] - 1;
      	}
      	else{
      		$cantidad_descu = $dat['PRODUCTO_PREPARADOS_CANTIDADESCUENTO'];
      	}
        $cantidadDescontada = $cantidad * $cantidad_descu;
        $fechaHoy = fecha_hoy_bd();
        mysql_query ("insert INTO ayahuaska.stock (PRODUCTO_ID,STOCK_FECHA,STOCK_CANTIDAD, venta_id) VALUES ('{$dat['PRODUCTO_ID']}', '{$fechaHoy}','{$cantidadDescontada}', '{$movimiento}');");
       //  if(stock_critico($dat['PRODUCTO_ID'])){
       //  	$producto = get_id_producto_by_id($dat['PRODUCTO_ID']);
      	// 	enviarcorreostock($producto['PRODUCTO_NOMBRE'], stockUnidadBy_idProducto($dat['PRODUCTO_ID']), $producto['PRODUCTO_STOCKMINIMO']);
      	// }
      }
    }
  }


  function get_productos_onzas_by_id($venta_id){
  	$preparados = null;
  	$sql = "select preparado_id, cantidad from ayahuaska.ventas_detalles where venta_id = ".$venta_id." and estado = 0";
  	$res = mysql_query($sql);
  	$tot = mysql_num_rows($res);
  	$hay_descu = 0;
  	if($tot > 0){
  		while ($dat = mysql_fetch_array($res)) {
  			//REVISA SI ES HAPPY 
  			$es_happy = get_preparados_id($dat['preparado_id']);
  			if($es_happy['es_happy'] == 1){
  				$sql2 = "select PRODUCTO_ID, PRODUCTO_PREPARADOS_CANTIDADESCUENTO from ayahuaska.producto_preparados where PREPARADOS_ID = ".$dat['preparado_id']."";
	  			$res2 = mysql_query($sql2);
	  			while($dat2 = mysql_fetch_array($res2)){
	  				$sql3 = "select PRODUCTO_ID, TIPO_DESCUENTO_ID from producto where PRODUCTO_ID = ".$dat2['PRODUCTO_ID']." and TIPO_DESCUENTO_ID = 2";
	  				$res3 = mysql_query($sql3);
	  				while ($dat3 = mysql_fetch_array($res3)) {
  						$cant = ($dat2['PRODUCTO_PREPARADOS_CANTIDADESCUENTO'] - 1) * $dat['cantidad'];
  						$fechaHoy = fecha_hoy_bd();
    					mysql_query ("insert INTO ayahuaska.stock (PRODUCTO_ID,STOCK_FECHA,STOCK_CANTIDAD, venta_id) VALUES ('{$dat3['PRODUCTO_ID']}', '{$fechaHoy}','{$cant}', '{$venta_id}');");
    					echo "insert INTO ayahuaska.stock (PRODUCTO_ID,STOCK_FECHA,STOCK_CANTIDAD, venta_id) VALUES ('{$dat3['PRODUCTO_ID']}', '{$fechaHoy}','{$cant}', '{$venta_id}');";
    					$sqlA = "update ayahuaska.ventas_detalles set estado = 1 where venta_id = ".$venta_id."
								and preparado_id = ".$dat['preparado_id']." and estado = 0";
						mysql_query($sqlA);
						$hay_descu++;
	  				}
	  			}
  			}
  			
  		}
  	}
  	return $hay_descu;
  }


  function es_happy_canjeado($venta_detalle_id){
  	$sql = "select estado from ayahuaska.ventas_detalles where id = ".$venta_detalle_id."";
  	$res = mysql_query($sql);
  	$dat = mysql_fetch_array($res);
  	return $dat['estado'];
  }

  function get_productos_onzas_happy($preparado_id){
  	$productos = null;
  	$sql = "select PRODUCTO_ID, PRODUCTO_PREPARADOS_CANTIDADESCUENTO from ayahuaska.producto_preparados where PREPARADOS_ID = ".$preparado_id."";
	$res = mysql_query($sql);
	while($dat = mysql_fetch_array($res)){
		$sql3 = "select PRODUCTO_ID, TIPO_DESCUENTO_ID from producto where PRODUCTO_ID = ".$dat['PRODUCTO_ID']." and TIPO_DESCUENTO_ID = 2";
		$res3 = mysql_query($sql3);
		while ($dat3 = mysql_fetch_array($res3)) {
			$productos[] = array('producto_id' => $dat['PRODUCTO_ID'], 'producto_cantidad_descuento' =>$dat['PRODUCTO_PREPARADOS_CANTIDADESCUENTO']);
		}
	}

	return $productos;
  }

  function get_cantidad_pedido_vta_det_by_id($id){
  	$sql = "select cantidad from ayahuaska.ventas_detalles where id = ".$id."";
  	$res = mysql_query($sql);
  	$dat = mysql_fetch_array($res);
  	return $dat['cantidad'];
  }

  function rebajar_happy_stock($productos, $cantidad, $venta_id){
  	foreach ($productos as $key => $producto) {
  		$cant = ($producto['producto_cantidad_descuento'] -1)*$cantidad;
  		$fechaHoy = fecha_hoy_bd();
    	mysql_query ("insert INTO ayahuaska.stock (PRODUCTO_ID,STOCK_FECHA,STOCK_CANTIDAD, venta_id) VALUES ('{$producto['producto_id']}', '{$fechaHoy}','{$cant}', '{$venta_id}');");
  	}
  }

  function actualiza_estado_vta_detalle_by_id($id){
  	$sql = "update ayahuaska.ventas_detalles set estado = 1 where id = ".$id."";
	mysql_query($sql);
  }

  function get_ventas_detalles_by_vta_det_id($id){
		$vtas_detalles = null;
		$sql = "select * from ayahuaska.ventas_detalles where id = ".$id."";
		$res = mysql_query($sql);
		$tot = mysql_num_rows($res);
		if($tot > 0){
			while($dat = mysql_fetch_array($res)){
				$vtas_detalles[] = array('id' => $dat['id'], 'cantidad' =>$dat['cantidad'], 'npedido' => $dat['npedido'],
									'observacion' => $dat['observacion'],
									'preparado_id' => $dat['preparado_id'],
									'fecha' => $dat['fecha'],
									'hora' => $dat['hora'],
									'venta_id' => $dat['venta_id']);
			}
		}
		return $vtas_detalles;
	}



function elimina_vta_detalle_temporal($id){
	$sql = "delete from ayahuaska.temp_ventas_detalles where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}
// -------------------- FIN FUNCIONES AGREGADAS A SHEOL ---------------------- //



function ingresa_nueva_forma_pago3($vta_id, $totalconprop, $mesa_id, $total, $monto_pagado, $propina, $forma_pago_id, $cliente_id, $usuario_id, $boleta){

	$venta = get_venta_id($vta_id);
	if(inserta_vta_pago(($totalconprop), date("Y-m-d"), date("H:i:s"), $vta_id, $forma_pago_id, $usuario_id, date("Y-m-d H:i:s"))){
		$vta_pago_id = mysql_insert_id();
		$mesero = get_usuario_id($venta['usuario_id']);
    	$nombre_mesero = $mesero['nombre']." ".$mesero['apellido'];
    	//SI SE PAGA EL TOTAL DE LA MESA

		//actualiza_mesa($mesa_id, 0);
		//cierra_mesa_venta($vta_id);
		actualiza_boleta_venta($vta_id, $boleta);
	     
	    
	    //ACTUALIZA NRO DE BOLETA

	    if(($boleta != 0) && ($boleta != "")){
	      inserta_boleta_acutal($vta_id, $boleta, $vta_pago_id);
	      actauliza_bol_actual($boleta);
	    }
	    if($propina > 0){
	      inserta_venta_propina($vta_id, $propina, 0, $vta_pago_id);
	    }
	    if($forma_pago_id == 3){
	      inserta_cta_cte(date("Y-m-d"), date("H:i:s"), ($totalconprop), $cliente_id, 1, $vta_id);
	      $cliente = get_cliente_id($cliente_id);
	      $nombrecli = $cliente['nombre'];
	      $rutcli = $cliente['rut'];
	      $correocli = $cliente['correo'];
	      // ENVIAR CORREO NOTIFICANDO DEUDA
	      //include("../phpmailer/sendmail.php");
	      generar_correo_carga_cta_cte($nombrecli, $rutcli, $vta_id, ($totalconprop), date("H:i:s"), $nombre_mesero, $correocli, $vta_pago_id);
	    }
	    $venta_socio = get_vta_socio_id($vta_id);
	    if($venta_socio != ""){
	      $nombre_socio = get_nombre_socio($venta_socio);
	      inserta_compra_socio($vta_id, $venta_socio, 0, ($totalconprop));
	    }
	    else{
	    	$nombre_socio = "";
	    }
	    //valida_stock_critico($vta_id);
		
	    return true;
	}
	else{
		return false;
	}
	
}

if(isset($_GET['elimina_sobrantes'])){
    $sql = "select * from ayahuaska.producto 
	    left join ayahuaska.familias 
	    on (producto.FAMILIA_ID = familias.id)
	    where familias.id is null";
    $res = mysql_query($sql);
    while($dat = mysql_fetch_array($res)){
      echo "ELIMINANDO: ".$dat['PRODUCTO_NOMBRE']."<br>";
      $sq = "delete from ayahuaska.producto where PRODUCTO_ID = ".$dat['PRODUCTO_ID']."";
      mysql_query($sq);
    }
}


function get_all_ccs(){
	$ccs = null;
	$sql = "select * from ayahuaska.ccs
			order by cc asc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$ccs[] = array('id' =>$dat['id'], 'cc' =>$dat['cc'], 'onzas' =>$dat['onzas']);
		}
	}
	return $ccs;
}

function ingresa_nuevo_cc($cc, $onzas){
	$sql = "insert into ayahuaska.ccs (cc, onzas) 
			values ('".$cc."', ".$onzas.")";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function get_cc_by_id($id){
	$sql = "select * from ayahuaska.ccs where id = ".$id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat;
}

function elimina_cc($id){
	$sql = "delete from ayahuaska.ccs where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function actualiza_cc($cc, $onzas, $id){
	echo $sql = "update ayahuaska.ccs set cc = '".$cc."', onzas = ".$onzas." where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}







function get_all_egresos(){
	$datos = null;
	$sql = "select * from ayahuaska.egresos order by id asc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$datos[] = array('id' => $dat['id'], 'monto' => $dat['monto']
							, 'fecha' => $dat['fecha'], 'hora' => $dat['hora']
							, 'usuario_id' => $dat['usuario_id'], 'motivo' => $dat['motivo']);
		}
	}
	return $datos;
}


function inserta_egreso($monto, $motivo, $usuario_id){
	$sql = "insert into ayahuaska.egresos (monto, fecha, hora, usuario_id, motivo, fecha_full) values ($monto, '".date("Y-m-d")."', '".date("H:i:s")."', '$usuario_id', '$motivo', '".date("Y-m-d H:i:s")."')";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}


function elimina_egreso($id){
	$sql = "delete from ayahuaska.egresos where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function get_egreso_datos($id){
	$sql = "select * from ayahuaska.egresos where id=".$id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat;
}

function actualiza_egreso($monto, $motivo, $id){
	$sql = "update ayahuaska.egresos set monto = $monto, motivo = '$motivo' where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}



function get_egresos_fecha($fecha_inicial, $fecha_final){
	$egresos = null;
	$sql = "select * from ayahuaska.egresos where fecha_full between '$fecha_inicial' and '$fecha_final'";
    $res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$egresos[] = array('monto' => $dat['monto'], 'fecha' =>$dat['fecha']
									, 'hora' =>$dat['hora'] , 'usuario_id' =>$dat['usuario_id']
									, 'motivo' =>$dat['motivo']);
		}
	}

	return $egresos;
}

function get_egresos_fecha_usuario($fecha_inicial, $fecha_final, $usuario_id){
	$egresos = null;
	$sql = "select * from ayahuaska.egresos where fecha_full between '$fecha_inicial' and '$fecha_final' and usuario_id = $usuario_id ";
    $res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$egresos[] = array('monto' => $dat['monto'], 'fecha' =>$dat['fecha']
									, 'hora' =>$dat['hora'] , 'usuario_id' =>$dat['usuario_id']
									, 'motivo' =>$dat['motivo']);
		}
	}

	return $egresos;
}

function get_egresos_fecha2($fecha_inicial1, $fecha_final1, $fecha_inicial2, $fecha_final2){
	$egresos = null;
	 $sql = "select * from ayahuaska.egresos where ((fecha_full between '".$fecha_inicial1."' and '".$fecha_final1."') or
            (fecha_full between '".$fecha_inicial2."' and '".$fecha_final2."'))  ";
    $res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$egresos[] = array('monto' => $dat['monto'], 'fecha' =>$dat['fecha']
									, 'hora' =>$dat['hora'] , 'usuario_id' =>$dat['usuario_id']
									, 'motivo' =>$dat['motivo']);
		}
	}

	return $egresos;
}

function get_egresos_fecha2_usuario($fecha_inicial1, $fecha_final1, $fecha_inicial2, $fecha_final2, $usuario_id){
	$egresos = null;
	$sql = "select * from ayahuaska.egresos where ((fecha_full between '".$fecha_inicial1."' and '".$fecha_final1."' or
             fecha_full between '".$fecha_inicial2."' and '".$fecha_final2."'))  and usuario_id = $usuario_id ";
    $res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$egresos[] = array('monto' => $dat['monto'], 'fecha' =>$dat['fecha']
									, 'hora' =>$dat['hora'] , 'usuario_id' =>$dat['usuario_id']
									, 'motivo' =>$dat['motivo']);
		}
	}

	return $egresos;
}


function get_egresos_by_fecha($fecha){
	$egresos = null;
	$sql = "select * from ayahuaska.egresos where fecha like '".$fecha."'
           order by id asc";
    $res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$egresos[] = array('monto' => $dat['monto'], 'fecha' =>$dat['fecha']
									, 'hora' =>$dat['hora'] , 'usuario_id' =>$dat['usuario_id']
									, 'motivo' =>$dat['motivo']);
		}
	}

	return $egresos;
}




function elimina_compra_by_id($id){
	$sqldet = "delete from ayahuaska.compras_detalles where compra_id = $id";
	mysql_query($sqldet);
	$sqlcomp = "delete from ayahuaska.compras where id=$id";
	mysql_query($sqlcomp);
	$sqlstock = "delete from ayahuaska.stock_compras where COMPRA_ID=$id";
	mysql_query($sqlstock);
	return true;
}











function inserta_compra_detalle2($compra_id){
	$sql = "select * from ayahuaska.tmp where compra_id = ".$compra_id."";
	$res = mysql_query($sql);
	while ($dat = mysql_fetch_array($res)) {
		$sql = "insert into ayahuaska.compras_detalles(cantidad, precio, producto_id, compra_id, formato_id)
			values(".$dat['cantidad'].", ".$dat['precio'].", ".$dat['producto_id'].", ".$compra_id.", ".$dat['formato_id'].")";
		mysql_query($sql);
		aumenta_stock($dat['producto_id'], $dat['cantidad'], $compra_id);
	}
}

function get_compras_detalles($compra_id){
	$detalles = null;
	$sql = "select * from ayahuaska.compras_detalles where compra_id = ".$compra_id."";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$detalles[] = array('id' => $dat['id'], 'cantidad' =>$dat['cantidad']
									, 'precio' =>$dat['precio'] , 'producto_id' =>$dat['producto_id']
									, 'compra_id' =>$dat['compra_id'], 'formato_id' =>$dat['formato_id']);
		}
	}
	return $detalles;
}



function get_formato_by_id($id){
	$sql = "select * from ayahuaska.ccs where id = $id";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['onzas'];
}


//NUEVO AGREGA RETORNA STOCK MIN
function get_stock_min($id){
	$query="select PRODUCTO_STOCKMINIMO from ayahuaska.producto WHERE PRODUCTO_ID={$id}";
    $result=mysql_query($query);
    $dat=mysql_fetch_array($result);
    return intval($dat['PRODUCTO_STOCKMINIMO']);
}

function get_enteros($onzas){
	$onzas = intval($onzas);
	if($onzas == 0){ return 0; }
	else { return $onzas/12; }
}






function get_top_productos(){
	$detalles = null;
	$sql = "select preparado_id, SUM(cantidad) as TOTAL, ventas_detalles.preparado_id, preparados.PREPARADOS_NOMBRE, preparados.PREPARADOS_PRECIO
	 from   ventas inner join ventas_detalles on (ventas.id = ventas_detalles.venta_id) inner join preparados on (preparados.PREPARADOS_ID = ventas_detalles.preparado_id) where ventas.estado = 1 group by preparado_id order by SUM(cantidad) DESC limit 15;";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$detalles[] = array('preparado_id' => $dat['preparado_id'], 'total' =>$dat['TOTAL']
								, 'preparado_nombre' =>$dat['PREPARADOS_NOMBRE'], 'precio' => $dat['PREPARADOS_PRECIO']);
		}
	}
	return $detalles;
}

function get_menos_productos(){
	$detalles = null;
	$sql = "select preparado_id, SUM(cantidad) as TOTAL, ventas_detalles.preparado_id, preparados.PREPARADOS_NOMBRE, preparados.PREPARADOS_PRECIO
	 from   ventas inner join ventas_detalles on (ventas.id = ventas_detalles.venta_id) inner join preparados on (preparados.PREPARADOS_ID = ventas_detalles.preparado_id) 
	 where ventas.estado = 1 group by preparado_id 
	 order by SUM(cantidad) ASC limit 15;";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$detalles[] = array('preparado_id' => $dat['preparado_id'], 'total' =>$dat['TOTAL']
								, 'preparado_nombre' =>$dat['PREPARADOS_NOMBRE'], 'precio' => $dat['PREPARADOS_PRECIO']);
		}
	}
	return $detalles;
}


function get_all_formas_pagos2(){
	$formas_pagos = null;
	$sql = "select * from ayahuaska.formas_pagos where id != 5 order by descripcion asc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$formas_pagos[] = array('id' => $dat['id'], 'descripcion' =>$dat['descripcion']);
		}
	}
	return $formas_pagos;
}





function get_ventas_entre_fechas($fechai, $fechaf){
	$cierres = null;
	 $sql = "select ayahuaska.ventas_pagos.valor, ayahuaska.ventas.fecha as venta_fecha, ayahuaska.ventas.hora as venta_hora,
			ayahuaska.ventas_pagos.venta_id, ayahuaska.ventas_pagos.forma_pago_id, ayahuaska.ventas.usuario_id, 
			ayahuaska.ventas.boleta, 
			ayahuaska.ventas.mesa_id, ayahuaska.ventas.estado, ayahuaska.ventas.fecha_full, ayahuaska.ventas_pagos.id as venta_pago_id
			from ayahuaska.ventas_pagos inner join ayahuaska.ventas
            on (ventas_pagos.venta_id = ventas.id)
            where (ventas_pagos.fecha between '".$fechai."' and '".$fechaf."')
            and ventas.estado <> -1 order by ventas_pagos.venta_id asc";
    $res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$cierres[] = array('valor' => $dat['valor'], 'fecha' =>$dat['venta_fecha']
									, 'hora' =>$dat['venta_hora'] , 'venta_id' =>$dat['venta_id']
									, 'forma_pago_id' =>$dat['forma_pago_id'], 'usuario_id' =>$dat['usuario_id']
									, 'boleta' =>$dat['boleta'], 'mesa_id' =>$dat['mesa_id']
									, 'estado' =>$dat['estado'], 'fecha_full' =>$dat['fecha_full'], 'venta_pago_id' =>$dat['venta_pago_id']);
		}
	}

	return $cierres;
}





function get_cant_happy_canjeados($preparado_id, $venta_id, $venta_detalle_id){
	$sql = "select id from ayahuaska.happys_canjeados where preparado_id = $preparado_id and venta_id =  $venta_id and venta_detalle_id = $venta_detalle_id";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	return $tot;
}

function get_happys_solicitados($preparado_id, $venta_id, $venta_detalle_id){
	$sql = "select cantidad from ayahuaska.ventas_detalles where preparado_id = $preparado_id and venta_id =  $venta_id and id = $venta_detalle_id";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot == 0){
		return 0;
	}
	else{
		$dat = mysql_fetch_array($res);
		return $dat['cantidad'];
	}
	
}

function inserta_happy_canjeado($preparado_id, $venta_id, $venta_detalle_id){
	echo $sql = "insert into ayahuaska.happys_canjeados (preparado_id, venta_id, venta_detalle_id) values ($preparado_id, $venta_id, $venta_detalle_id)";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}




function get_boletas_by_fecha($folio, $dia, $mes, $anio){
	$datos = [];
	$fecha = $anio.'-'.$mes."-%";
	if($folio == "")
		$folio = '%';

	if($dia != ""){
		$sql = "select * from ayahuaska.folios where fecha = '$dia'  and folio like '$folio'";
	}
	else{
		$sql = "select * from ayahuaska.folios where fecha like '$fecha'  and folio like '$folio'";	
	}
	
	
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$datos[] = array('id' => $dat['id'], 'folio' => $dat['folio'], 'monto' => $dat['monto'], 'fecha' => $dat['fecha'], 'hora' => $dat['hora'], 'trackid' => $dat['trackid'], 'estado_envio' => $dat['estado_envio'], 'movimiento' => $dat['movimiento']);
		}
	}
	return $datos;
}

function get_xml_by_folio($folio, $empresa){
	$sql = "select xml from ayahuaska.folios_asignas where (desde<=$folio and hasta>=$folio) and empresa='$empresa'";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['xml'];
}




 


function get_folios_by_fecha_empresa($fecha, $empresa){
	$datos = [];
	$sql = "select * from ayahuaska.folios where fecha = '$fecha' and empresa = '$empresa'";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$datos[] = array('id' => $dat['id'], 'folio' => $dat['folio'], 'monto' => $dat['monto'], 'fecha' => $dat['fecha'], 'hora' => $dat['hora']);
		}
	}
	return $datos;
}

//recogemos  la ruta para entrar en el segundo nivel
function leer_carpeta($dir) {
	$boletas = [];
	$leercarpeta = $dir . "/";
	 
	if(is_dir($leercarpeta)){
		if($dir = opendir($leercarpeta)){
			while(($archivo = readdir($dir)) !== false){
				if($archivo != '.' && $archivo != '..'){
					$boletas[] = $archivo; 
				} 
			}
			closedir($dir);
		}
	} 

	return $boletas;
}



function get_datos_boletas_by_folio($folio){
	$datos = [];
	$sql = "select * from ayahuaska.folios where folio = ".$folio."";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$datos[] = array('id' => $dat['id'], 'monto' => $dat['monto'], 'fecha' => $dat['fecha'], 'hora' => $dat['hora']);
		}
	}
	return $datos;
}


function get_max_desde_folios_asignas(){
	$sql = "select max(desde) as maxdesde from ayahuaska.folios_asignas";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot == 0)
		return 0;
	$dat = mysql_fetch_array($res);
	return $dat['maxdesde'];
}


function get_existe_folios_asignas($desde){
	$maxdesde = get_max_desde_folios_asignas();
	if($desde > $maxdesde)
		return false;
	else
		return true;
}


function inserta_folios_asignas($empresa, $desde, $hasta, $nombrexml){
	$cantidad = ($hasta - $desde ) + 1;
	$sql = "insert into ayahuaska.folios_asignas(empresa, desde, hasta, cantidad, fecha, hora, xml) values('$empresa', $desde, $hasta, $cantidad, '".date("Y-m-d")."', '".date("H:i:s")."', '$nombrexml')";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}


function getCafs($empresa, $order = 'ASC'){

	$sql = "select desde, hasta, cantidad, xml from ayahuaska.folios_asignas where empresa = '$empresa' order by desde $order";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot == 0){
		return false;
	}
	else{
		$dat = mysql_fetch_array($res);
		return $dat;
	}

        // $cafs = $this->db->getTable('
        //     SELECT desde, hasta, (hasta - desde + 1) AS cantidad, xml
        //     FROM dte_caf
        //     WHERE emisor = :rut AND dte = :dte AND certificacion = :certificacion
        //     ORDER BY desde '.($order=='ASC'?'ASC':'DESC').'
        // ', [':rut'=>$this->emisor, ':dte'=>$this->dte, ':certificacion'=>$this->certificacion]);
        // foreach ($cafs as &$caf) {
        //     $xml = \website\Dte\Utility_Data::decrypt($caf['xml']);
        //     if (!$xml)
        //         return false;
        //     $Caf = new Folios($xml);
        //     $caf['fecha_autorizacion'] = $Caf->getFechaAutorizacion();
        //     $caf['meses_autorizacion'] = Utility_Date::countMonths($caf['fecha_autorizacion']);
        //     unset($caf['xml']);
        // }
        // return $cafs;
}

function getPrimerFolio($empresa){

    $sql = "select min(folio) as minfolio from ayahuaska.folios where empresa='$empresa'";
    $res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot == 0){
		return 0;
	}
	else{
		$dat = mysql_fetch_array($res);
		return $dat['minfolio'];
	}

}


// buscar rango
function get_folios_rango_aux($empresa){
	$folios = [];
	$sql = "select desde, hasta from ayahuaska.folios_asignas where empresa = '$empresa'";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot == 0){
		$folios = [];
	}
	else{
		while ($dat = mysql_fetch_array($res)) {
			for ($folio=$dat['desde']; $folio<=$dat['hasta']; $folio++) {
                $folios[] = $folio;
            }
		}
	}

    return $folios;
}


function get_folios_sin_uso($empresa, $folios, $primer_folio){
	$folios_disp = [];
	foreach ($folios as $key => $folio) {
		if($folio > $primer_folio){
			$sql = "select id from ayahuaska.folios where folio = $folio and empresa ='$empresa'";
			$res = mysql_query($sql);
			$tot = mysql_num_rows($res);
			if($tot == 0){
				$folios_disp[] = $folio;
			}	
		}		
	}

	return $folios_disp;
}
    
  

function inserta_folio($folio, $total, $fecha, $hora, $empresa, $trackid, $estado, $movi){
	$sq = "select id from ayahuaska.folios where folio = $folio and empresa = '$empresa'";
	$re = mysql_query($sq);
	$tot = mysql_num_rows($re);
	if($tot > 0){
		return false;
	}
	$sql = "insert into ayahuaska.folios(folio, monto, fecha, hora, empresa, trackid, estado_envio, movimiento) 
			values($folio, $total, '$fecha', '$hora', '$empresa' ,$trackid, '$estado', $movi)";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}


function inserta_rcof($cant, $fecha, $hora, $trackid){
	echo $sql = "insert into ayahuaska.rcofs(cantidad, fecha, hora, trackid) values($cant, '$fecha', '$hora', $trackid)";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}




function inserta_folios_disponibles($folio){
	$sql = "insert into ayahuaska.folios_disponibles(folio, estado) values($folio, 0)";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}


function get_folios_disponibles(){
	$datos = [];
	$sql = "select * from ayahuaska.folios_disponibles where estado=0";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$datos[] = array('id' => $dat['id'], 'folio' => $dat['folio']);
		}
	}
	return $datos;
}



function get_min_folios_disponibles(){
	$sql = "select min(folio) as minfolio from ayahuaska.folios_disponibles where estado=0";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat['minfolio'];
}

function actualiza_folios_disponibles($folio, $estado){
	$sql = "update ayahuaska.folios_disponibles set estado=$estado where folio=$folio";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}









//BOL ELEC
function ingresa_boleta_elec($vta_id, $totalconprop, $mesa_id, $total, $monto_pagado, $propina, $forma_pago_id, $cliente_id, $usuario_id, $boleta, $descuento){


	$venta = get_venta_id($vta_id);
	if(inserta_vta_pago(($totalconprop), date("Y-m-d"), date("H:i:s"), $vta_id, $forma_pago_id, $usuario_id, date("Y-m-d H:i:s"))){
		$vta_pago_id = mysql_insert_id();
		$mesero = get_usuario_id($venta['usuario_id']);
    	$nombre_mesero = $mesero['nombre']." ".$mesero['apellido'];
    	//SI SE PAGA EL TOTAL DE LA MESA

		actualiza_mesa($mesa_id, 0);
		cierra_mesa_venta($vta_id);
		actualiza_boleta_venta($vta_id, $boleta);
	     
	   
	    if($propina > 0){
	      inserta_venta_propina($vta_id, $propina, 0, $vta_pago_id);
	    }
	    if($forma_pago_id == 3){
	      inserta_cta_cte(date("Y-m-d"), date("H:i:s"), ($totalconprop), $cliente_id, 1, $vta_id);
	      $cliente = get_cliente_id($cliente_id);
	      $nombrecli = $cliente['nombre'];
	      $rutcli = $cliente['rut'];
	      $correocli = $cliente['correo'];
	      // ENVIAR CORREO NOTIFICANDO DEUDA
	      //include("../phpmailer/sendmail.php");
	      generar_correo_carga_cta_cte($nombrecli, $rutcli, $vta_id, ($totalconprop), date("H:i:s"), $nombre_mesero, $correocli, $vta_pago_id);
	    }

	    $venta_socio = get_vta_socio_id($vta_id);
	    if($venta_socio != ""){
	      $nombre_socio = get_nombre_socio($venta_socio);
	      inserta_compra_socio($vta_id, $venta_socio, 0, ($totalconprop));
	    }
	    else{
	    	$nombre_socio = "";
	    }
	    valida_stock_critico($vta_id);
		
		$mesa = get_mesa_by_id($mesa_id);
		$formapago = get_forma_pago_id($forma_pago_id);

		include("../../APISII/genera_boleta_electronica.php");
		$detalles = array();
		$ventas_detalles = get_ventas_detalles_id($vta_id);
		foreach ($ventas_detalles as $key => $venta_detalle) {
          $cantidad_temporal = get_cantidad_venta_temporal($vta_id, $venta_detalle['preparado_id'], 0, $venta_detalle['npedido']);
          if($cantidad_temporal == ""){
            $cantidad_temporal = 0;
          }
          if($cantidad_temporal < $venta_detalle['cantidad']){

	          $preparado = get_preparados_id($venta_detalle['preparado_id']);
	          //VER CIGARROS
	          $familia = $preparado['PREPARADOS_FAMILIA'];
	          $detalles[] = array('nombre' => $preparado['PREPARADOS_NOMBRE'], 'cantidad' => $venta_detalle['cantidad']-$cantidad_temporal, 'precio' => $preparado['PREPARADOS_PRECIO'], 'familia' =>$familia);

	         
	       }
        }

        
        //$folio = create_boleta_electronica($detalles, $vta_id, $propina, $descuento);






        //NUEVO ENVIAR XML Y FOLIO PARA GENERAR PDF EN CLIENTE FINAL
  //       $fecha_hoy = date("Y-m-d");
  //       $urlxml = "/var/www/realdev.cl/ayahuaska/APISII/xml/boletas/ayahuaska/".$fecha_hoy."/".$folio."_boleta.xml";
  //       $codigo_comercial = "REAL002";
  //       $comercio = "ayahuaska";
  //       $url = "https://api.notifier.realdev.cl/api/solicita_boleta_electronica";

	 //    $parametrosdatos = array('codcomercio' => $codigo_comercial, 'comercio' => 'ayahuaska',
	 //     	'impresora' => 'CAJA',	
	 //     	'url' => $urlxml
	 //    );
	 //    //print_r($parametrosdatos);
		// $data = postURL($url, $parametrosdatos);
		// $data = json_decode($data);

	    return true;
	}
	else{
		return false;
	}

}




function ingresa_boleta_elec_temp($vta_id, $total, $mesa_id, $total_temporal, $propina, $forma_pago_id, $cliente_id, $usuario_id, $montopagado, $vuelto, $boleta_temporal){

	
	$venta = get_venta_id($vta_id);
	if(inserta_vta_pago(($total_temporal+$propina), date("Y-m-d"), date("H:i:s"), $vta_id, $forma_pago_id, $usuario_id, date("Y-m-d H:i:s"))){
		$vta_pago_id = mysql_insert_id();
		$mesero = get_usuario_id($venta['usuario_id']);
    	$nombre_mesero = $mesero['nombre']." ".$mesero['apellido'];


		if($propina > 0){
	      inserta_venta_propina($vta_id, $propina, 0, $vta_pago_id);
	    }

		if($forma_pago_id == 3){
	      inserta_cta_cte(date("Y-m-d"), date("H:i:s"), ($total_temporal+$propina), $cliente_id, 1, $vta_id);
	      $cliente = get_cliente_id($cliente_id);
	      $nombrecli = $cliente['nombre'];
	      $rutcli = $cliente['rut'];
	      $correocli = $cliente['correo'];
	      // ENVIAR CORREO NOTIFICANDO DEUDA
	      include("../phpmailer/sendmail.php");
	      generar_correo_carga_cta_cte($nombrecli, $rutcli, $vta_id, ($total_temporal+$propina), date("H:i:s"), $nombre_mesero, $correocli, $vta_pago_id);
	    }
	    $venta_socio = get_vta_socio_id($vta_id);
	    if($venta_socio != ""){
	      $nombre_socio = get_nombre_socio($venta_socio);
	      inserta_compra_socio($vta_id, $venta_socio, 0, ($total_temporal+$propina));
	    }
	    else{
	    	$nombre_socio = "";
	    }

	    //CREAR VOUCHER TEMPORAL CON PRODUCTOS DE TABLE TEMPORAL
	    $mesa = get_mesa_by_id($mesa_id);
		$formapago = get_forma_pago_id($forma_pago_id);
		


		

	    include("../../APISII/genera_boleta_electronica.php");
		$detalles = array();
		$ventas_detalles = get_ventas_detalles_temporal_id($vta_id);
		foreach ($ventas_detalles as $key => $venta_detalle) {
	          $preparado = get_preparados_id($venta_detalle['preparado_id']);
	          $familia = $preparado['PREPARADOS_FAMILIA'];
	          $detalles[] = array('nombre' => $preparado['PREPARADOS_NOMBRE'], 'cantidad' => $venta_detalle['cantidad'], 'precio' => $preparado['PREPARADOS_PRECIO'], 'familia' =>$familia);
	       
        }

        $folio = create_boleta_electronica($detalles, $vta_id, $propina, $descuento);


        //NUEVO ENVIAR XML Y FOLIO PARA GENERAR PDF EN CLIENTE FINAL
  //       $fecha_hoy = date("Y-m-d");
  //       $urlxml = "/var/www/realdev.cl/ayahuaska/APISII/xml/boletas/ayahuaska/".$fecha_hoy."/".$folio."_boleta.xml";
  //       $codigo_comercial = "REAL002";
  //       $url = "https://api.notifier.realdev.cl/api/solicita_boleta_electronica";
		// $parametrosdatos = array('codcomercio' => $codigo_comercial, 'comercio' => 'ayahuaska',
	 //     	'impresora' => 'CAJA',	
	 //     	'url' => $urlxml
	 //    );
		// $data = postURL($url, $parametrosdatos);
		// $data = json_decode($data);

        
	    return true;

	}
	else{
		return false;
	}	
	
	
}



function get_rcofs_fecha($fecha){
	
	$datos = [];
	$sql = "select * from ayahuaska.rcofs where fecha = '$fecha'";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		$total = get_monto_by_fecha($fecha);
		$desde = get_min_folios($fecha);
		$hasta = get_max_folios($fecha);
		while($dat = mysql_fetch_array($res)){
			$datos[] = array('id' => $dat['id'], 'trackid' => $dat['trackid'], 'cantidad' => $dat['cantidad'], 'total' => $total, 'desde' => $desde, 'hasta' =>$hasta);
		}
	}
	return $datos;
}


function get_monto_by_fecha($fecha){
	$fecha_rep = strtotime ( '-1 day' , strtotime ( $fecha ) ) ;
    $fecha_rep = date ( 'Y-m-j' , $fecha_rep );
	$sql = "select sum(monto) as total from folios where fecha='$fecha_rep'";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot == 0){
		return 0;
	}
	$dat = mysql_fetch_array($res);
	return $dat['total'];
}


function get_min_folios($fecha){
	$fecha_rep = strtotime ( '-1 day' , strtotime ( $fecha ) ) ;
    $fecha_rep = date ( 'Y-m-j' , $fecha_rep );
	$sql = "select min(folio) as desde from folios where fecha='$fecha_rep'";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot == 0){
		return 0;
	}
	$dat = mysql_fetch_array($res);
	return $dat['desde'];
}


function get_max_folios($fecha){
	$fecha_rep = strtotime ( '-1 day' , strtotime ( $fecha ) ) ;
    $fecha_rep = date ( 'Y-m-j' , $fecha_rep );
	$sql = "select max(folio) as hasta from folios where fecha='$fecha_rep'";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot == 0){
		return 0;
	}
	$dat = mysql_fetch_array($res);
	return $dat['hasta'];
}




function elimina_pedido_volver($venta_id, $motivo){
	$mesa = get_venta_mesa_id($venta_id);
	venta_cambia_estado($venta_id, -1);
	actualiza_mesa($mesa, 0);
	elimina_preparados_happy_by_id($venta_id);
	elimina_vta_socio($venta_id);
	inserta_motivo_eliminacion($venta_id, $motivo);
	// FALTA AGREGAR LA REPOSICION DEL STOCK
	descuentaStock_preparados_revertirByIdVenta($venta_id);

	return true;
}




function es_boleta_emitida($movimiento){
	$sql = "select folio from ayahuaska.folios where movimiento=$movimiento";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		$dat = mysql_fetch_array($res);
		return $dat['folio'];
	}
	return 0;
}



//if(ingresa_boleta_elec($_GET['omov'], $totcpro, $_GET['omesa'], $_GET['ototalmenosdescu'], $_GET['monto_pagado'], $_GET['propina'], $_GET['fpago'], $_GET['nomcli'], $_SESSION['id'], $_GET['boleta'], $descuentos));
function solicita_reimpresion_boleta_elec($movimiento){

}


//YA ESTA EN SHEOL
function get_pendientes_estado(){
	$datos = [];
	$sql = "select id, trackid, folio from ayahuaska.folios where (estado_envio='REC' or estado_envio='') order by id desc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$datos[] = array('id' => $dat['id'], 'trackid' => $dat['trackid'], 'folio' => $dat['folio']);
		}
	}
	return $datos;
}

function actualiza_estado_boleta($empresa, $folio, $resp){
	$sql = "update ayahuaska.folios set estado_envio='$resp' where empresa='$empresa' and folio=$folio";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}




function get_pendientes_enviar($fecha){
	$datos = [];
	$sql = "select folio from ayahuaska.folios where fecha='$fecha' and estado_envio='PENDIENTE'";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot == 0)
		return 0;
	while($dat = mysql_fetch_array($res)){
			$datos[] = array('folio' => $dat['folio']);
	}
	return $datos;

}

// SE DEBE CAMBIAR EL TIPO DE DATO TRACKID
// alter table folios change trackid trackid varchar(70);
function actualiza_track_id($folio, $trackid,  $estado){
	$sql = "update ayahuaska.folios set trackid='$trackid', estado_envio='$estado' where folio=$folio";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}



function get_all_categorias(){
	$familias = null;
	$sql = "select * from ayahuaska.categorias order by nombre asc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$familias[] = array('id' => $dat['id'], 'nombre' => $dat['nombre']);
		}
	}
	return $familias;
}



function get_categoria_datos($id){
	$sql = "select * from ayahuaska.categorias where id=".$id."";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat;
}



function ingresa_nueva_categoria($nombre){
	$sql = "insert into ayahuaska.categorias (nombre) values ('".$nombre."')";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function elimina_categoria($id){
	$sql = "delete from ayahuaska.categorias where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}

function actualiza_categoria($nombre, $id){
	$sql = "update ayahuaska.categorias set nombre = '".$nombre."' where id = ".$id."";
	if(mysql_query($sql)){
		return true;
	}
	else{
		return false;
	}
}



function get_preparados_categoria($categoria_id){
	$preparados = null ;
	$sql = "select * from ayahuaska.preparados where categoria_id = ".$categoria_id."";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while ($dat = mysql_fetch_array($res)) {
			$preparados[] = array('id' => $dat['PREPARADOS_ID'], 'nombre' => $dat['PREPARADOS_NOMBRE'],
							'familia' => $dat['PREPARADOS_FAMILIA'], 'precio' => $dat['PREPARADOS_PRECIO']);
		}
	}
	return $preparados;
}



function sanear_string($string)
{
 
    $string = trim($string);
 
    $string = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $string
    );
 
    $string = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $string
    );
 
    $string = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $string
    );
 
    $string = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $string
    );
 
    $string = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $string
    );
 
    $string = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C',),
        $string
    );
 
    //Esta parte se encarga de eliminar cualquier caracter extraño
    // $string = str_replace(
    //     array("\", "¨", "º", "-", "~",
    //          "#", "@", "|", "!", """,
    //          "·", "$", "%", "&", "/",
    //          "(", ")", "?", "'", "¡",
    //          "¿", "[", "^", "<code>", "]",
    //          "+", "}", "{", "¨", "´",
    //          ">", "< ", ";", ",", ":",
    //          ".", " "),
    //     $string
    // );
 
 
    return $string;
}


function get_venta_eliminada($venta_id){
	$sql = "select * from ayahuaska.ventas_eliminadas where venta_id=$venta_id";
	$res = mysql_query($sql);
	$dat = mysql_fetch_array($res);
	return $dat;
}



function top_garzones(){
	$ventas = null;
	$sql = "select ventas.usuario_id, sum(valor) as Venta
			from ayahuaska.ventas_pagos inner join ayahuaska.ventas
			on (ventas_pagos.venta_id = ventas.id)
            and  estado=1 group by ventas.usuario_id order by Venta desc; ";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);
	if($tot > 0){
		while($dat = mysql_fetch_array($res)){
			$ventas[] = array('usuario_id' =>$dat['usuario_id'], 'venta' => $dat['Venta']);
		}
	}
	return $ventas;

}

?>
