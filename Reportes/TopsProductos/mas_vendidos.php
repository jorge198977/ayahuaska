<?php session_start();   ?>
<!DOCTYPE html>
<html>

<?php 
  include("header.php"); 
  include("../../intranet/funciones/controlador.php");
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
      $productos = get_top_productos();
    ?>



    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <div class="card-header border-0">
                  <h3 class="mb-0">TOP PRODUCTOS MAS VENDIDOS</h3>
                </div>


                  <div>
                    <!-- /.box-header -->
                    <div>
                     <div class="table-responsive">
                      <table id="example1" class="table table-flush">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">PRODUCTO</th>
                            <th scope="col">CANTIDAD</th>
                            <th scope="col">PRECIO</th>
                            <th scope="col">TOTAL</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            foreach ($productos as $key => $producto) {
                          ?> 
                          <tr>
                            <th><?php echo $producto['preparado_nombre'] ?></th>
                            <th><?php echo $producto['total'] ?></th>
                            <th><?php echo number_format($producto['precio'], 0, ',', '.') ?></th>
                             <th><?php echo number_format($producto['precio']*$producto['total'] , 0, ',', '.') ?></th>
                          </tr>
                          <?php
                            //$vent[] = array('y' => $producto['total'], 'label' => $producto['preparado_nombre']);
                            }
                          ?>
                        </tbody>
                      </table>
                    </div>
                   </div>
                  </div>

                  <?php $dataPoints = $vent; ?>
                 <!--  <div class="col-lg-12 text-center">
                    <div id="chartContainer" style="height: 1000px; width: 100%;"></div>
                    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                  </div>
 -->


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

  <script>
    window.onload = function() {
     
    var chart = new CanvasJS.Chart("chartContainer", {
      animationEnabled: true,
      title:{
        text: "TOP PRODUCTOS"
      },
      axisY: {
        title: "TOP PRODUCTOS",
        
      },
      data: [{
        type: "bar",
        yValueFormatString: "$#,##0",
        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
      }]
    });
    chart.render();
     
    }
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

   <!-- DataTables -->
  
  <script src="../../intranet/plugins/datatables/jquery.dataTables.min.js"></script>

  <!-- page script -->
  


</body>

</html>