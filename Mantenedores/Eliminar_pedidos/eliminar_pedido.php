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

  function muestra_modal_motivo_eliminacion(id, mesa_id)
  {
    $('#myModalMotivo #id_promocion2').val(id);   $.ajax({
           url: 'modal_motivo_eliminacion.php',
           type: 'POST',
           data:{id:id, mesa_id:mesa_id},
           success: function(data){
                $('#contenidoMotivo').html(data);
                $('#myModalMotivo').modal('show');
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
      $ventas = get_ventas_estado(0);
      $ventas_cerradas = get_ventas_estado(1); 
    ?>



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">ELIMINAR PEDIDO</h3>
                </div>



                <div class="nav-wrapper">
                    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                      <li class="nav-item">
                          <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i>MESAS ABIERTAS</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-folder-17 mr-2"></i>MESAS CERRADAS</a>
                      </li>
                  </ul>
                </div>
                <div class="card shadow">
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                
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
                                          <th scope="col">ACCIÓN</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                          foreach ($ventas as $key => $venta) {
                                            $usuario = get_usuario_id($venta['usuario_id']);
                                            $mesa = get_mesa_by_id($venta['mesa_id']);
                                            $ventas_detalles = get_ventas_detalles_id($venta['id']);
                                        ?> 
                                          <tr>
                                            <td><?php echo $venta['id'] ?></td>
                                            <td><?php echo $mesa ?></td>
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
                                                $sumatoria_descuento = 0;
                                                $descuento_puntos = 0;
                                                foreach ($ventas_detalles as $key => $venta_detalle) {
                                                  $desc = 0;
                                                  $preparado = get_preparados_id($venta_detalle['preparado_id']);
                                                  $descuento_familia = get_descuento_familia_by_familia_id($preparado['PREPARADOS_FAMILIA']);
                                                  if($descuento_familia['descuento'] != ""){
                                                    $dentro_horario = dentro_de_horario($descuento_familia['hora_inicial'], $descuento_familia['hora_final'], $venta_detalle['hora']);
                                                    if($dentro_horario == 1){
                                                      $desc = $descuento_familia['descuento'] * $venta_detalle['cantidad'];
                                                      $sumatoria_descuento = $sumatoria_descuento + intval($desc);
                                                    }
                                                  }
                                                }

                                                $obtener_descuento = get_descuento_venta($venta['id']);
                                                if($obtener_descuento != ""){
                                                  $descu = $obtener_descuento;
                                                }
                                                else{
                                                  $descu = 0;
                                                }
                                                  $descuento_puntos = get_descuento_puntos($venta['id']);
                                                  $monto_venta = obtiene_total_venta($venta['id']);
                                                  if($monto_venta > 0){
                                                    echo number_format($monto_venta - $descu - $sumatoria_descuento - $descuento_puntos, 0, ',', '.');
                                                  }
                                                  else{
                                                    echo number_format($monto_venta, 0, ',', '.');
                                                  }
                                            ?>  
                                            </td>
                                            <td><?php echo substr($venta['fecha'], 8, 2)."-".substr($venta['fecha'], 5, 2)."-".substr($venta['fecha'], 0, 4) ?></td>
                                            <td align="center">
                                              <a onclick="muestra_modal_motivo_eliminacion(<?php echo $venta['id'] ?>,<?php echo $venta['mesa_id'] ?>)">
                                                <button type="button" name="btnelimbeb" value="btnelimbeb" class="btn btn-default" aria-label="Left Align">
                                                <span class="far fa-trash-alt" aria-hidden="true"></span>
                                                </button>
                                              </a>
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


                            </div>
                            <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                <div class="col">
                                  
                                  <div class="box">
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                     <div class="table-responsive">
                                      <table id="example2" class="table table-flush">
                                        <thead class="thead-light">
                                          <tr>
                                            <th scope="col">MOV</th>
                                            <th scope="col">MESA</th>
                                            <th scope="col">MESERO</th>
                                            <th scope="col">SOCIO</th>
                                            <th scope="col">TOTAL</th>
                                            <th scope="col">FECHA</th>
                                            <th scope="col">ACCIÓN</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php
                                            foreach ($ventas_cerradas as $key => $venta_cerrada) {
                                              $usuario = get_usuario_id($venta_cerrada['usuario_id']);
                                              $mesa = get_mesa_by_id($venta_cerrada['mesa_id']);
                                              $ventas_detalles = get_ventas_detalles_id($venta_cerrada['id']);
                                          ?> 
                                            <tr>
                                              <td><?php echo $venta_cerrada['id'] ?></td>
                                              <td><?php echo $mesa ?></td>
                                              <td><?php echo $usuario['nombre']." ".$usuario['apellido']; ?></td>
                                              <td>
                                                <?php 
                                                  $socio_id = get_vta_socio_id($venta_cerrada['id']);
                                                  if($socio_id != ""){ 
                                                      $nombre_socio = get_nombre_socio($socio_id);
                                                      echo $nombre_socio['nombre']; 
                                                  } 
                                                ?>
                                              </td>
                                              <td>
                                              <?php  
                                                  $sumatoria_descuento = 0;
                                                  $descuento_puntos = 0;
                                                  foreach ($ventas_detalles as $key => $venta_detalle) {
                                                    $desc = 0;
                                                    $preparado = get_preparados_id($venta_detalle['preparado_id']);
                                                    $descuento_familia = get_descuento_familia_by_familia_id($preparado['PREPARADOS_FAMILIA']);
                                                    if($descuento_familia['descuento'] != ""){
                                                      $dentro_horario = dentro_de_horario($descuento_familia['hora_inicial'], $descuento_familia['hora_final'], $venta_detalle['hora']);
                                                      if($dentro_horario == 1){
                                                        $desc = $descuento_familia['descuento'] * $venta_detalle['cantidad'];
                                                        $sumatoria_descuento = $sumatoria_descuento + intval($desc);
                                                      }
                                                    }
                                                  }

                                                  $obtener_descuento = get_descuento_venta($venta_cerrada['id']);
                                                  if($obtener_descuento != ""){
                                                    $descu = $obtener_descuento;
                                                  }
                                                  else{
                                                    $descu = 0;
                                                  }
                                                    $descuento_puntos = get_descuento_puntos($venta_cerrada['id']);
                                                    $monto_venta = obtiene_total_venta($venta_cerrada['id']);
                                                    if($monto_venta > 0){
                                                      echo number_format($monto_venta - $descu - $sumatoria_descuento - $descuento_puntos, 0, ',', '.');
                                                    }
                                                    else{
                                                      echo number_format($monto_venta, 0, ',', '.');
                                                    }
                                              ?>  
                                              </td>
                                              <td><?php echo substr($venta_cerrada['fecha'], 8, 2)."-".substr($venta_cerrada['fecha'], 5, 2)."-".substr($venta_cerrada['fecha'], 0, 4) ?></td>
                                              <td align="center">
                                                <a onclick="muestra_modal_motivo_eliminacion(<?php echo $venta_cerrada['id'] ?>, <?php echo $venta_cerrada['mesa_id'] ?>)">
                                                  <button type="button" name="btnelimbeb" value="btnelimbeb" class="btn btn-default" aria-label="Left Align">
                                                  <span class="far fa-trash-alt" aria-hidden="true"></span>
                                                  </button>
                                                </a>
                                                  <button type="button" onclick='muestra_modal(<?php echo $venta_cerrada['id'] ?>)' class="btn btn-default" aria-label="Left Align" data-toggle="modal" data-toggle="modal" data-target="modal" data-whatever="@mdo">
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
                                  
                                </div>
                            </div>
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


                <div id="myModalMotivo" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <form  name="miform" id="form1" method="post" action="../../intranet/funciones/procesamoderador2.php" >
                        <div class="modal-header">
                          <h4 class="modal-title">MOTIVO ELIMINACION</h4>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                              <div id="contenidoMotivo"></div>
                          </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Eliminar</button>
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
       $("#example2").DataTable();

    });
  </script>



</body>
<script src="../../js/bootbox.min.js"></script>
<?php 
    if(isset($_GET['Eliminado'])){
  ?>
    <script type="text/javascript">
      bootbox.alert("Mesa Eliminada correctamente!");
    </script>
  <?php
    }
    if(isset($_GET['ErrorEliminando'])){
  ?>
    <script type="text/javascript">
      bootbox.alert("Error Eliminando pedido!");
    </script>
  <?php
    }
  ?>

</html>