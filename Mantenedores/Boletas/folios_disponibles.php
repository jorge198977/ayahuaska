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



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">FOLIOS DISPONIBLES</h3>
                </div>

                <form name="frmfoliosdisp" method="post" action="folios_disponibles.php">
                  <div class="row">
                    <div class="container">
                      <div class="col-md-12">
                        <div class="form-group">
                          <div class="input-group mb-4">
                            <button type="submit" class="btn btn-success btn-lg btn-block" name="btnfoliosdisp">Filtrar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>

                <?php
                  if(isset($_POST['btnfoliosdisp'])){
                    $folios = get_folios_disponibles();
                   $cant = 0;
                ?>


                    <div class="container">
                        
                        <div class="card">
                          <div class="card-header bg-info">
                            FOLIOS
                          </div>
                          <div class="card-body">
                              <?php
                                foreach ($folios as $key => $folio) {
                              ?>
                              <span class="badge badge-default"><?php echo $folio['folio']; ?></span>
                              <?php
                                $cant++;
                              }
                              ?>
                          </div>
                        </div>
                        <br>
                        <br>
                        <strong>CANTIDAD DE FOLIOS: <?php echo $cant; ?></strong>

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