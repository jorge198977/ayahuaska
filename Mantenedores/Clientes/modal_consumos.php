<?php
include("../../intranet/funciones/controlador.php");
$id = intval($_POST['id']);
if($id != 0){
  $cliente = get_cliente_id($_POST['id']);

}
?>

<?php echo $cliente['nombre'] ?>  

<div class="box">
  <!-- /.box-header -->
  <div class="box-body">
   <div class="table-responsive">
    <table id="example2" class="table table-flush">
      <thead class="thead-light">
        <tr>
          <th scope="col">MOV</th>
          <th scope="col">FECHA</th>
          <th scope="col">DESCRIP</th>
          <th scope="col">CANTIDAD</th>
          <th scope="col">MONTO</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $compras_detalles_cliente = get_detalle_compras_cliente($_POST['id']);
          foreach ($compras_detalles_cliente as $key => $compra_detalle_cliente) {
            $ventas_detalles = get_ventas_detalles_id($compra_detalle_cliente['venta_id']);
            foreach ($ventas_detalles as $key => $venta_detalle) {
              $preparado = get_preparados_id($venta_detalle['preparado_id']);
              $subt = $preparado['PREPARADOS_PRECIO'] * $venta_detalle['cantidad'];
              ?>
                   <tr>
                      <th><?php echo $compra_detalle_cliente['venta_id'] ?></th>
                      <th><?php echo substr($compra_detalle_cliente['fecha'], 8, 2)."-"
                      .substr($compra_detalle_cliente['fecha'], 5, 2)."-"
                      .substr($compra_detalle_cliente['fecha'], 0, 4) ?></th>
                      <th><?php echo $preparado['PREPARADOS_NOMBRE'] ?></th>
                      <th><?php echo $venta_detalle['cantidad'] ?></th>
                      <th><?php echo number_format($subt, 0, ',', '.') ?></th>
                  </tr>
              <?php  
              }
          }

          $abonos_cta_cte_cliente = get_cta_cte_cliente($_POST['id'], 2);
          foreach ($abonos_cta_cte_cliente as $key => $abono_cta_cte_cliente) {
          ?>  
              <tr>
                <th><?php echo $abono_cta_cte_cliente['venta_id'] ?></th>
                <th><?php echo substr($abono_cta_cte_cliente['fecha'], 8, 2)."-"
                          .substr($abono_cta_cte_cliente['fecha'], 5, 2).
                          "-".substr($abono_cta_cte_cliente['fecha'], 0, 4) ?></th>
                <th><?php echo "Abono cuenta corriente" ?></th>
                <th>
                    
                </th>
                <th><?php echo number_format($abono_cta_cte_cliente['monto'], 0, ',', '.') ?></th>    
              </tr>
          <?php  
          }
        ?>
      </tbody>
    </table>
  </div>
 </div>
</div>

  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="../../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../../assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../../assets/js/argon.js?v=1.0.0"></script>

   <!-- DataTables -->
  
  <script src="../../intranet/plugins/datatables/jquery.dataTables.min.js"></script>

  <!-- page script -->
  <script>
    $(function () {
       $("#example2").DataTable();

    });
  </script>