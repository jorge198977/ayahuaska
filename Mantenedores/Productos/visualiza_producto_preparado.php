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
           url: 'modal_preparados.php',
           type: 'POST',
           data:{id:id, familia:familia},
           success: function(data){
                $('#contenido2').html(data);
                $('#myModal5').modal('show');
           }
       });
  }

  function muestra_modal_descuento(id, familia)
  {
    $('#myModalDescuento #id_promocion2').val(id);   $.ajax({
           url: 'modal_descuentos.php',
           type: 'POST',
           data:{id:id, familia:familia},
           success: function(data){
                $('#contenidoDescuento').html(data);
                $('#myModalDescuento').modal('show');
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
      $preparados = get_preparados_familia($_GET['Familia']);
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
                  <h3 class="mb-0">PRODUCTOS PREPARADOS - <?php echo $nombre_familia ?></h3>
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
                            <th scope="col">DESCUENTO</th>
                            <th scope="col">ACCION</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                             foreach ($preparados as $key => $prep) {
                              $prep_descuentos = get_producto_preparados_id_prep($prep['id']);
                          ?> 
                            <tr>
                              <th>
                                
                                <a onclick="return (confirmDel(<?php echo $prep['id'] ?>, <?php echo $_GET['Familia'] ?>));">
                                  <button type="button" name="btnelimbeb" value="btnelimbeb" class="btn btn-default"  aria-label="Left Align">
                                  <span class="fas fa-trash" aria-hidden="true"></span>
                                  </button>
                                </a>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <?php echo $prep['nombre'] ?>                                  
                              </th>
                              <th><?php echo number_format($prep['precio'], 0, ',', '.') ?></th>
                              <th>
                                <?php
                                  foreach ($prep_descuentos as $key => $prep_descuento) {
                                    $nombre_producto = get_producto($prep_descuento['producto_id']);
                                  ?>
                                      <!-- <a onclick="return (confirmDel(<?php echo $prep_descuento['producto_id'] ?>, <?php echo $familia_id ?>, <?php echo $prep['id'] ?>));">
                                        <button type="button" name="btnelimbeb" value="btnelimbeb" class="btn btn-default"  aria-label="Left Align">
                                        <span class="fas fa-trash" aria-hidden="true"></span>
                                        </button>
                                      </a> -->
                                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <?php echo $nombre_producto['PRODUCTO_NOMBRE']." ".$prep_descuento['cantidad']." ".get_nombre_tipo_descuento($nombre_producto['TIPO_DESCUENTO_ID']); ?>
                                      
                                      
                                    <br><br>
                                  <?php
                                  }
                                ?>
                              </th>
                              <th>
                               <!--  <button type="button" onclick='muestra_modal_descuento(<?php echo $prep['id'] ?>, <?php echo $familia_id ?>)' class="btn btn-default" aria-label="Left Align" data-toggle="modal" data-toggle="modal" data-target="modal" data-whatever="@mdo">
                                <span class="far fa-clipboard" aria-hidden="true"></span>
                                </button> -->
                                <a href="ver_descuento_preparado.php?id=<?php echo $prep['id'] ?>&familia_id=<?php echo $familia_id ?>">
                                 <button type="button" class="btn btn-default" aria-label="Left Align">
                                <span class="far fa-clipboard" aria-hidden="true"></span>
                                </button>
                                </a>

                                <button type="button" onclick='muestra_modal(<?php echo $prep['id'] ?>, <?php echo $familia_id ?>)' class="btn btn-default" aria-label="Left Align" data-toggle="modal" data-toggle="modal" data-target="modal" data-whatever="@mdo">
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
                      <a href="productos_preparados.php"><button type="button" class="btn btn-danger btn-block my-4">Volver</button></a>
                    </div>
                  </div>
                </div>


                <div id="myModal5" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <form  name="miform" id="form1" method="post" action="../../intranet/funciones/procesamoderador2.php" >
                        <div class="modal-header">
                          <h4 class="modal-title">PREPARADO</h4>
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

                <div id="myModalDescuento" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <form  name="miform" id="form1" method="post" action="../../intranet/funciones/procesamoderador2.php" >
                        <div class="modal-header">
                          <h4 class="modal-title">DESCUENTOS</h4>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                              <div id="contenidoDescuento">

                              </div>
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
              location.href = "../../intranet/funciones/procesamoderador2.php?EliminaProducto_preparado="+id+"&Familia="+familia_id+""; 
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