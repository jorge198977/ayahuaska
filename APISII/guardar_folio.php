<?php
   session_start(); 
   include("../intranet/funciones/controlador.php");
   include("manejo_folios.php");
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" >Guardar Folio</a>
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
                      <form action="guardar_folio.php" method="post" enctype="multipart/form-data">
                         <h6 class="heading-small text-muted mb-4">Ingrese datos</h6>
                         <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-12">
                                  <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="folio" name="folio" lang="es">
                                        <label class="custom-file-label" for="customFileLang">Archivo XML de folios</label>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-lg-12">
                                  <div class="form-group">
                                     <input type="submit" name="btnagregafolio" class="btn btn-success btn-lg btn-block" value="Consultar">
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
            if(isset($_POST['btnagregafolio'])){
              //$ambiente = "certificación";
              $ambiente = "producción";
              $carpetaDestino = "xml/empresas/TURQUESA";
              if(file_exists($carpetaDestino) || @mkdir($carpetaDestino)){
                $archivo = basename($_FILES['folio']['name']); 
                $extension = pathinfo($archivo, PATHINFO_EXTENSION);
                $archivo = md5($archivo);
                $origen=$_FILES["folio"]["tmp_name"];
                $destino=$carpetaDestino."/".$archivo.".".$extension;
                $nombre = $archivo.".".$extension;
                if(move_uploaded_file($origen, $destino)){
                  $empresa = "76324007-K";
                  $resp = set_folios($empresa, $ambiente, file_get_contents($destino), $nombre);
                }
              }
            
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
                                            <strong> <?php echo $resp; ?></strong>
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