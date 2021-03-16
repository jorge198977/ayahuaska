<?php session_start();   ?>
<!DOCTYPE html>
<html>

<?php 
  include("header.php"); 
  include("../intranet/funciones/controlador.php");
  $vta_id = $_GET['id'];
  $npedido = 1;
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
              <strong>Genera Pedido!</strong> 
          </div>
          <!-- Card stats -->
          <div class="nav-wrapper">
            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
              <li class="nav-item">
                  <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i>FAMILIAS</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>VER PEDIDO</a>
              </li>
          </ul>
        </div>
        <div class="card shadow">
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                        
                        <div class="container">
                          <div class="row">
                            <div class="col-12">
                              <div class="nav-wrapper" id="accordion" role="tablist" aria-multiselectable="true">

                                <form>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <div class="input-group mb-4">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                          </div>
                                          <input class="form-control" name="busqueda_familia" id="busqueda_familia" placeholder="Ingresa nombre familia" type="text">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <div class="input-group mb-4">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                          </div>
                                          <input class="form-control" name="busqueda_producto" id="busqueda_producto" placeholder="Ingresa nombre Producto" type="text">
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </form>

                                <div id="muestra_familias">

                                </div>

                                <div id="accordion">
                                  <div class="card">
                                    <div class="card-header" id="headingOne">
                                      <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                          PRODUCTOS
                                        </button>
                                      </h5>
                                    </div>

                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                      <div class="card-body">
                                        <div id="muestra_productos_div">

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
                    <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                        <div class="col">
                          <?php
                            $vta_detalles = get_ventas_detalles_by_id_npedido($_GET['id'], $_GET['npedido']);
                          ?>
                          <div class="card shadow">
                            <div class="card-header border-0">
                              <h3 class="mb-0">DETALLE PEDIDO</h3>
                            </div>
                            <div class="table-responsive">
                              <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                  <tr>
                                    <th>NOMBRE</th>
                                    <th>OBSERVACION</th>
                                    <th>CANTIDAD</th>
                                    <th>PRECIO</th>
                                    <th>ELIMINAR</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($vta_detalles as $key => $vta_detalle) { 
                                    $preparado = get_preparados_id($vta_detalle['preparado_id']);
                                  ?>
                                    <tr>
                                      <td><?php echo $preparado['PREPARADOS_NOMBRE'] ?></td>
                                      <td><?php echo $vta_detalle['observacion'] ?></td>
                                      <td><?php echo $vta_detalle['cantidad'] ?></td>
                                      <td><?php echo number_format($preparado['PREPARADOS_PRECIO']*$vta_detalle['cantidad'], 0, ',', '.') ?></td>
                                      <td>
                                        <a href="../intranet/funciones/procesapedido2.php?ElimpedidotablaDirecto=<?php echo $vta_detalle['id'] ?>&vta_id=<?php echo $_GET['id'] ?>&npedido=1">
                                          <button type="button" name="btnelimbeb" value="btnelimbeb" class="btn btn-default" aria-label="Left Align">
                                          <span class="fa fa-window-close" aria-hidden="true"></span>
                                          </button>
                                        </a>
                                      </td>
                                    </tr>
                                  <?php } ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <?php 
                            $cuenta_vta_detalle = get_count_vta_detalle($_GET['id']);
                            if($cuenta_vta_detalle > 0){
                          ?>

                            <div class="card-footer py-4">
                              <nav aria-label="...">
                                <!-- <a href="generarpedido.php?mov=<?php echo $_GET['id'] ?>&npedido=1" onclick="block()">
                                  <button type="button" name="imprimepedido" id="imprimepedido" class="btn btn-success btn-lg btn-block my-4" value="imprimepedido" >IMPRIMIR PEDIDO</button>
                                </a> -->
                                <a href="pagar_directo.php?Mov=<?php echo $_GET['id'] ?>" onClick="return validar()">
                                  <button type="button" name="imprimepedido" id="imprimepedido" class="btn btn-success btn-lg btn-block my-4" onClick="this.disabled=true;">PAGAR PEDIDO</button >
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
                    url:   'busqueda_familia_directo.php',
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
         $("#busqueda_producto").keyup(function(){
              largo_busqueda = document.getElementById("busqueda_producto").value.length;
              //BUSCA SI EXISTE BUSQUEDA DE PROD Y OCULTA FAMILIAS
              if(largo_busqueda > 0){
                element_familias = document.getElementById("muestra_familias"); 
                element_familias.style.display='none';

                //SI BUSQUEDA MOSTRAR PANEL PROD
                var parametros=document.getElementById("busqueda_producto").value;
                var vta_id= document.getElementById("ovtaid").value;
                var npedid= document.getElementById("onpedido").value;
                $.ajax({
                      data:  {parametros,vta_id, npedid},
                      url:   'busqueda_productos_directo.php',
                      type:  'post',
                        beforeSend: function () { },
                        success:  function (response) {     
                            $('#muestra_productos_div').html(response);
                      },
                      error:function(){
                           alert("error")
                        }
                 });

              }
              else{
                element_familias = document.getElementById("muestra_familias"); 
                element_familias.style.display='block';
              }
         })
    });

    $(document).ready(function(){
      var vta_id= document.getElementById("ovtaid").value;
      var npedid= document.getElementById("onpedido").value;
      $.ajax({
            data:  {vta_id, npedid},
            url:   'busqueda_familia_directo.php',
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

</html>