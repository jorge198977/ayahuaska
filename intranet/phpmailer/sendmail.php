<?php
include("EnviarPush.php");
date_default_timezone_set('America/Santiago');

function generar_correo_carga_cta_cte($nombre, $rut, $mov, $monto, $fecha, $cajero, $correocli, $vta_pago_id){


$mensaje = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1' />
  <title>Oxygen Confirm</title>

  <style type='text/css'>
    /* Take care of image borders and formatting, client hacks */
    img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
    a img { border: none; }
    table { border-collapse: collapse !important;}
    #outlook a { padding:0; }
    .ReadMsgBody { width: 100%; }
    .ExternalClass { width: 100%; }
    .backgroundTable { margin: 0 auto; padding: 0; width: 100% !important; }
    table td { border-collapse: collapse; }
    .ExternalClass * { line-height: 115%; }
    .container-for-gmail-android { min-width: 600px; }


    /* General styling */
    * {
      font-family: Helvetica, Arial, sans-serif;
    }

    body {
      -webkit-font-smoothing: antialiased;
      -webkit-text-size-adjust: none;
      width: 100% !important;
      margin: 0 !important;
      height: 100%;
      color: #676767;
    }

    td {
      font-family: Helvetica, Arial, sans-serif;
      font-size: 14px;
      color: #777777;
      text-align: center;
      line-height: 21px;
    }

    a {
      color: #676767;
      text-decoration: none !important;
    }

    .pull-left {
      text-align: left;
    }

    .pull-right {
      text-align: right;
    }

    .header-lg,
    .header-md,
    .header-sm {
      font-size: 32px;
      font-weight: 700;
      line-height: normal;
      padding: 35px 0 0;
      color: #4d4d4d;
    }

    .header-md {
      font-size: 24px;
    }

    .header-sm {
      padding: 5px 0;
      font-size: 18px;
      line-height: 1.3;
    }

    .content-padding {
      padding: 20px 0 5px;
    }

    .mobile-header-padding-right {
      width: 290px;
      text-align: right;
      padding-left: 10px;
    }

    .mobile-header-padding-left {
      width: 290px;
      text-align: left;
      padding-left: 10px;
    }

    .free-text {
      width: 100% !important;
      padding: 10px 60px 0px;
    }

    .button {
      padding: 30px 0;
    }


    .mini-block {
      border: 1px solid #e5e5e5;
      border-radius: 5px;
      background-color: #ffffff;
      padding: 12px 15px 15px;
      text-align: left;
      width: 253px;
    }

    .mini-container-left {
      width: 278px;
      padding: 10px 0 10px 15px;
    }

    .mini-container-right {
      width: 278px;
      padding: 10px 14px 10px 15px;
    }

    .product {
      text-align: left;
      vertical-align: top;
      width: 175px;
    }

    .total-space {
      padding-bottom: 8px;
      display: inline-block;
    }

    .item-table {
      padding: 50px 20px;
      width: 560px;
    }

    .item {
      width: 300px;
    }

    .mobile-hide-img {
      text-align: left;
      width: 125px;
    }

    .mobile-hide-img img {
      border: 1px solid #e6e6e6;
      border-radius: 4px;
    }

    .title-dark {
      text-align: left;
      border-bottom: 1px solid #cccccc;
      color: #4d4d4d;
      font-weight: 700;
      padding-bottom: 5px;
    }

    .item-col {
      padding-top: 20px;
      text-align: left;
      vertical-align: top;
    }

    .force-width-gmail {
      min-width:600px;
      height: 0px !important;
      line-height: 1px !important;
      font-size: 1px !important;
    }

  </style>

  <style type='text/css' media='screen'>
    @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
  </style>

  <style type='text/css' media='screen'>
    @media screen {
      /* Thanks Outlook 2013! */
      * {
        font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
      }
    }
  </style>

  <style type='text/css' media='only screen and (max-width: 480px)'>
    /* Mobile styles */
    @media only screen and (max-width: 480px) {

      table[class*='container-for-gmail-android'] {
        min-width: 290px !important;
        width: 100% !important;
      }

      img[class='force-width-gmail'] {
        display: none !important;
        width: 0 !important;
        height: 0 !important;
      }

      table[class='w320'] {
        width: 320px !important;
      }


      td[class*='mobile-header-padding-left'] {
        width: 160px !important;
        padding-left: 0 !important;
      }

      td[class*='mobile-header-padding-right'] {
        width: 160px !important;
        padding-right: 0 !important;
      }

      td[class='header-lg'] {
        font-size: 24px !important;
        padding-bottom: 5px !important;
      }

      td[class='content-padding'] {
        padding: 5px 0 5px !important;
      }

       td[class='button'] {
        padding: 5px 5px 30px !important;
      }

      td[class*='free-text'] {
        padding: 10px 18px 30px !important;
      }

      td[class~='mobile-hide-img'] {
        display: none !important;
        height: 0 !important;
        width: 0 !important;
        line-height: 0 !important;
      }

      td[class~='item'] {
        width: 140px !important;
        vertical-align: top !important;
      }

      td[class~='quantity'] {
        width: 50px !important;
      }

      td[class~='price'] {
        width: 90px !important;
      }

      td[class='item-table'] {
        padding: 30px 20px !important;
      }

      td[class='mini-container-left'],
      td[class='mini-container-right'] {
        padding: 0 15px 15px !important;
        display: block !important;
        width: 290px !important;
      }
    }
  </style>
</head>

<body bgcolor='#f7f7f7'>
<table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%'>
  <tr>
    <td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
      <center>
      <img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
        <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
          <tr>
            <td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
            <!--[if gte mso 9]>
            <v:rect xmlns:v='urn:schemas-microsoft-com:vml' fill='true' stroke='false' style='mso-width-percent:1000;height:80px; v-text-anchor:middle;'>
              <v:fill type='tile' src='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' color='#ffffff' />
              <v:textbox inset='0,0,0,0'>
            <![endif]-->
              <center>
                <table cellpadding='0' cellspacing='0' width='600' class='w320'>
                  <tr>
                    <td class='pull-left mobile-header-padding-left' style='vertical-align: middle;'>
                      <a href=''><img width='200' height='100' src='http://sheolsistema.ddns.net/sheol2/intranet/images/logo3.png' alt='logo'></a>
                    </td>
                    <td class='pull-right mobile-header-padding-right' style='color: #4d4d4d;'>
                      <a href=''><img width='44' height='47' src='http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif' alt='twitter' /></a>
                      <a href=''><img width='38' height='47' src='http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif' alt='facebook' /></a>
                    </td>
                  </tr>
                </table>
              </center>
              <!--[if gte mso 9]>
              </v:textbox>
            </v:rect>
            <![endif]-->
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td align='center' valign='top' width='100%' style='background-color: #f7f7f7;' class='content-padding'>
      <center>
        <table cellspacing='0' cellpadding='0' width='600' class='w320'>
          <tr>
            <td class='header-lg'>
              ".utf8_decode('Notificación')." de cargo a cuenta corriente
            </td>
          </tr>
          <tr>
            <td class='free-text'>
              Estimado el ".utf8_decode('día')." ".date("d/m/Y").", se ha realizado
              un cargo a la cuenta corriente del cliente, los detalles se muestran a ".utf8_decode('continuación').".
            </td>
          </tr>
          <tr>
            <td class='button'>
              <div><!--[if mso]>
                <v:roundrect xmlns:v='urn:schemas-microsoft-com:vml' xmlns:w='urn:schemas-microsoft-com:office:word' href='http://' style='height:45px;v-text-anchor:middle;width:155px;' arcsize='15%' strokecolor='#ffffff' fillcolor='#ff6f6f'>
                  <w:anchorlock/>
                  <center style='color:#ffffff;font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;'>Track Order</center>
                </v:roundrect>
              <![endif]--><a href='http://'
              style='background-color:#ff6f6f;border-radius:5px;color:#ffffff;display:inline-block;font-family:'Cabin', Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;line-height:45px;text-align:center;text-decoration:none;width:155px;-webkit-text-size-adjust:none;mso-hide:all;'>DETALLE</a></div>
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td align='center' valign='top' width='100%' style='background-color: #ffffff;  border-top: 1px solid #e5e5e5; border-bottom: 1px solid #e5e5e5;'>
      <center>
        <table cellpadding='0' cellspacing='0' width='600' class='w320'>
            <tr>
              <td class='item-table'>
                <table cellspacing='0' cellpadding='0' width='100%'>
                  <tr>
                    <td class='title-dark' width='300'>
                       CLIENTE
                    </td>
                    <td class='title-dark' width='163'>
                      MOV
                    </td>
                    <td class='title-dark' width='97'>
                      HORA
                    </td>
                    <td class='title-dark' width='97'>
                      CAJERO
                    </td>
                    <td class='title-dark' width='97'>
                      MONTO
                    </td>
                  </tr>


                  <tr>
                    <td class='item-col item'>
                      <table cellspacing='0' cellpadding='0' width='100%'>
                        <tr>
                          <td class='product'>
                            <span style='color: #4d4d4d; font-weight:bold;'>".utf8_decode($nombre)."-".$rut."</span> 
                          </td>
                        </tr>
                      </table>
                    </td>
                    <td class='item-col quantity'>
                    <strong><a href='http://sheolsistema.ddns.net/sheol2/boletas/movimientos/".$mov."-".$vta_pago_id.".pdf'>".$mov."</a></strong>
                    </td>
                    <td class='item-col'>
                      ".$fecha."
                    </td>
                    <td class='item-col'>
                      ".utf8_decode($cajero)."
                    </td>
                    <td class='item-col'>
                      ".number_format($monto, 0, ',', '.')."
                    </td>
                  </tr>

                </table>
              </td>
            </tr>

        </table>
      </center>
    </td>
  </tr>
</table>
</div>
</body>
</html>";

// Cabecera que especifica que es un HMTL
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$titulo    = "Sistema web";
//$para = "".$correocli.", caferealovalle@gmail.com";
$para = "jorgeuls19@gmail.com";

mail($para, $titulo, $mensaje, $cabeceras);


// $mensaje_push = "Se ha realizado un cargo a la cuenta corriente de ".utf8_decode($nombre)."-".$rut.", con fecha ".$fecha.", el cajero ".utf8_decode($cajero)." por un monto de ".number_format($monto, 0, ',', '.').". Puede ver el comprobante en http://caferealsistema.servehttp.com:81/demosistreal/intranet/boletas/movimientos/".$mov."-".$vta_pago_id.".pdf";
// enviar_push('Cargo cuenta Corriente', $mensaje_push);

}

function enviarcorreoabonos($mov, $monto, $rut, $hora, $cajero, $nombre, $correocli){

$mensaje = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1' />
  <title>Oxygen Confirm</title>

  <style type='text/css'>
    /* Take care of image borders and formatting, client hacks */
    img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
    a img { border: none; }
    table { border-collapse: collapse !important;}
    #outlook a { padding:0; }
    .ReadMsgBody { width: 100%; }
    .ExternalClass { width: 100%; }
    .backgroundTable { margin: 0 auto; padding: 0; width: 100% !important; }
    table td { border-collapse: collapse; }
    .ExternalClass * { line-height: 115%; }
    .container-for-gmail-android { min-width: 600px; }


    /* General styling */
    * {
      font-family: Helvetica, Arial, sans-serif;
    }

    body {
      -webkit-font-smoothing: antialiased;
      -webkit-text-size-adjust: none;
      width: 100% !important;
      margin: 0 !important;
      height: 100%;
      color: #676767;
    }

    td {
      font-family: Helvetica, Arial, sans-serif;
      font-size: 14px;
      color: #777777;
      text-align: center;
      line-height: 21px;
    }

    a {
      color: #676767;
      text-decoration: none !important;
    }

    .pull-left {
      text-align: left;
    }

    .pull-right {
      text-align: right;
    }

    .header-lg,
    .header-md,
    .header-sm {
      font-size: 32px;
      font-weight: 700;
      line-height: normal;
      padding: 35px 0 0;
      color: #4d4d4d;
    }

    .header-md {
      font-size: 24px;
    }

    .header-sm {
      padding: 5px 0;
      font-size: 18px;
      line-height: 1.3;
    }

    .content-padding {
      padding: 20px 0 5px;
    }

    .mobile-header-padding-right {
      width: 290px;
      text-align: right;
      padding-left: 10px;
    }

    .mobile-header-padding-left {
      width: 290px;
      text-align: left;
      padding-left: 10px;
    }

    .free-text {
      width: 100% !important;
      padding: 10px 60px 0px;
    }

    .button {
      padding: 30px 0;
    }


    .mini-block {
      border: 1px solid #e5e5e5;
      border-radius: 5px;
      background-color: #ffffff;
      padding: 12px 15px 15px;
      text-align: left;
      width: 253px;
    }

    .mini-container-left {
      width: 278px;
      padding: 10px 0 10px 15px;
    }

    .mini-container-right {
      width: 278px;
      padding: 10px 14px 10px 15px;
    }

    .product {
      text-align: left;
      vertical-align: top;
      width: 175px;
    }

    .total-space {
      padding-bottom: 8px;
      display: inline-block;
    }

    .item-table {
      padding: 50px 20px;
      width: 560px;
    }

    .item {
      width: 300px;
    }

    .mobile-hide-img {
      text-align: left;
      width: 125px;
    }

    .mobile-hide-img img {
      border: 1px solid #e6e6e6;
      border-radius: 4px;
    }

    .title-dark {
      text-align: left;
      border-bottom: 1px solid #cccccc;
      color: #4d4d4d;
      font-weight: 700;
      padding-bottom: 5px;
    }

    .item-col {
      padding-top: 20px;
      text-align: left;
      vertical-align: top;
    }

    .force-width-gmail {
      min-width:600px;
      height: 0px !important;
      line-height: 1px !important;
      font-size: 1px !important;
    }

  </style>

  <style type='text/css' media='screen'>
    @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
  </style>

  <style type='text/css' media='screen'>
    @media screen {
      /* Thanks Outlook 2013! */
      * {
        font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
      }
    }
  </style>

  <style type='text/css' media='only screen and (max-width: 480px)'>
    /* Mobile styles */
    @media only screen and (max-width: 480px) {

      table[class*='container-for-gmail-android'] {
        min-width: 290px !important;
        width: 100% !important;
      }

      img[class='force-width-gmail'] {
        display: none !important;
        width: 0 !important;
        height: 0 !important;
      }

      table[class='w320'] {
        width: 320px !important;
      }


      td[class*='mobile-header-padding-left'] {
        width: 160px !important;
        padding-left: 0 !important;
      }

      td[class*='mobile-header-padding-right'] {
        width: 160px !important;
        padding-right: 0 !important;
      }

      td[class='header-lg'] {
        font-size: 24px !important;
        padding-bottom: 5px !important;
      }

      td[class='content-padding'] {
        padding: 5px 0 5px !important;
      }

       td[class='button'] {
        padding: 5px 5px 30px !important;
      }

      td[class*='free-text'] {
        padding: 10px 18px 30px !important;
      }

      td[class~='mobile-hide-img'] {
        display: none !important;
        height: 0 !important;
        width: 0 !important;
        line-height: 0 !important;
      }

      td[class~='item'] {
        width: 140px !important;
        vertical-align: top !important;
      }

      td[class~='quantity'] {
        width: 50px !important;
      }

      td[class~='price'] {
        width: 90px !important;
      }

      td[class='item-table'] {
        padding: 30px 20px !important;
      }

      td[class='mini-container-left'],
      td[class='mini-container-right'] {
        padding: 0 15px 15px !important;
        display: block !important;
        width: 290px !important;
      }
    }
  </style>
</head>

<body bgcolor='#f7f7f7'>
<table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%'>
  <tr>
    <td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
      <center>
      <img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
        <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
          <tr>
            <td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
            <!--[if gte mso 9]>
            <v:rect xmlns:v='urn:schemas-microsoft-com:vml' fill='true' stroke='false' style='mso-width-percent:1000;height:80px; v-text-anchor:middle;'>
              <v:fill type='tile' src='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' color='#ffffff' />
              <v:textbox inset='0,0,0,0'>
            <![endif]-->
              <center>
                <table cellpadding='0' cellspacing='0' width='600' class='w320'>
                  <tr>
                    <td class='pull-left mobile-header-padding-left' style='vertical-align: middle;'>
                      <a href=''><img width='200' height='100' src='http://sheolsistema.ddns.net/sheol2/intranet/images/logo3.png' alt='logo'></a>
                    </td>
                    <td class='pull-right mobile-header-padding-right' style='color: #4d4d4d;'>
                      <a href=''><img width='44' height='47' src='http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif' alt='twitter' /></a>
                      <a href=''><img width='38' height='47' src='http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif' alt='facebook' /></a>
                    </td>
                  </tr>
                </table>
              </center>
              <!--[if gte mso 9]>
              </v:textbox>
            </v:rect>
            <![endif]-->
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td align='center' valign='top' width='100%' style='background-color: #f7f7f7;' class='content-padding'>
      <center>
        <table cellspacing='0' cellpadding='0' width='600' class='w320'>
          <tr>
            <td class='header-lg'>
              ".utf8_decode('Notificación')." abono a cuenta corriente
            </td>
          </tr>
          <tr>
            <td class='free-text'>
              Estimado el ".utf8_decode('día')." ".date("d/m/Y")." se ha realizado
                   un abono a la cuenta corriente del cliente, los detalles se muestran a ".utf8_decode('continuación').".
            </td>
          </tr>
          <tr>
            <td class='button'>
              <div><!--[if mso]>
                <v:roundrect xmlns:v='urn:schemas-microsoft-com:vml' xmlns:w='urn:schemas-microsoft-com:office:word' href='http://' style='height:45px;v-text-anchor:middle;width:155px;' arcsize='15%' strokecolor='#ffffff' fillcolor='#ff6f6f'>
                  <w:anchorlock/>
                  <center style='color:#ffffff;font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;'>Track Order</center>
                </v:roundrect>
              <![endif]--><a href='http://'
              style='background-color:#ff6f6f;border-radius:5px;color:#ffffff;display:inline-block;font-family:'Cabin', Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;line-height:45px;text-align:center;text-decoration:none;width:155px;-webkit-text-size-adjust:none;mso-hide:all;'>DETALLE</a></div>
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td align='center' valign='top' width='100%' style='background-color: #ffffff;  border-top: 1px solid #e5e5e5; border-bottom: 1px solid #e5e5e5;'>
      <center>
        <table cellpadding='0' cellspacing='0' width='600' class='w320'>
            <tr>
              <td class='item-table'>
                <table cellspacing='0' cellpadding='0' width='100%'>
                  <tr>
                    <td class='title-dark' width='300'>
                       CAJERO
                    </td>
                    <td class='title-dark' width='163'>
                      MOV
                    </td>
                    <td class='title-dark' width='97'>
                      HORA
                    </td>
                    <td class='title-dark' width='97'>
                      MONTO
                    </td>
                  </tr>


                  <tr>
                    <td class='item-col item'>
                      <table cellspacing='0' cellpadding='0' width='100%'>
                        <tr>
                          <td class='product'>
                            <span style='color: #4d4d4d; font-weight:bold;'>".utf8_decode($nombre)."</span> 
                          </td>
                        </tr>
                      </table>
                    </td>
                    <td class='item-col quantity'>
                    ".$mov."
                    </td>
                    <td class='item-col quantity'>
                    ".$hora."
                    </td>
                    <td class='item-col'>
                      $".number_format($monto, 0, ',', '.')."
                    </td>
                  </tr>

                </table>
              </td>
            </tr>

        </table>
      </center>
    </td>
  </tr>
</table>
</div>
</body>
</html>";

// Cabecera que especifica que es un HMTL
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$para = "jorgeuls19@gmail.com";
//$para = "".$correocli.", pagos.sheol@gmail.com";
$titulo    = "Sistema web";
//$para = "".$correocli."";
//$para = "jorgeuls19@gmail.com";

mail($para, $titulo, $mensaje, $cabeceras);

// $mensaje_push = "Estimado, el ".utf8_decode('día')." ".date("d/m/Y")." se ha realizado un abono a la cuenta corriente del cliente. Cajero ".utf8_decode($nombre).", MOV: ".$mov.", MONTO: $".number_format($monto, 0, ',', '.')." <br>";
// enviar_push('Abono Cuenta Corriente', $mensaje_push);

}

