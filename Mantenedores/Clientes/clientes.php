<?php session_start();   ?>
<!DOCTYPE html>
<html>

<?php 
  include("header.php"); 
  include("../../intranet/funciones/controlador.php");
?>

<script type="text/javascript">

  function enviar(){
    if(formabono.montoabono.value == ""){
      alert("Debe ingresar monto de abono");
      return false;
    }

    if(parseInt(formabono.deuda.value) < parseInt(formabono.montoabono.value)){
      alert("Monto de abono no puede ser mayor a la deuda");
      document.formabono.montoabono.focus();
      return false;
    }
    else{
      var ElementoRemover= document.getElementById('btnabonar');
      ElementoRemover.removeAttributeNode;
      padre = ElementoRemover.parentNode;
      padre.removeChild(ElementoRemover);
      formabono.action='../../intranet/funciones/procesapedido2.php'; // Defino el action
      formabono.method='post'; // Defino el metodo de envio
      formabono.submit(); // Envio los datos
    }
  }

  function muestra_modal(id)
  {
    $('#myModal5 #id_promocion2').val(id);   $.ajax({
           url: 'modal_clientes.php',
           type: 'POST',
           data:{id:id},
           success: function(data){
                $('#contenido2').html(data);
                $('#myModal5').modal('show');
           }
       });
  }

  function muestra_modal_consumo(id)
  {
    $('#myModalConsumo #id_promocion2').val(id);   $.ajax({
           url: 'modal_consumos.php',
           type: 'POST',
           data:{id:id},
           success: function(data){
                $('#contenidoConsumo').html(data);
                $('#myModalConsumo').modal('show');
           }
       });
  }

  function muestra_modal_abono(id)
  {
    $('#myModalAbono #id_promocion2').val(id);   $.ajax({
           url: 'modal_abonos.php',
           type: 'POST',
           data:{id:id},
           success: function(data){
                $('#contenidoAbono').html(data);
                $('#myModalAbono').modal('show');
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
      $clientes = get_all_clientes();
    ?>



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">CLIENTES</h3>
                </div>


                  <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                     <div class="table-responsive">
                      <table id="example1" class="table table-flush">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">RUT</th>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">DIRECCION</th>
                            <th scope="col">FONO</th>
                            <th scope="col">EMAIL</th>
                            <th scope="col">CUPO</th>
                            <th scope="col">DISPONIBLE</th>
                            <th scope="col">ACCION</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                             foreach ($clientes as $key => $cli) {
                                $monto_adeudado = get_monto_adeudado($cli['id']);
                                $disponible = $cli['cupo'] - $monto_adeudado;
                          ?> 
                          <tr>
                            <th><?php echo $cli['rut'] ?></th>
                            <th><?php echo $cli['nombre'] ?></th>
                            <th><?php echo $cli['direccion'] ?></th>
                            <th><?php echo $cli['telefono'] ?></th>
                            <th><?php echo $cli['correo'] ?></th>
                            <th><?php echo number_format($cli['cupo'], 0, ',', '.') ?></th>
                            <th><?php echo number_format($disponible, 0, ',', '.') ?></th>
                            <th>
                              <button type="button" onclick='muestra_modal_consumo(<?php echo $cli['id'] ?>)' class="btn btn-default" aria-label="Left Align" data-toggle="modal" data-toggle="modal" data-target="modal" data-whatever="@mdo">
                                  <span class="far fa-eye" aria-hidden="true"></span>
                              </button>
                              <a onclick="return (confirmDel(<?php echo $cli['id'] ?>));">
                                  <button type="button" name="btnelimbeb" value="btnelimbeb" class="btn btn-default"  aria-label="Left Align">
                                  <span class="fas fa-trash" aria-hidden="true"></span>
                                  </button>
                              </a>
                              <button type="button" onclick='muestra_modal(<?php echo $cli['id'] ?>)' class="btn btn-default" aria-label="Left Align" data-toggle="modal" data-toggle="modal" data-target="modal" data-whatever="@mdo">
                                  <span class="fas fa-edit" aria-hidden="true"></span>
                              </button>
                              <?php 
                                if($cli['cupo'] > $disponible){
                              ?>
                                <button type="button" onclick='muestra_modal_abono(<?php echo $cli['id'] ?>)' class="btn btn-default" aria-label="Left Align" data-toggle="modal" data-toggle="modal" data-target="modal" data-whatever="@mdo">
                                  <span class="fas fa-money-bill" aria-hidden="true"></span>
                                </button>
                              <?php
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


                <div class="container">
                  <div class="row">
                    <div class="col">
                       <button type="button" onclick='muestra_modal(0)' class="btn btn-success btn-block my-4" data-toggle="modal" data-toggle="modal" data-target="modal" data-whatever="@mdo">Nuevo</button>
                    </div>
                    <div class="col">
                      <a href="index.php"><button type="button" class="btn btn-danger btn-block my-4">Volver</button></a>
                    </div>
                  </div>
                </div>


                <div id="myModal5" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <form  name="miform" id="form1" method="post" action="../../intranet/funciones/procesamoderador2.php" >
                        <div class="modal-header">
                          <h4 class="modal-title">CLIENTES</h4>
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



                <div id="myModalConsumo" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">CONSUMO</h4>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                          <div id="contenidoConsumo"></div>
                        </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-warning" data-dismiss="modal">CERRAR</button>
                        </div>
                      </div>
                    </div>
                </div>

                <div id="myModalAbono" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-lg">
                    <form  name="formabono" id="formabono">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">ABONO</h4>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                            <div id="contenidoAbono"></div>
                          </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" name="btnabonar" id="btnabonar" class="btn btn-success" onclick="enviar()">Abonar</button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">CERRAR</button>
                          </div>
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
    function confirmDel(id){
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
              location.href = "../../intranet/funciones/procesamoderador2.php?Elimcliente=="+id+""; 
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