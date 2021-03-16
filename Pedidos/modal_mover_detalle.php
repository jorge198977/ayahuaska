<script language="javascript">
  function soloNumeros(e) 
    { 
      var key = window.Event ? e.which : e.keyCode 
      return ((key >= 48 && key <= 57) || (key==8)) 
    }
</script>

<?php
include("../intranet/funciones/controlador.php");
$mesa = get_mesa_by_id($_POST['mesa']);
$preparado = get_preparados_id($_POST['Id']);

$cantidad_temporal = get_cantidad_venta_temporal($_POST['Mov'], $_POST['Id'], 0, $_POST['Npedido']);
if($cantidad_temporal == ""){
  $cantidad_temporal = 0;
}

?>
<hr>
<div class="box">
  <!-- /.box-header -->
  <div class="box-body">
   <div class="table-responsive">
    <table id="example2" class="table table-flush">
      <thead class="thead-light">
        <tr>
          <th scope="col">MESA</th>
          <th scope="col">PRODCUTO</th>
          <th scope="col">CANT</th>
        </tr>
      </thead>
      <tbody>
        <tr class="active">
          <td>
            <?php echo $mesa ?>
          </td>
          <td>
            <?php echo $preparado['PREPARADOS_NOMBRE'] ?>
          </td>
          <td>
            <?php echo $_POST['cantidad'] - $cantidad_temporal ?>
          </td>
        </tr>
      </tbody>
    </table>


    <hr>
    <label for="observacion" class="col-sm-xs-2 control-label">NUEVA MESA</label>
    <div class="col-sm-xs-10">
      <select class="form-control input-lg" name="mesa" id="mesa" required>
        <option value=""> Seleccione Nueva Mesa </option>
        <?php
          $mesas = get_all_mesas();
          foreach ($mesas as $key => $mesa) {
            if($mesa['estado'] == 0){ $estado = "DISPONIBLE"; } else{ $estado = "OCUPADA"; }
            if($mesa['num'] != $_POST['mesa']){
        ?>
              <option value="<?php echo $mesa['num'] ?>">MESA <?php echo $mesa['num']. " / " .$estado  ?></option>
        <?php
            }
        }
        ?>
      </select>
    </div>
    <!-- <label for="observacion" class="col-sm-xs-2 control-label">NUEVA MESA</label>
    <div class="col-sm-xs-10">
      <input type="number" name="mesa" id="mesa" class='form-control' onKeyPress="return soloNumeros(event)" required>
    </div> -->
    <label for="observacion" class="col-sm-xs-2 control-label">CANTIDAD</label>
    <div class="col-sm-xs-10">
      <input type="number" name="cantidadmov" id="cantidadmov" class='form-control' onKeyPress="return soloNumeros(event)" required>
    </div>
    <input name="Omov" type="hidden"  value="<?php echo $_POST['Mov'] ?>">
    <input name="OmovProd" type="hidden"  value="<?php echo $_POST['Id'] ?>">
    <input name="Ocantant" type="hidden"  value="<?php echo $_POST['cantidad'] -$cantidad_temporal ?>">
    <input type="hidden" name="oNpedido" value="<?php echo $_POST['Npedido'] ?>"> 
    <input name="Omesaant" type="hidden"  value="<?php echo $_POST['mesa'] ?>">
    <input name="Ovta_detalle_id" type="hidden"  value="<?php echo $_POST['venta_detalle_id'] ?>">
    
  </div>
 </div>
</div>

