<?php 
session_start();   
include("intranet/funciones/seguridad.php");
  if(!validaringreso())
    header('Location:index.php?NOCINICIA');
?>
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

            <?php if(($_SESSION['tipo'] == 1) or ($_SESSION['tipo'] == 2) or ($_SESSION['tipo'] == 3) or ($_SESSION['tipo'] == 5) or ($_SESSION['tipo'] == 6) or ($_SESSION['tipo'] == 9) or ($_SESSION['tipo'] == 4) or ($_SESSION['tipo'] == 10)){ ?>

              <div class="col-xl-3 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                  <a <?php if(($_SESSION['tipo'] == 1) or ($_SESSION['tipo'] == 2) or ($_SESSION['tipo'] == 3) or ($_SESSION['tipo'] == 5) or ($_SESSION['tipo'] == 6) or ($_SESSION['tipo'] == 9)or ($_SESSION['tipo'] == 4) or ($_SESSION['tipo'] == 10)){ ?>
                    href="mantenedores.php" <?php  } else{ ?> href="#" <?php } ?> >
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <h3 class="card-title text-uppercase text-muted mb-0">MANTENER / ORGANIZAR</h3>
                          <span class="h2 font-weight-bold mb-0"></span>
                        </div>
                        <div class="col-auto">
                          <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                            <i class="fas fa-chalkboard"></i>
                          </div>
                        </div>
                      </div>
                      <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                        <span class="text-nowrap">Ingresa a Poblar tú Sistema</span>
                      </p>
                    </div>
                  </a>
                </div>
              </div>

            <?php } ?> 
            <?php if(($_SESSION['tipo'] == 5) || ($_SESSION['tipo'] != 9)){ ?>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <a href="Pedidos/index.php">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h3 class="card-title text-uppercase text-muted mb-0">GENERA PEDIDO</h3>
                        <span class="h2 font-weight-bold mb-0"></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                          <i class="fas fa-edit"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> </span>
                      <span class="text-nowrap">Genera un nuevo pedido</span>
                    </p>
                  </div>
                </a>
              </div>
            </div>
            <?php } ?> 
            <?php if(($_SESSION['tipo'] == 1) or ($_SESSION['tipo'] == 2) or ($_SESSION['tipo'] == 4) or ($_SESSION['tipo'] == 7) or ($_SESSION['tipo'] == 8)){ ?>

              <div class="col-xl-3 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                  <a <?php if(($_SESSION['tipo'] == 1) or ($_SESSION['tipo'] == 2)  or ($_SESSION['tipo'] == 4) or ($_SESSION['tipo'] == 7) or ($_SESSION['tipo'] == 8)){ ?>
                    href="Cierres/ver_cierre.php" <?php  } else{ ?> href="#" <?php } ?> >
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <h3 class="card-title text-uppercase text-muted mb-0"> CIERRE DE CAJA</h3>
                          <span class="h2 font-weight-bold mb-0"></span>
                        </div>
                        <div class="col-auto">
                          <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                            <i class="far fa-hand-point-up"></i>
                          </div>
                        </div>
                      </div>
                      <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i></span>
                        <span class="text-nowrap">Realiza el cierre de jornada</span>
                      </p>
                    </div>
                  </a>
                </div>
              </div>
            <?php } ?> 
            
            <?php if(($_SESSION['tipo'] == 1) or ($_SESSION['tipo'] == 2)){ ?>

              <div class="col-xl-3 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                  <a <?php if(($_SESSION['tipo'] == 1) or ($_SESSION['tipo'] == 2)){ ?>
                    href="Compras/index.php" <?php  } else{ ?> href="#" <?php } ?> >
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <h3 class="card-title text-uppercase text-muted mb-0">REALIZAR COMPRAS</h3>
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
                        <span class="text-nowrap">Ingresa tus nuevas compras</span>
                      </p>
                    </div>
                  </a>
                </div>
              </div>
            <?php } ?> 
            <?php if(($_SESSION['tipo'] == 1) or ($_SESSION['tipo'] == 2)){ ?>

              <div class="col-xl-3 col-lg-6">
                <br>
                <div class="card card-stats mb-4 mb-xl-0">
                   <a <?php if(($_SESSION['tipo'] == 1) or ($_SESSION['tipo'] == 2)){ ?>
                    href="Reportes/index.php" <?php  } else{ ?> href="#" <?php } ?> >
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <h3 class="card-title text-uppercase text-muted mb-0">GENERAR REPORTES</h3>
                          <span class="h2 font-weight-bold mb-0"></span>
                        </div>
                        <div class="col-auto">
                          <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                            <i class="fas fa-chart-pie"></i>
                          </div>
                        </div>
                      </div>
                      <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i></span>
                        <span class="text-nowrap">Estado de tu negocio</span>
                      </p>
                    </div>
                  </a>
                </div>
              </div>
            <?php } ?> 

             <?php if(($_SESSION['tipo'] == 9) or ($_SESSION['tipo'] == 1) or ($_SESSION['tipo'] == 3)){ ?>

              <div class="col-xl-3 col-lg-6">
                <br>
                <div class="card card-stats mb-4 mb-xl-0">
                   <a <?php if(($_SESSION['tipo'] == 9) or ($_SESSION['tipo'] == 1)){ ?>
                    href="Pedidos/orden2.php" <?php  } else{ ?> href="#" <?php } ?> >
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <h3 class="card-title text-uppercase text-muted mb-0">RECEPCION</h3>
                          <span class="h2 font-weight-bold mb-0"></span>
                        </div>
                        <div class="col-auto">
                          <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                            <i class="fas fa-edit"></i>
                          </div>
                        </div>
                      </div>
                      <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-info mr-2"><i class="fas fa-arrow-up"></i></span>
                        <span class="text-nowrap">Estado de las mesas</span>
                      </p>
                    </div>
                  </a>
                </div>
              </div>
            <?php } ?> 

            <!-- <?php if(($_SESSION['tipo'] == 1) or ($_SESSION['tipo'] == 2)or ($_SESSION['tipo'] == 5)){ ?>
            <div class="col-xl-3 col-lg-6">
              <br>
              <div class="card card-stats mb-4 mb-xl-0">
                <a href="Mantenedores/Djs/index.php">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h3 class="card-title text-uppercase text-muted mb-0">DJS - SOLICITA KARAOKES</h3>
                        <span class="h2 font-weight-bold mb-0"></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                          <i class="fas fa-calendar-alt"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <span class="text-success mr-2"><i class="fas fa-arrow-up"></i></span>
                      <span class="text-nowrap">Gestiona canciones</span>
                    </p>
                  </div>
                </a>
              </div>
            </div>
            <?php } ?>  -->
            <div class="col-xl-3 col-lg-6">
              <br>
              <div class="card card-stats mb-4 mb-xl-0">
                <a href="cerrar_sesion.php">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h3 class="card-title text-uppercase text-muted mb-0">CERRAR SISTEMA</h3>
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