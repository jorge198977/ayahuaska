<?php
   session_start(); 
   include("manejo_folios.php");
   include("../intranet/funciones/controlador.php");
 //   error_reporting(E_ALL);
 // ini_set('display_errors', '1');
?>
<!DOCTYPE html>
<html>

<?php 
  include("head.php");
?>

<body>
  <!-- Sidenav -->
  <?php include("nav_back.php") ?>
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" >Consulta FOLIOS DISP</a>
        <!-- User -->
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">

          <div class="card card-stats mb-4 mb-lg-0 ma10">
             <div class="card-body">
                <div class="row">
                   <div class="col">
                      <form action="folios_disponibles.php" method="post">
                         <h6 class="heading-small text-muted mb-4">Ingrese datos</h6>
                         <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-12">
                                  <div class="form-group">
                                     <input type="submit" name="btnconsultafolio" class="btn btn-success btn-lg btn-block" value="Consultar">
                                  </div>
                                </div>
                            </div>
                         </div>
                      </form>
                   </div>
                </div>

             </div>
          </div>

          <?php
            if(isset($_POST['btnconsultafolio'])){
              $folios = get_folios_disponibles('76988196-4');
          ?>

          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-12 col-lg-12">
              <div class="card card-stats mb-12 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                        
                        <div class="row">
                            <div class="col-md-12">  
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <strong>FOLIOS</strong>
                                    </div>
                                    <div class="panel-body">
			                            <?php
			                            	$cant = 0;
			                                foreach ($folios as $key => $folio) {
			                                    $cant++;
			                            ?>	
			                            	<span class="badge badge-default"><?php echo $folio; ?></span>
			                               
			                            <?php        
			                                }
			                            ?>
			                            <br>
			                            <br>
			                             <strong>CANTIDAD DE FOLIOS: <?php echo $cant; ?></strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>                
                  </div>
              </div>
            </div>
          </div>
        </div>
    <?php
      
    }
    ?>
    <!-- Page content -->
    <div class="container-fluid mt--7">

    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->



</body>

</html>