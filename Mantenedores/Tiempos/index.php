<?php session_start();   ?>
<!DOCTYPE html>
<html>

<?php 
  include("header.php"); 
  include("../../intranet/funciones/controlador.php");
?>

<body>
  <!-- Sidenav -->
  <?php include("sidenav.php"); ?>
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <?php include("top_nav.php"); ?>
    <!-- Header -->

    <?php
      $tiempo_happy = get_hora_happy();
    ?>



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">Tiempo de Happy - <?php echo "Hora Happy actual: Desde " .$tiempo_happy['horainicialhappy']. " hasta ".$tiempo_happy['horafinalhappy'];?></h3>
                </div>

                <form method="post" action="../../intranet/funciones/procesamoderador2.php" method="post">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="time" placeholder="Success" class="form-control is-valid"  name="horainicial" value="<?php echo $tiempo_happy['horainicialhappy'] ?>" required />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="time" placeholder="Success" class="form-control is-valid"  name="horafinal" value="<?php echo $tiempo_happy['horafinalhappy'] ?>" required />
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <button type="sumbit" name="btntiempohappy" class="btn btn-primary btn-lg btn-block">Actualizar</button>
                      </div>
                    </div>
                  </div>
                </form>


                <div class="container">
                  <div class="row">
                    <div class="col">
                      <a href="../../mantenedores.php"><button type="button" class="btn btn-danger btn-block my-4">Volver</button></a>
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
    if(isset($_GET['Actualizado'])){
  ?>
    <script type="text/javascript">
      bootbox.alert("Tiempo Happy actualizado!");
    </script>
  <?php
    }
  ?>

</html>