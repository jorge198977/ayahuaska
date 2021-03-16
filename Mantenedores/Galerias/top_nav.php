<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
  <div class="container-fluid">
    <!-- Brand -->
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Inicio</a>
    <!-- Form -->
    
    <!-- User -->
    <ul class="navbar-nav align-items-center d-none d-md-flex">
      <li class="nav-item dropdown">
        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="media align-items-center">
            <span class="avatar avatar-sm rounded-circle">
              <img alt="Image placeholder" src="../../assets/img/brand/favicon.png">
            </span>
            <div class="media-body ml-2 d-none d-lg-block">
              <span class="mb-0 text-sm  font-weight-bold"><?php echo $_SESSION['nombre']." ".$_SESSION['apellido'] ?></span>
            </div>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
          <div class=" dropdown-header noti-title">
            <h6 class="text-overflow m-0">Bienvenido!</h6>
          </div>
          <div class="dropdown-divider"></div>
          <a href="../../cerrar_sesion.php" class="dropdown-item">
            <i class="ni ni-user-run"></i>
            <span>SALIR</span>
          </a>
        </div>
      </li>
    </ul>
  </div>
</nav>