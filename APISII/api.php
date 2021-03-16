<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
include("genera_boleta_electronica.php");



function postURL($url, $parametros)
{
	//urlify the data for the POST
	$fields_string = http_build_query($parametros);

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_VERBOSE, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
	$response = curl_exec($ch);
	curl_close($ch);

	return $response;
}




if(isset($_POST['jsonboletaelec'])){
	$data = json_decode($_POST['jsonboletaelec']);
	foreach ($data as $key => $dat) {
		$suc = $dat->sucursal;
		$caja = $dat->caja;
		$rut = $dat->rut;
		$cli = $dat->cli;
		$nombre = $dat->nombre;
		$datos = get_detalle_boleta($dat->nrointerno, $dat->movimiento, $dat->sucursal);
	}
	$folio = create_boleta_electronica($datos, $suc, $caja, $rut, $cli, $nombre);
	echo json_encode($folio); 
}




if(isset($_POST['jsonboletaelecce'])){
	$data = json_decode($_POST['jsonboletaelecce']);
	foreach ($data as $key => $dat) {
		$suc = $dat->sucursal;
		$cli = $dat->cli;
		$descrip = $dat->descrip;
		$monto = $dat->monto;
	}
	$folio = create_boleta_electronicace($descrip, $suc, $caja, $cli, $monto);
	echo json_encode($folio); 
}



function get_detalle_boleta($nrointerno, $movimiento, $sucursal){
	$ipsucursal = array(
	"10" => "192.168.1.80",
	"20" => "192.168.21.80",
	"30" => "192.168.31.80",
	"40" => "192.168.1.196",
	"50" => "192.168.51.80",
	);
	$url = "http://{$ipsucursal[$sucursal]}/OficinaVirtual/API/sii.php";
	$envia[] = array(
		    'nrointerno' => $nrointerno,
		    'movimiento' => $movimiento,
			);
	$envia = json_encode($envia);
	$parametroscuenta = array(
		'jsondetalle' => $envia
	);
	$data = postURL($url, $parametroscuenta);
	$data = json_decode($data);
	return $data;
}





?>