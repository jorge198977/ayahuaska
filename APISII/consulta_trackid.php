<?php
   session_start(); 
   include("consulta_estado.php")
?>
<!DOCTYPE html>
<html>

<?php 
  include("head.php");
?>

<body>
  <!-- Sidenav -->
  <?php include("nav_back.php") ?>
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" >Consulta Bol Electrónica</a>
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
                      <form action="consulta_trackid.php" method="post">
                         <h6 class="heading-small text-muted mb-4">Ingrese datos</h6>
                         <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>TRACKID</label>
                                        <input type="text" class="form-control" name="trackid" id="trackid" placeholder="Ingrese trackid">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                  <div class="form-group">
                                    <select class="form-control" name="empresa" required>
                                        <option value="0">Elegir empresa</option>
                                        <option value="10">UNO</option>
                                        <option value="99500720-7">TVCABLE</option>
                                     </select> 
                                  </div>
                                </div>
                                <div class="col-lg-12">
                                  <div class="form-group">
                                     <input type="submit" name="btnconsultatrackid" class="btn btn-success btn-lg btn-block" value="Consultar">
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
            if(isset($_POST['btnconsultatrackid'])){
              $estado = get_estado_by_trackid($_POST['empresa'], $_POST['trackid']);
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
                                        <strong>RESPUESTA DEL SII</strong>
                                    </div>
                                    <div class="panel-body">
                                        <div class="alert alert-secondary" role="alert">
                                            <strong> RUTENVIA: <?php echo $estado['rut_envia']. "<br> FECHA RECEP: ".$estado['fecha_recepcion']."<br> ESTADO: ".$estado['estado']."<br> INFORMADOS: ".$estado['estadistica'][0]['informados']." <br> ACEPTADO: ".$estado['estadistica'][0]['aceptados']." <br> RECHAZADOS: ".$estado['estadistica'][0]['rechazados']." <br> REPAROS: ".$estado['estadistica'][0]['reparos']; ?></strong>
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
        </div>
    <?php
      
    }
    ?>
    <!-- Page content -->
    <div class="container-fluid mt--7">

    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->



</body>

</html>