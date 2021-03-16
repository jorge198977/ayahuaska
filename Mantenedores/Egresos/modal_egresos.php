<?php
include("../../intranet/funciones/controlador.php");
$id = intval($_POST['id']);
if($id != 0){
   	$egreso = get_egreso_datos($id);
  	$monto = $egreso['monto'];
  	$motivo = $egreso['motivo'];
}
?>
<hr>
<label for="observacion" class="col-sm-xs-2 control-label">MONTO</label>
<div class="col-sm-xs-10">
  <input type="number" name="montoegreso" value="<?php echo $monto ?>" class='form-control' required>
</div>

<label for="observacion" class="col-sm-xs-2 control-label">MOTIVO</label>
<div class="col-sm-xs-10">
  <input type="text" name="motivoegreso" value="<?php echo $motivo ?>" class='form-control' required>
</div>

<?php
  if($id == 0){
?>
 <input type="hidden" name="ingresaegreso" id="ingresaegreso">
<?php 
}
else{
?>
 <input type="hidden" name="ActidEgreso" id="ActidEgreso" value="<?php echo $id ?>">
<?php 
}
?>