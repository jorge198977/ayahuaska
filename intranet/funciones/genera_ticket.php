<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

// function postURL($url, $parametros)
// {
//   //urlify the data for the POST
//   $fields_string = http_build_query($parametros);

//   $ch = curl_init();
//   curl_setopt($ch, CURLOPT_HEADER, 0);
//   curl_setopt($ch, CURLOPT_VERBOSE, 0);
//   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//   curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
//   curl_setopt($ch, CURLOPT_URL, $url);
//   curl_setopt($ch, CURLOPT_POST, 1);
//   curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
//   $response = curl_exec($ch);
//   curl_close($ch);

//   return $response;
// }


function solicita_ticket($vta_id, $npedido, $nombre_cliente, $usuario_id, $mesa, $impresora){
  $codigo_comercial = "REAL002";
  $cuenta_barra = 0;
  $venta_detalles = get_ventas_detalles_id_pedido($vta_id, $npedido);
  $usuario = get_usuario_id($usuario_id);
  $nombre_usuario = $usuario['nombre']. " ".$usuario['apellido'];
  foreach ($venta_detalles as $key => $venta_detalle){
    $preparado = get_preparados_id($venta_detalle['preparado_id']);
    if($preparado['es_cocina'] == 2){
      $detalle[] = array('nombre' => utf8_encode($preparado['PREPARADOS_NOMBRE']) , 'cantidad' => $venta_detalle['cantidad'], 'observacion' => utf8_encode($venta_detalle['observacion']));
      $cuenta_barra++;
    }
  }

  // if($cuenta_barra > 0){
  //   $url = "https://api.notifier.realdev.cl/api/solicita_ticket";
  //   $parametrosdatos = array('codcomercio' => $codigo_comercial, 'comercio' => 'TURQUESA',
  //       'impresora' => $impresora,
  //       'movimiento' => $vta_id,
  //       'mesa' => $mesa,
  //       'mesero' => $nombre_usuario,
  //       'nombrecli' => $nombre_cliente,
  //       'detalle' => $detalle);
  //   $data = postURL($url, $parametrosdatos);
  //   $data = json_decode($data);
  //   return $data;
  // }

}



function solicita_ticker_cocina($vta_id, $npedido, $nombre_cliente, $usuario_id, $mesa){
  $codigo_comercial = "REAL002";
  $cuenta_cocina = 0;
  $venta_detalles = get_ventas_detalles_id_pedido($vta_id, $npedido);
  $usuario = get_usuario_id($usuario_id);
  $nombre_usuario = $usuario['nombre']. " ".$usuario['apellido'];
  foreach ($venta_detalles as $key => $venta_detalle) {
    $preparado = get_preparados_id($venta_detalle['preparado_id']);
    // SI ES COMINDA  IMPRIME
    if(($preparado['es_cocina'] == 1) || ($preparado['es_cocina'] == 3)){
      $detalle[] = array('nombre' => utf8_encode($preparado['PREPARADOS_NOMBRE']) , 'cantidad' => $venta_detalle['cantidad'], 'observacion' => utf8_encode($venta_detalle['observacion']));
        $cuenta_cocina++;
      $tamdescrip = strlen($preparado['PREPARADOS_NOMBRE']);
      $cuenta_cocina++;
    }
    
  }

  // if($cuenta_cocina > 0){
  //   $url = "https://api.notifier.realdev.cl/api/solicita_ticket";
  //   $parametrosdatos = array('codcomercio' => $codigo_comercial, 'comercio' => 'TURQUESA',
  //       'impresora' => 'COCINA',
  //       'movimiento' => $vta_id,
  //       'mesa' => $mesa,
  //       'mesero' => $nombre_usuario,
  //       'nombrecli' => $nombre_cliente,
  //       'detalle' => $detalle);
  //   $data = postURL($url, $parametrosdatos);
  //   $data = json_decode($data);
  //   return $data;
  // }

}


function solicita_ticker_parrilla($vta_id, $npedido, $nombre_cliente, $usuario_id, $mesa){
  $codigo_comercial = "REAL002";
  $cuenta_parrilla = 0;
  $venta_detalles = get_ventas_detalles_id_pedido($vta_id, $npedido);
  $usuario = get_usuario_id($usuario_id);
  $nombre_usuario = $usuario['nombre']. " ".$usuario['apellido'];
  foreach ($venta_detalles as $key => $venta_detalle) {
    $preparado = get_preparados_id($venta_detalle['preparado_id']);
    // SI ES COMINDA  IMPRIME
    if(($preparado['es_cocina'] == 1) || ($preparado['es_cocina'] == 3)){
      $detalle[] = array('nombre' => utf8_encode($preparado['PREPARADOS_NOMBRE']) , 'cantidad' => $venta_detalle['cantidad'], 'observacion' => utf8_encode($venta_detalle['observacion']));
        $cuenta_parrilla++;
    }
    
  }

  // if($cuenta_parrilla > 0){
  //   $url = "https://api.notifier.realdev.cl/api/solicita_ticket";
  //   $parametrosdatos = array('codcomercio' => $codigo_comercial, 'comercio' => 'TURQUESA',
  //       'impresora' => 'PARRILLA',
  //       'movimiento' => $vta_id,
  //       'mesa' => $mesa,
  //       'mesero' => $nombre_usuario,
  //       'nombrecli' => $nombre_cliente,
  //       'detalle' => $detalle);
  //   $data = postURL($url, $parametrosdatos);
  //   $data = json_decode($data);
  //   return $data;
  // }

}


function solicita_happy($movi, $usuario_id, $nombresocio, $mesa, $impresora){
  $codigo_comercial = "REAL002";
    $usuario = get_usuario_id($usuario_id);
    $nombre_usuario = $usuario['nombre']. " ".$usuario['apellido'];
    $preparados_happy = get_happy_preparados($movi, 0);
   
    foreach ($preparados_happy as $key => $prep_happy) {

      $preparado = get_preparados_id($prep_happy['preparado_id']);
      //$nombrearchivo = "happy-".$prep_happy['preparado_id']."-".$movi.".pdf";
     
      //Actualizar estado de happy
      actualiza_estado_preparado_happy($movi, 1, $prep_happy['preparado_id']);


      // for($z=0; $z < $prep_happy['cantidad']; $z++ ){
      //   $detalle = null;
      //   $codigo = "H".$prep_happy['preparado_id']."M".$movi."D".$prep_happy['venta_detalle_id'];
      //   $detalle[] = array('nombre' => utf8_encode($preparado['PREPARADOS_NOMBRE']) , 'cantidad' => $prep_happy['cantidad'], 'codigo' =>$codigo);
      //   $url = "https://api.notifier.realdev.cl/api/solicita_happy";
      //   $parametrosdatos = array('codcomercio' => $codigo_comercial, 'comercio' => 'TURQUESA',
      //       'impresora' => $impresora,
      //       'movimiento' => $movi,
      //       'mesa' => $mesa,
      //       'mesero' => $nombre_usuario,
      //       'nombrecli' => $nombresocio,
      //       'detalle' => $detalle);
      //   $data = postURL($url, $parametrosdatos);
      //   $data = json_decode($data);

      // }



    }


    
    
        
}






?>





