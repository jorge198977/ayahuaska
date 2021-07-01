<?php
include("../../intranet/funciones/controlador.php");
$id = intval($_POST['id']);
if($id != 0){
   $categoria = get_categoria_datos($id);

  $nombrecategoria = $categoria['nombre'];
  $estado = $categoria['estado'];
  $posicion = $categoria['posicion'];
}
?>
<hr>
<label for="observacion" class="col-sm-xs-2 control-label">NOMBRE</label>
<div class="col-sm-xs-10">
  <input type="text" name="nombrecategoria" value="<?php echo $nombrecategoria ?>" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">POSICION</label>
<div class="col-sm-xs-10">
  <input type="number" name="posicion" value="<?php echo $posicion ?>" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">ACTIVO</label>
<div class="col-sm-xs-10">
  <select class="form-control input-lg" name="estado" required> 
    <option value=""> Ingrese</option>
    <option <?php if($estado == 0){ ?>  selected <?php } ?> value="0"> SI</option>
    <option <?php if($estado == 1){ ?>  selected <?php } ?> value="1"> NO</option>
  </select>  
</div>
<?php
  if($id == 0){
?>
 <input type="hidden" name="ingresacategoria" id="ingresacategoria">
<?php 
}
else{
?>
 <input type="hidden" name="ActidCategoria" id="ActidCategoria" value="<?php echo $id ?>">
<?php 
}
?>