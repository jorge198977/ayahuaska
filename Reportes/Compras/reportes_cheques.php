<?php session_start();   ?>
<!DOCTYPE html>
<html>

<?php 
  include("header.php"); 
  include("../../intranet/funciones/controlador.php");
  date_default_timezone_set('America/Santiago');
?>


<body>
  <!-- Sidenav -->
  <?php include("sidenav.php"); ?>
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <?php include("top_nav.php"); ?>
    <!-- Header -->

    <?php
      $hoy = date("Y-m-d");
      $fecha_act = date("Y-m-d");
      $fecha_parse = substr($fecha_act, 0, 7)."-%";
      $compras = get_reporte_compras_cheque_vencidos($fecha_parse);
      $total = 0;
    ?>



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">REPORTES VENCIMIENTOS CHEQUES</h3>
                </div>

                  <div class="table-responsive">
                      <table  class="table table-flush">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">N° FACT</th>
                            <th scope="col">PROVEEDOR</th>
                            <th scope="col">FECHA VENCIMIENTO</th>
                            <th scope="col">ESTADO</th>
                            <th scope="col">F. PAGO</th>
                            <th scope="col">NRO</th>
                            <th scope="col">TOTAL</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                           foreach ($compras as $key => $compra) {
                              $total = $total + $compra['total'];
                              $fpago = get_froma_pago_compra_by_id($compra['forma_pago_compra_id']);
                              $prov = get_proveedor_id($compra['proveedor_id']);
                              $dias_restantes = dateDiff($hoy, $compra['fecha_vencimiento']); 

                          ?>   
                            <tr class="active">
                              <td><?php echo $compra['num_factura'] ?></td>
                              <td><?php echo $prov['nombre'] ?></td>
                              <td><?php echo fecha_bd_normal($compra['fecha_vencimiento']) ?></td>
                              <td>
                                <?php  
                                  if($dias_restantes <= 0){  
                                    echo "VENCIDA";
                                  } 
                                  if($dias_restantes > 0 && $dias_restantes < 7){
                                    echo "POR VENCER";
                                  }
                                  if($dias_restantes > 7){
                                    echo "MAS DE UNA SEMANA PARA VENCER";
                                  }
                                ?>
                              </td>
                              <td><?php echo $fpago ?></td>
                              <td><?php echo $compra['num_transferencia'] ?></td>
                              <td><?php echo number_format($compra['total'], 0 , ',', '.') ?></td>
                            </tr>
                         <?php
                          }
                          ?>
                          <tr>
                            <td colspan="6"></td>
                            <td><?php echo number_format($total, 0 , ',', '.') ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>






                <div class="container">
                  <div class="row">
                    <div class="col-md-12">
                      <a href="index.php"><button type="button" class="btn btn-danger btn-block my-4">Volver</button></a>
                    </div>
                  </div>
                </div>


              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

<?php 

function dateDiff($start, $end) { 

$start_ts = strtotime($start); 

$end_ts = strtotime($end); 

$diff = $end_ts - $start_ts; 

return round($diff / 86400); 

}

?>

  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="../../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../../assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../../assets/js/argon.js?v=1.0.0"></script>





</body>

</html>