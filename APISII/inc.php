<?php

// activar todos los errores
//ini_set('display_errors', true);
//error_reporting(E_ALL);

// zona horaria
date_default_timezone_set('America/Santiago');

// incluir configuración específica de los ejemplos
if (is_readable('config.php'))
    include 'config.php';
else
    die('Debes crear config.php a partir'."\n");

?>