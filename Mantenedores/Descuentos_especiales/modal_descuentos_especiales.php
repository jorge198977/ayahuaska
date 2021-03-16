<?php
include("../../intranet/funciones/controlador.php");
$id = intval($_POST['id']);
if($id != 0){
  $descuento_familia = get_descuento_familia_by_id($id);

  $horai = $descuento_familia['hora_inicial'];
  $horaf = $descuento_familia['hora_final'];
  $descuento = $descuento_familia['descuento'];

}
?>

<label for="observacion" class="col-sm-xs-2 control-label">HORA INICIO</label>
<div class="col-sm-xs-10">
  <input type="time" name="horai" value="<?php echo $horai ?>" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">HORA FIN</label>
<div class="col-sm-xs-10">
  <input type="time" name="horaf" value="<?php echo $horaf ?>" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">DESCUENTO</label>
<div class="col-sm-xs-10">
  <input type="number" name="descuento" value="<?php echo $descuento ?>" class='form-control' required>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">FAMILIA</label>
<div class="col-sm-xs-10">
  <select class="form-control input-lg" name="familia" required>
    <option value=""> Seleccione Familia </option>
    <?php
      $familias  = get_all_familias();
      foreach ($familias as $key => $familia) {
    ?>
      <option <?php if($descuento_familia['familia_id'] == $familia['id']){ ?> selected <?php } ?> value="<?php echo $familia['id'] ?>"> <?php echo $familia['nombre'] ?> </option>

    <?php
    }
    ?>
 </select>
</div>

<?php
  if($id == 0){
?>
 <input type="hidden" name="btningresadescuentofamilia" id="btningresadescuentofamilia">
<?php 
}
else{
?>
 <input type="hidden" name="btnactualizadescuentofamilia" id="btnactualizadescuentofamilia" value="<?php echo $id ?>">
<?php 
}
?>