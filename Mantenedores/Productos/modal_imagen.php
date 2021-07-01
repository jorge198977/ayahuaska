<?php
$id = $_POST['id'];
$familia_id = $_POST['familia_id'];
?>
<label for="observacion" class="col-sm-xs-2 control-label">IMAGEN</label>
<div class="col-sm-xs-10">
  <input type="file" name="archivo" id="archivo"  placeholder="Seleccione imagen">
</div>
<input type="hidden" name="idimagenpreparado" id="idimagenpreparado" value="<?php echo $id ?>">
<input type="hidden" name="familia_id" id="familia_id" value="<?php echo $familia_id ?>">