<?php session_start();   ?>
<!DOCTYPE html>
<html>
<?php 
  include("header.php"); 
  include("../intranet/funciones/controlador.php");

  include("../intranet/funciones/seguridad.php");
  if(!validaringreso())
    header('Location:../index.php?NOCINICIA');
?>

<script language="javascript" src="../intranet/js/jquery-1.2.6.js"></script>
<script language="javascript">
$(document).ready(function(){
   $("#nomcli").change(function () {
           $("#nomcli option:selected").each(function () {
            id_nombre = $(this).val();
            $.post("cupo_cliente.php", { id_nombre: id_nombre }, function(data){
                $("#cupcli").html(data);
            });            
        });
   })
});
$(document).ready(function(){
  var $montopagado = $('#monto_pagado');
  var $vuelto = $('#vuelto');
  var $totpag = $('#totalapagar');
  var $totcpropina = $('#totalconpropin');
  var $propinamonto = $('#propina');
  
  $montopagado.on('keyup', function(e) {
  
  if($propinamonto.val() == ""){
    $propinamonto.val(0);
    $totcpropina.val(
        $totpag.val()
      );
  }
  
  $vuelto.val(
          Math.round(
             parseInt($montopagado.val()) - parseInt($totcpropina.val()) 
          
          ) 

    );
    if(parseInt($montopagado.val()) >= parseInt($totcpropina.val())){
      frmcerrar.btnpagarpedido.disabled = false;
    }
  });



  $propinamonto.on('keyup', function(e) {
    $totcpropina.val(
          Math.round(
             parseInt($totpag.val()) + parseInt($propinamonto.val()) 
          
          ) 

    );
    $vuelto.val(
          Math.round(
             parseInt($montopagado.val()) - parseInt($totcpropina.val()) 
          
          ) 

    );
  });
 
});
</script>

