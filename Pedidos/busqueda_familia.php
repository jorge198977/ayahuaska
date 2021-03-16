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
date_default_timezone_set('America/Santiago'); 
include("../intranet/funciones/controlador.php");



$familias = null;
$vta_id = $_POST['vta_id'];
$npedid = $_POST['npedid'];



$fecha = date("H:i:s");
$sqlhora = "select * from turquesa.horahappy where idhorahappy = 1";
$reshora = mysql_query($sqlhora);
$dathora = mysql_fetch_array($reshora);
$horario1 = $dathora['horainicialhappy'];
$horario2 = $dathora['horafinalhappy'];
$ret = dentro_de_horario($horario1, $horario2, $fecha);
if($ret == 1){
  if(isset($_POST['parametros'])){
    $dato = $_POST['parametros'];
    $sql = "select * from turquesa.familias where nombre like '%".$dato."%' order by nombre asc";
  }
  else{
    $sql = "select * from turquesa.familias order by nombre asc";  
  }
}
else{
  if(isset($_POST['parametros'])){
    $dato = $_POST['parametros'];
    $sql = "select * from turquesa.familias where nombre like '%".$dato."%' and nombre not like '%HAPPY%' order by nombre asc";
  }
  else{
    $sql = "select * from turquesa.familias where nombre not like '%HAPPY%' order by nombre asc";  
  }
}


$res = mysql_query($sql);
$tot = mysql_num_rows($res);
$i = 1;
$nombrecollapse = "collapse";
if($tot > 0){
  while($dat = mysql_fetch_array($res)){
    //$familias[] = array('id' => $dat['id'], 'nombre' => $dat['nombre']);
  ?>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card shadow" id="card-familia">
              <div class="card-body">
                <h4 class="panel-title">
                  <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $nombrecollapse."".$i ?>" aria-expanded="false" aria-controls="<?php echo $nombrecollapse."".$i ?>">
                    <?php echo $dat['nombre'] ?>
                  </a>
                </h4>
              </div>
              <div id="<?php echo $nombrecollapse."".$i ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                  <?php 
                    $preaparados = get_preparados_familia($dat['id']);
                    foreach ($preaparados as $key => $preaparado) {
                  ?>  
                    <a onclick='muestra_detalle_pedido(<?php echo $preaparado['id'] ?>, <?php echo $vta_id ?>, <?php echo $npedid ?>)' class="btn btn-success" aria-label="Left Align" data-toggle="modal" data-toggle="modal" data-target="modal" data-whatever="@mdo">
                       <?php 
                        if(strlen($preaparado['nombre']) > 20){
                          $nom1 = substr($preaparado['nombre'], 0, 19);
                          $nom2 = substr($preaparado['nombre'], 19, strlen($preaparado['nombre']));
                          echo $nom1."<br>".$nom2. "/ $".number_format($preaparado['precio'], 0, ',', '.');
                        }
                        else{
                          echo $preaparado['nombre']." / $".number_format($preaparado['precio'], 0, ',', '.');
                        }
                        ?>
                    </a>
                    <br><br>
                  <?php
                  }
                  ?>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
    <?php
    $i++;
  }
}

?>

<div class="container">
  <div class="row">
    <div class="col-12">
      <div id="myModalDetalle" class="modal fade" role="dialog">
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
    </div>
  </div>
</div>