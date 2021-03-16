<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
ini_set("session.cookie_lifetime","7200");
ini_set("session.gc_maxlifetime","7200");
session_start();
include("seguridad.php");
if(!validaringreso())
    header('Location:../../index.php?NOCINICIA');
date_default_timezone_set('America/Santiago');
include("controlador.php");
include("../phpmailer/sendmail.php");



if(isset($_GET['ElimMesa'])){
	if(elimina_pedido_volver($_GET['ElimMesa'],  'VOLVER DESDE MANT')){
		header("Location:../../Pedidos/index.php?Eliminado");
	}
	else{
		header("Location:../../Pedidos/index.php?ErrorEliminando");
	}
}


if(isset($_GET['btnpagarpedido'])){

	if($_SESSION['id'] == ""){
		header('Location:../../index.php?NOCINICIA');
	}


	$totcpro = $_GET['ototalmenosdescu'] + $_GET['propina'];
	$descuentos = $_GET['descuento'] + $_GET['descuento_especial'] + $_GET['descuento_puntos'];
	if($_GET['ototalmenosdescu'] > 0){

		if(($_GET['fpago'] == 1) || ($_GET['fpago'] == 4) || ($_GET['fpago'] == 8)){
			if(ingresa_boleta_elec($_GET['omov'], $totcpro, $_GET['omesa'], $_GET['ototalmenosdescu'], $_GET['monto_pagado'], $_GET['propina'], $_GET['fpago'], $_GET['nomcli'], $_SESSION['id'], $_GET['boleta'], $descuentos)){
				actualiza_estado_venta_detalle($_GET['omov'], 1);
				header("Location:../../Pedidos/ver_pedido.php?Pagado");	
			}
			else{
				header("Location:../../Pedidos/ver_pedido.php?ErrorPagando");
			}
		}
		else{
			if(ingresa_nueva_forma_pago2($_GET['omov'], $totcpro, $_GET['omesa'], $_GET['ototalmenosdescu'], $_GET['monto_pagado'], $_GET['propina'], $_GET['fpago'], $_GET['nomcli'], $_SESSION['id'], $_GET['boleta'])){
				actualiza_estado_venta_detalle($_GET['omov'], 1);
				header("Location:../../Pedidos/ver_pedido.php?Pagado");	
			}
			else{
				header("Location:../../Pedidos/ver_pedido.php?ErrorPagando");
			}
		}	
	}


	else{
		if(ingresa_nueva_forma_pago2($_GET['omov'], $totcpro, $_GET['omesa'], $_GET['ototalmenosdescu'], $_GET['monto_pagado'], $_GET['propina'], $_GET['fpago'], $_GET['nomcli'], $_SESSION['id'], $_GET['boleta'])){
			actualiza_estado_venta_detalle($_GET['omov'], 1);
			header("Location:../../Pedidos/ver_pedido.php?Pagado");	
		}
		else{
			header("Location:../../Pedidos/ver_pedido.php?ErrorPagando");
		}	
	}
	
}




if(isset($_GET['btnpagarpedidodirecto'])){
	$totcpro = $_GET['ototalmenosdescu'] + $_GET['propina'];
	ingresa_nueva_forma_pago3($_GET['omov'], $totcpro, $_GET['omesa'], $_GET['ototalmenosdescu'], $_GET['monto_pagado'], $_GET['propina'], $_GET['fpago'], $_GET['nomcli'], $_SESSION['id'], $_GET['boleta']);
	include("generarpedidodirecto.php");
	imprime_cocinadirecto($_GET['omov'], 1, '', $_SESSION['id'], $_GET['omesa']);
	imprime_directo($_GET['omov'], $_SESSION['id'], $totcpro, $_GET['monto_pagado'], $_GET['fpago']);
	header("Location:../../Pedidos/index.php?Venta_realizada");
}