<script type="text/javascript">
  
  function mostrarocultocliente(){
    element = document.getElementById("contentcliente"); 
    if(fpago.value == 3){
      element.style.display='block';
    }
    else{
      element.style.display='none';
      //rutcli.value = "";
      nomcli.value = "1";
      cupcli.value = "";

    }
  }

  function mostrarocultocliente_temporal(){
    element = document.getElementById("contentcliente_temporal"); 
    if(fpago_temporal.value == 3){
      element.style.display='block';
    }
    else{
      element.style.display='none';
      //rutcli.value = "";
      nomcli_temporal.value = "1";
      nomcli_temporal.value = "";

    }
  }

  function soloNumeros(e) 
  { 
    var key = window.Event ? e.which : e.keyCode 
    return ((key >= 48 && key <= 57) || (key==8)) 
  }

  var statSend = false;
  function validar(){

    if (!statSend) {
        statSend = true;
        return true;
    } else {
        alert("Enviando datos...no volver a presionar el botón");
        return false;
    }


    if(document.frmcerrar.ousu.value == ""){
      alert("Sesión Expirada debe volver a ingresar...");
      location.replace("../index.php")
      return false;
    }

    if((fpago.value == 3) && (nomcli.value == "")){
      alert("Debe ingresar el cliente cuenta corriente");
      return false;
    }

    if(fpago.value == ""){
      alert("Debe ingresar forma de pago");
      return false;
    }

    if(propina.value == ""){
      alert("Debe ingresar monto de propina");
      document.propina_temporal.focus();
      return false;
    }

    if(monto_pagado.value == ""){
      alert("Debe ingresar monto pagado");
      document.frmcerrar.monto_pagado.focus();
      return false;
    } 

    if((parseInt(cupcli.value) < parseInt(totalconpropin.value)) && (nomcli.value != "")){
      alert("El cliente no tiene cupo suficiente");
      return false;
    } 

    return true;
  }


  function muestra_modal_pagado(venta_id, venta_pago_id)
  {
    $('#myModalPagado #id_promocion2').val(venta_id);   $.ajax({
           url: 'modal_pagado.php',
           type: 'POST',
           data:{venta_id:venta_id, venta_pago_id:venta_pago_id},
           success: function(data){
                $('#contenidoPagado').html(data);
                $('#myModalPagado').modal('show');
           }
       });
  }

  function muestra_modal_cambio(preparado_id, cantidad, mov, npedido)
  {
    $('#myModalCambio #id_promocion2').val(preparado_id);   $.ajax({
           url: 'modal_cambio.php',
           type: 'POST',
           data:{preparado_id:preparado_id, cantidad:cantidad, mov:mov, npedido:npedido},
           success: function(data){
                $('#contenidoCambio').html(data);
                $('#myModalCambio').modal('show');
           }
       });
  }

  function muestra_modal_temporal(mov, mesa_id, total)
  {
    $('#myModalTemporal #id_promocion2').val(mov);   $.ajax({
           url: 'modal_temporal.php',
           type: 'POST',
           data:{mov:mov, mesa_id:mesa_id, totalventa:total},
           success: function(data){
                $('#contenidoTemporal').html(data);
                $('#myModalTemporal').modal('show');
           }
       });
  }

  function valida_cambio(){
    if(document.form_cambio.cantidad_nueva.value > document.form_cambio.cantidad_antes.value){
      alert("Cantidad a cambiar no puede ser mayor a la cantidad de la mesa");
      return false;
    }
    return true;
  }

  var statSend = false;

  function valida_temporal(){

    if (!statSend) {
        statSend = true;
        return true;
    } else {
        alert("Enviando datos...no volver a presionar el botón");
        return false;
    }

    if(parseInt(document.form_temporal.monto_pago_temporal.value) < parseInt(document.form_temporal.totalconpropina_temporal.value)){
      alert("Monto pagado no puede ser menor al total");
      document.monto_pagado.focus();
      return false;
    }
    if((parseInt(cupcli_temporal.value) < (ototaltemporal.value)) && (nomcli_temporal.value != "")){
      alert("El cliente no tiene cupo suficiente");
      return false;
    } 
    if(fpago_temporal.value == ""){
      alert("Debe ingresar forma de pago");
      return false;
    }
    if(propina_temporal.value == ""){
      alert("Debe ingresar monto de propina");
      document.propina_temporal.focus();
      return false;
    }

    if(monto_pago_temporal.value == ""){
      alert("Debe ingresar monto pagado");
      document.monto_pagado.focus();
      return false;
    } 
    
    return true;
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
      $venta = get_venta_id($_GET['Mov']);
      $ventas_detalles = get_ventas_detalles_id($_GET['Mov']);
      $venta_socio = get_vta_socio_id($_GET['Mov']);
      $mesa = get_mesa_by_id($venta['mesa_id']);
      $total = 0;
      $sumatoria_descuento = 0;

      $ventas_pagos = get_pagos_actuales($_GET['Mov']);
    ?>

    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">Mesa: <?php echo $mesa; ?></h3>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">PRODUCTO</th>
                        <th scope="col">FAMILIA</th>
                        <th scope="col">CANTIDAD</th>
                        <th scope="col">PRECIO U</th>
                        <th scope="col">DESCUENTO</th>
                        <th scope="col">SUBTOTAL</th>
                        <th scope="col">SEPARAR</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        foreach ($ventas_detalles as $key => $venta_detalle) {
                          $cantidad_temporal = get_cantidad_venta_temporal($_GET['Mov'], $venta_detalle['preparado_id'], 0, $venta_detalle['npedido']);
                          $desc = 0;
                          //echo "COD->".$venta_detalle['preparado_id'].", CANT TEMP->".$cantidad_temporal.", CANT VTA->".$venta_detalle['cantidad']."<br>";
                          if($cantidad_temporal == ""){
                            $cantidad_temporal = 0;
                          }
                          if($cantidad_temporal < $venta_detalle['cantidad']){
                          
                      ?> 
                          <tr>
                            <td> 
                              <?php
                                $preparado = get_preparados_id($venta_detalle['preparado_id']);
                                echo $preparado['PREPARADOS_NOMBRE'];                      
                              ?>
                            </td>
                            <td><?php echo get_familia($preparado['PREPARADOS_FAMILIA']) ?></td>
                            <td>
                              <?php echo $venta_detalle['cantidad'] - $cantidad_temporal ?>
                            </td>
                            <td>
                              <?php 
                                echo "$".number_format($preparado['PREPARADOS_PRECIO'], 0, ',', '.'); 
                                $total = $total + ($preparado['PREPARADOS_PRECIO'] * ($venta_detalle['cantidad'] -$cantidad_temporal));
                              ?> 
                              </td>
                              <td>
                                <?php
                                  $descuento_familia = get_descuento_familia_by_familia_id($preparado['PREPARADOS_FAMILIA']);
                                  if($descuento_familia['descuento'] != ""){
                                    $dentro_horario = dentro_de_horario($descuento_familia['hora_inicial'], $descuento_familia['hora_final'], $venta_detalle['hora']);
                                    if($dentro_horario == 1){
                                      $desc = $descuento_familia['descuento'] * ($venta_detalle['cantidad'] - $cantidad_temporal);
                                      $sumatoria_descuento = $sumatoria_descuento + intval($desc);
                                      echo number_format($desc, 0, ',', '.');
                                    }
                                    else{
                                      echo 0;
                                    }
                                  }
                                  else{
                                    echo 0;
                                  }
                                  
                                ?>
                              </td>
                              <td>
                                <?php
                                  echo "$".number_format(((($preparado['PREPARADOS_PRECIO'])*($venta_detalle['cantidad'] - $cantidad_temporal)) - $desc), 0, ',', '.');
                                ?>
                              </td>
                              <td>
                                <button type="button" onclick='muestra_modal_cambio(<?php echo $venta_detalle['preparado_id'] ?>, <?php echo $venta_detalle['cantidad'] - $cantidad_temporal ?>, <?php echo $_GET['Mov'] ?>, <?php echo $venta_detalle['npedido'] ?>)' class="btn btn-default" aria-label="Left Align" data-toggle="modal" data-toggle="modal" data-target="modal" data-whatever="@mdo">
                                  <span class="fas fa-arrows-alt-h" aria-hidden="true"></span>
                                </button>
                              </td>
                          </tr>
                      <?php
                          }
                        }
                      ?>
                    </tbody>
                  </table>

                  <?php

                    $obtener_descuento = get_descuento_venta($_GET['Mov']);
                    if($obtener_descuento != ""){
                      $descu = $obtener_descuento;
                    }
                    else{
                      $descu = 0;
                    }

                    $descuento_puntos = get_descuento_puntos($_GET['Mov']);
                  ?>

                  <?php
                    //SI EXISTE PAGOS TEMPORALES MUESTRA BOTON
                      $existe_pago_temp = hay_pago_temporal($_GET['Mov'], 0);
                      if($existe_pago_temp == true){
                        $total_Venta =  $total-$descu - $sumatoria_descuento - $descuento_puntos;
                      ?>

                        <div class="col-md-12">
                          <div class="form-group">
                            <button type="button" onclick='muestra_modal_temporal(<?php echo $_GET['Mov'] ?>, <?php echo $venta['mesa_id'] ?>, <?php echo $total_Venta ?>)' class="btn btn-info btn-block my-4">VER PRODUCTOS</button>
                          </div>
                        </div>

                      <?php
                      }
                    //FIN SI EXISTE PAGOS TEMPORALES MUESTRA BOTON

                  ?>

                  
                  <hr>
                  <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col" colspan="4"><strong>PAGOS REALIZADOS</strong></th>
                      </tr>
                    </thead>
                      <tbody>
                      <?php 
                        $total_pagado = 0;
                        foreach ($ventas_pagos as $key => $vta_pago) { 
                      ?>
                        <tr>
                          <td><strong><h3><?php echo get_forma_pago_id($vta_pago['forma_pago_id']) ?></h3></strong></td>
                          <td><strong><h3><?php echo number_format($vta_pago['valor'], 0, ',', '.') ?></h3></strong></td>
                          <td><strong><h3><?php echo fecha_bd_normal($vta_pago['fecha'])." ".$vta_pago['hora'] ?></h3></strong></td>
                          <td align="center">
                            <button type="button" onclick='muestra_modal_pagado(<?php echo $_GET['Mov'] ?>, <?php echo $vta_pago['id'] ?>)' class="btn btn-default" aria-label="Left Align" data-toggle="modal" data-toggle="modal" data-target="modal" data-whatever="@mdo">
                                  <span class="fas fa-book-reader" aria-hidden="true"></span>
                            </button>
                            <a href="reimprimir_pedido_pagado.php?mov=<?php echo $_GET['Mov'] ?>&vta_pago=<?php echo $vta_pago['id'] ?>" onclick="block()">
                              <button type="button" name="imprimepedido" id="imprimepedido" class="btn btn-success" value="imprimepedido" ><span class="fas fa-print " aria-hidden="true"></span></button>
                            </a>
                          </td>
                        </tr>
                      <?php 
                          $total_pagado = $total_pagado + $vta_pago['valor'];
                        } 
                      ?>
                      </tbody>
                  </table>
                  </div>
                  <hr>
                  <div class="container">
                    <div class="row">
                      <div class="col-sm">
                        <span>
                          <label>Total</label><input class="form-control " type="text" 
                         disabled="false" value="<?php echo number_format($total, 0, ',', '.')  ?>" >
                        </span>
                      </div>
                      <div class="col-sm">
                        <span>
                          <label>Desc</label><input class="form-control input-lg" name="des" id="des" type="text" 
                         disabled="true" value="<?php echo number_format($descu, 0, ',', '.') ?>" >
                        </span>
                      </div>
                      <div class="col-sm">
                        <span>
                          <label>Desc Espec</label><input class="form-control input-lg" name="deses" id="deses" type="text" 
                         disabled="true" value="<?php echo number_format($sumatoria_descuento, 0, ',', '.') ?>" >
                        </span>
                      </div>
                      <div class="col-sm">
                        <span>
                          <label>Desc Pts</label><input class="form-control input-lg" name="deses" id="deses" type="text" 
                         disabled="true" value="<?php echo number_format($descuento_puntos, 0, ',', '.') ?>" >
                        </span>
                      </div>
                      <div class="panel-body">
                        <div class="col-lg-12 text-center">
                          <label>Total - Descuento</label><input class="form-control input-lg" name="totaldes" id="totaldes" type="text" 
                             disabled="true" value="<?php echo number_format(($total-$descu - $sumatoria_descuento - $descuento_puntos), 0, ',', '.') ?>" >
                             <input  name="ototaldes" id="ototaldes" type="hidden" 
                             value="<?php echo $total-$descu - $sumatoria_descuento - $descuento_puntos ?>" >
                             <input type="hidden" name="totalapagar" id="totalapagar" value="<?php echo $total-$descu - $sumatoria_descuento - $descuento_puntos ?>">
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="container">
                    <div class="row">
                      <div class="col-sm">
                        <span>
                          <label>PENDIENTE A PAGAR</label><input class="form-control input-lg" name="to" id="to" type="text" 
                         disabled="true" value="<?php echo number_format($total-$descu - $sumatoria_descuento - $descuento_puntos, 0, ',', '.') ?>" >
                         <input  name="ototalpendiente" id="ototalpendiente" type="hidden" 
                             value="<?php echo $total-$descu - $sumatoria_descuento - $descuento_puntos  ?>" >
                        </span>
                      </div>
                    </div>
                  </div>
                  

                </div>

                <hr>
                <?php
                  //SI EXISTE PENDIENTES POR PAGAR NO MOSTRAR PAGO TOTAL
                  if(!hay_pago_temporal($_GET['Mov'], 0)){
                ?>

                <div class="container">
                  <div class="row">
                    <div class="col-sm">
                        <center><h2><i class="glyphicon glyphicon-search"></i> 
                          Detalle Pago
                        </h2> </center>
                        <form method="post" name="frmcerrar" action="../intranet/funciones/procesapedido2.php">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <select class="form-control input-lg" name="fpago" id="fpago" onchange="javascript:mostrarocultocliente()"> 
                                  <option value=""> Ingrese forma de pago</option>
                                  <?php 
                                    $formas_pagos = get_all_formas_pagos();
                                    foreach ($formas_pagos as $key => $forma_pago) { 
                                  ?>
                                    <option value="<?php echo $forma_pago['id'] ?>"><?php echo $forma_pago['descripcion'] ?></option>
                                  <?php } ?>
                                </select> 
                              </div>
                            </div>
                          </div>

                          <div id="contentcliente" style="display: none;">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <select class="form-control input-lg" name="nomcli" id="nomcli"> 
                                    <option value=""> Nombre</option>
                                    <?php
                                      $clientes = get_all_clientes();
                                      foreach ($clientes as $key => $cliente) {
                                    ?>
                                      <option value="<?php echo $cliente['id'] ?>"> <?php echo $cliente['nombre'] ?></option>
                                    <?php
                                    }
                                    ?>
                                  </select> 
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control input-lg" name="cupcli" id="cupcli"> 
                                      <option value=""> Cupo disponible</option>
                                    </select>
                                </div>
                              </div>
                            </div>
                          </div>


                          <?php
                            $max_boleta = get_boleta_actual();
                            if($max_boleta == ""){
                              $max_boleta = 1;
                            }
                            else{
                              $max_boleta = $max_boleta + 1;
                            }
                          ?>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <div class="input-group input-group-alternative mb-4">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                  </div>
                                  <input class="form-control form-control-alternative" name="boleta" id="boleta" type="text" placeholder="Ingrese n° boleta" value="<?php echo ($max_boleta) ?>" onKeyPress="return soloNumeros(event)">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <?php $propina = (($total-$descu-$sumatoria_descuento-$descuento_puntos) * 0.1); ?>
                            <div class="col-md-6">
                              <div class="form-group">
                                <input type="text" placeholder="PROPINA(Sugerida 10% = <?php echo number_format($propina, 0, ',', '.') ?>)" name="propina" id="propina" class="form-control" onKeyPress="return soloNumeros(event)" required />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <input type="text" name="totalconpropin" id="totalconpropin" class="form-control" disabled />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group has-success">
                                <input type="text" placeholder="Ingrese Monto Pagado" name="monto_pagado" id="monto_pagado" class="form-control form-control-alternative is-valid" onKeyPress="return soloNumeros(event)" />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <input type="text" name="vuelto" id="vuelto" class="form-control form-control-alternative is-valid" disabled />
                              </div>
                            </div>
                            
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">

                                <input type="hidden" name="ousu" id="ousu" value="<?php echo $_SESSION['id'] ?>">  
                                <input type="hidden" name="omov" value="<?php echo $_GET['Mov'] ?>">
                                <input type="hidden" name="omesa" value="<?php echo $venta['mesa_id'] ?>">
                                <input type="hidden" name="ototal" value="<?php echo $total ?>">
                                <input type="hidden" name="odescuento" value="<?php echo $descu ?>">
                                <input type="hidden" name="odescuentoespecial" value="<?php echo $sumatoria_descuento ?>">
                                <input type="hidden" name="odescuentopuntos" value="<?php echo $descuento_puntos ?>">
                                <input type="hidden" name="ototalmenosdescu" value="<?php echo $total-$descu - $sumatoria_descuento - $descuento_puntos ?>">
                                <input type="hidden" name="ototalpendiente2" id="ototalpendiente2" value="<?php echo $total-$descu - $sumatoria_descuento - $descuento_puntos - $total_pagado ?>" >
                                <!-- <button type="submit" name="btnpagarpedido" id="btnpagarpedido" disabled="true" onClick="return validar()" class="btn btn-lg btn-success btn-block my-4">PAGAR</button> -->
                                <!-- <button type="submit" name="btnpagarpedido" id="btnpagarpedido" disabled="true" class="btn btn-lg btn-success btn-block my-4" onclick="return (confirmaPago(<?php echo $_GET['Mov'] ?>, ));" disabled="true">PAGAR</button> -->
                                <a onclick="return (confirmaPago(<?php echo $_GET['Mov'] ?>));">
                                    <button type="button" name="btnpagarpedido" id="btnpagarpedido" disabled="true" class="btn btn-lg btn-success btn-block my-4">
                                    PAGAR
                                    </button>
                                </a>
                              </div>
                            </div>
                            
                          </div>
                        </form>
                    </div>
                  </div>
                </div>

                <?php
                }
                ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <a href="ver_pedido.php"><button type="button" class="btn btn-danger btn-block my-4">Volver</button></a>
                    </div>
                  </div>
                </div>

            </div>
          </div>


          <div id="myModalCambio" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
              <!-- Modal content-->
              <div class="modal-content">
                <form  name="form_cambio" id="form_cambio" method="post" action="../intranet/funciones/procesamoderador2.php" >
                  <div class="modal-header">
                    <h4 class="modal-title">SEPARAR</h4>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                        <div id="contenidoCambio"></div>
                    </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" onClick="return valida_cambio()" class="btn btn-success">Cambiar</button>
                      <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                    </div>
                  </form>
                </div>
              </div>
          </div>

          <div id="myModalTemporal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
              <!-- Modal content-->
              <div class="modal-content">
                <form  name="form_temporal" id="form_temporal" method="post" action="../intranet/funciones/procesamoderador2.php" >
                  <div class="modal-header">
                    <h4 class="modal-title">PRODUCTOS</h4>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                        <div id="contenidoTemporal"></div>
                    </div>
                    </div>
                    <div class="modal-footer">
                      <!-- <button type="submit" name="btn_pagar_temporal" id="btn_pagar_temporal" onClick="return valida_temporal()" class="btn btn-success" disabled>PAGAR</button> -->
                      <a onclick="return (confirmaPagoTemporal());">
                          <button type="button" name="btn_pagar_temporal" id="btn_pagar_temporal" disabled="true" class="btn btn-lg btn-success">
                          PAGAR
                          </button>
                      </a>
                      
                      <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                    </div>
                  </form>
                </div>
              </div>
          </div>


          <div id="myModalPagado" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
              <!-- Modal content-->
              <div class="modal-content">
                <form  name="form_pagados" id="form_pagados" method="post">
                  <div class="modal-header">
                    <h4 class="modal-title">PRODUCTOS PAGADOS</h4>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                        <div id="contenidoPagado"></div>
                    </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                    </div>
                  </form>
                </div>
              </div>
          </div>

        </div>
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
    function confirmaPago(id){
        var fp = "";
        frmcerrar.btnpagarpedido.disabled = true;
        if(frmcerrar.fpago.value == 1){ fp = "Efectivo";}if(frmcerrar.fpago.value == 3){ fp = "Cuenta Corriente";}if(frmcerrar.fpago.value == 4){ fp = "Débito";}
        bootbox.confirm({
        message: "Se va a cerrar Pedido Nro <strong> "+id+" </strong> con los siguientes datos:  <br> Forma de Pago: <strong> "+fp+" </strong> <br> Total:  <strong>"+frmcerrar.ototalmenosdescu.value+" </strong> <br> Propina: <strong> "+frmcerrar.propina.value+" </strong> <br> Monto Pagado: <strong> "+frmcerrar.monto_pagado.value+" </strong> <br> Vuelto: <strong> "+frmcerrar.vuelto.value+" </strong> <br> ¿Datos ingresados son correctos?",
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
              location.href = "../intranet/funciones/procesapedido2.php?btnpagarpedido&ototalmenosdescu="+frmcerrar.ototalmenosdescu.value+"&propina="+frmcerrar.propina.value+"&omov="+id+"&omesa="+frmcerrar.omesa.value+"&monto_pagado="+frmcerrar.monto_pagado.value+"&fpago="+frmcerrar.fpago.value+"&nomcli="+frmcerrar.nomcli.value+"&boleta="+frmcerrar.boleta.value+"&descuento="+frmcerrar.odescuento.value+"&descuento_especial="+frmcerrar.odescuentoespecial.value+"&descuento_puntos="+frmcerrar.odescuentopuntos.value+""; 
            }
            else{
              
            }
        }
    });
    }


    function confirmaPagoTemporal(){
        var fp = "";
        form_temporal.btn_pagar_temporal.disabled = true;
        if(form_temporal.fpago_temporal.value == 1){ fp = "Efectivo";}if(form_temporal.fpago_temporal.value == 3){ fp = "Cuenta Corriente";}if(form_temporal.fpago_temporal.value == 4){ fp = "Débito";}
        bootbox.confirm({
        message: "Se va a cerrar Pedido Nro <strong> "+form_temporal.oidpagotemporal.value+" </strong> con los siguientes datos:  <br> Forma de Pago: <strong> "+fp+" </strong> <br> Total:  <strong>"+form_temporal.ototaltemporal.value+" </strong> <br> Propina: <strong> "+form_temporal.propina_temporal.value+" </strong> <br> Monto Pagado: <strong> "+form_temporal.monto_pago_temporal.value+" </strong> <br> Vuelto: <strong> "+form_temporal.vuelto_temporal.value+" </strong> <br> ¿Datos ingresados son correctos?",
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
              location.href = "../intranet/funciones/procesamoderador2.php?oidpagotemporal="+form_temporal.oidpagotemporal.value+"&ototal="+form_temporal.ototal.value+"&omesa_id="+form_temporal.omesa_id.value+"&ototaltemporal="+form_temporal.ototaltemporal.value+"&propina_temporal="+form_temporal.propina_temporal.value+"&fpago_temporal="+form_temporal.fpago_temporal.value+"&nomcli_temporal="+form_temporal.nomcli_temporal.value+"&monto_pago_temporal="+form_temporal.monto_pago_temporal.value+"&vuelto_temporal="+form_temporal.vuelto_temporal.value+"&boleta_temporal="+form_temporal.boleta_temporal.value+""; 
            }
            else{
              
            }
        }
    });
    }
  </script>
</div>

<?php 
    if(isset($_GET['Impreso'])){
  ?>
    <script type="text/javascript">
      bootbox.alert("Voucher impreso correctamente!");
    </script>
  <?php
    }
    if(isset($_GET['ReimpresoPagado'])){
  ?>
    <script type="text/javascript">
      bootbox.alert("Voucher impreso correctamente!");
    </script>
  <?php
    }
    if(isset($_GET['ErrorEliminando'])){
  ?>
    <script type="text/javascript">
      bootbox.alert("Ha ocurrido un error mientras se eliminaba el producto de mesa temporal!");
    </script>
  <?php
    }
    if(isset($_GET['Eliminado'])){
  ?>
    <script type="text/javascript">
      bootbox.alert("Producto eliminado correctamente de mesa temporal!");
    </script>
  <?php
    }
  ?>

</html>