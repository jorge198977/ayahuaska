<?php
include("../../intranet/funciones/controlador.php");
$id = intval($_POST['id']);
if($id != 0){
  $cliente = get_cliente_id($_POST['id']);
  $rutcli = $cliente['rut'];
  $nombrecli = $cliente['nombre'];
  $monto_adeudado = get_monto_adeudado($_POST['id']);

}
?>

<label for="observacion" class="col-sm-xs-2 control-label"><?php echo $rutcli." ".$nombrecli ?></label><br>
<label for="observacion" class="col-sm-xs-2 control-label">DEUDA</label>
<div class="col-sm-xs-10">
  <input type="text" name="deuda" id="deuda" value="<?php echo $monto_adeudado ?>" class='form-control' disabled>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">ABONO</label>
<div class="col-sm-xs-10">
  <input type="text" name="montoabono" id="montoabono" class='form-control' required>
</div>
  <input type="hidden" name="cliente_id" id="cliente_id" value="<?php echo $_POST['id'] ?>">