if(isset($_GET['btnpagarpedidoentrada'])){
	$totcpro = $_GET['ototalmenosdescu'] + $_GET['propina'];
	ingresa_nueva_forma_pago3($_GET['omov'], $totcpro, $_GET['omesa'], $_GET['ototalmenosdescu'], $_GET['monto_pagado'], $_GET['propina'], $_GET['fpago'], $_GET['nomcli'], $_SESSION['id'], $_GET['boleta']);
	include("generarpedidocover.php");
	imprime_entrada($_GET['omov'], $_SESSION['id']);
	header("Location:../../Pedidos/index.php?Venta_entrada_realizada");
}



if(isset($_POST['Omesamodal'])){
	$socio_id = get_socio_id_nombre($_POST['socio']);
	if(inserta_vta(date("Y-m-d"), date("H:i:s"), 0, $_POST['Omesamodal'], $_SESSION['id'], date("Y-m-d H:i:s"), $_SESSION['turno'], 0)){
		$vta_id = mysql_insert_id();
		if(actualiza_mesa($_POST['Omesamodal'], 1)){
			if($_POST['socio'] != " "){
				inserta_vta_socio(date("Y-m-d"), date("H:i:s"), $vta_id, $socio_id);
			}
			header("Location:../../Pedidos/toma_nuevo_pedido.php?Vta_id=".$vta_id."&npedido=1");
		}
		else{
			header("Location:../../Pedidos/orden.php?ErrorActMesa");
		}
	}
	else{
		header("Location:../../Pedidos/orden.php?ErrorInsertaVenta");
	}

}



if(isset($_GET['AgregaNuevopedido'])){
	echo "prod->".$_GET['preparado_id'].", id->".$_GET['id'];
	if(inserta_venta_detalle2($_GET['preparado_id'], $_GET['id'], date("Y-m-d"), date("H:i:s"), $_GET['npedido'])){
		//AQUI VA EL REBAJE DE STOCK
		descuentaStock_preparados($_GET['preparado_id'], 1, $_GET['id']);
		//VALIDA STOCK CRITICO
		$es_happy = get_preparados_id($_GET['preparado_id']);
		if($es_happy['es_happy'] == 1){
			inserta_preparados_happy($_GET['id'], $_GET['preparado_id'], 1);
		}
		header("Location:../../Pedidos/toma_nuevo_pedido.php?Vta_id=".$_GET['id']."&npedido=".$_GET['npedido']."");
	}
	else{
		header("Location:../../Pedidos/toma_nuevo_pedido.php?Error&Vta_id=".$_GET['id']."&npedido=".$_GET['npedido']."");
	}
}



if(isset($_POST['AgregaNuevopedido'])){
	//echo "prod->".$_POST['preparado_id'].", id->".$_POST['id'].", CANTIDAD->".$_POST['cantidad'].", OBS->".$_POST['observacion'];
	if($_POST['observacion'] == " "){
		$observacion = "-";
	}
	else{
		$observacion = $_POST['observacion'];
	}
	if(inserta_venta_detalle($_POST['cantidad'], $_POST['npedido'], $_POST['observacion'], $_POST['preparado_id'], $_POST['id'], date("Y-m-d"), date("H:i:s"))){
		$vta_detalle_id = mysql_insert_id();
		$es_happy = get_preparados_id($_POST['preparado_id']);
		//AQUI VA EL REBAJE DE STOCK
		//descuentaStock_preparados($_POST['preparado_id'], $_POST['cantidad'], $_POST['id']);
		if($es_happy['es_happy'] != 1){
			descuentaStock_preparados($_POST['preparado_id'], $_POST['cantidad'], $_POST['id']);
		}
		else{
			descuentaStock_preparados_happy($_POST['preparado_id'], $_POST['cantidad'], $_POST['id']);	
			$cant_happy = $_POST['cantidad'] * 2;
			inserta_preparados_happy($_POST['id'], $_POST['preparado_id'], $_POST['cantidad'], $vta_detalle_id);
			//for($i=0; $i < $cant_happy; $i++){
			//	inserta_preparados_happy_pedidos($_POST['id'], $_POST['preparado_id'], 1);
			//}
		}
		//VALIDA STOCK CRITICO
		header("Location:../../Pedidos/toma_nuevo_pedido.php?Vta_id=".$_POST['id']."&npedido=".$_POST['npedido']."");
	}
	else{
		header("Location:../../Pedidos/toma_nuevo_pedido.php?Error&Vta_id=".$_POST['id']."&npedido=".$_POST['npedido']."");
	}
}


