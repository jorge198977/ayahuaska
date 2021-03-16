<?php
	$folio = intval($_POST['folio']);
	$sucursal = intval($_POST['sucursal']);
	$fecha = $_POST['fecha'];
	//CAMBIAR DESPUES POR 50
	if($sucursal == 40){
		$empresa = "T V CABLE COLOR S A";
	}
	else{
		$empresa = "";
	}
?>
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="PDF/<?php echo $empresa ?>/<?php echo $fecha ?>/<?php echo $folio ?>.pdf"></iframe>
</div>