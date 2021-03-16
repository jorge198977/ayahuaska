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
                  <h3 class="mb-0">CONSULTA BOLETA ELECTRONICA</h3>
                </div>

                <form name="frmguardarfolios" method="post" action="consulta_folio.php">
                  <div class="container">
                      
                      <div class="row">
                              <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Folio</label>
                                        <input type="number" class="form-control" name="folio" id="folio" placeholder="Ingrese folio (opcional)" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                  <div class="form-group">
                                     <input type="submit" name="btnconsultaboleta" class="btn btn-success btn-lg btn-block" value="Consultar">
                                  </div>
                                </div>
                            </div>
                  </div>
                </form>

                <?php
                  if(isset($_POST['btnconsultaboleta'])){
                    //$folios = "";
                    $obtener_datos = get_datos_boletas_by_folio($_POST['folio']);
                    $estado = get_estado_documento(39, $_POST['folio'], $obtener_datos[0]['monto'], fecha_bd_normal($obtener_datos[0]['fecha']));
                ?>


                    <div class="container">
                        
                        <div class="card">
                          <div class="card-header bg-info">
                            <strong>RESPUESTA DEL SII</strong>
                          </div>
                          <div class="card-body">
                              <div class="alert alert-info" role="alert">
                                   <strong> COD: <?php echo $estado['codigo'].", RESP: ".$estado['descripcion']; ?></strong>
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