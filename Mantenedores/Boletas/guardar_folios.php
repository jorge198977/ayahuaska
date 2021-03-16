<?php session_start();   ?>
<!DOCTYPE html>
<html>

<?php 
  include("header.php"); 
  include("../../intranet/funciones/controlador.php");
  include("../../APISII/manejo_folios.php");
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
                  <h3 class="mb-0">GUARDAR FOLIOS</h3>
                </div>

                <form name="frmguardarfolios" method="post" action="guardar_folios.php" enctype="multipart/form-data">
                  <div class="row">
                    <div class="container">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <div class="custom-file">
                              <input type="file" class="custom-file-input" id="folio" name="folio" lang="es">
                              <label class="custom-file-label" for="customFileLang">Archivo XML de folios</label>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <div class="input-group mb-4">
                            <button type="submit" class="btn btn-success btn-lg btn-block" name="btnguardarfolios">GUARDAR</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>

                <?php
                  if(isset($_POST['btnguardarfolios'])){
                    //$ambiente = "certificación";
                    $ambiente = "producción";
                    $carpetaDestino = "../../APISII/xml/empresas/TURQUESA";
                    if(file_exists($carpetaDestino) || @mkdir($carpetaDestino)){
                      $archivo = basename($_FILES['folio']['name']); 
                      $extension = pathinfo($archivo, PATHINFO_EXTENSION);
                      $archivo = md5($archivo);
                      $origen=$_FILES["folio"]["tmp_name"];
                      $destino=$carpetaDestino."/".$archivo.".".$extension;
                      $nombre = $archivo.".".$extension;
                      if(move_uploaded_file($origen, $destino)){
                        $empresa = "76324007-K";
                        $resp = set_folios($empresa, $ambiente, file_get_contents($destino), $nombre);
                      }
                    }
                ?>


                    <div class="container">
                        
                        <div class="card">
                          <div class="card-header bg-info">
                            <strong>RESPUESTA DEL SII</strong>
                          </div>
                          <div class="card-body">
                              <div class="alert alert-info" role="alert">
                                  <strong> <?php echo $resp; ?></strong>
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