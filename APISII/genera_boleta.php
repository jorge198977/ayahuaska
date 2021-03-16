<?php
header('Content-type: text/plain; charset=ISO-8859-1');
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
require_once 'Clases/SII/EnvioDte.php';
// incluir archivos php de la biblioteca y configuraciones
include 'inc.php';

// primer folio a usar para envio de set de pruebas
$folios = [
    39 => 1136, //BOLET ELECTRONICA
];

// caratula para el envío de los dte
$caratula = [
    'RutEnvia' => '10932299-7',
    'RutReceptor' => '60803000-K', //RUT SII
    'FchResol' => '2020-11-16',
    'NroResol' => 0,
];

// datos del emisor
$Emisor = [
    'RUTEmisor' => '99500720-7',
    'RznSoc' => 'T V CABLE COLOR S A',
    'GiroEmis' => 'SERVICIOS DE TELEVISION NO ABIERTA. TELEVISION POR CABLE',
    'Acteco' => 611030,
    'DirOrigen' => 'Ovalle',
    'CmnaOrigen' => 'Ovalle',
];

// datos de los DTE (cada elemento del arreglo $set_pruebas es un DTE)
$boleta = [
    // CASO 1
    [
        'Encabezado' => [
            'IdDoc' => [
                'TipoDTE' => 39,
                'Folio' => $folios[39],
            ],
            'Emisor' => $Emisor,
            'Receptor' => [
                'RUTRecep' => '77123870-K',
                'RznSocRecep' => 'COMERCIALIZADORA Y SERVICIOS UNO LIMITADA',
                'GiroRecep' => 'SERVICIOS DE TELEVISION NO ABIERTA. TELEVISION POR CABLE.',
                'DirRecep' => 'Ovalle',
                'CmnaRecep' => 'Ovalle',
            ],
        ],
        'Detalle' => [
            [
                'NmbItem' => 'Pago mensualidad Diciembre 2020',
                'QtyItem' => 1,
                'PrcItem' => 25000,
            ],
        ],
    ],
];


$Firma = new FirmaElectronica($config['firma']);
foreach ($folios as $tipo => $cantidad)
    $Folios[$tipo] = new Folios(file_get_contents('xml/folios/'.$tipo.'.xml'));
$EnvioDTE = new EnvioDte();

// generar cada DTE, timbrar, firmar y agregar al sobre de EnvioDTE
foreach ($boleta as $documento) {
    $DTE = new Dte($documento);
    if (!$DTE->timbrar($Folios[$DTE->getTipo()])){
        break;
    }
    if (!$DTE->firmar($Firma))
        break;
    $EnvioDTE->agregar($DTE);
}

// enviar dtes y mostrar resultado del envío: track id o bien =false si hubo error
$EnvioDTE->setCaratula($caratula);
$EnvioDTE->setFirma($Firma);
file_put_contents('xml/EnvioDTE.xml', $EnvioDTE->generar()); // guardar XML en sistema de archivos
$xml = file_get_contents('xml/EnvioDTE.xml');
$enviar_boleta = new Utility_EnvioBoleta();
$respuesta = $enviar_boleta::enviar("10932299-7", "99500720-7", $xml, $Firma);
print_r($respuesta);

?>