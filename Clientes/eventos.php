<?php session_start();   ?>
<!DOCTYPE html>
<html>

<?php 
  include("header.php"); 
  include("../intranet/funciones/controlador.php");
?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">
    <link rel="stylesheet" href="gallery-clean.css">
<body>
  <!-- Sidenav -->
  <?php include("sidenav.php"); ?>
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <?php include("top_nav.php"); ?>
    <!-- Header -->

    <?php
      $eventos_activos = get_eventos_activos(0);
    ?>

    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">Próximos Eventos en Ayahuska</h3>
                </div>

                  <div class="tz-gallery">
                    <?php
                      foreach ($eventos_activos as $key => $evento) {
                        $imagen = get_imagen_evento($evento['id']);
                        $dir = "Eventos/".$evento['id']."/".$imagen['nombre'];
                    ?>  
                        <div class="col-sm-6 col-md-4">
                          <div class="thumbnail">
                              <a class="lightbox" href="<?php echo $dir ?>">
                                  <img src="<?php echo $dir ?>">
                              </a>
                              <div class="caption">
                                  <h3><?php echo $evento['nombre'] ?></h3>
                                  <p><?php echo nl2br($evento['descripcion']) ?>.</p>
                              </div>
                          </div>
                        </div>


                    <?php
                      }
                    ?>
                  </div>



                <div class="card-footer py-12">
                  <div class="container">
                    <nav aria-label="...">
                      <a href="../qrclientes.php?qrcli&Mesa=<?php echo $_GET['Mesa'] ?>"><button type="button" class="btn btn-danger btn-block my-4">Volver</button></a>
                    </nav>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
<script>
    baguetteBox.run('.tz-gallery');
</script>
  

  <!-- Argon Scripts -->
  <!-- Core -->

  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.0.0"></script>


</body>

</html>