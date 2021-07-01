<?php session_start();   ?>
<!DOCTYPE html>
<html>


<script type="text/javascript">

  function muestra_impresoras(mov, npedido)
  {
    $('#myModalImpresora #id_promocion2').val(mov);   $.ajax({
           url: 'modal_impresora.php',
           type: 'POST',
           data:{mov:mov, npedido:npedido},
           success: function(data){
                $('#contenidoImpresora').html(data);
                $('#myModalImpresora').modal('show');
           }
       });
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

    return true;
  }
</script>

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

       <!--  <?php
          if($npedido == 1){
        ?>
          <div class="container">
            <div class="row">
              <div class="col">
                <a onclick="return (confirmVolver(<?php echo $vta_id ?>));"><button type="button" class="btn btn-danger btn-block my-4">Volver</button></a>
              </div>
            </div>
          </div>
        <?php
          }
        ?> -->

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
                            $vta_detalles = get_ventas_detalles_by_id_npedido($_GET['Vta_id'], $_GET['npedido']);
                          ?>
                          <div class="card shadow">
                            <div class="card-header border-0">
                              <h3 class="mb-0">DETALLE PEDIDO</h3>
                            </div>

                            <?php 
                              if($vta_detalles != null){
                                foreach ($vta_detalles as $key => $vta_detalle) { 
                                $preparado = get_preparados_id($vta_detalle['preparado_id']);
                                $tamnombre = strlen($preparado['PREPARADOS_NOMBRE']);
                                $fam = get_familia($preparado['PREPARADOS_FAMILIA']);
                                $tamfam = strlen($fam);
                
                              ?>

                                  <div class="card card-stats mb-4 mb-lg-0 ma10">
                                  <div class="card-body">
                                      <div class="row">
                                          <div class="col">
                                              <h5 class="card-title text-uppercase text-muted mb-0"></h5>
                                              <span class="h2 font-weight-bolder mb-0"></span> 
                                              <span class="badge badge-dot mr-4">
                                                <span class="badge badge-success">PEDIDO</span>
                                              </span>
                                          </div>
                                          <div class="col-auto">
                                            <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                                <a class="icon icon-shape bg-primary text-white rounded-circle shadow" onclick="return (confirmDel(<?php echo $vta_detalle['id'] ?>, <?php echo $_GET['Vta_id'] ?>, <?php echo $_GET['npedido'] ?>));">  

                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-12">
                                          <p class="mt-0 mb-0 text-muted text-sm">

                                              <span class="text-nowrap"><i class="fas fa-clipboard-check"></i>&nbsp;<B class="font-weight-bolder">FAMILIA: </B>
                                                <?php   

                                                    if($tamfam > 17) {
                                                      $descrip1 = substr($fam, 0, 16);
                                                      $descrip2 = substr($fam, 16, $tamnombre);
                                                      echo $descrip1. "<br>".$descrip2;
                                                    }
                                                    else{
                                                      echo $fam. "<br>";
                                                    }

                                                ?>
                                              </span><br>
                                              <span class="text-nowrap">
                                                <?php 

                                                  if($tamnombre > 30) {
                                                    $descrip1 = substr($preparado['PREPARADOS_NOMBRE'], 0, 29);
                                                    $descrip2 = substr($preparado['PREPARADOS_NOMBRE'], 29, $tamnombre);
                                                    echo $vta_detalle['cantidad']." ".$descrip1. "<br>".$descrip2;
                                                  }
                                                  else{
                                                    echo $vta_detalle['cantidad']." ".$preparado['PREPARADOS_NOMBRE']. "<br>";
                                                  }
                                                ?>
                                              </span> 
                                              <span class="text-nowrap"><i class="fas fa-dollar-sign"></i>&nbsp;
                                                <B class="font-weight-bolder">
                                                <?php  
                                                  echo $vta_detalle['cantidad']." X $".number_format($preparado['PREPARADOS_PRECIO'], 0, ',', '.')." = "." $".number_format(((($preparado['PREPARADOS_PRECIO'])*($vta_detalle['cantidad'])) - $desc), 0, ',', '.');  
                                                ?>
                                                </B>
                                              </span>
                                              <br>
                                              <span class="text-nowrap"><i class="fas fa-align-center"></i>&nbsp;
                                                <B class="font-weight-bolder">
                                                <?php  
                                                  echo $vta_detalle['observacion'];  
                                                ?>
                                                </B>
                                              </span>
                                          </p>
                                        </div>
                                      </div>
                                  </div>
                                </div>
                              <?php
                              }
                            }
                              ?>


                          </div>
                          <?php 
                            $cuenta_vta_detalle = get_count_vta_detalle($_GET['Vta_id']);
                            if($cuenta_vta_detalle > 0){
                          ?>

                            <div class="card-footer py-4">
                              <nav aria-label="...">
                                <a href="generapedido2.php?oMov=<?php echo $_GET['Vta_id'] ?>&oNpedido=<?php echo $_GET['npedido'] ?>" onclick="block()">
                                  <button type="button" name="imprimepedido" id="imprimepedido" class="btn btn-success btn-lg btn-block my-4" value="imprimepedido" onClick="this.disabled=true;">IMPRIMIR PEDIDO</button>
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
                      url:   'busqueda_productos.php',
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


  <script src="../js/bootbox.min.js"></script>
  <script type="text/javascript">
    function confirmDel(vta_detalle_id, vta_id, npedido){
        bootbox.confirm({
        message: "¿Realmente desea eliminarlo?",
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
            //alert(npedido);
            if(result){
              location.href = "../intranet/funciones/procesapedido2.php?Elimpedidotabla2="+vta_detalle_id+"&vta_id="+vta_id+"&npedido="+npedido+"";
              //location.href = "../../intranet/funciones/procesamoderador2.php?EliminaOC="+id+""; 
            }
            else{
              
            }
        }
    });
    }
  </script>



   <script type="text/javascript">
    function confirmVolver(id){
        bootbox.confirm({
        message: "¿Realmente desea salir y anular mesa?",
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
              location.href = "../intranet/funciones/procesapedido2.php?ElimMesa="+id+""; 
            }
            else{
              
            }
        }
    });
    }
  </script>


  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.0.0"></script>
</body>

</html>