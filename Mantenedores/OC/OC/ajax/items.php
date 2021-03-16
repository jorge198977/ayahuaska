<?php
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	/* Connect To Database*/
	require_once("mysql-shim.php");
	$con = mysql_connect("127.0.0.1","icopetedb","icopetedbroot");
	mysql_select_db('ayahuaska', $con); 
	
	if (isset($_REQUEST['id'])){
		$id=intval($_REQUEST['id']);
		$sql = "delete from ayahuaska.tmp_oc where id=".$id."";
		mysql_query($sql);
	}
	
	if (isset($_POST['nombreProducto'])){
		
		$descripcion= $_POST['nombreProducto'];
		$cantidad=intval($_POST['cantidad']);
		$precio=intval($_POST['precio']);
		$oden_compra_id = $_POST['oOc'];

		$sqle = "select cantidad from ayahuaska.tmp_oc where orden_compra_id = ".$oden_compra_id." and producto_id = ".$descripcion."";
		$rese = mysql_query($sqle);
		$tote = mysql_num_rows($rese);
		if($tote > 0){
			$date = mysql_fetch_array($rese);
			$nueva_cantidad = $cantidad + $date['cantidad'];
			$sql="update ayahuaska.tmp_oc set cantidad = ".$nueva_cantidad." where orden_compra_id = ".$oden_compra_id." and producto_id = ".$descripcion."";
			mysql_query($sql);			
		}
		else{
			$sql="insert INTO  ayahuaska.tmp_oc (producto_id, cantidad, orden_compra_id) VALUES (".$descripcion.", ".$cantidad.", ".$oden_compra_id.");";
			mysql_query($sql);
		}
	}

	$query_perfil="select iva from ayahuaska.perfiles where id=1";
	$rw=mysql_query($query_perfil);
	$dat = mysql_fetch_array($rw);
	$tax= $dat['iva'];//% de iva o impuestos
	
	$sql = "select * from ayahuaska.tmp_oc order by id asc";
	$query=mysql_query($sql);
	$items=1;
	$suma=0;

	while($row=mysql_fetch_array($query)){
			$sql = "select * from ayahuaska.producto where PRODUCTO_ID = ".$row['producto_id']." ";
			$res = mysql_query($sql);
			$dat = mysql_fetch_array($res);
		?>
	<tr>
		<td class='text-center'><?php echo $items;?></td>
		<td><?php echo utf8_encode($dat['PRODUCTO_NOMBRE']);?></td>
		<td class='text-center'><?php echo $row['cantidad']; ?></td>
		<td class='text-right'><a href="#" onclick="eliminar_item('<?php echo $row['id']; ?>')" ><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAeFBMVEUAAADnTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDx+VWpeAAAAJ3RSTlMAAQIFCAkPERQYGi40TVRVVlhZaHR8g4WPl5qdtb7Hys7R19rr7e97kMnEAAAAaklEQVQYV7XOSQKCMBQE0UpQwfkrSJwCKmDf/4YuVOIF7F29VQOA897xs50k1aknmnmfPRfvWptdBjOz29Vs46B6aFx/cEBIEAEIamhWc3EcIRKXhQj/hX47nGvt7x8o07ETANP2210OvABwcxH233o1TgAAAABJRU5ErkJggg=="></a></td>
	</tr>	
		<?php
		$items++;

		
	}

	?>
	<tr>
		<td colspan='6'>
		
			<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span> Agregar Ítem</button>
		</td>
	</tr>
	
<?php

}