<?php
include("../intranet/funciones/controlador.php");
$id = intval($_POST['id']);
$max_npedido = get_max_npedido_venta_detalle($id);
?>
<h3>NRO INTERNO <?php echo $id ?></h3>
<hr>

<?php
    $nombrecollapse = "collapse";
    for($i = 1; $i <= $max_npedido; $i++){
      $vta_detalles = get_ventas_detalles_id_pedido($id, $i);
?>    
      
      <p>
        <a class="btn btn-primary" data-toggle="collapse" href="#<?php echo $nombrecollapse."".$i ?>" role="button" aria-expanded="false" aria-controls="<?php echo $nombrecollapse."".$i ?>">
          NRO DE PEDIDO <?php echo $i ?>
        </a>
      </p>
      <div class="collapse" id="<?php echo $nombrecollapse."".$i ?>">
        <div class="card card-body">
            <div class="card-header border-0">
              <h3 class="mb-0">DETALLE PEDIDO</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th>NOMBRE</th>
                    <th>OBSERVACION</th>
                    <th>CANTIDAD</th>
                    <th>PRECIO</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($vta_detalles as $key => $vta_detalle) { 
                    $preparado = get_preparados_id($vta_detalle['preparado_id']);
                  ?>
                    <tr>
                      <td><?php echo $preparado['PREPARADOS_NOMBRE'] ?></td>
                      <td><?php echo $vta_detalle['observacion'] ?></td>
                      <td><?php echo $vta_detalle['cantidad'] ?></td>
                      <td><?php echo number_format($preparado['PREPARADOS_PRECIO']*$vta_detalle['cantidad'], 0, ',', '.') ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <div class="card-footer py-4">
              <nav aria-label="...">
                <a href="reimprimir_pedido.php?mov=<?php echo $id ?>&npedido=<?php echo $i ?>" onclick="block()">
                  <button type="button" name="imprimepedido" id="imprimepedido" class="btn btn-success btn-lg btn-block my-4" value="imprimepedido" >IMPRIMIR PEDIDO</button>
                </a>
              </nav>
            </div>

        </div>
      </div>
    
<?php
    }
?>

<!-- <label for="observacion" class="col-sm-xs-2 control-label">TIPO</label>
<div class="col-sm-xs-10">
  <select class="form-control input-lg" name="npedido" required>
    <option value=""> Seleccione Nro de Pedido </option>
    <?php
      for($i = 1; $i <= $max_npedido; $i++){
    ?>
      <option value="<?php echo $i ?>">PEDIDO NRO <?php echo $i ?></option>
    <?php
    }
    ?>
  </select>
</div> -->
<input type="hidden" name="oIdVtaImprimir" id="oIdVtaImprimir" value="<?php echo $id ?>">