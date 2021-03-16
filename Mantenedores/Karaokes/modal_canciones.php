<?php
include("../../intranet/funciones/controlador.php");
$id = intval($_POST['id']);
$familia_id = $_POST['familia_nombre'];
$familia = get_familia_karaoke($familia_id);
if($id != 0){
	$cancion = get_cancion_by_id($id);
	$nombre = $cancion['nombre'];
}
?>

<label for="observacion" class="col-sm-xs-2 control-label">NOMBRE CANCION</label>
<div class="col-sm-xs-10">
	<input type="text" name="nombre" value="<?php echo $nombre ?>" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">ARTISTA</label>
<div class="col-sm-xs-10">
	<input type="text" name="artista2" value="<?php echo $familia['nombre'] ?>" class='form-control' disabled>
	<input type="hidden" name="artista" value="<?php echo $familia_id ?>" class='form-control'>
</div>
<?php
	if($id == 0){
?>
 <input type="hidden" name="ingresanuevacancion" id="ingresanuevacancion">
<?php 
}
else{
?>
 <input type="hidden" name="actualizacancion" id="actualizacancion" value="<?php echo $id ?>">
<?php	
}
?>