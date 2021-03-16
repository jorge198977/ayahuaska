<?php
include("../../intranet/funciones/controlador.php");
$id = intval($_POST['id']);
if($id != 0){
  $cliente = get_cliente_id($_POST['id']);

  $rutcli = $cliente['rut'];
  $nombrecli = $cliente['nombre'];
  $direccioncli = $cliente['direccion'];
  $ciudadcli = $cliente['ciudad'];
  $telefonocli = $cliente['telefono'];
  $emailcli = $cliente['correo'];
  $cupocli = $cliente['cupo'];
}
?>

<label for="observacion" class="col-sm-xs-2 control-label">RUT</label>
<div class="col-sm-xs-10">
  <input type="text" name="rutcli" value="<?php echo $rutcli ?>" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">NOMBRE</label>
<div class="col-sm-xs-10">
  <input type="text" name="nombrecli" value="<?php echo $nombrecli ?>" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">DIRECCION</label>
<div class="col-sm-xs-10">
  <input type="text" name="direccioncli" value="<?php echo $direccioncli ?>" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">CIUDAD</label>
<div class="col-sm-xs-10">
  <input type="text" name="ciudadcli" value="<?php echo $ciudadcli ?>" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">TELEFONO</label>
<div class="col-sm-xs-10">
  <input type="text" name="telefonocli" value="<?php echo $telefonocli ?>" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">EMAIL</label>
<div class="col-sm-xs-10">
  <input type="email" name="emailcli" value="<?php echo $emailcli ?>" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">CUPO</label>
<div class="col-sm-xs-10">
  <input type="text" name="cupocli" value="<?php echo $cupocli ?>" class='form-control' required>
</div>

<?php
  if($id == 0){
?>
 <input type="hidden" name="ingresacliente" id="ingresacliente">
<?php 
}
else{
?>
 <input type="hidden" name="Actidcliente" id="Actidcliente" value="<?php echo $id ?>">
<?php 
}
?>