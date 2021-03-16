<?php session_start();   ?>
<!DOCTYPE html>
<html>

<?php 
  include("header.php"); 
  include("../intranet/funciones/controlador.php");
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
      $mesa = $_GET['Mesa'];
      $familias_karaokes = get_all_familias_karaokes();
      $mesa_id = get_mesa_by_num($mesa);
    ?>



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">CATEGORIAS KARAOKE</h3>
                </div>

                     <div class="table-responsive">
                      <table id="example1" class="table table-flush">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">VER</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            foreach ($familias_karaokes as $key => $familia_karaoke) {
                          ?>   
                            <tr class="active">
                              <th><?php echo $familia_karaoke['nombre'] ?></th>
                              <th>
      
                                <a href="pedir_karaoke.php?id=<?php echo $familia_karaoke['id'] ?>&mesa_id=<?php echo $mesa_id ?>&Mesa=<?php echo $mesa ?>">
                                  <button type="button" class="btn btn-default" aria-label="Left Align">
                                  <span class="fas fa-search-location" aria-hidden="true"></span>
                                  </button>
                                </a>
                              </th> 
                            </tr>
                          <?php
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>

                    <div class="container">
                      <div class="row">
                        <div class="col">
                          <a href="../qrclientes.php?qrcli&Mesa=<?php echo $_GET['Mesa'] ?>"><button type="button" class="btn btn-danger btn-block my-4">Volver</button></a>
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
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.0.0"></script>

  <script src="../intranet/plugins/datatables/jquery.dataTables.min.js"></script>

  <!-- page script -->
  <script>
    $(function () {
       $("#example1").DataTable();

    });
  </script>


</body>

</html>