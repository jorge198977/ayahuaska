<?php session_start();   ?>
<!DOCTYPE html>
<html>

<?php 
  include("header.php"); 
  include("../../intranet/funciones/controlador.php");
?>

<script type="text/javascript">

  function muestra_modal(id)
  {
    $('#myModal5 #id_promocion2').val(id);   $.ajax({
           url: 'modal_proveedores.php',
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
      $clientes = get_all_clientes();
      $total = 0;
    ?>



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">DEUDORES</h3>
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
                            <th scope="col">EMAIL</th>
                            <th scope="col">DEBE</th>
                            <th scope="col">ACCIÓN</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $clientes = get_all_clientes();
                            $total = 0;
                            foreach ($clientes as $key => $cliente) {

                            $monto_adeudado = get_monto_adeudado($cliente['id']);
                            $total = $total + $monto_adeudado;
                            if($monto_adeudado > 0){
                          ?> 
                          <tr>
                            <th><?php echo $cliente['rut'] ?></th>
                            <th><?php echo $cliente['nombre'] ?></th>
                            <th><?php echo $cliente['direccion'] ?></th>
                            <th><?php echo $cliente['correo'] ?></th>
                            <th><?php echo "$".number_format($monto_adeudado, 0, ',', '.') ?></th>
                            <th>
                              <a href="enviar_correo.php?cliente_id=<?php echo $cliente['id'] ?>">
                                  <button type="button" class="btn btn-default" aria-label="Left Align">
                                    <span class="fas fa-envelope" aria-hidden="true"></span>
                                  </button>
                              </a> 
                            </th>
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
                <br>
                <div class="alert alert-primary" role="alert">
                    <center><strong>Total adeudado!</strong> $<?php echo number_format($total, 0, ',', '.') ?></center>
                </div>

                <div class="container">
                  <div class="row">
                    <div class="col">
                      <a href="enviar_correo.php"><button type="button" class="btn btn-success btn-block my-4">Enviar Correo</button></a>
                    </div>
                    <div class="col">
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

</html>