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






if(isset($_GET['btnpagarpedido'])){

	if($_SESSION['id'] == ""){
		header('Location:../../index.php?NOCINICIA');
	}


	$totcpro = $_GET['ototalmenosdescu'] + $_GET['propina'];
	$descuentos = $_GET['descuento'] + $_GET['descuento_especial'] + $_GET['descuento_puntos'];
	if($_GET['ototalmenosdescu'] > 0){

			if(($_GET['fpago'] == 1) || ($_GET['fpago'] == 4) || ($_GET['fpago'] == 8) || ($_GET['fpago'] == 6)){
				//SI NO SE DEBE REALIZAR BOLETA
				if($_GET['escanje'] == 1){
					echo "ENTRAAA";
					actualiza_venta_canje($_GET['omov'], 1);
				}
				// if(ingresa_boleta_elec($_GET['omov'], $totcpro, $_GET['omesa'], $_GET['ototalmenosdescu'], $_GET['monto_pagado'], $_GET['propina'], $_GET['fpago'], $_GET['nomcli'], $_SESSION['id'], $_GET['boleta'], $descuentos)){

				// 	//actualiza_estado_venta_detalle($_GET['omov'], 1);
				// 	//header("Location:../../Pedidos/ver_pedido.php?Pagado");	
				// }
				// else{
				// 	//header("Location:../../Pedidos/ver_pedido.php?ErrorPagando");
				// }
			}
			else{
				if($_GET['escanje'] == 1){
					echo "ENTRAAA";
					actualiza_venta_canje($_GET['omov'], 1);
				}
				// if(ingresa_nueva_forma_pago2($_GET['omov'], $totcpro, $_GET['omesa'], $_GET['ototalmenosdescu'], $_GET['monto_pagado'], $_GET['propina'], $_GET['fpago'], $_GET['nomcli'], $_SESSION['id'], $_GET['boleta'])){
				// 	actualiza_estado_venta_detalle($_GET['omov'], 1);
				// 	header("Location:../../Pedidos/ver_pedido.php?Pagado");	
				// }
				// else{
				// 	header("Location:../../Pedidos/ver_pedido.php?ErrorPagando");
				// }
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






//FIN ADICIONAL SHEOL ////////

?>
