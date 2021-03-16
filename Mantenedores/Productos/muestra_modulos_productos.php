<?php
include("../../intranet/funciones/controlador.php");
  $colores = array('bg-success', 'bg-info', 'bg-yellow');
  $i = 0;
  $z = 0;

  	if(isset($_POST['parametros'])){
      $sql = "select * from ayahuaska.familias where id != 10 and id != 11 and nombre like '%".$_POST['parametros']."%' order by nombre asc";
    }
    else{
      $sql = "select * from ayahuaska.familias where id != 10 and id != 11 order by nombre asc";
   	}
   	$res = mysql_query($sql);
   	?>
   	<div class="row">
	   	<?php
	   	while($dat = mysql_fetch_array($res)){
	   	?>	


	          <?php 
	            if ($z % 4 == 0){
	            ?>
	              <br>
	            <?php  
	            }
	          ?>
	          <div class="col-4">
	        	<br>
	          <div class="card card-stats mb-2 mb-xl-0">
	            <a href="visualiza_producto.php?Familia=<?php echo $dat['id'] ?>">
	              <div class="card-body">
	                <div class="row">
	                  <div class="col">
	                    <h4 class="card-title text-uppercase text-muted mb-0"><?php echo $dat['nombre'] ?></h4>
	                    <span class="h2 font-weight-bold mb-0"></span>
	                  </div>
	                  <div class="col-auto">
	                    <div class="icon icon-shape <?php echo $colores[$i] ?> text-white rounded-circle shadow">
	                      <i class="fas fa-layer-group"></i>
	                    </div>
	                  </div>
	                </div>
	                <p class="mt-3 mb-0 text-muted text-sm">
	                  <span class="text-success mr-2"><i class="fas fa-arrow-up"></i></span>
	                  <span class="text-nowrap"></span>
	                </p>
	              </div>
	            </a>
	          </div>
	        </div>


	   	<?php
	   		if($i == 2){
	            $i = 0;
	        }
	        else{
	            $i++;   
	        } 
	   	}
	   	?>


	   	<div class="col-4">
	      <br>
	      <div class="card card-stats mb-2 mb-xl-0">
	        <a href="index.php">
	          <div class="card-body">
	            <div class="row">
	              <div class="col">
	                <h3 class="card-title text-uppercase text-muted mb-0">VOLVER</h3>
	                <span class="h2 font-weight-bold mb-0"></span>
	              </div>
	              <div class="col-auto">
	                <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
	                  <i class="fas fa-arrow-alt-circle-left"></i>
	                </div>
	              </div>
	            </div>
	            <p class="mt-3 mb-0 text-muted text-sm">
	              <span class="text-success mr-2"><i class=""></i></span>
	              <span class="text-nowrap"></span>
	            </p>
	          </div>
	        </a>
	      </div>
	    </div>
	   	
	</div>

   	