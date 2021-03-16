<?php
// connect to database
require_once("mysql-shim.php");
$con = mysql_connect("127.0.0.1","icopetedb","icopetedbroot");
mysql_select_db('ayahuaska', $con); 
$search = strip_tags(trim($_GET['q'])); 
// Do Prepared Query
$query = mysql_query("select * FROM ayahuaska.proveedores WHERE nombre LIKE '".$search."%' and estado = 0 LIMIT 40", $con);
// Do a quick fetchall on the results
$list = array();
while ($list=mysql_fetch_array($query)){
	$data[] = array('id' => $list['id'], 'text' => $list['nombre'],'email' => $list['correo'],'telefono' => $list['fono'],'rol' => $list['rol']);
}
// return the result in json
echo json_encode($data);
?>