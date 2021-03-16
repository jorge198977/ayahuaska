<?php
date_default_timezone_set('America/Santiago');

function generar_correo_carga_cta_cte($nombre, $rut, $mov, $monto, $fecha, $cajero){

$rutalogo = "PHPMailer/imagenes/logo.png";
$titulo    = "Sistema Real web";
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
                    <img src='http://caferealsistema.servehttp.com:81/cafereal/images/logo.png' width='142' height='142' alt='Cafe-Real'/>
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
                    <h3><b>Estimado, </b></h3><br>
                    El ".utf8_decode('día')." ";

$mensaje .= date("d/m/Y");

$mensaje .= ", se ha realizado
                    un cargo a la cuenta corriente del cliente, los detalles se muestran a ".utf8_decode('continuación').".<br>
                    <strong> Rut de cliente: ".$rut." </strong><br>
                    <strong> Nombre de cliente:  ".utf8_decode($nombre)."</strong><br>
                    <br>
                    <br>
                    Saludos Coordiales. Sistema Real
                  </div>

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
            <table border='0' cellpadding='0' cellspacing='0' width='600' class='w320' style='height:100%;'>
              <tr>
                <td valign='top' class='mobile-padding' style='padding:20px;'>
                  <table cellspacing='0' cellpadding='0' width='100%'>
                    <tr>
                      <td style='padding-right:20px'>
                        <b>Movimiento</b>
                      </td>
                      <td style='padding-right:20px'>
                        <b>Hora</b>
                      </td>
                      <td style='padding-right:20px'>
                        <b>Cajero</b>
                      </td>
                      <td>
                        <b>Monto</b>
                      </td>
                    </tr>
                    <tr>
                      <td style='padding-top:5px;padding-right:20px; border-top:1px solid #E7E7E7; '>
                        ".$mov."
                      </td>
                      <td style='padding-top:5px;padding-right:20px; border-top:1px solid #E7E7E7;'>
                        ".$fecha."
                      </td>
                      <td style='padding-top:5px; border-top:1px solid #E7E7E7;' class='mobile'>
                        ".utf8_decode($cajero)."
                      </td>
                      <td style='padding-top:5px; border-top:1px solid #E7E7E7;' class='mobile'>
                        ".number_format($monto, 0, ',', '.')."
                      </td>
                    </tr>
                  </table>
                  <table cellspacing='0' cellpadding='0' width='100%'>
                    <tr>
                      <td style='padding-top:35px;'>
                        <table cellpadding='0' cellspacing='0' width='100%'>
                          <tr>
                            <td width='350' class='mobile-hide' style='vertical-align:top;'>
                              <h4> Saludos Coordiales. Sistema Real<h4><br>
                              <p><strong> Los que deseen cancelar por internet, pueden realizarlo a la siguiente cuenta:<br>
                                Cta corriente:    <br>
                                Rut:              <br>
                                Numero cta:       <br>

                                * Enviar comprobante a @.. *<br>

                              Gracias por preferirnos una vez ".utf8_decode('más')."!!! </strong></p>
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
//$para = "jorgeuls19@gmail.com, ".$correocli.", pgboric@gmail.com";
$para = "jorgeuls19@gmail.com";

mail($para, $titulo, $mensaje, $cabeceras);


}

