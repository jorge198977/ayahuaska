<?php session_start();   ?>
<!DOCTYPE html>
<html>

<?php 
  include("header.php"); 
  include("../../intranet/funciones/controlador.php");
  include("../../APISII/consulta_estado.php");
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
                  <h3 class="mb-0">CONSULTA TRACKID</h3>
                </div>

                <form name="frmguardarfolios" method="post" action="consulta_trackid.php">
                  <div class="container">
                      
                      <div class="row">
                        <div class="col-md-12">
                              <div class="form-group">
                                  <label>TRACKID</label>
                                  <input type="text" class="form-control" name="trackid" id="trackid" placeholder="Ingrese trackid" autocomplete="off">
                              </div>
                          </div>
                          <div class="col-lg-12">
                            <div class="form-group">
                               <input type="submit" name="btnconsultatrackid" class="btn btn-success btn-lg btn-block" value="Consultar">
                            </div>
                          </div>
                      </div>
                  </div>
                </form>

                <?php
                  if(isset($_POST['btnconsultatrackid'])){
                    //$folios = "";
                    $estado = get_estado_by_trackid("76825194-0", $_POST['trackid']);
                ?>


                    <div class="container">
                        
                        <div class="card">
                          <div class="card-header bg-info">
                            <strong>RESPUESTA DEL SII</strong>
                          </div>
                          <div class="card-body">
                              <div class="alert alert-info" role="alert">
                                  <strong> RUTENVIA: <?php echo $estado['rut_envia']. "<br> FECHA RECEP: ".$estado['fecha_recepcion']."<br> ESTADO: ".$estado['estado']."<br> INFORMADOS: ".$estado['estadistica'][0]['informados']." <br> ACEPTADO: ".$estado['estadistica'][0]['aceptados']." <br> RECHAZADOS: ".$estado['estadistica'][0]['rechazados']." <br> REPAROS: ".$estado['estadistica'][0]['reparos']; ?></strong>
                              </div>
                          </div>
                        </div>

                    </div>



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