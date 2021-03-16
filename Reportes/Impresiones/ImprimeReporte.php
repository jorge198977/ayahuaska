<?php
include_once('PDF.php');
$pdf = new PDF('L','mm','A4');
$pdf->AddPage();

if(isset($_GET['stock'])){
	if($_GET['tipo_descuento'] != 1){
		$miCabecera = array('NOMBRE', 'FAMILIA', 'XUNID', 'XMED', 'MIN');	
	}
	else{
		$miCabecera = array('NOMBRE', 'FAMILIA', 'XUNID', 'MIN');
	}
	$pdf->cabeceraHorizontalverStock($miCabecera); 
	$misDatos = "RepStock";
	$pdf->reportesStock($misDatos, $_GET['tipo_descuento']);
}

if((isset($_GET['repGarzones'])) && (isset($_GET['Fechai']))){
	$miCabecera = array('GARZON', 'VENTAS');
	$misDatos = "repGarzones";
	$pdf->datosHorizontalrepGarzones($miCabecera); 
	$pdf->reporteGarzones($misDatos, $_GET['Fechai'], $_GET['Fechaf']); 
}

if((isset($_GET['repGarzonesPropina'])) && (isset($_GET['Fechai']))){
	$miCabecera = array('CAJERO', 'PROPINAS');
	$misDatos = "repGarzonesPropina";
	$pdf->datosHorizontalrepGarzonespropina($miCabecera); 
	$pdf->reportepropGarzones($misDatos, $_GET['Fechai'], $_GET['Fechaf']); 
}

if((isset($_GET['repSocioRep'])) && (isset($_GET['Fechai']))){
	$miCabecera = array('RUT', 'NOMBRE', 'MONTO', '$ REALES');
	$misDatos = "repSocioRep";
	$pdf->datosHorizontalrepSocioRep($miCabecera); 
	$pdf->reportesocio($misDatos, $_GET['Fechai'], $_GET['Fechaf']); 
}

if(isset($_GET['verRepSocioDet'])){
	$miCabecera = array('DESCRIPCION', 'FECHA', 'CANT', 'PRECIO U', 'TOTAL');
	$pdf->cabeceraHorizontalverRepSocioDet($miCabecera); 
	$misDatos = "verRepSocioDetFecha";
	$pdf->reportesociodetalleprep($misDatos, $_GET['socio_id'], $_GET['Fechai'], $_GET['Fechaf']);
}

if(isset($_GET['verRepFamilia'])){
	$miCabecera = array('DESCRIPCION', 'CANT', 'PRECIO', '$ SUBT');
	$misDatos = "verRepFamilia";
	$pdf->datosHorizontalverRepFamilia($miCabecera); 
	$pdf->reportesfamilias($misDatos, $_GET['Familia'], $_GET['Fechai'], $_GET['Fechaf']); 
}

if(isset($_GET['verrepvtaturnofecha'])){
	$miCabecera = array('DESCRIPCION', 'CANT', 'MONTO');
	$misDatos = "verrepvtaturnofecha";
	$pdf->datosHorizontalverrepvtaturnofecha($miCabecera); 
	$pdf->reporte_ventas_fecha($misDatos, $_GET['Familia'], $_GET['Fechai'], $_GET['Fechaf']); 
}

if((isset($_GET['repvta']))){
	$miCabecera = array('DESCRIPCION', 'CANT');
	$misDatos = "repvta";
	$pdf->datosHorizontalrepvta($miCabecera);
	if(isset($_GET['Fechai'])){ 
		$pdf->reportes_ventas_turnos($misDatos, $_GET['Fechai'], $_GET['Familia'], $_GET['Turno']);
	}
}

if(isset($_GET['verrepcompras'])){
	$miCabecera = array('PROVEEDOR', 'MONTO');
	$misDatos = "verrepcompras";
	$pdf->datosHorizontalrepcompras($miCabecera); 
	$pdf->reporte_compras_proveedor($misDatos, $_GET['Fechai'], $_GET['Fechaf'], $_GET['Proveedor']); 
}

if(isset($_GET['verrepOC'])){
	$miCabecera = array('PROVEEDOR', 'USUARIO', 'FECHA');
	$misDatos = "verrepOC";
	
	$pdf->datosHorizontalrepocs($miCabecera); 
	$pdf->reporte_ocs($misDatos, $_GET['Fechai'], $_GET['Fechaf']); 
}

if((isset($_GET['repProveedores']))){
	$miCabecera = array('ROL', 'NOMBRE', 'FONO', 'CORREO');
	$misDatos = "repProveedores";
	$pdf->datosHorizontalrepProveedores($miCabecera);
	$pdf->rep_proveedores(); 
}

