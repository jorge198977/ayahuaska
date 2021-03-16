<?php
include("../intranet/funciones/controlador.php");
$propinas_pendientes = get_propinas_estado(0);
?>

<?php echo $cliente['nombre'] ?>  

<div class="box">
  <!-- /.box-header -->
  <div class="box-body">
   <div class="table-responsive">
    <table id="example2" class="table table-flush">
      <thead class="thead-light">
        <tr>
          <th scope="col">MESERO</th>
          <th scope="col">PROPINA</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($propinas_pendientes as $key => $propina_pendiente) {
              ?>
               <tr class="info">
                  <td><?php 
                    $mesero = get_usuario_id($propina_pendiente['usuario_id']);
                    $nombre_mesero = $mesero['nombre']." ".$mesero['apellido'];
                    echo $nombre_mesero;
                    ?>
                  </td>
                  <td><?php 
                    echo number_format($propina_pendiente['propina'], 0, ',', '.');
                   ?></td>
                </tr>         
          <?php  
          }
          ?>
      </tbody>
    </table>
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
  
  <script src="../../intranet/plugins/datatables/jquery.dataTables.min.js"></script>

  <!-- page script -->
  <script>
    $(function () {
       $("#example2").DataTable();

    });
  </script>