function generar_correo_deudores($rut, $nombre, $correo, $debe){


  $mensaje = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1' />
  <title>Oxygen Confirm</title>

  <style type='text/css'>
    /* Take care of image borders and formatting, client hacks */
    img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
    a img { border: none; }
    table { border-collapse: collapse !important;}
    #outlook a { padding:0; }
    .ReadMsgBody { width: 100%; }
    .ExternalClass { width: 100%; }
    .backgroundTable { margin: 0 auto; padding: 0; width: 100% !important; }
    table td { border-collapse: collapse; }
    .ExternalClass * { line-height: 115%; }
    .container-for-gmail-android { min-width: 600px; }


    /* General styling */
    * {
      font-family: Helvetica, Arial, sans-serif;
    }

    body {
      -webkit-font-smoothing: antialiased;
      -webkit-text-size-adjust: none;
      width: 100% !important;
      margin: 0 !important;
      height: 100%;
      color: #676767;
    }

    td {
      font-family: Helvetica, Arial, sans-serif;
      font-size: 14px;
      color: #777777;
      text-align: center;
      line-height: 21px;
    }

    a {
      color: #676767;
      text-decoration: none !important;
    }

    .pull-left {
      text-align: left;
    }

    .pull-right {
      text-align: right;
    }

    .header-lg,
    .header-md,
    .header-sm {
      font-size: 32px;
      font-weight: 700;
      line-height: normal;
      padding: 35px 0 0;
      color: #4d4d4d;
    }

    .header-md {
      font-size: 24px;
    }

    .header-sm {
      padding: 5px 0;
      font-size: 18px;
      line-height: 1.3;
    }

    .content-padding {
      padding: 20px 0 5px;
    }

    .mobile-header-padding-right {
      width: 290px;
      text-align: right;
      padding-left: 10px;
    }

    .mobile-header-padding-left {
      width: 290px;
      text-align: left;
      padding-left: 10px;
    }

    .free-text {
      width: 100% !important;
      padding: 10px 60px 0px;
    }

    .button {
      padding: 30px 0;
    }


    .mini-block {
      border: 1px solid #e5e5e5;
      border-radius: 5px;
      background-color: #ffffff;
      padding: 12px 15px 15px;
      text-align: left;
      width: 253px;
    }

    .mini-container-left {
      width: 278px;
      padding: 10px 0 10px 15px;
    }

    .mini-container-right {
      width: 278px;
      padding: 10px 14px 10px 15px;
    }

    .product {
      text-align: left;
      vertical-align: top;
      width: 175px;
    }

    .total-space {
      padding-bottom: 8px;
      display: inline-block;
    }

    .item-table {
      padding: 50px 20px;
      width: 560px;
    }

    .item {
      width: 300px;
    }

    .mobile-hide-img {
      text-align: left;
      width: 125px;
    }

    .mobile-hide-img img {
      border: 1px solid #e6e6e6;
      border-radius: 4px;
    }

    .title-dark {
      text-align: left;
      border-bottom: 1px solid #cccccc;
      color: #4d4d4d;
      font-weight: 700;
      padding-bottom: 5px;
    }

    .item-col {
      padding-top: 20px;
      text-align: left;
      vertical-align: top;
    }

    .force-width-gmail {
      min-width:600px;
      height: 0px !important;
      line-height: 1px !important;
      font-size: 1px !important;
    }

  </style>

  <style type='text/css' media='screen'>
    @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
  </style>

  <style type='text/css' media='screen'>
    @media screen {
      /* Thanks Outlook 2013! */
      * {
        font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
      }
    }
  </style>

  <style type='text/css' media='only screen and (max-width: 480px)'>
    /* Mobile styles */
    @media only screen and (max-width: 480px) {

      table[class*='container-for-gmail-android'] {
        min-width: 290px !important;
        width: 100% !important;
      }

      img[class='force-width-gmail'] {
        display: none !important;
        width: 0 !important;
        height: 0 !important;
      }

      table[class='w320'] {
        width: 320px !important;
      }


      td[class*='mobile-header-padding-left'] {
        width: 160px !important;
        padding-left: 0 !important;
      }

      td[class*='mobile-header-padding-right'] {
        width: 160px !important;
        padding-right: 0 !important;
      }

      td[class='header-lg'] {
        font-size: 24px !important;
        padding-bottom: 5px !important;
      }

      td[class='content-padding'] {
        padding: 5px 0 5px !important;
      }

       td[class='button'] {
        padding: 5px 5px 30px !important;
      }

      td[class*='free-text'] {
        padding: 10px 18px 30px !important;
      }

      td[class~='mobile-hide-img'] {
        display: none !important;
        height: 0 !important;
        width: 0 !important;
        line-height: 0 !important;
      }

      td[class~='item'] {
        width: 140px !important;
        vertical-align: top !important;
      }

      td[class~='quantity'] {
        width: 50px !important;
      }

      td[class~='price'] {
        width: 90px !important;
      }

      td[class='item-table'] {
        padding: 30px 20px !important;
      }

      td[class='mini-container-left'],
      td[class='mini-container-right'] {
        padding: 0 15px 15px !important;
        display: block !important;
        width: 290px !important;
      }
    }
  </style>
</head>

<body bgcolor='#f7f7f7'>
<table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%'>
  <tr>
    <td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
      <center>
      <img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
        <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
          <tr>
            <td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
            <!--[if gte mso 9]>
            <v:rect xmlns:v='urn:schemas-microsoft-com:vml' fill='true' stroke='false' style='mso-width-percent:1000;height:80px; v-text-anchor:middle;'>
              <v:fill type='tile' src='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' color='#ffffff' />
              <v:textbox inset='0,0,0,0'>
            <![endif]-->
              <center>
                <table cellpadding='0' cellspacing='0' width='600' class='w320'>
                  <tr>
                    <td class='pull-left mobile-header-padding-left' style='vertical-align: middle;'>
                      <a href=''><img width='200' height='100' src='http://sheolsistema.ddns.net/sheol2/intranet/images/logo3.png' alt='logo'></a>
                    </td>
                    <td class='pull-right mobile-header-padding-right' style='color: #4d4d4d;'>
                      <a href=''><img width='44' height='47' src='http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif' alt='twitter' /></a>
                      <a href=''><img width='38' height='47' src='http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif' alt='facebook' /></a>
                    </td>
                  </tr>
                </table>
              </center>
              <!--[if gte mso 9]>
              </v:textbox>
            </v:rect>
            <![endif]-->
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td align='center' valign='top' width='100%' style='background-color: #f7f7f7;' class='content-padding'>
      <center>
        <table cellspacing='0' cellpadding='0' width='600' class='w320'>
          <tr>
            <td class='header-lg'>
              Recordatorio deuda impaga
            </td>
          </tr>
          <tr>
            <td class='free-text'>
              Estimado ".utf8_decode(".$nombre.")." al ".utf8_decode('día')." ".date("d/m/Y").", le recordamos que mantiene una deuda vigente, el detalle se describe ".utf8_decode('continuación').".
            </td>
          </tr>
          <tr>
            <td class='button'>
              <div><!--[if mso]>
                <v:roundrect xmlns:v='urn:schemas-microsoft-com:vml' xmlns:w='urn:schemas-microsoft-com:office:word' href='http://' style='height:45px;v-text-anchor:middle;width:155px;' arcsize='15%' strokecolor='#ffffff' fillcolor='#ff6f6f'>
                  <w:anchorlock/>
                  <center style='color:#ffffff;font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;'>Track Order</center>
                </v:roundrect>
              <![endif]--><a href='http://'
              style='background-color:#ff6f6f;border-radius:5px;color:#ffffff;display:inline-block;font-family:'Cabin', Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;line-height:45px;text-align:center;text-decoration:none;width:155px;-webkit-text-size-adjust:none;mso-hide:all;'>DETALLE</a></div>
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td align='center' valign='top' width='100%' style='background-color: #ffffff;  border-top: 1px solid #e5e5e5; border-bottom: 1px solid #e5e5e5;'>
      <center>
        <table cellpadding='0' cellspacing='0' width='600' class='w320'>
            <tr>
              <td class='item-table'>
                <table cellspacing='0' cellpadding='0' width='100%'>
                  <tr>
                    <td class='title-dark' width='300'>
                       NOMBRE
                    </td>
                    <td class='title-dark' width='163'>
                      RUT
                    </td>
                    <td class='title-dark' width='97'>
                      DEUDA
                    </td>
                  </tr>


                  <tr>
                    <td class='item-col item'>
                      <table cellspacing='0' cellpadding='0' width='100%'>
                        <tr>
                          <td class='product'>
                            <span style='color: #4d4d4d; font-weight:bold;'>".utf8_decode($nombre)."</span> 
                          </td>
                        </tr>
                      </table>
                    </td>
                    <td class='item-col quantity'>
                    ".$rut."
                    </td>
                    <td class='item-col'>
                      $".number_format($debe, 0, ',', '.')."
                    </td>
                  </tr>

                </table>
              </td>
            </tr>

        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td align='center' valign='top' width='100%' style='background-color: #f7f7f7; height: 100px;'>
      <center>
        <table cellspacing='0' cellpadding='0' width='600' class='w320'>
          <tr>
            <td style='padding: 25px 0 25px'>
              <strong>
                Puede cancelar su deuda a la sigueinte cuenta y enviar comprobante a admsistemareal@gmail.com:
              </strong>


              <tr>
                <td align='center' valign='top' width='100%' style='background-color: #ffffff;  border-top: 1px solid #e5e5e5; border-bottom: 1px solid #e5e5e5;'>
                  <center>
                    <table cellpadding='0' cellspacing='0' width='600' class='w320'>
                        <tr>
                          <td class='item-table'>
                            <table cellspacing='0' cellpadding='0' width='100%'>
                              <tr>
                                <td class='title-dark' width='300'>
                                   Cta corriente
                                </td>
                                <td class='title-dark' width='163'>
                                  RUT
                                </td>
                                <td class='title-dark' width='97'>
                                  Numero cta
                                </td>
                              </tr>


                              <tr>
                                <td class='item-col item'>
                                  <table cellspacing='0' cellpadding='0' width='100%'>
                                    <tr>
                                      <td class='product'>
                                        <span style='color: #4d4d4d; font-weight:bold;'>Banco de chile</span> 
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                                <td class='item-col quantity'>
                                14314351-1
                                </td>
                                <td class='item-col'>
                                  128-00637-04
                                </td>
                              </tr>

                            </table>
                          </td>
                        </tr>

                    </table>
                  </center>
                </td>
              </tr>

            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
</table>
</div>
</body>
</html>";





// Cabecera que especifica que es un HMTL
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$para = "jorgeuls19@gmail.com";
//$para = "".$correo.",pagos.sheol@gmail.com";
$titulo    = "Sistema web";
mail($para, $titulo, $mensaje, $cabeceras);

}




function enviarcorreostock($producto, $stock, $stockmin){

$mensaje = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1' />
  <title>Oxygen Confirm</title>

  <style type='text/css'>
    /* Take care of image borders and formatting, client hacks */
    img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
    a img { border: none; }
    table { border-collapse: collapse !important;}
    #outlook a { padding:0; }
    .ReadMsgBody { width: 100%; }
    .ExternalClass { width: 100%; }
    .backgroundTable { margin: 0 auto; padding: 0; width: 100% !important; }
    table td { border-collapse: collapse; }
    .ExternalClass * { line-height: 115%; }
    .container-for-gmail-android { min-width: 600px; }


    /* General styling */
    * {
      font-family: Helvetica, Arial, sans-serif;
    }

    body {
      -webkit-font-smoothing: antialiased;
      -webkit-text-size-adjust: none;
      width: 100% !important;
      margin: 0 !important;
      height: 100%;
      color: #676767;
    }

    td {
      font-family: Helvetica, Arial, sans-serif;
      font-size: 14px;
      color: #777777;
      text-align: center;
      line-height: 21px;
    }

    a {
      color: #676767;
      text-decoration: none !important;
    }

    .pull-left {
      text-align: left;
    }

    .pull-right {
      text-align: right;
    }

    .header-lg,
    .header-md,
    .header-sm {
      font-size: 32px;
      font-weight: 700;
      line-height: normal;
      padding: 35px 0 0;
      color: #4d4d4d;
    }

    .header-md {
      font-size: 24px;
    }

    .header-sm {
      padding: 5px 0;
      font-size: 18px;
      line-height: 1.3;
    }

    .content-padding {
      padding: 20px 0 5px;
    }

    .mobile-header-padding-right {
      width: 290px;
      text-align: right;
      padding-left: 10px;
    }

    .mobile-header-padding-left {
      width: 290px;
      text-align: left;
      padding-left: 10px;
    }

    .free-text {
      width: 100% !important;
      padding: 10px 60px 0px;
    }

    .button {
      padding: 30px 0;
    }


    .mini-block {
      border: 1px solid #e5e5e5;
      border-radius: 5px;
      background-color: #ffffff;
      padding: 12px 15px 15px;
      text-align: left;
      width: 253px;
    }

    .mini-container-left {
      width: 278px;
      padding: 10px 0 10px 15px;
    }

    .mini-container-right {
      width: 278px;
      padding: 10px 14px 10px 15px;
    }

    .product {
      text-align: left;
      vertical-align: top;
      width: 175px;
    }

    .total-space {
      padding-bottom: 8px;
      display: inline-block;
    }

    .item-table {
      padding: 50px 20px;
      width: 560px;
    }

    .item {
      width: 300px;
    }

    .mobile-hide-img {
      text-align: left;
      width: 125px;
    }

    .mobile-hide-img img {
      border: 1px solid #e6e6e6;
      border-radius: 4px;
    }

    .title-dark {
      text-align: left;
      border-bottom: 1px solid #cccccc;
      color: #4d4d4d;
      font-weight: 700;
      padding-bottom: 5px;
    }

    .item-col {
      padding-top: 20px;
      text-align: left;
      vertical-align: top;
    }

    .force-width-gmail {
      min-width:600px;
      height: 0px !important;
      line-height: 1px !important;
      font-size: 1px !important;
    }

  </style>

  <style type='text/css' media='screen'>
    @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
  </style>

  <style type='text/css' media='screen'>
    @media screen {
      /* Thanks Outlook 2013! */
      * {
        font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
      }
    }
  </style>

  <style type='text/css' media='only screen and (max-width: 480px)'>
    /* Mobile styles */
    @media only screen and (max-width: 480px) {

      table[class*='container-for-gmail-android'] {
        min-width: 290px !important;
        width: 100% !important;
      }

      img[class='force-width-gmail'] {
        display: none !important;
        width: 0 !important;
        height: 0 !important;
      }

      table[class='w320'] {
        width: 320px !important;
      }


      td[class*='mobile-header-padding-left'] {
        width: 160px !important;
        padding-left: 0 !important;
      }

      td[class*='mobile-header-padding-right'] {
        width: 160px !important;
        padding-right: 0 !important;
      }

      td[class='header-lg'] {
        font-size: 24px !important;
        padding-bottom: 5px !important;
      }

      td[class='content-padding'] {
        padding: 5px 0 5px !important;
      }

       td[class='button'] {
        padding: 5px 5px 30px !important;
      }

      td[class*='free-text'] {
        padding: 10px 18px 30px !important;
      }

      td[class~='mobile-hide-img'] {
        display: none !important;
        height: 0 !important;
        width: 0 !important;
        line-height: 0 !important;
      }

      td[class~='item'] {
        width: 140px !important;
        vertical-align: top !important;
      }

      td[class~='quantity'] {
        width: 50px !important;
      }

      td[class~='price'] {
        width: 90px !important;
      }

      td[class='item-table'] {
        padding: 30px 20px !important;
      }

      td[class='mini-container-left'],
      td[class='mini-container-right'] {
        padding: 0 15px 15px !important;
        display: block !important;
        width: 290px !important;
      }
    }
  </style>
</head>

<body bgcolor='#f7f7f7'>
<table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%'>
  <tr>
    <td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
      <center>
      <img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
        <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
          <tr>
            <td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
            <!--[if gte mso 9]>
            <v:rect xmlns:v='urn:schemas-microsoft-com:vml' fill='true' stroke='false' style='mso-width-percent:1000;height:80px; v-text-anchor:middle;'>
              <v:fill type='tile' src='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' color='#ffffff' />
              <v:textbox inset='0,0,0,0'>
            <![endif]-->
              <center>
                <table cellpadding='0' cellspacing='0' width='600' class='w320'>
                  <tr>
                    <td class='pull-left mobile-header-padding-left' style='vertical-align: middle;'>
                      <a href=''><img width='200' height='100' src='http://sheolsistema.ddns.net/sheol2/intranet/images/logo3.png' alt='logo'></a>
                    </td>
                    <td class='pull-right mobile-header-padding-right' style='color: #4d4d4d;'>
                      <a href=''><img width='44' height='47' src='http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif' alt='twitter' /></a>
                      <a href=''><img width='38' height='47' src='http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif' alt='facebook' /></a>
                    </td>
                  </tr>
                </table>
              </center>
              <!--[if gte mso 9]>
              </v:textbox>
            </v:rect>
            <![endif]-->
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td align='center' valign='top' width='100%' style='background-color: #f7f7f7;' class='content-padding'>
      <center>
        <table cellspacing='0' cellpadding='0' width='600' class='w320'>
          <tr>
            <td class='header-lg'>
              Reporte stock ".utf8_decode('crítico')."
            </td>
          </tr>
          <tr>
            <td class='free-text'>
              Estimado Sistema Real reporta stock ".utf8_decode('crítico')." del producto ".utf8_decode($producto)." en SISTEMA REAL.
            </td>
          </tr>
          <tr>
            <td class='button'>
              <div><!--[if mso]>
                <v:roundrect xmlns:v='urn:schemas-microsoft-com:vml' xmlns:w='urn:schemas-microsoft-com:office:word' href='http://' style='height:45px;v-text-anchor:middle;width:155px;' arcsize='15%' strokecolor='#ffffff' fillcolor='#ff6f6f'>
                  <w:anchorlock/>
                  <center style='color:#ffffff;font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;'>Track Order</center>
                </v:roundrect>
              <![endif]--><a href='http://'
              style='background-color:#ff6f6f;border-radius:5px;color:#ffffff;display:inline-block;font-family:'Cabin', Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;line-height:45px;text-align:center;text-decoration:none;width:155px;-webkit-text-size-adjust:none;mso-hide:all;'>DETALLE</a></div>
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td align='center' valign='top' width='100%' style='background-color: #ffffff;  border-top: 1px solid #e5e5e5; border-bottom: 1px solid #e5e5e5;'>
      <center>
        <table cellpadding='0' cellspacing='0' width='600' class='w320'>
            <tr>
              <td class='item-table'>
                <table cellspacing='0' cellpadding='0' width='100%'>
                  <tr>
                    <td class='title-dark' width='300'>
                       PRODUCTO
                    </td>
                    <td class='title-dark' width='163'>
                      FECHA
                    </td>
                    <td class='title-dark' width='97'>
                      STOCK MIN
                    </td>
                    <td class='title-dark' width='97'>
                      STOCK ACTUAL
                    </td>
                  </tr>


                  <tr>
                    <td class='item-col item'>
                      <table cellspacing='0' cellpadding='0' width='100%'>
                        <tr>
                          <td class='product'>
                            <span style='color: #4d4d4d; font-weight:bold;'>".utf8_decode($producto)."</span> 
                          </td>
                        </tr>
                      </table>
                    </td>
                    <td class='item-col quantity'>
                    ".date("Y/m/d H:i:s")."
                    </td>
                    <td class='item-col'>
                      ".$stockmin."
                    </td>
                    <td class='item-col'>
                      ".$stock."
                    </td>
                  </tr>

                </table>
              </td>
            </tr>

        </table>
      </center>
    </td>
  </tr>
</table>
</div>
</body>
</html>";

// Cabecera que especifica que es un HMTL
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//$para = "adm.reportesheol@gmail.com";
$para = "jorgeuls19@gmail.com";
//$para = $correo;

mail($para, $titulo, $mensaje, $cabeceras);

}



