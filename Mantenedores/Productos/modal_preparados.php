<?php
include("../../intranet/funciones/controlador.php");
$id = intval($_POST['id']);
$fam = $_POST['familia'];
if($id != 0){
  $preparado = get_preparados_id($id);

  $nombreproducto = $preparado['PREPARADOS_NOMBRE'];
  $precio = $preparado['PREPARADOS_PRECIO'];
   $famprep = $preparado['PREPARADOS_FAMILIA'];
   $categoria_id = $preparado['categoria_id'];
   $descrip = $preparado['descripcion'];
   $orden = $preparado['orden'];

 
}
?>
<hr>
<label for="observacion" class="col-sm-xs-2 control-label">NOMBRE</label>
<div class="col-sm-xs-10">
  <input type="text" name="nombreproducto" value="<?php echo $nombreproducto ?>" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">PRECIO</label>
<div class="col-sm-xs-10">
  <input type="text" name="precio" value="<?php echo $precio ?>" class='form-control' required>
</div>
<!-- <label for="observacion" class="col-sm-xs-2 control-label">FAMILIAS</label>
<div class="col-sm-xs-10">
  <select class="form-control input-lg" name="familia_prep" required>
    <option value=""> Seleccione Familia </option>
    <?php 
      $familias = get_all_familias();
      foreach ($familias as $descuento => $fam) {
    ?>
      <option <?php if($famprep == $fam['id']){ ?> selected <?php } ?> 
        value="<?php echo $fam['id'] ?>"> <?php echo $fam['nombre'] ?> 
      </option> 
    <?php
      }
    ?>                                 
 </select>
</div> -->


<label for="observacion" class="col-sm-xs-2 control-label">ESHAPPY</label>
<div class="col-sm-xs-10">
  <select class="form-control input-lg" name="es_happy" required> 
    <option value=""> Ingrese</option>
    <option <?php if($preparado['es_happy'] == 1){ ?>  selected <?php } ?> value="1"> SI</option>
    <option <?php if($preparado['es_happy'] == 2){ ?>  selected <?php } ?> value="2"> NO</option>
  </select> 
</div>




<label for="observacion" class="col-sm-xs-2 control-label">COCINA</label>
<div class="col-sm-xs-10">
  <select class="form-control input-lg" name="es_cocina" required> 
    <option value=""> Ingrese</option>
    <option <?php if($preparado['es_cocina'] == 1){ ?>  selected <?php } ?> value="1"> COCINA</option>
    <option <?php if($preparado['es_cocina'] == 2){ ?>  selected <?php } ?> value="2"> NO</option>
  </select>  
</div>


<label for="observacion" class="col-sm-xs-2 control-label">CATEGORIA</label>
<div class="col-sm-xs-10">
  <select class="form-control input-lg" name="categoria">
    <option value=""> Seleccione Categoria </option>
    <?php 
      $categorias = get_all_categorias();
      foreach ($categorias as $key => $categoria) {
        
    ?>
      <option <?php if($categoria_id == $categoria['id']){ ?> selected <?php } ?> 
        value="<?php echo $categoria['id'] ?>"> <?php echo $categoria['nombre'] ?> 
      </option> 
    <?php
      }
    ?>                                 
  </select>
</div>

<label for="observacion" class="col-sm-xs-2 control-label">ESTADO</label>
<div class="col-sm-xs-10">
  <select class="form-control input-lg" name="estado" required> 
    <option value=""> Ingrese</option>
    <option <?php if($preparado['estado'] == 1){ ?>  selected <?php } ?> value="1"> ACTIVO</option>
    <option <?php if($preparado['estado'] == 0){ ?>  selected <?php } ?> value="0"> INACTIVO</option>
  </select>  
</div>


<label for="observacion" class="col-sm-xs-2 control-label">ORDEN</label>
<div class="col-sm-xs-10">
  <input type="number" name="orden" value="<?php echo $orden ?>" class='form-control' >
</div>

<label for="observacion" class="col-sm-xs-2 control-label">DESCRIPCION</label>
<div class="col-sm-xs-10">
  <textarea class="form-control" id="descripcion" name="descripcion" rows="3"><?php echo $descrip ?></textarea>
</div>



 <input type="hidden" name="oFamilia" value="<?php echo $_POST['familia'] ?>">
<?php
  if($id == 0){
?>
 <input type="hidden" name="Ingresaproductopreparado" id="Ingresaproductopreparado">
<?php 
}
else{
?>
 <input type="hidden" name="Actproductopreparado" id="Actproductopreparado" value="<?php echo $id ?>">
<?php 
}
?>