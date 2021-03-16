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

            <?php if(($_SESSION['tipo'] == 1) or ($_SESSION['tipo'] == 2) or ($_SESSION['tipo'] == 10)){ ?>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <a href="Mantenedores/Proveedores/index.php">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h3 class="card-title text-uppercase text-muted mb-0">PROVEEDOR</h3>
                        <span class="h2 font-weight-bold mb-0"></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                          <i class="fas fa-address-card"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                      <span class="text-nowrap">Administra tus proveedores</span>
                    </p>
                  </div>
                </a>
              </div>
            </div>
            <?php } ?>
            <?php if(($_SESSION['tipo'] == 1) or ($_SESSION['tipo'] == 2)){ ?>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <a href="Mantenedores/OC/index.php">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h3 class="card-title text-uppercase text-muted mb-0">OC</h3>
                        <span class="h2 font-weight-bold mb-0"></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                          <i class="fas fa-cart-plus"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> </span>
                      <span class="text-nowrap">Visualiza tus OC</span>
                    </p>
                  </div>
                </a>
              </div>
            </div>
            <?php } ?>
            <!-- <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <a href="Mantenedores/Clientes/index.php">
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
                      <span class="text-nowrap">Mantenedor de Clientes</span>
                    </p>
                  </div>
                </a>
              </div>
            </div> -->
            <?php if(($_SESSION['tipo'] == 1) or ($_SESSION['tipo'] == 2) or ($_SESSION['tipo'] == 6) or ($_SESSION['tipo'] == 10)){ ?>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <a href="Mantenedores/Stocks/index.php">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h3 class="card-title text-uppercase text-muted mb-0">STOCKS</h3>
                        <span class="h2 font-weight-bold mb-0"></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                          <i class="fas fa-user-edit"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> </span>
                      <span class="text-nowrap">Revisa tú stock</span>
                    </p>
                  </div>
                </a>
              </div>
            </div>
            <?php } ?>
            <?php if(($_SESSION['tipo'] == 1) or ($_SESSION['tipo'] == 2) or ($_SESSION['tipo'] == 3) or ($_SESSION['tipo'] == 4) or ($_SESSION['tipo'] == 9) or ($_SESSION['tipo'] == 6)){ ?>
            <div class="col-xl-3 col-lg-6">
             
              <div class="card card-stats mb-4 mb-xl-0">
                <a href="Mantenedores/Socios/index.php">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h3 class="card-title text-uppercase text-muted mb-0">CLIENTES</h3>
                        <span class="h2 font-weight-bold mb-0"></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                          <i class="fas fa-user"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <span class="text-success mr-2"><i class="fas fa-arrow-up"></i></span>
                      <span class="text-nowrap">Mantenedor de Clientes</span>
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
                <a href="Mantenedores/Usuarios/index.php">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h3 class="card-title text-uppercase text-muted mb-0">USUARIOS</h3>
                        <span class="h2 font-weight-bold mb-0"></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                          <i class="fas fa-user"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <span class="text-success mr-2"><i class="fas fa-arrow-up"></i></span>
                      <span class="text-nowrap">Mantenedor de Usuarios</span>
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
                <a href="Mantenedores/Familias/index.php">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h3 class="card-title text-uppercase text-muted mb-0">FAMILIAS</h3>
                        <span class="h2 font-weight-bold mb-0"></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                          <i class="fas fa-stream"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> </span>
                      <span class="text-nowrap">Mantenedor de Familias</span>
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
                <a href="Mantenedores/Ccs/index.php">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h3 class="card-title text-uppercase text-muted mb-0">CCS</h3>
                        <span class="h2 font-weight-bold mb-0"></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                          <i class="fas fa-stream"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> </span>
                      <span class="text-nowrap">Mantenedor de CCS</span>
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
                <a href="Mantenedores/Productos/index.php">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h3 class="card-title text-uppercase text-muted mb-0">PRODUCTOS</h3>
                        <span class="h2 font-weight-bold mb-0"></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                          <i class="fas fa-cart-plus"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <span class="text-success mr-2"><i class="fas fa-arrow-up"></i></span>
                      <span class="text-nowrap">Administra tus productos</span>
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
                <a href="Mantenedores/Pie/index.php">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h3 class="card-title text-uppercase text-muted mb-0">PIE PAGINA</h3>
                        <span class="h2 font-weight-bold mb-0"></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                          <i class="fas fa-file-alt "></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <span class="text-success mr-2"><i class="fas fa-arrow-up"></i></span>
                      <span class="text-nowrap">Modifica Pie de Página</span>
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
                <a href="Mantenedores/Eventos/index.php">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h3 class="card-title text-uppercase text-muted mb-0">EVENTOS</h3>
                        <span class="h2 font-weight-bold mb-0"></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                          <i class="fas fa-calendar-alt"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <span class="text-success mr-2"><i class="fas fa-arrow-up"></i></span>
                      <span class="text-nowrap">Gestiona tús eventos</span>
                    </p>
                  </div>
                </a>
              </div>
            </div>
            <?php } ?>
            <!-- <?php if(($_SESSION['tipo'] == 1) or ($_SESSION['tipo'] == 2) or ($_SESSION['tipo'] == 5)){ ?>
            <div class="col-xl-3 col-lg-6">
              <br>
              <div class="card card-stats mb-4 mb-xl-0">
                <a href="Mantenedores/Karaokes/index.php">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h3 class="card-title text-uppercase text-muted mb-0">KARAOKES</h3>
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
                      <span class="text-nowrap">Gestiona tús karaokes</span>
                    </p>
                  </div>
                </a>
              </div>
            </div>
            <?php } ?> -->
            <?php if(($_SESSION['tipo'] == 1) or ($_SESSION['tipo'] == 2)){ ?>
            <div class="col-xl-3 col-lg-6">
              <br>
              <div class="card card-stats mb-4 mb-xl-0">
                <a href="Mantenedores/Galerias/index.php">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h3 class="card-title text-uppercase text-muted mb-0">GALERIAS</h3>
                        <span class="h2 font-weight-bold mb-0"></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                          <i class="fas fa-camera-retro"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <span class="text-success mr-2"><i class="fas fa-arrow-up"></i></span>
                      <span class="text-nowrap">Gestiona tú galería</span>
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
                <a href="Mantenedores/Boletas/index.php">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h3 class="card-title text-uppercase text-muted mb-0">SII</h3>
                        <span class="h2 font-weight-bold mb-0"></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                          <i class="fas fa-edit"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <span class="text-success mr-2"><i class="fas fa-arrow-up"></i></span>
                      <span class="text-nowrap">Boletas electrónicas</span>
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
                <a href="Mantenedores/Tiempos/index.php">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h3 class="card-title text-uppercase text-muted mb-0">TIEMPOS</h3>
                        <span class="h2 font-weight-bold mb-0"></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                          <i class="fas fa-clock"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <span class="text-success mr-2"><i class="fas fa-arrow-up"></i></span>
                      <span class="text-nowrap">Administra tiempos</span>
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
                <a href="Mantenedores/Costos/index.php">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h3 class="card-title text-uppercase text-muted mb-0">COSTOS</h3>
                        <span class="h2 font-weight-bold mb-0"></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                          <i class="fas fa-money-bill-wave-alt"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <span class="text-success mr-2"><i class="fas fa-arrow-up"></i></span>
                      <span class="text-nowrap">Administra tus costos</span>
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
                <a href="Mantenedores/Descuentos/index.php">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h3 class="card-title text-uppercase text-muted mb-0">DESCUENTOS</h3>
                        <span class="h2 font-weight-bold mb-0"></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                          <i class="fas fa-caret-square-down"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <span class="text-success mr-2"><i class="fas fa-arrow-up"></i></span>
                      <span class="text-nowrap">Aplica descuentos</span>
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
                <a href="Mantenedores/Descuentos_especiales/index.php">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h3 class="card-title text-uppercase text-muted mb-0">DESCU ESPEC</h3>
                        <span class="h2 font-weight-bold mb-0"></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                          <i class="fas fa-caret-square-down"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <span class="text-success mr-2"><i class="fas fa-arrow-up"></i></span>
                      <span class="text-nowrap">Aplica descuentos especiales</span>
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
                <a href="Mantenedores/Mesas/index.php">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h3 class="card-title text-uppercase text-muted mb-0">MESAS</h3>
                        <span class="h2 font-weight-bold mb-0"></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                          <i class="fas fa-align-justify"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <span class="text-success mr-2"><i class="fas fa-arrow-up"></i></span>
                      <span class="text-nowrap">Administra tus mesas</span>
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
                <a href="Mantenedores/Movimientos/index.php">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h3 class="card-title text-uppercase text-muted mb-0">MOVIMIENT</h3>
                        <span class="h2 font-weight-bold mb-0"></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                          <i class="fas fa-file-alt"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <span class="text-success mr-2"><i class="fas fa-arrow-up"></i></span>
                      <span class="text-nowrap">Ver Movimientos</span>
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
                <a href="Mantenedores/Eliminar_pedidos/index.php">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h3 class="card-title text-uppercase text-muted mb-0">ELIMINAR</h3>
                        <span class="h2 font-weight-bold mb-0"></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                          <i class="far fa-trash-alt"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <span class="text-success mr-2"><i class="fas fa-arrow-up"></i></span>
                      <span class="text-nowrap">Elimina Pedido</span>
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
                <a href="Mantenedores/Mercaderias/index.php">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h3 class="card-title text-uppercase text-muted mb-0">MERCADERIA</h3>
                        <span class="h2 font-weight-bold mb-0"></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                          <i class="fas fa-dolly-flatbed"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <span class="text-success mr-2"><i class="fas fa-arrow-up"></i></span>
                      <span class="text-nowrap">Ver Mercadería</span>
                    </p>
                  </div>
                </a>
              </div>
            </div>
            <?php } ?>
            

            <?php if(($_SESSION['tipo'] == 1) or ($_SESSION['tipo'] == 2) or ($_SESSION['tipo'] == 4)){ ?>
             <div class="col-xl-3 col-lg-6">
              <br>
              <div class="card card-stats mb-4 mb-xl-0">
                <a href="Mantenedores/Egresos/index.php">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h2 class="card-title text-uppercase text-muted mb-0">EGRESOS</h2>
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
                      <span class="text-nowrap">Gestiona egresos</span>
                    </p>
                  </div>
                </a>
              </div>
            </div> 
            <?php } ?>


            <div class="col-xl-3 col-lg-6">
              <br>
              <div class="card card-stats mb-4 mb-xl-0">
                <a href="inicio.php">
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
  <script src="./assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="./assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="./assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="./assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="./assets/js/argon.js?v=1.0.0"></script>
</body>

</html>