if(isset($_GET['Cliente'])){
	$miCabecera = array('RUT', 'NOMBRE', 'CORREO', 'CUPO');
	$misDatos = "Cliente";
	$pdf->cabeceraHorizontalCliente($miCabecera);
	$pdf->rep_clientes();
}

if((isset($_GET['repverabonos']))){
	$miCabecera = array('RUT', 'NOMBRE', 'FECHA', 'ABONO');
	$misDatos = "repverabonos";
	$pdf->datosHorizontalrepAbonos($miCabecera);
	$pdf->rep_abonos(); 
}

if((isset($_GET['repverdeudores']))){
	$miCabecera = array('RUT', 'NOMBRE', 'CORREO', 'DEBE');
	$misDatos = "repverdeudores";
	$pdf->datosHorizontalrepDeudores($miCabecera);
	$pdf->rep_deudores(); 
}

if(isset($_GET['repProductos'])){
	$miCabecera = array('ID', 'NOMBRE', 'F DESC', 'STCK', 'MIN', 'ESTADO');
	$pdf->datosHorizontalrepProductos($miCabecera);
	$pdf->rep_productos($_GET['familia']);
}

if(isset($_GET['repProductos_preparados'])){
	$miCabecera = array('ID', 'NOMBRE', 'FAMILIA', 'PRECIO');
	$pdf->datosHorizontalrepProductos_preparados($miCabecera);
	$pdf->rep_productos_preparados($_GET['familia']);
}

if(isset($_GET['Socioreal'])){
	$miCabecera = array('RUT', 'NOMBRE', 'TELEFONO', 'CORREO');
	$pdf->cabeceraHorizontalSocio($miCabecera);
	$pdf->rep_socios();
}

if((isset($_GET['repUsuarios']))){
	$miCabecera = array('ID', 'NOMBRE', 'TIPO', 'CORREO');
	$pdf->datosHorizontalrepUsuarios($miCabecera);
	$pdf->rep_usuarios(); 
}

if((isset($_GET['repVerelimpedido']))){
	$miCabecera = array('ID', 'MESA', 'FECHA', 'ATENDIDO POR');
	$pdf->datosHorizontalrepVerelimpedido($miCabecera);
	$pdf->rep_pedidos_eliminados(); 
}

if((isset($_GET['repFamilias']))){
	$miCabecera = array('ID', 'DESCRIPCION');
	$pdf->datosHorizontalrepFamilias($miCabecera);
	$pdf->rep_familias(); 
}


if((isset($_GET['repMercaderia']))){
	$miCabecera = array('NOMBRE', 'PRECIO', 'FAMILIA');
	$pdf->datosHorizontalrepMercaderia($miCabecera); 
	$pdf->rep_mercaderias(); 
}

if((isset($_GET['ventas_mensuales']))){
	$miCabecera = array('FECHA', 'MESA', 'N°INT', 'USUARIO', 'TOTAL', 'BOL', 'EFEC', 'DEBI', 'CREDI', 'ABONO');
	$pdf->datosHorizontalrepVentasmensuales($miCabecera); 
	$pdf->rep_ventas_mensuales($_GET['Fecha']); 
}


if(isset($_GET['verreppuntoscanjeados'])){
	$miCabecera = array('SOCIO', 'MONTO', 'FECHA', 'HORA');
	$misDatos = "verrepvtaturnofecha";
	$pdf->datoshorizontalpuntoscanjeados($miCabecera); 
	$pdf->reporte_puntos_socio(); 
}

if((isset($_GET['cierre']))){
	$miCabecera = array('FECHA', 'MESA', 'N°INT', 'USUARIO', 'TOTAL', 'BOL', 'PROP', 'EFEC', 'DEBI', 'CREDI', 'ABONO');
	$pdf->datosHorizontalrepVentasmensuales($miCabecera); 
	$pdf->rep_cierre_turno($_GET['Fechai'], $_GET['Turno']); 
}

if((isset($_GET['ClienteConsumo']))){
	$miCabecera = array('MOV', 'FECHA', 'DESCRIPCION', 'CANT', 'MONTO');
	$pdf->datosHorizontalrepCliConsumo($miCabecera); 
	$pdf->rep_cliconsumo($_GET['ClienteConsumo']); 
}

$pdf->Output();

// if(isset($_GET['Fechai'])){
//     $ventas = get_detalle_ventas_garzones($_GET['Fechai'], $_GET['Fechaf']);
//     print_r($ventas);
// }
?>