<?php session_start();   ?>
<!DOCTYPE html>
<html>

<?php 
  include("header.php"); 
  include("../../intranet/funciones/controlador.php");
?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">
    <link rel="stylesheet" href="gallery-clean.css">


<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v10.0&appId=194743868250254&autoLogAppEvents=1" nonce="JtIC8F4S"></script>

<body>
  <!-- Sidenav -->
  <?php include("sidenav.php"); ?>
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->

    <!-- Header -->

    <?php
      $fotos = get_galeria();
    ?>

    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">GALERIA DE IMAGENES</h3>
                </div>

                  <div class="tz-gallery">
                    <?php
                      foreach($fotos as $fot){
                    ?>  
                        <div class="col-sm-6 col-md-4">
                          <div class="thumbnail">
                              <a class="lightbox" href="imagenes/<?php echo $fot['nombre'] ?>">
                                  <img src="imagenes/<?php echo $fot['nombre'] ?>">
                              </a>
                              <div class="caption">
                                  <h3><?php echo $fot['fecha'] ?></h3>
                                  <div class="fb-share-button" data-href="https://turquesa.realdev.cl/Clientes/Galerias/imagenes/<?php echo $fot['nombre'] ?>" data-layout="button" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https://turquesa.realdev.cl/Clientes/Galerias/imagenes/<?php echo $fot['nombre'] ?>&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Compartir</a></div>
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
                      <a href="../../qrclientes.php?qrcli&Mesa=<?php echo $_GET['Mesa'] ?>"><button type="button" class="btn btn-danger btn-block my-4">Volver</button></a>
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

  <script src="../../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="../../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../../assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../../assets/js/argon.js?v=1.0.0"></script>


</body>

</html> 
