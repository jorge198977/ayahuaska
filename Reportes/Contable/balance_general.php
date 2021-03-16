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
      if(isset($_POST['generalfiltro'])){
        $costos = get_reportes_costos_general($_POST['generalfiltro']);
        $utiliades = get_reportes_utilidades_general($_POST['generalfiltro']);
        $mes = '#';
        $dias = '#';
        $fechas = "#";
        $aniof = "#";
        $general = "active";
        $showm = "show";
      }
    ?>



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">BALANCE GENERAL</h3>
                </div>

                <div class="nav-wrapper">
                  <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                      <li class="nav-item">
                          <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="ni ni-calendar-grid-58 mr-2"></i>Balance General</a>
                      </li>
                  </ul>
              </div>
              <div class="card shadow">
                  <div class="card-body">
                      <div class="tab-content" id="myTabContent">
                          
                          <div class="tab-pane fade <?php echo $showm ?> <?php echo $general ?>" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                              
                            <form name="frmfiltro" method="post" action="balance_general.php">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                      <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                        </div>
                                        <select class="form-control" name="generalfiltro" required>
                                          <option value="">Seleccione año</option>
                                          <option value="2018">2018</option>
                                          <?php
                                            $anio_actual = date("Y");
                                            for($i = 2019; $i <= $anio_actual; $i++){
                                          ?>
                                            <option value="<?php echo $i ?>"><?php echo $i ?></option>  
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
                              if((isset($_POST['generalfiltro']))){
                              $total_costo = 0;
                              $total_utilidad = 0;
                            ?>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="table-responsive">
                                    <table  class="table table-flush">
                                      <thead class="thead-light">
                                        <tr>
                                          <th scope="col">MES</th>
                                          <th scope="col">COSTO</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                        $prod = null;
                                        foreach ($costos as $key => $costo) {
                                          $mes = get_mes_nombre($costo['mes']);
                                          $total_costo = $total_costo + $costo['costo'];
                                      ?>   
                                          <tr class="active">
                                              <td><?php echo $mes; ?></td>
                                              <td><?php echo number_format($costo['costo'], 0, ',', '.') ?></td>
                                          </tr>
                                         <?php
                                            $costo_arreglo[] = array('label' => $mes, 'y' => $costo['costo']);
                                          }
                                          ?>
                                      </tbody>
                                    </table>
                                   <center><h3> TOTAL COSTO EN EL MES $<?php echo number_format($total_costo, 0, ',', '.'); ?> </h3></center>
                                </div>

                                <?php
                                    for($i = 1; $i <= 12; $i++){
                                      $costo_arreglo2[] = array('label' => get_mes_nombre($i), 'y' => 0);
                                    }
                                    foreach ($costo_arreglo as $key => $cost_arr) {
                                      $num_mes = get_numero_mes($cost_arr['label']);
                                      $pos_arr = $num_mes - 1;
                                      $costo_arreglo2[$pos_arr] = array('label' => $cost_arr['label'], 'y' => $cost_arr['y']);
                                       //echo $num_mes;
                                    }
                                    $dataPoints = $costo_arreglo2;
                                ?>

                              </div>
                              <div class="col-md-6">
                                <div class="table-responsive">
                                    <table  class="table table-flush">
                                      <thead class="thead-light">
                                        <tr>
                                          <th scope="col">MES</th>
                                          <th scope="col">MONTO</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php                                      
                                          $utilida = 0;
                                          
                                          foreach ($utiliades as $key => $familia_reporte) {
                                            $mes = get_mes_nombre($familia_reporte['mes']);
                                            
                                            $util_mes = get_reportes_utilidades_mes($familia_reporte['mes'], $_POST['generalfiltro']);
                                            $costo_preparado = 0;
                                            foreach ($util_mes as $key => $util) {
                                              $producto_preparados = get_producto_preparados_id_prep($util['preparado_id']);
                                              foreach ($producto_preparados as $key => $prod_prep) {
                                                $nombre_producto = get_producto($prod_prep['producto_id']);
                                                $costo_asociado = get_costo_asociado($prod_prep['cantidad'], $nombre_producto['PRODUCTO_COSTO'], $nombre_producto['PRODUCTO_CAPACIDADPORUNIDAD']);
                                                  $costo_preparado = $costo_preparado + $costo_asociado;
                                              }
                                              $cost = $costo_preparado*$util['cantidad'];
                                            }
                                            

                                          ?>
                                             <tr class="active">
                                                <td><?php echo $mes; ?></td>
                                                <td><?php echo number_format($familia_reporte['utilidad_bruta'] - $cost, 0, ',', '.') ?></td>
                                            </tr>
                                           <?php
                                              $utilida = $utilida + ($familia_reporte['utilidad_bruta'] - $cost);
                                              $utilidad_arreglo[] = array('label' => $mes, 'y' => $familia_reporte['utilidad_bruta'] - $cost);
                                            }
                                            ?>
                                      </tbody>
                                    </table>
                                   <center><h3> TOTAL UTILIDAD $<?php echo number_format($utilida, 0, ',', '.'); ?> </h3></center>
                                </div>

                                <?php

                                  for($i = 1; $i <= 12; $i++){
                                    $utilidad_arreglo2[] = array('label' => get_mes_nombre($i), 'y' => 0);
                                  }
                                  foreach ($utilidad_arreglo as $key => $ut_arr) {
                                    $num_mes = get_numero_mes($ut_arr['label']);
                                    $pos_arr = $num_mes - 1;
                                    $utilidad_arreglo2[$pos_arr] = array('label' => $ut_arr['label'], 'y' => intval($ut_arr['y']));
                                     //echo $num_mes;
                                  }

                                  $dataPoints2 = $utilidad_arreglo2;
                                ?>

                              </div>
                            </div>


                              <div class="col-lg-12 text-center">
                                <div id="chartContainer" style="height: 1000px; width: 100%;"></div>
                                <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                              </div>

                            <?php    
                              }
                            ?>

                          </div>

                      </div>
                  </div>
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

    <script>
    window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer", {
      animationEnabled: true,
      title:{
        text: "BALANCE GENERAL AÑO <?php echo $_POST['generalfiltro'] ?>"
      },  
      axisY: {
        title: "PESOS CHILENOS",
        titleFontColor: "#4F81BC",
        lineColor: "#C0504E",
        labelFontColor: "#C0504E",
        tickColor: "#4F81BC"
      },
      axisY2: {
        title: "PESOS CHILENOS",
        titleFontColor: "#C0504E",
        lineColor: "#4F81BC",
        labelFontColor: "#4F81BC",
        tickColor: "#C0504E"
      },  
      toolTip: {
        shared: true
      },
      legend: {
        cursor:"pointer",
        itemclick: toggleDataSeries
      },
      data: [{
        type: "column",
        name: "Utilidad $",
        legendText: "Utilidad Total",
        showInLegend: true, 
        dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
      },
      {
        type: "column", 
        name: "COSTO $",
        legendText: "COSTO TOTAL",
        axisYType: "secondary",
        showInLegend: true,
        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
      }]
    });
    chart.render();

    function toggleDataSeries(e) {
      if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
        e.dataSeries.visible = false;
      }
      else {
        e.dataSeries.visible = true;
      }
      chart.render();
    }

    }
</script>

</html>