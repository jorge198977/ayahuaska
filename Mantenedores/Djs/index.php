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
      $karaokes_pendientes = get_karaokes_by_estado(0);
    ?>



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">LISTA KARAOKES PENDIENTES</h3>
                </div>


                  <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                     <div class="table-responsive">
                      <table id="example1" class="table table-flush">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">ARTISTA</th>
                            <th scope="col">FECHA</th>
                            <th scope="col">MESA</th>
                            <th scope="col">CAMBIAR</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            foreach ($karaokes_pendientes as $key => $kar_pend) {
                              $karaoke = get_cancion_by_id($kar_pend['karaoke_id']);
                              $mesa = get_mesa_by_id($kar_pend['mesa_id']);
                            ?> 
                              <tr class="active">
                                <th><?php echo $karaoke['nombre'] ?></th>
                                <th><?php echo $karaoke['artista'] ?></th>
                                <th><?php echo fecha_bd_normal($kar_pend['fecha']). " ".$kar_pend['hora'] ?></th>
                                <th><?php echo $mesa ?></th>
                                <th>
                                  <a onclick="return confirmDel();" href="../../intranet/funciones/procesamoderador2.php?&CambiaEstadocancion=<?php echo $kar_pend['id'] ?>">
                                      <button type="button" name="btnelimbeb" value="btnelimbeb" class="btn btn-default" aria-label="Left Align">
                                          <span class="fas fa-bullhorn" aria-hidden="true"></span>
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
                   </div>
                  </div>


                <div class="container">
                  <div class="row">
                    <div class="col">
                      <a href="../../inicio.php"><button type="button" class="btn btn-danger btn-block my-4">Volver</button></a>
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

   <!-- DataTables -->
  
  <script src="../../intranet/plugins/datatables/jquery.dataTables.min.js"></script>

  <!-- page script -->
  <script>
    $(function () {
       $("#example1").DataTable();

    });
  </script>



</body>

</html>