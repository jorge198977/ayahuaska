<script language="javascript">
$(document).ready(function(){
   $("#nomcli_temporal").change(function () {
           $("#nomcli_temporal option:selected").each(function () {
            id_nombre = $(this).val();
            $.post("cupo_cliente.php", { id_nombre: id_nombre }, function(data){
                $("#cupcli_temporal").html(data);
            });            
        });
   })
});

$(document).ready(function(){
  var $montopagado = $('#monto_pago_temporal');
  var $vuelto = $('#vuelto_temporal');
  var $totpag = $('#totalapagar_temporal');
  var $totcpropina = $('#totalconpropina_temporal');
  var $propinamonto = $('#propina_temporal');
  var $btn_pago_temporal =$('#btn_pagar_temporal');
  
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
      form_temporal.btn_pagar_temporal.disabled = false;
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

<?php
include("../intranet/funciones/controlador.php");
$id = intval($_POST['mov']);

  $ventas_detalles_temporal = get_ventas_detalles_temporal_id($id);
  $total = 0;

?>
Mesa TEMPORAL
<hr>
<div class="box">
  <!-- /.box-header -->
  <div class="box-body">
   <div class="table-responsive">
    <table id="example2" class="table table-flush">
      <thead class="thead-light">
        <tr>
          <th scope="col">PRODUCTO</th>
          <th scope="col">PRECIO</th>
          <th scope="col">DESC</th>
          <th scope="col">SUBTOT</th>
          <th scope="col">ELIM</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $i = 1;
          foreach ($ventas_detalles_temporal as $key => $venta_detalle) {
            $desc = 0;
        ?>   
          <tr class="active">
            <td>
              <?php
                $preparado = get_preparados_id($venta_detalle['preparado_id']);
                echo $venta_detalle['cantidad']." ".$preparado['PREPARADOS_NOMBRE'];                      
              ?>
            </td>
            <td>
              <?php 
                echo "$".number_format($preparado['PREPARADOS_PRECIO'], 0, ',', '.'); 
                $total = $total + ($preparado['PREPARADOS_PRECIO'] * $venta_detalle['cantidad']);
                if(get_familia($preparado['PREPARADOS_FAMILIA']) == "CIGARRILLOS"){
                  $totcig = $totcig + ($venta_detalle['cantidad']*$preparado['PREPARADOS_PRECIO']) ;
                }
                
              ?>

            </td>
            <td>
              <?php
                $descuento_familia = get_descuento_familia_by_familia_id($preparado['PREPARADOS_FAMILIA']);
                if($descuento_familia['descuento'] != ""){
                  $dentro_horario = dentro_de_horario($descuento_familia['hora_inicial'], $descuento_familia['hora_final'], $venta_detalle['hora']);
                  if($dentro_horario == 1){
                    $desc = $descuento_familia['descuento'] * $venta_detalle['cantidad'];
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
                echo "$".number_format(((($preparado['PREPARADOS_PRECIO'])*$venta_detalle['cantidad'])-$desc), 0, ',', '.');
              ?>
            </td>
            <td>
              <a href="../intranet/funciones/procesamoderador2.php?ElimpedidotablaTemporal=<?php echo $venta_detalle['id'] ?>&Mov=<?php echo $id ?>">
                <button type="button" name="btnelimbeb" value="btnelimbeb" class="btn btn-default" aria-label="Left Align">
                <span class="fa fa-window-close" aria-hidden="true"></span>
                </button>
              </a>
            </td>
          </tr>
        <?php
        $i++;
        }
        ?>
      </tbody>
    </table>

    <?php
      $obtener_descuento = get_descuento_venta($id);
      if($obtener_descuento != ""){
        $descu = $obtener_descuento;
      }
      else{
        $descu = 0;
      }
      $descuento_puntos = get_descuento_puntos($id);
    ?>

    <div class="container">
      <div class="row">
        <div class="col-sm">
          <span>
            <label>Total</label><input class="form-control input-lg" name="to" id="to" type="text" 
           disabled="true" value="<?php echo number_format($total, 0, ',', '.') ?>" >
          </span>
        </div>
        <div class="col-sm">
          <span>
            <label>Descuento</label><input class="form-control input-lg" name="des" id="des" type="text" 
           disabled="true" value="<?php echo number_format($descu, 0, ',', '.') ?>" >
          </span>
        </div>
        <div class="col-sm">
          <span>
            <label>Descuento Especial</label><input class="form-control input-lg" name="deses" id="deses" type="text" 
           disabled="true" value="<?php echo number_format($sumatoria_descuento, 0, ',', '.') ?>" >
          </span>
        </div>
        <div class="col-sm">
          <span>
            <label>Desc Pts Reales</label><input class="form-control input-lg" name="deses" id="deses" type="text" 
           disabled="true" value="<?php echo number_format($descuento_puntos, 0, ',', '.') ?>" >
          </span>
        </div>
      </div>
    </div>

    <div class="panel-body">
      <div class="col-lg-12 text-center">
        <label>Total - Descuento</label><input class="form-control input-lg" name="totaldes_temporal" id="totaldes_temporal" type="text" 
           disabled="true" value="<?php echo number_format(($total-$descu - $sumatoria_descuento - $descuento_puntos), 0, ',', '.') ?>" >
           <input type="hidden" name="totalapagar_temporal" id="totalapagar_temporal" value="<?php echo $total-$descu - $sumatoria_descuento - $descuento_puntos ?>">
      </div>
    </div>

    <hr>
    <label for="observacion" class="col-sm-xs-2 control-label">FORMA DE PAGO</label>
	<div class="col-sm-xs-10">
	  	<select class="form-control input-lg" name="fpago_temporal" id="fpago_temporal" onchange="javascript:mostrarocultocliente_temporal()"> 
          <option value=""> Ingrese forma de pago</option>
          <?php 
            $formas_pagos = get_all_formas_pagos();
            foreach ($formas_pagos as $key => $forma_pago) { 
          ?>
            <option value="<?php echo $forma_pago['id'] ?>"><?php echo $forma_pago['descripcion'] ?></option>
          <?php } ?>
        </select> 
	</div>

	<div id="contentcliente_temporal" class="col-sm-xs-10" style="display: none;">
	  	<select class="form-control input-lg" name="nomcli_temporal" id="nomcli_temporal"> 
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
        <select class="form-control input-lg" name="cupcli_temporal" id="cupcli_temporal"> 
           <option value=""> Cupo disponible</option>
        </select>
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

  <label for="observacion" class="col-sm-xs-2 control-label">BOLETA</label>
  <div class="col-sm-xs-10">
    <input type="number" name="boleta_temporal" id="boleta_temporal" value="<?php echo ($max_boleta) ?>" class='form-control' required>
  </div>

  <?php $propina = (($total-$descu-$sumatoria_descuento-$descuento_puntos) * 0.1); ?>
	
	<label for="observacion" class="col-sm-xs-2 control-label">PROPINA(Sugerida 10% = <?php echo number_format($propina, 0, ',', '.') ?>)</label>
	<div class="col-sm-xs-10">
	  <input type="number" name="propina_temporal" id="propina_temporal" class='form-control' required>
	</div>
  <label for="observacion" class="col-sm-xs-2 control-label">TOTAL</label>
  <div class="col-sm-xs-10">
    <input type="number" name="totalconpropina_temporal" id="totalconpropina_temporal" class='form-control' disabled>
  </div>
  <label for="observacion" class="col-sm-xs-2 control-label">MONTO DE PAGO</label>
  <div class="col-sm-xs-10">
    <input type="number" name="monto_pago_temporal" id="monto_pago_temporal" class='form-control' required>
  </div>
  <label for="observacion" class="col-sm-xs-2 control-label">VUELTO</label>
  <div class="col-sm-xs-10">
    <input type="number" name="vuelto_temporal" id="vuelto_temporal" class='form-control' required>
  </div>
	<input type="hidden" name="ototaltemporal" id="ototaltemporal" value="<?php echo $total-$descu - $sumatoria_descuento - $descuento_puntos ?>">
	<input type="hidden" name="ototal" id="ototal" value="<?php echo $_POST['totalventa'] +  ($total-$descu - $sumatoria_descuento - $descuento_puntos) ?>">
	<input type="hidden" name="oidpagotemporal" id="oidpagotemporal" value="<?php echo $id ?>">
	<input type="hidden" name="omesa_id" id="omesa_id" value="<?php echo $_POST['mesa_id'] ?>">

  <br>
  <a href="imprimedetalle_temporal.php?mov=<?php echo $id ?>&mesa=<?php echo $_POST['mesa_id'] ?>&total=<?php echo $total ?>&descu=<?php echo $descu ?>&desc_puntos=<?php echo $descuento_puntos ?>&descu_especial=<?php echo $sumatoria_descuento ?>"><button type="button" class="btn btn-success btn-block my-12"><span class="fa fa-print" aria-hidden="true"></span></button></a>
  
  </div>
 </div>
</div>

