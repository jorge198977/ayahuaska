<?php
include("../../intranet/funciones/controlador.php");
$id = intval($_POST['id']);
if($id != 0){
  $tipo_costo = get_tipo_costo_id($id);

  $nombre = $tipo_costo['nombre'];

}
?>

<hr>
<label for="observacion" class="col-sm-xs-2 control-label">NOMBRE</label>
<div class="col-sm-xs-10">
  <input type="text" name="nombre" value="<?php echo $nombre ?>" class='form-control' required>
</div>

<?php
  if($id == 0){
?>
 <input type="hidden" name="ingresatipocosto" id="ingresatipocosto">
<?php 
}
else{
?>
 <input type="hidden" name="Actidtipocosto" id="Actidtipocosto" value="<?php echo $id ?>">
<?php 
}
?>