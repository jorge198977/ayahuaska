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
      $descuentos = get_all_descuentos();
    ?>



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">DESCUENTOS REALIZADOS</h3>
                </div>


                  <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                     <div class="table-responsive">
                      <table id="example1" class="table table-flush">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">MESA</th>
                            <th scope="col">MONTO</th>
                            <th scope="col">USUARIO</th>
                            <th scope="col">FECHA</th>
                            <th scope="col">HORA</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            foreach ($descuentos as $key => $descuento) {
                              $usuario = get_usuario_id($descuento['usuario_id']);
                              $venta = get_venta_id($descuento['venta_id']);
                          ?> 
                            <tr>
                                <th><?php echo $descuento['venta_id'] ?></th>
                                <th><?php echo $venta['mesa_id'] ?></th>
                                <th><?php echo "$".number_format($descuento['monto']) ?></th>
                                <th>
                                  <?php 
                                   echo  $usuario['nombre']. " ".$usuario['apellido'];
                                  ?> 
                                </th>
                                <th><?php echo substr($descuento['fecha'], 8, 2)."-".substr($descuento['fecha'], 5, 2)."-".substr($descuento['fecha'], 0, 4) ?></th>
                                <th><?php echo $descuento['hora'] ?></th>
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
                      <a href="index.php"><button type="button" class="btn btn-danger btn-block my-4">Volver</button></a>
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