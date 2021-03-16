<?php 
session_start();   
include("../intranet/funciones/seguridad.php");
  if(!validaringreso())
    header('Location:../index.php?NOCINICIA');
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
            <?php if(($_SESSION['tipo'] == 5) || ($_SESSION['tipo'] == 1) || ($_SESSION['tipo'] == 2) || ($_SESSION['tipo'] == 3)|| ($_SESSION['tipo'] == 4)|| ($_SESSION['tipo'] == 7) || ($_SESSION['tipo'] == 6) || ($_SESSION['tipo'] == 10)){ ?>
              <div class="col-xl-3 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                  <a href="ver_pedido.php">
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <h3 class="card-title text-uppercase text-muted mb-0">VER PEDIDO</h3>
                          <span class="h2 font-weight-bold mb-0"></span>
                        </div>
                        <div class="col-auto">
                          <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                            <i class="far fa-eye"></i>
                          </div>
                        </div>
                      </div>
                      <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                        <span class="text-nowrap">Visualiza tus pedidos</span>
                      </p>
                    </div>
                  </a>
                </div>
              </div>
            <?php } ?>
            <?php if(($_SESSION['tipo'] == 5) || ($_SESSION['tipo'] == 1) || ($_SESSION['tipo'] == 2) || ($_SESSION['tipo'] == 3) || ($_SESSION['tipo'] == 4) || ($_SESSION['tipo'] == 6) || ($_SESSION['tipo'] == 10)){ ?>
              <div class="col-xl-3 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                  <a href="orden.php">
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <h3 class="card-title text-uppercase text-muted mb-0">NUEVO</h3>
                          <span class="h2 font-weight-bold mb-0"></span>
                        </div>
                        <div class="col-auto">
                          <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                            <i class="fas fa-edit"></i>
                          </div>
                        </div>
                      </div>
                      <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-warning mr-2"><i class=""></i> </span>
                        <span class="text-nowrap">Genera un nuevo Pedido</span>
                      </p>
                    </div>
                  </a>
                </div>
              </div>
            <?php } ?>

            <!-- VENTA DE CAJERO -->
            <!-- <?php if(($_SESSION['tipo'] == 8) ||($_SESSION['tipo'] == 4) || ($_SESSION['tipo'] == 1) || ($_SESSION['tipo'] == 2) ){ ?>
              <div class="col-xl-3 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                  <a href="../intranet/funciones/procesapedido2.php?venta_directa=0">
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <h3 class="card-title text-uppercase text-muted mb-0">VENTA</h3>
                          <span class="h2 font-weight-bold mb-0"></span>
                        </div>
                        <div class="col-auto">
                          <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                            <i class="fas fa-money-bill"></i>
                          </div>
                        </div>
                      </div>
                      <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-warning mr-2"><i class=""></i> </span>
                        <span class="text-nowrap">Venta Directa</span>
                      </p>
                    </div>
                  </a>
                </div>
              </div>
            <?php } ?> -->


            <!-- <?php if(($_SESSION['tipo'] == 7) || ($_SESSION['tipo'] == 1) || ($_SESSION['tipo'] == 2)){ ?>
              <div class="col-xl-3 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                  <a href="../intranet/funciones/procesapedido2.php?venta_entrada=0">
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <h3 class="card-title text-uppercase text-muted mb-0">ENTRADAS</h3>
                          <span class="h2 font-weight-bold mb-0"></span>
                        </div>
                        <div class="col-auto">
                          <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                            <i class="fas fa-money-bill"></i>
                          </div>
                        </div>
                      </div>
                      <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-warning mr-2"><i class=""></i> </span>
                        <span class="text-nowrap">Venta de entradas</span>
                      </p>
                    </div>
                  </a>
                </div>
              </div>
            <?php } ?> -->
            <!-- <?php if( ($_SESSION['tipo'] == 1) || ($_SESSION['tipo'] == 2) || ($_SESSION['tipo'] == 6)){ ?>
              <div class="col-xl-3 col-lg-6">
                <br>
                <div class="card card-stats mb-4 mb-xl-0">
                  <a href="leer_cod_barra.php">
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <h3 class="card-title text-uppercase text-muted mb-0">COD BARRA</h3>
                          <span class="h2 font-weight-bold mb-0"></span>
                        </div>
                        <div class="col-auto">
                          <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                            <i class="fas fa-stream"></i>
                          </div>
                        </div>
                      </div>
                      <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-warning mr-2"><i class=""></i> </span>
                        <span class="text-nowrap">Leer Código de barra</span>
                      </p>
                    </div>
                  </a>
                </div>
              </div>
            <?php } ?> -->
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <a href="../inicio.php">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h3 class="card-title text-uppercase text-muted mb-0">VOLVER</h3>
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
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.0.0"></script>
</body>

<script src="../js/bootbox.min.js"></script>
<?php 
    if(isset($_GET['generado'])){
  ?>
    <script type="text/javascript">
      bootbox.alert("Pedido generado correctamente!");
    </script>
  <?php
    }
    if(isset($_GET['Venta_entrada_realizada'])){
  ?>
    <script type="text/javascript">
      bootbox.alert("Venta de entrada generada!");
    </script>
  <?php
    }
    if(isset($_GET['Venta_realizada'])){
  ?>
    <script type="text/javascript">
      bootbox.alert("Venta generada!");
    </script>
  <?php
    }
  ?>
</html>