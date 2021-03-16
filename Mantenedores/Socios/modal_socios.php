<?php
include("../../intranet/funciones/controlador.php");
$id = intval($_POST['id']);
if($id != 0){
  $socio = get_socio_id($id);

  $rutsocio = $socio['rut'];
  $nombresocio = $socio['nombre'];
  $telefonosocio = $socio['telefono'];
  $emailsocio = $socio['correo'];
  $direccionsocio = $socio['direccion'];

}
?>
<hr>
<label for="observacion" class="col-sm-xs-2 control-label">RUT</label>
<div class="col-sm-xs-10">
  <input type="text" name="rutsocio" value="<?php echo $rutsocio ?>" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">NOMBRE</label>
<div class="col-sm-xs-10">
  <input type="text" name="nombresocio" value="<?php echo $nombresocio ?>" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">FONO</label>
<div class="col-sm-xs-10">
  <input type="text" name="telefonosocio" value="<?php echo $telefonosocio ?>" class='form-control' required>
</div>
<!-- <label for="observacion" class="col-sm-xs-2 control-label">CORREO</label>
<div class="col-sm-xs-10">
  <input type="mail" name="emailsocio" value="<?php echo $emailsocio ?>" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">DIRECCION</label>
<div class="col-sm-xs-10">
  <input type="text" name="direccionsocio" value="<?php echo $direccionsocio ?>" class='form-control' required>
</div> -->


<?php
  if($id == 0){
?>
 <input type="hidden" name="ingresasocio" id="ingresasocio">
<?php 
}
else{
?>
 <input type="hidden" name="Actidsocio" id="Actidsocio" value="<?php echo $id ?>">
<?php 
}
?>