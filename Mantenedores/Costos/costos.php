<?php  session_start();   ?>
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
           url: 'modal_costos.php',
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
      $costos = get_all_costos_by_tipo($_GET['id']);  
     // print_r($costos);  
      $tipo_costo = get_tipo_costo_id($_GET['id']);
      $mes_actual = date("m");
      $fecha_filtro = date("Y-m");
    ?>



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">Costo - <?php echo $tipo_costo['nombre'] ?></h3>
                </div>


                  <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                     <div class="table-responsive">
                      <table id="example1" class="table table-flush">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">COSTO</th>
                            <th scope="col">TOTAL</th>
                            <th scope="col">FECHA</th>
                            <th scope="col">FECHA VENCIMIENTO</th>
                            <th scope="col">F. PAGO</th>
                            <th scope="col">FACT</th>
                            <th scope="col">INGRESO</th>
                            <th scope="col">ACCION</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            foreach ($costos as $key => $costo) {
                              //if($fecha_filtro == substr($costo['fecha'], 0, 7)){
                                $usuario = get_usuario_id($costo['usuario_id']);
                                $tipo_costo = get_tipo_costo_id($costo['tipo_costo_id']);
                            ?> 
                              <tr class="active">
                                <th><?php echo $costo['id'] ?></th>
                                <th><?php echo $costo['nombre'] ?></th>
                                <th><?php echo number_format($costo['monto'], 0, ',', '.') ?></th>
                                <th><?php echo fecha_bd_normal($costo['fecha']) ?></th>
                                <th><?php echo fecha_bd_normal($costo['fecha_vencimiento']) ?></th>
                                <th><?php echo get_forma_pago_id($costo['forma_pago_id']) ?></th>   
                                <th><?php echo $costo['factura'] ?></th>
                                <th><?php echo $usuario['nombre']." ".$usuario['apellido']; ?></th>

                                <th>
                                  <a onclick="return confirmDel(<?php echo $_GET['id'] ?>, <?php echo $costo['id'] ?>);">
                                    <button type="button" name="btnelimbeb" value="btnelimbeb" class="btn btn-default" aria-label="Left Align">
                                    <span class="fas fa-cut " aria-hidden="true"></span>
                                    </button>
                                  </a>
                                  <button type="button" onclick='muestra_modal(<?php echo $costo['id'] ?>)' class="btn btn-default" aria-label="Left Align" data-toggle="modal" data-toggle="modal" data-target="modal" data-whatever="@mdo">
                                  <span class="fas fa-edit" aria-hidden="true"></span>
                                  </button>
                                  
                                </th> 
                              </tr>
                          <?php
                           // }
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
                      <a href="index.php"><button type="button" class="btn btn-danger btn-block my-4">Volver</button></a>
                    </div>
                  </div>
                </div>


                <div id="myModal5" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <form  name="miform" id="form1" method="post" action="../../intranet/funciones/procesamoderador2.php" >
                        <div class="modal-header">
                          <h4 class="modal-title">COSTOS</h4>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                            <input type="hidden" name="tipo_costo" value="<?php echo $_GET['id'] ?>">
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


   <script src="../../js/bootbox.min.js"></script>
  <script type="text/javascript">
    function confirmDel(id, Elimcosto){
        bootbox.confirm({
        message: "¿Realmente desea eliminarlo?",
        buttons: {
            confirm: {
                label: 'SI',
                className: 'btn-success'
            },
            cancel: {
                label: 'NO',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if(result){
              location.href = "../../intranet/funciones/procesamoderador2.php?id="+id+"&Elimcosto="+Elimcosto+""; 
            }
            else{
              
            }
        }
    });
    }
  </script>



</body>

</html>