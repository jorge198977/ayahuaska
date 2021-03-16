<?php
include("../../intranet/funciones/controlador.php");
$id = intval($_POST['id']);

function get_productoById($idProducto){
  $productos = null;
  $sql = "SELECT * from turquesa.producto WHERE PRODUCTO_ID={$idProducto}";
  $res = mysql_query($sql);
  $tot = mysql_num_rows($res);
  if($tot > 0){
    while ($dat = mysql_fetch_array($res)) {
      $familia = get_familiaById2($dat['FAMILIA_ID']);
      $stockUnidad = stockUnidadBy_idProducto($dat['PRODUCTO_ID']);
      $stockMedida = stockTipoBy_idProducto($dat['PRODUCTO_ID']);
      $productos[] = array(
      'id' => $dat['PRODUCTO_ID'],
      'nombre' => $dat['PRODUCTO_NOMBRE'],
      'nombreFamilia' => $familia[0]['nombre'],
      'unidadinicial' => $dat['PRODUCTO_UNIDADESINICIAL'],
      'tipo_descuento' => $dat['TIPO_DESCUENTO_ID'],
      'capacidad' => $dat['PRODUCTO_CAPACIDADPORUNIDAD'],
      'stockPorUnitdad' => $stockUnidad,
      'stockPorTipo' => $stockMedida,
      'stock_minimo' => $dat['PRODUCTO_STOCKMINIMO']);
    }
  }

  return $productos;
}

function get_familiaById2($idFamilia)
{
  $familia = null;
  $sql = "SELECT * from familias WHERE id={$idFamilia}";
  $res = mysql_query($sql);
  $tot = mysql_num_rows($res);
  if($tot > 0){
    while ($dat = mysql_fetch_array($res)) {
      $familia[] = array(
      'id' => $dat['id'],
      'nombre' => $dat['nombre']
      );
    }
  }

  return $familia;
}


if($id != 0){
  $producto = get_productoById($_POST['id']);
}
?>

<label for="observacion" class="col-sm-xs-2 control-label">Control Stock Producto: <?php echo $producto[0]['nombre']; ?></label>
<hr>
<label for="observacion" class="col-sm-xs-2 control-label">STOCK ACTUAL</label>
<div class="col-sm-xs-10">
  <input type="text" name="stockactual" value="<?php echo $_POST['stock'] ?>" class='form-control' disabled>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">Cantidad a aumentar (<?php echo get_nombre_tipo_descuento($producto[0]['tipo_descuento']) ?>)</label>
<div class="col-sm-xs-10">
  <input type="text" name="stockAumenta" placeholder="Ingrese stock por <?php echo get_nombre_tipo_descuento($producto[0]['tipo_descuento']) ?>" class='form-control' required>
</div>
<input type="hidden" name="idProducto" value="<?php echo $producto[0]['id'] ?>">
<input type="hidden" name="stockActual" value="<?php echo $_POST['stock'] ?>">
<input type="hidden" name="tipo_descuento" value="1">



