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
      if(isset($_GET['fechai'])){
          $fechai = $_GET['fechai']; 
          $fechaf = $_GET['fechaf']; 
          $estados_compras = get_reporte_compras_estados($fechai, $fechaf, $_GET['nuevoestado']);          
      }
    ?>



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">REPORTES ESTADOS DE FACTURAS</h3>
                </div>

                <form name="frmfiltro" method="get" action="reportes_estado_facturas.php">
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
                          <select name="nuevoestado" class="form-control input-lg" required>
                            <option value="">Ingrese nuevo estado</option>
                              <option value="0">NO PAGADA</option>
                              <option value="1">PAGADA</option>
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
                  
                  <div class="table-responsive">
                      <table  class="table table-flush">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">N° FACTURA</th>
                            <th scope="col">PROVEEDOR</th>
                            <th scope="col">VALOR ($)</th>
                            <th scope="col">FORMA PAGO</th>
                            <th scope="col">TRANSF</th>
                            <th scope="col">FECHA</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          foreach ($estados_compras as $key => $estado_compra) {
                            $total = $total + $estado_compra['total'];
                            $prov = get_proveedor_id($estado_compra['proveedor_id']);
                            $forma_pago = get_froma_pago_compra_by_id($estado_compra['forma_pago_id']);

                            if($estado_compra['num_transferencia'] == 0){
                              $transf = "N/A";
                            }
                            else{
                              $transf = $estado_compra['num_transferencia'];
                            }
                         ?>   
                            <tr class="active">
                                <td><?php echo $estado_compra['id'] ?></td>
                                <td><?php echo $prov['nombre'] ?></td>
                                <td><?php echo number_format($estado_compra['total'], 0,',','.') ?></td>
                                <td><?php echo $forma_pago ?></td>
                                <td><?php echo $transf ?></td>
                                <td><?php echo fecha_bd_normal($estado_compra['fecha']) ?></td>
                            </tr>
                         <?php
                          }
                          ?>
                        </tbody>
                      </table>
                      <center><h3> TOTAL EN COMPRAS $<?php echo number_format($total, 0,',','.'); ?> </h3></center>
                    </div>

                <?php    
                  }
                ?>





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

</html>