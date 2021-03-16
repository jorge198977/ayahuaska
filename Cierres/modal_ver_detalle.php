<?php
include("../intranet/funciones/controlador.php");
$id = intval($_POST['id']);
$forma_pago_id =  intval($_POST['forma_pago_id']);
$venta_pago_id = intval($_POST['venta_pago_id']);
  $venta = get_venta_id($id);

  $ventas_detalles = get_ventas_detalles_id($id);
  $total = 0;
  $mesero = get_usuario_id($venta['usuario_id']);
  $socio = get_nombre_socio(get_vta_socio_id($id)); 
  $nombre_mesero = $mesero['nombre']." ".$mesero['apellido'];
  $forma_pago = get_forma_pago_id($forma_pago_id);

  $obtener_propina = get_venta_propina($id, $venta_pago_id);
  if($obtener_propina['monto'] != ""){
    $propina = $obtener_propina['monto'];
  }
  else{
    $propina = 0;
  }

?>
Mesa: <?php echo get_mesa_by_id($venta['mesa_id']); ?>
<hr>
<div class="box">
  <!-- /.box-header -->
  <div class="box-body">
   <div class="table-responsive">
    <table id="example2" class="table table-flush">
      <thead class="thead-light">
        <tr>
          <th scope="col">PRODUCTO</th>
          <th scope="col">FAM</th>
          <th scope="col">CANT</th>
          <th scope="col">PRECIO</th>
          <th scope="col">DESCUENTO</th>
          <th scope="col">SUBTOTAL</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $i = 1;
          foreach ($ventas_detalles as $key => $venta_detalle) {
            $desc = 0;
        ?>   
          <tr class="active">
            <td>
              <?php
                $preparado = get_preparados_id($venta_detalle['preparado_id']);
                echo $preparado['PREPARADOS_NOMBRE'];                      
              ?>
            </td>
            <td>
              <?php echo get_familia($preparado['PREPARADOS_FAMILIA']) ?>
            </td>
            <td><?php echo $venta_detalle['cantidad'] ?></td>
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
        <label>Total - Descuento</label><input class="form-control input-lg" name="totaldes" id="totaldes" type="text" 
           disabled="true" value="<?php echo number_format(($total-$descu - $sumatoria_descuento - $descuento_puntos), 0, ',', '.') ?>" >
      </div>
    </div>


    <div class="container">
      <div class="row">
        <div class="col-sm">
          <span>
            <label>CLIENTE</label><input class="form-control input-lg" name="to" id="to" type="text" 
           disabled="true" value="<?php echo $socio['nombre'] ?>" >
          </span>
        </div>
        <div class="col-sm">
          <span>
            <label>ATENDIDO POR</label><input class="form-control input-lg" name="to" id="to" type="text" 
           disabled="true" value="<?php echo $nombre_mesero ?>" >
          </span>
        </div>
        <div class="col-sm">
          <span>
            <label>PROPINA</label><input class="form-control input-lg" name="des" id="des" type="text" 
           disabled="true" value="<?php echo number_format($propina, 0, ',', '.') ?>" >
          </span>
        </div>
        <div class="col-sm">
          <span>
            <label>FORMA DE PAGO</label><input class="form-control input-lg" name="des" id="des" type="text" 
           disabled="true" value="<?php echo $forma_pago ?>" >
          </span>
        </div>
      </div>
    </div>

  </div>
 </div>
</div>

