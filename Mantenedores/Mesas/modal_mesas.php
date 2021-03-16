<?php
include("../../intranet/funciones/controlador.php");
$id = intval($_POST['id']);
if($id != 0){
  $mesa = get_mesa_id($id);

  $idmesa = $mesa['num'];
  $ubicacion = $mesa['ubicacion'];
  $fonoprov = $proveedor['fono'];
  $contactoprov = $proveedor['correo'];
}
?>

<label for="observacion" class="col-sm-xs-2 control-label">NRO MESA</label>
<div class="col-sm-xs-10">
  <input type="text" name="idmesa" value="<?php echo $idmesa ?>" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">UBICACION</label>
<div class="col-sm-xs-10">
  <input type="text" name="ubicacion" value="<?php echo $ubicacion ?>" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">ESTADO</label>
<div class="col-sm-xs-10">
  <select class="form-control input-lg" name="estado" required>
    <option value=""> Seleccione Estado </option>
    <option <?php if($mesa['estado'] == 0){ ?> selected <?php } ?>  value="0"> Disponible </option>
    <option <?php if($mesa['estado'] == 1){ ?> selected <?php } ?> value="1"> Ocupada </option>
  </select>
</div>


<?php
  if($id == 0){
?>
 <input type="hidden" name="ingresarmesa" id="ingresarmesa">
<?php 
}
else{
?>
 <input type="hidden" name="Actidmesa" id="Actidmesa" value="<?php echo $id ?>">
<?php 
}
?>