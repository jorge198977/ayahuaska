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
    <?php include("top_nav.php"); ?>
    <!-- Header -->

    <?php
      if(isset($_GET['fechai'])){
        $ventas = get_ventas_entre_fechas($_GET['fechai'], $_GET['fechaf']);
      }
    ?>



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">VENTAS POR FECHA</h3>
                </div>

                <form name="ventas_brutas" method="get" action="ventas_brutas.php">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="input-group mb-4">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                          </div>
                          <input class="form-control" placeholder="Fecha Inicial" type="date" name="fechai" id="fechai">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="input-group mb-4">
                          <input class="form-control" placeholder="Fecha Final" type="date" name="fechaf" id="fechaf">
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
                  if(isset($_GET['fechai'])){
                ?>
                  
                  <div class="table-responsive">
                      <table  class="table table-flush">
                        <thead class="thead-light">
                          <tr>
                            <!-- <th scope="col">VER</th> -->
                            <th scope="col">FECHA</th>
                            <th scope="col">MESA</th>
                            <th scope="col">N° INT</th>
                            <th scope="col">CLIENTE</th>
                            <th scope="col">ATENDIDO POR</th>
                            <th scope="col">EFECTIVO</th>
                            <th scope="col">DEBITO</th>
                            <th scope="col">TRANSFER</th>
                            <th scope="col">FACTURA</th>
                            <th scope="col">CHEQUE</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $totcig = 0;
                            $propina = 0;
                            $prop_efec = 0;
                            $prop_debito = 0;
                            foreach ($ventas as $key => $cierre) {
                             $obtener_propina = get_venta_propina($cierre['venta_id'], $cierre['venta_pago_id']);
                              if($obtener_propina['monto'] != ""){
                                $propina = $propina + $obtener_propina['monto'];
                              }
                              $vtas_detalles = get_ventas_detalles_id($cierre['venta_id']);
                              foreach ($vtas_detalles as $key => $vta_detalle) {
                                $preparado = get_preparados_id($vta_detalle['preparado_id']);
                                if($preparado['PREPARADOS_FAMILIA'] == 132){
                                  $totcig = $totcig + ($preparado['PREPARADOS_PRECIO'] * $vta_detalle['cantidad'] );
                                } 
                              }
                           ?>   
                            <tr class="info">
                              <!-- <td>
                                <a href="../../boletas/movimientos/<?php echo $cierre['venta_id']."-".$cierre['venta_pago_id'] ?>.pdf" target="_blank">
                                  <button type="button" class="btn btn-default" aria-label="Left Align">
                                  <span class="far fa-eye" aria-hidden="true"></span>
                                  </button>
                                </a>
                              </td> -->
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
                              <?php 
                                    //echo number_format($cierre['valor'], 0, ',', '.'); 
                                    $total = $total + $cierre['valor'];
                                  ?>
                              

                              
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
                              <td>
                                <?php 
                                  //CHEQUE
                                  if($cierre['forma_pago_id'] == 6){
                                    if($obtener_propina['monto'] != ""){
                                      echo number_format($cierre['valor'] - $obtener_propina['monto'], 0, ',', '.'); 
                                      $cheque = $cheque + $cierre['valor'] - $obtener_propina['monto'];
                                      $prop_cheque = $prop_cheque + $obtener_propina['monto'];
                                    }
                                    else{
                                      echo number_format($cierre['valor'], 0, ',', '.'); 
                                      $cheque = $cheque + $cierre['valor'];
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
                            <td colspan=4> <?php echo "<strong>Turno ".$turno."</strong>"; ?></td> 
                            <td></td>
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
                            <td>
                              <?php
                              if($cheque == 0){
                                echo 0;
                              }
                              else{
                                echo number_format($cheque, 0, ',', '.');
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


                <br><br>
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped">
                    <thead>
                      <tr>
                        <td colspan=8><strong>RESUMEN CIERRE</strong></td>
                      </tr>
                      
                       <tr>
                                <td class="success" colspan=4 align="center">
                                   <h4><strong>TOTAL VENTAS</strong></h4>
                                </td>
                                <td class="info" colspan=4>
                                 <strong>$<?php echo number_format($efec + $tarjeta + $trasnferencia + $factura + $cheque , 0, ',', '.') ?></strong>
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
                                  <strong>Ventas Factura</strong>
                                </td>
                                <td class="info" colspan=4>
                                  <strong>$<?php echo number_format($factura, 0, ',', '.') ?></strong>
                                </td>
                            </tr>
                            <tr>
                                <td class="success" colspan=4 align="center">
                                  <strong>Ventas Cheque</strong>
                                </td>
                                <td class="info" colspan=4>
                                  <strong>$<?php echo number_format($cheque, 0, ',', '.') ?></strong>
                                </td>
                            </tr>
                           
                      
                    </thead>
                  <tbody>
                  <tr></tr>
                </tbody>
              </table>
            </div> 




                <div class="container">
                  <div class="row">
                    <div class="col-md-12">
                      <!-- <a <?php if(isset($_GET['fechai'])){ ?> href="../Impresiones/ImprimeReporte.php?verrepvtaturnofecha&Familia=<?php echo $_GET['familia'] ?>&Fechai=<?php echo $_GET['fechai'] ?>&Fechaf=<?php echo $_GET['fechaf'] ?>" target="_blank" <?php } ?>><button type="button" class="btn btn-success btn-block my-4">Reporte</button></a> -->
                    </div>
                    <div class="col-md-12">
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