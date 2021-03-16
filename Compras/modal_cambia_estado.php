<?php
include("../intranet/funciones/controlador.php");
$id = intval($_POST['id']);
if($id != 0){
  $compra = get_compra_by_id($id);
  $proveedor = get_proveedor_id($compra['proveedor_id']);
  $forma_pago_compra = get_froma_pago_compra_by_id($compra['forma_pago_compra_id']);
}
?>

<label for="observacion" class="col-sm-xs-2 control-label">FACTURA <?php echo $id ?></label>
<hr>

<label for="observacion" class="col-sm-xs-2 control-label">Proveedor</label>
<div class="col-sm-xs-10">
  <input type="text" class='form-control' name="prov" type="text" value="<?php echo $proveedor['nombre']  ?>" disabled>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">VALOR</label>
<div class="col-sm-xs-10">
  <input type="text" class='form-control' name="valor" type="text" value="<?php echo number_format($compra['total'], 0 , ',', '.')  ?>" disabled>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">FECHA</label>
<div class="col-sm-xs-10">
  <input name="fecha" class='form-control' type="text" value="<?php echo fecha_bd_normal($compra['fecha'])  ?>" disabled>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">ESTADO ACTUAL</label>
<div class="col-sm-xs-10">
  <input class='form-control' name="fecha" type="text" value="<?php if($compra['estado'] == 1){ echo 'PAGADA'; } else{ echo 'NO PAGADA';}  ?>" disabled>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">FORMA DE PAGO</label>
<div class="col-sm-xs-10">
  <input class='form-control' name="fpago" type="text" value="<?php echo $forma_pago_compra ?>" disabled>
</div>
<hr>
<label for="observacion" class="col-sm-xs-2 control-label">NUEVO ESTADO</label>
<div class="col-sm-xs-10">
  <select name="nuevoestado" class="form-control input-lg" required>
    <option value="">Ingrese nuevo estado</option>
      <option value="0">NO PAGADA</option>
      <option value="1">PAGADA</option>
  </select>
</div>
<?php 
  if($datcomp['fpago'] != 2){
?>
  <label for="observacion" class="col-sm-xs-2 control-label">NRO TRANSFERENCIA/CHEQUE</label>
  <div class="col-sm-xs-10">
    <input class='form-control' name="num_transf" type="text" value="">
  </div>
<?php
}
?>

 <input type="hidden" name="btncambiaestadofactura" id="btncambiaestadofactura" value="<?php echo $id ?>">