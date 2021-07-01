<?php session_start();   ?>
<!DOCTYPE html>
<html>

<?php 
  include("header.php"); 
  include("../intranet/funciones/controlador.php");
  include("../intranet/funciones/seguridad.php");
  if(!validaringreso())
    header('Location:../index.php?NOCINICIA');
  date_default_timezone_set('America/Santiago');
  $horaactual = date("H:i:s");
  $fechahoy = date("Y-m-d");
  $total = 0;




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

  function muestra_modal(id)
  {
    $('#myModal5 #id_promocion2').val(id);   $.ajax({
           url: 'modal_propinas.php',
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
      $horaactual = date("H:i:s");
    $fechahoy = date("Y-m-d");
    //$fechahoy = date("2021-05-18");
    $total = 0;
    ?>
    <!-- End Logo Section -->
    <?php
      $turno = $_SESSION['turno']; 
      if($turno == 1){
        $horat21 = "09:00:00";
        $hotat22 = "23:59:59";
        $fecha21 = $fechahoy." ".$horat21;
        $fecha22 = $fechahoy." ".$hotat22;
        if($_POST['usuario'] == 0){
          $cierres = get_cierres_por_fecha_hora($fecha21, $fecha22);
          $eliminadas =  get_ventas_eliminadas_fecha($fecha21, $fecha22, -1);  
          $egresos = get_egresos_fecha($fecha21, $fecha22);
        }
        else{
          $cierres = get_cierres_por_fecha_hora_usuario($fecha21, $fecha22, $_POST['usuario']);
          $eliminadas =  get_ventas_eliminadas_fecha_usuario($fecha21, $fecha22, -1, $_POST['usuario']); 
          $egresos = get_egresos_fecha_usuario($fecha21, $fecha22, $_POST['usuario']);  
        }
                                      
      }
      else{
        $horario1 = "00:00:00";
        $horario2 = "08:00:00";
        $ret = dentro_de_horario($horario1, $horario2, $horaactual);
        if($ret == 1){
          $fecha = date('Y-m-j');
          $fechan = strtotime ( '-1 day' , strtotime ( $fecha ) ) ;
          $fechan = date ( 'Y-m-j' , $fechan ); 
          $hora221 = "00:00:00";
          $hora222 = "06:00:00";
          $horat21 = "17:00:01";
          $hotat22 = "23:59:59";
          $fecha21 = $fechan." ".$horat21;
          $fecha22 = $fechan." ".$hotat22;
          $fecha221 = $fechahoy." ".$hora221;
          $fecha222 = $fechahoy." ".$hora222;
        }
        else{
          $fecha = date('Y-m-j');
          $fechan = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
          $fechan = date ( 'Y-m-j' , $fechan ); 
          $hora221 = "00:00:00";
          $hora222 = "06:00:00";
          $horat21 = "17:00:01";
          $hotat22 = "23:59:59";
          $fecha21 = $fechahoy." ".$horat21;
          $fecha22 = $fechahoy." ".$hotat22;
          $fecha221 = $fechan." ".$hora221;
          $fecha222 = $fechan." ".$hora222;
        }

        if($_POST['usuario'] == 0){
          $cierres = get_cierres_por_fecha_hora2($fecha21, $fecha22, $fecha221, $fecha222);
          $eliminadas = get_ventas_eliminadas_fecha2($fecha21, $fecha22, $fecha221, $fecha222, -1);  
          $egresos = get_egresos_fecha2($fecha21, $fecha22, $fecha221, $fecha222);
        }
        else{
          $cierres = get_cierres_por_fecha_hora2_usuario($fecha21, $fecha22, $fecha221, $fecha222, $_POST['usuario']);
          $eliminadas = get_ventas_eliminadas_fecha2_usario($fecha21, $fecha22, $fecha221, $fecha222, -1);
          $egresos = get_egresos_fecha2_usuario($fecha21, $fecha22, $fecha221, $fecha222,  $_POST['usuario']);
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
                  <h3 class="mb-0">RENDICION DE CAJA - <?php echo "Entre ".$fecha21. " y ".$fecha22; ?></h3>
                </div>

                    <form name="frmfiltro" method="post" action="ver_cierre.php">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <div class="input-group mb-4">
                              <?php if(($_SESSION['tipo'] == 1) || ($_SESSION['tipo'] == 4)){ ?>
                                <select name="usuario" class="form-control input-lg">
                                  <option value="">Selecione usuario</option>
                                  <?php  
                                    $usuarios = get_all_usuarios();
                                    if(($_SESSION['tipo'] == 1) || ($_SESSION['tipo'] == 4)){
                                    ?>
                                      <option value="0" >
                                        TODOS
                                      </option>
                                    <?php
                                    }
                                    foreach ($usuarios as $key => $usuario) {
                                  ?>
                                    <option value="<?php echo $usuario['id'] ?>" >
                                      <?php echo $usuario['nombre']." ".$usuario['apellido'] ?>
                                    </option>
                                  <?php
                                  }
                                  ?>
                                </select>
                              <?php
                                }
                                else{
                              ?>
                                <select name="usuario" class="form-control input-lg" >
                                  <option value="<?php echo $_SESSION['id'] ?>"><?php echo $_SESSION['nombre']." ".$_SESSION['apellido'] ?></option>
                                </select>
                              <?php 
                                }
                              ?>
                              <div class="input-group-append">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <div class="input-group mb-4">
                              <button type="submit" class="btn btn-success btn-lg btn-block">VER CIERRE</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>


                    <?php
                      if(isset($_POST['usuario'])){
                    ?>
                     <div class="table-responsive">
                      <table id="example1" class="table table-flush">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">VER</th>
                            <th scope="col">FECHA</th>
                            <th scope="col">MESA</th>
                            <th scope="col">N° INT</th>
                            <th scope="col">CLIENTE</th>
                            <th scope="col">ATENDIDO POR</th>
                            <th scope="col">TOTAL</th>
                          
                            <th scope="col">PROPINA</th>
                            <th scope="col">EFECTIVO</th>
                            <th scope="col">DEBITO</th>
                            <th scope="col">TRANSFER</th>
                            <th scope="col">FACTURA</th>
                            <th scope="col">CHEQUE</th>
                            <th scope="col">CANJE</th>
                            <!-- <th scope="col">CREDITO</th>
                            <th scope="col">ABONOS</th> -->


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
                            $prop_cheque = 0;
                            $total = 0;
                            $efec = 0;
                            $tarjeta = 0;
                            $trasnferencia = 0;
                            $factura = 0;
                            $cheque = 0;
                            foreach ($cierres as $key => $cierre) {
                              $obtener_propina = get_venta_propina($cierre['venta_id'], $cierre['venta_pago_id']);
                              if((is_array($obtener_propina)) && ($obtener_propina['monto'] != "") ){
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
                                    <a href="../intranet/boletas/tickets/<?php echo $cierre['venta_id']?>-cover.pdf" target="_blank">
                                      <button type="button" class="btn btn-default" aria-label="Left Align">
                                      <span class="far fa-eye" aria-hidden="true"></span>
                                      </button>
                                    </a>
                                <?php
                                  }
                                  else if($cierre['mesa_id'] == '9999'){
                                ?>
                                    <a href="../boletas/tickets/<?php echo $cierre['venta_id']?>-directo.pdf" target="_blank">
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
                              <td>
                                <?php 
                                  if($cierre['mesa_id'] == '8888'){
                                    echo "Venta Entrada";
                                  }
                                  else if($cierre['mesa_id'] == '9999'){
                                    echo "Venta Caja";
                                  }
                                  else{
                                    echo $mesa = get_mesa_by_id($cierre['mesa_id']);   
                                  }
                                  
                                ?>
                              </td>
                              <td><?php echo $cierre['venta_id'] ?></td>
                              <td><?php $socio = get_nombre_socio2(get_vta_socio_id($cierre['venta_id'])); echo $socio ?></td>
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

                              <td><?php 
                                    if((is_array($obtener_propina)) && ($obtener_propina['monto'] != "") ){
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
                                    if((is_array($obtener_propina)) && ($obtener_propina['monto'] != "") ){
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
                                    if((is_array($obtener_propina)) && ($obtener_propina['monto'] != "") ){
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
                                    if((is_array($obtener_propina)) && ($obtener_propina['monto'] != "") ){
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
                                    if((is_array($obtener_propina)) && ($obtener_propina['monto'] != "") ){
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
                                    if((is_array($obtener_propina)) && ($obtener_propina['monto'] != "") ){
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
                              <td>
                                <?php 
                                  //CANJE
                                  if($cierre['canje'] == 1){
                                    echo "SI";
                                  }
                                  else{
                                    echo "NO";
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
                            <td>
                              <?php
                                $pro = $prop_efec + $prop_debito + $prop_transferencia + $prop_factura + $prop_cheque;
                               // echo "EFE->".$prop_efec.", DEB->".$prop_debito.", trna->".$prop_transferencia.", fac->".$prop_factura.", che->".$prop_cheque."<br>";
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
                                  <strong>Total Ventas menos propina</strong>
                                </td>
                                <td class="info" colspan=4>
                                  <strong>$<?php echo number_format($total - $propina, 0, ',', '.') ?></strong>
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
                                  <strong>Ventas Cheque</strong>
                                </td>
                                <td class="info" colspan=4>
                                  <strong>$<?php echo number_format($cheque, 0, ',', '.') ?></strong>
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
                                  <strong>Propina Cheque</strong>
                                </td>
                                <td class="info" colspan=4>
                                  <strong>$<?php echo number_format($prop_cheque, 0, ',', '.') ?></strong>
                                </td>
                            </tr>
                            <tr>
                                <td class="success" colspan=4 align="center">
                                  <strong>Propina Factura</strong>
                                </td>
                                <td class="info" colspan=4>
                                  <strong>$<?php echo number_format($prop_factura, 0, ',', '.') ?></strong>
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
                                 <strong>$<?php echo number_format($efec - $total_egreso  - $prop_transferencia - $prop_debito - $prop_cheque, 0, ',', '.') ?></strong>
                                </td>
                            </tr>



          
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>

  

                      <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                          <thead class="thead-light">
                              <tr>
                                  <th scope="col" colspan=8>
                                  <strong>MESAS ELIMINADAS</strong>
                                  </th>
                              </tr>
                              <tr>
                                  <th scope="col" >
                                    <strong>FECHA</strong>
                                  </th>
                                  <th scope="col">
                                    <strong>MESA</strong>
                                  </th>
                                  <th scope="col">
                                    <strong>N ° INT</strong>
                                  </th>
                                  <th scope="col">
                                    <strong>CAJERO</strong>
                                  </th>
                                  <th scope="col">
                                    <strong>MOTIVO</strong>
                                  </th>
                                  <th scope="col">
                                    <strong>ANULADO POR</strong>
                                  </th>
                              </tr>
                              <?php
                                foreach ($eliminadas as $key => $eliminada) {
                                  $venta_elim = get_venta_eliminada($eliminada['id']);
                              ?>
                              <tr>
                                <td class="info">
                                  <?php echo $eliminada['fecha'] ?>
                                </td>
                                <td class="info">
                                  <?php echo $mesa = get_mesa_by_id($eliminada['mesa_id']); ?>
                                </td>
                                <td class="info">
                                  <?php echo $eliminada['id'] ?>
                                </td>
                                <td class="info">
                                  <?php 
                                    $mesero = get_usuario_id($eliminada['usuario_id']);
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
                                     echo $usu. ": ".$eliminada['fecha']." ".$eliminada['hora'];
                                   ?>
                                </td> 
                              </tr>  
                              <?php
                              }
                              ?>
                            </thead>
                            <tbody>
                              <tr></tr>
                            </tbody>
                          </table>
                        </div>

                    </div>
                    <?php
                    }
                    ?>
                   </div>
                  </div>


                <div class="container">
                  <div class="row">
                    <?php
                    if(isset($_POST['usuario'])){
                      if(($_SESSION['tipo'] == 1) || ($_SESSION['tipo'] == 2) || ($_SESSION['tipo'] == 3) ){
                    ?>
                      <div class="col">
                        <button type="button" onclick='muestra_modal(0)' class="btn btn-warning btn-block my-4">Mostrar propinas</button>
                      </div>
                    <?php
                      }
                    }
                    ?>
                    <div class="col">
                      <a href="../inicio.php"><button type="button" class="btn btn-danger btn-block my-4">Volver</button></a>
                    </div>
                  </div>
                </div>


              </div>

        </div>
      </div>
    </div>
  </div>



  <div id="myModal5" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <form  name="miform" id="form1" method="post" action="../intranet/funciones/procesamoderador2.php" >
          <div class="modal-header">
            <h4 class="modal-title">PROPINAS</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <input type="hidden" name="id_promocion" id="id_promocion2">
                <div id="contenido2"></div>
            </div>
            </div>
            <div class="modal-footer">
              <input type="hidden" name="entrega_propina">
              <button type="submit" class="btn btn-success">Entregar</button>
              <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
            </div>
          </form>
        </div>
      </div>
  </div>



  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <form  name="miform" id="form1" method="post" action="../../intranet/funciones/procesamoderador2.php" >
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

</html>
