<?php

function get_firma(){
    $config = [
        'firma' => [
            'file' => '../../APISII/certs/7853564-4.pfx',
            //CAMBIAR A 'file' => '../APISII/certs/she.pfx', PARA CARGAR FOLIOS
            //'data' => '', // contenido del archivo certificado.p12
            'pass' => 'juanaa11',
        ],
    ];
    return $config;
}

function get_firma2(){
    $config = [
        'firma' => [
            'file' => '../APISII/certs/7853564-4.pfx',
            //CAMBIAR A 'file' => '../APISII/certs/she.pfx', PARA CARGAR FOLIOS
            //'data' => '', // contenido del archivo certificado.p12
            'pass' => 'juanaa11',
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
            'rut_envia' => '7853564-4',
            'rut_recep' => '60803000-K',
            'fecha_resol' => '2021-02-10', // CAMBIAR FECHA NUEVA
            'nro_resol' => 99,
        ],
        'emisor' => [
            'rut_emisor' => '76324007-K',
            'razon_social' => 'SOCIEDAD COMERCIAL DLORENZO LTDA',
            'giro' => 'ACTIVIDADES DE RESTAURANTES Y DE SERVICIO MOVIL DE COMIDAS',
            'acteco' => 561000, //ACTIVIDAD ECONOMICA COD
            'dirorigen' => 'Ovalle',
            'comunaorigen' => 'Ovalle',
        ],
        'datos' => [
            'rut' => '76324007-K',
            'empresa' => 'SOCIEDAD COMERCIAL DLORENZO LTDA',
            'rutemisor' => '7853564-4',
        ],
    ];
    

    return $datos;
}






?>

