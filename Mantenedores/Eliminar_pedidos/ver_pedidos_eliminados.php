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
           url: 'modal_elimina_pedidos.php',
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
      $ventas = get_ventas_estado(-1);
    ?>



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">PEDIDOS ELIMINADOS</h3>
                </div>


                  <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                     <div class="table-responsive">
                      <table id="example1" class="table table-flush">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">MOV</th>
                            <th scope="col">MESA</th>
                            <th scope="col">MESERO</th>
                            <th scope="col">MOTIVO</th>
                            <th scope="col">FECHA</th>
                            <th scope="col">ACCIÓN</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            foreach ($ventas as $key => $venta) {
                              $usuario = get_usuario_id($venta['usuario_id']);
                          ?> 
                            <tr>
                              <td><?php echo $venta['id'] ?></td>
                              <td><?php echo get_mesa_by_id($venta['mesa_id']) ?></td>
                              <td><?php echo $usuario['nombre']." ".$usuario['apellido']; ?></td>
                              <td>
                              <?php  
                                  $motivo = get_motivo_eliminado($venta['id']);
                                  echo $motivo;
                              ?>  
                              </td>
                              <td><?php echo substr($venta['fecha'], 8, 2)."-".substr($venta['fecha'], 5, 2)."-".substr($venta['fecha'], 0, 4) ?></td>
                              <td>
                                <button type="button" onclick='muestra_modal(<?php echo $venta['id'] ?>)' class="btn btn-default" aria-label="Left Align" data-toggle="modal" data-toggle="modal" data-target="modal" data-whatever="@mdo">
                                  <span class="far fa-eye" aria-hidden="true"></span>
                                  </button>

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
                    <div class="col">
                      <a href="index.php"><button type="button" class="btn btn-danger btn-block my-4">Volver</button></a>
                    </div>
                  </div>
                </div>

                <div id="myModal5" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <form  name="miform" id="form1" method="post" action="../../intranet/funciones/procesamoderador2.php" >
                        <div class="modal-header">
                          <h4 class="modal-title">VER PEDIDO</h4>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                              <div id="contenido2"></div>
                          </div>
                          </div>
                          <div class="modal-footer">
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