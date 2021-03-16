<?php  session_start();   ?>
<!DOCTYPE html>
<html>

<?php 
  include("header.php"); 
  include("../../intranet/funciones/controlador.php");
?>

<script type="text/javascript">

  function muestra_stock_modifica(id, stock)
  {
    $('#myModalStock #id_promocion2').val(id);   $.ajax({
           url: 'modal_stock_modifica.php',
           type: 'POST',
           data:{id:id, stock:stock},
           success: function(data){
                $('#contenidoStock').html(data);
                $('#myModalStock').modal('show');
           }
       });
  }

  function muestra_stock_modifica_onzas(id, stock, stockonza)
  {
    $('#myModalStockOnzas #id_promocion2').val(id);   $.ajax({
           url: 'modal_stock_modifica_onzas.php',
           type: 'POST',
           data:{id:id, stock:stock, stockonza:stockonza},
           success: function(data){
                $('#contenidoStockOnzas').html(data);
                $('#myModalStockOnzas').modal('show');
           }
       });
  }


  function muestra_stock_modifica_gramos(id, stock, stockgramos)
  {
    $('#myModalStockGramos #id_promocion2').val(id);   $.ajax({
           url: 'modal_stock_modifica_gramos.php',
           type: 'POST',
           data:{id:id, stock:stock, stockgramos:stockgramos},
           success: function(data){
                $('#contenidoStockGramos').html(data);
                $('#myModalStockGramos').modal('show');
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

<body>
  <!-- Sidenav -->
  <?php include("sidenav.php"); ?>
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <?php include("top_nav.php"); ?>
    <!-- Header -->

    <?php
      $proveedores = get_all_proveedores();
    ?>



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">CONTROL STOCK</h3>
                </div>


                  <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                     <div class="table-responsive">
                      <table id="example1" class="table table-flush">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">FAMILIA</th>
                            <th scope="col">T. DESCU</th>
                            <?php if($_GET['tipo_descuento'] == 1){ ?>
                              <th scope="col">STOCK X UNIDADES</th>
                            <?php } ?>
                            
                            <th scope="col">ESTADO</th>
                            <?php if($_GET['tipo_descuento'] != 1){ ?>
                                <th>STOCK X MEDIDA</th>
                            <?php } ?>
                            <th scope="col">STOCK MÍNIMO</th>
                            <?php if($_SESSION['tipo'] == 1){ ?>
                              <th scope="col">ACCION</th>
                            <?php } ?>
                            <?php if($_SESSION['tipo'] == 1){ ?>
                              <th scope="col">VER</th>
                            <?php } ?>

                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $productos = get_productos_by_tipo_descuento($_GET['tipo_descuento']);
                            foreach ($productos as $key => $producto) {

                              if($producto['nombreFamilia'] != ""){

                              $estado_stock = "";
                              if(stock_critico($producto['id'])){
                                  $estado_stock = "CRITICO";
                                }
                                else{
                                  $estado_stock = "NORMAL";
                                }
                              //NUEVO REVISA SI SON ONZAS PARA STOCK CRITICO
                              // if(($_GET['tipo_descuento'] == 2) or ($_GET['tipo_descuento'] == 3)){

                              //   $stockmin = intval(get_stock_min($producto['id']));

                              //   $stockqueda = get_enteros($producto['stockPorUnitdad']);

                              //   //echo "NOMBRE->".$producto['nombre'].", STOCKQUEDA->".$stockqueda.", STOCKMIN->".$stockmin;  
                              //   if($stockmin > $stockqueda){
                              //     //echo "<br> ES CRITICO";
                              //     $estado_stock = "CRITICO";
                              //   }
                              //   else{
                              //     $estado_stock = "NORMAL";
                              //   }

                              // }
                              // else{
                              //   if(stock_critico($producto['id'])){
                              //     $estado_stock = "CRITICO";
                              //   }
                              //   else{
                              //     $estado_stock = "NORMAL";
                              //   }
                              // }
                          ?>
                          <tr>
                            <td><?php echo $producto['nombre']; ?></td>
                            <td><?php echo $producto['nombreFamilia']; ?></td>
                            <td><?php echo get_nombre_tipo_descuento($producto['tipo_descuento']); ?></td>
                            <?php if($_GET['tipo_descuento'] == 1){ ?>
                              <td><?php if($_GET['tipo_descuento'] == 1){ echo intval($producto['stockPorUnitdad']); } 
                                  // else { echo (intval($producto['stockPorTipo'])/33); }
                               ?></td> 
                            <?php } ?>
                             <td align="center" class="text-white" <?php if($estado_stock != "NORMAL"){ ?>  bgcolor="red" <?php } else{ ?>  bgcolor="green" <?php } ?> >
                                <strong><?php echo $estado_stock ?></strong></td>
                            <?php if($_GET['tipo_descuento'] != 1){ ?>
                              <td><?php echo $producto['stockPorTipo']; ?></td>
                            <?php } ?>
                            <td><?php echo $producto['stock_minimo']; ?></td>
                             <?php if($_SESSION['tipo'] == 1){ ?>
                              <td>
                                <button type="button" <?php if($_GET['tipo_descuento'] == 1){ ?> onclick='muestra_stock_modifica(<?php echo $producto['id'] ?>, <?php echo intval($producto['stockPorUnitdad']) ?>)' <?php } if($_GET['tipo_descuento'] == 2){ ?> onclick='muestra_stock_modifica_onzas(<?php echo $producto['id'] ?>, <?php echo intval($producto['stockPorUnitdad']) ?>, <?php echo intval($producto['stockPorTipo']) ?>)' <?php } ?> 
                                <?php if($_GET['tipo_descuento'] == 3){  ?>  
                                    onclick='muestra_stock_modifica_gramos(<?php echo $producto['id'] ?>, <?php echo intval($producto['stockPorUnitdad']) ?>, <?php echo intval($producto['stockPorTipo']) ?>)' 
                                    <?php } ?> 
                                class="btn btn-default" aria-label="Left Align" data-toggle="modal" data-toggle="modal" data-target="modal" data-whatever="@mdo">
                                  <span class="fas fa-edit" aria-hidden="true"></span>
                                </button>
                              </td>
                              <td>
                                <a <?php if($_SESSION['tipo'] == 1){ ?> href="ver_stock.php?id=<?php echo $producto['id'] ?>" <?php } ?>
                                  class="btn btn-default btn-xs glyphicon far fa-eye" target="_blank">
                                </a>
                              </td>
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


                  <div id="myModalStock" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                      <!-- Modal content-->
                      <div class="modal-content">
                        <form  name="miform" id="form1" method="post" action="../../intranet/funciones/procesamoderador2.php" >
                          <div class="modal-header">
                            <h4 class="modal-title">MODIFICA STOCK</h4>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
                              <input type="hidden" name="id_promocion" id="id_promocion2">
                                <div id="contenidoStock"></div>
                            </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" name="btnmodificastockunit" onClick="return validar()" class="btn btn-success">Modifica</button>
                              <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                            </div>
                          </form>
                        </div>
                      </div>
                  </div>


                  <div id="myModalStockOnzas" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                      <!-- Modal content-->
                      <div class="modal-content">
                        <form  name="miform" id="form1" method="post" action="../../intranet/funciones/procesamoderador2.php" >
                          <div class="modal-header">
                            <h4 class="modal-title">MODIFICA STOCK ONZAS</h4>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
                              <input type="hidden" name="id_promocion" id="id_promocion2">
                                <div id="contenidoStockOnzas"></div>
                            </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" name="btnmodificastockonzas" onClick="return validar()" class="btn btn-success">Modifica</button>
                              <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                            </div>
                          </form>
                        </div>
                      </div>
                  </div>



                  <div id="myModalStockGramos" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                      <!-- Modal content-->
                      <div class="modal-content">
                        <form  name="miform" id="form1" method="post" action="../../intranet/funciones/procesamoderador2.php" >
                          <div class="modal-header">
                            <h4 class="modal-title">MODIFICA STOCK GRAMOS</h4>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
                              <input type="hidden" name="id_promocion" id="id_promocion2">
                                <div id="contenidoStockGramos"></div>
                            </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" name="btnmodificastockgramos" onClick="return validar()" class="btn btn-success">Modifica</button>
                              <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                            </div>
                          </form>
                        </div>
                      </div>
                  </div>


                   


                <div class="container">
                  <div class="row">
                    <div class="col-md-6">
                      <a href="../../Reportes/Impresiones/ImprimeReporte.php?stock&tipo_descuento=<?php echo $_GET['tipo_descuento'] ?>" target="_blank" target="_blank"><button type="button" class="btn btn-success btn-block my-4">Reporte</button></a>
                    </div>
                    <div class="col-md-6">
                      <a href="index.php"><button type="button" class="btn btn-danger btn-block my-4">Volver</button></a>
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

<script src="../../js/bootbox.min.js"></script>
<?php 
    if(isset($_GET['success'])){
  ?>
    <script type="text/javascript">
      bootbox.alert("Stock Actualizado correctamente!");
    </script>
  <?php
    }
    if(isset($_GET['error'])){
  ?>
    <script type="text/javascript">
      bootbox.alert("Error Actualizado correctamente!");
    </script>
  <?php
    }
  ?>

</html>