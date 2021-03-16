<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once 'Clases/SII/Autenticacion.php';
require_once 'Clases/SII/Folios.php';
require_once 'Clases/FirmaElectronica.php';
require_once 'Clases/I18n.php';
require_once 'Clases/EnvioBoleta.php';
require_once 'Clases/Estado.php';
require_once 'Clases/Sii.php';
require_once 'Clases/Arreglo.php';
require_once 'Clases/Log.php';
require_once 'Clases/SII/Dte.php';
require_once 'Clases/SII/Dte/PDF/DtePdf.php';
require_once 'Clases/SII/EnvioDte.php';


$sii = new Sii();
echo $sii::getServidor();

//echo "bol creada en ->".$nombre_xml;

?>