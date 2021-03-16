<?php
ini_set("session.cookie_lifetime","7200");
ini_set("session.gc_maxlifetime","7200");
session_start();
include("seguridad.php");
if(!validaringreso())
    header('Location:../../index.php?NOCINICIA');
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
include("controlador.php");
date_default_timezone_set('America/Santiago');
// INGRESO NUEVO PRODUCTO
if(isset($_POST['Ingresaproducto'])){
	if(inserta_producto($_POST['nombreproducto'], $_POST['forma_comercializa'], $_POST['cantinicial'], $_POST['forma_descuento'],
					1, $_POST['stock_minimo'], $_POST['OFamilia'], $_POST['costo'])){
		header("Location:../../Mantenedores/Productos/visualiza_producto.php?Familia=".$_POST['OFamilia']."&Ingresado");
	}
	else{
		header("Location:../../Mantenedores/Productos/visualiza_producto.php?Familia=".$_POST['OFamilia']."&ErrorIngresando");
	}
}
if(isset($_POST['Actproducto'])){
	if(actualiza_producto($_POST['nombreproducto'], $_POST['forma_comercializa'], $_POST['cantinicial'], $_POST['forma_descuento'],
					1, $_POST['stock_minimo'], $_POST['OFamilia'], $_POST['Actproducto'], $_POST['costo'])){
		header("Location:../../Mantenedores/Productos/visualiza_producto.php?Familia=".$_POST['OFamilia']."&Actualizado");
	}
	else{
		header("Location:../../Mantenedores/Productos/visualiza_producto.php?Familia=".$_POST['OFamilia']."&ErrorActualizando");
	}
}
if(isset($_GET['EliminaProducto'])){
	if(elimina_producto($_GET['EliminaProducto'])){
		header("Location:../../Mantenedores/Productos/visualiza_producto.php?Familia=".$_GET['Familia']."&Eliminado");
	}
	else{
		header("Location:../../Mantenedores/Productos/visualiza_producto.php?Familia=".$_GET['Familia']."&ErrorEliminando");
	}
}
// FIN INGRESO NUEVO PRODUCTO


// INGRESO NUEVO PRODUCTO
if(isset($_POST['Ingresaproductopreparado'])){
	if(inserta_producto_preparado($_POST['nombreproducto'], $_POST['precio'], $_POST['oFamilia'], $_POST['es_happy'], $_POST['es_cocina'])){
		header("Location:../../Mantenedores/Productos/visualiza_producto_preparado.php?Familia=".$_POST['oFamilia']."&Ingresado");
	}
	else{
		header("Location:../../Mantenedores/Productos/visualiza_producto_preparado.php?Familia=".$_POST['oFamilia']."&ErrorIngresando");
	}
}
if(isset($_POST['Actproductopreparado'])){
	if(actualiza_producto_preparado($_POST['nombreproducto'], $_POST['precio'], $_POST['Actproductopreparado'], $_POST['es_happy'], $_POST['es_cocina'], $_POST['oFamilia'], $_POST['categoria'])){
		header("Location:../../Mantenedores/Productos/visualiza_producto_preparado.php?Familia=".$_POST['oFamilia']."&Actualizado");
	}
	else{
		header("Location:../../Mantenedores/Productos/visualiza_producto_preparado.php?Familia=".$_POST['oFamilia']."&ErrorActualizando");
	}
}
if(isset($_GET['EliminaProducto_preparado'])){
	if(elimina_producto_preparado($_GET['EliminaProducto_preparado'])){
		header("Location:../../Mantenedores/Productos/visualiza_producto_preparado.php?Familia=".$_GET['Familia']."&Eliminado");
	}
	else{
		header("Location:../../Mantenedores/Productos/visualiza_producto_preparado.phpFamilia=".$_GET['Familia']."&?ErrorEliminando");
	}
}
// FIN INGRESO PRODUCTO PREPARADO


// INGRESA DESCUENTO DE PRODUCTOS
if(isset($_POST['btningresaprodescuento'])){
	if(inserta_descuento_producto_preparado($_POST['oProductoId'],
		$_POST['nombreProducto1'], $_POST['cantidad'])){
		header("Location:../../Mantenedores/Productos/ver_descuento_preparado.php?id=".$_POST['oProductoId']."&familia_id=".$_POST['oFamilia']."&Ingresado");
	}
	else{
		header("Location:../../Mantenedores/Productos/ver_descuento_preparado.php?id=".$_POST['oProductoId']."&familia_id=".$_POST['oFamilia']."&ErrorIngresando");
	}
}
if(isset($_GET['EliminaProducto_preparado_dscto'])){
	if(elimina_propudcto_preparado_dscto($_GET['EliminaProducto_preparado_dscto'], $_GET['producto_preparado_id'])){
		header("Location:../../Mantenedores/Productos/ver_descuento_preparado.php?id=".$_GET['producto_preparado_id']."&familia_id=".$_GET['Familia']."&Eliminado");
	}
	else{
		header("Location:../../Mantenedores/Productos/ver_descuento_preparado.php?id=".$_GET['producto_preparado_id']."&familia_id=".$_GET['Familia']."&ErrorEliminando");
	}
}
// FIN INGRESA DESCUENTO DE PRODUCTOS


