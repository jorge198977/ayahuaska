<?php
include("../../intranet/funciones/controlador.php");
$id = intval($_POST['id']);
if($id != 0){
   $categoria = get_categoria_datos($id);

  $nombrecategoria = $categoria['nombre'];
}
?>
<hr>
<label for="observacion" class="col-sm-xs-2 control-label">NOMBRE</label>
<div class="col-sm-xs-10">
  <input type="text" name="nombrecategoria" value="<?php echo $nombrecategoria ?>" class='form-control' required>
</div>

<?php
  if($id == 0){
?>
 <input type="hidden" name="ingresacategoria" id="ingresacategoria">
<?php 
}
else{
?>
 <input type="hidden" name="ActidCategoria" id="ActidCategoria" value="<?php echo $id ?>">
<?php 
}
?>