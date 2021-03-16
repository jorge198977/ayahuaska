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
      $stock_productos = get_movimientos_stock_by_prod($_GET['id']);
      $stocks_compras = get_movimientos_stock_compra_by_prod($_GET['id']);
      $producto = get_producto($_GET['id']);
    ?>



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">VER MOVIMIENTOS PROD: <?php echo $producto['PRODUCTO_NOMBRE'] ?></h3>
                </div>

                  <div class="nav-wrapper">
                    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i>SALIDA/MODIFICACION</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>ENTRADA</a>
                        </li>
                    </ul>
                </div>
                <div class="card shadow">
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                
                                <div class="box">
                                  <!-- /.box-header -->
                                  <div class="box-body">
                                   <div class="table-responsive">
                                    <table id="example1" class="table table-flush">
                                      <thead class="thead-light">
                                        <tr>                        
                                          <th scope="col">MOV</th>
                                          <th scope="col">PRODUCTO</th>
                                          <th scope="col">CANTIDAD</th>
                                          <th scope="col">TIPO</th>
                                          <th scope="col">FECHA</th>
                                          <th scope="col">USUARIO</th>
                                          <th scope="col">MESA</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php 
                                          foreach ($stock_productos as $key => $stock) {  
                                          ?>
                                          <tr>
                                              <th>
                                                <?php echo $stock['venta_id'] ?>
                                              </th>
                                              <th>
                                                <?php echo $producto['PRODUCTO_NOMBRE'] ?>
                                              </th>
                                              <th>
                                                <?php echo $stock['cantidad'] ?>
                                              </th>
                                              <th>
                                                <?php 
                                                if($stock['venta_id'] != ''){
                                                  echo "SALIDA DE PRODUCTO";
                                                }
                                                else{
                                                  echo "MODIFICACION POR MODULO";
                                                } 
                                                ?>
                                              </th>
                                              <th>
                                                <?php echo $stock['fecha'] ?>
                                              </th>

                                               <th>
                                                  <?php 
                                                  if($stock['venta_id'] != ''){
                                                    $vta = get_venta_id($stock['venta_id']);
                                                    $usuario = get_usuario_id($vta['usuario_id']);
                                                    echo $usuario['nombre']." ".$usuario['apellido'];
                                                  }
                                                  else if($stock['usuario_id'] != ''){
                                                    $usuario = get_usuario_id($stock['usuario_id']);
                                                    echo $usuario['nombre']." ".$usuario['apellido'];
                                                  }
                                                  ?>
                                               </th>

                                               <th>
                                                  <?php 
                                                  if($stock['venta_id'] != ''){
                                                    $vta = get_venta_id($stock['venta_id']);
                                                    $mesa = get_mesa_num_by_id($vta['mesa_id']);
                                                    echo $mesa;
                                                  }
                                                  ?>
                                               </th>
                                          </tr>
                                        <?php 
                                        } 
                                        ?>
                                      </tbody>
                                    </table>
                                  </div>
                                 </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                
                              <div class="box">
                                  <!-- /.box-header -->
                                  <div class="box-body">
                                   <div class="table-responsive">
                                    <table id="example1" class="table table-flush">
                                      <thead class="thead-light">
                                        <tr>                        
                                          <th scope="col">FACTURA</th>
                                          <th scope="col">PRODUCTO</th>
                                          <th scope="col">CANTIDAD</th>
                                          <th scope="col">TIPO</th>
                                          <th scope="col">FECHA</th>
                                          <th scope="col">USUARIO</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php 
                                          foreach ($stocks_compras as $key => $stock_compra) {
                                            $compra = get_compra_by_stock_compra($stock_compra['compra_id']); 
                                          ?>
                                          <tr>
                                              <th>
                                                <?php echo $compra['num_factura'] ?>
                                              </th>
                                              <th>
                                                <?php echo $producto['PRODUCTO_NOMBRE'] ?>
                                              </th>
                                              <th>
                                                <?php echo $stock_compra['cantidad'] ?>
                                              </th>
                                              <th>
                                                COMPRA DE PRODUCTO
                                              </th>
                                              <th>
                                                <?php echo $compra['fecha'] ?>
                                              </th>

                                               <th>
                                                  <?php 

                                                    $usuario = get_usuario_id($compra['usuario_id']);
                                                    echo $usuario['nombre']." ".$usuario['apellido'];
                                                  
                                                  ?>
                                               </th>

                                               <th>
                                                  <?php 
                                                  if($stock['venta_id'] != ''){
                                                    $vta = get_venta_id($stock['venta_id']);
                                                    $mesa = get_mesa_num_by_id($vta['mesa_id']);
                                                    echo $mesa;
                                                  }
                                                  ?>
                                               </th>
                                          </tr>
                                        <?php 
                                        } 
                                        ?>
                                      </tbody>
                                    </table>
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