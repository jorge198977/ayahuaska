<?php
include("../../intranet/funciones/controlador.php");
$id = intval($_POST['id']);
if($id != 0){
  $familia_karaoke = get_familia_karaoke($id);
  $nombre = $familia_karaoke['nombre'];
}
?>

<label for="observacion" class="col-sm-xs-2 control-label">NOMBRE</label>
<div class="col-sm-xs-10">
  <input type="text" name="nombre" value="<?php echo $nombre ?>" class='form-control' required>
</div>

<?php
  if($id == 0){
?>
 <input type="hidden" name="ingesanuevafamiliakaraoke" id="ingesanuevafamiliakaraoke">
<?php 
}
else{
?>
 <input type="hidden" name="actualizafamiliakaraoke" id="actualizafamiliakaraoke" value="<?php echo $id ?>">
<?php 
}
?>