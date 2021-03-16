<?php session_start();   ?>
<!DOCTYPE html>
<html>

<?php 
  include("header.php"); 
  include("../../intranet/funciones/controlador.php");
  $tipos_descuentos = get_tipos_descuentos();
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
          <!-- Card stats -->
          <div class="row">
            
            <?php foreach ($tipos_descuentos as $key => $tipo_descuento) { 

              if(($_SESSION['tipo'] != 6)){
            ?>
              <div class="col-xl-3 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                  <a href="stock.php?tipo_descuento=<?php echo $tipo_descuento['id'] ?>">
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <h3 class="card-title text-uppercase text-muted mb-0">CONTROL DE STOCK</h3>
                          <span class="h2 font-weight-bold mb-0"></span>
                        </div>
                        <div class="col-auto">
                          <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                            <i class="fas fa-chalkboard-teacher"></i>
                          </div>
                        </div>
                      </div>
                      <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i></span>
                        <span class="text-nowrap">STOCK <?php echo $tipo_descuento['nombre'] ?></span>
                      </p>
                    </div>
                  </a>
                </div>
              </div>
            <?php }} ?>

             <?php foreach ($tipos_descuentos as $key => $tipo_descuento) { 

              if((($tipo_descuento['id'] == 1) || ($tipo_descuento['id'] == 2)) && ($_SESSION['tipo'] == 6)){
            ?>
              <div class="col-xl-3 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                  <a href="stock.php?tipo_descuento=<?php echo $tipo_descuento['id'] ?>">
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <h3 class="card-title text-uppercase text-muted mb-0">CONTROL DE STOCK</h3>
                          <span class="h2 font-weight-bold mb-0"></span>
                        </div>
                        <div class="col-auto">
                          <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                            <i class="fas fa-chalkboard-teacher"></i>
                          </div>
                        </div>
                      </div>
                      <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i></span>
                        <span class="text-nowrap">STOCK <?php echo $tipo_descuento['nombre'] ?></span>
                      </p>
                    </div>
                  </a>
                </div>
              </div>
            <?php }} ?>

            


            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <a href="../../mantenedores.php">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h3 class="card-title text-uppercase text-muted mb-0">VOLVER ATRAS</h3>
                        <span class="h2 font-weight-bold mb-0"></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                          <i class="fas fa-arrow-alt-circle-left"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <span class="text-success mr-2"><i class=""></i></span>
                      <span class="text-nowrap"></span>
                    </p>
                  </div>
                </a>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="./assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="./assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="./assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="./assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="./assets/js/argon.js?v=1.0.0"></script>
</body>

</html>