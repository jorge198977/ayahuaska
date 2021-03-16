<?php session_start();   ?>
<!DOCTYPE html>
<html>

<?php 
  include("header.php"); 
  include("../../intranet/funciones/controlador.php");
  date_default_timezone_set('America/Santiago');
?>


<body>
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
          
          <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">REPORTE DE BOLETAS</h3>
                </div>

                <form name="frmguardarfolios" method="post" action="reportes_boletas.php">
                  <div class="container">
                      
                      <div class="row">
                              <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Folio</label>
                                        <input type="number" class="form-control" name="folio" id="folio" placeholder="Ingrese folio (opcional)">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>FECHA</label>
                                        <input type="date" class="form-control" name="fecha" id="fecha" placeholder="Ingrese Fecha (opcional)">
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
                                        <?php for($i = 2020; $i <= date("Y"); $i++){
                                        ?>
                                          <option value='<?php echo $i ?>'><?php echo $i ?></option>
                                        <?php  
                                        } ?>
                                        
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

                <?php
                  if(isset($_POST['btnconsultareporte'])){
                    //$folios = "";
                    $folios = get_boletas_by_fecha($_POST['folio'], $_POST['fecha'], $_POST['mes'], $_POST['anio']);
                ?>


                    <div class="container">
                        
                        <div class="row">
                            <div class="col-md-12">  
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <strong>RESULTADO</strong>
                                    </div>
                                    <div class="panel-body">
                                         
                                        <table class="table table-sm">
                                           <div class="table-responsive">
                                            <tr align="center">
                                                <td align="center"><b> FOLIO </b></td>
                                                <td align="center"><b> MOV </b></td>
                                                <td align="center"><b> MONTO </b></td>
                                                <td align="center"><b> FECHA </b></td>
                                                <td align="center"><b>  TRACKID </b></td>
                                                <td align="center"><b>  ESTADO </b></td>
                                            </tr>
                                            <?php
                                                $total = 0;
                                                foreach ($folios as $key => $folio) {
                                                  $total = $total + $folio['monto'];
                                                  //$estado = get_estado_by_trackid($folio['empresa'], $folio['trackid']);
                                            ?>
                                                <tr>
                                                    <td align="center"><?php echo $folio['folio'] ?> </td>
                                                    <td align="center"><?php echo $folio['movimiento'] ?> </td>
                                                    <td align="center"><?php echo number_format(($folio['monto']), 0, ',', '.') ?> </td>
                                                    <td align="center"><?php echo fecha_bd_normal($folio['fecha']) ?> </td>
                                                    <td align="center"><?php echo $folio['trackid'] ?> </td>
                                                    <td align="center"><?php echo $folio['estado_envio'] ?> </td>
                                                    <!-- <td align="center">

                                                      <button type="button" onclick='muestra_modal_boleta(<?php echo $folio['folio'] ?>, <?php echo $folio['sucursal'] ?>, "<?php echo $folio['fecha'] ?>")' class="btn btn-default" aria-label="Left Align" data-toggle="modal" data-toggle="modal" data-target=".bs-example-modal-lg" data-whatever="@mdo">
                                                        <span class="fas fa-print " aria-hidden="true"></span>
                                                      </button>

                                                    </td> -->
                                                </tr>
                                            <?php        
                                                }
                                            ?>
                                            <tr>
                                              <td align="right"><strong><h3>MONTO TOTAL: <?php echo number_format(($total), 0, ',', '.') ?></h3></strong> </td>
                                            </tr>
                                          </div>
                                        </table>


                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>



                <?php
                }
                ?>
                  
                

                <div class="container">
                  <div class="row">
                    <div class="col-md-12">
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





</body>

</html>