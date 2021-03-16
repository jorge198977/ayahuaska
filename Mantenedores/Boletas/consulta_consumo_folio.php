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
                  <h3 class="mb-0">CONSULTA RCOFS</h3>
                </div>

                <form name="frmguardarfolios" method="post" action="consulta_consumo_folio.php">
                  <div class="container">
                      
                      <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>FECHA</label>
                                <input type="date" class="form-control" name="fecha" id="fecha" placeholder="Ingrese Fecha (opcional)">
                            </div>
                        </div>
                        <!-- <div class="col-lg-6">
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
                        <div class="col-lg-6">
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
                        </div> -->
                        <div class="col-lg-12">
                          <div class="form-group">
                             <input type="submit" name="btnconsultareportercofs" class="btn btn-success btn-lg btn-block" value="Consultar">
                          </div>
                        </div>
                    </div>


                  </div>
                </form>

                <?php
                  if(isset($_POST['btnconsultareportercofs'])){
                     $rcofs = get_rcofs_fecha($_POST['fecha']);
                      $fecha_rep = strtotime ( '-1 day' , strtotime ( $_POST['fecha'] ) ) ;
                      $fecha_rep = date ( 'Y-m-j' , $fecha_rep );
                ?>


                    <div class="container">
                        
                        <div class="row">
                            <div class="col-md-12">  
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <strong>REPORTE RCOF ENVIADO EL <?php echo fecha_bd_normal($_POST['fecha']) ?> CON CONSUMO DE FOLIO DE <?php echo fecha_bd_normal($fecha_rep) ?> PARA SHEOL</strong>
                                    </div>
                                    <div class="panel-body">
                                         
                                        <table class="table table-sm">
                                           <div class="table-responsive">
                                            <tr align="center">
                                                <td align="center"><b> CANTIDAD </b></td>
                                                <td align="center"><b> FOLIO DESDE </b></td>
                                                <td align="center"><b> FOLIO HASTA </b></td>
                                                <td align="center"><b> TOTAL </b></td>
                                                <td align="center"><b> TRACKID </b></td>
                                            </tr>
                                            <?php
                                                $total = 0;
                                                foreach ($rcofs as $key => $rcof) {
                                                  $total = $total + $folio['monto'];
                                                  //$estado = get_estado_by_trackid($folio['empresa'], $folio['trackid']);
                                            ?>
                                               <tr>
                                                    <td align="center"><?php echo $rcof['cantidad'] ?> </td>
                                                    <td align="center"><?php echo $rcof['desde'] ?> </td>
                                                    <td align="center"><?php echo $rcof['hasta'] ?> </td>
                                                    <td align="center"><?php echo number_format($rcof['total'], 0, ',', '.') ?> </td>
                                                    <td align="center"><?php echo $rcof['trackid'] ?> </td>
                                                </tr>
                                            <?php        
                                                }
                                            ?>
                                            
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