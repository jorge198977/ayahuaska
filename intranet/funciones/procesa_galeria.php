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
           // var_dump($_FILES); 
            header('Location:../../qrclientes.php?qrcli&NoFormato&Mesa='.$_POST['omesa'].'');
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



if(isset($_POST['idimagenpreparado'])){
  $carpetaDestino= "../../Mantenedores/Productos/imagenes/";
  chmod($carpetaDestino, 0777); 
  $ext = explode(".", $_FILES["archivo"]["name"]);  
  $ext = $ext[count($ext)-1]; 
  echo "tipo->".$_FILES["archivo"]["tmp_name"];
  // Compress Image
  compressImage($origen,$destino,40);
  if($ext=="jpeg" || $ext=="jpg" || $ext=="gif" || $ext=="png"){

    $archivo = basename($_FILES['archivo']['name']); 
    $extension = pathinfo($archivo, PATHINFO_EXTENSION);
    $archivo = md5($archivo);
    $origen=$_FILES["archivo"]["tmp_name"];
    $destino=$carpetaDestino."//".$archivo.".".$extension;
    $nombrecomp = $archivo.".".$extension;

    

    if(move_uploaded_file($origen, $destino))
    {   
        $imagen_optimizada = redimensionar_imagen($nombrecomp,$destino,500,480);
        imagejpeg($imagen_optimizada, $destino);

        $sqlim = "select imagen from preparados where PREPARADOS_ID = ".$_POST['idimagenpreparado']."";
        $resim = mysql_query($sqlim);
        $tot = mysql_num_rows($resim);
        if($tot > 0){
          $dat = mysql_fetch_array($resim);
          $direlim = "../../Mantenedores/Productos/imagenes/".$dat['imagen']."";
          $elim = unlink($direlim);
          
        }
        
        $ruta = "https://ayahuaska.realdev.cl/Mantenedores/Productos/imagenes/".$nombrecomp."";              
        $sql = "update preparados set imagen='".$ruta."' where PREPARADOS_ID = ".$_POST['idimagenpreparado']."";
        mysql_query($sql);

        header('Location:../../Mantenedores/Productos/ver_imagen_preparado.php?Copiado&id='.$_POST['idimagenpreparado'].'&familia_id='.$_POST['familia_id'].'');
    }
    else{
        //header('Location:../../Mantenedores/Productos/ver_imagen_preparado.php?NoCopiado&id='.$_POST['idimagenpreparado'].'&familia_id='.$_POST['familia_id'].'');
    }

  }
  //echo "ENTRA->".$_POST['idimagenpreparado'];
}




function compressImage($source, $destination, $quality) {

  $info = getimagesize($source);

  if ($info['mime'] == 'image/jpeg') 
    $image = imagecreatefromjpeg($source);
  elseif ($info['mime'] == 'image/jpg') 
    $image = imagecreatefromgif($source);

  elseif ($info['mime'] == 'image/gif') 
    $image = imagecreatefromgif($source);

  elseif ($info['mime'] == 'image/png') 
    $image = imagecreatefrompng($source);

  imagejpeg($image, $destination, $quality);

}



function redimensionar_imagen($nombreimg, $rutaimg, $xmax, $ymax){  
    $ext = explode(".", $nombreimg);  
    $ext = $ext[count($ext)-1];  
  
    if($ext == "jpg" || $ext == "jpeg")  
        $imagen = imagecreatefromjpeg($rutaimg);  
    elseif($ext == "png")  
        $imagen = imagecreatefrompng($rutaimg);  
    elseif($ext == "gif")  
        $imagen = imagecreatefromgif($rutaimg);  
      
    $x = imagesx($imagen);  
    $y = imagesy($imagen);  
      
    // if($x <= $xmax && $y <= $ymax){
    //     echo "<center>Esta imagen ya esta optimizada para los maximos que deseas.<center>";
    //     return $imagen;  
    // }
  
    // if($x >= $y) {  
    //     $nuevax = $xmax;  
    //     $nuevay = $nuevax * $y / $x;  
    // }  
    //else {  
     //   $nuevay = $ymax;  
       // $nuevax = $x / $y * $nuevay;  
    //}  
      
    $img2 = imagecreatetruecolor(500, 480);  
    imagecopyresized($img2, $imagen, 0, 0, 0, 0, floor(500), floor(480), $x, $y);  
    echo "<center>La imagen se ha optimizado correctamente.</center>";
    return $img2;   
}







if(isset($_POST['AgregaOpinion'])){
  $nombre = $_POST['nombre'];
  $opinion = $_POST['opinion'];
  $sql = "insert into ayahuaska.opiniones(nombre, texto, fecha, hora) values ('$nombre', '$opinion', '".date("Y-m-d")."', '".date("H:i:s")."')";
  mysql_query($sql);
  header('Location:../../qrclientes.php?qrcli&OpinionENviada&Mesa='.$_POST['omesa'].'');
}




?>