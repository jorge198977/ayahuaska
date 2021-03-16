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
      if(isset($_GET['fechai'])){
        $propinas = get_detalle_propinas_garzones($_GET['fechai'], $_GET['fechaf']);  
      }
    ?>



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">PROPINAS DE GARZONES</h3>
                </div>

                <form name="frmfiltro" method="get" action="propinas.php">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="input-group mb-4">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                          </div>
                          <input class="form-control" placeholder="Fecha Inicial" type="date" name="fechai" id="fechai">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="input-group mb-4">
                          <input class="form-control" placeholder="Fecha Final" type="date" name="fechaf" id="fechaf">
                          <div class="input-group-append">
                            <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <div class="input-group mb-4">
                          <button type="submit" class="btn btn-success btn-lg btn-block">Filtrar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>

                <?php
                  if(isset($_GET['fechai'])){
                ?>
                  
                  <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                     <div class="table-responsive">
                      <table id="example1" class="table table-flush">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">CAJERO</th>
                            <th scope="col">PROPINA</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            foreach ($propinas as $key => $propina) {
                            $usuario = get_usuario_id($propina['usuario_id']);
                          ?> 
                          <tr>
                            <th><?php echo $usuario['nombre']." ".$usuario['apellido'] ?></th>
                            <th><?php echo number_format($propina['propina'], 0, ',', '.') ?></th>
                          </tr>
                          <?php
                             $propin[] = array('y' => $propina['propina'], 'label' => $usuario['nombre']." ".$usuario['apellido'] );
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                   </div>
                  </div>
                  <?php $dataPoints = $propin; ?>
                  <div class="col-lg-12 text-center">
                    <div id="chartContainer" style="height: 1000px; width: 100%;"></div>
                    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                  </div>

                <?php    
                  }
                ?>


                <div class="container">
                  <div class="row">
                    <div class="col-md-6">
                      <a <?php if(isset($_GET['fechai'])){ ?> href="../Impresiones/ImprimeReporte.php?repGarzonesPropina&Fechai=<?php echo $_GET['fechai'] ?>&Fechaf=<?php echo $_GET['fechaf'] ?>" target="_blank" target="_blank" <?php } ?>><button type="button" class="btn btn-success btn-block my-4">Reporte</button></a>
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
        text: "PROPINAS"
      },
      axisY: {
        title: "PROPINAS",
        
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