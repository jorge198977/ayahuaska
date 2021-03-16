<?php
include("../../intranet/funciones/controlador.php");
$id = intval($_POST['id']);
if($id != 0){
  $proveedor = get_proveedor_id($id);

  $idprov = $proveedor['rol'];
  $nombreprov = $proveedor['nombre'];
  $fonoprov = $proveedor['fono'];
  $contactoprov = $proveedor['correo'];
}
?>

<label for="observacion" class="col-sm-xs-2 control-label">ROL</label>
<div class="col-sm-xs-10">
  <input type="text" name="idprov" value="<?php echo $idprov ?>" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">NOMBRE</label>
<div class="col-sm-xs-10">
  <input type="text" name="nombreprov" value="<?php echo $nombreprov ?>" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">FONO</label>
<div class="col-sm-xs-10">
  <input type="text" name="fonoprov" value="<?php echo $fonoprov ?>" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">CORREO</label>
<div class="col-sm-xs-10">
  <input type="mail" name="contactoprov" value="<?php echo $contactoprov ?>" class='form-control' required>
</div>

<?php
  if($id == 0){
?>
 <input type="hidden" name="ingresaproveedor2" id="ingresaproveedor2">
<?php 
}
else{
?>
 <input type="hidden" name="Actidproveedor2" id="Actidproveedor2" value="<?php echo $id ?>">
<?php 
}
?>