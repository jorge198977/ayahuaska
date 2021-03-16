<?php session_start();   ?>
<!DOCTYPE html>
<html>

<?php 
  include("header.php"); 
  include("../../intranet/funciones/controlador.php");
  include("../../APISII/estado_documento.php");
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
                  <h3 class="mb-0">REIMPRIME BOLETA ELECTRONICA</h3>
                </div>

                <form name="frmguardarfolios" method="post" action="reimprime_boleta.php">
                  <div class="container">
                      
                      <div class="row">
                              <div class="col-md-12">
                                    <div class="form-group">
                                        <label>MOVIMIENTO</label>
                                        <input type="number" class="form-control" name="movimiento" id="movimiento" placeholder="Ingrese movimiento" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                  <div class="form-group">
                                     <input type="submit" name="btsreimprimir" class="btn btn-success btn-lg btn-block" value="IMPRIMIR">
                                  </div>
                                </div>
                            </div>
                  </div>
                </form>

                <?php
                  if(isset($_POST['btsreimprimir'])){
                    $existe_boleta = es_boleta_emitida($_POST['movimiento']);
                    //NO SE EMITIO BOLETA
                    if($existe_boleta == 0){

                    }
                    else{
                  ?>

                    <div class="container">
                        
                        <div class="card">
                          <div class="card-header bg-info">
                            <strong>RESPUESTA DEL SII</strong>
                          </div>
                          <div class="card-body">
                              <div class="alert alert-warning" role="alert">
                                   <strong> YA SE GENERO BOLETA CON ESE MOVIMIENTO, FOLIO ASOCIADO <?php echo $existe_boleta ?></strong>
                              </div>
                          </div>
                        </div>

                    </div>


                  <?php
                    }
                ?>

                <?php
                }
                ?>
                  
                

                <div class="container">
                  <div class="row">
                    <div class="col-md-12">
                      <a href="consultas.php"><button type="button" class="btn btn-danger btn-block my-4">Volver</button></a>
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