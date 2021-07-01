<?php session_start();   ?>
<!DOCTYPE html>
<html>

<?php 
  include("header.php"); 
  include("../../intranet/funciones/controlador.php");
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
      $puntos = get_puntos_canjeados();
      $total = 0;
    ?>



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">PUNTOS CANJEADOS</h3>
                </div>

                  <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                     <div class="table-responsive">
                      <table id="example1" class="table table-flush">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">CLIENTE</th>
                            <th scope="col">MONTO</th>
                            <th scope="col">FECHA</th>
                            <th scope="col">HORA</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            foreach ($puntos as $key => $punto) {
                              $socio = get_socio_id($punto['socio_id']);
                              if($socio['nombre'] != ""){
                              $total = $total + $punto['monto'];
                          ?> 
                          <tr>
                            <td><?php echo $socio['nombre']; ?></td>
                            <td><?php echo number_format($punto['monto'], 0, ',', '.') ?></td>
                            <td><?php echo fecha_bd_normal($punto['fecha']) ?></td>
                            <td><?php echo $punto['hora'] ?></td>
                          </tr>
                          <?php
                             $data[] = array('y' => $punto['monto'], 'label' => $socio['nombre']);
                          }
                        }
                          ?>
                        </tbody>
                      </table>
                    </div>
                   </div>
                  </div>
                  <?php $dataPoints = $data; ?>
                  <div class="col-lg-12 text-center">
                    <div id="chartContainer" style="height: 1000px; width: 100%;"></div>
                    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                  </div>


                <div class="container">
                  <div class="row">
                    <div class="col-md-6">
                      <a  href="../Impresiones/ImprimeReporte.php?verreppuntoscanjeados" target="_blank" target="_blank" ><button type="button" class="btn btn-success btn-block my-4">Reporte</button></a>
                    </div>
                    <div class="col-md-6">
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


<script>
    window.onload = function() {
     
    var chart = new CanvasJS.Chart("chartContainer", {
      animationEnabled: true,
      title:{
        text: "PTOS CANJEADOS"
      },
      axisY: {
        title: "PTOS CANJEADOS",
        
      },
      data: [{
        type: "bar",
        yValueFormatString: "$#,##0",
        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
      }]
    });
    chart.render();
     
    }
  </script>
   


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
       $("#example1").DataTable();

    });
  </script>



</body>

</html>