<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>OC SISTEMA REAL</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <style>
      @import url(http://fonts.googleapis.com/css?family=Bree+Serif);
      body, h1, h2, h3, h4, h5, h6{
      font-family: 'Bree Serif', serif;
      }
    </style>
    <?php
   include("../../intranet/funciones/controlador.php");
   ?>
  </head>
  
  <body>

  	<?php
  	  $oc = get_orden_compra_by_id($_GET['oc']);
      $proveedor = get_proveedor_id($oc['proveedor_id']);
  		$subt = 0;
  	?>

    <div class="container">
      <div class="row">
        <div class="col-xs-6">
          <h1>
            <a href="https://twitter.com/#">
            <img src="../../intranet/images/turquesa.jpg" width="300" heigth="300">
            </a>
          </h1>
        </div>
        <div class="col-xs-6 text-right">
          <h1>Orden de Compra</h1>
          <h1><small>OC #<?php echo $oc['id'] ?></small></h1>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-5">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4>De : <a href="#">TURQUESA</a></h4>
            </div>
            <div class="panel-body">
              <p>
                Calle: Parcela camino a sotaqui km 5<br>
                Fono:  +56971035997<br>
                 <br>
              </p>
            </div>
          </div>
        </div>
        <div class="col-xs-5 col-xs-offset-2 text-right">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4>A: <a href="#"><?php echo $proveedor['nombre'] ?></a></h4>
            </div>
            <div class="panel-body">
              <p>
                Contacto:  <?php echo $proveedor['correo'] ?> <br>
                Fono: <?php echo $proveedor['fono'] ?> <br>
                Fecha Ingreso: <?php echo fecha_bd_normal($oc['fecha']) ?> <br>
                Fecha Compra: <?php echo fecha_bd_normal($oc['fecha_compra']) ?> <br>
                 <br>
              </p>
            </div>
          </div>
        </div>
      </div>
      <!-- / end client details section -->
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>
              <h4>Código</h4>
            </th>
            <th>
              <h4>Descripción</h4>
            </th>
            <th>
              <h4>Cantidad</h4>
            </th>
          </tr>
        </thead>
        <tbody>
        	<?php
              $oc_detalles = get_ordenes_compras_detalles_by_ocid($oc['id']);
              foreach ($oc_detalles as $key => $oc_detalle) {
                $producto = get_producto($oc_detalle['producto_id']);
          ?>   
          <tr>
            <td><?php echo $oc_detalle['producto_id'] ?></td>
            <td><a href="#"><?php echo $producto['PRODUCTO_NOMBRE'] ?></a></td>
            <td class="text-right"><?php echo $oc_detalle['cantidad'] ?></td>
          </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
      
      <div class="row text-right">
        <div class="col-xs-2 col-xs-offset-8">
          <p>
            <strong>
            </strong>
          </p>
        </div>
        <div class="col-xs-2">
          <strong>
          </strong>
        </div>
      </div>
      <div class="row">

        <div class="col-xs-12">
          <div class="span7">
            <div class="panel panel-info">
              <div class="panel-heading">
                <h4>Detalles</h4>
              </div>
              <div class="panel-body">
                <p>
                  Forma Pago: <strong>
                  <?php 
                    echo $forma_pago_compra = get_froma_pago_compra_by_id($oc['forma_pago_id']);
                  ?>
                </strong>
                  <br><br>
                  Fecha Compra: <strong><?php echo fecha_bd_normal($oc['fecha_compra']) ?> </strong><br><br>
                  Email :  turquesa.ovalle@gmail.com  <br><br>
                  Web : <a href="//www.realdev.cl" target="_BLANK">SISTEMA REAL</a>
                </p>
                
              </div>
            </div>
          </div>
          <!-- <center>
          <a href="../ordenes_compra.php">
                            <button type="button" class="btn btn-lg btn-danger">Volver</button>
                           </a>
          </center>  -->                
        </div>
      </div>
    </div>
  </body>
</html>
