<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include 'config.php';
include("../intranet/funciones/controlador.php");
require_once 'Clases/X509.php';
require_once 'Clases/FirmaElectronica.php';
require_once 'Clases/Log.php';
require_once 'Clases/Estado.php';
require_once 'Clases/I18n.php';
require_once 'Clases/XML.php';
require_once 'Clases/SII/Autenticacion.php';
require_once 'Clases/Sii.php';
require_once 'Clases/SII/Dte.php';
require_once 'Clases/SII/EnvioDte.php';
include 'Clases/SII/ConsumoFolio.php';

function genera_consumo_folio_by_empresa(){

    $config = get_firma2();
    $datos = get_datos();
    $empresa = $datos['datos']['empresa'];
    $rut = $datos['datos']['rut'];
    $fecha_hoy = date("Y-m-d");
    //$fecha_hoy = '2021-05-18';
    $fecha_rep = strtotime ( '-1 day' , strtotime ( $fecha_hoy ) ) ;
    $fecha_rep = date ( 'Y-m-d' , $fecha_rep );


    $nombreDte = "xml/ConsumoFolios/AYAHUSKA/EnvioDTE-".$fecha_hoy.".xml";



    $ConsumoFolio = new ConsumoFolio();
    $Firma = new FirmaElectronica($config['firma']);
    $ConsumoFolio->setFirma($Firma);
    $ConsumoFolio->setDocumentos([39, 61]);
    $folios_emitidos = get_folios_by_fecha_empresa($fecha_rep, $rut);
    $cant = 0;

    $tamano = sizeof($folios_emitidos);
    if($tamano > 0){

        foreach ($folios_emitidos as $key => $folio_emitido) {
            $total = intval($folio_emitido['monto']);
            $neto = round($folio_emitido['monto']/1.19, 0);
            $iva = $total - $neto;

            $ConsumoFolio->agregar([
                'TpoDoc' => 39,
                'NroDoc' => $folio_emitido['folio'],
                'TasaImp' => 19,
                'FchDoc' => $folio_emitido['fecha'],
                'MntExe' => 0,
                'MntNeto' => $neto,
                'MntIVA' => $iva,
                'MntTotal' => $total,
            ]);
            $cant++;
        }

    }

    $caratula = set_caratula($datos['caratula']);
    $emisor = set_emisor($datos['emisor']);


    $ConsumoFolio->setCaratula([
        'RutEmisor' => $emisor['RUTEmisor'],
        'FchResol' => $caratula['FchResol'],
        'NroResol' => $caratula['NroResol'],
        'FchInicio' => $fecha_rep,
        'FchFinal' => $fecha_rep,
    ]);


    file_put_contents($nombreDte, $ConsumoFolio->generar()); 


    if ($ConsumoFolio->schemaValidate()) {
        $track_id = $ConsumoFolio->enviar();
        //SE DEBE MODIFICAR POR LA EMPRESA CORRESPONDIENTE
        if(inserta_rcof($cant, $fecha_hoy, date("H:i:s"), $track_id)){
            return $track_id;
        }

        else{
            return false;
        }
    }






    // si hubo errores mostrar
    foreach (Log::readAll() as $error)
        echo $error,"\n";
}



genera_consumo_folio_by_empresa();


?>