<?php
include("../../intranet/funciones/controlador.php");
$id = intval($_POST['id']);
if($id != 0){
    $cc = get_cc_by_id($id);

  	$ccs= $cc['cc'];
  	$cantidad_onzas = $cc['onzas'];
}
?>
<hr>
<label for="observacion" class="col-sm-xs-2 control-label">CC</label>
<div class="col-sm-xs-10">
  <input type="text" name="cc" value="<?php echo $ccs ?>" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">CANTIDAD ONZAS</label>
<div class="col-sm-xs-10">
  <input type="number" name="cantidad_onzas" value="<?php echo $cantidad_onzas ?>" class='form-control' required>
</div>
<?php
  if($id == 0){
?>
 <input type="hidden" name="ingresacc" id="ingresacc">
<?php 
}
else{
?>
 <input type="hidden" name="ActidCc" id="ActidCc" value="<?php echo $id ?>">
<?php 
}
?>