//LLAMADAS A MANTENEDORES//
if(isset($_POST['ingresafamilia'])){
	if(ingresa_nueva_familia($_POST['nombrefamilia'])){
		header("Location:../../Mantenedores/Familias/index.php?Ingresado");
	}
	else{
		header("Location:../../Mantenedores/Familias/index.php?ErrorIngresando");
	}
}
if(isset($_GET['ElimidFamilia'])){
	if(elimina_familia($_GET['ElimidFamilia'])){
		header("Location:../../Mantenedores/Familias/index.php?Eliminado");
	}
	else{
		header("Location:../../Mantenedores/Familias/index.php?ErrorEliminando");
	}
}
if(isset($_POST['ActidFamilia'])){
	if(actualiza_familia($_POST['nombrefamilia'], $_POST['ActidFamilia'])){
		header("Location:../../Mantenedores/Familias/index.php?Actualizado");
	}
	else{
		header("Location:../../Mantenedores/Familias/index.php?ErrorActualizando");
	}
}

if(isset($_POST['ingresaproveedor'])){
	if(ingresa_nuevo_proveedor($_POST['idprov'], $_POST['nombreprov'], $_POST['fonoprov'], $_POST['contactoprov'])){
		header("Location:../Mantenedores/Proveedores/index.php?Ingresado");
	}
	else{
		header("Location:../Mantenedores/Proveedores/index.php?ErrorIngresando");
	}
}
if(isset($_POST['Actidproveedor'])){
	if(actualiza_proveedor($_POST['idprov'], $_POST['nombreprov'], $_POST['fonoprov'], $_POST['contactoprov'], $_POST['Actidproveedor'])){
		header("Location:../Mantenedores/Proveedores/index.php?Actualizado");
	}
	else{
		header("Location:../Mantenedores/Proveedores/index.php?ErrorActualizando");
	}
}
if(isset($_GET['ElimidProv'])){
	if(elimina_proveedor($_GET['ElimidProv'])){
		header("Location:../../Mantenedores/Proveedores/index.php?Eliminado");
	}
	else{
		header("Location:../../Mantenedores/Proveedores/index.php?ErrorEliminando");
	}
}

if(isset($_POST['ingresausuario'])){
	if(ingresa_nuevo_usuario($_POST['nombreusuario'], $_POST['apellidousuario'], $_POST['usuariousuario'], $_POST['claveusuario'], $_POST['correousuario'], $_POST['tipousuario'], $_POST['fonusuario'], $_POST['estado'])){
		header("Location:../../Mantenedores/Usuarios/index.php?Ingresado");
	}
	else{
		header("Location:../../Mantenedores/Usuarios/index.php?ErrorIngresando");
	}
}
if(isset($_POST['Actidusuario'])){
	if(actualiza_usuario($_POST['nombreusuario'], $_POST['apellidousuario'], $_POST['usuariousuario'], $_POST['correousuario'], $_POST['tipousuario'], $_POST['Actidusuario'], $_POST['fonusuario'], $_POST['estado'])){
		header("Location:../../Mantenedores/Usuarios/index.php?Actualizado");
	}
	else{
		header("Location:../../Mantenedores/Usuarios/index.php?ErrorActualizando");
	}
}
if(isset($_GET['ElimidUsuario'])){
	if(elimina_usuario($_GET['ElimidUsuario'])){
		header("Location:../../Mantenedores/Usuarios/index.php?Eliminado");
	}
	else{
		header("Location:../../Mantenedores/Usuarios/index.php?ErrorEliminando");
	}
}

if(isset($_POST['btnCambioClave'])){
	if(actualiza_usuario_clave($_POST['nueva_clave'], $_POST['oIdUsuario'])){
		header("Location:../../Mantenedores/Usuarios/index.php?ActualizadoClave");
	}
	else{
		header("Location:../../Mantenedores/Usuarios/index.php?ErrorActualizadoClave");
	}
}



if(isset($_POST['ingresacliente'])){
	if(ingresa_nuevo_cliente($_POST['rutcli'], $_POST['nombrecli'], $_POST['direccioncli'], $_POST['ciudadcli'], $_POST['telefonocli'], $_POST['emailcli'], $_POST['cupocli'])){
		header("Location:../../Mantenedores/Clientes/clientes.php?Ingresado");
	}
	else{
		header("Location:../../Mantenedores/Clientes/clientes.php?ErrorIngresando");
	}
}
if(isset($_POST['Actidcliente'])){
	if(actualiza_cliente($_POST['rutcli'], $_POST['nombrecli'], $_POST['direccioncli'], $_POST['ciudadcli'], $_POST['telefonocli'], $_POST['emailcli'], $_POST['cupocli'], $_POST['Actidcliente'])){
		header("Location:../../Mantenedores/Clientes/clientes.php?Actualizado");
	}
	else{
		header("Location:../../Mantenedores/Clientes/clientes.php?ErrorActualizando");
	}
}
if(isset($_GET['Elimcliente'])){
	if(elimina_cliente($_GET['Elimcliente'])){
		header("Location:../../Mantenedores/Clientes/clientes.php?Eliminado");
	}
	else{
		header("Location:../../Mantenedores/Clientes/clientes.php?ErrorEliminando");
	}
}

