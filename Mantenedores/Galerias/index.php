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


    <?php
      $imagenes = get_galeria();
    ?>



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">GALERIAS</h3>
                </div>


                  <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                     <div class="table-responsive">
                      <table id="example1" class="table table-flush">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">IMAGEN</th>
                            <th scope="col">ACCION</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                             foreach ($imagenes as $key => $imagen) {
                          ?> 
                          <tr>
                            <th><?php echo $imagen['id'] ?></th>
                            <th>
                              <img src="../../Clientes/Galerias/imagenes/<?php echo $imagen['nombre'] ?>" alt="..." class="img-thumbnail" width="100" height="100">
                            </th>
                            <th>
                                <a onclick="return confirmDel();" 
                                  href="../../intranet/funciones/procesa_galeria.php?Elimina_imagen=<?php echo $imagen['id'] ?>&nombre=<?php echo $imagen['nombre'] ?>">
                                    <button type="button" name="btnelimbeb" value="btnelimbeb" class="btn btn-default" aria-label="Left Align">
                                    <span class="fas fa-trash-alt" aria-hidden="true"></span>
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