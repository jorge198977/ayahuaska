<?php
   session_start(); 
   include("funciones/controlador.php");
   include("consulta_estado.php");
?>
<!DOCTYPE html>
<html>

<?php 
  include("head.php");
?>

<script type="text/javascript">

  function muestra_modal_boleta(folio, sucursal, fecha)
  {
    $('#myModalBoleta #id_promocion2').val(folio);   $.ajax({
           url: 'modal_boleta.php',
           type: 'POST',
           data:{folio:folio, sucursal:sucursal, fecha:fecha},
           success: function(data){
                $('#contenidoBoleta').html(data);
                $('#myModalBoleta').modal('show');
           }
       });
  }
</script>

<body>
  <!-- Sidenav -->
  <?php include("nav_back.php") ?>
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" >REPORTE BOLETAS</a>
        <!-- User -->
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">

          <div class="card card-stats mb-4 mb-lg-0 ma10">
             <div class="card-body">
                <div class="row">
                   <div class="col">
                      <form action="reporte_boletas.php" method="post">
                         <h6 class="heading-small text-muted mb-4">Ingrese datos</h6>
                         <div class="pl-lg-4">
                            <div class="row">
                              <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Folio</label>
                                        <input type="number" class="form-control" name="folio" id="folio" placeholder="Ingrese folio (opcional)">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>CLIENTE</label>
                                        <input type="number" class="form-control" name="cliente" id="cliente" placeholder="Ingrese cliente (opcional)">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                  <div class="form-group">
                                    <label>MES</label>
                                    <select class="form-control" name="mes" required>
                                        <option value="0">Elegir mes</option>
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
                                <div class="col-lg-4">
                                  <div class="form-group">
                                    <label>AÑO</label>
                                    <select class="form-control" name="anio" required>
                                        <option value="0">Elegir anio</option>
                                        <option value="2020">2020</option>
                                        <option value="2019">2019</option>
                                        <option value="2018">2018</option>
                                     </select> 
                                  </div>
                                </div>
                                <div class="col-lg-4">
                                  <div class="form-group">
                                    <label>EMPRESA</label>
                                    <select class="form-control" name="empresa" required>
                                        <option value="0">Elegir empresa</option>
                                        <option value="77123870-K">COMERCIALIZADORA Y SERVICIOS UNO LIMITADA</option>
                                        <option value="99500720-7">T V CABLE COLOR S A</option>
                                     </select> 
                                  </div>
                                </div>
                                <div class="col-lg-12">
                                  <div class="form-group">
                                     <input type="submit" name="btnconsultareporte" class="btn btn-success btn-lg btn-block" value="Consultar">
                                  </div>
                                </div>
                            </div>
                         </div>
                      </form>
                   </div>
                </div>

             </div>
          </div>

          <?php
            if(isset($_POST['btnconsultareporte'])){
              $folios = get_boletas_by_fecha($_POST['folio'], $_POST['cliente'], $_POST['mes'], $_POST['anio'], $_POST['empresa']);
          ?>

          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-12 col-lg-12">
              <div class="card card-stats mb-12 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                        
                        <div class="row">
                            <div class="col-md-12">  
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <strong>RESULTADO</strong>
                                    </div>
                                    <div class="panel-body">
			                                   
                                        <table class="table table-striped">
                                            <tr align="center">
                                                <td align="center"><b> FOLIO </b></td>
                                                <td align="center"><b> MONTO </b></td>
                                                <td align="center"><b> FECHA </b></td>
                                                <td align="center"><b> SUCURSAL </b></td>
                                                <td align="center"><b>  TRACKID </b></td>
                                                <td align="center"><b>  ESTADO </b></td>
                                                <td align="center"><b>  ACEP </b></td>
                                                <td align="center"><b>  RECH </b></td>
                                                <td align="center"><b>  REPA </b></td>
                                                <td align="center"><b>  VER </b></td>
                                            </tr>
                                            <?php
                                                foreach ($folios as $key => $folio) {
                                                  $estado = get_estado_by_trackid($folio['empresa'], $folio['trackid']);
                                            ?>
                                                <tr>
                                                    <td align="center"><?php echo $folio['folio'] ?> </td>
                                                    <td align="center"><?php echo number_format(($folio['monto']), 0, ',', '.') ?> </td>
                                                    <td align="center"><?php echo fecha_bd_normal($folio['fecha']) ?> </td>
                                                    <td align="center"><?php echo get_nombre_sucursal($folio['sucursal']) ?> </td>
                                                    <td align="center"><?php echo $folio['trackid'] ?> </td>
                                                    <td align="center"><?php echo $folio['estado_envio'] ?> </td>
                                                    <td align="center"><?php echo $estado['estadistica'][0]['aceptados'] ?> </td>
                                                    <td align="center"><?php echo $estado['estadistica'][0]['rechazados'] ?> </td>
                                                    <td align="center"><?php echo $estado['estadistica'][0]['reparos'] ?> </td>
                                                    <td align="center">

                                                      <button type="button" onclick='muestra_modal_boleta(<?php echo $folio['folio'] ?>, <?php echo $folio['sucursal'] ?>, "<?php echo $folio['fecha'] ?>")' class="btn btn-default" aria-label="Left Align" data-toggle="modal" data-toggle="modal" data-target=".bs-example-modal-lg" data-whatever="@mdo">
                                                        <span class="fas fa-print " aria-hidden="true"></span>
                                                      </button>

                                                    </td>
                                                </tr>
                                            <?php        
                                                }
                                            ?>
                                        </table>


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
    <?php
      
    }
    ?>


    <div id="myModalBoleta" tabindex="-1" class="modal fade" role="dialog" aria-labelledby="myLargeModalLabel">
      <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
          <form  name="formCambioReImprimir" id="formCambioReImprimir" method="post" action="#" >
            <div class="modal-header">
              <h4 class="modal-title">BOLETA ELECTRONICA</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                  <div id="contenidoBoleta"></div>
              </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
              </div>
            </form>
          </div>
        </div>
    </div>

    <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Page content -->
    <div class="container-fluid mt--7">

    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->



</body>

</html>