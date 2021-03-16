<?php
 session_start();
 include("mysql/conecta.php");
 include("../phpmailer/sendmail.php");
 conecta();
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
 date_default_timezone_set('America/Santiago'); 


if(isset($_POST['btngaleria'])){

    $carpetaDestino= "../../Clientes/Galerias/imagenes/";
    chmod($carpetaDestino, 0777); 
        # si es un formato de imagen
        if($_FILES["archivo"]["type"]=="image/jpeg" || $_FILES["archivo"]["type"]=="image/jpg" || $_FILES["archivo"]["type"]=="image/gif" || $_FILES["archivo"]["type"]=="image/png"){

            # si exsite la carpeta o se ha creado
            //if(file_exists($carpetaDestino) || @mkdir($carpetaDestino))
            //{ 
                $archivo = basename($_FILES['archivo']['name']); 
                $extension = pathinfo($archivo, PATHINFO_EXTENSION);
                $archivo = md5($archivo);
                $origen=$_FILES["archivo"]["tmp_name"];
                $destino=$carpetaDestino."//".$archivo.".".$extension;
                $nombrecomp = $archivo.".".$extension;
                # movemos el archivo
                if(move_uploaded_file($origen, $destino))
                {
                   $sqlima = "insert into galerias (fecha, nombre) 
                        values ('".date("Y-m-d H:i:s")."' ,'".$nombrecomp."')";
                        mysql_query($sqlima);

                    header('Location:../../qrclientes.php?qrcli&Subido&Mesa='.$_POST['omesa'].'');
                }
                else{
                    header('Location:../../qrclientes.php?qrcli&NoCopiado&Mesa='.$_POST['omesa'].'');
                }
            //}
            //else{
              //  header('Location:../../qrclientes.php?qrcli&NoDirectorio&Mesa='.$_POST['omesa'].'');
           // }
        }
        else{
            var_dump($_FILES); 
           // header('Location:../../qrclientes.php?qrcli&NoFormato&Mesa='.$_POST['omesa'].'');
        }   
    //}
    
}







if(isset($_GET['Elimina_imagen'])){
	   echo $archivo= "../../Clientes/Galerias/imagenes/".$_GET['nombre']."";
       unlink($archivo);
       $sqldelimg = "delete from galerias where id=".$_GET['Elimina_imagen']."";
       mysql_query($sqldelimg);  
       header('Location:../../Mantenedores/Galerias/index.php?Eliminado');
       
}




?>