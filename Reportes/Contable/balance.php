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
      if(isset($_POST['mesfiltro'])){
        $costos = get_reportes_costos_mes($_POST['mesfiltro'], $_POST['aniofiltro']);
        $utiliades = get_reportes_utilidades_mes($_POST['mesfiltro'], $_POST['aniofiltro']);
        $mes = 'active';
        $dias = '#';
        $fechas = "#";
        $aniof = "#";
        $showm = "show";
        $showa = "";
      }
      if(isset($_POST['aniofiltro2'])){
        $costos = get_reportes_costos_anio($_POST['aniofiltro2']);
        $utiliades = get_reportes_utilidades_anio($_POST['aniofiltro2']);
        $mes = '#';
        $dias = '#';
        $fechas = "#";
        $aniof = "active";
        $showm = "";
        $showa = "show";
      }
    ?>



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">BALANCE</h3>
                </div>

                <div class="nav-wrapper">
                  <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                      <li class="nav-item">
                          <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="ni ni-calendar-grid-58 mr-2"></i>MES</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link mb-sm-4 mb-md-0" id="tabs-icons-text-4-tab" data-toggle="tab" href="#tabs-icons-text-4" role="tab" aria-controls="tabs-icons-text-4" aria-selected="false"><i class="ni ni-calendar-grid-58 mr-2"></i>AÑO</a>
                      </li>
                  </ul>
              </div>
              <div class="card shadow">
                  <div class="card-body">
                      <div class="tab-content" id="myTabContent">
                          
                          <div class="tab-pane fade <?php echo $showm ?> <?php echo $mes ?>" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                              
                            <form name="frmfiltro" method="post" action="balance.php">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <div class="input-group mb-4">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                      </div>
                                      <select class="form-control" name="mesfiltro">
                                        <option value="">Seleccione Mes</option>
                                        <option value="1">ENERO</option>
                                        <option value="2">FEBRERO</option>
                                        <option value="3">MARZO</option>
                                        <option value="4">ABRIL</option>
                                        <option value="5">MAYO</option>
                                        <option value="6">JUNIO</option>
                                        <option value="7">JULIO</option>
                                        <option value="8">AGOSTO</option>
                                        <option value="9">SEPTIEMBRE</option>
                                        <option value="10">OCTUBRE</option>
                                        <option value="11">NOVIEMBRE</option>
                                        <option value="12">DICIEMBRE</option>
                                      </select>
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                      <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                        </div>
                                        <select class="form-control" name="aniofiltro" required>
                                          <option value="">Seleccione año</option>
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
                              if((isset($_POST['mesfiltro']))){
                              $total = 0;
                            ?>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="table-responsive">
                                    <table  class="table table-flush">
                                      <thead class="thead-light">
                                        <tr>
                                          <th scope="col">NOMBRE</th>
                                          <th scope="col">COSTO</th>
                                          <th scope="col">TIPO</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                          $prod = null;
                                          foreach ($costos as $key => $costo) {
                                            $total_costo = $total_costo + $costo['costo'];
                                            $tipo_costo = get_tipo_costo_id($costo['tipo_costo_id']);
                                        ?>   
                                            <tr class="active">
                                                <td><?php echo $costo['nombre'] ?></td>
                                                <td><?php echo number_format($costo['costo'], 0, ',', '.') ?></td>
                                                <td><?php echo $tipo_costo['nombre'] ?></td>
                                            </tr>
                                           <?php
                                            }
                                            ?>
                                      </tbody>
                                    </table>
                                   <center><h3> TOTAL COSTO EN EL MES $<?php echo number_format($total_costo, 0, ',', '.'); ?> </h3></center>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="table-responsive">
                                    <table  class="table table-flush">
                                      <thead class="thead-light">
                                        <tr>
                                          <th scope="col">Descripción</th>
                                          <th scope="col">Cantidad</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                          $prod = null;
                                          $cantidades = 0;
                                          foreach ($utiliades as $key => $familia_reporte) {
                                            $producto_preparados = get_producto_preparados_id_prep($familia_reporte['preparado_id']);
                                            $costo_preparado = 0;
                                      foreach ($producto_preparados as $key => $prod_prep) {
                                        $nombre_producto = get_producto($prod_prep['producto_id']);
                                        $costo_asociado = get_costo_asociado($prod_prep['cantidad'], $nombre_producto['PRODUCTO_COSTO'], $nombre_producto['PRODUCTO_CAPACIDADPORUNIDAD']);
                                          $costo_preparado = $costo_preparado + $costo_asociado;
                                      }
                                            $cantidades = $cantidades + $familia_reporte['cantidad'];
                                            $subtotal = ($familia_reporte['preparado_precio']*$familia_reporte['cantidad'])-($costo_preparado*$familia_reporte['cantidad']);
                                            $total_utilidad = $total_utilidad + $subtotal;
                                        ?>   
                                           <?php
                                            }
                                            ?>
                                        <tr class="active">
                                            <td>VENTA DE PRODUCTOS</td>
                                            <td><?php echo $cantidades ?></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                   <center><h3> TOTAL UTILIDAD $<?php echo number_format($total_utilidad, 0, ',', '.'); ?> </h3></center>
                                </div>
                              </div>
                            </div>



                              <?php
                                $dataPoints = $prod;
                              ?>

                              <div id="chartContainer" style="height: 1300px; width: 100%;"></div>
                              <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

                            <?php    
                              }
                            ?>

                          </div>
                          <div class="tab-pane fade <?php echo $showa ?> <?php echo $aniof ?>" id="tabs-icons-text-4" role="tabpanel" aria-labelledby="tabs-icons-text-4-tab">
                              
                            <form name="frmfiltro" method="post" action="balance.php">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                      <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                        </div>
                                        <select class="form-control" name="aniofiltro2" required>
                                          <option value="">Seleccione año</option>
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
                              if((isset($_POST['aniofiltro2']))){
                              $total = 0;
                            ?>

                               <div class="row">
                              <div class="col-md-6">
                                <div class="table-responsive">
                                    <table  class="table table-flush">
                                      <thead class="thead-light">
                                        <tr>
                                          <th scope="col">NOMBRE</th>
                                          <th scope="col">COSTO</th>
                                          <th scope="col">TIPO</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                          $prod = null;
                                          foreach ($costos as $key => $costo) {
                                            $total_costo = $total_costo + $costo['costo'];
                                            $tipo_costo = get_tipo_costo_id($costo['tipo_costo_id']);
                                        ?>   
                                            <tr class="active">
                                                <td><?php echo $costo['nombre'] ?></td>
                                                <td><?php echo number_format($costo['costo'], 0, ',', '.') ?></td>
                                                <td><?php echo $tipo_costo['nombre'] ?></td>
                                            </tr>
                                           <?php
                                            }
                                            ?>
                                      </tbody>
                                    </table>
                                   <center><h3> TOTAL COSTO EN EL MES $<?php echo number_format($total_costo, 0, ',', '.'); ?> </h3></center>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="table-responsive">
                                    <table  class="table table-flush">
                                      <thead class="thead-light">
                                        <tr>
                                          <th scope="col">Descripción</th>
                                          <th scope="col">Cantidad</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                          $prod = null;
                                          $cantidades = 0;
                                          foreach ($utiliades as $key => $familia_reporte) {
                                            $producto_preparados = get_producto_preparados_id_prep($familia_reporte['preparado_id']);
                                            $costo_preparado = 0;
                                      foreach ($producto_preparados as $key => $prod_prep) {
                                        $nombre_producto = get_producto($prod_prep['producto_id']);
                                        $costo_asociado = get_costo_asociado($prod_prep['cantidad'], $nombre_producto['PRODUCTO_COSTO'], $nombre_producto['PRODUCTO_CAPACIDADPORUNIDAD']);
                                          $costo_preparado = $costo_preparado + $costo_asociado;
                                      }
                                            $cantidades = $cantidades + $familia_reporte['cantidad'];
                                            $subtotal = ($familia_reporte['preparado_precio']*$familia_reporte['cantidad'])-($costo_preparado*$familia_reporte['cantidad']);
                                            $total_utilidad = $total_utilidad + $subtotal;
                                        ?>   
                                           <?php
                                            }
                                            ?>
                                        <tr class="active">
                                            <td>VENTA DE PRODUCTOS</td>
                                            <td><?php echo $cantidades ?></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                   <center><h3> TOTAL UTILIDAD $<?php echo number_format($total_utilidad, 0, ',', '.'); ?> </h3></center>
                                </div>
                              </div>
                            </div>



                              <?php
                                $dataPoints = $prod;
                              ?>

                              <div id="chartContainer" style="height: 1300px; width: 100%;"></div>
                              <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                            

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
      theme: "light2", // "light1", "light2", "dark1", "dark2"
      title: {
        text: "BALANCE GENERAL <?php echo number_format(($total_utilidad - $total_costo), 0, ',', '.') ?>"
      },
      axisY: {
        title: "PESOS CHILENOS",
        suffix: "$",
        includeZero: false
      },
      axisX: {
        title: ""
      },
      data: [{
        type: "column",
        //yValueFormatString: "#,##0.0#\"%\"",
        yValueFormatString: "$#,##0",
        dataPoints: [
          { label: "COSTOS", y: <?php echo $total_costo ?> }, 
          { label: "UTILIDADES", y: <?php echo $total_utilidad ?> }
        ]
      }]
    });
    chart.render();

    }
  </script>

</html>