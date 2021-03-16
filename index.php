<!DOCTYPE html>
<html>

<?php include("header.php"); ?>

<body class="bg-default">
  <div class="main-content">
    <!-- Navbar -->
    <?php include("nav_login.php") ?>
    
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
              <br><br><br><br>
              <h1 class="text-white">Bienvenidos!</h1>
              <p class="text-lead text-light"><h5 class="text-white">Ingrese su usuario y contraseña para acceder a </h5> <br><b>REALDEV</b><br><b><h2 class="text-white">AYAHUASKA</h2></b></p>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">
            <div class="card-header bg-transparent pb-5">
              
        
            </div>
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <small>Conéctese con su nombre de usuario y contraseña</small>
              </div>
              <form role="form" name="frminicia" action="intranet/funciones/procesainicia.php" method="post" class="login-form">
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                    </div>
                    <input class="form-control" name="usuario" placeholder="Usuario" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" name="clave" placeholder="Password" type="password">
                  </div>
                </div>
                <!-- <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <select class="form-control input-lg" name="turno" required>
                        <option value=""> Seleccione turno </option>
                        <option value="1"> Turno 1 </option>
                        <option value="2"> Turno 2 </option>
                    </select>
                  </div>
                </div> -->
                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4">Ingresa</button>
                </div>
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
              <!-- <a href="#" class="text-light"><small>Olvidaste tu contraseña?</small></a> -->
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Argon JS -->
  <script src="assets/js/argon.js?v=1.0.0"></script>
</body>

<script src="js/bootbox.min.js"></script>
<?php 
    if(isset($_GET['NOCINICIA'])){
  ?>
    <script type="text/javascript">
      bootbox.alert("Sesión de usuario ha expirado!");
    </script>
  <?php
    }
  ?>

</html>