if(isset($_POST['ingresarmesa'])){
	if(ingresa_nueva_mesa($_POST['idmesa'], $_POST['ubicacion'], $_POST['estado'])){
		header("Location:../../Mantenedores/Mesas/index.php?Ingresado");
	}
	else{
		header("Location:../../Mantenedores/Mesas/index.php?ErrorIngresando");
	}
}
if(isset($_POST['Actidmesa'])){
	if(actualiza_datos_mesa($_POST['idmesa'], $_POST['ubicacion'], $_POST['estado'], $_POST['Actidmesa'])){
		header("Location:../../Mantenedores/Mesas/index.php?Actualizado");
	}
	else{
		header("Location:../../Mantenedores/Mesas/index.php?ErrorActualizando");
	}
}
if(isset($_GET['ElimidMesa'])){
	if(elimina_mesa($_GET['ElimidMesa'])){
		header("Location:../../Mantenedores/Mesas/index.php?Eliminado");
	}
	else{
		header("Location:../../Mantenedores/Mesas/index.php?ErrorEliminando");
	}
}

if(isset($_POST['descuentomonto'])){
	if(inserta_descuento_venta($_POST['descuentomov'], $_POST['descuentomonto'], $_SESSION['id'])){
		header("Location:../../Mantenedores/Descuentos/descuento.php?Realizado");
	}
	else{
		header("Location:../../Mantenedores/Descuentos/descuento.php?ErrorIngresando");
	}
}

if(isset($_POST['ingresasocio'])){
	if(inserta_socio($_POST['rutsocio'], $_POST['nombresocio'], $_POST['telefonosocio'])){
		header("Location:../../Mantenedores/Socios/index.php?Ingresado");
	}
	else{
		header("Location:../../Mantenedores/Socios/index.php?ErrorIngresando");
	}
}
if(isset($_POST['Actidsocio'])){
	if(actualiza_socio($_POST['rutsocio'], $_POST['nombresocio'], $_POST['telefonosocio'], $_POST['Actidsocio'])){
		header("Location:../../Mantenedores/Socios/index.php?Actualizado");
	}
	else{
		header("Location:../../Mantenedores/Socios/index.php?ErrorActualizando");
	}
}
if(isset($_GET['Elimsocio'])){
	if(elimina_socio($_GET['Elimsocio'])){
		header("Location:../../Mantenedores/Socios/index.php?Eliminado");
	}
	else{
		header("Location:../../Mantenedores/Socios/index.php?ErrorEliminando");
	}
}

if(isset($_POST['btnboleta'])){
	if(actauliza_bol_actual($_POST['boletanueva'])){
		header("Location:../../Mantenedores/Boletas/index.php?Actualizado");
	}
	else{
		header("Location:../../Mantenedores/Boletas/index.php?ErrorActualizando");
	}
}

if(isset($_POST['btntiempohappy'])){
	if(actualiza_tiempo_happy($_POST['horainicial'], $_POST['horafinal'])){
		header("Location:../../Mantenedores/Tiempos/index.php?Actualizado");
	}
	else{
		header("Location:../../Mantenedores/Tiempos/index.php?ErrorActualizando");
	}
}

if(isset($_POST['btntiempopsr'])){
	if(actualiza_tiempo_promocion($_POST['horainicial'], $_POST['horafinal'])){
		header("Location:../../Mantenedores/Tiempos/tiempo_promocion.php?Actualizado");
	}
	else{
		header("Location:../../Mantenedores/Tiempos/tiempo_promocion.php?ErrorActualizando");
	}
}

if(isset($_POST['ingresapie'])){
	if(inserta_pie($_POST['descrip'], $_POST['estado'])){
		header("Location:../../Mantenedores/Pie/index.php?Ingresado");
	}
	else{
		header("Location:../../Mantenedores/Pie/index.php?ErrorIngresando");
	}
}
if(isset($_POST['Actidpie'])){
	if(actualiza_pie($_POST['descrip'], $_POST['estado'], $_POST['Actidpie'])){
		header("Location:../../Mantenedores/Pie/index.php?Actualizado");
	}
	else{
		header("Location:../../Mantenedores/Pie/index.php?ErrorActualizando");
	}
}
if(isset($_GET['Elimpie'])){
	if(elimina_pie($_GET['Elimpie'])){
		header("Location:../../Mantenedores/Pie/index.php?Eliminado");
	}
	else{
		header("Location:../../Mantenedores/Pie/index.php?ErrorEliminando");
	}
}

