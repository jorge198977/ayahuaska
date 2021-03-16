<?php

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

include 'inc.php';


require_once 'Clases/SII/Autenticacion.php';
require_once 'Clases/Log.php';
require_once 'Clases/Sii.php';
require_once 'Clases/SII/Folios.php';
require_once 'Clases/FirmaElectronica.php';
require_once 'Clases/I18n.php';
require_once 'Clases/EnvioBoleta.php';
require_once 'Clases/Estado.php';

header('Content-type: text/plain');




// cargar folios
$Folios = new Folios(file_get_contents('xml/folios/39.xml'));
//$Folios = new \sasco\LibreDTE\Sii\Folios(file_get_contents('xml/folios/41.xml'));

// ejemplos métodos
echo 'Folios son validos?: ',($Folios->check()?'si':'no'),"\n\n";
echo 'Rango de folios: ',$Folios->getDesde(),' al ',$Folios->getHasta(),"\n\n";
if ($Folios->getCaf())
    echo 'CAF: ',$Folios->getCaf()->C14N(),"\n\n";
echo $Folios->getPrivateKey(),"\n";
echo $Folios->getPublicKey();

// si hubo errores mostrar
foreach (Log::readAll() as $error)
    echo $error,"\n";

?>