if(isset($_GET['AgregaNuevopedidoCliente'])){
	if(inserta_venta_detalle2($_GET['preparado_id'], $_GET['id'], date("Y-m-d"), date("H:i:s"), $_GET['npedido'])){
		//AQUI VA EL REBAJE DE STOCK
		descuentaStock_preparados($_GET['preparado_id'], $_POST['cantidad'], $_GET['id']);
		//VALIDA STOCK CRITICO
		$es_happy = get_preparados_id($_GET['preparado_id']);
		if(($es_happy['PREPARADOS_FAMILIA'] == 50) || ($es_happy['PREPARADOS_FAMILIA'] == 98) 
		|| ($es_happy['PREPARADOS_FAMILIA'] == 99) || ($es_happy['PREPARADOS_FAMILIA'] == 100)
		|| ($es_happy['PREPARADOS_FAMILIA'] == 101) || ($es_happy['PREPARADOS_FAMILIA'] == 102)
		|| ($es_happy['PREPARADOS_FAMILIA'] == 103) || ($es_happy['PREPARADOS_FAMILIA'] == 104) 
		|| ($es_happy['PREPARADOS_FAMILIA'] == 110) || ($es_happy['es_happy'] == 1)){
			inserta_preparados_happy($_GET['id'], $_GET['preparado_id'], 1);
		}
		header("Location:../../Clientes/toma_nuevo_pedido.php?Vta_id=".$_GET['id']."&npedido=".$_GET['npedido']."");
	}
	else{
		header("Location:../../Pedidos/toma_nuevo_pedido.php?Error&Vta_id=".$_GET['id']."&npedido=".$_GET['npedido']."");
	}
}


if(isset($_POST['AgregaNuevopedidoCliente'])){
	if($_POST['observacion'] == " "){
		$observacion = "-";
	}
	else{
		$observacion = $_POST['observacion'];
	}
	if(inserta_venta_detalle($_POST['cantidad'], $_POST['npedido'], $_POST['observacion'], $_POST['preparado_id'], $_POST['id'], date("Y-m-d"), date("H:i:s"))){
		//AQUI VA EL REBAJE DE STOCK
		descuentaStock_preparados($_POST['preparado_id'], $_POST['cantidad'], $_POST['id']);
		//VALIDA STOCK CRITICO
		$es_happy = get_preparados_id($_POST['preparado_id']);
		if(($es_happy['PREPARADOS_FAMILIA'] == 50) || ($es_happy['PREPARADOS_FAMILIA'] == 98) 
		|| ($es_happy['PREPARADOS_FAMILIA'] == 99) || ($es_happy['PREPARADOS_FAMILIA'] == 100)
		|| ($es_happy['PREPARADOS_FAMILIA'] == 101) || ($es_happy['PREPARADOS_FAMILIA'] == 102)
		|| ($es_happy['PREPARADOS_FAMILIA'] == 103) || ($es_happy['PREPARADOS_FAMILIA'] == 104) 
		|| ($es_happy['PREPARADOS_FAMILIA'] == 110) || ($es_happy['es_happy'] == 1)){
			inserta_preparados_happy($_POST['id'], $_POST['preparado_id'], 1);
		}
		header("Location:../../Clientes/toma_nuevo_pedido.php?Vta_id=".$_POST['id']."&npedido=".$_POST['npedido']."");
	}
	else{
		header("Location:../../Pedidos/toma_nuevo_pedido.php?Error&Vta_id=".$_POST['id']."&npedido=".$_POST['npedido']."");
	}
}


