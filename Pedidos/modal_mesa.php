<?php
include("../intranet/funciones/controlador.php");
$id = intval($_POST['id']);
$mesa = get_mesa_id($_POST['id']);
?>

<style>
.frmSearch {border: 1px solid #a8d4b1;background-color: #c6f7d0;margin: 2px 0px;padding:40px;border-radius:4px;}
#country-list{float:left;list-style:none;margin-top:-3px;padding:0;width:190px;position: absolute;}
#country-list li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}
#country-list li:hover{background:#ece3d2;cursor: pointer;}
#search-box{padding: 10px;border: #a8d4b1 1px solid;border-radius:4px;}
</style>

<label for="observacion" class="col-sm-xs-2 control-label">MESA</label>
<div class="col-sm-xs-10">
	<input type="text" name="mesa" value="<?php echo $mesa['num']; ?>" disabled class='form-control'>
	<input type="hidden" name="Omesamodal" value="<?php echo $id; ?>">
</div>
<label for="observacion" class="col-sm-xs-2 control-label">¿Es Cliente?</label>
<div class="frmSearch col-sm-xs-10">
  <input type="text" id="search-box" name="socio" class='form-control' placeholder="Ingrese Socio" autocomplete="off" />
  <div id="suggesstion-box"></div>
</div>

<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
  $("#search-box").keyup(function(){
    $.ajax({
    type: "POST",
    url: "clientes_json.php",
    data:'keyword='+$(this).val(),
    beforeSend: function(){
      $("#search-box").css("background");
    },
    success: function(data){
      $("#suggesstion-box").show();
      $("#suggesstion-box").html(data);
      $("#search-box").css("background","#FFF");
    }
    });
  });
});

function selectCountry(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}
</script>


