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
      $preparados = get_all_preparados();
    ?>



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">VER MERCADERIA</h3>
                </div>


                  <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                     <div class="table-responsive">
                      <table id="example1" class="table table-flush">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">PRECIO</th>
                            <th scope="col">FAMILIA</th>
                            <th scope="col">DESCUENTO PROD</th>
                            <?php if($_SESSION['tipo'] == 1){ ?>
                              <th scope="col">COSTO TOTAL</th>
                            <?php } ?>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                    
                          foreach ($preparados as $key => $preparado) {
                            $nombre_familia = get_familia($preparado['familia']);
                            if($nombre_familia != ""){
                            $producto_preparados = get_producto_preparados_id_prep($preparado['id']);
                        ?> 
                          <tr>
                            <th><?php echo $preparado['nombre'] ?></th>
                            <th><?php echo number_format($preparado['precio'], 0, ',', '.') ?></th>
                            <th><?php echo $nombre_familia ?></th>
                            <th>
                            <?php
                              $costo_preparado = 0;
                              foreach ($producto_preparados as $key => $prod_prep) {
                                $nombre_producto = get_producto($prod_prep['producto_id']);
                            ?>  
                                <?php 
                                  $costo_asociado = get_costo_asociado($prod_prep['cantidad'], $nombre_producto['PRODUCTO_COSTO'], $nombre_producto['PRODUCTO_CAPACIDADPORUNIDAD']);
                                  $costo_preparado = $costo_preparado + $costo_asociado;
                                echo $prod_prep['cantidad']. 
                                " ".get_nombre_tipo_descuento($nombre_producto['TIPO_DESCUENTO_ID']).
                                " ".$nombre_producto['PRODUCTO_NOMBRE'].
                                
                                "<br>" ?>
                            <?php } ?>
                            </th>
                            <?php if($_SESSION['tipo'] == 1){ ?>
                              <th><?php echo number_format($costo_preparado, 0, ',', '.') ?></th>
                            <?php } ?>
                          </tr>

                        <?php
                          }
                        }
                        ?>
                        </tbody>
                      </table>
                    </div>
                   </div>
                  </div>


                <div class="container">
                  <div class="row">
                    <div class="col">
                      <a href="../../Reportes/Impresiones/ImprimeReporte.php?repMercaderia" target="_blank" target="_blank"><button type="button" class="btn btn-success btn-block my-4">Reporte</button></a>
                    </div>
                    <div class="col">
                      <a href="../../mantenedores.php"><button type="button" class="btn btn-danger btn-block my-4">Volver</button></a>
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