// ----------------- INICIO INSERCION ABONO --------------------------------- //
if(isset($_POST['montoabono'])){
	$glosa = "Abono N ".$_POST['Onabono'];
	//AGREGA MESA FICTICIA PARA DEJAR CONSTANCIA DE ABONO
	//MESA DE ABONOS SERA LA 7777
	if(inserta_vta(date("Y-m-d"), date("H:i:s"), 1, 7777, $_SESSION['id'], date("Y-m-d H:i:s"), $_SESSION['turno'], 0)){
		$vta_id = get_vta_id(date("Y-m-d"), date("H:i:s"), 1, 7777, $_SESSION['id']);
		if(inserta_vta_pago($_POST['montoabono'], date("Y-m-d"), date("H:i:s"), $vta_id, 5, $_SESSION['id'], date("Y-m-d H:i:s"))){
			if(inserta_cliente_abono(2, date("Y-m-d"), $glosa, $_POST['montoabono'], $_POST['cliente_id'], $vta_id)){
				if(inserta_cta_cte(date("Y-m-d"), date("H:i:s"), $_POST['montoabono'], $_POST['cliente_id'], 2, $vta_id)){
					$cli = get_cliente_id($_POST['cliente_id']);
					$usu = get_tipo_usuario_nombre_id($usu);
					enviarcorreoabonos($vta_id, $_POST['montoabono'], $cli['rut'], date("H:i:s"), $_SESSION['id'], $cli['nombre'], $cli['correo']);
					header("Location:../../Mantenedores/Clientes/index.php?Ingresando");
				}
				else{
					header("Location:../../Mantenedores/Clientes/clientes.php?ErrorIngresando4");
				}
			}
			else{
				header("Location:../../Mantenedores/Clientes/clientes.php?ErrorIngresando3");
			}
		}
		else{
			header("Location:../../Mantenedores/Clientes/clientes.php?ErrorIngresando2");
		}
	}
	else{
		header("Location:../../Mantenedores/Clientes/clientes.php?ErrorIngresando1");
	}

}


// ----------------- FIN INSERCION ABONO --------------------------------- //

// TOMAR UNA MESA
if(isset($_GET['mesa'])){
	if(inserta_vta(date("Y-m-d"), date("H:i:s"), 0, $_GET['mesa'], $_SESSION['id'], date("Y-m-d H:i:s"), $_SESSION['turno'])){
		$vta_id = mysql_insert_id();
		if(actualiza_mesa($_GET['mesa'], 1)){
			//$vta_id = get_vta_id(date("Y-m-d"), date("H:i:s"), 0, $_GET['mesa'], $_SESSION['id']);
			if((isset($_GET['socioreal'])) && ($_GET['socioreal'] != "")){
				$mystring = $_GET['socioreal'];
	            $findme   = '>'; //24
	            $pos = strpos($mystring, $findme);
	            $largo = strlen($_GET['socioreal']);
	            $rutsocio = substr($_GET['socioreal'], $pos+1, ($largo-$pos));
	            $socio_id = get_socio_id_rut($rutsocio);
	            if(inserta_vta_socio(date("Y-m-d"), date("H:i:s"), $vta_id, $socio_id)){
	            	header("Location:../pedido/tomapedido_socio.php?Vta_id=".$vta_id."&npedido=1&Socio_id=".$socio_id);
	            }
	            else{
	            	header("Location:../pedido/orden.php?ErrorInsertar1");
	            }
			}
			else{
				header("Location:../pedido/tomapedido.php?Vta_id=".$vta_id."&npedido=1");
			}
		}
		else{
			header("Location:../pedido/orden.php?ErrorInsertar3");
		}
	}
	else{
		header("Location:../pedido/orden.php?ErrorInsertar4");
	}
}

// FIN TOMAR UNA MESA

