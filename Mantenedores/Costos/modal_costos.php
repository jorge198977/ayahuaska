<?php
include("../../intranet/funciones/controlador.php");
$id = intval($_POST['id']);
if($id != 0){
	$costo = get_costos_by_id($id);
	$nombre = $costo['nombre'];
	$monto = $costo['monto'];
	$fecha = $costo['fecha'];
	$fecha_vencimiento = $costo['fecha_vencimiento'];
	$tipo_costo = $costo['tipo_costo_id'];
	$fpago_id = $costo['forma_pago_id'];
	$factura = $costo['factura'];
}
?>

<label for="observacion" class="col-sm-xs-2 control-label">NOMBRE</label>
<div class="col-sm-xs-10">
	<input type="text" name="nombre" value="<?php echo $nombre ?>" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">MONTO</label>
<div class="col-sm-xs-10">
	<input type="number" name="monto" value="<?php echo $monto ?>" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">FECHA</label>
<div class="col-sm-xs-10">
	<input type="date" name="fecha" value="<?php echo $fecha ?>" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">FECHA VENCIMIENTO</label>
<div class="col-sm-xs-10">
	<input type="date" name="fecha_vencimiento" value="<?php echo $fecha_vencimiento ?>" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">FORMA PAGO</label>
<div class="col-sm-xs-10">
  <select class="form-control input-lg" name="fpago" required>
    <option value=""> Seleccione forma de pago </option>
    <?php 
    	$fpagos = get_all_formas_pagos2(); 
    	foreach ($fpagos as $key => $fpago) {
    ?>
    	<option <?php if($fpago_id == $fpago['id']){ ?> selected <?php } ?>  value="<?php echo $fpago['id'] ?>"> <?php echo $fpago['descripcion'] ?> </option>
    <?php
    	}
    ?>
    
  </select>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">FACTURA</label>
<div class="col-sm-xs-10">
	<input type="number" name="factura" value="<?php echo $factura ?>" class='form-control'>
</div>

<?php
	if($id == 0){
?>
 <input type="hidden" name="ingresanuevocosto" id="ingresanuevocosto">
<?php 
}
else{
?>
 <input type="hidden" name="actualizacosto" id="actualizacosto" value="<?php echo $id ?>">
<?php	
}
?>