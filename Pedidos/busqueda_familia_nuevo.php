<script type="text/javascript">

  function muestra_detalle_pedido(preparado_id, id, npedido)
  {
    $('#myModalDetalle #id_promocion2').val(id);   $.ajax({
           url: 'modal_detalle.php',
           type: 'POST',
           data:{preparado_id:preparado_id, id:id, npedido:npedido},
           success: function(data){
                $('#contenido2').html(data);
                $('#myModalDetalle').modal('show');
           }
       });
  }

</script>

<?php
include("../intranet/funciones/controlador.php");
$familias = null;
$vta_id = $_POST['vta_id'];
$npedid = $_POST['npedid'];
if(isset($_POST['parametros'])){
	$dato = $_POST['parametros'];
	$sql = "select * from ayahuaska.familias where nombre like '".$dato."%' order by nombre asc";
}
else{
	$sql = "select * from ayahuaska.familias order by nombre asc";	
}

$res = mysql_query($sql);
$tot = mysql_num_rows($res);
$i = 1;
$nombrecollapse = "collapse";
if($tot > 0){
	while($dat = mysql_fetch_array($res)){
	  //$familias[] = array('id' => $dat['id'], 'nombre' => $dat['nombre']);
	?>
		<div class="card shadow" id="card-familia">
          <div class="card-body">
            <h4 class="panel-title">
              <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $nombrecollapse."".$i ?>" aria-expanded="false" aria-controls="<?php echo $nombrecollapse."".$i ?>" onClick="llamar_productos_by_familia(<?php echo $dat['id'] ?>, <?php echo $i ?>);">
                <?php echo $dat['nombre'] ?>
              </a>
            </h4>
          </div>
          <div id="muestra_productos">

          </div>      
    </div>
    <?php
    $i++;
	}
}

?>


<div id="myModalDetalle" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <form  name="miform" id="form1" method="post" action="../intranet/funciones/procesapedido2.php" >
        <div class="modal-header">
          <h4 class="modal-title">DETALLE</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" name="id_promocion" id="id_promocion2">
              <div id="contenido2"></div>
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


<script src="../assets/vendor/jquery/dist/jquery.min.js"></script>

  <script type="text/javascript">
  function llamar_productos_by_familia(familia_id, index){
    var fam = '';
     $(document).ready(function(){
         $("#busqueda_producto").keyup(function(){
              var parametros=document.getElementById("busqueda_producto").value;
              fam = familia_id;
              $.ajax({
                    data:  {fam, parametros, index},
                    url:   'busqueda_productos.php',
                    type:  'post',
                      beforeSend: function () { },
                      success:  function (response) {                 
                          $('#muestra_productos').html(response);
                    },
                    error:function(){
                         alert("error")
                      }
               });
         })
    });

    $(document).ready(function(){
      fam = familia_id;
      $.ajax({
            data:  {fam, index},
            url:   'busqueda_productos.php',
            type:  'post',
              beforeSend: function () { },
              success:  function (response) {                 
                  $('#muestra_productos').html(response);
            },
            error:function(){
                 alert("error")
              }
       });
         
    });
  }

  </script>