if(isset($_POST['ElimidMovPedido'])){
	if(elimina_pedido($_POST['ElimidMovPedido'], $_POST['mesa_id'], $_POST['motivo'], $_SESSION['id'])){
		header("Location:../../Mantenedores/Eliminar_pedidos/eliminar_pedido.php?Eliminado");
	}
	else{
		header("Location:../../Mantenedores/Eliminar_pedidos/eliminar_pedido.php?ErrorEliminando");
	}
}

if(isset($_GET['btningresafactura'])){
	if(inserta_compra($_GET['nfact'], $_GET['proveedor'], $_GET['fecha'], $_GET['fechavenc'], $_GET['fpago'], $_SESSION['id'])){
		$compra_id = get_compra_id($_GET['nfact']);
		header("Location:../Compras/agrega_productos.php?id=$compra_id&Ingresado");
	}
	else{
		header("Location:../Compras/dato_factura.php?ErrorIngresando");
	}
}

if(isset($_POST['btningresafactura'])){
	if(actualiza_compras($_POST['Oid'], $_POST['Ofpago'], $_POST['neto'], $_POST['iva'], $_POST['impuesto_adicional'],
		$_POST['serv_logisticos'], $_POST['retencion'], $_POST['iaba'], $_POST['ila'], $_POST['descuento'], $_POST['exento'],
		$_POST['total'], $_POST['nro_cheque'])){
		header("Location:../Compras/index.php?Ingresado");
	}
	else{

	}
}
if(isset($_GET['ElimCompraFact'])){
	if(elimina_factura($_GET['ElimCompraFact'])){
		header("Location:../Compras/index.php?Eliminado");
	}
	else{
		header("Location:../Compras/index.php?&ErrorEliminando");
	}
}

if(isset($_GET['Elimpedidotablacomprafact'])){
	if(elimina_compra_detalle($_GET['Elimpedidotablacomprafact'], $_GET['compra_id'])){
		elimina_stock_compra($_GET['Elimpedidotablacomprafact'], $_GET['compra_id']);
		header("Location:../Compras/agrega_productos.php?id=".$_GET['compra_id']."&Eliminado");
	}
	else{
		header("Location:../Compras/agrega_productos.php?id=".$_GET['compra_id']."&ErrorEliminando");
	}
}


if(isset($_POST['btncambiaestadofactura'])){
	
	if($_POST['num_transf'] == ""){
		$transf = 0;
	}
	else{
		$transf = $_POST['num_transf'];
	}
	$act = "update compras set estado = ".$_POST['nuevoestado'].", num_transferencia='".$transf."' 
			where id=".$_POST['btncambiaestadofactura']."";
	if(mysql_query($act)){
		header("Location:../../Compras/index.php?Actualizado_estado");
	}
	else{
		header("Location:../../Compras/index.php?ErrorActualizando_estado");
	}
}

if(isset($_POST['btningresadescuentofamilia'])){
	if(inserta_descuento_familia($_POST['horai'], $_POST['horaf'], $_POST['descuento'], $_POST['familia'])){
		header("Location:../../Mantenedores/Descuentos_especiales/index.php?Ingresado");
	}
	else{
		header("Location:../../Mantenedores/Descuentos_especiales/index.php?ErrorIngresando");
	}
}
if(isset($_POST['btnactualizadescuentofamilia'])){
	if(actualiza_descuento_familia($_POST['horai'], $_POST['horaf'], $_POST['descuento'], $_POST['familia'], $_POST['btnactualizadescuentofamilia'])){
		header("Location:../../Mantenedores/Descuentos_especiales/index.php?Actualizado");
	}
	else{
		header("Location:../../Mantenedores/Descuentos_especiales/index.php?ErrorActualizando");
	}
}
if(isset($_GET['Elimdescuento_familia'])){
	if(elimina_descuento_familia($_GET['Elimdescuento_familia'])){
		header("Location:../../Mantenedores/Descuentos_especiales/index.php?Eliminado");
	}
	else{
		header("Location:../../Mantenedores/Descuentos_especiales/index.php?ErrorEliminando");
	}
}

if(isset($_POST['entrega_propina'])){
	if(actualiza_propina_estado(1)){
		header("Location:../../Cierres/ver_cierre.php?PropinaCerrada");
	}
	else{
		header("Location:../../Cierres/ver_cierre.php?ErrorCierre");
	}

}

