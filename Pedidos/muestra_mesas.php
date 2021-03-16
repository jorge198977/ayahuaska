  <script type="text/javascript">
  var statSend = false;
  function validar(){
     miform.siguiente_pedido.disabled = true;
     miform.submit();
    }
</script>
  <?php
    include("../intranet/funciones/controlador.php");
    if(isset($_POST['parametros'])){
      $mesas = get_mesa_by_numero($_POST['parametros']);
    }
    else{
      $mesas = get_all_mesas();
    }
    $i = 1;
    ?>
    <div class="row">
    <?php
    foreach ($mesas as $key => $mesa) {
    $mes = $mesa['num'];
    $mesa_id = $mesa['id'];
      if($mesa['estado'] == 0){ 
        $color = "green";
        $estado = "false";
        $icon = "fa fa-th-large";
        $data = "#exampleModal";
        $btn_color = "btn-success";
        $toggle = "modal";
        $clic = "modificar_promocion";
      }
      else if($mesa['estado'] == 1){ 
        $color = "red";
        $estado = "true";
        $icon = "fa fa-window-close";
        $data = "#";
        $btn_color = "btn-danger";
        $toggle = "#";
        $clic = "#";
        $hora_pedio = get_venta_by_mesa_estado($mesa_id, 0);
      }
  ?>    

      <div class="col-xs-4  col-sm-4 col-md-3">
        <br>
        <div class="card card-stats mb-2 mb-xl-0">
          <div class="card-body">
            <div class="row">
              <div class="col">
                <p class="card-title text-uppercase text-muted mb-0"><strong>MESA <?php echo $mesa['num'] ?> <?php if($mesa['estado'] == 1){ ?> HORA: <?php echo $hora_pedio['hora']; ?> <?php } ?></p></strong>
                <span class="h2 font-weight-bold mb-0"></span>
                <span class="h2 font-weight-bold mb-0"></span>
              </div>
            </div>
            <button type="button" onclick='<?php echo $clic ?>(<?php echo $mesa_id ?>)' name="btnmesa" id="btnmesa" class="btn <?php echo $btn_color ?> btn-lg btn-block" data-toggle="<?php echo $toggle ?>" data-toggle="<?php echo $toggle ?>" data-target="<?php echo $data ?>" data-whatever="@mdo"
                           data-myvalue='<?php echo $mesa['num'] ?>'>
                <i class="<?php echo $icon ?>"></i>
                
            </button>
          </div>
        </div>
      </div>
  <?php
    }
  ?>
  </div>

  <div id="myModal5" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <form  name="miform" id="form1" method="post" action="../intranet/funciones/procesapedido2.php" >
          <div class="modal-header">
            <h4 class="modal-title">TOMAR PEDIDO</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <input type="hidden" name="id_promocion" id="id_promocion2">
                <div id="contenido2"></div>
            </div>
            </div>
            <div class="modal-footer">
              <button type="submit" name="siguiente_pedido" id="siguiente_pedido" onClick="return validar()" class="btn btn-success">Siguiente</button>
              <button type="button" onclick="location.href='orden.php';" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
            </div>
          </form>
        </div>
      </div>
  </div>


 