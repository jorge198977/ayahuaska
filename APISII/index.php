<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include 'inc.php';


require_once 'Clases/SII/Autenticacion.php';
require_once 'Clases/SII/Folios.php';
require_once 'Clases/FirmaElectronica.php';
require_once 'Clases/I18n.php';
require_once 'Clases/EnvioBoleta.php';
require_once 'Clases/Estado.php';


$Firma = new FirmaElectronica($config['firma']);
$boleta = new Utility_EnvioBoleta;
$token = $boleta::getToken($Firma);
echo $token;
?>