if(isset($_POST['btningresaoc'])){
	if(ingresa_orden_compra(date("Y-m-d"), date("H:i:s"), $_POST['fechac'], $_POST['proveedor'] ,
		$_SESSION['id'] , $_POST['fpago'])){
		$orden_compra = get_orden_compra(date("Y-m-d"), date("H:i:s"), $_POST['fechac'], $_POST['proveedor'] ,
		$_SESSION['id'] , $_POST['fpago']);
		header("Location:../Mantenedores/OC/ingresa_producto_oc.php?nfact=".$orden_compra['id']."&fpago=".$_POST['fpago']."");
	}
	else{
		header("Location:../Mantenedores/OC/oc.php?ErrorInsertando");
	}
}
if(isset($_GET['EliminaOC'])){
	if(elimina_orden_compra($_GET['EliminaOC'])){
		header("Location:../../Mantenedores/OC/index.php?Eliminado");
	}
	else{
		header("Location:../../Mantenedores/OC/index.php?ErrorEliminando");
	}
}
if(isset($_GET['ElimpedidotablacompraOC'])){
	if(elimina_orden_compra_detalle($_GET['ElimpedidotablacompraOC'], $_GET['oc'])){
		header("Location:../Mantenedores/OC/ingresa_producto_oc.php?nfact=".$_GET['oc']."&fpago=".$_GET['fpago']."");
	}
	else{
		header("Location:../Mantenedores/OC/ingresa_producto_oc.php?nfact=".$_GET['oc']."&fpago=".$_GET['fpago']."&ErrorEliminando");
	}
}
//FIN LLAMADAS A MANTENEDORES//
//STOCK MANTENEDOR
if (isset($_POST['btnmodificastockunit'])) {
	//echo "stock->".$_POST['stockActual'].", STOC AUM->".$_POST['stockAumenta'];
	$tipo_descuento = $_POST['tipo_descuento'];
	include("../phpmailer/sendmail.php");
	if (actualiza_stock_unitario2($_POST['idProducto'], $_POST['stockActual'], $_POST['stockAumenta'], $_SESSION['id'])) {
		header("Location:../../Mantenedores/Stocks/stock.php?tipo_descuento=$tipo_descuento&success");
	}
	else{
	 	header("Location:../../Mantenedores/Stocks/stock.php?tipo_descuento=$tipo_descuento&error");
	}
}

if (isset($_POST['btnmodificastockonzas'])) {
	//echo "stock->".$_POST['stockActual'].", STOC AUM ONZA->".$_POST['stockAumenta'].", STOC ONZA->".$_POST['stockOnzas'];
	$tipo_descuento = $_POST['tipo_descuento'];
	include("../phpmailer/sendmail.php");
	if (actualiza_stock_onzas2($_POST['idProducto'], $_POST['stockActual'], $_POST['stockAumenta'], $_POST['stockOnzas'], $_SESSION['id'])) {
		header("Location:../../Mantenedores/Stocks/stock.php?tipo_descuento=$tipo_descuento&success");
	}
	else{
	 	header("Location:../../Mantenedores/Stocks/stock.php?tipo_descuento=$tipo_descuento&error");
	}
}


if (isset($_POST['btnmodificastockgramos'])) {
	//echo "stock->".$_POST['stockActual'].", STOC AUM ONZA->".$_POST['stockAumenta'].", STOC ONZA->".$_POST['stockOnzas'];
	$tipo_descuento = $_POST['tipo_descuento'];
	include("../phpmailer/sendmail.php");
	if (actualiza_stock_onzas2($_POST['idProducto'], $_POST['stockActual'], $_POST['stockAumenta'], $_POST['stockgramos'], $_SESSION['id'])) {
		header("Location:../../Mantenedores/Stocks/stock.php?tipo_descuento=$tipo_descuento&success");
	}
	else{
	 	header("Location:../../Mantenedores/Stocks/stock.php?tipo_descuento=$tipo_descuento&error");
	}
}
//FIN STOCK MANTENEDOR

if(isset($_POST['ingresatipocosto'])){
	if(inserta_tipo_costo($_POST['nombre'])){
		header("Location:../../Mantenedores/Costos/tipos_costos.php?Ingresado");
	}
	else{
		header("Location:../../Mantenedores/Costos/tipos_costos.php?ErrorIngresando");
	}
}

if(isset($_POST['Actidtipocosto'])){
	if(actualiza_tipo_costo($_POST['nombre'], $_POST['Actidtipocosto'])){
		header("Location:../../Mantenedores/Costos/tipos_costos.php?Actualizado");
	}
	else{
		header("Location:../../Mantenedores/Costos/tipos_costos.php?&ErrorActualizando");
	}
}

if(isset($_GET['ElimTipoCosto'])){
	if(elimina_tipo_costo($_GET['ElimTipoCosto'])){
		header("Location:../../Mantenedores/Costos/tipos_costos.php?&Eliminado");
	}
	else{
		header("Location:../../Mantenedores/Costos/tipos_costos.php?ErrorEliminando");
	}
}


if(isset($_POST['ingresanuevocosto'])){
	if(inserta_costo($_POST['nombre'], $_POST['monto'], $_POST['fecha'], $_POST['fecha_vencimiento'], $_POST['tipo_costo'], $_SESSION['id'], $_POST['fpago'], $_POST['factura'])){
		header("Location:../../Mantenedores/Costos/costos.php?id=".$_POST['tipo_costo']."&Ingresado");
	}
	else{
		header("Location:../../Mantenedores/Costos/costos.php?id=".$_POST['tipo_costo']."&ErrorIngresando");
	}
}

