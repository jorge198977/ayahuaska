<?php
 $nombre = $_POST['venta_id']."-".$_POST['venta_pago_id'].".pdf";
 $direccion = "../boletas/movimientos/".$nombre;
?>
<div class="col-sm-xs-10">
	<embed src="../boletas/movimientos/<?php echo $nombre ?>#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf" width="100%" height="700px" />
</div>