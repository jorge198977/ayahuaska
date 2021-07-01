<?php session_start();   ?>
<!DOCTYPE html>
<html>

<?php 
  include("header.php"); 
  include("../../intranet/funciones/controlador.php");
?>

<script type="text/javascript">

  function muestra_modal(id, familia)
  {
    $('#myModal5 #id_promocion2').val(id);   $.ajax({
           url: 'modal_productos.php',
           type: 'POST',
           data:{id:id, familia:familia},
           success: function(data){
                $('#contenido2').html(data);
                $('#myModal5').modal('show');
           }
       });
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
      $productos = get_producto_familia($_GET['Familia']);
      $nombre_familia = get_familia($_GET['Familia']);
      $familia_id = $_GET['Familia'];
    ?>



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">PRODUCTOS - <?php echo $nombre_familia ?></h3>
                </div>


                  <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                     <div class="table-responsive">
                      <table id="example1" class="table table-flush">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">COSTO</th>
                            <th scope="col">UNID INI</th>
                            <th scope="col">F.DSCTO</th>
                            <!-- <th scope="col">CAPACIDAD</th> -->
                            <th scope="col">Stock</th>
                            <th scope="col">Stock Por Unidad</th>
                            <th scope="col">Stock Mínimo</th>
                            <th scope="col">Estado del Stock</th>
                            <th scope="col">ACCION</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                             foreach ($productos as $key => $prod) {
                              
                              $estado_stock = "";
                              if(stock_critico($prod['id'])){
                                $estado_stock = "CRITICO";
                              }
                              else{
                                $estado_stock = "NORMAL";
                              }
                          ?>
                            <tr>
                              <th><?php echo $prod['nombre'] ?></th>
                              <th><?php echo number_format($prod['costo'], 2, ',', '.') ?></th>
                              <th><?php echo $prod['unidadinicial'] ?></th>
                              <th>
                                <?php
                                  echo get_nombre_tipo_descuento($prod['tipo_descuento']);
                                ?>
                              </th>
                              <!-- <th><?php echo $prod['capacidad'] ?></th> -->
                              <th><?php echo stockUnidadBy_idProducto($prod['id']) ?></th>
                              <th><?php echo stockTipoBy_idProducto($prod['id']) ?></th>
                              <th><?php echo $prod['stock_minimo'] ?></th>
                              <th align="center" <?php if($estado_stock != "NORMAL"){ ?>  bgcolor="red" <?php } else{ ?>  bgcolor="green" <?php } ?> >
                                <strong><?php echo $estado_stock ?></th></strong>
                              <th>
                                <a onclick="return (confirmDel(<?php echo $prod['id'] ?>, <?php echo $familia_id ?>));">
                                  <button type="button" name="btnelimbeb" value="btnelimbeb" class="btn btn-default"  aria-label="Left Align">
                                  <span class="fas fa-trash" aria-hidden="true"></span>
                                  </button>
                                </a>
                                <button type="button" onclick='muestra_modal(<?php echo $prod['id'] ?>, <?php echo $familia_id ?>)' class="btn btn-default" aria-label="Left Align" data-toggle="modal" data-toggle="modal" data-target="modal" data-whatever="@mdo">
                                <span class="fas fa-edit" aria-hidden="true"></span>
                                </button>

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


                <div class="container">
                  <div class="row">
                    <div class="col">
                       <button type="button" onclick='muestra_modal(0, <?php echo $familia_id ?>)' class="btn btn-success btn-block my-4" data-toggle="modal" data-toggle="modal" data-target="modal" data-whatever="@mdo">Nuevo</button>
                    </div>
                    <div class="col">
                      <a href="productos.php"><button type="button" class="btn btn-danger btn-block my-4">Volver</button></a>
                    </div>
                  </div>
                </div>


                <div id="myModal5" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <form  name="miform" id="form1" method="post" action="../../intranet/funciones/procesamoderador2.php" >
                        <div class="modal-header">
                          <h4 class="modal-title">PRODUCTO</h4>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                            <input type="hidden" name="id_promocion" id="id_promocion2">
                              <div id="contenido2"></div>
                          </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Siguiente</button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                          </div>
                        </form>
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

  <script src="../../js/bootbox.min.js"></script>
  <script type="text/javascript">
    function confirmDel(id, familia_id){
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
            if(result){
              location.href = "../../intranet/funciones/procesamoderador2.php?EliminaProducto="+id+"&Familia="+familia_id+""; 
            }
            else{
              
            }
        }
    });
    }
  </script>


  <?php 
    if(isset($_GET['Eliminado'])){
  ?>
    <script type="text/javascript">
      bootbox.alert("Eliminado correctamente!");
    </script>
  <?php
    }
    if(isset($_GET['ErrorEliminando'])){
  ?>
    <script type="text/javascript">
      bootbox.alert("Error Eliminando!");
    </script>
  <?php
    }
    if(isset($_GET['Ingresado'])){
  ?>
    <script type="text/javascript">
      bootbox.alert("Ingresado correctamente!");
    </script>
  <?php
    }
    if(isset($_GET['ErrorIngresando'])){
  ?>
    <script type="text/javascript">
      bootbox.alert("Error al ingresar!");
    </script>
  <?php
    }
    if(isset($_GET['Actualizado'])){
  ?>
    <script type="text/javascript">
      bootbox.alert("Actualizado correctamente!");
    </script>
  <?php
    }
    if(isset($_GET['ErrorActualizando'])){
  ?>
    <script type="text/javascript">
      bootbox.alert("Error al actualizar!");
    </script>
  <?php
    }
  ?>


</body>

</html>