// ELIMINAR PEDIDO VENTA DETALLE
if(isset($_GET['Elimpedidotabla'])){
	if(isset($_GET['socio_id'])){

		//GUARDO LOS DATOS DE LA TABLA ANTES DE ELIMINARLOS PARA REBAJARLOS DEL STOCK
		$ventaDetalles = get_ventas_detalle_byId($_GET['Elimpedidotabla']);
		$idPreparado = $ventaDetalles[0]['preparado_id'];
		$cantidadAEliminar = $ventaDetalles[0]['cantidad'];


		if(elimina_vta_detalle_id($_GET['Elimpedidotabla'])){

			//ACA SE DEBE REPONER EL STOCK DESCONTADO
			descuentaStock_preparados_revertir($idPreparado, $cantidadAEliminar);
			//FIN STOCK DESCONTADO
			$cant_happy = get_cant_happy_producto($_GET['vta_id'], $idPreparado);
			if($cant_happy > 0){
				if(elimina_preparados_happy($_GET['vta_id'], $idPreparado)){

				}
			}
			header("Location:../pedido/tomapedido_socio.php?Vta_id=".$_GET['vta_id']."&npedido=".$_GET['npedido']."&Socio_id=".$_GET['socio_id']."");
		}
		else{
			header("Location:../pedido/tomapedido_socio.php?Vta_id=".$_GET['vta_id']."&npedido=".$_GET['npedido']."&Socio_id=".$_GET['socio_id']."&ErrorEliminando");
		}
	}
	else{

		//GUARDO LOS DATOS DE LA TABLA ANTES DE ELIMINARLOS PARA REBAJARLOS DEL STOCK
		$ventaDetalles = get_ventas_detalle_byId($_GET['Elimpedidotabla']);
		$idPreparado = $ventaDetalles[0]['preparado_id'];
		$cantidadAEliminar = $ventaDetalles[0]['cantidad'];

		if(elimina_vta_detalle_id($_GET['Elimpedidotabla'])){
			
			//ACA SE DEBE REPONER EL STOCK DESCONTADO
			descuentaStock_preparados_revertir($idPreparado, $cantidadAEliminar);
			//FIN STOCK DESCONTADO
			$cant_happy = get_cant_happy_producto($_GET['vta_id'], $idPreparado);
			if($cant_happy > 0){
				if(elimina_preparados_happy($_GET['vta_id'], $idPreparado)){

				}
			}

			header("Location:../pedido/tomapedido.php?Vta_id=".$_GET['vta_id']."&npedido=".$_GET['npedido']."");
		}
		else{
			header("Location:../pedido/tomapedido.php?Vta_id=".$_GET['vta_id']."&npedido=".$_GET['npedido']."&ErrorEliminando");
		}
	}
}



if(isset($_GET['Elimpedidotabla2'])){
	//GUARDO LOS DATOS DE LA TABLA ANTES DE ELIMINARLOS PARA REBAJARLOS DEL STOCK
	$ventaDetalles = get_ventas_detalle_byId($_GET['Elimpedidotabla2']);
	$idPreparado = $ventaDetalles[0]['preparado_id'];
	$cantidadAEliminar = $ventaDetalles[0]['cantidad'];

	if(elimina_vta_detalle_id($_GET['Elimpedidotabla2'])){
		
		//ACA SE DEBE REPONER EL STOCK DESCONTADO
		descuentaStock_preparados_revertir($idPreparado, $cantidadAEliminar);
		//FIN STOCK DESCONTADO
		$cant_happy = get_cant_happy_producto($_GET['vta_id'], $idPreparado);
		if($cant_happy > 0){
			if(elimina_preparados_happy($_GET['vta_id'], $idPreparado)){

			}
		}

		header("Location:../../Pedidos/toma_nuevo_pedido.php?Vta_id=".$_GET['vta_id']."&npedido=".$_GET['npedido']."");
	}
	else{
		header("Location:../../Pedidos/toma_nuevo_pedido.php?Vta_id=".$_GET['vta_id']."&npedido=".$_GET['npedido']."&ErrorEliminando");
	}
	
}
// FIN ELIMINAR PEDIDO VENTA DETALLE



if(isset($_GET['canjear_puntos'])){
	$socio = get_socio_id($_GET['socio_id']);
    $nombre_socio = utf8_encode($socio['nombre']);
	inserta_descuento_puntos_socio($_GET['socio_id'], $_GET['ptos'], $_GET['movimiento']);
	actualiza_puntos_socios($_GET['socio_id'], 1);
	notifica_canjie_puntos($_GET['socio_id'], $_GET['ptos'], $_GET['movimiento'], $_GET['Mesa'], $nombre_socio);
	header("Location:../../qrclientes.php?qrcli&Mesa=".$_GET['Mesa']."");
}




//ADICIONAL SHEOL ////////