function enviarcorreoabonos($mov, $monto, $rut, $hora, $cajero, $nombre, $correocli){

$rutalogo = "PHPMailer/imagenes/logo.png";
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
                    <img src='http://caferealsistema.servehttp.com:81/cafereal/images/logo.png' width='142' height='142' alt='Cafe-Real'/>
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
                    <h3><b>Estimado:</b></h3><br>
                    El ".utf8_decode('día')." ";

$mensaje .= date("d/m/Y");

$mensaje .= ", se ha realizado
                   un abono a la cuenta corriente del cliente, los detalles se muestran a ".utf8_decode('continuación').".<br>
                    <strong> Rut de cliente: ".$rut." </strong><br>
                    <strong> Nombre de cliente:  ".utf8_decode($nombre)."</strong><br>
                    <br>
                    <br>
                    Saludos Coordiales. Sistema Web ".utf8_decode('Café')." Real
                  </div>

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
            <table border='0' cellpadding='0' cellspacing='0' width='600' class='w320' style='height:100%;'>
              <tr>
                <td valign='top' class='mobile-padding' style='padding:20px;'>
                  <table cellspacing='0' cellpadding='0' width='100%'>
                    <tr>
                      <td style='padding-right:20px'>
                        <b>Movimiento</b>
                      </td>
                      <td style='padding-right:20px'>
                        <b>Hora</b>
                      </td>
                      <td style='padding-right:20px'>
                        <b>Cajero</b>
                      </td>
                      <td>
                        <b>Monto</b>
                      </td>
                    </tr>
                    <tr>
                      <td style='padding-top:5px;padding-right:20px; border-top:1px solid #E7E7E7; '>
                        ".$mov."
                      </td>
                      <td style='padding-top:5px;padding-right:20px; border-top:1px solid #E7E7E7;'>
                        ".$hora."
                      </td>
                      <td style='padding-top:5px; border-top:1px solid #E7E7E7;' class='mobile'>
                        ".utf8_decode($cajero)."
                      </td>
                      <td style='padding-top:5px; border-top:1px solid #E7E7E7;' class='mobile'>
                        ".$monto."
                      </td>
                    </tr>
                  </table>
                  <table cellspacing='0' cellpadding='0' width='100%'>
                    <tr>
                      <td style='padding-top:35px;'>
                        <table cellpadding='0' cellspacing='0' width='100%'>
                          <tr>
                            <td width='350' class='mobile-hide' style='vertical-align:top;'>
                              <h4> Saludos Coordiales. Sistema Web Café Real<h4>
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
//$para = "jorgeuls19@gmail.com";
$para = "admsistemareal@gmail.com, ".$correocli.", pgboric@gmail.com";
//$para = "".$correocli."";
//$para = "caferealovalle@gmail.com,jorgeuls19@gmail.com";

mail($para, $titulo, $mensaje, $cabeceras);

}

function generar_correo_deudores($rut, $nombre, $correo, $debe){
  $rutalogo = "PHPMailer/imagenes/logo.png";
$titulo    = "Sistema Real web";
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
                    <img src='http://caferealsistema.servehttp.com:81/cafereal/images/logo.png' width='142' height='142' alt='Cafe-Real'/>
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
                    <h3><b>Estimado cliente: ".$nombre.",</b></h3><br>
                    Al ".utf8_decode('día')." ";

$mensaje .= date("d/m/Y");

$mensaje .= ", se le recuerda a usted que mantiene una deuda que se describe a ".utf8_decode('continuación').".<br>
                    <strong> Rut de cliente: ".$rut." </strong><br>
                    <strong> Nombre de cliente:  ".utf8_decode($nombre)."</strong><br>
                    <strong> Correo:  ".$correo."</strong><br>
                    <strong> Deuda Actual:  $".$debe."</strong><br>
                    <br>
                    <br>

          <br>
                              <p><strong> Los que deseen cancelar por internet, pueden realizarlo a la siguiente cuenta:<br>
                                Cta corriente:    <br>
                                Rut:              <br>
                                Numero cta:      <br>

                                * Enviar comprobante a admsistemareal@gmail.com. *<br>

                              Gracias por preferirnos una vez ".utf8_decode('más')."!!! </strong></p>

                    <br><br>
                    Saludos Coordiales, gracias por su preferencia. Sistema Web ".utf8_decode('Café')." Real
                  </div>

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
                              <h4> Saludos Coordiales. Sistema Web Café Real<h4>
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
$para = "jorgeuls19@gmail.com";
//$para = "admsistemareal@gmail.com, ".$correo.", pgboric@gmail.com";

mail($para, $titulo, $mensaje, $cabeceras);
}


public function holamundo(){
  echo "ss";
}






function enviarcorreollamado($correo, $mesa, $nombre){

$rutalogo = "PHPMailer/imagenes/logo.png";
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
                    <img src='http://caferealsistema.servehttp.com:81/cafereal/images/logo.png' width='142' height='142' alt='Cafe-Real'/>
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
                    <h1><b>Estimado usuario: ".utf8_decode($nombre).",</b></h1><br>
                    <h3><strong>La mesa ".$mesa." ha solicitado su ".utf8_decode('atención')." a las ".date("H:i:s")." </strong></h3> ";

$mensaje .= "       <br>
                    <br>
                    Saludos Coordiales. Sistema Web ".utf8_decode('Café')." Real
                  </div>

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
                              <h4> Saludos Coordiales. Sistema Web Café Real<h4>
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
//$para = "jorgeuls19@gmail.com";
$para = $correo;

mail($para, $titulo, $mensaje, $cabeceras);

}

