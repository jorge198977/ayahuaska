<?php
include("../../intranet/funciones/controlador.php");
$id = intval($_POST['id']);
if($id != 0){
  $producto = get_producto($id);

  $nombreproducto = $producto['PRODUCTO_NOMBRE'];
  $cantinicial = $producto['PRODUCTO_UNIDADESINICIAL'];
  //$capacidad = $producto['PRODUCTO_CAPACIDADPORUNIDAD'];
  $stock_minimo = $producto['PRODUCTO_STOCKMINIMO'];
  $costo = $producto['PRODUCTO_COSTO'];
  //$familia = $producto['FAMILIA_ID'];
}
?>

<label for="observacion" class="col-sm-xs-2 control-label">NOMBRE</label>
<div class="col-sm-xs-10">
  <input type="text" name="nombreproducto" value="<?php echo $nombreproducto ?>" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">FORMA COMERCIALIZACION</label>
<div class="col-sm-xs-10">
  <select class="form-control input-lg" name="forma_comercializa" required>
    <option value=""> Seleccione Forma de comercialización </option>
    <option <?php if($producto['PRODUCTO_FORMADECOMERCIO'] == 1){ ?> selected <?php } ?> 
      value="1"> Venta 
    </option>
    <option <?php if($producto['PRODUCTO_FORMADECOMERCIO'] == 2){ ?> selected <?php } ?> 
      value="2"> Material para preparados 
    </option>
 </select>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">CANT INICIAL</label>
<div class="col-sm-xs-10">
  <input type="text" name="cantinicial" value="<?php echo $cantinicial ?>" class='form-control' required>
</div>
<!-- <label for="observacion" class="col-sm-xs-2 control-label">CAPACIDAD</label>
<div class="col-sm-xs-10">
  <input type="text" name="capacidad" value="<?php echo $capacidad ?>" class='form-control' required>
</div> -->
<label for="observacion" class="col-sm-xs-2 control-label">STOCK MIN</label>
<div class="col-sm-xs-10">
  <input type="number" name="stock_minimo" value="<?php echo $stock_minimo ?>" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">COSTO</label>
<div class="col-sm-xs-10">
  <input type="text" name="costo" value="<?php echo $costo ?>" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">FORMA DESCUENTO</label>
<div class="col-sm-xs-10">
  <select class="form-control input-lg" name="forma_descuento" required>
    <option value=""> Seleccione Forma descuento </option>
    <?php 
      $tipos_descuentos = get_tipos_descuentos();
      foreach ($tipos_descuentos as $descuento => $desc) {
    ?>
      <option <?php if($producto['TIPO_DESCUENTO_ID'] == $desc['id']){ ?> selected <?php } ?> 
        value="<?php echo $desc['id'] ?>"> <?php echo $desc['nombre'] ?> 
      </option> 
    <?php
      }
    ?>                                 
 </select>
</div>
<input type="hidden" name="OFamilia" value="<?php echo $_POST['familia'] ?>">
<!-- <label for="observacion" class="col-sm-xs-2 control-label">FAMILIAS</label>
<div class="col-sm-xs-10">
  <select class="form-control input-lg" name="familia_prod" required>
    <option value=""> Seleccione Familia </option>
    <?php 
      $familias = get_all_familias();
      foreach ($familias as $descuento => $fam) {
    ?>
      <option <?php if($producto['FAMILIA_ID'] == $fam['id']){ ?> selected <?php } ?> 
        value="<?php echo $fam['id'] ?>"> <?php echo $fam['nombre'] ?> 
      </option> 
    <?php
      }
    ?>                                 
 </select>
</div> -->
<?php
  if($id == 0){
?>
 <input type="hidden" name="Ingresaproducto" id="Ingresaproducto">
<?php 
}
else{
?>
 <input type="hidden" name="Actproducto" id="Actproducto" value="<?php echo $id ?>">
<?php 
}
?>