<?php session_start();   ?>
<!DOCTYPE html>
<html>

<?php 
  include("header.php"); 
  include("../intranet/funciones/controlador.php");
?>

<script type="text/javascript">

  function muestra_modal(id)
  {
    $('#myModal5 #id_promocion2').val(id);   $.ajax({
           url: 'modal_cambia_estado.php',
           type: 'POST',
           data:{id:id},
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
      $compras = get_all_compras();
    ?>



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">COMPRAS</h3>
                </div>


                  <div >
                    <!-- /.box-header -->
                    <div class="box-body">
                     <div class="table-responsive">
                      <table id="example1" class="table table-flush">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">N° FACTURA</th>
                            <th scope="col">PROVEEDOR</th>
                            <th scope="col">VALOR ($)</th>
                            <th scope="col">F. PAGO</th>
                            <th scope="col">FECHA</th>
                            <th scope="col">ESTADO</th>
                            <th scope="col">NUM TRANSF/CHEQUE</th>
                            <th scope="col">ACCIÓN</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            foreach ($compras as $key => $compra) {
                              $fpago = get_froma_pago_compra_by_id($compra['forma_pago_compra_id']);
                           ?>   
                              <tr class="active">
                                  <td><?php echo $compra['num_factura'] ?></td>
                                  <td>
                                    <?php 
                                    $proveedor = get_proveedor_id($compra['proveedor_id']);
                                    echo $proveedor['nombre'];
                                    ?>
                                  </td>
                                  <td><?php echo number_format($compra['total'], 0 , ',', '.') ?></td>
                                  <td><?php echo $fpago ?></td>
                                  <td><?php echo substr($compra['fecha'], 8, 2)."-".substr($compra['fecha'], 5, 2)."-".substr($compra['fecha'], 0, 4) ?></td>
                                  <td <?php  if($compra['estado'] == 1){ ?> bgcolor="green" <?php } ?>> <strong> <?php  if($compra['estado'] == 1){ echo "PAGADA";} else{ echo "NO PAGADA"; } ?></strong></td>
                                   <td>
                                    <?php  
                                      if($compra['num_transferencia'] != ""){ echo $compra['num_transferencia'];} 
                                      if($compra['num_cheque'] != ""){ echo $compra['num_cheque'];} 
                                      ?>
                                  </td>
                                  <td>
                                      <a href="factura/factura.php?id=<?php echo $compra['id'] ?>" target="_blank">
                                        <button type="button" name="btnelimbeb" value="btnelimbeb" class="btn btn-default" aria-label="Left Align">
                                        <span class="far fa-eye" aria-hidden="true" ></span>
                                        </button>
                                      </a>

                                      <button type="button" onclick='muestra_modal(<?php echo $compra['id'] ?>)' class="btn btn-default" aria-label="Left Align" data-toggle="modal" data-toggle="modal" data-target="modal" data-whatever="@mdo">
                                      <span class="fas fa-calendar-check" aria-hidden="true"></span>
                                      </button>


                                      <a onclick="return (confirmDel(<?php echo $compra['id'] ?>));">
                                        <button type="button" name="btnelimbeb" value="btnelimbeb" class="btn btn-default"  aria-label="Left Align">
                                        <span class="fas fa-trash" aria-hidden="true"></span>
                                        </button>
                                      </a>

                                  </td>
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
                       <a href="Factura/index.php" target="_blank"><button type="button" class="btn btn-success btn-block my-4" data-toggle="modal" data-toggle="modal" data-target="modal" data-whatever="@mdo">Nuevo</button></a>
                    </div>
                    <div class="col">
                      <a href="../inicio.php"><button type="button" class="btn btn-danger btn-block my-4">Volver</button></a>
                    </div>
                  </div>
                </div>


                <div id="myModal5" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <form  name="miform" id="form1" method="post" action="../intranet/funciones/procesamoderador2.php" >
                        <div class="modal-header">
                          <h4 class="modal-title">CAMBIA ESTADO</h4>
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
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.0.0"></script>

   <!-- DataTables -->
  
  <script src="../intranet/plugins/datatables/jquery.dataTables.min.js"></script>

  <script src="../js/bootbox.min.js"></script>
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
              location.href = "../intranet/funciones/procesamoderador2.php?ElimFactura="+id+""; 
            }
            else{
              
            }
        }
    });
    }
  </script>

  <?php 
    if(isset($_GET['Eliminada'])){
  ?>
    <script type="text/javascript">
      bootbox.alert("Factura eliminada correctamente!");
    </script>
  <?php
    }
  ?>

  <!-- page script -->




</body>

</html>