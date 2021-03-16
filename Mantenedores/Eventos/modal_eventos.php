<?php
include("../../intranet/funciones/controlador.php");
$id = intval($_POST['id']);
if($id != 0){
  $evento = get_evento_by_id($id);

  $nombre = $evento['nombre'];
  $fonoprov = $proveedor['fono'];
  $contactoprov = $proveedor['correo'];
}
?>
<hr>
<label for="observacion" class="col-sm-xs-2 control-label">NOMBRE</label>
<div class="col-sm-xs-10">
  <input type="text" name="nombre" value="<?php echo $nombre ?>" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">DESCRIPCION</label>
<div class="col-sm-xs-10">
  <textarea class="textarea" name="descripcion" id="descripcion" placeholder="Ingresa descripcion" 
  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
  <?php if($id != 0){ 
    echo $evento['descripcion']
  ?>
  <?php
  }
  ?>
  </textarea>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">ESTADO</label>
<div class="col-sm-xs-10">
  <select name="estado" id="estado" class="form-control input-lg">
      <option value="">Seleccione estado</option>
      <option value="0" <?php if($evento['estado'] == 0){ ?>
      selected <?php } ?>>
      Activo
      </option>
      <option value="1" <?php if($evento['estado'] == 1){ ?>
      selected <?php } ?>>Inactivo</option>
  </select>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">IMAGEN</label>
<div class="col-sm-xs-10">
  <input type="file" name="archivo[]" multiple="multiple" placeholder="Seleccione imagenes">
</div>

<?php
  if($id == 0){
?>
 <input type="hidden" name="btnevento" id="btnevento">
<?php 
}
else{
?>
  <input type="hidden" name="Oid" value="<?php echo $evento['id'] ?>">
  <input type="hidden" name="btn_actualiza_evento" id="btn_actualiza_evento" value="<?php echo $id ?>">
<?php 
}
?>