function enviarcorreostock($producto, $stock, $stockmin){

$rutalogo = "PHPMailer/imagenes/logo.png";
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
                    <img src='http://caferealsistema.servehttp.com:81/cafereal/images/logo.png' width='142' height='142' alt='Cafe-Real'/>
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
                    <h1><b>Estimado ".utf8_decode('Sebastián')." Yagnam: </b></h1><br>
                    <h3><strong> Sistema real reporta stock ".utf8_decode('crítico')." del producto ".utf8_decode($producto)."</strong></h3> ";

$mensaje .= "       <br>";


$mensaje .= "  A ".utf8_decode('continuación')." se describe el detalle: .<br>
                    <strong> Fecha: ".date("Y/m/d H:i:s")." </strong><br>
                    <strong> Producto: ".utf8_decode($producto)." </strong><br>
                    <strong> Stock ".utf8_decode('Mínimo').":  ".$stockmin."</strong><br>
                    <strong> Stock Actual:  ".$stock."</strong><br>
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
                              <h4> Saludos Coordiales. Sistema Web ".utf8_decode('Café')." Real<h4>
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
$para = "caferealovalle@gmail.com, admsistemareal@gmail.com, pgboric@gmail.com";
//$para = $correo;

mail($para, $titulo, $mensaje, $cabeceras);

}



function enviarcorrecheque($nfact, $url){

$rutalogo = "PHPMailer/imagenes/logo.png";
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
                    <img src='http://caferealsistema.servehttp.com:81/cafereal/images/logo.png' width='142' height='142' alt='Cafe-Real'/>
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
                    <h1><b>Estimado ".utf8_decode('Sebastián')." Yagnam: </b></h1><br>
                    <h3><strong> Sistema real reporta ingreso de nuevo cheque a nuestro sistema. </strong></h3> ";

$mensaje .= "       <br>";


$mensaje .= "  A ".utf8_decode('continuación')." se da a conocer la ruta donde puede ver el cheque: .<br>
                    <strong> Fecha: ".date("Y/m/d H:i:s")." </strong><br>
                    <strong> Nro de Factura: ".$nfact." </strong><br>
                    <strong> URL:  ".$url."</strong><br>
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
                              <h4> Saludos Coordiales. Sistema Web ".utf8_decode('Café')." Real<h4>
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
$para = "admsistemareal@gmail.com, pgboric@gmail.com";
//$para = "jorgeuls19@gmail.com";
//$para = $correo;

mail($para, $titulo, $mensaje, $cabeceras);

}


function enviarcorreobajastock($producto){

$rutalogo = "PHPMailer/imagenes/logo.png";
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
                    <img src='http://caferealsistema.servehttp.com:81/cafereal/images/logo.png' width='142' height='142' alt='Cafe-Real'/>
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
                    <h1><b>Estimado ".utf8_decode('Sebastián')." Yagnam: </b></h1><br>
                    <h3><strong> Sistema real reporta rebaja de stock del producto ".utf8_decode($producto)."</strong></h3> ";

$mensaje .= "       <br>";


$mensaje .= "  A ".utf8_decode('continuación')." se describe el detalle: .<br>
                    <strong> Fecha: ".date("Y/m/d H:i:s")." </strong><br>
                    <strong> Producto: ".utf8_decode($producto)." </strong><br>
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
                              <h4> Saludos Coordiales. Sistema Web ".utf8_decode('Café')." Real<h4>
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
$para = "admsistemareal@gmail.com, pgboric@gmail.com";
//$para = $correo;

mail($para, $titulo, $mensaje, $cabeceras);

}


