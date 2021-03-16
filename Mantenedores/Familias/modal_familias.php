<?php
include("../../intranet/funciones/controlador.php");
$id = intval($_POST['id']);
if($id != 0){
   $familia = get_familia_datos($id);

  $nombrefamilia = $familia['nombre'];
}
?>
<hr>
<label for="observacion" class="col-sm-xs-2 control-label">NOMBRE</label>
<div class="col-sm-xs-10">
  <input type="text" name="nombrefamilia" value="<?php echo $nombrefamilia ?>" class='form-control' required>
</div>

<?php
  if($id == 0){
?>
 <input type="hidden" name="ingresafamilia" id="ingresafamilia">
<?php 
}
else{
?>
 <input type="hidden" name="ActidFamilia" id="ActidFamilia" value="<?php echo $id ?>">
<?php 
}
?>