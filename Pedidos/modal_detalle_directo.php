<?php
include("../intranet/funciones/controlador.php");
$id = intval($_POST['id']);
$npedido = $_POST['npedido'];
$preparado_id = $_POST['preparado_id'];
?>
<hr>
<label for="observacion" class="col-sm-xs-2 control-label">CANTIDAD</label>
<div class="col-sm-xs-10">
  <input type="number" name="cantidad" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">OBSERVACION</label>
<div class="col-sm-xs-10">
  <input type="text" name="observacion" class='form-control'>
</div>

<input type="hidden" name="preparado_id" id="preparado_id" value="<?php echo $preparado_id ?>">
<input type="hidden" name="npedido" id="npedido" value="<?php echo $npedido ?>">
<input type="hidden" name="id" id="id" value="<?php echo $id ?>">
<input type="hidden" name="pedido_directo" id="pedido_directo" value="<?php echo $id ?>">