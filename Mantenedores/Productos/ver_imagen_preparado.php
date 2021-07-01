<?php session_start();   ?>
<!DOCTYPE html>
<html>

<?php 
  include("header.php"); 
  include("../../intranet/funciones/controlador.php");
?>


<script type="text/javascript">


  function muestra_modal_imagen(id, familia_id)
  {
    $('#myModalDescuento #id_promocion2').val(id);   $.ajax({
           url: 'modal_imagen.php',
           type: 'POST',
           data:{id:id, familia_id:familia_id},
           success: function(data){
                $('#contenidoDescuento').html(data);
                $('#myModalDescuento').modal('show');
           }
       });
  }

</script>


<body>
  <!-- Sidenav -->
  <?php include("sidenav.php"); ?>
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->


    <?php
      $nombre_producto = get_preparados_id($_GET['id']);
    ?>



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">IMAGEN ASOCIADA A <?php echo $nombre_producto['PREPARADOS_NOMBRE'] ?></h3>
                </div>


                  <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                     <div class="table-responsive">
                      <table id="example1" class="table table-flush">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">IMAGEN</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                             $imagen = get_imagen_preparado_by_id($_GET['id']);
                          ?> 
                          <tr align="center"> 
                            <th >
                              <img src="<?php echo $imagen ?>" alt="..." class="img-thumbnail" width="500" height="500">
                            </th>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                   </div>
                  </div>


                <div class="container">
                  <div class="row">
                    <div class="col">
                       <button type="button" onclick='muestra_modal_imagen(<?php echo $_GET['id'] ?>, <?php echo $_GET['familia_id'] ?>)' class="btn btn-default btn-block my-4" aria-label="Left Align" data-toggle="modal" data-toggle="modal" data-target="modal" data-whatever="@mdo">
                          NUEVO
                        </button>
                    </div>
                    <div class="col">
                       <a href="visualiza_producto_preparado.php?Familia=<?php echo $_GET['familia_id'] ?>"><button type="button" class="btn btn-danger btn-block my-4">Volver</button></a>
                    </div>
                  </div>
                </div>


                 <div id="myModalDescuento" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <form  name="miform" id="form1" method="post" action="../../intranet/funciones/procesa_galeria.php" enctype="multipart/form-data">
                        <div class="modal-header">
                          <h4 class="modal-title">IMAGEN</h4>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                              <div id="contenidoDescuento">

                              </div>
                          </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Agregar</button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">CERRAR</button>
                          </div>
                        </form>
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





</body>

</html>