<?php session_start();   ?>
<!DOCTYPE html>
<html>

<?php 
  include("header.php"); 
  include("../../intranet/funciones/controlador.php");
  date_default_timezone_set('America/Santiago');
?>


<script type="text/javascript">

  function muestra_modal_detalle(id, forma_pago_id, venta_pago_id)
  {
    $('#myModal #id_promocion').val(id);   $.ajax({
           url: 'modal_ver_detalle.php',
           type: 'POST',
           data:{id:id, forma_pago_id:forma_pago_id, venta_pago_id:venta_pago_id},
           success: function(data){
                $('#contenido').html(data);
                $('#myModal').modal('show');
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
         if(isset($_GET['turno'])){
          $turno = $_GET['turno']; 
          if($turno == 1){
            $fechahoy = $_GET['fechai'];  
            $horat21 = "09:00:00";
            $hotat22 = "23:59:59";
            $fecha21 = $fechahoy." ".$horat21;
            $fecha22 = $fechahoy." ".$hotat22;
            $cierres = get_cierres_por_fecha_hora($fecha21, $fecha22);
            $eliminadas =  get_ventas_eliminadas_fecha($fecha21, $fecha22, -1);
            $egresos = get_egresos_fecha($fecha21, $fecha22);                             
          }
          else{
            $fechahoy = $_GET['fechai'];
            $horaactual = date("H:i:s");
            $horario1 = "00:00:00";
            $horario2 = "06:00:00";
            $hora221 = "00:00:00";
            $hora222 = "06:00:00";
            $horat21 = "18:00:01";
            $hotat22 = "23:59:59";
            $fecha21 = $fechahoy." ".$horat21;
            $fecha22 = $fechahoy." ".$hotat22;
            $fechan = strtotime ( '+1 day' , strtotime ( $fechahoy ) ) ;
            $fechan = date ( 'Y-m-j' , $fechan ); 
            $fecha221 = $fechan." ".$hora221;
            $fecha222 = $fechan." ".$hora222;
            $cierres = get_cierres_por_fecha_hora2($fecha21, $fecha22, $fecha221, $fecha222);
            $eliminadas = get_ventas_eliminadas_fecha2($fecha21, $fecha22, $fecha221, $fecha222, -1);
            $egresos = get_egresos_fecha2($fecha21, $fecha22, $fecha221, $fecha222);           
          }
        }   
    ?>



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">REPORTES MENSUALES</h3>
                </div>

                <form name="frmfiltro" method="get" action="cierres_turnos.php">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="input-group mb-4">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                          </div>
                          <input type="date" class="form-control" name="fechai" id="fechai" placeholder="Ingrese Fecha Inicial"
                            >
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="input-group mb-4">
                          <select class="form-control" name="turno">
                              <option value="">Seleccione turno</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                            </select>
                          <div class="input-group-append">
                            <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <div class="input-group mb-4">
                          <button type="submit" class="btn btn-success btn-lg btn-block">Filtrar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>

                <?php
                  if(isset($_GET['turno'])){
                ?>
                  
                  <div class="table-responsive">
                      <table  class="table table-flush">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">VER</th>
                            <th scope="col">FECHA</th>
                            <th scope="col">MESA</th>
                            <th scope="col">N° INT</th>
                            <th scope="col">CLIENTE</th>
                            <th scope="col">ATENDIDO POR</th>
                            <th scope="col">TOTAL</th>
                            <th scope="col">BOLETA</th>
                            <th scope="col">PROPINA</th>
                            <th scope="col">EFECTIVO</th>
                            <th scope="col">DEBITO</th>
                            <th scope="col">TRANSFER</th>
                            <th scope="col">FACTURA</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $totcig = 0;
                            $propina = 0;
                            $prop_efec = 0;
                            $prop_debito = 0;
                            $prop_transferencia = 0;
                            $prop_factura = 0;
                            foreach ($cierres as $key => $cierre) {
                              $obtener_propina = get_venta_propina($cierre['venta_id'], $cierre['venta_pago_id']);
                              if($obtener_propina['monto'] != ""){
                                $propina = $propina + $obtener_propina['monto'];
                              }
                              $vtas_detalles = get_ventas_detalles_id($cierre['venta_id']);
                              foreach ($vtas_detalles as $key => $vta_detalle) {
                                $preparado = get_preparados_id($vta_detalle['preparado_id']);
                                if($preparado['PREPARADOS_FAMILIA'] == 30){
                                  $totcig = $totcig + ($preparado['PREPARADOS_PRECIO'] * $vta_detalle['cantidad'] );
                                } 
                              }
                           ?>   
                            <tr class="info">
                              <td align="center">
                                <?php
                                  if($cierre['mesa_id'] == '8888'){
                                ?>
                                    <a href="../../intranet/boletas/tickets/<?php echo $cierre['venta_id']?>-cover.pdf" target="_blank">
                                      <button type="button" class="btn btn-default" aria-label="Left Align">
                                      <span class="far fa-eye" aria-hidden="true"></span>
                                      </button>
                                    </a>
                                <?php
                                  }
                                  else if($cierre['mesa_id'] == '9999'){
                                ?>
                                    <a href="../../boletas/tickets/<?php echo $cierre['venta_id']?>-directo.pdf" target="_blank">
                                      <button type="button" class="btn btn-default" aria-label="Left Align">
                                      <span class="far fa-eye" aria-hidden="true"></span>
                                      </button>
                                    </a>
                                <?php
                                  }
                                  else{
                                ?>
                                    <button type="button" onclick='muestra_modal_detalle(<?php echo $cierre['venta_id'] ?>, <?php echo $cierre['forma_pago_id'] ?>, <?php echo $cierre['venta_pago_id'] ?>)' class="btn btn-default" aria-label="Left Align" data-toggle="modal" data-toggle="modal" data-target="modal" data-whatever="@mdo">
                                    <span class="fas fa-eye" aria-hidden="true"></span>
                                    </button>

                                <?php    
                                  }
                                ?>
                                
                              </td>
                              <td><?php echo $cierre['fecha_full'] ?></td>
                              <td><?php 
                                if($cierre['mesa_id'] == '8888'){
                                    echo "Venta Entrada";
                                  }
                                  else{
                                     $mesa = get_mesa_by_id($cierre['mesa_id']);   
                                     echo $mesa;
                                  }

                               ?></td>
                              <td><?php echo $cierre['venta_id'] ?></td>
                              <td><?php $socio = get_nombre_socio(get_vta_socio_id($cierre['venta_id'])); echo $socio['nombre'] ?></td>
                              <td>
                                <?php 
                                $mesero = get_usuario_id($cierre['usuario_id']);
                                $nombre_mesero = $mesero['nombre']." ".$mesero['apellido'];
                                echo $nombre_mesero;
                                ?>
                              </td>
                              <td><?php 
                                    echo number_format($cierre['valor'], 0, ',', '.'); 
                                    $total = $total + $cierre['valor'];
                                  ?>
                              </td>
                              <td>
                                <?php
                                  echo $cierre['boleta'];
                                ?>
                              </td>
                              <td><?php 
                                    if($obtener_propina['monto'] != ""){
                                      echo number_format($obtener_propina['monto'], 0, ',', '.'); 
                                    }
                                    else{
                                      echo 0;
                                    }
                                  ?>
                              </td>
                              <td>
                                <?php 
                                  //EFECTIVO
                                  if($cierre['forma_pago_id'] == 1){
                                    if($obtener_propina['monto'] != ""){
                                      echo number_format($cierre['valor'] - $obtener_propina['monto'], 0, ',', '.'); 
                                      $efec = $efec + $cierre['valor'] - $obtener_propina['monto'] ;
                                      $prop_efec = $prop_efec + $obtener_propina['monto'];
                                    }
                                    else{
                                      echo number_format($cierre['valor'], 0, ',', '.'); 
                                      $efec = $efec + $cierre['valor'] ;
                                    }
                                    
                                  }
                                  else{
                                    echo "0";
                                  }
                                ?>
                              </td>
                              <td>
                                <?php 
                                  //DEBITO
                                  if($cierre['forma_pago_id'] == 4){
                                    if($obtener_propina['monto'] != ""){
                                      echo number_format($cierre['valor'] - $obtener_propina['monto'], 0, ',', '.'); 
                                      $tarjeta = $tarjeta + $cierre['valor'] - $obtener_propina['monto'];
                                      $prop_debito = $prop_debito + $obtener_propina['monto'];
                                    }
                                    else{
                                      echo number_format($cierre['valor'], 0, ',', '.'); 
                                      $tarjeta = $tarjeta + $cierre['valor'];
                                    }
                                  }
                                  else{
                                    echo "0";
                                  }
                                ?>
                              </td>    
                              <td>
                                <?php 
                                  //TRANSFERENCIA
                                  if($cierre['forma_pago_id'] == 8){
                                    if($obtener_propina['monto'] != ""){
                                      echo number_format($cierre['valor'] - $obtener_propina['monto'], 0, ',', '.'); 
                                      $trasnferencia = $trasnferencia + $cierre['valor'] - $obtener_propina['monto'];
                                      $prop_transferencia = $prop_transferencia + $obtener_propina['monto'];
                                    }
                                    else{
                                      echo number_format($cierre['valor'], 0, ',', '.'); 
                                      $trasnferencia = $trasnferencia + $cierre['valor'];
                                    }
                                  }
                                  else{
                                    echo "0";
                                  }
                                ?>
                              </td>
                              <td>
                                <?php 
                                  //FACTURA
                                  if($cierre['forma_pago_id'] == 7){
                                    if($obtener_propina['monto'] != ""){
                                      echo number_format($cierre['valor'] - $obtener_propina['monto'], 0, ',', '.'); 
                                      $factura = $factura + $cierre['valor'] - $obtener_propina['monto'];
                                      $prop_factura = $prop_factura + $obtener_propina['monto'];
                                    }
                                    else{
                                      echo number_format($cierre['valor'], 0, ',', '.'); 
                                      $factura = $factura + $cierre['valor'];
                                    }
                                  }
                                  else{
                                    echo "0";
                                  }
                                ?>
                              </td>           
                            </tr>                 
                          <?php
                            }
                          ?>
                          <tr>           
                            <td colspan=6> <?php echo "<strong>Turno ".$turno."</strong>"; ?></td> 
                            <td><?php echo number_format($total, 0, ',', '.');?></td>  
                            <td></td>
                            <td>
                              <?php
                                $pro = $prop_efec + $prop_debito + $prop_transferencia + $prop_factura;
                                echo number_format($pro, 0, ',', '.');
                              ?>
                            </td>
                            <td>
                              <?php
                              if($efec == 0){
                                echo 0;
                              }
                              else {
                                echo number_format($efec, 0, ',', '.');
                              }
                              ?>
                            </td>
                            <td>
                              <?php
                              if($tarjeta == 0){
                                echo 0;
                              }
                              else{
                                echo number_format($tarjeta, 0, ',', '.');
                              }
                              ?>
                            </td> 
                            <td>
                              <?php
                              if($trasnferencia == 0){
                                echo 0;
                              }
                              else{
                                echo number_format($trasnferencia, 0, ',', '.');
                              }
                              ?>
                            </td>   
                            <td>
                              <?php
                              if($factura == 0){
                                echo 0;
                              }
                              else{
                                echo number_format($factura, 0, ',', '.');
                              }
                              ?>
                            </td>     
                          </tr>
                        </tbody>
                      </table>
                    </div>

                <?php    
                  }
                ?>



                <br>
                      <div class="table-responsive">
                        <table id="example1" class="table table-flush">
                          <thead class="thead-light">
                            <tr>
                              <td colspan=3><strong>EGRESOS</strong></td>
                            </tr>
                            <tr>
                                <td class="success">
                                  MONTO
                                </td>  
                                <td class="success">
                                  MOTIVO
                                </td> 
                                <td class="success">
                                  USUARIO
                                </td>  
                            </tr>
                            <?php
                            $total_egreso = 0; 
                              foreach ($egresos as $key => $egreso) {
                                $total_egreso = $total_egreso + $egreso['monto'];
                                $usuario = get_usuario_id($egreso['usuario_id']);
                            ?>
                            <tr>
                                <td class="success" align="center">
                                  <?php echo number_format($egreso['monto'], 0, ',', '.') ?>
                                </td>  
                                <td class="success" align="center">
                                  <?php echo $egreso['motivo'] ?>
                                </td>
                                <td class="success" align="center">
                                 <?php echo $usuario['nombre']." ".$usuario['apellido']; ?>
                                </td>
                            </tr>
                            <?php
                              }
                            ?>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>


                      <br><br>

                      <div class="table-responsive">
                        <table id="example1" class="table table-flush">
                          <thead class="thead-light">
                            <tr>
                              <td colspan=8><strong>RESUMEN CIERRE</strong></td>
                            </tr>
                            <tr>
                                <td class="success" colspan=4 align="center">
                                  <strong>Total Ventas Bruto</strong>
                                </td>
                                <td class="info" colspan=4>
                                  <strong>$<?php echo number_format($total, 0, ',', '.') ?></strong>
                                </td>
                            </tr>
                            <tr>
                            <td class="success" colspan=4 align="center">
                              <strong>Ventas Efectivo</strong>
                            </td>
                            <td class="info" colspan=4>
                              <strong>$<?php echo number_format($efec, 0, ',', '.') ?></strong>
                            </td>
                            </tr>
                            <tr>
                                <td class="success" colspan=4 align="center">
                                  <strong>Ventas Transbank</strong>
                                </td>
                                <td class="info" colspan=4>
                                  <strong>$<?php echo number_format($tarjeta, 0, ',', '.') ?></strong>
                                </td>
                            </tr>
                            <tr>
                                <td class="success" colspan=4 align="center">
                                  <strong>Ventas Transferencia</strong>
                                </td>
                                <td class="info" colspan=4>
                                  <strong>$<?php echo number_format($trasnferencia, 0, ',', '.') ?></strong>
                                </td>
                            </tr>
                            <tr>
                                <td class="success" colspan=4 align="center">
                                  <strong>Propina Efectivo</strong>
                                </td>
                                <td class="info" colspan=4>
                                  <strong>$<?php echo number_format($prop_efec, 0, ',', '.') ?></strong>
                                </td>
                            </tr>
                            <tr>
                                <td class="success" colspan=4 align="center">
                                  <strong>Propina Transbank</strong>
                                </td>
                                <td class="info" colspan=4>
                                  <strong>$<?php echo number_format($prop_debito, 0, ',', '.') ?></strong>
                                </td>
                            </tr>
                            <tr>
                                <td class="success" colspan=4 align="center">
                                  <strong>Propina Transferencia</strong>
                                </td>
                                <td class="info" colspan=4>
                                  <strong>$<?php echo number_format($prop_transferencia, 0, ',', '.') ?></strong>
                                </td>
                            </tr>
                            <tr>
                                <td class="success" colspan=4 align="center">
                                  <strong>Egresos</strong>
                                </td>
                                <td class="info" colspan=4>
                                  <strong>$<?php echo number_format($total_egreso, 0, ',', '.') ?></strong>
                                </td>
                            </tr>

                            <tr>
                                <td class="success" colspan=4 align="center">
                                   <h4><strong>Real Efectivo</strong></h4>
                                </td>
                                <td class="info" colspan=4>
                                 <strong>$<?php echo number_format($efec - $total_egreso  - $prop_debito - $prop_transferencia, 0, ',', '.') ?></strong>
                                </td>
                            </tr>


                            <!-- <tr>
                                <td class="success" colspan=2>
                                  +
                                </td>  
                                <td class="success" colspan=2 align="center">
                                  <strong>TBK + PROP TBK</strong>
                                </td>
                                <td class="info" colspan=2>
                                  <strong>$ <?php ; echo number_format($prop_debito + $tarjeta, 0, ',', '.') ?></strong>
                                </td>
                            </tr>

                            <tr>
                                <td class="success" colspan=2>
                                  +
                                </td>  
                                <td class="success" colspan=2 align="center">
                                  <strong>EGRESOS</strong>
                                </td>
                                <td class="info" colspan=2>
                                  <strong>$ <?php ; echo number_format($total_egreso, 0, ',', '.') ?></strong>
                                </td>
                            </tr>

                            <tr>
                                <td class="success" colspan=2>
                                  +
                                </td>  
                                <td class="success" colspan=2 align="center">
                                  <strong>PROP EFEC</strong>
                                </td>
                                <td class="info" colspan=2>
                                  <strong>$ <?php ; echo number_format($prop_efec, 0, ',', '.') ?></strong>
                                </td>
                            </tr>

                            <tr>
                                <td class="success" colspan=2>
                                  +
                                </td>  
                                <td class="success" colspan=2 align="center">
                                  <strong>EFEC CAJA</strong>
                                </td>
                                <td class="info" colspan=2>
                                  <strong>$ <?php ; echo number_format($total - ($prop_debito + $tarjeta) - $total_egreso - $prop_efec, 0, ',', '.') ?></strong>
                                </td>
                            </tr> -->



          
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>


               <!--  <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped">
                    <thead>
                      <tr>
                        <td colspan=8><strong>RESUMEN CIERRE</strong></td>
                      </tr>
                      <tr>
                          <td class="success" colspan=4 align="center">
                            <strong>Ventas Bruto</strong>
                          </td>
                          <td class="info" colspan=4>
                            <strong>$<?php echo number_format($total, 0, ',', '.') ?></strong>
                          </td>
                      </tr>
                      <tr>
                          <td class="success" colspan=4 align="center">
                            <strong>Efectivo</strong>
                          </td>
                          <td class="info" colspan=4>
                            <strong>$<?php echo number_format($efec, 0, ',', '.') ?></strong>
                          </td>
                      </tr>
                      <tr>
                          <td class="success" colspan=4 align="center">
                            <strong>Débito</strong>
                          </td>
                          <td class="info" colspan=4>
                            <strong>$<?php echo number_format($tarjeta, 0, ',', '.') ?></strong>
                          </td>
                      </tr>
                      <tr>
                          <td class="success" colspan=4 align="center">
                            <strong>Egresos</strong>
                          </td>
                          <td class="info" colspan=4>
                            <strong>$<?php echo number_format($total_egreso, 0, ',', '.') ?></strong>
                          </td>
                      </tr>
                      <tr>
                          <td class="success" colspan=4 align="center">
                          <strong>Propinas</strong>
                          </td>
                          <td class="info" colspan=4>
                          <strong>$<?php echo number_format($propina, 0 , ',', '.') ?></strong>
                          </td>
                      </tr>
                      <tr>
                          <td class="success" colspan=2>
                            +
                          </td>  
                          <td class="success" colspan=2 align="center">
                            <strong>PROPINA EFECTIVO</strong>
                          </td>
                          <td class="info" colspan=2>
                            <strong>$ <?php ; echo number_format($prop_efec, 0, ',', '.') ?></strong>
                          </td>
                      </tr>
                      <tr>
                          <td class="success" colspan=2>
                            +
                          </td>  
                          <td class="success" colspan=2 align="center">
                            <strong>PROPINA DEBITO</strong>
                          </td>
                          <td class="info" colspan=2>
                            <strong>$ <?php ; echo number_format($prop_debito, 0, ',', '.') ?></strong>
                          </td>
                      </tr>
                      <tr>
                          <td class="success" colspan=4 align="center">
                          <strong>Ventas Tot Productos</strong>
                          </td>
                          <td class="info" colspan=4>
                          <strong>$
                          <?php
                          $vtaprod = $total - $abono - $propina - $total_egreso; 
                          echo number_format($vtaprod, 0, ',', '.');
                          ?>
                          </strong>
                          </td>
                      </tr>
                      <tr>
                        <td class="success" colspan=2>
                          +
                        </td>  
                        <td class="success" colspan=2 align="center">
                          <strong>Ventas Prod</strong>
                          </td>
                          <td class="info" colspan=2>
                            <strong>$ <?php $vtaprod = $vtaprod - $totcig; echo number_format($vtaprod, 0, ',', '.') ?></strong>
                          </td>
                      </tr> 
                      <tr>
                        <td class="success" colspan=2>
                          +
                        </td>  
                        <td class="success" colspan=2 align="center">
                          <strong>Ventas Cig</strong>
                          </td>
                          <td class="info" colspan=2>
                            <strong>$<?php echo number_format($totcig, 0, ',', '.'); ?></strong>
                          </td>
                      </tr>  
                    </thead>
                  <tbody>
                  <tr></tr>
                </tbody>
              </table>
            </div>  -->


            <div class="table-responsive">
              <table class="table table-bordered table-hover table-striped">
                  <thead>
                      <tr>
                          <td colspan=8>
                          <strong>MESAS ELIMINADAS</strong>
                          </td>
                      </tr>
                      <tr>
                          <td>
                            <strong>FECHA</strong>
                          </td>
                          <td>
                            <strong>MESA</strong>
                          </td>
                          <td>
                            <strong>N ° INT</strong>
                          </td>
                          <td>
                            <strong>CAJERO</strong>
                          </td>
                          <th scope="col">
                            <strong>MOTIVO</strong>
                          </th>
                          <th scope="col">
                            <strong>ANULADO POR</strong>
                          </th>
                      </tr>
                      <?php
                        foreach ($eliminadas as $key => $elim) {
                          $venta_elim = get_venta_eliminada($elim['id']);
                      ?>
                      <tr>
                        <td class="info">
                          <?php echo $elim['fecha'] ?>
                        </td>
                        <td class="info">
                          <?php echo $mesa = get_mesa_by_id($elim['mesa_id']) ?>
                        </td>
                        <td class="info">
                          <?php echo $elim['id'] ?>
                        </td>
                        <td class="info">
                          <?php 
                            $mesero = get_usuario_id($elim['usuario_id']);
                            $nombre_mesero = $mesero['nombre']." ".$mesero['apellido'];
                            echo $nombre_mesero;
                           ?>
                        </td>  
                        <td class="info">
                          <?php echo $venta_elim['motivo'] ?>
                        </td> 
                        <td class="info">
                          <?php $usu =  get_usuario_id($venta_elim['usuario_id']);
                                $usu =  $usu['nombre']." ".$usu['apellido'];
                             echo $usu. ": ".$elim['fecha']." ".$elim['hora'];
                           ?>
                        </td> 
                      </tr>  
                      <?php
                      }
                      ?>
                  </thead>
                  <tbody>

                  <tr>
                    
                  </tr>

              </tbody>
             </table>
           </div> 

                <div class="container">
                  <div class="row">
                    <div class="col-md-6">
                      <a <?php if(isset($_GET['turno'])){ ?> href="../Impresiones/ImprimeReporte.php?cierre&Fechai=<?php echo $_GET['fechai'] ?>&Turno=<?php echo $turno ?>" target="_blank" <?php } ?>><button type="button" class="btn btn-success btn-block my-4">Reporte</button></a>
                    </div>
                    <div class="col-md-6">
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



  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">DETALLE PEDIDO</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <div id="contenido"></div>
            </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-warning" data-dismiss="modal">CERRAR</button>
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





</body>

</html>