if(isset($_POST['actualizacosto'])){
	if(actualiza_costo($_POST['nombre'], $_POST['monto'], $_POST['fecha'], $_POST['fecha_vencimiento'],$_POST['tipo_costo'], $_SESSION['id'], $_POST['actualizacosto'],  $_POST['fpago'], $_POST['factura'])){
		header("Location:../../Mantenedores/Costos/costos.php?id=".$_POST['tipo_costo']."&Actualizado");
	}
	else{
		header("Location:../../Mantenedores/Costos/costos.php?id=".$_POST['tipo_costo']."&&ErrorActualizando");
	}
}

if(isset($_GET['Elimcosto'])){
	if(elimina_costo($_GET['Elimcosto'])){
		header("Location:../../Mantenedores/Costos/costos.php?id=".$_GET['id']."&Eliminado");
	}
	else{
		header("Location:../../Mantenedores/Costos/costos.php?id=".$_GET['id']."&ErrorEliminando");
	}
}
















if(isset($_POST['ingesanuevafamiliakaraoke'])){
	if(inserta_familia_kareaoke($_POST['nombre'])){
		header("Location:../../Mantenedores/Karaokes/index.php?Ingresado");
	}
	else{
		header("Location:../../Mantenedores/Karaokes/index.php?ErrorIngresando");
	}
}

if(isset($_POST['actualizafamiliakaraoke'])){
	if(actualiza_familia_kareaoke($_POST['nombre'], $_POST['actualizafamiliakaraoke'])){
		header("Location:../../Mantenedores/Karaokes/index.php?Actualizado");
	}
	else{
		header("Location:../../Mantenedores/Karaokes/index.php?ErrorActualizando");
	}
}

if(isset($_GET['elimfamiliakaraoke'])){
	if(elimina_familia_kareaoke($_GET['elimfamiliakaraoke'])){
		header("Location:../../Mantenedores/Karaokes/index.php?Eliminado");
	}
	else{
		header("Location:../../Mantenedores/Karaokes/index.php?ErrorEliminando");
	}
}


if(isset($_POST['ingresanuevacancion'])){
	if(inserta_cancion($_POST['nombre'], $_POST['artista'], $_POST['ofamilia_karaoke'])){
		header("Location:../../Mantenedores/Karaokes/karaokes.php?id=".$_POST['ofamilia_karaoke']."&Ingresado");
	}
	else{
		header("Location:../../Mantenedores/Karaokes/karaokes.php?id=".$_POST['ofamilia_karaoke']."&ErrorIngresando");
	}
}

if(isset($_POST['actualizacancion'])){
	if(actualiza_cancion($_POST['nombre'], $_POST['artista'], $_POST['actualizacancion'])){
		header("Location:../../Mantenedores/Karaokes/karaokes.php?id=".$_POST['ofamilia_karaoke']."&Actualizado");
	}
	else{
		header("Location:../../Mantenedores/Karaokes/karaokes.php?id=".$_POST['ofamilia_karaoke']."&ErrorActualizando");
	}
}

if(isset($_GET['Elimcancion'])){
	if(elimina_cancion($_GET['Elimcancion'])){
		header("Location:../../Mantenedores/Karaokes/karaokes.php?id=".$_GET['id']."&Eliminado");
	}
	else{
		header("Location:../../Mantenedores/Karaokes/karaokes.php?id=".$_GET['id']."&ErrorEliminando");
	}
}


if(isset($_GET['PedirCancion'])){
	if(solicitar_cancion($_GET['PedirCancion'], $_GET['mesa_id'])){
		header("Location:../../Clientes/pedir_karaoke.php?id=".$_GET['id']."&mesa_id=".$_GET['mesa_id']."&Mesa=".$_GET['Mesa']."&Realizado");
	}
	else{
		header("Location:../../Clientes/pedir_karaoke.php?id=".$_GET['id']."&mesa_id=".$_GET['mesa_id']."&Mesa=".$_GET['Mesa']."&ErrorPedido");
	}
}

if(isset($_GET['CambiaEstadocancion'])){
	if(cambia_estado_pedido_karaoke($_GET['CambiaEstadocancion'])){
		header("Location:../../Mantenedores/Djs/index.php?Cambiado");
	}
	else{
		header("Location:../../Mantenedores/Djs/index.php?ErrirCambiando");
	}
}


