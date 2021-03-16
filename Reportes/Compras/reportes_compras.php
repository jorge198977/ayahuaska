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
          if($_GET['proveedor'] != 0){
            $compras = get_reportes_compras_proveedor($fechai, $fechaf, $_GET['proveedor']);
          }
          else{
            $compras = get_reportes_compras($fechai, $fechaf);
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
                  <h3 class="mb-0">REPORTES COMPRAS</h3>
                </div>

                <form name="frmfiltro" method="get" action="reportes_compras.php">
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
                          <select class="form-control" name="familia">
                            <option value="0">Todos</option>
                            <?php
                              $proveedores = get_all_proveedores();
                              foreach ($proveedores as $key => $proveedor) {
                            ?>
                              <option value="<?php echo $proveedor['id'] ?>"> <?php echo $proveedor['nombre'] ?></option>
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
                  
                  <div class="table-responsive">
                      <table  class="table table-flush">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">PROVEEDOR</th>
                            <th scope="col">MONTO</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          foreach ($compras as $key => $compra) {
                            $total = $total + $compra['total'];
                            $prov = get_proveedor_id($compra['proveedor_id']);
                         ?>   
                            <tr class="active">
                                <td><?php echo $prov['nombre'] ?></td>
                                <td><?php echo number_format($compra['total'], 0,',','.') ?></td>
                            </tr>
                         <?php
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>

                <?php    
                  }
                ?>





                <div class="container">
                  <div class="row">
                    <div class="col-md-6">
                      <a <?php if(isset($_GET['fechai'])){ ?> href="../Impresiones/ImprimeReporte.php?verrepcompras&Proveedor=<?php echo $_GET['proveedor'] ?>&Fechai=<?php echo $_GET['fechai'] ?>&Fechaf=<?php echo $_GET['fechaf'] ?>" target="_blank" <?php } ?>><button type="button" class="btn btn-success btn-block my-4">Reporte</button></a>
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