if(isset($_GET['venta_entrada'])){
	//MESA DE VENTA ENTRADAS SERA 8888
	if(inserta_vta2(date("Y-m-d"), date("H:i:s"), 1, 8888, $_SESSION['id'], date("Y-m-d H:i:s"), $_SESSION['turno'], 0, 0)){
		$vta_id = mysql_insert_id();;
		header("Location:../../Pedidos/venta_cover.php?id=".$vta_id."");
	}
	else{
		header("Location:../../Pedidos/index.php?ErrorIngresando1");
	}
}


if(isset($_POST['movimient_cover'])){
	//echo "prod->".$_GET['preparado_id'].", id->".$_GET['movimient_cover'];
	if(inserta_venta_detalle($_POST['cantidad'], 1, $_POST['observacion'], $_POST['preparado_id'], $_POST['movimient_cover'], date("Y-m-d"), date("H:i:s"))){
		
		header("Location:../../Pedidos/venta_cover.php?id=".$_POST['movimient_cover']."");
	}
	else{
		header("Location:../../Pedidos/venta_cover.php?Error&id=".$_POST['movimient_cover']."");
	}
}

if(isset($_GET['Elimpedidotabla3'])){
	//GUARDO LOS DATOS DE LA TABLA ANTES DE ELIMINARLOS PARA REBAJARLOS DEL STOCK
	$ventaDetalles = get_ventas_detalle_byId($_GET['Elimpedidotabla3']);
	$idPreparado = $ventaDetalles[0]['preparado_id'];
	$cantidadAEliminar = $ventaDetalles[0]['cantidad'];

	if(elimina_vta_detalle_id($_GET['Elimpedidotabla3'])){

		header("Location:../../Pedidos/venta_cover.php?id=".$_GET['vta_id']."");
	}
	else{
		header("Location:../../Pedidos/venta_cover.php?id=".$_GET['vta_id']."&ErrorEliminando");
	}
	
}




