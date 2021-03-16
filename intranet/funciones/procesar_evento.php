<?php
 session_start();
 include("mysql/conecta.php");
 include("../phpmailer/sendmail.php");
 conecta();
 date_default_timezone_set('America/Santiago'); 


function eliminarDir($carpeta)
{
    foreach(glob($carpeta . "/*") as $archivos_carpeta)
    {
        echo $archivos_carpeta;
 
        if (is_dir($archivos_carpeta))
        {
            eliminarDir($archivos_carpeta);
        }
        else
        {
            unlink($archivos_carpeta);
        }
    }
 
    rmdir($carpeta);
}

if(isset($_POST['btnevento'])){
	$ingresa = "insert into cafereal2.eventos (nombre, descripcion, usuario_id, fecha, hora, estado) 
                values ('".mysql_real_escape_string($_POST['nombre'])."',  
                '".mysql_real_escape_string($_POST['descripcion'])."', 
                ".mysql_real_escape_string($_SESSION['id']).", '".mysql_real_escape_string(date("Y-m-d"))."', 
                '".mysql_real_escape_string(date("H:i:s"))."',
                ".mysql_real_escape_string($_POST['estado']).")";
    mysql_query($ingresa);
    $idnot = "select max(id) as maxid from cafereal2.eventos";
    $residnot = mysql_query($idnot);
    $datnot = mysql_fetch_array($residnot);
    $carpetaDestino= "../../Clientes/Eventos/".$datnot['maxid']."";


    # si hay algun archivo que subir
    if($_FILES["archivo"]["name"][0])
    {
 
        # recorremos todos los arhivos que se han subido
        for($i=0;$i<count($_FILES["archivo"]["name"]);$i++)
        {

            # si es un formato de imagen
            if($_FILES["archivo"]["type"][$i]=="image/jpeg" || $_FILES["archivo"]["type"][$i]=="image/pjpeg" 
                || $_FILES["archivo"]["type"][$i]=="image/gif" || $_FILES["archivo"]["type"][$i]=="image/png")
            {
 
                # si exsite la carpeta o se ha creado
                if(file_exists($carpetaDestino) || @mkdir($carpetaDestino))
                {
                    chmod($carpetaDestino, 0777); 
                    $origen=$_FILES["archivo"]["tmp_name"][$i];
                    $destino=$carpetaDestino."//".$_FILES["archivo"]["name"][$i];
 
                    # movemos el archivo
                    if(@move_uploaded_file($origen, $destino))
                    {

                        $sqlima = "insert into cafereal2.imagenes_eventos (nombre, evento_id) 
                        values ('".$_FILES["archivo"]["name"][$i]."', ".$datnot['maxid'].")";
                        mysql_query($sqlima);
                    }
                }
                else{
                    echo "ERROR CREAR CARPETA";
                }
            }
            else{
                echo "ERROR FORMATO";
            }

        }

        header('Location:../../Mantenedores/Eventos/index.php?Ingresado');
    }
    else{
        echo "ERROR ARCHIVO";
    }
}


if(isset($_GET['Ideventoelim'])){
	$carpetaDestino= "../Clientes/Eventos/".$_GET['Ideventoelim']."";
    eliminarDir($carpetaDestino);
    $sqldelimg = "delete from cafereal2.imagenes_eventos where evento_id=".$_GET['Ideventoelim']."";
    mysql_query($sqldelimg);
    $sqldel = "delete from cafereal2.eventos where id=".$_GET['Ideventoelim']."";
    mysql_query($sqldel);
    
     header('Location:../../Mantenedores/Eventos/index.php?Ingresado');
}



if(isset($_POST['btn_actualiza_evento'])){
    # si hay algun archivo que subir

    if($_FILES["archivo"]["name"][0]){
        $dir= "../Clientes/Eventos/".$_POST['Oid']."/";
        $sqlactnot = "update cafereal2.eventos set nombre='".$_POST['nombre']."', 
        descripcion = '".$_POST['descripcion']."',
        usuario_id=".$_SESSION['id'].",  
        fecha='".date("Y-m-d")."', hora='".date("H:i:s")."', estado=".$_POST['estado']." 
        where id=".$_POST['Oid']."";
        mysql_query($sqlactnot);
        $ima = "select * from cafereal2.imagenes_eventos where evento_id=".$_POST['Oid']."";
        $resima = mysql_query($ima);
        while($datima = mysql_fetch_array($resima)){
            $dirima = $dir."".$datima['nombre'];
            unlink($dirima);
        }

        $elimima = "delete from cafereal2.imagenes_eventos where evento_id=".$_POST['Oid']."";
        mysql_query($elimima);

        # recorremos todos los arhivos que se han subido
        for($i=0;$i<count($_FILES["archivo"]["name"]);$i++)
            {
                $origen=$_FILES["archivo"]["tmp_name"][$i];
                $destino=$dir.$_FILES["archivo"]["name"][$i];
                # movemos el archivo
                if(@move_uploaded_file($origen, $destino))
                {
                    $sqlima = "insert into cafereal2.imagenes_eventos (nombre, evento_id) 
                            values ('".$_FILES["archivo"]["name"][$i]."', ".$_POST['Oid'].")";
                    mysql_query($sqlima);

                }
            }

        header('Location:../../Mantenedores/Eventos/index.php?Ingresado');
    }

    else{
        $sqlactnot = "update cafereal2.eventos set nombre='".$_POST['nombre']."', 
        descripcion = '".$_POST['descripcion']."',
        usuario_id=".$_SESSION['id'].",  
        fecha='".date("Y-m-d")."', hora='".date("H:i:s")."', estado=".$_POST['estado']." 
        where id=".$_POST['Oid']."";
        mysql_query($sqlactnot);
        header('Location:../Mantenedores/Eventos/index.php?Ingresado');
    }

}


?>