if(isset($_POST['ofacturaIngresa'])){
	$factura = $_POST['ofacturaIngresa'];
	$cliente = $_POST['cliente'];
	$num_factura = $_POST['numerofactura'];
	$fecha_vencimiento = $_POST['fecha_vencimiento'];
	$fpago = $_POST['fpago'];
	$impuesto_adicional = $_POST['impuesto_adicional'];
	$servicios_logic = $_POST['servicios_logic'];
	$retencion = $_POST['retencion'];
	$iaba = $_POST['iaba'];
	$ila = $_POST['ila'];
	$descuento = $_POST['descuento'];
	$iva = $_POST['oiva'];
	$total_nuevo = $_POST['ototal2'] + $impuesto_adicional + $servicios_logic + $retencion + $iaba + $ila - $descuento;
	$cheque = $_POST['nro_cheque'];
	inserta_compra2($factura, $num_factura, $cliente, date("Y-m-d"), $fecha_vencimiento, $fpago, $_SESSION['id'], $descuento, $iva, $ila, $iaba, $impuesto_adicional, $servicios_logic, $retencion, $_POST['ototal2'] - $iva, $total_nuevo, $cheque);
	inserta_compra_detalle2($factura);
	elimina_tmp($factura);
	//header("Location://caferealsistema.servehttp.com:81/demosistreal/Compras/index.php");
	header("Location:../../Compras/index.php");
}

if(isset($_GET['ElimFactura'])){

	elimina_compra_by_id($_GET['ElimFactura']);
	header("Location:../../Compras/index.php?Eliminada");
}



if(isset($_POST['oOcIngresa'])){
	$oc = $_POST['oOcIngresa'];
	$cliente = $_POST['cliente'];
	$fecha_compra = $_POST['fechac'];
	$fpago = $_POST['fpago'];	
	ingresa_orden_compra(date("Y-m-d"), date("H:i:s"), $fecha_compra, $cliente ,
		$_SESSION['id'] , $fpago);
	$oc = mysql_insert_id();
	inserta_orden_compra_detalle2($oc);
	elimina_tmp_oc($oc);
	header("Location:../../Mantenedores/OC/index.php?Ingresada");
	//inserta_compra2($factura, $num_factura, $cliente, date("Y-m-d"), $fecha_vencimiento, $fpago, $_SESSION['id'], $descuento, $iva, $ila, $iaba, $impuesto_adicional, $servicios_logic, $retencion, $_POST['ototal2'], $total_nuevo);
	//inserta_compra_detalle2($factura);
	//elimina_tmp($factura);
	//header("Location://caferealsistema.servehttp.com:81/sistreal/Compras/index.php");
}



//AGREGA FUNCIONES PARA APP
if(isset($_POST['ingresaproveedor2'])){
	if(ingresa_nuevo_proveedor($_POST['idprov'], $_POST['nombreprov'], $_POST['fonoprov'], $_POST['contactoprov'], $_POST['estadoprov'])){
		header("Location:../../Mantenedores/Proveedores/index.php?Ingresado");
	}
	else{
		header("Location:../../Mantenedores/Proveedores/index.php?ErrorIngresando");
	}
}

if(isset($_POST['Actidproveedor2'])){
	if(actualiza_proveedor($_POST['idprov'], $_POST['nombreprov'], $_POST['fonoprov'], $_POST['contactoprov'], $_POST['Actidproveedor2'], $_POST['estadoprov'])){
		header("Location:../../Mantenedores/Proveedores/index.php?Actualizado");
	}
	else{
		header("Location:../../Mantenedores/Proveedores/index.php?ErrorActualizando");
	}
}




if(isset($_POST['omovcambiaproduto'])){
	echo "MOV->".$_POST['omovcambiaproduto'].", PREPID->".$_POST['opreparado_id'].", CANT ANTES->".$_POST['cantidad_antes'].", CANT DESP->".$_POST['cantidad_nueva'];
	if(inserta_temp_ventas_detalles($_POST['omovcambiaproduto'], $_POST['opreparado_id'], $_POST['cantidad_antes'], $_POST['cantidad_nueva'], $_POST['onpedido'])){
		header("Location:../../Pedidos/cerrarped.php?Cambiado&Mov=".$_POST['omovcambiaproduto']."&pedircuenta");
	}
	else{
		header("Location:../../Pedidos/cerrarped.php?ErrorIngresando&Mov=".$_POST['omovcambiaproduto']."&pedircuenta");
	}
}


if(isset($_GET['oidpagotemporal'])){

	if(ingresa_boleta_elec_temp($_GET['oidpagotemporal'], $_GET['ototal'], $_GET['omesa_id'], $_GET['ototaltemporal'], $_GET['propina_temporal'], $_GET['fpago_temporal'], $_GET['nomcli_temporal'], $_SESSION['id'], $_GET['monto_pago_temporal'], $_GET['vuelto_temporal'], $_GET['boleta_temporal'])){
		actualiza_estado_temp_ventas_datalles($_GET['oidpagotemporal'], 1);
		header("Location:../../Pedidos/cerrarped.php?Mov=".$_GET['oidpagotemporal']."&pedircuenta");
	}
	else{
		header("Location:../../Pedidos/cerrarped.php?Mov=".$_GET['oidpagotemporal']."&ProblemasAlPagar");	
	}
}