function enviarcorrecheque($nfact, $url){

$mensaje = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1' />
  <title>Oxygen Confirm</title>

  <style type='text/css'>
    /* Take care of image borders and formatting, client hacks */
    img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
    a img { border: none; }
    table { border-collapse: collapse !important;}
    #outlook a { padding:0; }
    .ReadMsgBody { width: 100%; }
    .ExternalClass { width: 100%; }
    .backgroundTable { margin: 0 auto; padding: 0; width: 100% !important; }
    table td { border-collapse: collapse; }
    .ExternalClass * { line-height: 115%; }
    .container-for-gmail-android { min-width: 600px; }


    /* General styling */
    * {
      font-family: Helvetica, Arial, sans-serif;
    }

    body {
      -webkit-font-smoothing: antialiased;
      -webkit-text-size-adjust: none;
      width: 100% !important;
      margin: 0 !important;
      height: 100%;
      color: #676767;
    }

    td {
      font-family: Helvetica, Arial, sans-serif;
      font-size: 14px;
      color: #777777;
      text-align: center;
      line-height: 21px;
    }

    a {
      color: #676767;
      text-decoration: none !important;
    }

    .pull-left {
      text-align: left;
    }

    .pull-right {
      text-align: right;
    }

    .header-lg,
    .header-md,
    .header-sm {
      font-size: 32px;
      font-weight: 700;
      line-height: normal;
      padding: 35px 0 0;
      color: #4d4d4d;
    }

    .header-md {
      font-size: 24px;
    }

    .header-sm {
      padding: 5px 0;
      font-size: 18px;
      line-height: 1.3;
    }

    .content-padding {
      padding: 20px 0 5px;
    }

    .mobile-header-padding-right {
      width: 290px;
      text-align: right;
      padding-left: 10px;
    }

    .mobile-header-padding-left {
      width: 290px;
      text-align: left;
      padding-left: 10px;
    }

    .free-text {
      width: 100% !important;
      padding: 10px 60px 0px;
    }

    .button {
      padding: 30px 0;
    }


    .mini-block {
      border: 1px solid #e5e5e5;
      border-radius: 5px;
      background-color: #ffffff;
      padding: 12px 15px 15px;
      text-align: left;
      width: 253px;
    }

    .mini-container-left {
      width: 278px;
      padding: 10px 0 10px 15px;
    }

    .mini-container-right {
      width: 278px;
      padding: 10px 14px 10px 15px;
    }

    .product {
      text-align: left;
      vertical-align: top;
      width: 175px;
    }

    .total-space {
      padding-bottom: 8px;
      display: inline-block;
    }

    .item-table {
      padding: 50px 20px;
      width: 560px;
    }

    .item {
      width: 300px;
    }

    .mobile-hide-img {
      text-align: left;
      width: 125px;
    }

    .mobile-hide-img img {
      border: 1px solid #e6e6e6;
      border-radius: 4px;
    }

    .title-dark {
      text-align: left;
      border-bottom: 1px solid #cccccc;
      color: #4d4d4d;
      font-weight: 700;
      padding-bottom: 5px;
    }

    .item-col {
      padding-top: 20px;
      text-align: left;
      vertical-align: top;
    }

    .force-width-gmail {
      min-width:600px;
      height: 0px !important;
      line-height: 1px !important;
      font-size: 1px !important;
    }

  </style>

  <style type='text/css' media='screen'>
    @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
  </style>

  <style type='text/css' media='screen'>
    @media screen {
      /* Thanks Outlook 2013! */
      * {
        font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
      }
    }
  </style>

  <style type='text/css' media='only screen and (max-width: 480px)'>
    /* Mobile styles */
    @media only screen and (max-width: 480px) {

      table[class*='container-for-gmail-android'] {
        min-width: 290px !important;
        width: 100% !important;
      }

      img[class='force-width-gmail'] {
        display: none !important;
        width: 0 !important;
        height: 0 !important;
      }

      table[class='w320'] {
        width: 320px !important;
      }


      td[class*='mobile-header-padding-left'] {
        width: 160px !important;
        padding-left: 0 !important;
      }

      td[class*='mobile-header-padding-right'] {
        width: 160px !important;
        padding-right: 0 !important;
      }

      td[class='header-lg'] {
        font-size: 24px !important;
        padding-bottom: 5px !important;
      }

      td[class='content-padding'] {
        padding: 5px 0 5px !important;
      }

       td[class='button'] {
        padding: 5px 5px 30px !important;
      }

      td[class*='free-text'] {
        padding: 10px 18px 30px !important;
      }

      td[class~='mobile-hide-img'] {
        display: none !important;
        height: 0 !important;
        width: 0 !important;
        line-height: 0 !important;
      }

      td[class~='item'] {
        width: 140px !important;
        vertical-align: top !important;
      }

      td[class~='quantity'] {
        width: 50px !important;
      }

      td[class~='price'] {
        width: 90px !important;
      }

      td[class='item-table'] {
        padding: 30px 20px !important;
      }

      td[class='mini-container-left'],
      td[class='mini-container-right'] {
        padding: 0 15px 15px !important;
        display: block !important;
        width: 290px !important;
      }
    }
  </style>
</head>

<body bgcolor='#f7f7f7'>
<table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%'>
  <tr>
    <td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
      <center>
      <img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
        <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
          <tr>
            <td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
            <!--[if gte mso 9]>
            <v:rect xmlns:v='urn:schemas-microsoft-com:vml' fill='true' stroke='false' style='mso-width-percent:1000;height:80px; v-text-anchor:middle;'>
              <v:fill type='tile' src='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' color='#ffffff' />
              <v:textbox inset='0,0,0,0'>
            <![endif]-->
              <center>
                <table cellpadding='0' cellspacing='0' width='600' class='w320'>
                  <tr>
                    <td class='pull-left mobile-header-padding-left' style='vertical-align: middle;'>
                      <a href=''><img width='200' height='100' src='http://sheolsistema.ddns.net/sheol2/intranet/images/logo3.png' alt='logo'></a>
                    </td>
                    <td class='pull-right mobile-header-padding-right' style='color: #4d4d4d;'>
                      <a href=''><img width='44' height='47' src='http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif' alt='twitter' /></a>
                      <a href=''><img width='38' height='47' src='http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif' alt='facebook' /></a>
                    </td>
                  </tr>
                </table>
              </center>
              <!--[if gte mso 9]>
              </v:textbox>
            </v:rect>
            <![endif]-->
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td align='center' valign='top' width='100%' style='background-color: #f7f7f7;' class='content-padding'>
      <center>
        <table cellspacing='0' cellpadding='0' width='600' class='w320'>
          <tr>
            <td class='header-lg'>
              Ingreso de Nuevo Cheque
            </td>
          </tr>
          <tr>
            <td class='free-text'>
              Estimado Sistema Real reporta ingreso de nuevo cheque a nuestro sistema, a ".utf8_decode('continuación')." se da a conocer la ruta donde puede visualizar el documento:
            </td>
          </tr>
          <tr>
            <td class='button'>
              <div><!--[if mso]>
                <v:roundrect xmlns:v='urn:schemas-microsoft-com:vml' xmlns:w='urn:schemas-microsoft-com:office:word' href='http://' style='height:45px;v-text-anchor:middle;width:155px;' arcsize='15%' strokecolor='#ffffff' fillcolor='#ff6f6f'>
                  <w:anchorlock/>
                  <center style='color:#ffffff;font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;'>Track Order</center>
                </v:roundrect>
              <![endif]--><a href='http://'
              style='background-color:#ff6f6f;border-radius:5px;color:#ffffff;display:inline-block;font-family:'Cabin', Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;line-height:45px;text-align:center;text-decoration:none;width:155px;-webkit-text-size-adjust:none;mso-hide:all;'>DETALLE</a></div>
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td align='center' valign='top' width='100%' style='background-color: #ffffff;  border-top: 1px solid #e5e5e5; border-bottom: 1px solid #e5e5e5;'>
      <center>
        <table cellpadding='0' cellspacing='0' width='600' class='w320'>
            <tr>
              <td class='item-table'>
                <table cellspacing='0' cellpadding='0' width='100%'>
                  <tr>
                    <td class='title-dark' width='300'>
                       URL
                    </td>
                    <td class='title-dark' width='163'>
                      FECHA
                    </td>
                    <td class='title-dark' width='97'>
                      NRO
                    </td>
                  </tr>


                  <tr>
                    <td class='item-col item'>
                      <table cellspacing='0' cellpadding='0' width='100%'>
                        <tr>
                          <td class='product'>
                            <span style='color: #4d4d4d; font-weight:bold;'>".$url."</span> 
                          </td>
                        </tr>
                      </table>
                    </td>
                    <td class='item-col quantity'>
                    ".date("d-m-Y H:i:s")."
                    </td>
                    <td class='item-col'>
                      ".$nfact."
                    </td>
                  </tr>

                </table>
              </td>
            </tr>

        </table>
      </center>
    </td>
  </tr>
</table>
</div>
</body>
</html>";

// Cabecera que especifica que es un HMTL
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//$para = "adm.reportesheol@gmail.com";
$para = "jorgeuls19@gmail.com";
//$para = $correo;

mail($para, $titulo, $mensaje, $cabeceras);

}


function enviarcorreobajastock($producto){

$mensaje = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1' />
  <title>Oxygen Confirm</title>

  <style type='text/css'>
    /* Take care of image borders and formatting, client hacks */
    img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
    a img { border: none; }
    table { border-collapse: collapse !important;}
    #outlook a { padding:0; }
    .ReadMsgBody { width: 100%; }
    .ExternalClass { width: 100%; }
    .backgroundTable { margin: 0 auto; padding: 0; width: 100% !important; }
    table td { border-collapse: collapse; }
    .ExternalClass * { line-height: 115%; }
    .container-for-gmail-android { min-width: 600px; }


    /* General styling */
    * {
      font-family: Helvetica, Arial, sans-serif;
    }

    body {
      -webkit-font-smoothing: antialiased;
      -webkit-text-size-adjust: none;
      width: 100% !important;
      margin: 0 !important;
      height: 100%;
      color: #676767;
    }

    td {
      font-family: Helvetica, Arial, sans-serif;
      font-size: 14px;
      color: #777777;
      text-align: center;
      line-height: 21px;
    }

    a {
      color: #676767;
      text-decoration: none !important;
    }

    .pull-left {
      text-align: left;
    }

    .pull-right {
      text-align: right;
    }

    .header-lg,
    .header-md,
    .header-sm {
      font-size: 32px;
      font-weight: 700;
      line-height: normal;
      padding: 35px 0 0;
      color: #4d4d4d;
    }

    .header-md {
      font-size: 24px;
    }

    .header-sm {
      padding: 5px 0;
      font-size: 18px;
      line-height: 1.3;
    }

    .content-padding {
      padding: 20px 0 5px;
    }

    .mobile-header-padding-right {
      width: 290px;
      text-align: right;
      padding-left: 10px;
    }

    .mobile-header-padding-left {
      width: 290px;
      text-align: left;
      padding-left: 10px;
    }

    .free-text {
      width: 100% !important;
      padding: 10px 60px 0px;
    }

    .button {
      padding: 30px 0;
    }


    .mini-block {
      border: 1px solid #e5e5e5;
      border-radius: 5px;
      background-color: #ffffff;
      padding: 12px 15px 15px;
      text-align: left;
      width: 253px;
    }

    .mini-container-left {
      width: 278px;
      padding: 10px 0 10px 15px;
    }

    .mini-container-right {
      width: 278px;
      padding: 10px 14px 10px 15px;
    }

    .product {
      text-align: left;
      vertical-align: top;
      width: 175px;
    }

    .total-space {
      padding-bottom: 8px;
      display: inline-block;
    }

    .item-table {
      padding: 50px 20px;
      width: 560px;
    }

    .item {
      width: 300px;
    }

    .mobile-hide-img {
      text-align: left;
      width: 125px;
    }

    .mobile-hide-img img {
      border: 1px solid #e6e6e6;
      border-radius: 4px;
    }

    .title-dark {
      text-align: left;
      border-bottom: 1px solid #cccccc;
      color: #4d4d4d;
      font-weight: 700;
      padding-bottom: 5px;
    }

    .item-col {
      padding-top: 20px;
      text-align: left;
      vertical-align: top;
    }

    .force-width-gmail {
      min-width:600px;
      height: 0px !important;
      line-height: 1px !important;
      font-size: 1px !important;
    }

  </style>

  <style type='text/css' media='screen'>
    @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
  </style>

  <style type='text/css' media='screen'>
    @media screen {
      /* Thanks Outlook 2013! */
      * {
        font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
      }
    }
  </style>

  <style type='text/css' media='only screen and (max-width: 480px)'>
    /* Mobile styles */
    @media only screen and (max-width: 480px) {

      table[class*='container-for-gmail-android'] {
        min-width: 290px !important;
        width: 100% !important;
      }

      img[class='force-width-gmail'] {
        display: none !important;
        width: 0 !important;
        height: 0 !important;
      }

      table[class='w320'] {
        width: 320px !important;
      }


      td[class*='mobile-header-padding-left'] {
        width: 160px !important;
        padding-left: 0 !important;
      }

      td[class*='mobile-header-padding-right'] {
        width: 160px !important;
        padding-right: 0 !important;
      }

      td[class='header-lg'] {
        font-size: 24px !important;
        padding-bottom: 5px !important;
      }

      td[class='content-padding'] {
        padding: 5px 0 5px !important;
      }

       td[class='button'] {
        padding: 5px 5px 30px !important;
      }

      td[class*='free-text'] {
        padding: 10px 18px 30px !important;
      }

      td[class~='mobile-hide-img'] {
        display: none !important;
        height: 0 !important;
        width: 0 !important;
        line-height: 0 !important;
      }

      td[class~='item'] {
        width: 140px !important;
        vertical-align: top !important;
      }

      td[class~='quantity'] {
        width: 50px !important;
      }

      td[class~='price'] {
        width: 90px !important;
      }

      td[class='item-table'] {
        padding: 30px 20px !important;
      }

      td[class='mini-container-left'],
      td[class='mini-container-right'] {
        padding: 0 15px 15px !important;
        display: block !important;
        width: 290px !important;
      }
    }
  </style>
</head>

<body bgcolor='#f7f7f7'>
<table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%'>
  <tr>
    <td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
      <center>
      <img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
        <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
          <tr>
            <td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
            <!--[if gte mso 9]>
            <v:rect xmlns:v='urn:schemas-microsoft-com:vml' fill='true' stroke='false' style='mso-width-percent:1000;height:80px; v-text-anchor:middle;'>
              <v:fill type='tile' src='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' color='#ffffff' />
              <v:textbox inset='0,0,0,0'>
            <![endif]-->
              <center>
                <table cellpadding='0' cellspacing='0' width='600' class='w320'>
                  <tr>
                    <td class='pull-left mobile-header-padding-left' style='vertical-align: middle;'>
                      <a href=''><img width='200' height='100' src='http://sheolsistema.ddns.net/sheol2/intranet/images/logo3.png' alt='logo'></a>
                    </td>
                    <td class='pull-right mobile-header-padding-right' style='color: #4d4d4d;'>
                      <a href=''><img width='44' height='47' src='http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif' alt='twitter' /></a>
                      <a href=''><img width='38' height='47' src='http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif' alt='facebook' /></a>
                    </td>
                  </tr>
                </table>
              </center>
              <!--[if gte mso 9]>
              </v:textbox>
            </v:rect>
            <![endif]-->
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td align='center' valign='top' width='100%' style='background-color: #f7f7f7;' class='content-padding'>
      <center>
        <table cellspacing='0' cellpadding='0' width='600' class='w320'>
          <tr>
            <td class='header-lg'>
              Informe rebaja STOCK
            </td>
          </tr>
          <tr>
            <td class='free-text'>
              Estimado, Sistema Real reporta rebaja de stock del producto ".utf8_decode($producto).", el detalle se describe ".utf8_decode('continuación').".
            </td>
          </tr>
          <tr>
            <td class='button'>
              <div><!--[if mso]>
                <v:roundrect xmlns:v='urn:schemas-microsoft-com:vml' xmlns:w='urn:schemas-microsoft-com:office:word' href='http://' style='height:45px;v-text-anchor:middle;width:155px;' arcsize='15%' strokecolor='#ffffff' fillcolor='#ff6f6f'>
                  <w:anchorlock/>
                  <center style='color:#ffffff;font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;'>Track Order</center>
                </v:roundrect>
              <![endif]--><a href='http://'
              style='background-color:#ff6f6f;border-radius:5px;color:#ffffff;display:inline-block;font-family:'Cabin', Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;line-height:45px;text-align:center;text-decoration:none;width:155px;-webkit-text-size-adjust:none;mso-hide:all;'>DETALLE</a></div>
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td align='center' valign='top' width='100%' style='background-color: #ffffff;  border-top: 1px solid #e5e5e5; border-bottom: 1px solid #e5e5e5;'>
      <center>
        <table cellpadding='0' cellspacing='0' width='600' class='w320'>
            <tr>
              <td class='item-table'>
                <table cellspacing='0' cellpadding='0' width='100%'>
                  <tr>
                    <td class='title-dark' width='300'>
                       PRODUCTO
                    </td>
                    <td class='title-dark' width='163'>
                      FECHA
                    </td>
                  </tr>


                  <tr>
                    <td class='item-col item'>
                      <table cellspacing='0' cellpadding='0' width='100%'>
                        <tr>
                          <td class='product'>
                            <span style='color: #4d4d4d; font-weight:bold;'>".utf8_decode($producto)."</span> 
                          </td>
                        </tr>
                      </table>
                    </td>
                    <td class='item-col quantity'>
                    ".date("Y/m/d H:i:s")."
                    </td>
                  </tr>

                </table>
              </td>
            </tr>

        </table>
      </center>
    </td>
  </tr>
</table>
</div>
</body>
</html>";

// Cabecera que especifica que es un HMTL
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//$para = "adm.reportesheol@gmail.com";
$para = "jorgeuls19@gmail.com";

mail($para, $titulo, $mensaje, $cabeceras);

}


