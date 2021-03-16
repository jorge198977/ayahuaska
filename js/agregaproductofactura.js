$(document).ready(function() {
  $('.btninsertaprod').click(function(){

        //Obtenemos el valor del campo nombre
        var producto = $(".nombreProducto").val();
        var cantidad = $(".cantidad").val();
        var preciou = $(".preciou").val();
        var Oid = $(".Oid").val();
        var multiplicador = $(".multiplicador").val();
        

        if (producto == "") {
            alertify.error('Debe Introducir un Producto');
            $("input").focus();
            return false;
        }

        //Obtenemos el valor del cantidad
        if (cantidad == "") {
            alertify.error('Debe Introducir cantidad');
            $("input").focus();
            return false;
        }



        //Creamos la Variable que recibira el "Value" de todos los Input que esten dentro del Form
        var obtener = $("#frmncompre_mercaderia").serialize();
        $.ajax({
            type: "GET",
            url: "agregapedidofactura.php",
            data: obtener,
            success: function(data) {
                if(data == "nostock"){
                    alert("Error: No existe stock disponible!!!");
                }
                else if(data == "errorinsertavtadet"){
                    alert("Error: algo salió mal al insertar el producto");
                }
                else{
                    $(".producto, .cantidad, .multiplicador, .preciou").val(""); //Limpiamos los Input
                    location.reload('');  
                }
                //return false;
            }
        }); //Terminamos la Funcion Ajax
        return false; //Agregamos el Return para que no Recargue la Pagina al Enviar el Formulario  
    }); //Terminamos la Funcion Click
}); //Terminamos la Funcion Ready