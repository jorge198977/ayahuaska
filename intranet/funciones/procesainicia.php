<?php
include("mysql/conecta.php");


   /**
 * Determina si la hora de referencia queda dentro del rango horario dado
 *
 * - Todas las horas son cadenas en formato HH:MM (o HH:MM:SS)
 * - El rango es cerrado y de tipo 9:00-14:00 o 23:00-6:00
 * - Compara con la hora actual si no se indica lo contrario
 */
function dentro_de_horario($hms_inicio, $hms_fin, $hms_referencia=NULL){ // v2011-06-21
    if( is_null($hms_referencia) ){
        $hms_referencia = date('G:i:s');
    }

    list($h, $m, $s) = array_pad(preg_split('/[^\d]+/', $hms_inicio), 3, 0);
    $s_inicio = 3600*$h + 60*$m + $s;

    list($h, $m, $s) = array_pad(preg_split('/[^\d]+/', $hms_fin), 3, 0);
    $s_fin = 3600*$h + 60*$m + $s;

    list($h, $m, $s) = array_pad(preg_split('/[^\d]+/', $hms_referencia), 3, 0);
    $s_referencia = 3600*$h + 60*$m + $s;

    if($s_inicio<=$s_fin){
        return $s_referencia>=$s_inicio && $s_referencia<=$s_fin;
    }else{
        return $s_referencia>=$s_inicio || $s_referencia<=$s_fin;
    }
}



$usuario = $_POST['usuario'];
$clave = $_POST['clave'];
$turno = 1;
conecta();
date_default_timezone_set('America/Santiago'); 
$hora = date("H");
$min = date("i");
$seg = date("s");
$horahoy = $hora.":".$min.":".$seg;
//echo $horahoy;
if($turno == 1 ){
$horario1 =  "07:00:01";
$horario2 =  "05:59:59";
$ret = dentro_de_horario($horario1, $horario2, $horahoy);
    if($ret == 1){
        echo $sqlinicia = "select * from ayahuaska.usuarios where usuario='".($usuario)."' 
                    and clave='".(md5($clave))."'";
            $resinicia = mysql_query($sqlinicia);
            $tot = mysql_num_rows($resinicia);
            if($tot > 0){
               $datinicia = mysql_fetch_array($resinicia); 
                        ini_set("session.cookie_lifetime","7200");
                        ini_set("session.gc_maxlifetime","7200");  
                        session_start();  
                        $_SESSION['id']  = $datinicia['id']; 
                        $_SESSION['nombre']  = $datinicia['nombre']; 
                        $_SESSION['apellido']  = $datinicia['apellido'];
                        $_SESSION['usuario'] = $datinicia['usuario'];
                        $_SESSION['correo'] = $datinicia['correo'];
                        $_SESSION['nacionalidad'] = $datinicia['clave'];
                        $_SESSION['tipo'] = $datinicia['tipo_usuario_id'];
                        $_SESSION['inicia'] = "ACEPTADO";
                        $_SESSION['turno'] = $turno;
                        header('Location:../../inicio.php');
                        }
            else {
               header('Location:../../index.php?error');
            } 
    }
    else{
        header('Location:../../index.php?errorHoraFuera');
    }    
}
// if($turno == 2){

// $horario1 = "17:00:00";
// $horario2 = "08:59:00";
// $ret = dentro_de_horario($horario1, $horario2, $horahoy);
//     if($ret == 1){
//         $sqlinicia = "select * from ayahuaska.usuarios where usuario='".mysql_real_escape_string($usuario)."' and clave='".mysql_real_escape_string(md5($clave))."'";
//             $resinicia = mysql_query($sqlinicia);
//             $tot = mysql_num_rows($resinicia);
//             if($tot > 0){
//                $datinicia = mysql_fetch_array($resinicia);   
//                         session_start();  
//                         $_SESSION['id']  = $datinicia['id']; 
//                         $_SESSION['nombre']  = $datinicia['nombre']; 
//                         $_SESSION['apellido']  = $datinicia['apellido'];
//                         $_SESSION['usuario'] = $datinicia['usuario'];
//                         $_SESSION['correo'] = $datinicia['correo'];
//                         $_SESSION['nacionalidad'] = $datinicia['Clave'];
//                         $_SESSION['tipo'] = $datinicia['tipo_usuario_id'];
//                         $_SESSION['inicia'] = "ACEPTADO";
//                         $_SESSION['turno'] = $turno;
//                         header('Location:../../inicio.php');
//                         }
//             else {
//                header('Location:../../index.php?error');
//             } 
//     }
//     else{
//         header('Location:../../index.php?errorHoraFuera');
//     }    

// }



           
           


?>