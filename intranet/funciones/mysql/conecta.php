<?php
require_once("mysql-shim.php");

function conecta()
{
    mysql_connect("127.0.0.1","icopetedb","icopetedbroot");
    //mysql_connect("localhost","desdelim_jorge","Kokialvarez77$");
    //mysql_connect("caferealsistema.servehttp.com:3306","root","cafe2016seba");
    mysql_select_db("ayahuaska");
    //mysql_select_db("desdelim_intranet");
    mysql_query("SET NAMES 'utf8'");
}

//Formato Fecha Normal 24/09/2012 dd-mm-yyyy
function fecha_hoy_normal()
{
    $fecha=date('d-m-Y');
    return $fecha;
}

//Formato Fecha Base de Datos 2012-09-24 yyyy-mm-dd

function fecha_hoy_bd()
{
    $fecha=date('Y-m-d');
    return $fecha;
}

//Formato Hora HH:mm:ss

function hora_hoy()
{

    $hora=date('H:i:s');
    return $hora;
}
//Convertir formato fecha bd-a-normal yyyy-mm-dd a dd-mm-yyyy



function fecha_normal_bd($fecha)
{

    $dia=substr($fecha,0,2);
    $mes=substr($fecha,3,2);
    $anho=substr($fecha,6,4);

    return $anho."-".$mes."-".$dia;
}
function decimal_2($numero)
{
  return number_format($numero, 1, ',', ' ');
}
?>
