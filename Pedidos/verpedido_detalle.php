<?php session_start();   ?>
<!DOCTYPE html>
<html>

<?php 
  include("header.php"); 
  include("../intranet/funciones/controlador.php");
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
      $venta = get_venta_id($_GET['Mov']);
      $ventas_detalles = get_ventas_detalles_id($_GET['Mov']);
      $venta_socio = get_vta_socio_id($_GET['Mov']);
      $mesa = get_mesa_by_id($venta['mesa_id']);
      $total = 0;
      $sumatoria_descuento = 0;
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
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        foreach ($ventas_detalles as $key => $venta_detalle) {
                          $cantidad_temporal = get_cantidad_venta_temporal($_GET['Mov'], $venta_detalle['preparado_id'], 0, $venta_detalle['npedido']);
                          $desc = 0;
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
                                $total = $total + ($preparado['PREPARADOS_PRECIO'] * ($venta_detalle['cantidad'] - $cantidad_temporal));
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
                                  echo "$".number_format(((($preparado['PREPARADOS_PRECIO'])*($venta_detalle['cantidad']) -$cantidad_temporal) - $desc), 0, ',', '.');
                                ?>
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
                          <label>Descuento Puntos Reales</label><input class="form-control input-lg" name="deses" id="deses" type="text" 
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

                </div>
                <div class="card-footer py-4">
                  <div class="container">
                    <div class="row">
                        <?php
                          $npedido = get_max_npedido_venta_detalle($_GET['Mov']) + 1;
                          if(!isset($_GET['elimpedido'])){
                        ?>
                          <div class="col-sm">
                            <nav aria-label="...">
                              <a href="solicita_precuenta.php?mov=<?php echo $_GET['Mov'] ?>&mesa=<?php echo $mesa ?>&total=<?php echo $total ?>&descu=<?php echo $descu ?>&desc_puntos=<?php echo $descuento_puntos ?>&descu_especial=<?php echo $sumatoria_descuento ?>&Socio_id=<?php echo $venta_socio ?>&npedido=<?php echo $npedido ?>">
                                <button type="button" class="btn btn-lg btn-success btn-block my-4">Imprimir Detalle</button>
                            </a>
                            </nav>
                          </div>
                        <?php
                          }
                         if( (!isset($_GET['elimpedido']))){
                            if($venta_socio != ""){
                            ?>
                            <div class="col-sm">
                              <nav aria-label="...">
                                 <a href="toma_nuevo_pedido.php?Vta_id=<?php echo $_GET['Mov'] ?>&npedido=<?php echo $npedido ?>&Socio_id=<?php echo $venta_socio ?>">
                                  <button type="button" class="btn btn-lg btn-primary btn-block my-4">Nuevos productos</button>
                                 </a>
                              </nav>
                            </div>
                            <?php
                            }
                            else{
                            ?>
                            <div class="col-sm">
                              <nav aria-label="...">
                                 <a href="toma_nuevo_pedido.php?Vta_id=<?php echo $_GET['Mov'] ?>&npedido=<?php echo $npedido ?>">
                                  <button type="button" class="btn btn-lg btn-primary btn-block my-4">Nuevos productos</button>
                                </a>
                              </nav>
                            </div>
                            <?php
                            }
                          }  
                        ?>

                     </div>

                  <nav aria-label="...">
                    <a href="ver_pedido.php"><button type="button" class="btn btn-danger btn-block my-4">Volver</button></a>
                  </nav>
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
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.0.0"></script>
</body>

<script src="../js/bootbox.min.js"></script>
<?php 
    if(isset($_GET['Impreso'])){
  ?>
    <script type="text/javascript">
      bootbox.alert("Detalle impreso!");
    </script>
  <?php
    }
  ?>

</html>