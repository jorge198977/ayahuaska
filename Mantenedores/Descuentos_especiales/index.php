<?php session_start();   ?>
<!DOCTYPE html>
<html>

<?php 
  include("header.php"); 
  include("../../intranet/funciones/controlador.php");
?>

<script type="text/javascript">

  function muestra_modal(id)
  {
    $('#myModal5 #id_promocion2').val(id);   $.ajax({
           url: 'modal_descuentos_especiales.php',
           type: 'POST',
           data:{id:id},
           success: function(data){
                $('#contenido2').html(data);
                $('#myModal5').modal('show');
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
    <?php include("top_nav.php"); ?>
    <!-- Header -->

    <?php
      $descuentos_familias = get_all_descuentos_familias();
    ?>



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">DESCUENTOS POR FAMILIA</h3>
                </div>


                  <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                     <div class="table-responsive">
                      <table id="example1" class="table table-flush">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">FAMILIA</th>
                            <th scope="col">DESC</th>
                            <th scope="col">HORA I</th>
                            <th scope="col">HORA F</th>
                            <th scope="col">FECHA INGRESO</th>
                            <?php if(($_SESSION['tipo'] == 1)){ ?>
                              <th>ACCION</th>
                            <?php } ?>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            foreach ($descuentos_familias as $key => $descuento_familia) {
                              $familia = get_familia($descuento_familia['familia_id']);
                          ?> 
                            <tr>
                              <th><?php echo $familia ?></th>
                              <th><?php echo number_format($descuento_familia['descuento'], 0, ',', '.'); ?></th>
                              <th><?php echo $descuento_familia['hora_inicial'] ?></th>
                              <th><?php echo $descuento_familia['hora_final'] ?></th>
                              <th><?php echo (substr($descuento_familia['fecha_ingreso'], 8, 2).
                              "-".substr($descuento_familia['fecha_ingreso'], 5, 2).
                              "-".substr($descuento_familia['fecha_ingreso'], 0, 4)); ?></th>
                              <?php if(($_SESSION['tipo'] == 1)){ ?>
                                <th>

                                  <a onclick="return confirmDel();" href="../../intranet/funciones/procesamoderador2.php?Elimdescuento_familia=<?php echo $descuento_familia['id'] ?>">
                                  <button type="button" name="btnelimbeb" value="btnelimbeb" class="btn btn-default" aria-label="Left Align">
                                  <span class="fas fa-cut " aria-hidden="true"></span>
                                  </button>
                                </a>
                                  <button type="button" onclick='muestra_modal(<?php echo $descuento_familia['id'] ?>)' class="btn btn-default" aria-label="Left Align" data-toggle="modal" data-toggle="modal" data-target="modal" data-whatever="@mdo">
                                  <span class="fas fa-edit" aria-hidden="true"></span>
                                  </button>

                                </th>
                              <?php } ?>
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
                       <button type="button" onclick='muestra_modal(0)' class="btn btn-success btn-block my-4" data-toggle="modal" data-toggle="modal" data-target="modal" data-whatever="@mdo">Nuevo</button>
                    </div>
                    <div class="col">
                      <a href="../../mantenedores.php"><button type="button" class="btn btn-danger btn-block my-4">Volver</button></a>
                    </div>
                  </div>
                </div>


                <div id="myModal5" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <form  name="miform" id="form1" method="post" action="../../intranet/funciones/procesamoderador2.php" >
                        <div class="modal-header">
                          <h4 class="modal-title">PROVEEDORES</h4>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                            <input type="hidden" name="id_promocion" id="id_promocion2">
                              <div id="contenido2"></div>
                          </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Siguiente</button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
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

  <!-- page script -->
  <script>
    $(function () {
       $("#example1").DataTable();

    });
  </script>



</body>

</html>