function enviarcorreobajaonzas($producto, $onza_antes, $onza_despues){

$mensaje = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1' />
  <title>Oxygen Confirm</title>

  <style type='text/css'>
    /* Take care of image borders and formatting, client hacks */
    img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
    a img { border: none; }
    table { border-collapse: collapse !important;}
    #outlook a { padding:0; }
    .ReadMsgBody { width: 100%; }
    .ExternalClass { width: 100%; }
    .backgroundTable { margin: 0 auto; padding: 0; width: 100% !important; }
    table td { border-collapse: collapse; }
    .ExternalClass * { line-height: 115%; }
    .container-for-gmail-android { min-width: 600px; }


    /* General styling */
    * {
      font-family: Helvetica, Arial, sans-serif;
    }

    body {
      -webkit-font-smoothing: antialiased;
      -webkit-text-size-adjust: none;
      width: 100% !important;
      margin: 0 !important;
      height: 100%;
      color: #676767;
    }

    td {
      font-family: Helvetica, Arial, sans-serif;
      font-size: 14px;
      color: #777777;
      text-align: center;
      line-height: 21px;
    }

    a {
      color: #676767;
      text-decoration: none !important;
    }

    .pull-left {
      text-align: left;
    }

    .pull-right {
      text-align: right;
    }

    .header-lg,
    .header-md,
    .header-sm {
      font-size: 32px;
      font-weight: 700;
      line-height: normal;
      padding: 35px 0 0;
      color: #4d4d4d;
    }

    .header-md {
      font-size: 24px;
    }

    .header-sm {
      padding: 5px 0;
      font-size: 18px;
      line-height: 1.3;
    }

    .content-padding {
      padding: 20px 0 5px;
    }

    .mobile-header-padding-right {
      width: 290px;
      text-align: right;
      padding-left: 10px;
    }

    .mobile-header-padding-left {
      width: 290px;
      text-align: left;
      padding-left: 10px;
    }

    .free-text {
      width: 100% !important;
      padding: 10px 60px 0px;
    }

    .button {
      padding: 30px 0;
    }


    .mini-block {
      border: 1px solid #e5e5e5;
      border-radius: 5px;
      background-color: #ffffff;
      padding: 12px 15px 15px;
      text-align: left;
      width: 253px;
    }

    .mini-container-left {
      width: 278px;
      padding: 10px 0 10px 15px;
    }

    .mini-container-right {
      width: 278px;
      padding: 10px 14px 10px 15px;
    }

    .product {
      text-align: left;
      vertical-align: top;
      width: 175px;
    }

    .total-space {
      padding-bottom: 8px;
      display: inline-block;
    }

    .item-table {
      padding: 50px 20px;
      width: 560px;
    }

    .item {
      width: 300px;
    }

    .mobile-hide-img {
      text-align: left;
      width: 125px;
    }

    .mobile-hide-img img {
      border: 1px solid #e6e6e6;
      border-radius: 4px;
    }

    .title-dark {
      text-align: left;
      border-bottom: 1px solid #cccccc;
      color: #4d4d4d;
      font-weight: 700;
      padding-bottom: 5px;
    }

    .item-col {
      padding-top: 20px;
      text-align: left;
      vertical-align: top;
    }

    .force-width-gmail {
      min-width:600px;
      height: 0px !important;
      line-height: 1px !important;
      font-size: 1px !important;
    }

  </style>

  <style type='text/css' media='screen'>
    @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
  </style>

  <style type='text/css' media='screen'>
    @media screen {
      /* Thanks Outlook 2013! */
      * {
        font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
      }
    }
  </style>

  <style type='text/css' media='only screen and (max-width: 480px)'>
    /* Mobile styles */
    @media only screen and (max-width: 480px) {

      table[class*='container-for-gmail-android'] {
        min-width: 290px !important;
        width: 100% !important;
      }

      img[class='force-width-gmail'] {
        display: none !important;
        width: 0 !important;
        height: 0 !important;
      }

      table[class='w320'] {
        width: 320px !important;
      }


      td[class*='mobile-header-padding-left'] {
        width: 160px !important;
        padding-left: 0 !important;
      }

      td[class*='mobile-header-padding-right'] {
        width: 160px !important;
        padding-right: 0 !important;
      }

      td[class='header-lg'] {
        font-size: 24px !important;
        padding-bottom: 5px !important;
      }

      td[class='content-padding'] {
        padding: 5px 0 5px !important;
      }

       td[class='button'] {
        padding: 5px 5px 30px !important;
      }

      td[class*='free-text'] {
        padding: 10px 18px 30px !important;
      }

      td[class~='mobile-hide-img'] {
        display: none !important;
        height: 0 !important;
        width: 0 !important;
        line-height: 0 !important;
      }

      td[class~='item'] {
        width: 140px !important;
        vertical-align: top !important;
      }

      td[class~='quantity'] {
        width: 50px !important;
      }

      td[class~='price'] {
        width: 90px !important;
      }

      td[class='item-table'] {
        padding: 30px 20px !important;
      }

      td[class='mini-container-left'],
      td[class='mini-container-right'] {
        padding: 0 15px 15px !important;
        display: block !important;
        width: 290px !important;
      }
    }
  </style>
</head>

<body bgcolor='#f7f7f7'>
<table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%'>
  <tr>
    <td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
      <center>
      <img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
        <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
          <tr>
            <td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
            <!--[if gte mso 9]>
            <v:rect xmlns:v='urn:schemas-microsoft-com:vml' fill='true' stroke='false' style='mso-width-percent:1000;height:80px; v-text-anchor:middle;'>
              <v:fill type='tile' src='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' color='#ffffff' />
              <v:textbox inset='0,0,0,0'>
            <![endif]-->
              <center>
                <table cellpadding='0' cellspacing='0' width='600' class='w320'>
                  <tr>
                    <td class='pull-left mobile-header-padding-left' style='vertical-align: middle;'>
                      <a href=''><img width='200' height='100' src='http://sheolsistema.ddns.net/sheol2/intranet/images/logo3.png' alt='logo'></a>
                    </td>
                    <td class='pull-right mobile-header-padding-right' style='color: #4d4d4d;'>
                      <a href=''><img width='44' height='47' src='http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif' alt='twitter' /></a>
                      <a href=''><img width='38' height='47' src='http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif' alt='facebook' /></a>
                    </td>
                  </tr>
                </table>
              </center>
              <!--[if gte mso 9]>
              </v:textbox>
            </v:rect>
            <![endif]-->
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td align='center' valign='top' width='100%' style='background-color: #f7f7f7;' class='content-padding'>
      <center>
        <table cellspacing='0' cellpadding='0' width='600' class='w320'>
          <tr>
            <td class='header-lg'>
              Reporte de Rebaja
            </td>
          </tr>
          <tr>
            <td class='free-text'>
              Estimado Sistema Real reporta rebaja desde el mantenedor del producto ".utf8_decode($producto).", el detalle se describe a ".utf8_decode('continuación').".
            </td>
          </tr>
          <tr>
            <td class='button'>
              <div><!--[if mso]>
                <v:roundrect xmlns:v='urn:schemas-microsoft-com:vml' xmlns:w='urn:schemas-microsoft-com:office:word' href='http://' style='height:45px;v-text-anchor:middle;width:155px;' arcsize='15%' strokecolor='#ffffff' fillcolor='#ff6f6f'>
                  <w:anchorlock/>
                  <center style='color:#ffffff;font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;'>Track Order</center>
                </v:roundrect>
              <![endif]--><a href='http://'
              style='background-color:#ff6f6f;border-radius:5px;color:#ffffff;display:inline-block;font-family:'Cabin', Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;line-height:45px;text-align:center;text-decoration:none;width:155px;-webkit-text-size-adjust:none;mso-hide:all;'>DETALLE</a></div>
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td align='center' valign='top' width='100%' style='background-color: #ffffff;  border-top: 1px solid #e5e5e5; border-bottom: 1px solid #e5e5e5;'>
      <center>
        <table cellpadding='0' cellspacing='0' width='600' class='w320'>
            <tr>
              <td class='item-table'>
                <table cellspacing='0' cellpadding='0' width='100%'>
                  <tr>
                    <td class='title-dark' width='300'>
                       PRODUCTO
                    </td>
                    <td class='title-dark' width='163'>
                      STOCK ANTES
                    </td>
                    <td class='title-dark' width='97'>
                      STOCK ACTUAL
                    </td>
                  </tr>


                  <tr>
                    <td class='item-col item'>
                      <table cellspacing='0' cellpadding='0' width='100%'>
                        <tr>
                          <td class='product'>
                            <span style='color: #4d4d4d; font-weight:bold;'>".utf8_decode($producto)."</span> 
                          </td>
                        </tr>
                      </table>
                    </td>
                    <td class='item-col quantity'>
                    ".date("Y/m/d H:i:s")."
                    </td>
                    <td class='item-col'>
                      ".$onza_antes."
                    </td>
                    <td class='item-col'>
                      ".$onza_despues."
                    </td>
                  </tr>

                </table>
              </td>
            </tr>

        </table>
      </center>
    </td>
  </tr>
</table>
</div>
</body>
</html>";

// Cabecera que especifica que es un HMTL
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//$para = "adm.reportesheol@gmail.com";
$para = "jorgeuls19@gmail.com";
//$para = $correo;

mail($para, $titulo, $mensaje, $cabeceras);

}








