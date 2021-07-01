<?php session_start();   
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<!DOCTYPE html>
<html>

<?php 
  include("header.php"); 
  include("../intranet/funciones/controlador.php");
  include("../intranet/funciones/seguridad.php");
  if(!validaringreso())
    header('Location:../index.php?NOCINICIA');
?>

<script type="text/javascript">

  function muestra_modal_imprime(id)
  {
    $('#myModalImprimir #id_promocion2').val(id);   $.ajax({
           url: 'modal_imprimir.php',
           type: 'POST',
           data:{id:id},
           success: function(data){
                $('#contenidoImprimir').html(data);
                $('#myModalImprimir').modal('show');
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
    <!-- Header -->

    <?php
      if(($_SESSION['tipo'] == 1) or ($_SESSION['tipo'] == 2) or ($_SESSION['tipo'] == 4)){
        $ventas = get_ventas_estado(0);  
      }
      else{
        $ventas = get_ventas_usuario_estado($_SESSION['id'], 0);
      }
    ?>

    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">PEDIDOS</h3>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col"><h3>MESA</h3></th>
                        <th scope="col"><h3>MESEROA</h3></th>
                        <th scope="col"><h3>CLIENTE</h3></th>
                        <th scope="col"><h3>TOTAL</h3></th>
                        <th scope="col"><h3>PAGADO</h3></th>
                        <th scope="col"><h3>FECHA</h3></th>
                        <th scope="col"><h3>ACCION</h3></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        foreach ($ventas as $key => $venta) {
                          $usuario = get_usuario_id($venta['usuario_id']);
                          $mesa = get_mesa_by_id($venta['mesa_id']);
                          $ventas_detalles = get_ventas_detalles_id($venta['id']);
                          $monto_pagado = suma_pagos_by_mov($venta['id']);
                      ?> 
                          <tr>
                            <td><h4> <?php echo $mesa ?> </h4></td>
                            <td><h4><?php echo $usuario['nombre']." ".$usuario['apellido']; ?></h4></td>
                            <td><h4>
                              <?php 
                                $socio_id = get_vta_socio_id($venta['id']);
                                if($socio_id != ""){ 
                                    $nombre_socio = get_nombre_socio($socio_id);
                                    echo $nombre_socio['nombre']; 
                                } 
                              ?>
                            </h4></td>
                            <td><h4>
                              <?php  
                                $sumatoria_descuento = 0;
                                $descuento_puntos = 0;
                                foreach ($ventas_detalles as $key => $venta_detalle) {
                                  $desc = 0;
                                  $preparado = get_preparados_id($venta_detalle['preparado_id']);
                                  $descuento_familia = get_descuento_familia_by_familia_id2($preparado['PREPARADOS_FAMILIA']);
                                  if($descuento_familia != 0){
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
                              </h4></td>
                              <td><h4><?php echo number_format($monto_pagado, 0, ',', '.') ?></h4></td>
                              <td><h4><?php echo fecha_bd_normal($venta['fecha'])." ".$venta['hora'] ?></h4></td>
                              <td align="center">
                                  <a href="verpedido_detalle.php?Mov=<?php echo $venta['id'] ?>">
                                    <button type="button" name="btnelimbeb" value="btnelimbeb" class="btn btn-default" aria-label="Left Align">
                                    <span class="far fa-eye" aria-hidden="true"></span>
                                    </button>
                                  </a>
                                  <?php if(($_SESSION['tipo'] == 1) || ($_SESSION['tipo'] == 2) || ($_SESSION['tipo'] == 4) || ($_SESSION['tipo'] == 7)){ ?>
                                     <a onclick="return (confirmDel(<?php echo $venta['id'] ?>));">
                                      <button type="button" name="btnelimbeb" value="btnelimbeb" class="btn btn-default"  aria-label="Left Align">
                                      <span class="fas fa-cart-arrow-down" aria-hidden="true"></span>
                                      </button>
                                    </a>
                                  <?php } ?>
                                  <?php if(($_SESSION['tipo'] == 1) || ($_SESSION['tipo'] == 2) || ($_SESSION['tipo'] == 4) || ($_SESSION['tipo'] == 7)){ ?>
                                      <a href="mover.php?Mov=<?php echo $venta['id'] ?>">
                                        <button type="button" class="btn btn-default" aria-label="Left Align">
                                        <span class="fas fa-angle-double-right" aria-hidden="true"></span>
                                        </button>
                                      </a>
                                  <?php } ?>
                                  <button type="button" onclick='muestra_modal_imprime(<?php echo $venta['id'] ?>)' class="btn btn-default" aria-label="Left Align" data-toggle="modal" data-toggle="modal" data-target="modal" data-whatever="@mdo">
                                  <span class="fas fa-print " aria-hidden="true"></span>
                                  </button>
                              </td>
                          </tr>
                      <?php
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
                <div class="card-footer py-4">
                  <nav aria-label="...">
                    <a href="index.php"><button type="button" class="btn btn-danger btn-block my-4">Volver</button></a>
                  </nav>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

                <div id="myModalImprimir" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <form  name="formCambioReImprimir" id="formCambioReImprimir" method="post" action="../intranet/funciones/procesamoderador2.php" >
                        <div class="modal-header">
                          <h4 class="modal-title">VOLVER A IMPRIMIR PEDIDO</h4>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                              <div id="contenidoImprimir"></div>
                          </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                          </div>
                        </form>
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

<script src="../js/bootbox.min.js"></script>
  <script type="text/javascript">
    function confirmDel(id){
        bootbox.confirm({
        message: "¿Realmente desea cerrar la mesa?",
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
              location.href = "cerrarped.php?Mov="+id+"&pedircuenta"; 
            }
            else{
              
            }
        }
    });
    }
    </script>
    <?php 
      if(isset($_GET['ReImpreso'])){
    ?>
      <script type="text/javascript">
        bootbox.alert("Se ha enviado a imprimir ticket nuevamente!");
      </script>
    <?php
      }
      if(isset($_GET['Pagado'])){
    ?>
      <script type="text/javascript">
        bootbox.alert("Pago realizado correctamente!");
      </script>
    <?php
      }
    ?>
  

</html>