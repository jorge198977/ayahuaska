<?php session_start();   ?>
<!DOCTYPE html>
<html>

<?php 
  include("header.php"); 
  include("../intranet/funciones/controlador.php");
  $vta_id = $_GET['Vta_id'];
  $npedido = $_GET['npedido'];
?>

<body>
  <input type="hidden" name="ovtaid" id="ovtaid" value="<?php echo $vta_id ?>">
  <input type="hidden" name="onpedido" id="onpedido" value="<?php echo $npedido ?>">
  <!-- Sidenav -->
  <?php include("sidenav.php"); ?>
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <?php include("top_nav.php"); ?>
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <div class="alert alert-primary" role="alert">
              <strong>CANJEAR COVER!</strong> 
          </div>
                    <div>
                        <div class="col">
                          <div class="card shadow">
                            <div class="card-header border-0">
                              <h3 class="mb-0">DETALLE PEDIDO</h3>
                            </div>

                            <form name="frmagregapedido" method="post" action="../intranet/funciones/procesapedido2.php"> 
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <div class="input-group mb-4">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                      </div>
                                      <input class="form-control" name="agregaarticulo" id="agregaarticulo" placeholder="Escane el código de barra" type="text" autofocus required value autofocus>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" name="btnagregaarticulo" class="btn btn-primary btn-lg" >BUSCAR</button>
                                    <a href="index.php">
                                      <button type="button" class="btn btn-danger btn-lg">VOLVER</button>
                                    </a>
                                </div>
                              </div>
                            </form>
                            <br><hr>
                            <?php
                              if(isset($_GET['id'])){
                                if(isset($_GET['Pedido'])){
                                  $ventas_detalles = get_ventas_detalles_id_pedido($_GET['id'], $_GET['npedido']);    
                                }
                                if(isset($_GET['preparado_id'])){
                                 $ventas_detalles = get_ventas_detalles_by_vta_det_id($_GET['vta_det_id']);     
                                }
                                else{
                                  $ventas_detalles = get_ventas_detalles_id($_GET['id']);    
                                }
                              
                            ?> 
                            <div class="table-responsive">
                              <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                  <tr>
                                    <th>PRODUCTO</th>
                                    <th>CANTIDAD</th>
                                    <th>FECHA</th>
                                    <th>HORA</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  foreach ($ventas_detalles as $key => $venta_detalle) {
                                    $preparado = get_preparados_id($venta_detalle['preparado_id']);
                                    //if($preparado['es_happy'] != 1){
                                  ?>
                                      <tr class="active">
                                        <td>
                                          <?php
                                            echo $preparado['PREPARADOS_NOMBRE'];                      
                                          ?>
                                        </td>
                                        <td>
                                          <?php
                                            echo $venta_detalle['cantidad'];                      
                                          ?>
                                        </td>
                                        <td>
                                          <?php
                                            echo $venta_detalle['fecha'];                      
                                          ?>
                                        </td>
                                        <td>
                                          <?php
                                            echo $venta_detalle['hora'];                      
                                          ?>
                                        </td>
                                      </tr>
                                  <?php
                                    //}
                                  }
                                  ?>
                                </tbody>
                              </table>
                            </div>
                            <?php
                            }
                            ?>
                            <br><hr>
                          </div>

                          <?php 
                            $cuenta_vta_detalle = get_count_vta_detalle($_GET['Vta_id']);
                            if($cuenta_vta_detalle > 0){
                          ?>

                            <div class="card-footer py-4">
                              <nav aria-label="...">
                                <a href="generarpedido.php?mov=<?php echo $_GET['Vta_id'] ?>&npedido=<?php echo $_GET['npedido'] ?>" onclick="block()">
                                  <button type="button" name="imprimepedido" id="imprimepedido" class="btn btn-success btn-lg btn-block my-4" value="imprimepedido" >IMPRIMIR PEDIDO</button>
                                </a>
                              </nav>
                            </div>

                          <?php
                            }
                          ?>
                        </div>
                    </div>
               
      </div>
    </div>


  </div>








  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>

  <script type="text/javascript">
    
     $(document).ready(function(){
         $("#busqueda_familia").keyup(function(){
              //var parametros="busqueda_familia="+$(this).val();
              //var parametros="busqueda_familia="+document.getElementById("busqueda_familia").value;
              var parametros=document.getElementById("busqueda_familia").value;
              var vta_id= document.getElementById("ovtaid").value;
              var npedid= document.getElementById("onpedido").value;
              $.ajax({
                    data:  {parametros,vta_id, npedid},
                    url:   'busqueda_familia.php',
                    type:  'post',
                      beforeSend: function () { },
                      success:  function (response) {                 
                          $('#muestra_familias').html(response);
                    },
                    error:function(){
                         alert("error")
                      }
               });
         })
    });

    $(document).ready(function(){
      var vta_id= document.getElementById("ovtaid").value;
      var npedid= document.getElementById("onpedido").value;
      $.ajax({
            data:  {vta_id, npedid},
            url:   'busqueda_familia.php',
            type:  'post',
              beforeSend: function () { },
              success:  function (response) {                 
                  $('#muestra_familias').html(response);
            },
            error:function(){
                 alert("error")
              }
       });
         
    });

    

  </script>

  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.0.0"></script>
</body>

<script src="../js/bootbox.min.js"></script>
<?php 
    if(isset($_GET['Canjeado'])){
  ?>
    <script type="text/javascript">
      bootbox.alert("Cover ya fue canjeado anteriormente!");
    </script>
<?php
  }
   if(isset($_GET['CanjeadoPedido'])){
  ?>
    <script type="text/javascript">
      bootbox.alert("Pedido ya fue canjeado anteriormente!");
    </script>
<?php
  }
  if(isset($_GET['NoesCover'])){
  ?>
    <script type="text/javascript">
      bootbox.alert("Pedido ingresado NO es COVER!");
    </script>
<?php
  }
  if(isset($_GET['HappyRebajado'])){
  ?>
    <script type="text/javascript">
      bootbox.alert("Happy Rebajado Correctamente!");
    </script>
<?php
  }
  if(isset($_GET['HappyCanjeado'])){
  ?>
    <script type="text/javascript">
      bootbox.alert("Happy ya fue canjeado!");
    </script>
<?php
  }
?>

</html>