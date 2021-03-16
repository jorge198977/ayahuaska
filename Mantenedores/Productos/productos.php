<?php session_start();   ?>
<!DOCTYPE html>
<html>

<?php 
  include("header.php"); 
  include("../../intranet/funciones/seguridad.php");
  if(!validaringreso())
      header('Location:../../index.php?NOCINICIA');
  
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

          <div class="container">
            <div class="row">
              <div class="col-sm">
                <form>
                  <div class="form-group">
                    <div class="input-group mb-4">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                      </div>
                      <input class="form-control" name="busqueda_modulos_productos" id="busqueda_modulos_productos" placeholder="Buscar módulo" type="text">
                    </div>
                  </div>
                 </form>
              </div>
            </div>
          </div>

          <div class="col">
            <div id="muestra_modulos_productos" ></div>
          </div>

          
        </div>
      </div>
    </div>
  </div>


  <script src="../../assets/vendor/jquery/dist/jquery.min.js"></script>

  <script type="text/javascript">
    
    $(document).ready(function(){
         $("#busqueda_modulos_productos").keyup(function(){
              var parametros=document.getElementById("busqueda_modulos_productos").value;
              $.ajax({
                    data:  {parametros},
                    url:   'muestra_modulos_productos.php',
                    type:  'post',
                      beforeSend: function () { },
                      success:  function (response) {                 
                          $('#muestra_modulos_productos').html(response);
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
            url:   'muestra_modulos_productos.php',
            type:  'post',
              beforeSend: function () { },
              success:  function (response) {                 
                  $('#muestra_modulos_productos').html(response);
            },
            error:function(){
                 alert("error")
              }
       });
         
    });


  </script>



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