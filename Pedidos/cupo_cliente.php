<?php
	 include("../intranet/funciones/controlador.php");
	 $id_nombre = $_POST['id_nombre'];
	 $cliente = get_cliente_id($id_nombre);
	 $monto_adeudado = get_monto_adeudado($id_nombre);
	 $disponible = $cliente['cupo'] - $monto_adeudado;
	 $html .= '<option value="'.$disponible.'">'.number_format($disponible, 0, ',', '.').'</option>';
	 echo $html;
 ?> 