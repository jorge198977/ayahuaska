<?php
include("../../intranet/funciones/controlador.php");
$id = intval($_POST['id']);
if($id != 0){
  $preparado = get_preparados_id($id);

}
?>
<label for="observacion" class="col-sm-xs-2 control-label"><?php echo $preparado['PREPARADOS_NOMBRE'] ?></label>
<hr>
<label for="observacion" class="col-sm-xs-2 control-label">FAMILIA</label>
<div class="col-sm-xs-10">
  <select name="producto1" id="producto1" class="form-control input-lg">
      <option value="">Seleccione Producto</option>
          <?php
            $familias = get_all_familias();
              foreach ($familias as $key => $fam) {
          ?>
            <option value="<?php echo $fam['id'] ?>"><?php echo $fam['nombre'] ?></option>
          <?php 
              }
          ?>    
  </select>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">PRODUCTO</label>
<div class="col-sm-xs-10">
  <select name="nombreProducto1" id="nombreProducto1" class="form-control input-lg nombreProducto">
  </select>
</div>
<label for="observacion" class="col-sm-xs-2 control-label">CANTIDAD</label>
<div class="col-sm-xs-10">
  <input type="text" name="cantidad" class='form-control' required>
</div>
 <input type="hidden" name="oFamilia" value="<?php echo $_POST['familia'] ?>">
 <input type="hidden" name="oProductoId" value="<?php echo $id ?>">
<input type="hidden" name="btningresaprodescuento" id="btningresaprodescuento">




<script language="javascript">

$(document).ready(function(){
   $("#producto1").change(function () {
           $("#producto1 option:selected").each(function () {
            id_producto = $(this).val();
            $.post("nombre_producto.php", { id_producto: id_producto }, function(data){
                $("#nombreProducto1").html(data);
            });            
        });
   })
});

</script>