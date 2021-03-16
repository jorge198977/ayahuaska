<!DOCTYPE html>
<html>

<?php 
  include("header.php"); 
  include("intranet/funciones/controlador.php");
?>

<script type="text/javascript">

  var statSend = false;

  function valida_envio(){

    if (!statSend) {
        statSend = true;
        return true;
    } else {
        alert("Enviando datos...no volver a presionar el botón");
        return false;
    }
  }


  function muestra_modal(id)
  {
    $('#myModal5 #id_promocion2').val(id);   $.ajax({
           url: 'Clientes/modal_subir_foto.php',
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


    <?php
      if(isset($_GET['qrcli'])){
          $mesa_id = get_mesa_by_num($_GET['Mesa']);
          $movimiento = get_venta_by_mesa_estado($mesa_id, 0);
          $usuario = get_usuario_id($movimiento['usuario_id']);
          $socio_id = get_vta_socio_id($movimiento['id']);
          if($socio_id != ""){
              $socio = get_socio_id($socio_id);
              $nombre_socio = utf8_encode($socio['nombre']);
              $puntos = intval(redondeo(get_puntos_socio($socio_id, 0) * 0.001));
          }
          else{
              $nombre_socio = "";
              $puntos = 0;
          }

          if($puntos > 0){
              $venta = get_venta_id($movimiento['id']);
              $ventas_detalles = get_ventas_detalles_id($movimiento['id']);   
              $total = 0;
              $sumatoria_descuento = 0; 
              foreach ($ventas_detalles as $key => $venta_detalle) {
                  $desc = 0;
                  $preparado = get_preparados_id($venta_detalle['preparado_id']);
                  $descuento_familia = get_descuento_familia_by_familia_id($preparado['PREPARADOS_FAMILIA']);
                  if($descuento_familia['descuento'] != ""){
                    $dentro_horario = dentro_de_horario($descuento_familia['hora_inicial'], $descuento_familia['hora_final'], $venta_detalle['hora']);
                    if($dentro_horario == 1){
                      $desc = $descuento_familia['descuento'] * $venta_detalle['cantidad'];
                      $sumatoria_descuento = $sumatoria_descuento + intval($desc);
                    }
                    else{
                      $desc = 0;
                    }
                  }
                  $total = $total + (($preparado['PREPARADOS_PRECIO']*$venta_detalle['cantidad']) - $desc);
              }
          } 
    ?> 


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
          <!-- Card stats -->
          <div class="row">

            <div class="container-fluid d-flex align-items-center">
              <div class="row">
                <div class="col-lg-12 col-md-12">
                  <h2 class="display-2 text-white">Mesa: <?php echo $_GET['Mesa'] ?></h2>
                  <h1 class="display-2 text-white">Hola <?php echo utf8_decode($nombre_socio) ?>, tus puntos son <?php echo $puntos ?></h1>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                 <a href="Clientes/Carta/cartaturquesa.pdf" target="_blank"> 
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h2 class="card-title text-uppercase text-muted mb-0">CARTA</h2>
                        <span class="h2 font-weight-bold mb-0"></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                          <i class="fas fa-book-open"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                      <span class="text-nowrap">Visualiza Nuestra Carta</span>
                    </p>
                  </div>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <a href="Clientes/eventos.php?Mov=<?php echo $movimiento['id'] ?>&qrcli&Mesa=<?php echo $_GET['Mesa'] ?>">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h2 class="card-title text-uppercase text-muted mb-0">EVENTOS</h2>
                        <span class="h2 font-weight-bold mb-0"></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                          <i class="fas fa-music"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> </span>
                      <span class="text-nowrap">Nuestros Eventos</span>
                    </p>
                  </div>
                </a>
              </div>
            </div>
            <!-- <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <a href="Clientes/karaokes.php?Mesa=<?php echo $_GET['Mesa'] ?>">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h2 class="card-title text-uppercase text-muted mb-0">KARAOKE</h2>
                        <span class="h2 font-weight-bold mb-0"></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                          <i class="fas fa-microphone"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <span class="text-success mr-2"><i class="fas fa-arrow-up"></i></span>
                      <span class="text-nowrap">Solicita Karaoke</span>
                    </p>
                  </div>
                </a>
              </div>
            </div> -->
            
            <!-- <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <a href="https://api.whatsapp.com/send?phone=<?php echo $usuario['fono'] ?>&text=Estimad@ <?php echo $usuario['nombre']." ".$usuario['apellido']." " ?>, Sistema Real solicita atención desde la mesa <?php echo $_GET['Mesa'] ?>" target="_blank">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h2 class="card-title text-uppercase text-muted mb-0">ATENCION</h2>
                        <span class="h2 font-weight-bold mb-0"></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                          <i class="fas fa-phone-volume "></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> </span>
                      <span class="text-nowrap">Solicita Atención</span>
                    </p>
                  </div>
                </a>
              </div>
            </div> -->


            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <a href="Clientes/Galerias/ver_galeria.php?Mesa=<?php echo $_GET['Mesa'] ?>">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h2 class="card-title text-uppercase text-muted mb-0">GALERIA</h2>
                        <span class="h2 font-weight-bold mb-0"></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                          <i class="fas fa-images"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <span class="text-success mr-2"><i class="fas fa-arrow-up"></i></span>
                      <span class="text-nowrap">Nuestra Galería</span>
                    </p>
                  </div>
                </a>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6">
             
              <div class="card card-stats mb-4 mb-xl-0">
                <a href="#" onclick='muestra_modal(0)'>
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h2 class="card-title text-uppercase text-muted mb-0">COMPARTE</h2>
                        <span class="h2 font-weight-bold mb-0"></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                          <i class="fas fa-camera"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <span class="text-success mr-2"><i class="fas fa-arrow-up"></i></span>
                      <span class="text-nowrap">Comparte tú experiencia</span>
                    </p>
                  </div>
                </a>
              </div>
            </div>

            <?php 
            if($socio_id != ""){ 
                if($total > $puntos){
            ?>

              <div class="col-xl-3 col-lg-6">
                <br>
                <div class="card card-stats mb-4 mb-xl-0">  
                  <a onclick='return (confirmDel(<?php echo $socio_id ?>,  <?php echo $puntos ?>, <?php echo $_GET['Mesa'] ?>, <?php echo $total ?>, <?php echo $movimiento['id'] ?>));'>
                               
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <h2 class="card-title text-uppercase text-muted mb-0">CANJEAR</h2>
                          <span class="h2 font-weight-bold mb-0"></span>
                        </div>
                        <div class="col-auto">
                          <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                            <i class="fas fa-comment-dollar "></i>
                          </div>
                        </div>
                      </div>
                      <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> </span>
                        <span class="text-nowrap">Canjear Puntos</span>
                      </p>
                    </div>
                  </a>
                </div>
              </div>

            <?php
              }
              }
            ?>

            <div class="col-xl-3 col-lg-6">
              <br>
              <div class="card card-stats mb-4 mb-xl-0">
                <a href="Clientes/cuenta.php?Mov=<?php echo $movimiento['id'] ?>&qrcli&Mesa=<?php echo $_GET['Mesa'] ?>">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h2 class="card-title text-uppercase text-muted mb-0">MI CUENTA</h2>
                        <span class="h2 font-weight-bold mb-0"></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                          <i class="fas fa-eye"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                      <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                      <span class="text-nowrap">Visualiza tú cuenta</span>
                    </p>
                  </div>
                </a>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="card-footer text-muted">
      Desarrollado por <a href="https://realdev.cl/">REALDEV</a>
    </div>


  </div>


  <div id="myModal5" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <form  name="miform" id="form1" method="post" action="intranet/funciones/procesa_galeria.php" enctype="multipart/form-data">
          <div class="modal-header">
            <h2 class="modal-title">SUBE TU FOTO</h2>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <div id="contenido2"></div>
                <input type="hidden" name="omesa" id="omesa" value="<?php echo $_GET['Mesa'] ?>">
            </div>
            </div>
            <div class="modal-footer">
              <button type="submit" onClick="return valida_envio()" class="btn btn-success">SUBIR</button>
              <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
            </div>
          </form>
        </div>
      </div>
  </div>


  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="assets/js/argon.js?v=1.0.0"></script>
  <?php
  }
  ?>

  <script src="js/bootbox.min.js"></script>
  <script type="text/javascript">
    function confirmDel(id, pts, mesa_id, total, movimiento_id){
        bootbox.confirm({
        message: "¿Realmente desea canjear sus Puntos?",
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
              location.href = "intranet/funciones/procesapedido2.php?canjear_puntos&socio_id="+id+"&ptos="+pts+"&Mesa="+mesa_id+"&total="+total+"&movimiento="+movimiento_id+""; 
            }
            else{
              
            }
        }
    });
    }
  </script>
</body>
<?php 
    if(isset($_GET['Compartido'])){
  ?>
    <script type="text/javascript">
      bootbox.alert("Imagen compartida correctamente!");
    </script>
  <?php
    }
    if(isset($_GET['ErrorSubiendo'])){
  ?>
    <script type="text/javascript">
      bootbox.alert("Error subiendo imagen!");
    </script>
  <?php
    }
?>

</html>