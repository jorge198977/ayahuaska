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

        $ventas = top_garzones();
      
    ?>



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">TOP DE GARZONES</h3>
                </div>




                  
                  <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                     <div class="table-responsive">
                      <table id="example1" class="table table-flush">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">CAJERO</th>
                            <th scope="col">VENTA</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            foreach ($ventas as $key => $venta) {
                            $usuario = get_usuario_id($venta['usuario_id']);
                            if($venta['venta'] > 0){
                          ?> 
                          <tr>
                            <th><?php echo $usuario['nombre']." ".$usuario['apellido'] ?></th>
                            <th><?php echo number_format($venta['venta'], 0, ',', '.') ?></th>
                          </tr>
                          <?php
                            $vent[] = array('y' => $venta['venta'], 'label' => $usuario['nombre']." ".$usuario['apellido'] );
                            }
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                   </div>
                  </div>

                  <?php $dataPoints = $vent; ?>
                  <div class="col-lg-12 text-center">
                    <div id="chartContainer" style="height: 1000px; width: 100%;"></div>
                    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                  </div>




                <div class="container">
                  <div class="row">
                    <!-- <div class="col-md-6">
                      <a <?php if(isset($_GET['fechai'])){ ?> href="../Impresiones/ImprimeReporte.php?repGarzones&Fechai=<?php echo $_GET['fechai'] ?>&Fechaf=<?php echo $_GET['fechaf'] ?>" target="_blank" <?php } ?>><button type="button" class="btn btn-success btn-block my-4">Reporte</button></a>
                    </div> -->
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

  <script>
    window.onload = function() {
     
    var chart = new CanvasJS.Chart("chartContainer", {
      animationEnabled: true,
      title:{
        text: "VENTAS"
      },
      axisY: {
        title: "VENTAS",
        
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




</body>

</html>