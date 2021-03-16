<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Factura SISTEMAREAL</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <style>
      @import url(http://fonts.googleapis.com/css?family=Bree+Serif);
      body, h1, h2, h3, h4, h5, h6{
      font-family: 'Bree Serif', serif;
      }
    </style>
    <?php
   include("../../intranet/funciones/controlador.php");
   include("../header.php");
   ?>
  </head>

  <script language="javascript" type="text/javascript"> 
    function cerrar() { 
       window.open('','_parent',''); 
       window.close(); 
    } 
  </script>
  
  <body>

  	<?php
      $compra = get_compra_by_id($_GET['id']);
      $compras_detalles = get_compras_detalles($_GET['id']);
      $proveedor = get_proveedor_id($compra['proveedor_id']);
      $forma_pago_compra = get_froma_pago_compra_by_id($compra['forma_pago_compra_id']);
  		$subt = 0;
  	?>

    <div class="container">
      <div class="row">
        <div class="col-xs-6">
          <h1>
            <a href="https://twitter.com/tahirtaous">
              <img src="../../assets/img/brand/turquesa.jpg" width="300" heigth="300">
            </a>
          </h1>
        </div>
        <div class="col-xs-6 text-right">
          <h1>FACTURA</h1>
          <h1><small>Factura #<?php echo $compra['id'] ?></small></h1>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-5">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4>De: <a href="#"><?php echo $proveedor['nombre'] ?></a></h4>
            </div>
            <div class="panel-body">
              <p>
                Fono: <?php echo $proveedor['fono'] ?> <br>
                Fecha Ingreso: <?php echo fecha_bd_normal($compra['fecha']) ?> <br>
                Fecha Vencimiento: <?php echo fecha_bd_normal($compra['fecha_vencimiento']) ?> <br>
                 <br>
              </p>
            </div>
          </div>
        </div>
        <div class="col-xs-5 col-xs-offset-2 text-right">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4>A : <a href="#">TURQUESA</a></h4>
            </div>
            <div class="panel-body">
              <p>
                Calle: DIR <br>
                Fono: FONO <br>
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
            <th>
              <h4>Precio Unit</h4>
            </th>
            <th>
              <h4>Sub Total</h4>
            </th>
          </tr>
        </thead>
        <tbody>
        	<?php
              foreach ($compras_detalles as $key => $compra_detalle) {
              	$producto = get_producto($compra_detalle['producto_id']);
                $cantidad = $compra_detalle['cantidad'];
                if(date("Y-m-d") >= "2021-01-01"){
                  //SE AGREGA NUEVO METODO PARA CALCULAR CANTIDAD A PARTIR DEL FORMATO
                  $formato = get_formato_by_id($compra_detalle['formato_id']);
                  $cantidad = intval($cantidad/$formato);
                }
             ?>   
          <tr>
            <td><?php echo $producto['PRODUCTO_ID'] ?></td>
            <td><a href="#"><?php echo $producto['PRODUCTO_NOMBRE'] ?></a></td>
            <td class="text-right"><?php echo number_format($cantidad, 0, ',', '.') ?></td>
            <td class="text-right"><?php echo number_format($compra_detalle['precio'], 0, ',', '.') ?></td>
            <td class="text-right"><?php echo number_format($cantidad*$compra_detalle['precio'], 0, ',', '.') ?></td>
          </tr>
          <?php
              $subt = $subt + ($cantidad*$compra_detalle['precio']);
          	}
          ?>
        </tbody>
      </table>
      <div class="row text-right">
        <div class="col-xs-2 col-xs-offset-8">
          <p>
            <strong>
            Sub Total : <br>
            IVA : <br>
            <?php if($compra['descuento'] > 0) { ?> Descuento : <br> <?php } ?>
            <?php if($compra['exento'] > 0) { ?> Exento : <br> <?php } ?>
            <?php if($compra['ila'] > 0) { ?> ILA : <br> <?php } ?>
            <?php if($compra['iaba'] > 0) { ?> IABA : <br> <?php } ?>
            <?php if($compra['impuesto_adicional'] > 0) { ?> Imp. Adic : <br> <?php } ?>
            <?php if($compra['servicios_logisticos'] > 0) { ?> Serv. Logist : <br> <?php } ?>
            <?php if($compra['retencion'] > 0) { ?> Retención : <br> <?php } ?>
            Total : <br>
            </strong>
          </p>
        </div>
        <div class="col-xs-2">
          <strong>
          <?php echo "$".number_format($compra['neto'], 0, ',', '.') ?><br>
          <?php echo "$".number_format($compra['iva'], 0, ',', '.') ?> <br>
          <?php if($compra['descuento'] > 0) { echo "$".number_format($compra['descuento'], 0, ',', '.'); ?> <br> <?php } ?> 
          <?php if($compra['exento'] > 0) { echo "$".number_format($compra['exento'], 0, ',', '.'); ?> <br> <?php } ?>
          <?php if($compra['ila'] > 0) { echo "$".number_format($compra['ila'], 0, ',', '.'); ?> <br> <?php } ?>
          <?php if($compra['iaba'] > 0) { echo "$".number_format($compra['iaba'], 0, ',', '.'); ?> <br> <?php } ?>
          <?php if($compra['impuesto_adicional'] > 0) { echo "$".number_format($compra['impuesto_adicional'], 0, ',', '.'); ?> <br> <?php } ?>
          <?php if($compra['servicios_logisticos'] > 0) { echo "$".number_format($compra['servicios_logisticos'], 0, ',', '.'); ?> <br> <?php } ?>
          <?php if($compra['retencion'] > 0) { echo "$".number_format($compra['retencion'], 0, ',', '.'); ?> <br> <?php } ?>
          <?php echo "$".number_format($compra['total'], 0, ',', '.') ?><br>
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
                   echo $forma_pago_compra;
                  ?>
                </strong>
                  <br><br>
                  Fecha Vencimiento: <strong><?php echo fecha_bd_normal($compra['fecha_vencimiento']) ?> </strong><br><br>
                  Email : @gmail.com <br><br>
                  Celular : -------- <br> <br>
                  Web : <a href="www.realdev.cl">SISTEMAREAL</a>
                </p>
                
              </div>
            </div>
          </div>
          <center>
          <a href="javascript:cerrar();">
            <button type="button" class="btn btn-lg btn-danger">CERRAR</button>
          </a>
          </center>                 
        </div>
      </div>
    </div>
  </body>
</html>
