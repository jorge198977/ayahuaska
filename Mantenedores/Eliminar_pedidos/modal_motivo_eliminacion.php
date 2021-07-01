<?php
include("../../intranet/funciones/controlador.php");
$id = intval($_POST['id']);
$mesa_id = $_POST['mesa_id'];
?>

<label for="observacion" class="col-sm-xs-2 control-label"><?php echo "MOVIMIENTO ".$id ?></label><br>
<label for="observacion" class="col-sm-xs-2 control-label">MERMA</label>
<div class="col-sm-xs-10">
  <select class="form-control input-lg" name="estado" required> 
    <option value=""> Ingrese</option>
    <option value="1"> SI</option>
    <option value="0"> NO</option>
  </select>  
</div>
<br>
<label for="observacion" class="col-sm-xs-2 control-label">MOTIVO</label>
<div class="col-sm-xs-10">
  <input type="text" name="motivo" id="motivo" class='form-control' required>
</div>
<input type="hidden" name="ElimidMovPedido" id="ElimidMovPedido" value="<?php echo $_POST['id'] ?>">
<input type="hidden" name="mesa_id" id="mesa_id" value="<?php echo $_POST['mesa_id'] ?>">