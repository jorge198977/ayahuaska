<?php session_start();   ?>
<!DOCTYPE html>
<html>
  
<?php 
  include("header.php"); 
  //include("../intranet/funciones/controlador.php");
  include("../intranet/funciones/seguridad.php");
  if(!validaringreso())
      header('Location:../index.php?NOCINICIA');
  
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
                  <h3 class="mb-0">MESAS</h3>
                </div>
              </div>
            </div>
          </div>
          <br>
          <div class="container">
            <div class="row">
              <div class="col-sm">
                <form>
                  <div class="form-group">
                    <div class="input-group mb-4">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                      </div>
                      <input class="form-control" name="busqueda_mesa" id="busqueda_mesa" placeholder="Buscar Mesa" type="text">
                    </div>
                  </div>
                 </form>
              </div>
            </div>
          </div>


            
          <div class="col">
            <div id="muestra_mesas" ></div>
          </div>
           
          <div class="col">
            <a href="../inicio.php"><button type="button" class="btn btn-danger btn-block my-4">Volver</button></a>
          </div>

        </div>
      </div>
    </div>
  </div>







<script src="../assets/vendor/jquery/dist/jquery.min.js"></script>

  <script type="text/javascript">
    
    $(document).ready(function(){
         $("#busqueda_mesa").keyup(function(){
              var parametros=document.getElementById("busqueda_mesa").value;
              $.ajax({
                    data:  {parametros},
                    url:   'muestra_mesas.php',
                    type:  'post',
                      beforeSend: function () { },
                      success:  function (response) {                 
                          $('#muestra_mesas').html(response);
                    },
                    error:function(){
                         alert("error")
                      }
               });
         })
    });

    $(document).ready(function(){
      $.ajax({
            data:  {},
            url:   'muestra_mesas2.php',
            type:  'post',
              beforeSend: function () { },
              success:  function (response) {                 
                  $('#muestra_mesas').html(response);
            },
            error:function(){
                 alert("error")
              }
       });
         
    });


    function modificar_promocion(id)
    {
      $('#myModal5 #id_promocion2').val(id);   $.ajax({
             url: 'modal_mesa.php',
             type: 'POST',
             data:{id:id},
             success: function(data){
                  $('#contenido2').html(data);
                  $('#myModal5').modal('show');
             }
         });
    }

  </script>



    






  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.0.0"></script>

  
  
</body>

</html>