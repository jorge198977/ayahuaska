<!DOCTYPE html>
<html lang="en">
  <?php 
    include("head.php");
    include("../../intranet/funciones/controlador.php");

   ?>
  <body data-spy="scroll" data-target="#ftco-navbar" data-offset="200">


    
    <nav class="navbar navbar-vertical navbar-light bg-white" id="sidenav-main">
      <div class="container">
        <div class="row">
          <div class="col">
            ​<picture>
              <source srcset="..." type="image/svg+xml+jpg">
              <img src="images/logo.png" class="img-fluid img-thumbnail" alt="...">
            </picture>
            
          </div>
        </div>
      </div>
    </nav>
    <!-- END nav -->



    


    <section class="ftco-section" id="section-menu">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center mb-5 ftco-animate">
            <h2 class="display-4">CARTA</h2>
            <div class="row justify-content-center">
              <div class="col-md-7">
                <p class="lead">Nuestra carta.</p>
              </div>
            </div>
          </div>

          <div class="col-md-12 text-center">
            <ul class="nav ftco-tab-nav nav-pills mb-5" id="pills-tab" role="tablist">
              <?php
                $categorias = get_all_categorias();
                //echo "Buenos días, hoy es ".date("l");
                foreach ($categorias as $key => $categoria) {
              ?>
                <li class="nav-item ftco-animate">
                  <a class="nav-link" id="pills-<?php echo $categoria['id'] ?>-tab" data-toggle="pill" href="#pills-<?php echo $categoria['id'] ?>" role="tab" aria-controls="pills-<?php echo $categoria['id'] ?>" aria-selected="true"><strong><?php echo $categoria['nombre'] ?></strong></a>
                </li>
              <?php
                }
              ?>
            </ul>


            <div class="tab-content text-left">
              <?php
                foreach ($categorias as $key => $categoria) {
                  $preparados = get_preparados_categoria($categoria['id']);
              ?>
                <div class="tab-pane fade" id="pills-<?php echo $categoria['id'] ?>" role="tabpanel" aria-labelledby="pills-<?php echo $categoria['id'] ?>-tab">
                  <div class="row">
                    <?php
                      foreach ($preparados as $key => $preparado) {
                    ?>  
                          <div class="col-md-6 ftco-animate">
                            <div class="media menu-item">
                              <img class="mr-3" src="images/turquesa.jpg" class="img-fluid">
                              <div class="media-body">
                                <h5 class="mt-0"><?php echo $preparado['nombre'] ?></h5>
                                <p></p>
                                <h6 class="text-primary menu-price">$<?php echo number_format($preparado['precio'], 0, ',', '.') ?></h6>
                              </div>
                            </div>
                          </div>
                    <?php
                      }
                    ?>
                  </div>
                </div>
              <?php
              }
              ?>
            </div>



           
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->







    <!-- END section -->
    

    <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row ftco-animate">
          <div class="col-md text-left">
            <p>&copy; Derechos a  <span class="icon-heart text-danger"></span>  por <a href="https://realdev.cl/">REALDEV</a></p>
          </div>
        </div>
      </div>
    </footer>

    
    



    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>

    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/jquery.timepicker.min.js"></script>
    
    <script src="js/jquery.animateNumber.min.js"></script>
    

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="js/google-map.js"></script>

    <script src="js/main.js"></script>

    
  </body>
</html>