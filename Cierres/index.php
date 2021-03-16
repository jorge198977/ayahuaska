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
      $mesas = get_all_mesas();
      $existe_ocupada = false;
    ?>



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">CIERRE DE CAJA</h3>
                </div>

                     <div class="table-responsive">
                      <table id="example1" class="table table-flush">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">MESA</th>
                            <th scope="col">UBICACION</th>
                            <th scope="col">ESTADO</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            foreach ($mesas as $key => $mesa) {
                          ?>   
                            <tr <?php if($mesa['estado'] == 1){ $existe_ocupada = true; ?> class="warning" <?php } else{ ?> class="success" <?php } ?>>
                                <td><?php echo $mesa['num'] ?></td>
                                <td><?php echo $mesa['ubicacion'] ?></td>
                                <td class="status"><?php 
                                if($mesa['estado'] == 0){
                                ?>
                                  <span class="badge badge-dot mr-4">
                                    <i class="bg-success"></i> DISPONIBLE
                                  </span>
                                <?php
                                } 
                                else{
                                ?>
                                  <span class="badge badge-dot mr-4">
                                    <i class="bg-warning"></i> OCUPADA
                                  </span>
                                <?php  
                                }
                                ?>
                                </td>
                            </tr>
                          <?php
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                   </div>
                  </div>


                <div class="container">
                  <div class="row">
                    <?php  
                      if($existe_ocupada == false){
                    ?>
                      <div class="col">
                         <a href="ver_cierre.php"><button type="button" class="btn btn-success btn-block my-4">Realizar Cierre</button></a>
                      </div>
                    <?php
                      }
                    ?>
                    <div class="col">
                      <a href="../inicio.php"><button type="button" class="btn btn-danger btn-block my-4">Volver</button></a>
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




</body>

</html>