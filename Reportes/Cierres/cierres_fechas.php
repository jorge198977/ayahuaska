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
      $anio_actual = date("Y");
      if(isset($_GET['anio'])){
        $mes = $_GET['mes'];
        $anio = $_GET['anio'];
        $fech = $anio."-".$mes."%";
        $ventas = get_ventas_fecha($fech);
        $eliminadas =  get_ventas_eliminadas_by_fecha($fech, -1);
        $egresos = get_egresos_by_fecha($fech);
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

                <form name="frmfiltro" method="get" action="cierres_fechas.php">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="input-group mb-4">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                          </div>
                          <select class="form-control" name="mes">
                            <option value="">Seleccione Mes</option>
                            <option value="01">ENERO</option>
                            <option value="02">FEBRERO</option>
                            <option value="03">MARZO</option>
                            <option value="04">ABRIL</option>
                            <option value="05">MAYO</option>
                            <option value="06">JUNIO</option>
                            <option value="07">JULIO</option>
                            <option value="08">AGOSTO</option>
                            <option value="09">SEPTIEMBRE</option>
                            <option value="10">OCTUBRE</option>
                            <option value="11">NOVIEMBRE</option>
                            <option value="12">DICIEMBRE</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="input-group mb-4">
                          <select class="form-control" name="anio" required>
                            <option value="">Seleccione año</option>
                            <?php
                              for($i = 2018; $i <= $anio_actual; $i++){
                            ?>
                              <option value="<?php echo $i ?>"><?php echo $i ?></option>  
                            <?php
                              }
                            ?>
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
                  if(isset($_GET['mes'])){
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
                            foreach ($ventas as $key => $cierre) {
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
                              <td>
                                <button type="button" onclick='muestra_modal_detalle(<?php echo $cierre['venta_id'] ?>, <?php echo $cierre['forma_pago_id'] ?>, <?php echo $cierre['venta_pago_id'] ?>)' class="btn btn-default" aria-label="Left Align" data-toggle="modal" data-toggle="modal" data-target="modal" data-whatever="@mdo">
                                    <span class="fas fa-eye" aria-hidden="true"></span>
                                    </button>
                              </td>
                              <td><?php echo $cierre['fecha_full'] ?></td>
                              <td><?php 
                                if($cierre['mesa_id'] == '8888'){
                                    echo "Venta Entrada";
                                  }
                                  else{
                                    echo $mesa = get_mesa_by_id($cierre['mesa_id']);   
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
                         <!--    <tr>
                                <td class="success" colspan=4 align="center">
                                  <strong>Venta Cigarrillos</strong>
                                </td>
                                <td class="info" colspan=4>
                                  <strong>$<?php echo number_format($totcig, 0, ',', '.') ?></strong>
                                </td>
                            </tr> -->
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

<!-- 
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped">
                    <thead>
                      <tr>
                        <td colspan=8><strong>RESUMEN CIERRE</strong></td>
                      </tr>
                      <tr>
                          <td class="success" colspan=4>
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
                          <td class="success" colspan=4>
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
                          <td class="success" colspan=2>
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
                          <td class="success" colspan=2>
                            <strong>PROPINA DEBITO</strong>
                          </td>
                          <td class="info" colspan=2>
                            <strong>$ <?php ; echo number_format($prop_debito, 0, ',', '.') ?></strong>
                          </td>
                      </tr>
                      <tr>
                          <td class="success" colspan=4>
                          <strong>Ventas Tot Productos</strong>
                          </td>
                          <td class="info" colspan=4>
                          <strong>$
                          <?php
                          $vtaprod = $total - $abono - $propina - $propina; 
                          echo number_format($vtaprod, 0, ',', '.');
                          ?>
                          </strong>
                          </td>
                      </tr>
                      <tr>
                        <td class="success" colspan=2>
                          +
                        </td>  
                        <td class="success" colspan=2>
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
                        <td class="success" colspan=2>
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
                      <a <?php if(isset($_GET['mes'])){ ?> href="../Impresiones/ImprimeReporte.php?ventas_mensuales&Fecha=<?php echo $fech ?>" target="_blank" <?php } ?>><button type="button" class="btn btn-success btn-block my-4">Reporte</button></a>
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