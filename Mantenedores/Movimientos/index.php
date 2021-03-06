<?php session_start();   

 error_reporting(E_ALL);
 ini_set('display_errors', '1');
?>
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
           url: 'modal_ver_detalle.php',
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
      $ventas = get_all_ventas(); 
    ?>



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">Movimientos Generados</h3>
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
                            <th scope="col">SOCIO</th>
                            <th scope="col">TOTAL</th>
                            <th scope="col">FECHA</th>
                            <th scope="col">ESTADO</th>
                            <th scope="col">ACCIÓN</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            foreach ($ventas as $key => $venta) {
                              $usuario = get_usuario_id($venta['usuario_id']);
                              $ventas_detalles = get_ventas_detalles_id($venta['id']);
                          ?> 
                            <tr>
                              <td><?php echo $venta['id']; ?></td>
                              <td><?php echo $mesa = get_mesa_by_id($venta['mesa_id']); ?></td>
                              <td><?php echo $usuario['nombre']." ".$usuario['apellido']; ?></td>
                              <td>
                                <?php 
                                  $socio_id = get_vta_socio_id($venta['id']);
                                  if($socio_id != ""){ 
                                      $nombre_socio = get_nombre_socio($socio_id);
                                      echo $nombre_socio['nombre']; 
                                  } 
                                ?>
                              </td>
                              <td>
                              <?php  
                                  // $sumatoria_descuento = 0;
                                  // foreach ($ventas_detalles as $key => $venta_detalle) {
                                  //   $preparado = get_preparados_id($venta_detalle['preparado_id']);
                                  //   $descuento_familia = get_descuento_familia_by_familia_id($preparado['PREPARADOS_FAMILIA']);
                                  //   if($descuento_familia['descuento'] != ""){
                                  //     $dentro_horario = dentro_de_horario($descuento_familia['hora_inicial'], $descuento_familia['hora_final'], $venta_detalle['hora']);
                                  //     if($dentro_horario == 1){
                                  //       $desc = $descuento_familia['descuento'] * $venta_detalle['cantidad'];
                                  //       $sumatoria_descuento = $sumatoria_descuento + intval($desc);
                                  //     }
                                  //   }
                                  // }
                                  // $obtener_descuento = get_descuento_venta($venta['id']);
                                  // if($obtener_descuento != ""){
                                  //   $descu = $obtener_descuento;
                                  // }
                                  // else{
                                  //   $descu = 0;
                                  // }
                                  echo number_format(obtiene_total_venta($venta['id']), 0, ',', '.');
                              ?>  
                              </td>
                              <td><?php echo substr($venta['fecha'], 8, 2)."-".substr($venta['fecha'], 5, 2)."-".substr($venta['fecha'], 0, 4) ?></td>
                              <td>
                                <?php
                                  if($venta['estado'] == 0){
                                    echo "EN ATENCION";
                                  }
                                  if($venta['estado'] == 1){
                                    echo "CERRADA";
                                  }
                                  if($venta['estado'] == -1){
                                    echo "ANULADA";
                                  }
                                ?>
                              </td>
                              <td>
                                <button type="button" onclick='muestra_modal(<?php echo $venta['id'] ?>)' class="btn btn-default" aria-label="Left Align" data-toggle="modal" data-toggle="modal" data-target="modal" data-whatever="@mdo">
                                  <span class="fas fa-eye" aria-hidden="true"></span>
                                  </button>
                                <a href="solicita_precuenta.php?mov=<?php echo $venta['id'] ?>&mesa=<?php echo $mesa ?>">
                                  <button type="button" class="btn btn-default" aria-label="Left Align" data-toggle="modal" data-toggle="modal" data-target="modal" data-whatever="@mdo">
                                  <span class="fas fa-print " aria-hidden="true"></span>
                                  </button>
                                </a>
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
                      <a href="../../mantenedores.php"><button type="button" class="btn btn-danger btn-block my-4">Volver</button></a>
                    </div>
                  </div>
                </div>


                <div id="myModal5" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <form  name="miform" id="form1" method="post" action="../../intranet/funciones/procesamoderador2.php" >
                        <div class="modal-header">
                          <h4 class="modal-title">DETALLE PEDIDO</h4>
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


   <script type="text/javascript">
    $(document).ready( function () {
     // $('#myTable').DataTable();
       $('#example1').DataTable(
           {
               "order": [[ 0, "desc" ]],
               "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
          }
        );

     });
  </script> 



  <script src="../../js/bootbox.min.js"></script>
<?php 
    if(isset($_GET['Impreso'])){
  ?>
    <script type="text/javascript">
      bootbox.alert("Detalle impreso!");
    </script>
  <?php
    }
  ?>


</body>

</html>