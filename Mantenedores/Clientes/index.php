<?php session_start();   ?>
<!DOCTYPE html>
<html>

<?php include("header.php"); ?>

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
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <a href="clientes.php">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h1 class="card-title text-uppercase text-muted mb-0">CLIENTES</h1>
                        <span class="h2 font-weight-bold mb-0"></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                          <i class="fas fa-user"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <span class="text-success mr-2"><i class="fas fa-arrow-up"></i></span>
                      <span class="text-nowrap">Visualiza listado</span>
                    </p>
                  </div>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <a href="ver_abonos.php">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h1 class="card-title text-uppercase text-muted mb-0">VER ABONOS</h1>
                        <span class="h2 font-weight-bold mb-0"></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                          <i class="far fa-eye"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <span class="text-success mr-2"><i class="fas fa-arrow-up"></i></span>
                      <span class="text-nowrap">Revisa abonos realizados</span>
                    </p>
                  </div>
                </a>
              </div>
            </div>
            
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <a href="ver_deudores.php">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h1 class="card-title text-uppercase text-muted mb-0">DEUDORES</h1>
                        <span class="h2 font-weight-bold mb-0"></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                          <i class="fas fa-money-check-alt"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> </span>
                      <span class="text-nowrap">Ver listado de deudores</span>
                    </p>
                  </div>
                </a>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <a href="../../mantenedores.php">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h1 class="card-title text-uppercase text-muted mb-0">VOLVER</h1>
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
  <script src="../../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="../../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../../assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../../assets/js/argon.js?v=1.0.0"></script>
</body>

<script src="../../js/bootbox.min.js"></script>
<?php 
    if(isset($_GET['Ingresando'])){
  ?>
    <script type="text/javascript">
      bootbox.alert("Abono ingresado correctamente!");
    </script>
  <?php
    }
?>

</html>