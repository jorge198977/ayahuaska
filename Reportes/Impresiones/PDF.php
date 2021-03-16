<?php
//require('../../intranet/funciones/fpdf/fpdf.php');
include('../../intranet/funciones/controlador.php');
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

class PDF extends FPDF
{
    function Header()
   {
    //Logo
    $this->Image("../../assets/img/brand/logo.jpg" , 10 ,8, 55 , 38 , "JPG" ,"#");
    //Arial bold 15
    $this->SetFont('Arial','B',15);
    //Movernos a la derecha
    $this->Cell(80);
    //Título
    $this->Cell(60,10,'SISTEMAREAL',1,0,'C');
    $this->Ln(10);
    $this->Cell(80);
    $this->Cell(60,10, fecha_bd_normal(date("Y-m-d")) ,1,0,'C');
    //Salto de línea
    $this->Ln(40); 
      
   }

   function datosHorizontalrepCliConsumo($cabecera)
    {
        $this->SetXY(10, 70);
        $this->SetFont('Arial','B',10);
        foreach($cabecera as $fila)
        {
            //Atención!! el parámetro valor 0, hace que sea horizontal
            if(($fila == "MOV") ){
            $this->Cell(40,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if(($fila == "FECHA") ){
            $this->Cell(50,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if(($fila == "DESCRIPCION") ){
            $this->Cell(120,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else{
            $this->Cell(25,7, utf8_decode($fila),1, 0 , 'L' );
            }
            
        }
    }


   function datoshorizontalpuntoscanjeados($cabecera)
    {
        $this->SetXY(10, 70);
        $this->SetFont('Arial','B',10);
        foreach($cabecera as $fila)
        {
            //Atención!! el parámetro valor 0, hace que sea horizontal
            if(($fila == "SOCIO") ){
            $this->Cell(90,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if(($fila == "MONTO") ){
            $this->Cell(30,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else{
            $this->Cell(25,7, utf8_decode($fila),1, 0 , 'L' );
            }
            
        }
    }

   function datosHorizontalrepVentasmensuales($cabecera)
    {
        $this->SetXY(10, 70);
        $this->SetFont('Arial','B',10);
        foreach($cabecera as $fila)
        {
            //Atención!! el parámetro valor 0, hace que sea horizontal
            if(($fila == "FECHA") ){
            $this->Cell(40,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if(($fila == "MESA") ){
            $this->Cell(15,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if(($fila == "N°INT") ){
            $this->Cell(25,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if(($fila == "USUARIO") ){
            $this->Cell(65,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else{
            $this->Cell(15,7, utf8_decode($fila),1, 0 , 'L' );
            }
            
        }
    }

   function cabeceraHorizontalverStock($cabecera)
    {
        $this->SetXY(10, 70);
        $this->SetFont('Arial','B',10);
        foreach($cabecera as $fila)
        {
            //Atención!! el parámetro valor 0, hace que sea horizontal
            if(($fila == "NOMBRE") ){
            $this->Cell(160,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if(($fila == "FAMILIA") ){
            $this->Cell(70,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else{
            $this->Cell(15,7, utf8_decode($fila),1, 0 , 'L' );
            }
            
        }
    }

    function datosHorizontalrepGarzones($cabecera)
    {
        $this->SetXY(10, 70);
        $this->SetFont('Arial','B',10);
        foreach($cabecera as $fila)
        {
            //Atención!! el parámetro valor 0, hace que sea horizontal
            if(($fila == "GARZON") ){
            $this->Cell(75,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else{
            $this->Cell(24,7, utf8_decode($fila),1, 0 , 'L' );
            }
            
        }
    }

    function datosHorizontalrepGarzonespropina($cabecera)
    {

        $this->SetXY(10, 70);
        $this->SetFont('Arial','B',10);
        foreach($cabecera as $fila)
        {
            //Atención!! el parámetro valor 0, hace que sea horizontal
            if(($fila == "CAJERO") ){
            $this->Cell(75,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else{
            $this->Cell(24,7, utf8_decode($fila),1, 0 , 'L' );
            }
            
        }

    }

    function datosHorizontalrepSocioRep($cabecera)
    {
        $this->SetXY(10, 70);
        $this->SetFont('Arial','B',10);
        foreach($cabecera as $fila)
        {
            //Atención!! el parámetro valor 0, hace que sea horizontal
            if($fila == "RUT"){
            $this->Cell(45,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            if($fila == "NOMBRE"){
            $this->Cell(90,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if($fila == "MONTO"){
            $this->Cell(30,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if($fila == "$ REALES"){
            $this->Cell(30,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            
        }
    }

    function cabeceraHorizontalverRepSocioDet($cabecera)
    {
        $this->SetXY(10, 70);
        $this->SetFont('Arial','B',10);
        foreach($cabecera as $fila)
        {
            //Atención!! el parámetro valor 0, hace que sea horizontal
            if(($fila == "DESCRIPCION") ){
            $this->Cell(100,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if ($fila == "FECHA") {
            $this->Cell(45,7, utf8_decode($fila),1, 0 , 'L' );
            }
            else if ($fila == "CANT") {
            $this->Cell(13,7, utf8_decode($fila),1, 0 , 'L' );
            }
            else{
            $this->Cell(20,7, utf8_decode($fila),1, 0 , 'L' );
            }
            
        }
    }

    function datosHorizontalverRepFamilia($cabecera)
    {
        $this->SetXY(10, 70);
        $this->SetFont('Arial','B',10);
        foreach($cabecera as $fila)
        {
            //Atención!! el parámetro valor 0, hace que sea horizontal
            if($fila == "DESCRIPCION"){
            $this->Cell(110,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if($fila == "CANT"){
            $this->Cell(15,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if($fila == "PRECIO"){
            $this->Cell(30,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if($fila == "$ SUBT"){
            $this->Cell(30,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            
        }
    }

    function datosHorizontalverrepvtaturnofecha($cabecera)
    {
        $this->SetXY(10, 70);
        $this->SetFont('Arial','B',10);
        foreach($cabecera as $fila)
        {
            //Atención!! el parámetro valor 0, hace que sea horizontal
            if($fila == "DESCRIPCION"){
            $this->Cell(120,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if($fila == "CANT"){
            $this->Cell(20,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if($fila == "MONTO"){
            $this->Cell(20,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            
        }
    }

    function datosHorizontalrepvta($cabecera)
    {
        $this->SetXY(10, 70);
        $this->SetFont('Arial','B',10);
        foreach($cabecera as $fila)
        {
            //Atención!! el parámetro valor 0, hace que sea horizontal
            if($fila == "DESCRIPCION"){
            $this->Cell(140,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else{
            $this->Cell(20,7, utf8_decode($fila),1, 0 , 'L' );
            }
            
        }
    }

    function datosHorizontalrepcompras($cabecera)
    {
        $this->SetXY(10, 70);
        $this->SetFont('Arial','B',10);
        foreach($cabecera as $fila)
        {
            //Atención!! el parámetro valor 0, hace que sea horizontal
            if($fila == "PROVEEDOR"){
            $this->Cell(120,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if($fila == "MONTO"){
            $this->Cell(30,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            
        }
    }

    function datosHorizontalrepocs($cabecera)
    {
        $this->SetXY(10, 70);
        $this->SetFont('Arial','B',10);
        foreach($cabecera as $fila)
        {
            //Atención!! el parámetro valor 0, hace que sea horizontal
            if($fila == "PROVEEDOR"){
                $this->Cell(80,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if($fila == "USUARIO"){
                $this->Cell(80,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else{
                $this->Cell(30,7, utf8_decode($fila),1, 0 , 'L' );  
            }
            
        }
    }

    function datosHorizontalrepProveedores($cabecera)
    {
        $this->SetXY(10, 70);
        $this->SetFont('Arial','B',10);
        foreach($cabecera as $fila)
        {
            //Atención!! el parámetro valor 0, hace que sea horizontal
            if($fila == "ROL"){
            $this->Cell(25,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if($fila == "NOMBRE"){
            $this->Cell(85,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if($fila == "CORREO"){
            $this->Cell(60,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if($fila == "FONO"){
            $this->Cell(25,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            
        }
    }

    function cabeceraHorizontalCliente($cabecera)
    {
        $this->SetXY(10, 70);
        $this->SetFont('Arial','B',10);
        foreach($cabecera as $fila)
        {
            //Atención!! el parámetro valor 0, hace que sea horizontal
            if(($fila == "NOMBRE") ){
            $this->Cell(68,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if ($fila == "CORREO") {
            $this->Cell(68,7, utf8_decode($fila),1, 0 , 'L' );
            }
            else{
            $this->Cell(24,7, utf8_decode($fila),1, 0 , 'L' );
            }
            
        }
    }

    function datosHorizontalrepAbonos($cabecera)
    {
        $this->SetXY(10, 70);
        $this->SetFont('Arial','B',10);
        foreach($cabecera as $fila)
        {
            //Atención!! el parámetro valor 0, hace que sea horizontal
            if($fila == "RUT"){
            $this->Cell(25,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if($fila == "NOMBRE"){
            $this->Cell(90,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if($fila == "FECHA"){
            $this->Cell(40,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if($fila == "ABONO"){
            $this->Cell(30,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            
        }
    }

    function datosHorizontalrepDeudores($cabecera)
    {
        $this->SetXY(10, 70);
        $this->SetFont('Arial','B',10);
        foreach($cabecera as $fila)
        {
            //Atención!! el parámetro valor 0, hace que sea horizontal
            if($fila == "RUT"){
            $this->Cell(25,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if($fila == "NOMBRE"){
            $this->Cell(85,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if($fila == "CORREO"){
            $this->Cell(55,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if($fila == "DEBE"){
            $this->Cell(20,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            
        }
    }

    function datosHorizontalrepProductos($cabecera){
        $this->SetXY(10, 70);
        $this->SetFont('Arial','B',10);
        foreach($cabecera as $fila)
        {
            //Atención!! el parámetro valor 0, hace que sea horizontal
            if($fila == "NOMBRE"){
                $this->Cell(120,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if($fila == "ID"){
                $this->Cell(15,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if($fila == "F DESC"){
                $this->Cell(20,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if($fila == "STCK"){
                $this->Cell(12,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if($fila == "MIN"){
                $this->Cell(10,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if($fila == "ESTADO"){
                $this->Cell(17,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            
        }
    }

    function datosHorizontalrepProductos_preparados($cabecera){
        $this->SetXY(10, 70);
        $this->SetFont('Arial','B',10);
        foreach($cabecera as $fila)
        {
            //Atención!! el parámetro valor 0, hace que sea horizontal
            if($fila == "NOMBRE"){
                $this->Cell(110,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if($fila == "ID"){
                $this->Cell(15,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if($fila == "FAMILIA"){
                $this->Cell(50,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if($fila == "PRECIO"){
                $this->Cell(20,7, utf8_decode($fila),1, 0 , 'L' );    
            }   
        }
    }

    function cabeceraHorizontalSocio($cabecera)
    {
        $this->SetXY(10, 70);
        $this->SetFont('Arial','B',10);
        foreach($cabecera as $fila)
        {
            //Atención!! el parámetro valor 0, hace que sea horizontal
            if(($fila == "NOMBRE") ){
            $this->Cell(75,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if (($fila == "TELEFONO")) {
            $this->Cell(28,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if ($fila == "CORREO") {
            $this->Cell(60,7, utf8_decode($fila),1, 0 , 'L' );
            }
            else{
            $this->Cell(24,7, utf8_decode($fila),1, 0 , 'L' );
            }
            
        }
    }

    function datosHorizontalrepUsuarios($cabecera)
    {
        $this->SetXY(10, 70);
        $this->SetFont('Arial','B',10);
        foreach($cabecera as $fila)
        {
            //Atención!! el parámetro valor 0, hace que sea horizontal
            if($fila == "ID"){
            $this->Cell(25,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if($fila == "NOMBRE"){
            $this->Cell(70,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if($fila == "TIPO"){
            $this->Cell(40,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if($fila == "CORREO"){
            $this->Cell(60,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            
        }
    }

    function datosHorizontalrepVerelimpedido($cabecera)
    {
        $this->SetXY(10, 70);
        $this->SetFont('Arial','B',10);
        foreach($cabecera as $fila)
        {
            //Atención!! el parámetro valor 0, hace que sea horizontal
            if($fila == "ID"){
            $this->Cell(30,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            if($fila == "MESA"){
            $this->Cell(30,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if($fila == "ATENDIDO POR"){
            $this->Cell(90,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if($fila == "FECHA"){
            $this->Cell(40,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            
        }
    }


    function datosHorizontalrepFamilias($cabecera)
    {
        $this->SetXY(10, 70);
        $this->SetFont('Arial','B',10);
        foreach($cabecera as $fila)
        {
            //Atención!! el parámetro valor 0, hace que sea horizontal
            if($fila == "ID"){
            $this->Cell(45,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if($fila == "DESCRIPCION"){
            $this->Cell(120,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            
        }
    }

    function datosHorizontalrepMercaderia($cabecera)
    {
        $this->SetXY(10, 70);
        $this->SetFont('Arial','B',10);
        foreach($cabecera as $fila)
        {
            //Atención!! el parámetro valor 0, hace que sea horizontal
            if(($fila == "NOMBRE") ){
            $this->Cell(120,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else if(($fila == "FAMILIA") ){
            $this->Cell(60,7, utf8_decode($fila),1, 0 , 'L' );    
            }
            else{
            $this->Cell(15,7, utf8_decode($fila),1, 0 , 'L' );
            }
            
        }
    }


    function reporteGarzones($datos, $fechai, $fechaf){
    	$ventas = get_detalle_ventas_garzones($fechai, $fechaf);
        foreach ($ventas as $key => $venta) {
            $usuario = get_usuario_id($venta['usuario_id']);
            $this->Ln();
            if($venta['venta'] > 0){
            	$this->Cell(75,7, utf8_decode($usuario['nombre']." ".$usuario['apellido']),1, 0 , 'L' );
            	$this->Cell(24,7, number_format($venta['venta'], 0, ',', '.' ),1, 0 , 'L' );
            	//$this->Ln();
            }
        }
    }

    function reportepropGarzones($datos, $fechai, $fechaf){
        $propinas = get_detalle_propinas_garzones($fechai, $fechaf);
        foreach ($propinas as $key => $propina) {
            $usuario = get_usuario_id($propina['usuario_id']);
            $this->Ln();
            $this->Cell(75,7, utf8_decode($usuario['nombre']." ".$usuario['apellido']),1, 0 , 'L' );
            $this->Cell(24,7, utf8_decode(number_format($propina['propina'], 0, ',', '.') ),1, 0 , 'L' );
            //$this->Ln();
        }
    }

    function reportesocio($datos, $fechai, $fechaf){
        $socios_detalles = get_detalle_compra_socios($fechai, $fechaf);
        foreach ($socios_detalles as $key => $socio_detalle) {
            $socio = get_socio_id($socio_detalle['socio_id']);
            $pesosreales = ceil((($socio_detalle['total']*1)/100));
            $this->Ln();
            $this->Cell(45,7, utf8_decode($socio['rut']),1, 0 , 'L' );
            $this->Cell(90,7, utf8_decode($socio['nombre']),1, 0 , 'L' );
            $this->Cell(30,7, number_format($socio_detalle['total'], 0, ',', '.'),1, 0 , 'L' );
            $this->Cell(30,7, utf8_decode($pesosreales),1, 0 , 'L' );
            //$this->Ln();
        }
    }

    function reportesociodetalleprep($datos, $socio_id, $fechai, $fechaf){
        $tot = 0;
        $socio_detalles_consumo = get_detalle_compra_socio_productos($socio_id, $fechai, $fechaf);
        foreach ($socio_detalles_consumo as $key => $detalle_consumo) {
            $tot = $detalle_consumo['preparado_precio'] * $detalle_consumo['cantidad'];
            $this->Ln();
            $this->Cell(100,7, utf8_decode($detalle_consumo['preparado_nombre'] ),1, 0 , 'L' );
            $this->Cell(45,7, utf8_decode(fecha_bd_normal($detalle_consumo['fecha']) . " " .$detalle_consumo['hora']),1, 0 , 'L' );
            $this->Cell(13,7, utf8_decode($detalle_consumo['cantidad']),1, 0 , 'L' );
            $this->Cell(20,7, number_format($detalle_consumo['preparado_precio'], 0, ',', '.'),1, 0 , 'L' );
            $this->Cell(20,7, number_format($tot, 0, ',', '.'),1, 0 , 'L' );
            $this->Ln();
        }
    }

    function reportesfamilias($datos, $familia, $fechai, $fechaf){
        $familias_reportes = get_reportes_familias_fecha($familia, $fechai, $fechaf);
        $total = 0;
        foreach ($familias_reportes as $key => $familia_reporte) {
            $subtotal = $familia_reporte['preparado_precio']*$familia_reporte['cantidad'];
            $total = $total + $subtotal;
            $this->Ln();
            $this->Cell(110,7, utf8_decode($familia_reporte['preparado_nombre']),1, 0 , 'L' );
            $this->Cell(15,7, utf8_decode($familia_reporte['cantidad']),1, 0 , 'L' );
            $this->Cell(30,7, number_format($familia_reporte['preparado_precio'], 0, ',', '.'),1, 0 , 'L' );
            $this->Cell(30,7, utf8_decode($subtotal),1, 0 , 'L' );
        }
        $this->Ln();
        $this->Cell(110,7, 'TOTAL',1, 0 , 'C' );
        $this->Cell(75,7, number_format($total, 0, ',', '.'),1, 0 , 'C' );
    }

    function reporte_ventas_fecha($datos, $familia, $fechai, $fechaf){
        $total = 0; 
        $horafechai = "09:00:00";
        $horafechaf = "08:00:00";
        $fechaf2 = strtotime ( '+1 day' , strtotime ( $fechaf ) ) ;
        $fechaf2 = date ( 'Y-m-j' , $fechaf2 );
        $fecha1 = $fechai. " ".$horafechai;
        $fecha2 = $fechaf2. " ".$horafechaf;
        if($familia != 0){
            $ventas_fechas = get_reportes_ventas_fecha_familia($familia, $fecha1, $fecha2);
        }
        else{
            $ventas_fechas = get_reportes_ventas_fecha($fecha1, $fecha2);
        }
        foreach ($ventas_fechas as $key => $venta_fecha) {
            $subtotal = $venta_fecha['preparado_precio']*$venta_fecha['cantidad'];
            $total = $total + $subtotal;
            $this->Ln();
            $this->Cell(120,7, utf8_decode($venta_fecha['preparado_nombre']),1, 0 , 'L' );
            $this->Cell(20,7, utf8_decode($venta_fecha['cantidad']),1, 0 , 'L' );
            $this->Cell(20,7, number_format($subtotal, 0, ',', '.'),1, 0 , 'L' );
        }
        $this->Ln();
        $this->Cell(160,7, 'TOTAL RECAUDADO ENTRE '.$fechai.' y '.$fechaf.': $'.number_format($total, 0, ',', '.'),1, 0 , 'C' );
    }

    function reportes_ventas_turnos($datos, $fechai, $familia, $turno){
        if($turno == 1){
            $fechahoy = $fechai;  
            $horat21 = "09:00:00";
            $hotat22 = "21:00:00";
            $fecha21 = $fechahoy." ".$horat21;
            $fecha22 = $fechahoy." ".$hotat22;
            if($familia != 0){
                $ventas_fechas = get_reportes_ventas_turnos_familia($familia, $fecha21, $fecha22);
            }
            else{
                $ventas_fechas = get_reportes_ventas_turnos($fecha21, $fecha22);  
            }
        } 
        if($turno == 2){
            $fechahoy = $fechai;
            $horaactual = date("H:i:s");
            $horario1 = "00:00:00";
            $horario2 = "06:00:00";
            $ret = dentro_de_horario($horario1, $horario2, $horaactual);
            if($ret == 1){
              $fecha = $fechai;
              $fechan = strtotime ( '-1 day' , strtotime ( $fecha ) ) ;
              $fechan = date ( 'Y-m-j' , $fechan ); 
              $hora221 = "00:00:00";
              $hora222 = "08:55:00";
              $horat21 = "21:00:01";
              $hotat22 = "23:59:59";
              $fecha21 = $fechan." ".$horat21;
              $fecha22 = $fechan." ".$hotat22;
              $fecha221 = $fechahoy." ".$hora221;
              $fecha222 = $fechahoy." ".$hora222;
            }
            else{
              $fecha = $fechai;
              $fechan = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
              $fechan = date ( 'Y-m-j' , $fechan ); 
              $hora221 = "00:00:00";
              $hora222 = "08:55:00";
              $horat21 = "21:00:01";
              $hotat22 = "23:59:59";
              $fecha21 = $fechahoy." ".$horat21;
              $fecha22 = $fechahoy." ".$hotat22;
              $fecha221 = $fechan." ".$hora221;
              $fecha222 = $fechan." ".$hora222;
            }
            if($familia != 0){
              $ventas_fechas = get_reportes_ventas_turnos_familia($familia, $fecha21, $fecha22, $fecha221, $fecha222);
            } 
            else{
              $ventas_fechas = get_reportes_ventas_turnos_fechas($fecha21, $fecha22, $fecha221, $fecha222);
            } 
        }

        foreach ($ventas_fechas as $key => $venta_fecha) {
            $this->Ln();
            $this->Cell(140,7, utf8_decode($venta_fecha['preparado_nombre']),1, 0 , 'L' );
            $this->Cell(20,7, utf8_decode($venta_fecha['cantidad']),1, 0 , 'L' );
        }
    }

    function reporte_compras_proveedor($datos, $fechai, $fechaf, $proveedor_id){
        if($proveedor_id != 0){
            $compras = get_reportes_compras_proveedor($fechai, $fechaf, $proveedor_id);
        }
        else{
            $compras = get_reportes_compras($fechai, $fechaf);
        }
        foreach ($compras as $key => $compra) {
            $prov = get_proveedor_id($compra['proveedor_id']);
            $this->Ln();
            $this->Cell(120,7, utf8_decode($prov['nombre']),1, 0 , 'L' );
            $this->Cell(30,7, number_format($compra['total'], 0, ',', '.'),1, 0 , 'L' );
        }
    }

    function reporte_ocs($datos, $fechai, $fechaf){
        $ocs = get_reporte_ordenes_compra($fechai, $fechaf);
        foreach ($ocs as $key => $oc) {
            $proveedor = get_proveedor_id($oc['proveedor_id']);
            $usuario = get_usuario_id($oc['usuario_id']);
            $this->Ln();
            $this->Cell(80,7, utf8_decode($proveedor['nombre']),1, 0 , 'L' );
            $this->Cell(80,7, utf8_decode($usuario['nombre']. " ".$usuario['apellido']),1, 0 , 'L' );
            $this->Cell(30,7, fecha_bd_normal($oc['fecha']),1, 0 , 'L' );
        }
    }

    function rep_proveedores(){
        $proveedores = get_all_proveedores();
        foreach ($proveedores as $key => $prov) {
            $this->Ln();
            $this->Cell(25,7, utf8_decode($prov['id']),1, 0 , 'L' );
            $this->Cell(85,7, utf8_decode($prov['nombre']),1, 0 , 'L' );
            $this->Cell(25,7, utf8_decode($prov['fono']),1, 0 , 'L' );
            $this->Cell(60,7, utf8_decode($prov['correo'] ),1, 0 , 'L' );       
        }

    }

    function rep_clientes(){
        $clientes = get_all_clientes();
        foreach ($clientes as $key => $cli) {
            $this->Ln();
            $this->Cell(24,7, utf8_decode($cli['rut']),1, 0 , 'L' );
            $this->Cell(68,7, utf8_decode($cli['nombre']),1, 0 , 'L' );
            $this->Cell(68,7, utf8_decode($cli['correo']),1, 0 , 'L' );
            $this->Cell(24,7, number_format($cli['cupo'], 0, ',', '.'),1, 0 , 'L' );   
        }
    }

    function rep_abonos(){
        $abonos = get_all_abonos();
        foreach ($abonos as $key => $abono) {
            $cliente = get_cliente_id($abono['cliente_id']);
            $this->Ln();
            $this->Cell(25,7, utf8_decode($cliente['rut']),1, 0 , 'L' );
            $this->Cell(90,7, utf8_decode($cliente['nombre']),1, 0 , 'L' );
            $this->Cell(40,7, fecha_bd_normal($abono['fecha'] ),1, 0 , 'L' );
            $this->Cell(30,7, number_format($abono['abono'], 0, ',', '.'),1, 0 , 'L' );      
        }
    }

    function rep_deudores(){
        $clientes = get_all_clientes();
        $total = 0;
        foreach ($clientes as $key => $cliente) {
            $monto_adeudado = get_monto_adeudado($cliente['id']);
            $total = $total + $monto_adeudado;
            if($monto_adeudado > 0){
                $this->Ln();
                $this->Cell(25,7, utf8_decode($cliente['rut']),1, 0 , 'L' );
                $this->Cell(85,7, utf8_decode($cliente['nombre']),1, 0 , 'L' );
                $this->Cell(55,7, utf8_decode($cliente['correo'] ),1, 0 , 'L' );
                $this->Cell(20,7, number_format($monto_adeudado, 0 , ',', '.'),1, 0 , 'L' );
            }
        }
    }

    function rep_productos($familia){
        $productos = get_producto_familia($familia);
        foreach ($productos as $key => $prod) {
            $this->Ln();
            $this->Cell(15,7, utf8_decode($prod['id']),1, 0 , 'L' );
            $this->Cell(120,7, utf8_decode($prod['nombre']),1, 0 , 'L' );
            $this->Cell(20,7, utf8_decode(get_nombre_tipo_descuento($prod['tipo_descuento'])),1, 0 , 'L' );
            $this->Cell(12,7, stockUnidadBy_idProducto($prod['id']),1, 0 , 'L' );
            $this->Cell(10,7, $prod['stock_minimo'],1, 0 , 'L' );
            $this->Cell(17,7, utf8_decode((stock_critico($prod['id'])) ? "Crítico":"Normal"),1, 0 , 'L' );
        }
    }

    function rep_productos_preparados($familia){
        $preparados = get_preparados_familia($familia);
        foreach ($preparados as $key => $prep) {
            $this->Ln();
            $this->Cell(15,7, utf8_decode($prep['id']),1, 0 , 'L' );
            $this->Cell(110,7, utf8_decode($prep['nombre']),1, 0 , 'L' );
            $this->Cell(50,7, utf8_decode(get_familia($prep['familia'])),1, 0 , 'L' );
            $this->Cell(20,7, utf8_decode($prep['precio']),1, 0 , 'L' );
        }
    }

    function rep_socios(){
        $socios = get_all_socios();
        foreach ($socios as $key => $socio) {
            $this->Ln();
            $this->Cell(24,7, utf8_decode($socio['rut']),1, 0 , 'L' );
            $this->Cell(75,7, utf8_decode($socio['nombre']),1, 0 , 'L' );
            $this->Cell(28,7, utf8_decode($socio['telefono']),1, 0 , 'L' );
            $this->Cell(60,7, utf8_decode($socio['correo']),1, 0 , 'L' );
        }
    }

    function rep_usuarios(){
        $usuarios = get_all_usuarios();
        foreach ($usuarios as $key => $usu) {
            $this->Ln();
            $this->Cell(25,7, utf8_decode($usu['id']),1, 0 , 'L' );
            $this->Cell(70,7, utf8_decode($usu['nombre']. " ".$usu['apellido']),1, 0 , 'L' );
            $this->Cell(40,7, utf8_decode(get_tipo_usuario_nombre_id($usu['tipo_usuario'])),1, 0 , 'L' );
            $this->Cell(60,7, utf8_decode($usu['correo']),1, 0 , 'L' );             
        }
    } 

    function rep_pedidos_eliminados(){
        $ventas = get_ventas_estado(-1);
        foreach ($ventas as $key => $venta) {
            $usuario = get_usuario_id($venta['usuario_id']);
            $this->Ln();
            $this->Cell(30,7, utf8_decode($venta['id']),1, 0 , 'L' );
            $this->Cell(30,7, utf8_decode(get_mesa_by_id($venta['mesa_id'])),1, 0 , 'L' );
            $this->Cell(40,7, fecha_bd_normal($venta['fecha']),1, 0 , 'L' );
            $this->Cell(90,7, utf8_decode($usuario['nombre']." ".$usuario['apellido']),1, 0 , 'L' );
        }
    }

    function rep_familias(){
        $familias = get_all_familias();
        foreach ($familias as $key => $fam) {
            $this->Ln();
            $this->Cell(45,7, utf8_decode($fam['id']),1, 0 , 'L' );
            $this->Cell(120,7, utf8_decode($fam['nombre']),1, 0 , 'L' );            
        }
    }

    function rep_mercaderias(){
        $preparados = get_all_preparados();
        foreach ($preparados as $key => $preparado) {
            $producto_preparados = get_producto_preparados_id_prep($preparado['id']);
            $this->Ln();
            $this->Cell(120,7, utf8_decode(substr($preparado['nombre'], 0 , 100) ),1, 0 , 'L' );    
            $this->Cell(15,7, number_format($preparado['precio'], 0, ',', '.'),1, 0 , 'L' );
            $this->Cell(60,7, utf8_decode(substr(get_familia($preparado['familia']), 0 ,30) ),1, 0 , 'L' );
            if($producto_preparados != ""){
                $costo_preparado = 0;
                foreach ($producto_preparados as $key => $prod_prep) {
                    $nombre_producto = get_producto($prod_prep['producto_id']);
                    $costo_asociado = get_costo_asociado($prod_prep['cantidad'], $nombre_producto['PRODUCTO_COSTO'], $nombre_producto['PRODUCTO_CAPACIDADPORUNIDAD']);
                    $costo_preparado = $costo_preparado + $costo_asociado;
                    $this->Ln();
                    $nombre_producto = get_producto($prod_prep['producto_id']);
                    $this->Cell(60,7, utf8_decode($prod_prep['cantidad']. 
                            " ".get_nombre_tipo_descuento($nombre_producto['TIPO_DESCUENTO_ID']).
                            " ".$nombre_producto['PRODUCTO_NOMBRE']));
                }
            }
            $this->Ln();
            $this->Cell(50,7, 'COSTO ASOCIADO: $' .number_format($costo_preparado, 0, ',', '.'),1, 0 , 'L' );
            $this->Ln();
        }
    }

    function reportesStock($datos, $tipo_descuento){
        $productos = get_productos_by_tipo_descuento($tipo_descuento);
        foreach ($productos as $key => $producto) {
            if($producto['nombreFamilia'] != ""){
                $this->Ln();
                $this->Cell(160,7, utf8_decode(substr($producto['nombre'], 0 ,50) ),1, 0 , 'L' );
                $this->Cell(70,7, utf8_decode($producto['nombreFamilia']),1, 0 , 'L' );
                $this->Cell(15,7, intval($producto['stockPorUnitdad']),1, 0 , 'L' );
                if($tipo_descuento != 1){
                    $this->Cell(15,7, ($producto['stockPorTipo']),1, 0 , 'L' );
                }
                $this->Cell(15,7, intval($producto['stock_minimo']),1, 0 , 'L' );
            }
        }
    }

    function rep_ventas_mensuales($fecha){
        $ventas = get_ventas_fecha($fecha);
        $totcig = 0;
        $propina = 0;
        $total = 0;
        $efec = 0; $tarjeta = 0; $credito = 0; $abono = 0;
        foreach ($ventas as $key => $cierre) {
            $mesa = get_mesa_by_id($cierre['mesa_id']);
            $obtener_propina = get_venta_propina($cierre['venta_id']);
            $mesero = get_usuario_id($cierre['usuario_id']);
            $nombre_mesero = $mesero['nombre']." ".$mesero['apellido'];
            if($obtener_propina['monto'] != ""){
              $propina = $propina + $obtener_propina['monto'];
            }
            // $vtas_detalles = get_ventas_detalles_id($cierre['venta_id']);
            // foreach ($vtas_detalles as $key => $vta_detalle) {
            //   $preparado = get_preparados_id($vta_detalle['preparado_id']);
            //   if($preparado['PREPARADOS_FAMILIA'] == 4){
            //     $totcig = $totcig + ($preparado['PREPARADOS_PRECIO'] * $vta_detalle['cantidad'] );
            //   } 
            // }
            $total = $total + $cierre['valor'];
            $this->Ln();
            $this->Cell(40,7, $cierre['fecha_full'],1, 0 , 'L' );
            $this->Cell(20,7, $mesa,1, 0 , 'L' );
            $this->Cell(25,7, $cierre['venta_id'],1, 0 , 'L' );
            $this->Cell(70,7, $nombre_mesero,1, 0 , 'L' );
            $this->Cell(20,7, number_format($cierre['valor'], 0, ',', '.'),1, 0 , 'L' );
            $this->Cell(20,7, $cierre['boleta'],1, 0 , 'L' );
            if($cierre['forma_pago_id'] == 1){
              $this->Cell(20,7, number_format($cierre['valor'], 0, ',', '.'),1, 0 , 'L' );  
              $efec = $efec + $cierre['valor'];
            }
            else{
              $this->Cell(20,7, 0,1, 0 , 'L' );
            }
            if($cierre['forma_pago_id'] == 4){
              $this->Cell(20,7, number_format($cierre['valor'], 0, ',', '.'),1, 0 , 'L' );  
              $tarjeta = $tarjeta + $cierre['valor'];
            }
            else{
              $this->Cell(20,7, 0,1, 0 , 'L' );
            }
            if($cierre['forma_pago_id'] == 3){
              $this->Cell(20,7, number_format($cierre['valor'], 0, ',', '.'),1, 0 , 'L' );
              $credito = $credito + $cierre['valor'];
            }
            else{
              $this->Cell(20,7, 0,1, 0 , 'L' );
            }
            if($cierre['forma_pago_id'] == 5){
              $this->Cell(20,7, number_format($cierre['valor'], 0, ',', '.'),1, 0 , 'L' );
              $abono = $abono + $cierre['valor'];
            }
            else{
              $this->Cell(20,7, 0,1, 0 , 'L' );
            }
        }
	$this->Ln(); 
        $this->Cell(155,7, 'TOTALES',1, 0 , 'C' );
        $this->Cell(20,7, number_format($total, 0, ',', '.'),1, 0 , 'L' );
        $this->Cell(20,7, '',1, 0 , 'L' );
        $this->Cell(20,7, number_format($efec, 0, ',', '.'),1, 0 , 'L' );
        $this->Cell(20,7, number_format($tarjeta, 0, ',', '.'),1, 0 , 'L' );
        $this->Cell(20,7, number_format($credito, 0, ',', '.'),1, 0 , 'L' );
        $this->Cell(20,7, number_format($abono, 0, ',', '.'),1, 0 , 'L' );
    }


    function reporte_puntos_socio(){
        $puntos = get_puntos_canjeados();
        $total = 0;
        foreach ($puntos as $key => $punto) {
            $socio = get_socio_id($punto['socio_id']);
            if($socio['nombre'] != ""){
            $total = $total + $punto['monto'];
                $this->Ln();
                $this->Cell(90,7, utf8_decode($socio['nombre']),1, 0 , 'L' );
                $this->Cell(30,7, $punto['monto'],1, 0 , 'L' );
                $this->Cell(25,7, (fecha_bd_normal($punto['fecha'])),1, 0 , 'L' );
                $this->Cell(25,7, $punto['hora'],1, 0 , 'L' );
            }
        }
    }


    function rep_cierre_turno($fecha, $turno){

          if($turno == 1){
            $fechahoy = $fecha;  
            $horat21 = "09:00:00";
            $hotat22 = "21:00:00";
            $fecha21 = $fechahoy." ".$horat21;
            $fecha22 = $fechahoy." ".$hotat22;
            $cierres = get_cierres_por_fecha_hora($fecha21, $fecha22);
                                         
          }
          else{
            $fechahoy = $fecha;
            $horaactual = date("H:i:s");
            $horario1 = "00:00:00";
            $horario2 = "06:00:00";
            $hora221 = "00:00:00";
            $hora222 = "06:00:00";
            $horat21 = "21:00:01";
            $hotat22 = "23:59:59";
            $fecha21 = $fechahoy." ".$horat21;
            $fecha22 = $fechahoy." ".$hotat22;
            $fechan = strtotime ( '+1 day' , strtotime ( $fechahoy ) ) ;
            $fechan = date ( 'Y-m-j' , $fechan ); 
            $fecha221 = $fechan." ".$hora221;
            $fecha222 = $fechan." ".$hora222;
            $cierres = get_cierres_por_fecha_hora2($fecha21, $fecha22, $fecha221, $fecha222);        
          }

        $totcig = 0;
        $propina = 0;
        $total = 0;
        $efec = 0; $tarjeta = 0; $credito = 0; $abono = 0;

        if(sizeof($cierres) > 0){
        foreach ($cierres as $key => $cierre) {
            $mesa = get_mesa_by_id($cierre['mesa_id']);
            $obtener_propina = get_venta_propina($cierre['venta_id']);
            $mesero = get_usuario_id($cierre['usuario_id']);
            $nombre_mesero = $mesero['nombre']." ".$mesero['apellido'];
            if($obtener_propina['monto'] != ""){
              $propina = $propina + $obtener_propina['monto'];
            }
            $total = $total + $cierre['valor'];
            $this->Ln();
            $this->Cell(40,7, $cierre['fecha_full'],1, 0 , 'L' );
            $this->Cell(15,7, $mesa,1, 0 , 'L' );
            $this->Cell(25,7, $cierre['venta_id'],1, 0 , 'L' );
            $this->Cell(65,7, $nombre_mesero,1, 0 , 'L' );
            $this->Cell(15,7, number_format($cierre['valor'], 0, ',', '.'),1, 0 , 'L' );
            $this->Cell(15,7, $cierre['boleta'],1, 0 , 'L' );
            if($obtener_propina['monto'] != ""){
              $this->Cell(15,7, number_format($obtener_propina['monto'], 0, ',', '.'),1, 0 , 'L' );  
              //$efec = $efec + $cierre['valor'];
            }
            else{
              $this->Cell(15,7, 0,1, 0 , 'L' );
            }


            if($cierre['forma_pago_id'] == 1){
                if($obtener_propina['monto'] != ""){  
                    $this->Cell(15,7, number_format($cierre['valor'] - $obtener_propina['monto'], 0, ',', '.'),1, 0 , 'L' );  
                    $efec = $efec + $cierre['valor']- $obtener_propina['monto'];
                }
                else{
                    $this->Cell(15,7, number_format($cierre['valor'], 0, ',', '.'),1, 0 , 'L' );  
                    $efec = $efec + $cierre['valor'];
                }
            }
            else{
              $this->Cell(15,7, 0,1, 0 , 'L' );
            }


            if($cierre['forma_pago_id'] == 4){
                if($obtener_propina['monto'] != ""){
                    $this->Cell(15,7, number_format($cierre['valor'] - $obtener_propina['monto'], 0, ',', '.'),1, 0 , 'L' );  
                    $tarjeta = $tarjeta + $cierre['valor'] - $obtener_propina['monto'];
                }
                else{
                    $this->Cell(15,7, number_format($cierre['valor'], 0, ',', '.'),1, 0 , 'L' );  
                    $tarjeta = $tarjeta + $cierre['valor'];
                }
            }
            else{
              $this->Cell(15,7, 0,1, 0 , 'L' );
            }

            if($cierre['forma_pago_id'] == 3){
                if($obtener_propina['monto'] != ""){                
                    $this->Cell(15,7, number_format($cierre['valor'] - $obtener_propina['monto'], 0, ',', '.'),1, 0 , 'L' );
                    $credito = $credito + $cierre['valor'] - $obtener_propina['monto'];
                }
                else{
                    $this->Cell(15,7, number_format($cierre['valor'], 0, ',', '.'),1, 0 , 'L' );
                    $credito = $credito + $cierre['valor'];
                }
            }
            else{
              $this->Cell(15,7, 0,1, 0 , 'L' );
            }
            if($cierre['forma_pago_id'] == 5){
              $this->Cell(15,7, number_format($cierre['valor'], 0, ',', '.'),1, 0 , 'L' );
              $abono = $abono + $cierre['valor'];
            }
            else{
              $this->Cell(15,7, 0,1, 0 , 'L' );
            }
        }
        }
        $this->Ln(); 
        $this->Cell(145,7, 'TOTALES',1, 0 , 'C' );
        $this->Cell(15,7, number_format($total, 0, ',', '.'),1, 0 , 'L' );
        $this->Cell(15,7, '',1, 0 , 'L' );
        $this->Cell(15,7, number_format($propina, 0, ',', '.'),1, 0 , 'L' );
        $this->Cell(15,7, number_format($efec, 0, ',', '.'),1, 0 , 'L' );
        $this->Cell(15,7, number_format($tarjeta, 0, ',', '.'),1, 0 , 'L' );
        $this->Cell(15,7, number_format($credito, 0, ',', '.'),1, 0 , 'L' );
        $this->Cell(15,7, number_format($abono, 0, ',', '.'),1, 0 , 'L' );
    }


    function rep_cliconsumo($cliente){
        $subt = 0;
        $compras_detalles_cliente = get_detalle_compras_cliente($cliente);
        foreach ($compras_detalles_cliente as $key => $compra_detalle_cliente) {
            $ventas_detalles = get_ventas_detalles_id($compra_detalle_cliente['venta_id']);
            if(sizeof($ventas_detalles) > 0){
                foreach ($ventas_detalles as $key => $venta_detalle) {
                  $preparado = get_preparados_id($venta_detalle['preparado_id']);
                  $subt = $preparado['PREPARADOS_PRECIO'] * $venta_detalle['cantidad'];
                  $this->Ln();
                  $this->Cell(40,7, $compra_detalle_cliente['venta_id'],1, 0 , 'L' );
                  $this->Cell(50,7, fecha_bd_normal($compra_detalle_cliente['fecha']),1, 0 , 'L' );
                  $this->Cell(120,7, utf8_decode($preparado['PREPARADOS_NOMBRE']),1, 0 , 'L' );
                  $this->Cell(25,7, $venta_detalle['cantidad'],1, 0 , 'L' );
                  $this->Cell(25,7, number_format($subt, 0, ',', '.'),1, 0 , 'L' );

                }
            }
        }
        $abonos_cta_cte_cliente = get_cta_cte_cliente($cliente, 2);
        foreach ($abonos_cta_cte_cliente as $key => $abono_cta_cte_cliente) {
            $this->Ln();
            $this->Cell(40,7, $abono_cta_cte_cliente['venta_id'],1, 0 , 'L' );
            $this->Cell(50,7, fecha_bd_normal($abono_cta_cte_cliente['fecha']),1, 0 , 'L' );
            $this->Cell(120,7, "Abono cuenta corriente",1, 0 , 'L' );
            $this->Cell(25,7, ' ',1, 0 , 'L' );
            $this->Cell(25,7, number_format($abono_cta_cte_cliente['monto'], 0, ',', '.'),1, 0 , 'L' );
        }
    }

}

?>