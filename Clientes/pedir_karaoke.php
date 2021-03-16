<?php session_start();   ?>
<!DOCTYPE html>
<html>

<?php 
  include("header.php"); 
  include("../intranet/funciones/controlador.php");
?>


<body>
  <!-- Sidenav -->
  <?php include("sidenav.php"); ?>
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <?php include("top_nav.php"); ?>
    <!-- Header -->

    <?php
      $canciones = get_all_canciones_by_familia($_GET['id']);    
      $familia = get_familia_karaoke($_GET['id']);
    ?>



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">CANCIONES - <?php echo $familia['nombre'] ?></h3>
                </div>

                     <div class="table-responsive">
                      <table id="example1" class="table table-flush">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">ARTISTA</th>
                            <th scope="col">SOLICITAR</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            foreach ($canciones as $key => $cancion) {
                          ?>   
                            <tr class="active">
                              <th><?php echo $cancion['nombre'] ?></th>
                              <th><?php echo $cancion['artista'] ?></th>
                              <th>
                                <a onclick="return confirmDel();" href="../intranet/funciones/procesamoderador2.php?id=<?php echo $_GET['id'] ?>&PedirCancion=<?php echo $cancion['id'] ?>&mesa_id=<?php echo $_GET['mesa_id'] ?>&Mesa=<?php echo $_GET['Mesa'] ?>&id=<?php echo $_GET['id'] ?>">
                                    <button type="button" name="btnelimbeb" value="btnelimbeb" class="btn btn-default" aria-label="Left Align">
                                        <span class="fas fa-bullhorn" aria-hidden="true"></span>
                                    </button>
                                </a>
                                
                              </th> 
                            </tr>
                          <?php
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>

                    <div class="container">
                      <div class="row">
                        <div class="col">
                          <a href="karaokes.php?qrcli&Mesa=<?php echo $_GET['Mesa'] ?>"><button type="button" class="btn btn-danger btn-block my-4">Volver</button></a>
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

  <script src="../intranet/plugins/datatables/jquery.dataTables.min.js"></script>

  <!-- page script -->
  <script>
    $(function () {
       $("#example1").DataTable();

    });
  </script>



</body>

 <script src="../js/bootbox.min.js"></script>

 <script type="text/javascript">
  function confirmDel(id, PedirCancion, mesa_id, Mesa){
      bootbox.confirm({
      message: "¿Realmente desea pedir este karaoke?",
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
            location.href = "../intranet/funciones/procesamoderador2.php?id="+id+"&PedirCancion="+PedirCancion+"&mesa_id="+mesa_id+"&Mesa="+Mesa+""; 
          }
          else{
            
          }
      }
  });
  }
</script>
  <?php 
    if(isset($_GET['Realizado'])){
  ?>
    <script type="text/javascript">
      bootbox.alert("Karaoke Solicitado!");
    </script>
  <?php
    }
    if(isset($_GET['ErrorPedido'])){
    ?>  
      <script type="text/javascript">
        bootbox.alert("Su mesa ya tiene dos karaokes pendientes!");
      </script>
    <?php
    }
  ?>

</html>