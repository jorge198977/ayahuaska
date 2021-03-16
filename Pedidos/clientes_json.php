<?php
include("../intranet/funciones/controlador.php");
if(!empty($_POST["keyword"])) {
  	$dato = $_POST['keyword'];
  	$sql = "select * from turquesa.socios where nombre like '%".$dato."%' order by nombre asc";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);

	if($tot > 0){
	?>
	<ul id="country-list">
	<?php
	  while($dat = mysql_fetch_array($res)){
	  ?>
	  	<li onClick="selectCountry('<?php echo $dat["nombre"] ?>');"><?php echo $dat["nombre"]; ?></li>
	  <?php
	  }
	?>
	</ul>
	<?php
	}
}

?>