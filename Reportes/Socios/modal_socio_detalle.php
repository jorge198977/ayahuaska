<?php
include("../../intranet/funciones/controlador.php");
$id = intval($_POST['id']);
if($id != 0){
  $socio_detalles_consumo = get_detalle_compra_socio_productos($id, $_POST['fechai'], $_POST['fechaf']);
  $socio = get_socio_id($id);
}
?>

<label for="observacion" class="col-sm-xs-2 control-label"><?php echo $socio['nombre']; ?></label>
<hr>
<div class="box">
  <!-- /.box-header -->
  <div class="box-body">
   <div class="table-responsive">
    <table id="example2" class="table table-flush">
      <thead class="thead-light">
        <tr>
          	<th scope="col">PRODUCTO</th>
	        <th scope="col">FECHA</th>
	        <th scope="col">CANTIDAD</th>
	        <th scope="col">PRECIO U</th>
	        <th scope="col">TOTAL</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($socio_detalles_consumo as $key => $detalle_consumo) {
        ?>   
          <tr class="active">
            <td><?php echo $detalle_consumo['preparado_nombre'] ?></td>
            <td><?php echo fecha_bd_normal($detalle_consumo['fecha']) . " " .$detalle_consumo['hora'] ?></td>
            <td><?php echo $detalle_consumo['cantidad'] ?></td>
            <td><?php echo number_format($detalle_consumo['preparado_precio'], 0, ',', '.'); ?></td>
            <td>
              <?php 
              $tot = $detalle_consumo['preparado_precio'] * $detalle_consumo['cantidad'];
              echo  number_format($tot, 0, ',', '.');
              ?>
            </td>
          </tr>
        <?php
        $montototal = $montototal + $tot;
        }
        ?>
      </tbody>
    </table>


    <div class="container">
      <div class="row">
        <div class="col-sm">
          <span>
            <label>Total</label><input class="form-control input-lg" name="to" id="to" type="text" 
           disabled="true" value="$<?php echo number_format($montototal, 0, ',', '.') ?>" >
          </span>
        </div>
      </div>
    </div>

  </div>
 </div>
</div>