function enviarcorreobajaonzas($producto, $onza_antes, $onza_despues){

$rutalogo = "PHPMailer/imagenes/logo.png";
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
                    <img src='http://caferealsistema.servehttp.com:81/cafereal/images/logo.png' width='142' height='142' alt='Cafe-Real'/>
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
                    <h1><b>Estimado ".utf8_decode('Sebastián')." Yagnam: </b></h1><br>
                    <h3><strong> Sistema real reporta rebaja de onzas desde el mantenedor del producto ".utf8_decode($producto)."</strong></h3> ";

$mensaje .= "       <br>";


$mensaje .= "  A ".utf8_decode('continuación')." se describe el detalle: .<br>
                    <strong> Fecha: ".date("Y/m/d H:i:s")." </strong><br>
                    <strong> Producto: ".utf8_decode($producto)." </strong><br>
                    <strong> Onzas que ".utf8_decode('existían').": ".$onza_antes." </strong><br>
                    <strong> Onzas actuales: ".$onza_despues." </strong><br>
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
                              <h4> Saludos Coordiales. Sistema Web ".utf8_decode('Café')." Real<h4>
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
$para = "admsistemareal@gmail.com, pgboric@gmail.com";
//$para = "jorgeuls19@gmail.com";
//$para = $correo;

mail($para, $titulo, $mensaje, $cabeceras);

}








function correo_vencimiento($nfact, $proveedor, $fecha_venc, $url, $total){

$rutalogo = "PHPMailer/imagenes/logo.png";
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
                    <img src='http://caferealsistema.servehttp.com:81/cafereal/images/logo.png' width='142' height='142' alt='Cafe-Real'/>
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
                    <h1><b>Estimado ".utf8_decode('Sebastián')." Yagnam: </b></h1><br>
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
                              <h4> Saludos Coordiales. Sistema Web ".utf8_decode('Café')." Real<h4>
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
$para = "admsistemareal@gmail.com, pgboric@gmail.com";
//$para = "jorgeuls19@gmail.com";

mail($para, $titulo, $mensaje, $cabeceras);

}


function enviarcorreo_oc($oc, $nombre){
//conecta();
  mysql_connect("localhost","root","cafe2016seba");
    mysql_select_db("cafereal");
    mysql_query("SET NAMES 'utf8'");
$sqlfact = "select * from ordenes_compras where id=".$oc."";
$resfact = mysql_query($sqlfact);
$datfact = mysql_fetch_array($resfact);

$sqlprov = "select * from proveedor where CodProveedor=".$datfact['proveedor_id']."";
$resprov = mysql_query($sqlprov);
$datprov = mysql_fetch_array($resprov);
$rutalogo = "PHPMailer/imagenes/logo.png";
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
                    <img src='http://caferealsistema.servehttp.com:81/cafereal/images/logo.png' width='142' height='142' alt='Cafe-Real'/>
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
                    <h3><b>Estimado: ".utf8_decode($nombre).",</b></h3><br>
                    El ".utf8_decode('día')." ";

$mensaje .= date("d/m/Y");

$mensaje .= " se ".utf8_decode('creó')." una Orden de Compra desde el sistema ".utf8_decode('Café')." Real
              a ".utf8_decode('continuación')." se describe el detalle.<br>

<table class='table table-bordered'>
        <thead>
          <tr>
            <th>
              <h4>".utf8_decode('Descripción')."</h4>
            </th>
            <th>
              <h4>Cantidad</h4>
            </th>
          </tr>
        </thead>
        <tbody>";

              $sqlprod = "select * from ordenes_compras_detalle where ordenes_compras_id = ".$datfact['id']."";
              $resprod = mysql_query($sqlprod);
              while($filaprod = mysql_fetch_array($resprod)){
                  $sqlnombre = "select nombreproductosfactura from productosfactura where idproductosfacura='".$filaprod['producto_id']."'";
                    $resnombre = mysql_query($sqlnombre);
                    $datnombre = mysql_fetch_array($resnombre);

 $mensaje .= "<tr>
                <td><a>  ".utf8_decode($datnombre['nombreproductosfactura'])."</a></td>
            <td class='text-rigth'>  ".$filaprod['cantidad']."</td>
          </tr>";

          }

$mensaje .= "        </tbody>
      </table>
                              Gracias por preferirnos una vez ".utf8_decode('más')."!!! </strong></p>

                    <br><br>
                    Saludos Coordiales, gracias por su preferencia. Sistema Web ".utf8_decode('Café')." Real
                  </div>

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
                              <h4> Saludos Coordiales. Sistema Web Café Real<h4>
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
$para = $datprov['Contacto'];
//$para = "admsistemareal@gmail.com, ".$correo.", pgboric@gmail.com";

mail($para, $titulo, $mensaje, $cabeceras);

}



?>
