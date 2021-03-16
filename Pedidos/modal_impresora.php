<?php
include("../intranet/funciones/controlador.php");
$mov = intval($_POST['mov']);
$npedido = intval($_POST['npedido']);
?>

<label for="observacion" class="col-sm-xs-2 control-label">IMPRESORA</label>
<div class="col-sm-xs-10">
  <select class="form-control input-lg" name="impresora" id="impresora" required>
    <option value=""> Seleccione impresora </option>
    <?php 
      $impresoras = get_all_impresoras();
      foreach ($impresoras as $imp => $impresora) {
        if($impresora['visible'] == 1){
    ?>
      <option value="<?php echo $impresora['url'] ?>"> <?php echo $impresora['nombre'] ?> 
      </option> 
    <?php
        }
      }
    ?>                                 
 </select>
</div>
<input type="hidden" name="oMov" value="<?php echo $mov ?>">
<input type="hidden" name="oNpedido" value="<?php echo $npedido ?>">



