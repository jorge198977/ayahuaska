<?php session_start();   ?>
<!DOCTYPE html>
<html>

<?php 
  include("header.php"); 
  include("../../intranet/funciones/controlador.php");
  date_default_timezone_set('America/Santiago');
  // error_reporting(E_ALL);
  // ini_set('display_errors', '1');
?>

<script type="text/javascript">

  function muestra_modal_detalle(id, forma_pago_id, venta_pago_id)
  {
    $('#myModal #id_promocion').val(id);   $.ajax({
           url: 'modal_ver_detalle.php',
           type: 'POST',
           data:{id:id, forma_pago_id:forma_pago_id, venta_pago_id:venta_pago_id},
           success: function(data){
                $('#contenido').html(data);
                $('#myModal').modal('show');
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
      $anio_actual = date("Y");
      if(isset($_GET['anio'])){
        $mes = $_GET['mes'];
        $anio = $_GET['anio'];
        $fech = $anio."-".$mes."%";
        $ventas = get_ventas_fecha_merma($fech);

      } 


    ?>



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">REPORTES MENSUALES</h3>
                </div>

                <form name="frmfiltro" method="get" action="index.php">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="input-group mb-4">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                          </div>
                          <select class="form-control" name="mes">
                            <option value="">Seleccione Mes</option>
                            <option value="01">ENERO</option>
                            <option value="02">FEBRERO</option>
                            <option value="03">MARZO</option>
                            <option value="04">ABRIL</option>
                            <option value="05">MAYO</option>
                            <option value="06">JUNIO</option>
                            <option value="07">JULIO</option>
                            <option value="08">AGOSTO</option>
                            <option value="09">SEPTIEMBRE</option>
                            <option value="10">OCTUBRE</option>
                            <option value="11">NOVIEMBRE</option>
                            <option value="12">DICIEMBRE</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="input-group mb-4">
                          <select class="form-control" name="anio" required>
                            <option value="">Seleccione año</option>
                            <?php
                              for($i = 2018; $i <= $anio_actual; $i++){
                            ?>
                              <option value="<?php echo $i ?>"><?php echo $i ?></option>  
                            <?php
                              }
                            ?>
                          </select>
                          <div class="input-group-append">
                            <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <div class="input-group mb-4">
                          <button type="submit" class="btn btn-success btn-lg btn-block">Filtrar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>

                <?php
                  if(isset($_GET['mes'])){
                ?>
                  
                  <div class="table-responsive">
                      <table  class="table table-flush">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">FECHA</th>
                            <th scope="col">MESA</th>
                            <th scope="col">N° INT</th>
                            <th scope="col">ATENDIDO POR</th>
                            <th scope="col">PRODUCTOS</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            foreach ($ventas as $key => $cierre) {
                           ?>   
                            <tr class="info">
                              <td><?php echo $cierre['fecha']. " ".$cierre['hora'] ?></td>
                              <td><?php 
                                echo $mesa = get_mesa_by_id($cierre['mesa_id']); 
                               ?>
                              </td>
                              <td><?php echo $cierre['venta_id'] ?></td>
                              <td>
                                <?php 
                                $mesero = get_usuario_id($cierre['usuario_id']);
                                $nombre_mesero = $mesero['nombre']." ".$mesero['apellido'];
                                echo $nombre_mesero;
                                ?>
                              </td>
                              <td>
                                <?php
                                  $ventas_detalles = get_ventas_detalles_id($cierre['venta_id']);
                                  foreach ($ventas_detalles as $key => $venta_detalle){
                                    $preparado = get_preparados_id($venta_detalle['preparado_id']);
                                    echo "-"." ".$venta_detalle['cantidad']." ".$preparado['PREPARADOS_NOMBRE']."<br>";
                                  }
                                ?>
                              </td> 
                              
                              
             
                            </tr>                 
                          <?php
                            }
                          ?>
                        </tbody>
                      </table>
                    </div>

                <?php    
                  }
                ?>
            </div>
          </div>

          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <a href="../index.php"><button type="button" class="btn btn-danger btn-block my-4">Volver</button></a>
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





</body>

</html>