<?php
session_start();
include("controlador.php");
date_default_timezone_set('America/Santiago'); 
$mov = $_POST['Omov'];
$mesa_posterior = get_mesa_by_num($_POST['mesa']);
$mesa_anterior = $_POST['Omesaant'];
$cantidad_a_mover = $_POST['cantidadmov'];
$cantidad_origen = $_POST['Ocantant'];
$preparado = $_POST['OmovProd'];
$npedido = $_POST['oNpedido'];
$vta_detalle_id = $_POST['Ovta_detalle_id'];

//MESA INGRESADA NO EXISTE
if($mesa_posterior == ""){
	header("Location:../../Pedidos/mover.php?Mov=".$mov."&MesaNoExiste");
}
else{

	// MOVER TODOS LOS PRODUCTOS DE UNA MESA A OTRA
	if((isset($_POST['btnmover'])) && (isset($_POST['Otodos']))){
		//REVISAR SI MESA A MOVER SE ENCUENTRA OCUPADA O NO
		$estado_mesa_a_mover = get_mesa($mesa_posterior);
		echo "estado_mesa_a_mover->".$estado_mesa_a_mover['estado'];
		//SI ESTA OCUPADA LA MESA
		if($estado_mesa_a_mover['estado'] == 1){
			echo "MOVIENDO A UNA MESA OCUPADA TODOS LOS PRODUCTOS DE MESA ANTERIOR - TESTEADO";
			$vta_a_mover = get_venta_by_mesa_estado($mesa_posterior, 0);
			$max_npedido = get_max_npedido_venta_detalle($vta_a_mover['id']) + 1;
			echo "<br>".$max_npedido;
			actualiza_ventas_detalles_all($mov, $vta_a_mover['id'], $max_npedido);
			venta_cambia_estado($mov, 7);
			actualiza_mesa($mesa_anterior, 0);
			header("Location:../../Pedidos/ver_pedido.php");
		}
		else{
			echo "MOVIENDO A UNA MESA DESOCUPADA TODOS LOS PRODUCTOS DE MESA ANTERIOR - TESTEADO";
			actualiza_mesa($mesa_anterior, 0);
			actualiza_mesa($mesa_posterior, 1);
			actualiza_ventas_mesa_id($mov, $mesa_posterior);
			header("Location:../../Pedidos/ver_pedido.php");
		}
	}
	// FIN MOVER TODOS LOS PRODUCTOS DE UNA MESA A OTRA

	// MOVER ALGUNOS PRODUCTOS DE UNA MESA A OTRA
	if((isset($_POST['btnmover'])) && (!isset($_POST['Otodos']))){
		//REVISAR SI MESA A MOVER SE ENCUENTRA OCUPADA O NO
		$estado_mesa_a_mover = get_mesa($mesa_posterior);
		//SI ESTA OCUPADA LA MESA
		if($estado_mesa_a_mover['estado'] == 1){
			// SI LAS CANTIDADES SON IGUALES 
			// ACTUALIZAR EL MOV DE ESE REGISTO POR EL DE LA MESA A MOVER
			if($cantidad_a_mover == $cantidad_origen){
				$num_vta_detalle = get_count_vta_detalle($mov);
				// SI SOLO EXISTE EL REGISTRO QUE SE QUIERE MOVER
				if($num_vta_detalle <= 1){
					echo "MOVIENDO A UNA MESA OCUPADA TODOS LOS PROD NO QUEDAN PROD EN LA MESA ANTIGUA - TESTEADA";
					$vta_a_mover = get_venta_by_mesa_estado($mesa_posterior, 0);
					$max_npedido = get_max_npedido_venta_detalle($vta_a_mover['id']) + 1;
					actualiza_ventas_detalles_preparados_npedido($mov, $preparado, $npedido, $vta_a_mover['id'], $max_npedido);
					venta_cambia_estado($mov, 7);
					actualiza_mesa($mesa_anterior, 0);
					header("Location:../../Pedidos/ver_pedido.php");
				}
				// FIN SI SOLO EXISTE EL REGISTRO QUE SE QUIERE MOVER
				else{
					echo "MOVIENDO A UNA MESA OCUPADA TODOS LOS PROD PERO QUEDAN PROD EN MESA ANTIGUA - TESTEADO";
					$vta_a_mover = get_venta_by_mesa_estado($mesa_posterior, 0);
					$max_npedido = get_max_npedido_venta_detalle($vta_a_mover['id'])+1;
					actualiza_ventas_detalles_preparados_npedido($mov, $preparado, $npedido, $vta_a_mover['id'], $max_npedido);
					header("Location:../../Pedidos/mover.php?Mov=".$mov);
				}
			}
			else{
				echo "MOVIENDO A UNA MESA OCUPADA UNA CANTIDAD X DE PRODUCTOS - TESTEADO";
				$cantidad_queda = $cantidad_origen - $cantidad_a_mover;
				$vta_detalle = get_venta_detalle($mov, $preparado, $npedido);
				actualiza_ventas_detalles_cantitdades($mov, $preparado, $npedido, $cantidad_queda);
				$vta_a_mover = get_venta_by_mesa_estado($mesa_posterior, 0);
				$max_npedido = get_max_npedido_venta_detalle($vta_a_mover['id']) + 1;
				inserta_venta_detalle($cantidad_a_mover, $max_npedido, "", $preparado, $vta_a_mover['id'], $vta_detalle['fecha'], $vta_detalle['hora']);
				$cant_happy = get_cant_happy($mov, 0);
				if($cant_happy > 0){
					actualiza_preparados_happy($nueva_venta_id, $mov);
				}
				header("Location:../../Pedidos/mover.php?Mov=".$mov);
			}
		}
		//FIN SI ESTA OCUPADA LA MESA
		else{

			//NUEVO AGREGA ACTUALIZACION VTA TEMPORAL



			//FIN  VTA TEMPORAL

			$venta_anterior = get_venta_id($mov);
			actualiza_mesa($mesa_posterior, 1);
			if($cantidad_a_mover == $cantidad_origen){
				inserta_vta($venta_anterior['fecha'], $venta_anterior['hora'], 0, $mesa_posterior, $venta_anterior['usuario_id'], $venta_anterior['fecha_full'], $_SESSION['turno'], 0);
				$nueva_venta_id = get_vta_id($venta_anterior['fecha'], $venta_anterior['hora'], 0, $mesa_posterior, $venta_anterior['usuario_id']);
				$num_vta_detalle = get_count_vta_detalle($mov);
				// SI SOLO EXISTE EL REGISTRO QUE SE QUIERE MOVER
				if($num_vta_detalle <= 1){
					echo "MOVIENDO A UNA MESA DESOCUPADA TODOS LOS PROD NO QUEDAN MAS PRODUCTOS MESA ANTIGUA - TESTEADO ";
					actualiza_ventas_detalles_preparados($mov, $preparado, $npedido, $nueva_venta_id);
					venta_cambia_estado($mov, 7);
					actualiza_mesa($mesa_anterior, 0);
					actualiza_ventas_socios_by_id($nueva_venta_id, $mov);
					actualiza_preparados_happy($nueva_venta_id, $mov);
					header("Location:../../Pedidos/ver_pedido.php");
				}
				// FIN SI SOLO EXISTE EL REGISTRO QUE SE QUIERE MOVER
				//EXISTE MAS DE UN REGISTRO
				else{
					echo "MOVIENDO A UNA MESA DESOCUPADA X PROD AUN QUEDAN PROD EN MESA ANTIGUA - TESTEADO ";
					actualiza_ventas_detalles_preparados($mov, $preparado, $npedido, $nueva_venta_id);
					actualiza_mesa($mesa_posterior, 1);
					header("Location:../../Pedidos/mover.php?Mov=".$mov);
				}
				//FINEXISTE MAS DE UN REGISTRO	
			}
			//SI LAS CANTIDADES A MOVER NO SON IGUALES
			else{
				echo "MOVIENDO A UNA MESA DESOCUPADA X CANTIDAD DE PRODUCTOS DE Y EXISTENTES - TESTEADO ";
				$cantidad_queda = $cantidad_origen - $cantidad_a_mover;
				$vta_detalle = get_venta_detalle($mov, $preparado, $npedido);
				actualiza_ventas_detalles_cantitdades($mov, $preparado, $npedido, $cantidad_queda);
				inserta_vta($venta_anterior['fecha'], $venta_anterior['hora'], 0, $mesa_posterior, $venta_anterior['usuario_id'], $venta_anterior['fecha_full'], $_SESSION['turno'], 0);
				$nueva_venta_id = get_vta_id($venta_anterior['fecha'], $venta_anterior['hora'], 0, $mesa_posterior, $venta_anterior['usuario_id']);
				inserta_venta_detalle($cantidad_a_mover, 1, "", $preparado, $nueva_venta_id, $vta_detalle['fecha'], $vta_detalle['hora']);
				$cant_happy = get_cant_happy($mov, 0);
				if($cant_happy > 0){
					actualiza_preparados_happy_cantidad($mov, $cantidad_queda);
					inserta_preparados_happy($nueva_venta_id, $preparado, $cantidad_a_mover);
				}
				header("Location:../../Pedidos/mover.php?Mov=".$mov);
				//actualiza ventas socios ??????
			}
			//FIN SI LAS CANTIDADES A MOVER NO SON IGUALES
		}
		//echo "mov->".$mov.", mesaant->".$mesa_anterior.", mesadesp->".$mesa_posterior.", cantorigen->".$cantidad_origen.", cantmover->".$cantidad_a_mover;	
	}
	//FIN MOVER ALGUNOS PRODUCTOS DE UNA MESA A OTRA
}



?>