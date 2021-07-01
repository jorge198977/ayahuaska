<?php

function get_firma(){
    $config = [
        'firma' => [
            'file' => '../../APISII/certs/AYAHUASKA.pfx',
            //CAMBIAR A 'file' => '../APISII/certs/she.pfx', PARA CARGAR FOLIOS
            //'data' => '', // contenido del archivo certificado.p12
            'pass' => 'ayahuaska1',
        ],
    ];
    return $config;
}

function get_firma2(){
    $config = [
        'firma' => [
            'file' => '../APISII/certs/AYAHUASKA.pfx',
            //CAMBIAR A 'file' => '../APISII/certs/she.pfx', PARA CARGAR FOLIOS
            //'data' => '', // contenido del archivo certificado.p12
            'pass' => 'ayahuaska1',
        ],
    ];
    return $config;
}





function set_caratula($caratula){
    $car = [
        'RutEnvia' => $caratula['rut_envia'],
        'RutReceptor' => $caratula['rut_recep'], //RUT SII
        'FchResol' => $caratula['fecha_resol'],
        'NroResol' => $caratula['nro_resol'],
    ];
    return $car;
}


function set_emisor($emisor){
    $Emisor = [
        'RUTEmisor' => $emisor['rut_emisor'],
        'RznSoc' => $emisor['razon_social'],
        'GiroEmis' => $emisor['giro'],
        'Acteco' => $emisor['acteco'],
        'DirOrigen' => $emisor['dirorigen'],
        'CmnaOrigen' => $emisor['comunaorigen'],
    ];
    return $Emisor;
}



function get_datos(){

    $datos = [
        'caratula' => [
            'rut_envia' => '23374236-8', //REPRESENTANTE LEGAL
            'rut_recep' => '60803000-K',
            'fecha_resol' => '2021-03-22', // CAMBIAR FECHA NUEVA
            'nro_resol' => 99,
        ],
        'emisor' => [
            'rut_emisor' => '76825194-0',
            'razon_social' => 'SOCIEDAD GASTRONOMICA AYAHUASKA SPA',
            'giro' => 'ACTIVIDADES DE RESTAURANTES Y DE SERVICIO MOVIL DE COMIDAS',
            'acteco' => 561000, //ACTIVIDAD ECONOMICA COD
            'dirorigen' => 'Ovalle',
            'comunaorigen' => 'Ovalle',
        ],
        'datos' => [
            'rut' => '76825194-0',
            'empresa' => 'SOCIEDAD GASTRONOMICA AYAHUASKA SPA',
            'rutemisor' => '7853564-4',
        ],
    ];
    

    return $datos;
}






?>