//LERR CODIGO DE BARRA
if(isset($_POST['agregaarticulo'])){
	$id = $_POST['agregaarticulo'];
	$revisa_ticket = substr($id, 0, 1);


	//REVISA SI ES HAPY
	if($revisa_ticket == "H"){
		$ticket_id = substr($id, 6);
		$busqueda = $id;
		$largobusqueda = strlen($busqueda);
		$busvtadet   = 'D';
		$busmovi   = 'M';
		$posvtadet = strpos($busqueda, $busvtadet);
		$posmovi = strpos($busqueda, $busmovi);
		$vta_det_id = substr($busqueda, ($posvtadet+1),  ($largobusqueda - ($posvtadet+1)));
		$prep_id = substr($busqueda, 1, ($posmovi-1));
		$movi = substr($busqueda, ($posmovi+1), ($posvtadet  - ($posmovi + 1)));
		$happy_canjeado = es_happy_canjeado($vta_det_id);
		$cantidad_canjeados = get_cant_happy_canjeados($prep_id, $movi, $vta_det_id);
		$happy_solicitados = get_happys_solicitados($prep_id, $movi, $vta_det_id);
		// echo "COD->".$busqueda.", posvtadet->".$posvtadet.", vta_det_id->".$vta_det_id.", PREP->".$prep_id.", MOVI->".$movi.", CANT->".$cantidad_canjeados.", CANT PED->".$happy_solicitados;
		// echo "<br>".$happy_canjeado;
		//REVISAR SI YA ESTAN COBRADOS TODOS
		if($happy_solicitados-1 > $cantidad_canjeados){
			$productos_onzas = get_productos_onzas_happy($prep_id);
			$cantidad_pedido_vta_det = get_cantidad_pedido_vta_det_by_id($vta_det_id);
			rebajar_happy_stock($productos_onzas, $cantidad_pedido_vta_det, $movi);
			actualiza_estado_vta_detalle_by_id($vta_det_id);
			inserta_happy_canjeado($prep_id, $movi, $vta_det_id);
			// echo "LARGO->".$largobusqueda."<br>";
			// echo "PREP->".$prep_id."<br>";
			// echo "VTADET->".$vta_det_id."<br>";
			// echo "MOV->".$movi."<br>";
			// print_r($productos_onzas);
			header("Location:../../Pedidos/leer_cod_barra.php?HappyRebajado&id=$id&preparado_id=$prep_id&vta_det_id=$vta_det_id");
		}
		else{
			//echo "Jdjdjdj";
			header("Location:../../Pedidos/leer_cod_barra.php?HappyCanjeado&id=$id");
		}



		// if($happy_canjeado == 0){
		// 	$productos_onzas = get_productos_onzas_happy($prep_id);
		// 	$cantidad_pedido_vta_det = get_cantidad_pedido_vta_det_by_id($vta_det_id);
		// 	rebajar_happy_stock($productos_onzas, $cantidad_pedido_vta_det, $movi);
		// 	actualiza_estado_vta_detalle_by_id($vta_det_id);
		// 	// echo "LARGO->".$largobusqueda."<br>";
		// 	// echo "PREP->".$prep_id."<br>";
		// 	// echo "VTADET->".$vta_det_id."<br>";
		// 	// echo "MOV->".$movi."<br>";
		// 	// print_r($productos_onzas);
		// 	header("Location:../../Pedidos/leer_cod_barra.php?HappyRebajado&id=$id&preparado_id=$prep_id&vta_det_id=$vta_det_id");
		// }
		// else{
		// 	header("Location:../../Pedidos/leer_cod_barra.php?HappyCanjeado&id=$id");
		// }
		
		//$hay_descu_happy = get_productos_onzas_by_id($ticket_id);
		//echo $hay_descu_happy;
		//$estado_happy = get_estado_happy();
	}
	//FIN REVISA SI ES HAPPY


	else{
		//REVISA SI ES COVER
		$revisa_ticket = substr($id, 0, 7);
		if($revisa_ticket == "ENTRADA"){
			$largobusqueda = strlen($id);
			$id = substr($id, 8, ($largobusqueda - 8));
			$estado_cover = get_estado_cover($id);
			//ES COVER
			if($estado_cover == 0){
				$detalles_cover = get_ventas_detalles_id($id);
				foreach ($detalles_cover as $key => $venta_detalle) {
					descuentaStock_preparados($venta_detalle['preparado_id'], $venta_detalle['cantidad'], $id);
				}
				actualiza_estado_cover($id);
				header("Location:../../Pedidos/leer_cod_barra.php?Realizado&id=$id");
			}
			else if($estado_cover == 1){
				header("Location:../../Pedidos/leer_cod_barra.php?Canjeado");
			}
			else{
				header("Location:../../Pedidos/leer_cod_barra.php?NoesCover");
			}

		}
		else{
			header("Location:../../Pedidos/leer_cod_barra.php?NoValido");
			//ACA SE AGREGA PARA MOSTRAR DETALLE DE PRODUCTO POR NRO DE MOV
		}
		//}
		// else{
		// 	$ventas_detalles = get_vta_detalle_by_estado($id);
		// 	//EXISTEN PRODUCTOS POR COBRAR
		// 	//FALTA VER EL CASO QUE SEA HAPPY YA QUE TENDRA SU PROPIO TICKET UNA IDEA ES HACER EL FILTRO POR HAPPY Y VALIDAR ACA LOS HAPPY
		// 	if($ventas_detalles != null){
		// 		foreach ($ventas_detalles as $key => $venta_detalle) {
		// 			$preparado = get_preparados_id($venta_detalle['preparado_id']);
		// 			//SI ES HAPPY NO HACE DESCUENTO AUN SOLO SE HACE CON SU TICKET
		// 			if($preparado['es_happy'] != 1){
		// 				descuentaStock_preparados($venta_detalle['preparado_id'], $venta_detalle['cantidad'], $id);	
		// 				actualiza_estado_venta_detalle_npedio($id, 1, $venta_detalle['npedido'], $venta_detalle['preparado_id']);
		// 			}
		// 			$nped = $venta_detalle['npedido'];
		// 			header("Location:../../Pedidos/leer_cod_barra.php?Realizado&id=$id&npedido=$nped&Pedido");
		// 		}
		// 	}
		// 	else{
		// 		header("Location:../../Pedidos/leer_cod_barra.php?CanjeadoPedido");
		// 	}
		// }
	}
	
}


