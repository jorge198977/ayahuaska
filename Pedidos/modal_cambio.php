<?php
include("../intranet/funciones/controlador.php");
$id = intval($_POST['mov']);
$preparado = get_preparados_id($_POST['preparado_id']);

?>

<label for="observacion" class="col-sm-xs-2 control-label"><?php echo $_POST['cantidad']." - ".$preparado['PREPARADOS_NOMBRE']; ?></label><br>
<hr>
<label for="observacion" class="col-sm-xs-2 control-label">SEPARAR</label>
<div class="col-sm-xs-10">
  <input type="number" name="cantidad_nueva" id="cantidad_nueva" class='form-control' required>
</div>
  <input type="hidden" name="opreparado_id" id="opreparado_id" value="<?php echo $_POST['preparado_id'] ?>">
  <input type="hidden" name="cantidad_antes" id="cantidad_antes" value="<?php echo $_POST['cantidad'] ?>">
  <input type="hidden" name="omovcambiaproduto" id="omovcambiaproduto" value="<?php echo $_POST['mov'] ?>">
  <input type="hidden" name="onpedido" id="onpedido" value="<?php echo $_POST['npedido'] ?>">