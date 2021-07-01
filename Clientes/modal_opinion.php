<?php
$id = intval($_POST['id']);
?>
<hr>
<label for="observacion" class="col-sm-xs-2 control-label">NOMBRE</label>
<div class="col-sm-xs-10">
  <input type="text" name="nombre" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">OPINION</label>
<div class="col-sm-xs-10">
  <input type="text" name="opinion" class='form-control'>
</div>
<input type="hidden" name="AgregaOpinion" id="AgregaOpinion">
<input type="hidden" name="id" id="id" value="<?php echo $id ?>">