function correo_vencimiento($nfact, $proveedor, $fecha_venc, $url, $total){

$rutalogo = "../PHPMailer/imagenes/logo.png";
$titulo    = "Sistema web";
$mensaje   = "
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta charset='utf-8'>
  <title>Café Real</title>

  <style type='text/css'>
  /* Take care of image borders and formatting */

  img {
    max-width: 600px;
    outline: none;
    text-decoration: none;
    -ms-interpolation-mode: bicubic;
  }

  a {
    border: 0;
    outline: none;
  }

  a img {
    border: none;
  }

  /* General styling */

  td, h1, h2, h3  {
    font-family: Helvetica, Arial, sans-serif;
    font-weight: 400;
  }

  td {
    font-size: 13px;
    line-height: 150%;
    text-align: left;
  }

  body {
    -webkit-font-smoothing:antialiased;
    -webkit-text-size-adjust:none;
    width: 100%;
    height: 100%;
    color: #37302d;
    background: #ffffff;
  }

  table {
    border-collapse: collapse !important;
  }


  h1, h2, h3 {
    padding: 0;
    margin: 0;
    color: #444444;
    font-weight: 400;
    line-height: 110%;
  }

  h1 {
    font-size: 35px;
  }

  h2 {
    font-size: 30px;
  }

  h3 {
    font-size: 24px;
  }

  h4 {
    font-size: 18px;
    font-weight: normal;
  }

  .important-font {
    color: #21BEB4;
    font-weight: bold;
  }

  .hide {
    display: none !important;
  }

  .force-full-width {
    width: 100% !important;
  }

  td.desktop-hide {
    font-size: 0;
    height: 0;
    display: none;
    color: #ffffff;
  }


  </style>

  <style type='text/css' media='screen'>
      @media screen {
        @import url(http://fonts.googleapis.com/css?family=Open+Sans:400);

        /* Thanks Outlook 2013! */
        td, h1, h2, h3 {
          font-family: 'Open Sans', 'Helvetica Neue', Arial, sans-serif !important;
        }
      }
  </style>

  <style type='text/css' media='only screen and (max-width: 600px)'>
    /* Mobile styles */
    @media only screen and (max-width: 600px) {

      table[class='w320'] {
        width: 320px !important;
      }

      table[class='w300'] {
        width: 300px !important;
      }

      table[class='w290'] {
        width: 290px !important;
      }

      td[class='w320'] {
        width: 320px !important;
      }

      td[class~='mobile-padding'] {
        padding-left: 14px !important;
        padding-right: 14px !important;
      }

      td[class*='mobile-padding-left'] {
        padding-left: 14px !important;
      }

      td[class*='mobile-padding-right'] {
        padding-right: 14px !important;
      }

      td[class*='mobile-block'] {
        display: block !important;
        width: 100% !important;
        text-align: left !important;
        padding-left: 0 !important;
        padding-right: 0 !important;
        padding-bottom: 15px !important;
      }

      td[class*='mobile-no-padding-bottom'] {
        padding-bottom: 0 !important;
      }

      td[class~='mobile-center'] {
        text-align: center !important;
      }

      table[class*='mobile-center-block'] {
        float: none !important;
        margin: 0 auto !important;
      }

      *[class*='mobile-hide'] {
        display: none !important;
        width: 0 !important;
        height: 0 !important;
        line-height: 0 !important;
        font-size: 0 !important;
      }

      td[class*='mobile-border'] {
        border: 0 !important;
      }

      td[class*='desktop-hide'] {
        display: block !important;
        font-size: 13px !important;
        height: 61px !important;
        padding-top: 10px !important;
        padding-bottom: 10px !important;
        color: #444444 !important;
      }
    }
  </style>
</head>
<body class='body' style='padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none' bgcolor='#ffffff'>
<table align='center' cellpadding='0' cellspacing='0' width='100%' height='100%'>
  <tr>
    <td align='center' valign='top' bgcolor='#ffffff'  width='100%'>

    <table cellspacing='0' cellpadding='0' width='100%'>
      <tr>
        <td style='background:#1f1f1f' width='100%'>
          <center>
            <table cellspacing='0' cellpadding='0' width='600' class='w320'>
              <tr>
                <td valign='top' class='mobile-block mobile-no-padding-bottom mobile-center' width='270' style='background:#1f1f1f;padding:10px 10px 10px 20px;'>
                  <a href='#' style='text-decoration:none;'>
                    <img src='http://sheolsistema.ddns.net/sheol2/intranet/images/logo3.png' width='142' height='142' alt='Cafe-Real'/>
                  </a>
                </td>
                <td valign='top' class='mobile-block mobile-center' width='270' style='background:#1f1f1f;padding:10px 15px 10px 10px'>

                </td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
      <tr>
        <td style='border-bottom:1px solid #e7e7e7;'>
          <center>
            <table cellpadding='0' cellspacing='0' width='600' class='w320'>
              <tr>
                <td align='left' class='mobile-padding' style='padding:20px'>

                  <br class='mobile-hide' />

                  <div>
                    <h1><b>Estimado: </b></h1><br>
                    <h3><strong> Sistema real reporta pronto vencimiento del pago de la factura N° ".$nfact."</strong></h3> ";

$mensaje .= "       <br>";


$mensaje .= "  A ".utf8_decode('continuación')." se describe el detalle: .<br>
                    <strong> Fecha vencimiento: ".$fecha_venc." </strong><br>
                    <strong> N° Factura: ".$nfact." </strong><br>
                    <strong> Proveedor: ".utf8_decode($proveedor)." </strong><br>
                    <strong> Total: ".$total." </strong><br>
                    <strong> Imagen Asociada: ".$url." </strong><br>
                    <br>
                  </div>

                  <br>

                  <br>

                  <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff'>
                    <tr>
                      <td style='width:100px;background:#D84A38;'>
                        <div>
                          <!--[if mso]>
                          <v:rect xmlns:v='urn:schemas-microsoft-com:vml' xmlns:w='urn:schemas-microsoft-com:office:word' href='#' style='height:33px;v-text-anchor:middle;width:100px;' stroke='f' fillcolor='#D84A38'>
                            <w:anchorlock/>
                            <center>
                          <![endif]-->

                          <!--[if mso]>
                            </center>
                          </v:rect>
                          <![endif]-->
                        </div>
                      </td>
                      <td width='281' style='background-color:#ffffff; font-size:0; line-height:0;'>&nbsp;</td>
                    </tr>
                  </table>
                </td>
                <td class='mobile-hide' style='padding-top:20px;padding-bottom:0; vertical-align:bottom;' valign='bottom'>
                  <table cellspacing='0' cellpadding='0' width='100%'>
                    <tr>
                      <td align='right' valign='bottom' style='padding-bottom:0; vertical-align:bottom;'>
                        <img  style='vertical-align:bottom;' src='https://www.filepicker.io/api/file/9f3sP1z8SeW1sMiDA48o'  width='174' height='294' />
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
      <tr>
        <td valign='top' style='background-color:#f8f8f8;border-bottom:1px solid #e7e7e7;'>

          <center>

                  <table cellspacing='0' cellpadding='0' width='100%'>
                    <tr>
                      <td style='padding-top:35px;'>
                        <table cellpadding='0' cellspacing='0' width='100%'>
                          <tr>
                            <td width='350' class='mobile-hide' style='vertical-align:top;'>
                              <h4> Saludos Coordiales. Sistema Web Real<h4>
                            </td>
                          </tr>
                          <tr>
                            <td style='vertical-align:top;' class='desktop-hide'>

                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </center>
        </td>
      </tr>

    </table>

    </td>
  </tr>
</table>
</body>
</html>
";

// Cabecera que especifica que es un HMTL
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//$para = "adm.reportesheol@gmail.com";
$para = "jorgeuls19@gmail.com";

mail($para, $titulo, $mensaje, $cabeceras);

}


function enviarcorreo_oc($oc, $nombre){
$sqlfact = "select * from ordenes_compras where id=".$oc."";
$resfact = mysql_query($sqlfact);
$datfact = mysql_fetch_array($resfact);

$sqlprov = "select * from proveedores where id=".$datfact['proveedor_id']."";
$resprov = mysql_query($sqlprov);
$datprov = mysql_fetch_array($resprov);
$rutalogo = "../PHPMailer/imagenes/logo.png";
$titulo    = "Sistema web";

$mensaje = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1' />
  <title>Oxygen Confirm</title>

  <style type='text/css'>
    /* Take care of image borders and formatting, client hacks */
    img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
    a img { border: none; }
    table { border-collapse: collapse !important;}
    #outlook a { padding:0; }
    .ReadMsgBody { width: 100%; }
    .ExternalClass { width: 100%; }
    .backgroundTable { margin: 0 auto; padding: 0; width: 100% !important; }
    table td { border-collapse: collapse; }
    .ExternalClass * { line-height: 115%; }
    .container-for-gmail-android { min-width: 600px; }


    /* General styling */
    * {
      font-family: Helvetica, Arial, sans-serif;
    }

    body {
      -webkit-font-smoothing: antialiased;
      -webkit-text-size-adjust: none;
      width: 100% !important;
      margin: 0 !important;
      height: 100%;
      color: #676767;
    }

    td {
      font-family: Helvetica, Arial, sans-serif;
      font-size: 14px;
      color: #777777;
      text-align: center;
      line-height: 21px;
    }

    a {
      color: #676767;
      text-decoration: none !important;
    }

    .pull-left {
      text-align: left;
    }

    .pull-right {
      text-align: right;
    }

    .header-lg,
    .header-md,
    .header-sm {
      font-size: 32px;
      font-weight: 700;
      line-height: normal;
      padding: 35px 0 0;
      color: #4d4d4d;
    }

    .header-md {
      font-size: 24px;
    }

    .header-sm {
      padding: 5px 0;
      font-size: 18px;
      line-height: 1.3;
    }

    .content-padding {
      padding: 20px 0 5px;
    }

    .mobile-header-padding-right {
      width: 290px;
      text-align: right;
      padding-left: 10px;
    }

    .mobile-header-padding-left {
      width: 290px;
      text-align: left;
      padding-left: 10px;
    }

    .free-text {
      width: 100% !important;
      padding: 10px 60px 0px;
    }

    .button {
      padding: 30px 0;
    }


    .mini-block {
      border: 1px solid #e5e5e5;
      border-radius: 5px;
      background-color: #ffffff;
      padding: 12px 15px 15px;
      text-align: left;
      width: 253px;
    }

    .mini-container-left {
      width: 278px;
      padding: 10px 0 10px 15px;
    }

    .mini-container-right {
      width: 278px;
      padding: 10px 14px 10px 15px;
    }

    .product {
      text-align: left;
      vertical-align: top;
      width: 175px;
    }

    .total-space {
      padding-bottom: 8px;
      display: inline-block;
    }

    .item-table {
      padding: 50px 20px;
      width: 560px;
    }

    .item {
      width: 300px;
    }

    .mobile-hide-img {
      text-align: left;
      width: 125px;
    }

    .mobile-hide-img img {
      border: 1px solid #e6e6e6;
      border-radius: 4px;
    }

    .title-dark {
      text-align: left;
      border-bottom: 1px solid #cccccc;
      color: #4d4d4d;
      font-weight: 700;
      padding-bottom: 5px;
    }

    .item-col {
      padding-top: 20px;
      text-align: left;
      vertical-align: top;
    }

    .force-width-gmail {
      min-width:600px;
      height: 0px !important;
      line-height: 1px !important;
      font-size: 1px !important;
    }

  </style>

  <style type='text/css' media='screen'>
    @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
  </style>

  <style type='text/css' media='screen'>
    @media screen {
      /* Thanks Outlook 2013! */
      * {
        font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
      }
    }
  </style>

  <style type='text/css' media='only screen and (max-width: 480px)'>
    /* Mobile styles */
    @media only screen and (max-width: 480px) {

      table[class*='container-for-gmail-android'] {
        min-width: 290px !important;
        width: 100% !important;
      }

      img[class='force-width-gmail'] {
        display: none !important;
        width: 0 !important;
        height: 0 !important;
      }

      table[class='w320'] {
        width: 320px !important;
      }


      td[class*='mobile-header-padding-left'] {
        width: 160px !important;
        padding-left: 0 !important;
      }

      td[class*='mobile-header-padding-right'] {
        width: 160px !important;
        padding-right: 0 !important;
      }

      td[class='header-lg'] {
        font-size: 24px !important;
        padding-bottom: 5px !important;
      }

      td[class='content-padding'] {
        padding: 5px 0 5px !important;
      }

       td[class='button'] {
        padding: 5px 5px 30px !important;
      }

      td[class*='free-text'] {
        padding: 10px 18px 30px !important;
      }

      td[class~='mobile-hide-img'] {
        display: none !important;
        height: 0 !important;
        width: 0 !important;
        line-height: 0 !important;
      }

      td[class~='item'] {
        width: 140px !important;
        vertical-align: top !important;
      }

      td[class~='quantity'] {
        width: 50px !important;
      }

      td[class~='price'] {
        width: 90px !important;
      }

      td[class='item-table'] {
        padding: 30px 20px !important;
      }

      td[class='mini-container-left'],
      td[class='mini-container-right'] {
        padding: 0 15px 15px !important;
        display: block !important;
        width: 290px !important;
      }
    }
  </style>
</head>

<body bgcolor='#f7f7f7'>
<table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%'>
  <tr>
    <td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
      <center>
      <img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
        <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
          <tr>
            <td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
            <!--[if gte mso 9]>
            <v:rect xmlns:v='urn:schemas-microsoft-com:vml' fill='true' stroke='false' style='mso-width-percent:1000;height:80px; v-text-anchor:middle;'>
              <v:fill type='tile' src='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' color='#ffffff' />
              <v:textbox inset='0,0,0,0'>
            <![endif]-->
              <center>
                <table cellpadding='0' cellspacing='0' width='600' class='w320'>
                  <tr>
                    <td class='pull-left mobile-header-padding-left' style='vertical-align: middle;'>
                      <a href=''><img width='200' height='100' src='http://sheolsistema.ddns.net/sheol2/intranet/images/logo3.png' alt='logo'></a>
                    </td>
                    <td class='pull-right mobile-header-padding-right' style='color: #4d4d4d;'>
                      <a href=''><img width='44' height='47' src='http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif' alt='twitter' /></a>
                      <a href=''><img width='38' height='47' src='http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif' alt='facebook' /></a>
                    </td>
                  </tr>
                </table>
              </center>
              <!--[if gte mso 9]>
              </v:textbox>
            </v:rect>
            <![endif]-->
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td align='center' valign='top' width='100%' style='background-color: #f7f7f7;' class='content-padding'>
      <center>
        <table cellspacing='0' cellpadding='0' width='600' class='w320'>
          <tr>
            <td class='header-lg'>
              Orden de Compra 
            </td>
          </tr>
          <tr>
            <td class='free-text'>
              Estimado ".utf8_decode(".$nombre.")." el ".utf8_decode('día')." ".date("d/m/Y")." se ".utf8_decode('creó')." una Orden de Compra desde el Sistema Real, el detalle se describe ".utf8_decode('continuación').".
            </td>
          </tr>
          <tr>
            <td class='button'>
              <div><!--[if mso]>
                <v:roundrect xmlns:v='urn:schemas-microsoft-com:vml' xmlns:w='urn:schemas-microsoft-com:office:word' href='http://' style='height:45px;v-text-anchor:middle;width:155px;' arcsize='15%' strokecolor='#ffffff' fillcolor='#ff6f6f'>
                  <w:anchorlock/>
                  <center style='color:#ffffff;font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;'>Track Order</center>
                </v:roundrect>
              <![endif]--><a href='http://'
              style='background-color:#ff6f6f;border-radius:5px;color:#ffffff;display:inline-block;font-family:'Cabin', Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;line-height:45px;text-align:center;text-decoration:none;width:155px;-webkit-text-size-adjust:none;mso-hide:all;'>DETALLE</a></div>
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td align='center' valign='top' width='100%' style='background-color: #ffffff;  border-top: 1px solid #e5e5e5; border-bottom: 1px solid #e5e5e5;'>
      <center>
        <table cellpadding='0' cellspacing='0' width='600' class='w320'>
            <tr>
              <td class='item-table'>
                <table cellspacing='0' cellpadding='0' width='100%'>
                  <tr>
                    <td class='title-dark' width='300'>
                       ".utf8_decode('Descripción')."
                    </td>
                    <td class='title-dark' width='163'>
                      CANT
                    </td>
                  </tr>";

              $sqlprod = "select * from ordenes_compras_detalles where orden_compra_id = ".$datfact['id']."";
              $resprod = mysql_query($sqlprod);
              while($filaprod = mysql_fetch_array($resprod)){
                  $sqlnombre = "select PRODUCTO_NOMBRE from producto where PRODUCTO_ID='".$filaprod['producto_id']."'";
                    $resnombre = mysql_query($sqlnombre);
                    $datnombre = mysql_fetch_array($resnombre);

$mensaje  .="     <tr>
                    <td class='item-col item'>
                      <table cellspacing='0' cellpadding='0' width='100%'>
                        <tr>
                          <td class='product'>
                            <span style='color: #4d4d4d; font-weight:bold;'>".utf8_decode($datnombre['PRODUCTO_NOMBRE'])."</span> 
                          </td>
                        </tr>
                      </table>
                    </td>
                    <td class='item-col quantity'>
                    ".$filaprod['cantidad']."
                    </td>
                  </tr>";
                }

$mensaje  .=" </table>
              </td>
            </tr>

        </table>
      </center>
    </td>
  </tr>
</table>
</div>
</body>
</html>";

// Cabecera que especifica que es un HMTL
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$correo_prov = $datprov['correo'];
$para = "jorgeuls19@gmail.com";
//$para = "adm.reportesheol@gmail.com, $correo_prov";
//$para = $datprov['Contacto'];
//$para = "admsistemareal@gmail.com, ".$correo.", pgboric@gmail.com";

mail($para, $titulo, $mensaje, $cabeceras);

}





function enviarcorreonotificacioncanje($socio_id, $monto, $venta_id, $mesa, $nombre){

$titulo = "PUNTOS REALES";

$mensaje = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1' />
  <title>Oxygen Confirm</title>

  <style type='text/css'>
    /* Take care of image borders and formatting, client hacks */
    img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
    a img { border: none; }
    table { border-collapse: collapse !important;}
    #outlook a { padding:0; }
    .ReadMsgBody { width: 100%; }
    .ExternalClass { width: 100%; }
    .backgroundTable { margin: 0 auto; padding: 0; width: 100% !important; }
    table td { border-collapse: collapse; }
    .ExternalClass * { line-height: 115%; }
    .container-for-gmail-android { min-width: 600px; }


    /* General styling */
    * {
      font-family: Helvetica, Arial, sans-serif;
    }

    body {
      -webkit-font-smoothing: antialiased;
      -webkit-text-size-adjust: none;
      width: 100% !important;
      margin: 0 !important;
      height: 100%;
      color: #676767;
    }

    td {
      font-family: Helvetica, Arial, sans-serif;
      font-size: 14px;
      color: #777777;
      text-align: center;
      line-height: 21px;
    }

    a {
      color: #676767;
      text-decoration: none !important;
    }

    .pull-left {
      text-align: left;
    }

    .pull-right {
      text-align: right;
    }

    .header-lg,
    .header-md,
    .header-sm {
      font-size: 32px;
      font-weight: 700;
      line-height: normal;
      padding: 35px 0 0;
      color: #4d4d4d;
    }

    .header-md {
      font-size: 24px;
    }

    .header-sm {
      padding: 5px 0;
      font-size: 18px;
      line-height: 1.3;
    }

    .content-padding {
      padding: 20px 0 5px;
    }

    .mobile-header-padding-right {
      width: 290px;
      text-align: right;
      padding-left: 10px;
    }

    .mobile-header-padding-left {
      width: 290px;
      text-align: left;
      padding-left: 10px;
    }

    .free-text {
      width: 100% !important;
      padding: 10px 60px 0px;
    }

    .button {
      padding: 30px 0;
    }


    .mini-block {
      border: 1px solid #e5e5e5;
      border-radius: 5px;
      background-color: #ffffff;
      padding: 12px 15px 15px;
      text-align: left;
      width: 253px;
    }

    .mini-container-left {
      width: 278px;
      padding: 10px 0 10px 15px;
    }

    .mini-container-right {
      width: 278px;
      padding: 10px 14px 10px 15px;
    }

    .product {
      text-align: left;
      vertical-align: top;
      width: 175px;
    }

    .total-space {
      padding-bottom: 8px;
      display: inline-block;
    }

    .item-table {
      padding: 50px 20px;
      width: 560px;
    }

    .item {
      width: 300px;
    }

    .mobile-hide-img {
      text-align: left;
      width: 125px;
    }

    .mobile-hide-img img {
      border: 1px solid #e6e6e6;
      border-radius: 4px;
    }

    .title-dark {
      text-align: left;
      border-bottom: 1px solid #cccccc;
      color: #4d4d4d;
      font-weight: 700;
      padding-bottom: 5px;
    }

    .item-col {
      padding-top: 20px;
      text-align: left;
      vertical-align: top;
    }

    .force-width-gmail {
      min-width:600px;
      height: 0px !important;
      line-height: 1px !important;
      font-size: 1px !important;
    }

  </style>

  <style type='text/css' media='screen'>
    @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
  </style>

  <style type='text/css' media='screen'>
    @media screen {
      /* Thanks Outlook 2013! */
      * {
        font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
      }
    }
  </style>

  <style type='text/css' media='only screen and (max-width: 480px)'>
    /* Mobile styles */
    @media only screen and (max-width: 480px) {

      table[class*='container-for-gmail-android'] {
        min-width: 290px !important;
        width: 100% !important;
      }

      img[class='force-width-gmail'] {
        display: none !important;
        width: 0 !important;
        height: 0 !important;
      }

      table[class='w320'] {
        width: 320px !important;
      }


      td[class*='mobile-header-padding-left'] {
        width: 160px !important;
        padding-left: 0 !important;
      }

      td[class*='mobile-header-padding-right'] {
        width: 160px !important;
        padding-right: 0 !important;
      }

      td[class='header-lg'] {
        font-size: 24px !important;
        padding-bottom: 5px !important;
      }

      td[class='content-padding'] {
        padding: 5px 0 5px !important;
      }

       td[class='button'] {
        padding: 5px 5px 30px !important;
      }

      td[class*='free-text'] {
        padding: 10px 18px 30px !important;
      }

      td[class~='mobile-hide-img'] {
        display: none !important;
        height: 0 !important;
        width: 0 !important;
        line-height: 0 !important;
      }

      td[class~='item'] {
        width: 140px !important;
        vertical-align: top !important;
      }

      td[class~='quantity'] {
        width: 50px !important;
      }

      td[class~='price'] {
        width: 90px !important;
      }

      td[class='item-table'] {
        padding: 30px 20px !important;
      }

      td[class='mini-container-left'],
      td[class='mini-container-right'] {
        padding: 0 15px 15px !important;
        display: block !important;
        width: 290px !important;
      }
    }
  </style>
</head>

<body bgcolor='#f7f7f7'>
<table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%'>
  <tr>
    <td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
      <center>
      <img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
        <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
          <tr>
            <td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
            <!--[if gte mso 9]>
            <v:rect xmlns:v='urn:schemas-microsoft-com:vml' fill='true' stroke='false' style='mso-width-percent:1000;height:80px; v-text-anchor:middle;'>
              <v:fill type='tile' src='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' color='#ffffff' />
              <v:textbox inset='0,0,0,0'>
            <![endif]-->
              <center>
                <table cellpadding='0' cellspacing='0' width='600' class='w320'>
                  <tr>
                    <td class='pull-left mobile-header-padding-left' style='vertical-align: middle;'>
                      <a href=''><img width='200' height='100' src='http://sheolsistema.ddns.net/sheol2/intranet/images/logo3.png' alt='logo'></a>
                    </td>
                    <td class='pull-right mobile-header-padding-right' style='color: #4d4d4d;'>
                      <a href=''><img width='44' height='47' src='http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif' alt='twitter' /></a>
                      <a href=''><img width='38' height='47' src='http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif' alt='facebook' /></a>
                    </td>
                  </tr>
                </table>
              </center>
              <!--[if gte mso 9]>
              </v:textbox>
            </v:rect>
            <![endif]-->
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td align='center' valign='top' width='100%' style='background-color: #f7f7f7;' class='content-padding'>
      <center>
        <table cellspacing='0' cellpadding='0' width='600' class='w320'>
          <tr>
            <td class='header-lg'>
              Uso de Puntos Reales
            </td>
          </tr>
          <tr>
            <td class='free-text'>
              Estimado ".utf8_decode(".$nombre.")." el ".utf8_decode('día')." ".date("d/m/Y")." se ocuparon sus Puntos Reales, el detalle se describe ".utf8_decode('continuación').".
            </td>
          </tr>
          <tr>
            <td class='button'>
              <div><!--[if mso]>
                <v:roundrect xmlns:v='urn:schemas-microsoft-com:vml' xmlns:w='urn:schemas-microsoft-com:office:word' href='http://' style='height:45px;v-text-anchor:middle;width:155px;' arcsize='15%' strokecolor='#ffffff' fillcolor='#ff6f6f'>
                  <w:anchorlock/>
                  <center style='color:#ffffff;font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;'>Track Order</center>
                </v:roundrect>
              <![endif]--><a href='http://'
              style='background-color:#ff6f6f;border-radius:5px;color:#ffffff;display:inline-block;font-family:'Cabin', Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;line-height:45px;text-align:center;text-decoration:none;width:155px;-webkit-text-size-adjust:none;mso-hide:all;'>DETALLE</a></div>
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td align='center' valign='top' width='100%' style='background-color: #ffffff;  border-top: 1px solid #e5e5e5; border-bottom: 1px solid #e5e5e5;'>
      <center>
        <table cellpadding='0' cellspacing='0' width='600' class='w320'>
            <tr>
              <td class='item-table'>
                <table cellspacing='0' cellpadding='0' width='100%'>
                  <tr>
                    <td class='title-dark' width='300'>
                       MOVIMIENTO
                    </td>
                    <td class='title-dark' width='163'>
                      MONTO
                    </td>
                    <td class='title-dark' width='97'>
                      MESA
                    </td>
                  </tr>


                  <tr>
                    <td class='item-col item'>
                      <table cellspacing='0' cellpadding='0' width='100%'>
                        <tr>
                          <td class='product'>
                            <span style='color: #4d4d4d; font-weight:bold;'>".$venta_id."</span> 
                          </td>
                        </tr>
                      </table>
                    </td>
                    <td class='item-col quantity'>
                    ".number_format($monto, 0, ',', '.')."
                    </td>
                    <td class='item-col'>
                      ".$mesa."
                    </td>
                  </tr>

                </table>
              </td>
            </tr>

        </table>
      </center>
    </td>
  </tr>
</table>
</div>
</body>
</html>";

// Cabecera que especifica que es un HMTL
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$para = "jorgeuls19@gmail.com";
//$para = "jorgeuls19@gmail.com, caferealovalle@gmail.com";
//$para = "adm.reportesheol@gmail.com";
//$para = $datprov['Contacto'];
//$para = "admsistemareal@gmail.com, ".$correo.", pgboric@gmail.com";

mail($para, $titulo, $mensaje, $cabeceras);

}




function notifica_cambio_stock_unitario($producto, $stockactual, $stockaumenta){
$stocknuevo = $stockactual + $stockaumenta;
$rutalogo = "../PHPMailer/imagenes/logo.png";
$titulo    = "Sistema web";
$mensaje = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1' />
  <title>Oxygen Confirm</title>

  <style type='text/css'>
    /* Take care of image borders and formatting, client hacks */
    img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
    a img { border: none; }
    table { border-collapse: collapse !important;}
    #outlook a { padding:0; }
    .ReadMsgBody { width: 100%; }
    .ExternalClass { width: 100%; }
    .backgroundTable { margin: 0 auto; padding: 0; width: 100% !important; }
    table td { border-collapse: collapse; }
    .ExternalClass * { line-height: 115%; }
    .container-for-gmail-android { min-width: 600px; }


    /* General styling */
    * {
      font-family: Helvetica, Arial, sans-serif;
    }

    body {
      -webkit-font-smoothing: antialiased;
      -webkit-text-size-adjust: none;
      width: 100% !important;
      margin: 0 !important;
      height: 100%;
      color: #676767;
    }

    td {
      font-family: Helvetica, Arial, sans-serif;
      font-size: 14px;
      color: #777777;
      text-align: center;
      line-height: 21px;
    }

    a {
      color: #676767;
      text-decoration: none !important;
    }

    .pull-left {
      text-align: left;
    }

    .pull-right {
      text-align: right;
    }

    .header-lg,
    .header-md,
    .header-sm {
      font-size: 32px;
      font-weight: 700;
      line-height: normal;
      padding: 35px 0 0;
      color: #4d4d4d;
    }

    .header-md {
      font-size: 24px;
    }

    .header-sm {
      padding: 5px 0;
      font-size: 18px;
      line-height: 1.3;
    }

    .content-padding {
      padding: 20px 0 5px;
    }

    .mobile-header-padding-right {
      width: 290px;
      text-align: right;
      padding-left: 10px;
    }

    .mobile-header-padding-left {
      width: 290px;
      text-align: left;
      padding-left: 10px;
    }

    .free-text {
      width: 100% !important;
      padding: 10px 60px 0px;
    }

    .button {
      padding: 30px 0;
    }


    .mini-block {
      border: 1px solid #e5e5e5;
      border-radius: 5px;
      background-color: #ffffff;
      padding: 12px 15px 15px;
      text-align: left;
      width: 253px;
    }

    .mini-container-left {
      width: 278px;
      padding: 10px 0 10px 15px;
    }

    .mini-container-right {
      width: 278px;
      padding: 10px 14px 10px 15px;
    }

    .product {
      text-align: left;
      vertical-align: top;
      width: 175px;
    }

    .total-space {
      padding-bottom: 8px;
      display: inline-block;
    }

    .item-table {
      padding: 50px 20px;
      width: 560px;
    }

    .item {
      width: 300px;
    }

    .mobile-hide-img {
      text-align: left;
      width: 125px;
    }

    .mobile-hide-img img {
      border: 1px solid #e6e6e6;
      border-radius: 4px;
    }

    .title-dark {
      text-align: left;
      border-bottom: 1px solid #cccccc;
      color: #4d4d4d;
      font-weight: 700;
      padding-bottom: 5px;
    }

    .item-col {
      padding-top: 20px;
      text-align: left;
      vertical-align: top;
    }

    .force-width-gmail {
      min-width:600px;
      height: 0px !important;
      line-height: 1px !important;
      font-size: 1px !important;
    }

  </style>

  <style type='text/css' media='screen'>
    @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
  </style>

  <style type='text/css' media='screen'>
    @media screen {
      /* Thanks Outlook 2013! */
      * {
        font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
      }
    }
  </style>

  <style type='text/css' media='only screen and (max-width: 480px)'>
    /* Mobile styles */
    @media only screen and (max-width: 480px) {

      table[class*='container-for-gmail-android'] {
        min-width: 290px !important;
        width: 100% !important;
      }

      img[class='force-width-gmail'] {
        display: none !important;
        width: 0 !important;
        height: 0 !important;
      }

      table[class='w320'] {
        width: 320px !important;
      }


      td[class*='mobile-header-padding-left'] {
        width: 160px !important;
        padding-left: 0 !important;
      }

      td[class*='mobile-header-padding-right'] {
        width: 160px !important;
        padding-right: 0 !important;
      }

      td[class='header-lg'] {
        font-size: 24px !important;
        padding-bottom: 5px !important;
      }

      td[class='content-padding'] {
        padding: 5px 0 5px !important;
      }

       td[class='button'] {
        padding: 5px 5px 30px !important;
      }

      td[class*='free-text'] {
        padding: 10px 18px 30px !important;
      }

      td[class~='mobile-hide-img'] {
        display: none !important;
        height: 0 !important;
        width: 0 !important;
        line-height: 0 !important;
      }

      td[class~='item'] {
        width: 140px !important;
        vertical-align: top !important;
      }

      td[class~='quantity'] {
        width: 50px !important;
      }

      td[class~='price'] {
        width: 90px !important;
      }

      td[class='item-table'] {
        padding: 30px 20px !important;
      }

      td[class='mini-container-left'],
      td[class='mini-container-right'] {
        padding: 0 15px 15px !important;
        display: block !important;
        width: 290px !important;
      }
    }
  </style>
</head>

<body bgcolor='#f7f7f7'>
<table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%'>
  <tr>
    <td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
      <center>
      <img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
        <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
          <tr>
            <td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
            <!--[if gte mso 9]>
            <v:rect xmlns:v='urn:schemas-microsoft-com:vml' fill='true' stroke='false' style='mso-width-percent:1000;height:80px; v-text-anchor:middle;'>
              <v:fill type='tile' src='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' color='#ffffff' />
              <v:textbox inset='0,0,0,0'>
            <![endif]-->
              <center>
                <table cellpadding='0' cellspacing='0' width='600' class='w320'>
                  <tr>
                    <td class='pull-left mobile-header-padding-left' style='vertical-align: middle;'>
                      <a href=''><img width='200' height='100' src='http://sheolsistema.ddns.net/sheol2/intranet/images/logo3.png' alt='logo'></a>
                    </td>
                    <td class='pull-right mobile-header-padding-right' style='color: #4d4d4d;'>
                      <a href=''><img width='44' height='47' src='http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif' alt='twitter' /></a>
                      <a href=''><img width='38' height='47' src='http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif' alt='facebook' /></a>
                    </td>
                  </tr>
                </table>
              </center>
              <!--[if gte mso 9]>
              </v:textbox>
            </v:rect>
            <![endif]-->
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td align='center' valign='top' width='100%' style='background-color: #f7f7f7;' class='content-padding'>
      <center>
        <table cellspacing='0' cellpadding='0' width='600' class='w320'>
          <tr>
            <td class='header-lg'>
              Reporte Cambio de Stock
            </td>
          </tr>
          <tr>
            <td class='free-text'>
              Estimado, Sistema Real reporta ".utf8_decode('modificación')." en stock del producto ".utf8_decode($producto)." en CAFE REAL el detalle se describe ".utf8_decode('continuación').".
            </td>
          </tr>
          <tr>
            <td class='button'>
              <div><!--[if mso]>
                <v:roundrect xmlns:v='urn:schemas-microsoft-com:vml' xmlns:w='urn:schemas-microsoft-com:office:word' href='http://' style='height:45px;v-text-anchor:middle;width:155px;' arcsize='15%' strokecolor='#ffffff' fillcolor='#ff6f6f'>
                  <w:anchorlock/>
                  <center style='color:#ffffff;font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;'>Track Order</center>
                </v:roundrect>
              <![endif]--><a href='http://'
              style='background-color:#ff6f6f;border-radius:5px;color:#ffffff;display:inline-block;font-family:'Cabin', Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;line-height:45px;text-align:center;text-decoration:none;width:155px;-webkit-text-size-adjust:none;mso-hide:all;'>DETALLE</a></div>
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td align='center' valign='top' width='100%' style='background-color: #ffffff;  border-top: 1px solid #e5e5e5; border-bottom: 1px solid #e5e5e5;'>
      <center>
        <table cellpadding='0' cellspacing='0' width='600' class='w320'>
            <tr>
              <td class='item-table'>
                <table cellspacing='0' cellpadding='0' width='100%'>
                  <tr>
                    <td class='title-dark' width='300'>
                       PRODUCTO
                    </td>
                    <td class='title-dark' width='163'>
                      FECHA
                    </td>
                    <td class='title-dark' width='97'>
                      STOCK ANTES
                    </td>
                    <td class='title-dark' width='97'>
                      STOCK DESP
                    </td>
                    <td class='title-dark' width='97'>
                      STOCK 
                    </td>
                  </tr>


                  <tr>
                    <td class='item-col item'>
                      <table cellspacing='0' cellpadding='0' width='100%'>
                        <tr>
                          <td class='product'>
                            <span style='color: #4d4d4d; font-weight:bold;'>".utf8_decode($producto)."</span> 
                          </td>
                        </tr>
                      </table>
                    </td>
                    <td class='item-col quantity'>
                    ".date("d/m/Y H:i:s")."
                    </td>
                    <td class='item-col'>
                      ".$stockactual."
                    </td>
                    <td class='item-col'>
                      ".$stockaumenta."
                    </td>
                    <td class='item-col'>
                      ".$stocknuevo."
                    </td>
                  </tr>

                </table>
              </td>
            </tr>

        </table>
      </center>
    </td>
  </tr>
</table>
</div>
</body>
</html>";

// Cabecera que especifica que es un HMTL
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//$para = "adm.reportesheol@gmail.com";
$para = "jorgeuls19@gmail.com";
//$para = $correo;

mail($para, $titulo, $mensaje, $cabeceras);

}




function notifica_cambio_stock_unitario2($producto, $stockactual, $stockaumenta, $usuario){
$stocknuevo = $stockactual + $stockaumenta;
$rutalogo = "../PHPMailer/imagenes/logo.png";
$titulo    = "Sistema web";
$mensaje = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1' />
  <title>Oxygen Confirm</title>

  <style type='text/css'>
    /* Take care of image borders and formatting, client hacks */
    img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
    a img { border: none; }
    table { border-collapse: collapse !important;}
    #outlook a { padding:0; }
    .ReadMsgBody { width: 100%; }
    .ExternalClass { width: 100%; }
    .backgroundTable { margin: 0 auto; padding: 0; width: 100% !important; }
    table td { border-collapse: collapse; }
    .ExternalClass * { line-height: 115%; }
    .container-for-gmail-android { min-width: 600px; }


    /* General styling */
    * {
      font-family: Helvetica, Arial, sans-serif;
    }

    body {
      -webkit-font-smoothing: antialiased;
      -webkit-text-size-adjust: none;
      width: 100% !important;
      margin: 0 !important;
      height: 100%;
      color: #676767;
    }

    td {
      font-family: Helvetica, Arial, sans-serif;
      font-size: 14px;
      color: #777777;
      text-align: center;
      line-height: 21px;
    }

    a {
      color: #676767;
      text-decoration: none !important;
    }

    .pull-left {
      text-align: left;
    }

    .pull-right {
      text-align: right;
    }

    .header-lg,
    .header-md,
    .header-sm {
      font-size: 32px;
      font-weight: 700;
      line-height: normal;
      padding: 35px 0 0;
      color: #4d4d4d;
    }

    .header-md {
      font-size: 24px;
    }

    .header-sm {
      padding: 5px 0;
      font-size: 18px;
      line-height: 1.3;
    }

    .content-padding {
      padding: 20px 0 5px;
    }

    .mobile-header-padding-right {
      width: 290px;
      text-align: right;
      padding-left: 10px;
    }

    .mobile-header-padding-left {
      width: 290px;
      text-align: left;
      padding-left: 10px;
    }

    .free-text {
      width: 100% !important;
      padding: 10px 60px 0px;
    }

    .button {
      padding: 30px 0;
    }


    .mini-block {
      border: 1px solid #e5e5e5;
      border-radius: 5px;
      background-color: #ffffff;
      padding: 12px 15px 15px;
      text-align: left;
      width: 253px;
    }

    .mini-container-left {
      width: 278px;
      padding: 10px 0 10px 15px;
    }

    .mini-container-right {
      width: 278px;
      padding: 10px 14px 10px 15px;
    }

    .product {
      text-align: left;
      vertical-align: top;
      width: 175px;
    }

    .total-space {
      padding-bottom: 8px;
      display: inline-block;
    }

    .item-table {
      padding: 50px 20px;
      width: 560px;
    }

    .item {
      width: 300px;
    }

    .mobile-hide-img {
      text-align: left;
      width: 125px;
    }

    .mobile-hide-img img {
      border: 1px solid #e6e6e6;
      border-radius: 4px;
    }

    .title-dark {
      text-align: left;
      border-bottom: 1px solid #cccccc;
      color: #4d4d4d;
      font-weight: 700;
      padding-bottom: 5px;
    }

    .item-col {
      padding-top: 20px;
      text-align: left;
      vertical-align: top;
    }

    .force-width-gmail {
      min-width:600px;
      height: 0px !important;
      line-height: 1px !important;
      font-size: 1px !important;
    }

  </style>

  <style type='text/css' media='screen'>
    @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
  </style>

  <style type='text/css' media='screen'>
    @media screen {
      /* Thanks Outlook 2013! */
      * {
        font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
      }
    }
  </style>

  <style type='text/css' media='only screen and (max-width: 480px)'>
    /* Mobile styles */
    @media only screen and (max-width: 480px) {

      table[class*='container-for-gmail-android'] {
        min-width: 290px !important;
        width: 100% !important;
      }

      img[class='force-width-gmail'] {
        display: none !important;
        width: 0 !important;
        height: 0 !important;
      }

      table[class='w320'] {
        width: 320px !important;
      }


      td[class*='mobile-header-padding-left'] {
        width: 160px !important;
        padding-left: 0 !important;
      }

      td[class*='mobile-header-padding-right'] {
        width: 160px !important;
        padding-right: 0 !important;
      }

      td[class='header-lg'] {
        font-size: 24px !important;
        padding-bottom: 5px !important;
      }

      td[class='content-padding'] {
        padding: 5px 0 5px !important;
      }

       td[class='button'] {
        padding: 5px 5px 30px !important;
      }

      td[class*='free-text'] {
        padding: 10px 18px 30px !important;
      }

      td[class~='mobile-hide-img'] {
        display: none !important;
        height: 0 !important;
        width: 0 !important;
        line-height: 0 !important;
      }

      td[class~='item'] {
        width: 140px !important;
        vertical-align: top !important;
      }

      td[class~='quantity'] {
        width: 50px !important;
      }

      td[class~='price'] {
        width: 90px !important;
      }

      td[class='item-table'] {
        padding: 30px 20px !important;
      }

      td[class='mini-container-left'],
      td[class='mini-container-right'] {
        padding: 0 15px 15px !important;
        display: block !important;
        width: 290px !important;
      }
    }
  </style>
</head>

<body bgcolor='#f7f7f7'>
<table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%'>
  <tr>
    <td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
      <center>
      <img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
        <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
          <tr>
            <td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
            <!--[if gte mso 9]>
            <v:rect xmlns:v='urn:schemas-microsoft-com:vml' fill='true' stroke='false' style='mso-width-percent:1000;height:80px; v-text-anchor:middle;'>
              <v:fill type='tile' src='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' color='#ffffff' />
              <v:textbox inset='0,0,0,0'>
            <![endif]-->
              <center>
                <table cellpadding='0' cellspacing='0' width='600' class='w320'>
                  <tr>
                    <td class='pull-left mobile-header-padding-left' style='vertical-align: middle;'>
                      <a href=''><img width='200' height='100' src='http://sheolsistema.ddns.net/sheol2/intranet/images/logo3.png' alt='logo'></a>
                    </td>
                    <td class='pull-right mobile-header-padding-right' style='color: #4d4d4d;'>
                      <a href=''><img width='44' height='47' src='http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif' alt='twitter' /></a>
                      <a href=''><img width='38' height='47' src='http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif' alt='facebook' /></a>
                    </td>
                  </tr>
                </table>
              </center>
              <!--[if gte mso 9]>
              </v:textbox>
            </v:rect>
            <![endif]-->
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td align='center' valign='top' width='100%' style='background-color: #f7f7f7;' class='content-padding'>
      <center>
        <table cellspacing='0' cellpadding='0' width='600' class='w320'>
          <tr>
            <td class='header-lg'>
              Reporte Cambio de Stock
            </td>
          </tr>
          <tr>
            <td class='free-text'>
              Estimado, Sistema Real reporta ".utf8_decode('modificación')." en stock del producto ".utf8_decode($producto)." en CAFE REAL el detalle se describe ".utf8_decode('continuación').".
            </td>
          </tr>
          <tr>
            <td class='button'>
              <div><!--[if mso]>
                <v:roundrect xmlns:v='urn:schemas-microsoft-com:vml' xmlns:w='urn:schemas-microsoft-com:office:word' href='http://' style='height:45px;v-text-anchor:middle;width:155px;' arcsize='15%' strokecolor='#ffffff' fillcolor='#ff6f6f'>
                  <w:anchorlock/>
                  <center style='color:#ffffff;font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;'>Track Order</center>
                </v:roundrect>
              <![endif]--><a href='http://'
              style='background-color:#ff6f6f;border-radius:5px;color:#ffffff;display:inline-block;font-family:'Cabin', Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;line-height:45px;text-align:center;text-decoration:none;width:155px;-webkit-text-size-adjust:none;mso-hide:all;'>DETALLE</a></div>
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td align='center' valign='top' width='100%' style='background-color: #ffffff;  border-top: 1px solid #e5e5e5; border-bottom: 1px solid #e5e5e5;'>
      <center>
        <table cellpadding='0' cellspacing='0' width='600' class='w320'>
            <tr>
              <td class='item-table'>
                <table cellspacing='0' cellpadding='0' width='100%'>
                  <tr>
                    <td class='title-dark' width='300'>
                       PRODUCTO
                    </td>
                    <td class='title-dark' width='163'>
                      FECHA
                    </td>
                    <td class='title-dark' width='97'>
                      STOCK ANTES
                    </td>
                    <td class='title-dark' width='97'>
                      STOCK DESP
                    </td>
                    <td class='title-dark' width='97'>
                      STOCK 
                    </td>
                    <td class='title-dark' width='97'>
                      USUARIO 
                    </td>
                  </tr>


                  <tr>
                    <td class='item-col item'>
                      <table cellspacing='0' cellpadding='0' width='100%'>
                        <tr>
                          <td class='product'>
                            <span style='color: #4d4d4d; font-weight:bold;'>".utf8_decode($producto)."</span> 
                          </td>
                        </tr>
                      </table>
                    </td>
                    <td class='item-col quantity'>
                    ".date("d/m/Y H:i:s")."
                    </td>
                    <td class='item-col'>
                      ".$stockactual."
                    </td>
                    <td class='item-col'>
                      ".$stockaumenta."
                    </td>
                    <td class='item-col'>
                      ".$stocknuevo."
                    </td>
                    <td class='item-col'>
                      ".$usuario."
                    </td>
                  </tr>

                </table>
              </td>
            </tr>

        </table>
      </center>
    </td>
  </tr>
</table>
</div>
</body>
</html>";

// Cabecera que especifica que es un HMTL
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//$para = "jorgeuls19@gmail.com, admsistemareal@gmail.com, pgboric@gmail.com";
//$para = "adm.reportesheol@gmail.com";
$para = "jorgeuls19@gmail.com";
//$para = $correo;

mail($para, $titulo, $mensaje, $cabeceras);

// $mensaje_push = "Informamos cambio en stock del producto ".utf8_decode($producto)." con fecha  ".date("d/m/Y H:i:s").", ACTUAL: ".$stockactual.", AUMENTO: ".$stockaumenta.", NUEVO: ".$stocknuevo." \ln";
// enviar_push('Cambio Stock', $mensaje_push);

}


function notifica_cambio_stock_onzas($producto, $stockactual, $stockaumenta, $stockOnzas){
$stocknuevo = $stockOnzas + $stockaumenta;
$rutalogo = "../PHPMailer/imagenes/logo.png";
$titulo    = "Sistema web";

$mensaje = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1' />
  <title>Oxygen Confirm</title>

  <style type='text/css'>
    /* Take care of image borders and formatting, client hacks */
    img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
    a img { border: none; }
    table { border-collapse: collapse !important;}
    #outlook a { padding:0; }
    .ReadMsgBody { width: 100%; }
    .ExternalClass { width: 100%; }
    .backgroundTable { margin: 0 auto; padding: 0; width: 100% !important; }
    table td { border-collapse: collapse; }
    .ExternalClass * { line-height: 115%; }
    .container-for-gmail-android { min-width: 600px; }


    /* General styling */
    * {
      font-family: Helvetica, Arial, sans-serif;
    }

    body {
      -webkit-font-smoothing: antialiased;
      -webkit-text-size-adjust: none;
      width: 100% !important;
      margin: 0 !important;
      height: 100%;
      color: #676767;
    }

    td {
      font-family: Helvetica, Arial, sans-serif;
      font-size: 14px;
      color: #777777;
      text-align: center;
      line-height: 21px;
    }

    a {
      color: #676767;
      text-decoration: none !important;
    }

    .pull-left {
      text-align: left;
    }

    .pull-right {
      text-align: right;
    }

    .header-lg,
    .header-md,
    .header-sm {
      font-size: 32px;
      font-weight: 700;
      line-height: normal;
      padding: 35px 0 0;
      color: #4d4d4d;
    }

    .header-md {
      font-size: 24px;
    }

    .header-sm {
      padding: 5px 0;
      font-size: 18px;
      line-height: 1.3;
    }

    .content-padding {
      padding: 20px 0 5px;
    }

    .mobile-header-padding-right {
      width: 290px;
      text-align: right;
      padding-left: 10px;
    }

    .mobile-header-padding-left {
      width: 290px;
      text-align: left;
      padding-left: 10px;
    }

    .free-text {
      width: 100% !important;
      padding: 10px 60px 0px;
    }

    .button {
      padding: 30px 0;
    }


    .mini-block {
      border: 1px solid #e5e5e5;
      border-radius: 5px;
      background-color: #ffffff;
      padding: 12px 15px 15px;
      text-align: left;
      width: 253px;
    }

    .mini-container-left {
      width: 278px;
      padding: 10px 0 10px 15px;
    }

    .mini-container-right {
      width: 278px;
      padding: 10px 14px 10px 15px;
    }

    .product {
      text-align: left;
      vertical-align: top;
      width: 175px;
    }

    .total-space {
      padding-bottom: 8px;
      display: inline-block;
    }

    .item-table {
      padding: 50px 20px;
      width: 560px;
    }

    .item {
      width: 300px;
    }

    .mobile-hide-img {
      text-align: left;
      width: 125px;
    }

    .mobile-hide-img img {
      border: 1px solid #e6e6e6;
      border-radius: 4px;
    }

    .title-dark {
      text-align: left;
      border-bottom: 1px solid #cccccc;
      color: #4d4d4d;
      font-weight: 700;
      padding-bottom: 5px;
    }

    .item-col {
      padding-top: 20px;
      text-align: left;
      vertical-align: top;
    }

    .force-width-gmail {
      min-width:600px;
      height: 0px !important;
      line-height: 1px !important;
      font-size: 1px !important;
    }

  </style>

  <style type='text/css' media='screen'>
    @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
  </style>

  <style type='text/css' media='screen'>
    @media screen {
      /* Thanks Outlook 2013! */
      * {
        font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
      }
    }
  </style>

  <style type='text/css' media='only screen and (max-width: 480px)'>
    /* Mobile styles */
    @media only screen and (max-width: 480px) {

      table[class*='container-for-gmail-android'] {
        min-width: 290px !important;
        width: 100% !important;
      }

      img[class='force-width-gmail'] {
        display: none !important;
        width: 0 !important;
        height: 0 !important;
      }

      table[class='w320'] {
        width: 320px !important;
      }


      td[class*='mobile-header-padding-left'] {
        width: 160px !important;
        padding-left: 0 !important;
      }

      td[class*='mobile-header-padding-right'] {
        width: 160px !important;
        padding-right: 0 !important;
      }

      td[class='header-lg'] {
        font-size: 24px !important;
        padding-bottom: 5px !important;
      }

      td[class='content-padding'] {
        padding: 5px 0 5px !important;
      }

       td[class='button'] {
        padding: 5px 5px 30px !important;
      }

      td[class*='free-text'] {
        padding: 10px 18px 30px !important;
      }

      td[class~='mobile-hide-img'] {
        display: none !important;
        height: 0 !important;
        width: 0 !important;
        line-height: 0 !important;
      }

      td[class~='item'] {
        width: 140px !important;
        vertical-align: top !important;
      }

      td[class~='quantity'] {
        width: 50px !important;
      }

      td[class~='price'] {
        width: 90px !important;
      }

      td[class='item-table'] {
        padding: 30px 20px !important;
      }

      td[class='mini-container-left'],
      td[class='mini-container-right'] {
        padding: 0 15px 15px !important;
        display: block !important;
        width: 290px !important;
      }
    }
  </style>
</head>

<body bgcolor='#f7f7f7'>
<table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%'>
  <tr>
    <td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
      <center>
      <img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
        <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
          <tr>
            <td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
            <!--[if gte mso 9]>
            <v:rect xmlns:v='urn:schemas-microsoft-com:vml' fill='true' stroke='false' style='mso-width-percent:1000;height:80px; v-text-anchor:middle;'>
              <v:fill type='tile' src='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' color='#ffffff' />
              <v:textbox inset='0,0,0,0'>
            <![endif]-->
              <center>
                <table cellpadding='0' cellspacing='0' width='600' class='w320'>
                  <tr>
                    <td class='pull-left mobile-header-padding-left' style='vertical-align: middle;'>
                      <a href=''><img width='200' height='100' src='http://sheolsistema.ddns.net/sheol2/intranet/images/logo3.png' alt='logo'></a>
                    </td>
                    <td class='pull-right mobile-header-padding-right' style='color: #4d4d4d;'>
                      <a href=''><img width='44' height='47' src='http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif' alt='twitter' /></a>
                      <a href=''><img width='38' height='47' src='http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif' alt='facebook' /></a>
                    </td>
                  </tr>
                </table>
              </center>
              <!--[if gte mso 9]>
              </v:textbox>
            </v:rect>
            <![endif]-->
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td align='center' valign='top' width='100%' style='background-color: #f7f7f7;' class='content-padding'>
      <center>
        <table cellspacing='0' cellpadding='0' width='600' class='w320'>
          <tr>
            <td class='header-lg'>
              Reporte ".utf8_decode(".$modificación.")." de Stock
            </td>
          </tr>
          <tr>
            <td class='free-text'>
              Estimado Sistema Real reporta ".utf8_decode('modificación')." en stock del producto ".utf8_decode($producto)." en CAFE REAL, el detalle se describe a ".utf8_decode('continuación').".
            </td>
          </tr>
          <tr>
            <td class='button'>
              <div><!--[if mso]>
                <v:roundrect xmlns:v='urn:schemas-microsoft-com:vml' xmlns:w='urn:schemas-microsoft-com:office:word' href='http://' style='height:45px;v-text-anchor:middle;width:155px;' arcsize='15%' strokecolor='#ffffff' fillcolor='#ff6f6f'>
                  <w:anchorlock/>
                  <center style='color:#ffffff;font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;'>Track Order</center>
                </v:roundrect>
              <![endif]--><a href='http://'
              style='background-color:#ff6f6f;border-radius:5px;color:#ffffff;display:inline-block;font-family:'Cabin', Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;line-height:45px;text-align:center;text-decoration:none;width:155px;-webkit-text-size-adjust:none;mso-hide:all;'>DETALLE</a></div>
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td align='center' valign='top' width='100%' style='background-color: #ffffff;  border-top: 1px solid #e5e5e5; border-bottom: 1px solid #e5e5e5;'>
      <center>
        <table cellpadding='0' cellspacing='0' width='600' class='w320'>
            <tr>
              <td class='item-table'>
                <table cellspacing='0' cellpadding='0' width='100%'>
                  <tr>
                    <td class='title-dark' width='300'>
                       PRODUCTO
                    </td>
                    <td class='title-dark' width='163'>
                      FECHA
                    </td>
                    <td class='title-dark' width='97'>
                      STOCK ANT
                    </td>
                    <td class='title-dark' width='97'>
                      STOCK DESP
                    </td>
                    <td class='title-dark' width='97'>
                      STOCK
                    </td>
                  </tr>


                  <tr>
                    <td class='item-col item'>
                      <table cellspacing='0' cellpadding='0' width='100%'>
                        <tr>
                          <td class='product'>
                            <span style='color: #4d4d4d; font-weight:bold;'>".utf8_decode($producto)."</span> 
                          </td>
                        </tr>
                      </table>
                    </td>
                    <td class='item-col quantity'>
                    ".date("d/m/Y H:i:s")."
                    </td>
                    <td class='item-col'>
                      ".$stockOnzas."
                    </td>
                    <td class='item-col'>
                      ".$stockaumenta."
                    </td>
                    <td class='item-col'>
                      ".$stocknuevo."
                    </td>
                  </tr>

                </table>
              </td>
            </tr>

        </table>
      </center>
    </td>
  </tr>
</table>
</div>
</body>
</html>";

// Cabecera que especifica que es un HMTL
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//$para = "adm.reportesheol@gmail.com";
$para = "jorgeuls19@gmail.com";
//$para = $correo;

mail($para, $titulo, $mensaje, $cabeceras);

}



function notifica_cambio_stock_onzas2($producto, $stockactual, $stockaumenta, $stockOnzas, $usuario){
$stocknuevo = $stockOnzas + $stockaumenta;
$rutalogo = "../PHPMailer/imagenes/logo.png";
$titulo    = "Sistema web";

$mensaje = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1' />
  <title>Oxygen Confirm</title>

  <style type='text/css'>
    /* Take care of image borders and formatting, client hacks */
    img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
    a img { border: none; }
    table { border-collapse: collapse !important;}
    #outlook a { padding:0; }
    .ReadMsgBody { width: 100%; }
    .ExternalClass { width: 100%; }
    .backgroundTable { margin: 0 auto; padding: 0; width: 100% !important; }
    table td { border-collapse: collapse; }
    .ExternalClass * { line-height: 115%; }
    .container-for-gmail-android { min-width: 600px; }


    /* General styling */
    * {
      font-family: Helvetica, Arial, sans-serif;
    }

    body {
      -webkit-font-smoothing: antialiased;
      -webkit-text-size-adjust: none;
      width: 100% !important;
      margin: 0 !important;
      height: 100%;
      color: #676767;
    }

    td {
      font-family: Helvetica, Arial, sans-serif;
      font-size: 14px;
      color: #777777;
      text-align: center;
      line-height: 21px;
    }

    a {
      color: #676767;
      text-decoration: none !important;
    }

    .pull-left {
      text-align: left;
    }

    .pull-right {
      text-align: right;
    }

    .header-lg,
    .header-md,
    .header-sm {
      font-size: 32px;
      font-weight: 700;
      line-height: normal;
      padding: 35px 0 0;
      color: #4d4d4d;
    }

    .header-md {
      font-size: 24px;
    }

    .header-sm {
      padding: 5px 0;
      font-size: 18px;
      line-height: 1.3;
    }

    .content-padding {
      padding: 20px 0 5px;
    }

    .mobile-header-padding-right {
      width: 290px;
      text-align: right;
      padding-left: 10px;
    }

    .mobile-header-padding-left {
      width: 290px;
      text-align: left;
      padding-left: 10px;
    }

    .free-text {
      width: 100% !important;
      padding: 10px 60px 0px;
    }

    .button {
      padding: 30px 0;
    }


    .mini-block {
      border: 1px solid #e5e5e5;
      border-radius: 5px;
      background-color: #ffffff;
      padding: 12px 15px 15px;
      text-align: left;
      width: 253px;
    }

    .mini-container-left {
      width: 278px;
      padding: 10px 0 10px 15px;
    }

    .mini-container-right {
      width: 278px;
      padding: 10px 14px 10px 15px;
    }

    .product {
      text-align: left;
      vertical-align: top;
      width: 175px;
    }

    .total-space {
      padding-bottom: 8px;
      display: inline-block;
    }

    .item-table {
      padding: 50px 20px;
      width: 560px;
    }

    .item {
      width: 300px;
    }

    .mobile-hide-img {
      text-align: left;
      width: 125px;
    }

    .mobile-hide-img img {
      border: 1px solid #e6e6e6;
      border-radius: 4px;
    }

    .title-dark {
      text-align: left;
      border-bottom: 1px solid #cccccc;
      color: #4d4d4d;
      font-weight: 700;
      padding-bottom: 5px;
    }

    .item-col {
      padding-top: 20px;
      text-align: left;
      vertical-align: top;
    }

    .force-width-gmail {
      min-width:600px;
      height: 0px !important;
      line-height: 1px !important;
      font-size: 1px !important;
    }

  </style>

  <style type='text/css' media='screen'>
    @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
  </style>

  <style type='text/css' media='screen'>
    @media screen {
      /* Thanks Outlook 2013! */
      * {
        font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
      }
    }
  </style>

  <style type='text/css' media='only screen and (max-width: 480px)'>
    /* Mobile styles */
    @media only screen and (max-width: 480px) {

      table[class*='container-for-gmail-android'] {
        min-width: 290px !important;
        width: 100% !important;
      }

      img[class='force-width-gmail'] {
        display: none !important;
        width: 0 !important;
        height: 0 !important;
      }

      table[class='w320'] {
        width: 320px !important;
      }


      td[class*='mobile-header-padding-left'] {
        width: 160px !important;
        padding-left: 0 !important;
      }

      td[class*='mobile-header-padding-right'] {
        width: 160px !important;
        padding-right: 0 !important;
      }

      td[class='header-lg'] {
        font-size: 24px !important;
        padding-bottom: 5px !important;
      }

      td[class='content-padding'] {
        padding: 5px 0 5px !important;
      }

       td[class='button'] {
        padding: 5px 5px 30px !important;
      }

      td[class*='free-text'] {
        padding: 10px 18px 30px !important;
      }

      td[class~='mobile-hide-img'] {
        display: none !important;
        height: 0 !important;
        width: 0 !important;
        line-height: 0 !important;
      }

      td[class~='item'] {
        width: 140px !important;
        vertical-align: top !important;
      }

      td[class~='quantity'] {
        width: 50px !important;
      }

      td[class~='price'] {
        width: 90px !important;
      }

      td[class='item-table'] {
        padding: 30px 20px !important;
      }

      td[class='mini-container-left'],
      td[class='mini-container-right'] {
        padding: 0 15px 15px !important;
        display: block !important;
        width: 290px !important;
      }
    }
  </style>
</head>

<body bgcolor='#f7f7f7'>
<table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%'>
  <tr>
    <td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
      <center>
      <img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
        <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
          <tr>
            <td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
            <!--[if gte mso 9]>
            <v:rect xmlns:v='urn:schemas-microsoft-com:vml' fill='true' stroke='false' style='mso-width-percent:1000;height:80px; v-text-anchor:middle;'>
              <v:fill type='tile' src='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' color='#ffffff' />
              <v:textbox inset='0,0,0,0'>
            <![endif]-->
              <center>
                <table cellpadding='0' cellspacing='0' width='600' class='w320'>
                  <tr>
                    <td class='pull-left mobile-header-padding-left' style='vertical-align: middle;'>
                      <a href=''><img width='200' height='100' src='http://sheolsistema.ddns.net/sheol2/intranet/images/logo3.png' alt='logo'></a>
                    </td>
                    <td class='pull-right mobile-header-padding-right' style='color: #4d4d4d;'>
                      <a href=''><img width='44' height='47' src='http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif' alt='twitter' /></a>
                      <a href=''><img width='38' height='47' src='http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif' alt='facebook' /></a>
                    </td>
                  </tr>
                </table>
              </center>
              <!--[if gte mso 9]>
              </v:textbox>
            </v:rect>
            <![endif]-->
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td align='center' valign='top' width='100%' style='background-color: #f7f7f7;' class='content-padding'>
      <center>
        <table cellspacing='0' cellpadding='0' width='600' class='w320'>
          <tr>
            <td class='header-lg'>
              Reporte ".utf8_decode(".$modificación.")." de Stock
            </td>
          </tr>
          <tr>
            <td class='free-text'>
              Estimado Sistema Real reporta ".utf8_decode('modificación')." en stock del producto ".utf8_decode($producto)." en CAFE REAL, el detalle se describe a ".utf8_decode('continuación').".
            </td>
          </tr>
          <tr>
            <td class='button'>
              <div><!--[if mso]>
                <v:roundrect xmlns:v='urn:schemas-microsoft-com:vml' xmlns:w='urn:schemas-microsoft-com:office:word' href='http://' style='height:45px;v-text-anchor:middle;width:155px;' arcsize='15%' strokecolor='#ffffff' fillcolor='#ff6f6f'>
                  <w:anchorlock/>
                  <center style='color:#ffffff;font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;'>Track Order</center>
                </v:roundrect>
              <![endif]--><a href='http://'
              style='background-color:#ff6f6f;border-radius:5px;color:#ffffff;display:inline-block;font-family:'Cabin', Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;line-height:45px;text-align:center;text-decoration:none;width:155px;-webkit-text-size-adjust:none;mso-hide:all;'>DETALLE</a></div>
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td align='center' valign='top' width='100%' style='background-color: #ffffff;  border-top: 1px solid #e5e5e5; border-bottom: 1px solid #e5e5e5;'>
      <center>
        <table cellpadding='0' cellspacing='0' width='600' class='w320'>
            <tr>
              <td class='item-table'>
                <table cellspacing='0' cellpadding='0' width='100%'>
                  <tr>
                    <td class='title-dark' width='300'>
                       PRODUCTO
                    </td>
                    <td class='title-dark' width='163'>
                      FECHA
                    </td>
                    <td class='title-dark' width='97'>
                      STOCK ANT
                    </td>
                    <td class='title-dark' width='97'>
                      STOCK DESP
                    </td>
                    <td class='title-dark' width='97'>
                      STOCK
                    </td>
                    <td class='title-dark' width='97'>
                      USUARIO
                    </td>
                  </tr>


                  <tr>
                    <td class='item-col item'>
                      <table cellspacing='0' cellpadding='0' width='100%'>
                        <tr>
                          <td class='product'>
                            <span style='color: #4d4d4d; font-weight:bold;'>".utf8_decode($producto)."</span> 
                          </td>
                        </tr>
                      </table>
                    </td>
                    <td class='item-col quantity'>
                    ".date("d/m/Y H:i:s")."
                    </td>
                    <td class='item-col'>
                      ".$stockOnzas."
                    </td>
                    <td class='item-col'>
                      ".$stockaumenta."
                    </td>
                    <td class='item-col'>
                      ".$stocknuevo."
                    </td>
                    <td class='item-col'>
                      ".$usuario."
                    </td>
                  </tr>

                </table>
              </td>
            </tr>

        </table>
      </center>
    </td>
  </tr>
</table>
</div>
</body>
</html>";

// Cabecera que especifica que es un HMTL
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//$para = "adm.reportesheol@gmail.com";
$para = "jorgeuls19@gmail.com";
//$para = $correo;

mail($para, $titulo, $mensaje, $cabeceras);

}

function enviar_correo_vencimiento_costo($id, $nombre, $monto, $usuario_id, $tipo_costo_id){

  // $sqlusu = "select nombre, apellido from usuarios where id = ".$usuario_id."";
  // $resusu = mysql_query($sqlusu);
  // $datusu = mysql_fetch_array($resusu);

  // $sqltcos = "select nombre from tipos_costos where id = ".$tipo_costo_id."";
  // $restcos = mysql_query($sqltcos);
  // $dattcos = mysql_fetch_array($restcos);

  $titulo    = "Reporte de Vencimiento de Costo";

  $mensaje = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
    <html xmlns='http://www.w3.org/1999/xhtml'>
    <head>
      <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
      <meta name='viewport' content='width=device-width, initial-scale=1' />
      <title>Oxygen Confirm</title>

      <style type='text/css'>
        /* Take care of image borders and formatting, client hacks */
        img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
        a img { border: none; }
        table { border-collapse: collapse !important;}
        #outlook a { padding:0; }
        .ReadMsgBody { width: 100%; }
        .ExternalClass { width: 100%; }
        .backgroundTable { margin: 0 auto; padding: 0; width: 100% !important; }
        table td { border-collapse: collapse; }
        .ExternalClass * { line-height: 115%; }
        .container-for-gmail-android { min-width: 600px; }


        /* General styling */
        * {
          font-family: Helvetica, Arial, sans-serif;
        }

        body {
          -webkit-font-smoothing: antialiased;
          -webkit-text-size-adjust: none;
          width: 100% !important;
          margin: 0 !important;
          height: 100%;
          color: #676767;
        }

        td {
          font-family: Helvetica, Arial, sans-serif;
          font-size: 14px;
          color: #777777;
          text-align: center;
          line-height: 21px;
        }

        a {
          color: #676767;
          text-decoration: none !important;
        }

        .pull-left {
          text-align: left;
        }

        .pull-right {
          text-align: right;
        }

        .header-lg,
        .header-md,
        .header-sm {
          font-size: 32px;
          font-weight: 700;
          line-height: normal;
          padding: 35px 0 0;
          color: #4d4d4d;
        }

        .header-md {
          font-size: 24px;
        }

        .header-sm {
          padding: 5px 0;
          font-size: 18px;
          line-height: 1.3;
        }

        .content-padding {
          padding: 20px 0 5px;
        }

        .mobile-header-padding-right {
          width: 290px;
          text-align: right;
          padding-left: 10px;
        }

        .mobile-header-padding-left {
          width: 290px;
          text-align: left;
          padding-left: 10px;
        }

        .free-text {
          width: 100% !important;
          padding: 10px 60px 0px;
        }

        .button {
          padding: 30px 0;
        }


        .mini-block {
          border: 1px solid #e5e5e5;
          border-radius: 5px;
          background-color: #ffffff;
          padding: 12px 15px 15px;
          text-align: left;
          width: 253px;
        }

        .mini-container-left {
          width: 278px;
          padding: 10px 0 10px 15px;
        }

        .mini-container-right {
          width: 278px;
          padding: 10px 14px 10px 15px;
        }

        .product {
          text-align: left;
          vertical-align: top;
          width: 175px;
        }

        .total-space {
          padding-bottom: 8px;
          display: inline-block;
        }

        .item-table {
          padding: 50px 20px;
          width: 560px;
        }

        .item {
          width: 300px;
        }

        .mobile-hide-img {
          text-align: left;
          width: 125px;
        }

        .mobile-hide-img img {
          border: 1px solid #e6e6e6;
          border-radius: 4px;
        }

        .title-dark {
          text-align: left;
          border-bottom: 1px solid #cccccc;
          color: #4d4d4d;
          font-weight: 700;
          padding-bottom: 5px;
        }

        .item-col {
          padding-top: 20px;
          text-align: left;
          vertical-align: top;
        }

        .force-width-gmail {
          min-width:600px;
          height: 0px !important;
          line-height: 1px !important;
          font-size: 1px !important;
        }

      </style>

      <style type='text/css' media='screen'>
        @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
      </style>

      <style type='text/css' media='screen'>
        @media screen {
          /* Thanks Outlook 2013! */
          * {
            font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
          }
        }
      </style>

      <style type='text/css' media='only screen and (max-width: 480px)'>
        /* Mobile styles */
        @media only screen and (max-width: 480px) {

          table[class*='container-for-gmail-android'] {
            min-width: 290px !important;
            width: 100% !important;
          }

          img[class='force-width-gmail'] {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
          }

          table[class='w320'] {
            width: 320px !important;
          }


          td[class*='mobile-header-padding-left'] {
            width: 160px !important;
            padding-left: 0 !important;
          }

          td[class*='mobile-header-padding-right'] {
            width: 160px !important;
            padding-right: 0 !important;
          }

          td[class='header-lg'] {
            font-size: 24px !important;
            padding-bottom: 5px !important;
          }

          td[class='content-padding'] {
            padding: 5px 0 5px !important;
          }

           td[class='button'] {
            padding: 5px 5px 30px !important;
          }

          td[class*='free-text'] {
            padding: 10px 18px 30px !important;
          }

          td[class~='mobile-hide-img'] {
            display: none !important;
            height: 0 !important;
            width: 0 !important;
            line-height: 0 !important;
          }

          td[class~='item'] {
            width: 140px !important;
            vertical-align: top !important;
          }

          td[class~='quantity'] {
            width: 50px !important;
          }

          td[class~='price'] {
            width: 90px !important;
          }

          td[class='item-table'] {
            padding: 30px 20px !important;
          }

          td[class='mini-container-left'],
          td[class='mini-container-right'] {
            padding: 0 15px 15px !important;
            display: block !important;
            width: 290px !important;
          }
        }
      </style>
    </head>

    <body bgcolor='#f7f7f7'>
    <table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%'>
      <tr>
        <td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
          <center>
          <img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
            <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
              <tr>
                <td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
                <!--[if gte mso 9]>
                <v:rect xmlns:v='urn:schemas-microsoft-com:vml' fill='true' stroke='false' style='mso-width-percent:1000;height:80px; v-text-anchor:middle;'>
                  <v:fill type='tile' src='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' color='#ffffff' />
                  <v:textbox inset='0,0,0,0'>
                <![endif]-->
                  <center>
                    <table cellpadding='0' cellspacing='0' width='600' class='w320'>
                      <tr>
                        <td class='pull-left mobile-header-padding-left' style='vertical-align: middle;'>
                          <a href=''><img width='200' height='100' src='http://sheolsistema.ddns.net/sheol2/intranet/images/logo3.png' alt='logo'></a>
                        </td>
                        <td class='pull-right mobile-header-padding-right' style='color: #4d4d4d;'>
                          <a href=''><img width='44' height='47' src='http://s3.amazonaws.com/swu-filepicker/k8D8A7SLRuetZspHxsJk_social_08.gif' alt='twitter' /></a>
                          <a href=''><img width='38' height='47' src='http://s3.amazonaws.com/swu-filepicker/LMPMj7JSRoCWypAvzaN3_social_09.gif' alt='facebook' /></a>
                        </td>
                      </tr>
                    </table>
                  </center>
                  <!--[if gte mso 9]>
                  </v:textbox>
                </v:rect>
                <![endif]-->
                </td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
      <tr>
        <td align='center' valign='top' width='100%' style='background-color: #f7f7f7;' class='content-padding'>
          <center>
            <table cellspacing='0' cellpadding='0' width='600' class='w320'>
              <tr>
                <td class='header-lg'>
                  Reporte Pronto vencimiento de Costo
                </td>
              </tr>
              <tr>
                <td class='free-text'>
                  Estimado, Sistema Real reporta pronto vencimiento de uno de los costos ingresados a nuestro Sistema, el detalle se describe a ".utf8_decode('continuación').".
                </td>
              </tr>
              <tr>
                <td class='button'>
                  <div><!--[if mso]>
                    <v:roundrect xmlns:v='urn:schemas-microsoft-com:vml' xmlns:w='urn:schemas-microsoft-com:office:word' href='http://' style='height:45px;v-text-anchor:middle;width:155px;' arcsize='15%' strokecolor='#ffffff' fillcolor='#ff6f6f'>
                      <w:anchorlock/>
                      <center style='color:#ffffff;font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;'>Track Order</center>
                    </v:roundrect>
                  <![endif]--><a href='http://'
                  style='background-color:#ff6f6f;border-radius:5px;color:#ffffff;display:inline-block;font-family:'Cabin', Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;line-height:45px;text-align:center;text-decoration:none;width:155px;-webkit-text-size-adjust:none;mso-hide:all;'>DETALLE</a></div>
                </td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
      <tr>
        <td align='center' valign='top' width='100%' style='background-color: #ffffff;  border-top: 1px solid #e5e5e5; border-bottom: 1px solid #e5e5e5;'>
          <center>
            <table cellpadding='0' cellspacing='0' width='600' class='w320'>
                <tr>
                  <td class='item-table'>
                    <table cellspacing='0' cellpadding='0' width='100%'>
                      <tr>
                        <td class='title-dark' width='300'>
                           COSTO
                        </td>
                        <td class='title-dark' width='163'>
                          FECHA
                        </td>
                        <td class='title-dark' width='97'>
                          MONTO
                        </td>
                      </tr>


                      <tr>
                        <td class='item-col item'>
                          <table cellspacing='0' cellpadding='0' width='100%'>
                            <tr>
                              <td class='product'>
                                <span style='color: #4d4d4d; font-weight:bold;'>".utf8_decode($nombre)."</span> 
                              </td>
                            </tr>
                          </table>
                        </td>
                        <td class='item-col quantity'>
                        ".date("d/m/Y H:i:s")."
                        </td>
                        <td class='item-col'>
                          ".number_format($monto, 0, ',', '.')."
                        </td>
                      </tr>

                    </table>
                  </td>
                </tr>

            </table>
          </center>
        </td>
      </tr>
    </table>
    </div>
    </body>
    </html>";

    // Cabecera que especifica que es un HMTL
    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
    $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    //$para = "caferealovalle@gmail.com, admsistemareal@gmail.com, pgboric@gmail.com";
    //$para = "adm.reportesheol@gmail.com";
    $para = "jorgeuls19@gmail.com";
    //$para = $correo;

    mail($para, $titulo, $mensaje, $cabeceras);
}


?>
