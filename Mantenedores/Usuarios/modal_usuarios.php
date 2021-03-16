<?php
include("../../intranet/funciones/controlador.php");
$id = intval($_POST['id']);
if($id != 0){
   $usuario = get_usuario_id($id);

  $nombreusuario = $usuario['nombre'];
  $apellidousuario = $usuario['apellido'];
  $usuariousuario = $usuario['usuario'];
  $correousuario = $usuario['correo'];
  $fonusuario = $usuario['fono'];
}
?>
<hr>
<label for="observacion" class="col-sm-xs-2 control-label">NOMBRE</label>
<div class="col-sm-xs-10">
  <input type="text" name="nombreusuario" value="<?php echo $nombreusuario ?>" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">APELLIDO</label>
<div class="col-sm-xs-10">
  <input type="text" name="apellidousuario" value="<?php echo $apellidousuario ?>" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">USUARIO</label>
<div class="col-sm-xs-10">
  <input type="text" name="usuariousuario" value="<?php echo $usuariousuario ?>" class='form-control' required>
</div>
<?php
  if($id == 0){
?>
  <label for="observacion" class="col-sm-xs-2 control-label">CLAVE</label>
  <div class="col-sm-xs-10">
    <input type="password" name="claveusuario" value="<?php echo $claveusuario ?>" class='form-control' required>
  </div>
<?php
}
?>
<label for="observacion" class="col-sm-xs-2 control-label">CORREO</label>
<div class="col-sm-xs-10">
  <input type="mail" name="correousuario" value="<?php echo $correousuario ?>" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">TIPO</label>
<div class="col-sm-xs-10">
  <select class="form-control input-lg" name="tipousuario" required>
    <option value=""> Seleccione Tipo usuario </option>
    <?php  
      $tipos_usuarios = get_tipos_usuarios();
      foreach ($tipos_usuarios as $key => $tipo_usuario) {
    ?>
      <option value="<?php echo $tipo_usuario['id'] ?>" 
        <?php if (($tipo_usuario['id'] == $usuario['tipo_usuario_id'])){ ?> selected <?php } ?>><?php echo $tipo_usuario['nombre'] ?></option>
    <?php
    }
    ?>
  </select>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">ESTADO</label>
<div class="col-sm-xs-10">
  <select class="form-control input-lg" name="estado" required>
    <option value=""> Seleccione Estado de usuario </option>
      <option value="0" <?php if($usuario['estado'] == 0){ ?> selected <?php } ?>> ACTIVO </option>
      <option value="1" <?php if($usuario['estado'] == 1){ ?> selected <?php } ?>> INACTIVO </option>
  </select>
</div>
 <label for="observacion" class="col-sm-xs-2 control-label">FONO</label>
  <div class="col-sm-xs-10">
    <input type="text" name="fonusuario" value="<?php echo $fonusuario ?>" class='form-control' placeholder="+56911111111" required>
  </div>
<?php
  if($id == 0){
?>
 <input type="hidden" name="ingresausuario" id="ingresausuario">
<?php 
}
else{
?>
 <input type="hidden" name="Actidusuario" id="Actidusuario" value="<?php echo $id ?>">
<?php 
}
?>