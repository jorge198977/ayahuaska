<?php
include("../../intranet/funciones/controlador.php");
$id = intval($_POST['id']);
$usuario = get_usuario_id($id);
$nombreusuario = $usuario['nombre'];
$apellidousuario = $usuario['apellido'];

?>
<h3><?php echo $nombreusuario." ".$apellidousuario ?></h3>
<hr>
<label for="observacion" class="col-sm-xs-2 control-label">NUEVA CLAVE</label>
<div class="col-sm-xs-10">
  <input type="password" name="nueva_clave" id="nueva_clave" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">REPITA NUEVA CLAVE</label>
<div class="col-sm-xs-10">
  <input type="password" name="nueva_clave_rep" id="nueva_clave_rep" class='form-control' required>
</div>
<input type="hidden" name="oIdUsuario" id="oIdUsuario" value="<?php echo $id ?>">