if(isset($_GET['volverentrada'])){
	if(elimina_pedido($_GET['volverentrada'], '8888', 'NO SE COMPLETA VENTA ENTRADA')){
		header("Location:../../Pedidos/index.php?Eliminado");
	}
	else{
		header("Location:../../Pedidos/index.php?ErrorEliminando");
	}
}



//VENTA DIRECTA

if(isset($_GET['venta_directa'])){
	//MESA DE VENTA ENTRADAS SERA 9999
	if(inserta_vta2(date("Y-m-d"), date("H:i:s"), 1, 9999, $_SESSION['id'], date("Y-m-d H:i:s"), $_SESSION['turno'], 0, 0)){
		$vta_id = mysql_insert_id();;
		header("Location:../../Pedidos/venta_directa.php?id=".$vta_id."");
	}
	else{
		header("Location:../../Pedidos/index.php?ErrorIngresando1");
	}
}


if(isset($_POST['pedido_directo'])){
	//echo "prod->".$_POST['preparado_id'].", id->".$_POST['id'].", CANTIDAD->".$_POST['cantidad'].", OBS->".$_POST['observacion'];
	if($_POST['observacion'] == " "){
		$observacion = "-";
	}
	else{
		$observacion = $_POST['observacion'];
	}
	if(inserta_venta_detalle($_POST['cantidad'], 1, $_POST['observacion'], $_POST['preparado_id'], $_POST['id'], date("Y-m-d"), date("H:i:s"))){
		$vta_detalle_id = mysql_insert_id();
		$es_happy = get_preparados_id($_POST['preparado_id']);
		//AQUI VA EL REBAJE DE STOCK
		//descuentaStock_preparados($_POST['preparado_id'], $_POST['cantidad'], $_POST['id']);
		if($es_happy['es_happy'] != 1){
			descuentaStock_preparados($_POST['preparado_id'], $_POST['cantidad'], $_POST['id']);
		}
		else{
			descuentaStock_preparados_happy($_POST['preparado_id'], $_POST['cantidad'], $_POST['id']);	
			$cant_happy = $_POST['cantidad'] * 2;
			inserta_preparados_happy($_POST['id'], $_POST['preparado_id'], $_POST['cantidad'], $vta_detalle_id);
			//for($i=0; $i < $cant_happy; $i++){
			//	inserta_preparados_happy_pedidos($_POST['id'], $_POST['preparado_id'], 1);
			//}
		}
		//VALIDA STOCK CRITICO
		header("Location:../../Pedidos/venta_directa.php?id=".$_POST['id']."&npedido=1");
	}
	else{
		header("Location:../../Pedidos/venta_directa.php?Error&id=".$_POST['id']."&npedido=1");
	}
}

if(isset($_GET['ElimpedidotablaDirecto'])){
	//GUARDO LOS DATOS DE LA TABLA ANTES DE ELIMINARLOS PARA REBAJARLOS DEL STOCK
	$ventaDetalles = get_ventas_detalle_byId($_GET['ElimpedidotablaDirecto']);
	$idPreparado = $ventaDetalles[0]['preparado_id'];
	$cantidadAEliminar = $ventaDetalles[0]['cantidad'];

	if(elimina_vta_detalle_id($_GET['ElimpedidotablaDirecto'])){
		
		//ACA SE DEBE REPONER EL STOCK DESCONTADO
		descuentaStock_preparados_revertir($idPreparado, $cantidadAEliminar);
		//FIN STOCK DESCONTADO
		$cant_happy = get_cant_happy_producto($_GET['vta_id'], $idPreparado);
		if($cant_happy > 0){
			if(elimina_preparados_happy($_GET['vta_id'], $idPreparado)){

			}
		}

		header("Location:../../Pedidos/venta_directa.php?id=".$_GET['vta_id']."&npedido=".$_GET['npedido']."");
	}
	else{
		header("Location:../../Pedidos/venta_directa.php?id=".$_GET['vta_id']."&npedido=".$_GET['npedido']."&ErrorEliminando");
	}
	
}

//FIN ADICIONAL SHEOL ////////

?>
