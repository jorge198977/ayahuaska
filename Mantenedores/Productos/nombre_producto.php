<?php
include("../../intranet/funciones/mysql/conecta.php");
conecta();
$id_producto = $_POST['id_producto'];

$sqlprod = "select * from ayahuaska.producto where FAMILIA_ID=".$id_producto."";
$resprod = mysql_query($sqlprod);
while($filaprod =  mysql_fetch_array($resprod)){
	$html .= '<option value="'.$filaprod['PRODUCTO_ID'].'">'.$filaprod['PRODUCTO_NOMBRE'].'</option>';
	
}		

echo $html;

?>