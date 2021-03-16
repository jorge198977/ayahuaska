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
      if(isset($_POST['fechai'])){
        $utiliades = get_reportes_utilidades_fecha_rango($_POST['fechai'], $_POST['fechaf']);
        $fechas = 'active';
        $dias = '#';
        $mes = "#";
        $aniof = "#";
        $showf = "show";
        $showd = "";
        $showm = "";
        $showa = "";
      }
      if(isset($_POST['dia'])){
        $utiliades = get_reportes_utilidades_dia($_POST['dia']);
        $dias = 'active';
        $fechas = "#";
        $mes = "#";
        $aniof = "#";
        $showf = "";
        $showd = "show";
        $showm = "";
        $showa = "";
      }
      if(isset($_POST['mesfiltro'])){
        $utiliades = get_reportes_utilidades_mes($_POST['mesfiltro'], $_POST['aniofiltro']);
        $mes = 'active';
        $dias = '#';
        $fechas = "#";
        $aniof = "#";
        $showf = "";
        $showd = "";
        $showm = "show";
        $showa = "";
      }
      if(isset($_POST['aniofiltro2'])){
        $utiliades = get_reportes_utilidades_anio($_POST['aniofiltro2']);
        $mes = '#';
        $dias = '#';
        $fechas = "#";
        $aniof = "active";
        $showf = "";
        $showd = "";
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
                  <h3 class="mb-0">REPORTES UTILIDADES</h3>
                </div>

                <div class="nav-wrapper">
                  <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                      <li class="nav-item">
                          <a class="nav-link mb-sm-3 mb-md-0 <?php echo $fechas ?>" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-calendar-grid-58 mr-2"></i>RANGO DE FECHAS</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link mb-sm-3 mb-md-0 <?php echo $dias ?>" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-calendar-grid-58 mr-2"></i>DIAS</a>
                      </li>
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
                          <div class="tab-pane fade <?php echo $showf ?> <?php echo $fechas ?>" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                              
                            <form name="frmfiltro" method="post" action="index.php">
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
                              if(isset($_POST['fechai'])){
                                $total = 0;
                            ?>

                            <div class="table-responsive">
                              <table  class="table table-flush">
                                <thead class="thead-light">
                                  <tr>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">COSTO</th>
                                    <th scope="col">Precio U</th>
                                    <th scope="col">UTILIDAD</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $prod = null;
                                    foreach ($utiliades as $key => $familia_reporte) {
                                      $producto_preparados = get_producto_preparados_id_prep($familia_reporte['preparado_id']);
                                      $costo_preparado = 0;
                                      foreach ($producto_preparados as $key => $prod_prep) {
                                        $nombre_producto = get_producto($prod_prep['producto_id']);
                                        $costo_asociado = get_costo_asociado($prod_prep['cantidad'], $nombre_producto['PRODUCTO_COSTO'], $nombre_producto['PRODUCTO_CAPACIDADPORUNIDAD']);
                                          $costo_preparado = $costo_preparado + $costo_asociado;
                                      }
                                

                                        $subtotal = ($familia_reporte['preparado_precio']*$familia_reporte['cantidad'])-($costo_preparado*$familia_reporte['cantidad']);
                                        $total = $total + $subtotal;
                                      ?>   
                                      <tr class="active">
                                          <td><?php echo $familia_reporte['preparado_nombre'] ?></td>
                                          <td><?php echo $familia_reporte['cantidad'] ?></td>
                                          <td><?php echo number_format($costo_preparado, 0, ',', '.') ?></td>
                                          <td><?php echo number_format($familia_reporte['preparado_precio'], 0, ',', '.') ?></td>
                                          <td><?php echo number_format($subtotal, 0, ',', '.') ?></td>
                                      </tr>
                                     <?php
                                        $prod[] = array('y' => $subtotal, 'label' => $familia_reporte['preparado_nombre'] );
                                      }
                                      ?>
                                </tbody>
                              </table>
                              <center><h3> TOTAL UTILIDAD $<?php echo number_format($total, 0, ',', '.'); ?> </h3></center>
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
                          <div class="tab-pane fade <?php echo $showd ?> <?php echo $dias ?>" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                              
                            <form name="frmfiltro" method="post" action="index.php">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <div class="input-group mb-4">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                      </div>
                                      <input class="form-control" placeholder="Ingrese día" type="date" name="dia" id="dia">
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
                              if(isset($_POST['dia'])){
                                $total = 0;
                            ?>

                              <div class="table-responsive">
                                <table  class="table table-flush">
                                  <thead class="thead-light">
                                    <tr>
                                      <th scope="col">Descripción</th>
                                      <th scope="col">Cantidad</th>
                                      <th scope="col">COSTO</th>
                                      <th scope="col">Precio U</th>
                                      <th scope="col">UTILIDAD</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                      $prod = null;
                                      foreach ($utiliades as $key => $familia_reporte) {
                                        $producto_preparados = get_producto_preparados_id_prep($familia_reporte['preparado_id']);
                                        $costo_preparado = 0;
                                        foreach ($producto_preparados as $key => $prod_prep) {
                                          $nombre_producto = get_producto($prod_prep['producto_id']);
                                          $costo_asociado = get_costo_asociado($prod_prep['cantidad'], $nombre_producto['PRODUCTO_COSTO'], $nombre_producto['PRODUCTO_CAPACIDADPORUNIDAD']);
                                            $costo_preparado = $costo_preparado + $costo_asociado;
                                        }
                                  

                                          $subtotal = ($familia_reporte['preparado_precio']*$familia_reporte['cantidad'])-($costo_preparado*$familia_reporte['cantidad']);
                                          $total = $total + $subtotal;
                                        ?>   
                                        <tr class="active">
                                            <td><?php echo $familia_reporte['preparado_nombre'] ?></td>
                                            <td><?php echo $familia_reporte['cantidad'] ?></td>
                                            <td><?php echo number_format($costo_preparado, 0, ',', '.') ?></td>
                                            <td><?php echo number_format($familia_reporte['preparado_precio'], 0, ',', '.') ?></td>
                                            <td><?php echo number_format($subtotal, 0, ',', '.') ?></td>
                                        </tr>
                                       <?php
                                          $prod[] = array('y' => $subtotal, 'label' => $familia_reporte['preparado_nombre'] );
                                        }
                                        ?>
                                  </tbody>
                                </table>
                                <center><h3> TOTAL UTILIDAD $<?php echo number_format($total, 0, ',', '.'); ?> </h3></center>
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
                          <div class="tab-pane fade <?php echo $showm ?> <?php echo $mes ?>" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                              
                            <form name="frmfiltro" method="post" action="index.php">
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

                            <div class="table-responsive">
                                <table  class="table table-flush">
                                  <thead class="thead-light">
                                    <tr>
                                      <th scope="col">Descripción</th>
                                      <th scope="col">Cantidad</th>
                                      <th scope="col">COSTO</th>
                                      <th scope="col">Precio U</th>
                                      <th scope="col">UTILIDAD</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                      $prod = null;
                                      foreach ($utiliades as $key => $familia_reporte) {
                                        $producto_preparados = get_producto_preparados_id_prep($familia_reporte['preparado_id']);
                                        $costo_preparado = 0;
                                        foreach ($producto_preparados as $key => $prod_prep) {
                                          $nombre_producto = get_producto($prod_prep['producto_id']);
                                          $costo_asociado = get_costo_asociado($prod_prep['cantidad'], $nombre_producto['PRODUCTO_COSTO'], $nombre_producto['PRODUCTO_CAPACIDADPORUNIDAD']);
                                            $costo_preparado = $costo_preparado + $costo_asociado;
                                        }
                                  

                                          $subtotal = ($familia_reporte['preparado_precio']*$familia_reporte['cantidad'])-($costo_preparado*$familia_reporte['cantidad']);
                                          $total = $total + $subtotal;
                                        ?>   
                                        <tr class="active">
                                            <td><?php echo $familia_reporte['preparado_nombre'] ?></td>
                                            <td><?php echo $familia_reporte['cantidad'] ?></td>
                                            <td><?php echo number_format($costo_preparado, 0, ',', '.') ?></td>
                                            <td><?php echo number_format($familia_reporte['preparado_precio'], 0, ',', '.') ?></td>
                                            <td><?php echo number_format($subtotal, 0, ',', '.') ?></td>
                                        </tr>
                                       <?php
                                          $prod[] = array('y' => $subtotal, 'label' => $familia_reporte['preparado_nombre'] );
                                        }
                                        ?>
                                  </tbody>
                                </table>
                                <center><h3> TOTAL UTILIDAD $<?php echo number_format($total, 0, ',', '.'); ?> </h3></center>
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
                              
                            <form name="frmfiltro" method="post" action="index.php">
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

                            <div class="table-responsive">
                                <table  class="table table-flush">
                                  <thead class="thead-light">
                                    <tr>
                                      <th scope="col">Descripción</th>
                                      <th scope="col">Cantidad</th>
                                      <th scope="col">COSTO</th>
                                      <th scope="col">Precio U</th>
                                      <th scope="col">UTILIDAD</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                      $prod = null;
                                      foreach ($utiliades as $key => $familia_reporte) {
                                        $producto_preparados = get_producto_preparados_id_prep($familia_reporte['preparado_id']);
                                        $costo_preparado = 0;
                                        foreach ($producto_preparados as $key => $prod_prep) {
                                          $nombre_producto = get_producto($prod_prep['producto_id']);
                                          $costo_asociado = get_costo_asociado($prod_prep['cantidad'], $nombre_producto['PRODUCTO_COSTO'], $nombre_producto['PRODUCTO_CAPACIDADPORUNIDAD']);
                                            $costo_preparado = $costo_preparado + $costo_asociado;
                                        }
                                  

                                          $subtotal = ($familia_reporte['preparado_precio']*$familia_reporte['cantidad'])-($costo_preparado*$familia_reporte['cantidad']);
                                          $total = $total + $subtotal;
                                        ?>   
                                        <tr class="active">
                                            <td><?php echo $familia_reporte['preparado_nombre'] ?></td>
                                            <td><?php echo $familia_reporte['cantidad'] ?></td>
                                            <td><?php echo number_format($costo_preparado, 0, ',', '.') ?></td>
                                            <td><?php echo number_format($familia_reporte['preparado_precio'], 0, ',', '.') ?></td>
                                            <td><?php echo number_format($subtotal, 0, ',', '.') ?></td>
                                        </tr>
                                       <?php
                                          $prod[] = array('y' => $subtotal, 'label' => $familia_reporte['preparado_nombre'] );
                                        }
                                        ?>
                                  </tbody>
                                </table>
                                <center><h3> TOTAL UTILIDAD $<?php echo number_format($total, 0, ',', '.'); ?> </h3></center>
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
                      <a href="../index.php"><button type="button" class="btn btn-danger btn-block my-4">Volver</button></a>
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
    window.onload = function() {
     
    var chart = new CanvasJS.Chart("chartContainer", {
      animationEnabled: true,
      title:{
        text: "UTILIDADES"
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

</html>