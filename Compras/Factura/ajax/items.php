<?php
//require_once("mysql-shim.php");
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	/* Connect To Database*/
	require_once("mysql-shim.php");
	$con = mysql_connect("127.0.0.1","icopetedb","icopetedbroot");
	mysql_select_db('ayahuaska', $con); 
	
	if (isset($_REQUEST['id'])){
		$id=intval($_REQUEST['id']);
		$sql = "delete from ayahuaska.tmp where id=".$id."";
		mysql_query($sql);
	}
	
	if (isset($_POST['nombreProducto'])){
		
		$descripcion= $_POST['nombreProducto'];
		$cantidad=intval($_POST['cantidad']);
		$precio=intval($_POST['precio']);
		$compra_id = $_POST['ofactura'];

		$sqlcc = "select onzas from ayahuaska.ccs where id = ".$_POST['formato']."";
		$rescc = mysql_query($sqlcc);
		$datcc = mysql_fetch_array($rescc);
		$cc = $datcc['onzas'];

		$sqle = "select cantidad from ayahuaska.tmp where compra_id = ".$compra_id." and producto_id = ".$descripcion." ";
		$rese = mysql_query($sqle);
		$tote = mysql_num_rows($rese);
		if($tote > 0){
			$date = mysql_fetch_array($rese);
			
			$nueva_cantidad = ($cantidad * $cc) + $date['cantidad'];
			//$nueva_cantidad = ($cantidad) + $date['cantidad'];
			$sql="update ayahuaska.tmp set cantidad = ".$nueva_cantidad." where compra_id = ".$compra_id." and producto_id = ".$descripcion."";
			mysql_query($sql);			
		}
		else{
			$can = $cantidad * $cc;
			//$can = $cantidad;
			$sql="insert INTO  ayahuaska.tmp (producto_id, cantidad, precio, compra_id, formato_id) VALUES (".$descripcion.", ".$can.", ".$precio.", ".$compra_id.", ".$_POST['formato'].");";
			mysql_query($sql);
		}

	}

	$query_perfil="select iva from ayahuaska.perfiles where id=1";
	$rw=mysql_query($query_perfil);
	$dat = mysql_fetch_array($rw);
	$tax= $dat['iva'];//% de iva o impuestos
	
	$sql = "select * from ayahuaska.tmp order by id asc";
	$query=mysql_query($sql);
	$items=1;
	$suma=0;

	while($row=mysql_fetch_array($query)){

			$sqlcc2 = "select onzas from ayahuaska.ccs where id = ".$row['formato_id']."";
			$rescc2 = mysql_query($sqlcc2);
			$datcc2 = mysql_fetch_array($rescc2);
			$cc2 = $datcc2['onzas'];

			$total=($row['cantidad']*$row['precio']/$cc2);
			$sql = "select * from ayahuaska.producto where PRODUCTO_ID = ".$row['producto_id']." ";
			$res = mysql_query($sql);
			$dat = mysql_fetch_array($res);
		?>
	<tr>
		<td class='text-center'><?php echo $items;?></td>
		<td><?php echo utf8_encode($dat['PRODUCTO_NOMBRE']);?></td>
		<td class='text-center'><?php echo ($row['cantidad']/$cc2); ?></td>
		<td class='text-right'><?php echo number_format($row['precio'], 0, ',', '.');?></td>
		<td class='text-right'><?php echo number_format($total, 0, ',', '.');?></td>
		<td class='text-right'><a href="#" onclick="eliminar_item('<?php echo $row['id']; ?>')" ><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAeFBMVEUAAADnTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDx+VWpeAAAAJ3RSTlMAAQIFCAkPERQYGi40TVRVVlhZaHR8g4WPl5qdtb7Hys7R19rr7e97kMnEAAAAaklEQVQYV7XOSQKCMBQE0UpQwfkrSJwCKmDf/4YuVOIF7F29VQOA897xs50k1aknmnmfPRfvWptdBjOz29Vs46B6aFx/cEBIEAEIamhWc3EcIRKXhQj/hX47nGvt7x8o07ETANP2210OvABwcxH233o1TgAAAABJRU5ErkJggg=="></a></td>
	</tr>	
		<?php
		$items++;
		$suma+=$total;
		
	}
		$iva=$suma * ($tax / 100);
		//$total_iva=number_format($iva,0,',','.');	
		$total=$suma + $iva;
	?>
	<tr>
		<td colspan='6'>
		
			<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span> Agregar Ítem</button>
		</td>
	</tr>
	<tr>
		<td colspan='4' class='text-right'>
			NETO
		</td>
		<th class='text-right'>
			<?php echo number_format($suma, 0, ',', '.');?>
		</th>
		<td></td>
	</tr>
	
	<tr>
		<td colspan='4' class='text-right'>
			IVA
		</td>
		<th class='text-right'>
			<?php echo number_format($iva,0,',','.');?>
			<input type="hidden" class="form-control" id="oiva" name="oiva" value="<?php echo $iva ?>">
			<input type="hidden" class="form-control" id="ototal2" name="ototal2" value="<?php echo $total ?>">
		</th>
		<td></td>
	</tr>

	<tr>
		<td colspan='4' class='text-right'>
			IMP. ADICIONAL
		</td>
		<th class='text-right'>
			<input type="number" class="form-control" id="impuesto_adicional" name="impuesto_adicional"  onkeyup="agrega_impuesto()" required>
		</th>
		<td></td>
	</tr>
	<tr>
		<td colspan='4' class='text-right'>
			SERV LOGIST
		</td>
		<th class='text-right'>
			<input type="number" class="form-control" id="servicios_logic" name="servicios_logic"  onkeyup="agrega_serv_logistico()" required>
		</th>
		<td></td>
	</tr>
	<tr>
		<td colspan='4' class='text-right'>
			RETENCION
		</td>
		<th class='text-right'>
			<input type="number" class="form-control" id="retencion" name="retencion"  onkeyup="agrega_retencion()" required>
		</th>
		<td></td>
	</tr>
	<tr>
		<td colspan='4' class='text-right'>
			IABA
		</td>
		<th class='text-right'>
			<input type="number" class="form-control" id="iaba" name="iaba"  onkeyup="agrega_iaba()" required>
		</th>
		<td></td>
	</tr>
	<tr>
		<td colspan='4' class='text-right'>
			ILA
		</td>
		<th class='text-right'>
			<input type="number" class="form-control" id="ila" name="ila"  onkeyup="agrega_ila()" required>
		</th>
		<td></td>
	</tr>
	<tr>
		<td colspan='4' class='text-right'>
			DESCUENTO
		</td>
		<th class='text-right'>
			<input type="number" class="form-control" id="descuento" name="descuento"  onkeyup="agrega_descuento()" required>
		</th>
		<td></td>
	</tr>
	<tr>
		<td colspan='4' class='text-right'>
			TOTAL
		</td>
		<th class='text-right'>
			
			<input type="number" class="form-control" id="total" name="total" disabled>
			<input type="hidden" class="form-control" id="ototal" name="ototal" value="<?php echo $total ?>">
		</th>
		<td></td>
	</tr>
<?php

}