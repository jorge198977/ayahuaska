<?php
 include("../../intranet/phpmailer/sendmail.php");
 include("../../intranet/funciones/mysql/conecta.php");
 conecta();
if(isset($_GET['OC'])){
    enviarcorreo_oc($_GET['OC'], $_GET['Proveedor']);
    header("Location:index.php?Enviado");
}

?>