if(isset($_POST['oIdVtaImprimir'])){
	$npedido = $_POST['npedido'];
	$vta_id = $_POST['oIdVtaImprimir'];
	$impresora_id = $_POST['impresora'];
	$impresora = get_impresora_url($impresora_id);
	$nombrearchivo = $vta_id."-".$npedido.".pdf";
	$ubicacion = "../../boletas/tickets/".$nombrearchivo;

	if (file_exists($ubicacion)){
		$salida = shell_exec("lpr -P ".$impresora." ".$ubicacion."");
		header("Location:../../Pedidos/ver_pedido.php?ReImpreso");
	}

	//REVISA SI HAY HAPPY
	$preparados_happy = get_happy_preparados($vta_id, 0);
    foreach ($preparados_happy as $key => $prep_happy) {
      $preparado = get_preparados_id($prep_happy['preparado_id']);
      $nombrearchivohappy = "happy-".$prep_happy['preparado_id']."-".$vta_id.".pdf";
      $ubicacionhappy = "../boletas/happy/".$nombrearchivohappy;
      if (file_exists($ubicacionhappy)){
      	for($z=0; $z < $prep_happy['cantidad']; $z++ ){
      		$salida = shell_exec("lpr -P ".$impresora." ".$ubicacionhappy."");
			header("Location:../../Pedidos/ver_pedido.php?ReImpreso");
		}
      }
    }

    //REVISA SI HAY A LA COCINA
    $nombrearchivococina = $vta_id."-".$npedido.".pdf";
    $ubicacioncocina = "../../boletas/tickets/cocina/".$nombrearchivococina;
    if (file_exists($ubicacioncocina)){
    	$salida = shell_exec("lpr -P COCINA ".$ubicacioncocina."");  
    }
}


if(isset($_GET['ElimpedidotablaTemporal'])) {
	if(elimina_vta_detalle_temporal($_GET['ElimpedidotablaTemporal'])){
		header("Location:../../Pedidos/cerrarped.php?Mov=".$_GET['Mov']."&pedircuenta&Eliminado");
	}
	else{
		header("Location:../../Pedidos/cerrarped.php?Mov=".$_GET['Mov']."&pedircuenta&ErrorEliminando");
	}
}



//MOD CCS
if(isset($_POST['ingresacc'])){
	if(ingresa_nuevo_cc($_POST['cc'], $_POST['cantidad_onzas'])){
		header("Location:../../Mantenedores/Ccs/index.php?Ingresado");
	}
	else{
		header("Location:../../Mantenedores/Ccs/index.php?ErrorIngresando");
	}
}
if(isset($_GET['ElimidCc'])){
	if(elimina_cc($_GET['ElimidCc'])){
		header("Location:../../Mantenedores/Ccs/index.php?Eliminado");
	}
	else{
		header("Location:../../Mantenedores/Ccs/index.php?ErrorEliminando");
	}
}
if(isset($_POST['ActidCc'])){
	if(actualiza_cc($_POST['cc'], $_POST['cantidad_onzas'], $_POST['ActidCc'])){
		header("Location:../../Mantenedores/Ccs/index.php?Actualizado");
	}
	else{
		header("Location:../../Mantenedores/Ccs/index.php?ErrorActualizando");
	}
}




if(isset($_POST['ingresaegreso'])){
	if(inserta_egreso($_POST['montoegreso'], $_POST['motivoegreso'], $_SESSION['id'])){
		header("Location:../../Mantenedores/Egresos/index.php?Ingresado");
	}
	else{
		header("Location:../../Mantenedores/Egresos/index.php?ErrorIngresando");
	}
}

if(isset($_POST['ActidEgreso'])){
	if(actualiza_egreso($_POST['montoegreso'], $_POST['motivoegreso'], $_POST['ActidEgreso'])){
		header("Location:../../Mantenedores/Egresos/index.php?Actualizado");
	}
	else{
		header("Location:../../Mantenedores/Egresos/index.php?ErrorActualizando");
	}
}

if(isset($_GET['ElimidEgreso'])){
	if(elimina_egreso($_GET['ElimidEgreso'])){
		header("Location:../../Mantenedores/Egresos/index.php?Eliminado");
	}
	else{
		header("Location:../../Mantenedores/Egresos/index.php?ErrorEliminando");
	}
}




if(isset($_POST['ingresacategoria'])){
	if(ingresa_nueva_categoria($_POST['nombrecategoria'])){
		header("Location:../../Mantenedores/Categorias/index.php?Ingresado");
	}
	else{
		header("Location:../../Mantenedores/Categorias/index.php?ErrorIngresando");
	}
}
if(isset($_GET['ElimidCategoria'])){
	if(elimina_categoria($_GET['ElimidCategoria'])){
		header("Location:../../Mantenedores/Categorias/index.php?Eliminado");
	}
	else{
		header("Location:../../Mantenedores/Categorias/index.php?ErrorEliminando");
	}
}
if(isset($_POST['ActidCategoria'])){
	if(actualiza_categoria($_POST['nombrecategoria'], $_POST['ActidCategoria'])){
		header("Location:../../Mantenedores/Categorias/index.php?Actualizado");
	}
	else{
		header("Location:../../Mantenedores/Categorias/index.php?ErrorActualizando");
	}
}

?>
