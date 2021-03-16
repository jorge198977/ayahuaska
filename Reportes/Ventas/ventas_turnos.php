<?php session_start();   ?>
<!DOCTYPE html>
<html>

<?php 
  include("header.php"); 
  include("../../intranet/funciones/controlador.php");
  date_default_timezone_set('America/Santiago');
  $total = 0;
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
      if(isset($_GET['turno'])){
          $turno = $_GET['turno']; 
          if($turno == 1){
            $fechahoy = $_GET['fechai'];  
            $horat21 = "09:00:00";
            $hotat22 = "21:00:00";
            $fecha21 = $fechahoy." ".$horat21;
            $fecha22 = $fechahoy." ".$hotat22;
            if($_GET['familia'] != 0){
                $ventas_fechas = get_reportes_ventas_turnos_familia($_GET['familia'], $fecha21, $fecha22);
            }
            else{
              $ventas_fechas = get_reportes_ventas_turnos($fecha21, $fecha22);  
            }

          } 
          if($turno == 2){
            $fechahoy = $_GET['fechai'];
            $horaactual = date("H:i:s");
            $horario1 = "00:00:00";
            $horario2 = "06:00:00";
            $ret = dentro_de_horario($horario1, $horario2, $horaactual);
            if($ret == 1){
              $fecha = $_GET['fechai'];
              $fechan = strtotime ( '-1 day' , strtotime ( $fecha ) ) ;
              $fechan = date ( 'Y-m-j' , $fechan ); 
              $hora221 = "00:00:00";
              $hora222 = "08:55:00";
              $horat21 = "21:00:01";
              $hotat22 = "23:59:59";
              $fecha21 = $fechan." ".$horat21;
              $fecha22 = $fechan." ".$hotat22;
              $fecha221 = $fechahoy." ".$hora221;
              $fecha222 = $fechahoy." ".$hora222;
            }
            else{
              $fecha = $_GET['fechai'];
              $fechan = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
              $fechan = date ( 'Y-m-j' , $fechan ); 
              $hora221 = "00:00:00";
              $hora222 = "08:55:00";
              $horat21 = "21:00:01";
              $hotat22 = "23:59:59";
              $fecha21 = $fechahoy." ".$horat21;
              $fecha22 = $fechahoy." ".$hotat22;
              $fecha221 = $fechan." ".$hora221;
              $fecha222 = $fechan." ".$hora222;
            }
            if($_GET['familia'] != 0){
              $ventas_fechas = get_reportes_ventas_turnos_familia($_GET['familia'], $fecha21, $fecha22, $fecha221, $fecha222);
            } 
            else{
              $ventas_fechas = get_reportes_ventas_turnos_fechas($fecha21, $fecha22, $fecha221, $fecha222);
            } 
          }
        }
    ?>



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">VENTAS POR TURNO</h3>
                </div>

                <form name="frmfiltro" method="get" action="ventas_turnos.php">
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
                          <div class="col-sm-10">
                            <select class="form-control" name="turno">
                              <option value="">Seleccione turno</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <div class="input-group mb-4">
                          <select class="form-control" name="familia">
                            <option value="0">Todas</option>
                            <?php
                              $familias = get_all_familias();
                              foreach ($familias as $key => $familia) {
                            ?>
                              <option value="<?php echo $familia['id'] ?>"> <?php echo $familia['nombre'] ?></option>
                            <?php
                            }
                            ?>
                          </select>
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
                            <th scope="col">Descripción</th>
                            <th scope="col">Cantidad</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            foreach ($ventas_fechas as $key => $venta_fecha) {
                          ?> 
                          <tr>
                            <th><?php echo $venta_fecha['preparado_nombre'] ?></th>
                            <th><?php echo $venta_fecha['cantidad'] ?></th>
                          </tr>
                          <?php
                            $vent[] = array('y' => $venta_fecha['cantidad'], 'label' => $venta_fecha['preparado_nombre']);
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

                <?php    
                  }
                ?>


                <div class="container">
                  <div class="row">
                    <div class="col-md-6">
                      <a <?php if(isset($_GET['fechai'])){ ?> href="../Impresiones/ImprimeReporte.php?repvta&Fechai=<?php echo $_GET['fechai'] ?>&Turno=<?php echo $_GET['turno'] ?>&Familia=<?php echo $_GET['familia'] ?>" target="_blank" <?php } ?>><button type="button" class="btn btn-success btn-block my-4">Reporte</button></a>
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
  <script>
    $(function () {
       $("#example1").DataTable();

    });
  </script>



</body>

</html>