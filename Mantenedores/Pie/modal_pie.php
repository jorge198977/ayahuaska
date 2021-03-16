<?php
include("../../intranet/funciones/controlador.php");
$id = intval($_POST['id']);
if($id != 0){
  $pie = get_pie_by_id($id);

  $descrip = $pie['descrip'];
  $nombreprov = $proveedor['nombre'];
  $fonoprov = $proveedor['fono'];
  $contactoprov = $proveedor['correo'];
}
?>

<label for="observacion" class="col-sm-xs-2 control-label">DESCRIPCION</label>
<div class="col-sm-xs-10">
  <input type="text" name="descrip" value="<?php echo $descrip ?>" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">ESTADO</label>
<div class="col-sm-xs-10">
  <select class="form-control input-lg" name="estado" required>
      <option value=""> Seleccione Estado </option>
      <option <?php if($pie['estado'] == 0){ ?> selected  <?php } ?> value="0"> Activo </option>
      <option <?php if($pie['estado'] == 1){ ?> selected  <?php } ?> value="1"> Inactivo </option>
   </select>
</div>


<?php
  if($id == 0){
?>
 <input type="hidden" name="ingresapie" id="ingresapie">
<?php 
}
else{
?>
 <input type="hidden" name="Actidpie" id="Actidpie" value="<?php echo $id ?>">
<?php 
}
?>