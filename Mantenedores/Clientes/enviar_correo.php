<?php
include("../../intranet/funciones/controlador.php");
include("../../intranet/phpmailer/sendmail.php");

if(isset($_GET['cliente_id'])){
    $cliente = get_cliente_id($_GET['cliente_id']);
    $monto_adeudado = get_monto_adeudado($cliente['id']);
    generar_correo_deudores($cliente['rut'], $cliente['nombre'], $cliente['correo'], $monto_adeudado);
}
else{
    $clientes = get_all_clientes();
    foreach ($clientes as $key => $cliente) {
         $monto_adeudado = get_monto_adeudado($cliente['id']);
        if($monto_adeudado > 0){
            generar_correo_deudores($cliente['rut'], $cliente['nombre'], $cliente['correo'], $monto_adeudado);
        }
    }
}

header("Location:ver_deudores.php?Enviado");

?>