$(document).ready(function() {
  $('.btninsertaprodoc').click(function(){

        //Obtenemos el valor del campo nombre
        var producto = $(".nombreProducto").val();
        var cantidad = $(".cantidad").val();
        var Onfact = $(".Onfact").val();

        //Creamos la Variable que recibira el "Value" de todos los Input que esten dentro del Form
        var obtener = $("#frmoc").serialize();
        //alert(obtener);
        $.ajax({
            type: "GET",
            url: "agregapedidooc.php",
            data: obtener,
            success: function(data) {
                if(data == "nostock"){
                    alert("Error: No existe stock disponible!!!");
                }
                else if(data == "errorinsertavtadet"){
                    alert("Error: algo salió mal al insertar el producto");
                }
                else{
                    $(".producto, .cantidad, .Onfact").val(""); //Limpiamos los Input
                    location.reload('');  
                }
                //return false;
            }
        }); //Terminamos la Funcion Ajax
        return false; //Agregamos el Return para que no Recargue la Pagina al Enviar el Formulario  
    }); //Terminamos la Funcion Click
}); //Terminamos la Funcion Ready