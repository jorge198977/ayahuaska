<script type="text/javascript">

  function muestra_detalle_pedido2(preparado_id, id, npedido)
  {
    $('#myModalDetalleProduco #id_promocion2').val(id);   $.ajax({
           url: 'modal_detalle.php',
           type: 'POST',
           data:{preparado_id:preparado_id, id:id, npedido:npedido},
           success: function(data){
                $('#contenidoProducto').html(data);
                $('#myModalDetalleProduco').modal('show');
           }
       });
  }

</script>

<div class="container">
    <div class="row">
      	<div class="col-12">

			<?php
			date_default_timezone_set('America/Santiago'); 
			include("../intranet/funciones/controlador.php");

			$vta_id = $_POST['vta_id'];
			$npedid = $_POST['npedid'];

			$dato = $_POST['parametros'];

			$fecha = date("H:i:s");
			$sqlhora = "select * from ayahuaska.horahappy where idhorahappy = 1";
			$reshora = mysql_query($sqlhora);
			$dathora = mysql_fetch_array($reshora);
			$horario1 = $dathora['horainicialhappy'];
			$horario2 = $dathora['horafinalhappy'];
			$ret = dentro_de_horario($horario1, $horario2, $fecha);

			if($ret == 1){
				$sql = "select * from ayahuaska.preparados where PREPARADOS_NOMBRE like '%".$dato."%' order by PREPARADOS_NOMBRE asc";
			}
			else{
			  $sql = "select * from ayahuaska.preparados where PREPARADOS_NOMBRE like '%".$dato."%' and PREPARADOS_NOMBRE not like '%HAPPY%' order by PREPARADOS_NOMBRE asc";
			}

			
			

			$res = mysql_query($sql);
			$tot = mysql_num_rows($res);
			$i = 1;
			$nombrecollapse = "collapse";
			if($tot > 0){
				while($dat = mysql_fetch_array($res)){
					?>
			        <div class="panel-body">
			            <a onclick='muestra_detalle_pedido2(<?php echo $dat['PREPARADOS_ID'] ?>, <?php echo $vta_id ?>, <?php echo $npedid ?>)' class="btn btn-success" aria-label="Left Align" data-toggle="modal" data-toggle="modal" data-target="modal" data-whatever="@mdo">
			            	<?php 
			            	if(strlen($dat['PREPARADOS_NOMBRE']) > 20){
			            		$nom1 = substr($dat['PREPARADOS_NOMBRE'], 0, 19);
          						$nom2 = substr($dat['PREPARADOS_NOMBRE'], 19, strlen($dat['PREPARADOS_NOMBRE']));
          						echo $nom1."<br>".$nom2. "/ $".number_format($dat['PREPARADOS_PRECIO'], 0, ',', '.');
			            	}
			            	else{
			            		echo $dat['PREPARADOS_NOMBRE']." / $".number_format($dat['PREPARADOS_PRECIO'], 0, ',', '.');
			            	}
			            	?>
			                
			            </a>
			            <br><br>
			        </div>
			    <?php
			    $i++;
			  	}
			}

			?>
		</div>
	</div>	

	<div class="container">
	  <div class="row">
	    <div class="col-12">
	      <div id="myModalDetalleProduco" class="modal fade" role="dialog">
	        <div class="modal-dialog modal-sm">
	          <!-- Modal content-->
	          <div class="modal-content">
	            <form  name="miform" id="form1" method="post" action="../intranet/funciones/procesapedido2.php" >
	              <div class="modal-header">
	                <h4 class="modal-title">DETALLE</h4>
	              </div>
	              <div class="modal-body">
	                <div class="form-group">
	                  <input type="hidden" name="id_promocion" id="id_promocion2">
	                    <div id="contenidoProducto"></div>
	                </div>
	                </div>
	                <div class="modal-footer">
	                  <button type="submit" class="btn btn-success">Ordenar</button>
	                  <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
	                </div>
	              </form>
	            </div>
	          </div>
	      </div>
	    </div>
	  </div>
	</div>
</div>