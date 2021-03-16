$(document).ready(function() {
  $('.IngresarProductoCarta').click(function(){
        //Obtenemos el valor del campo nombre
        var producto = $(".producto").val();
        var movimiento = $(".Omovimiento").val();
        

        if (producto == "") {
            alertify.error('Debe Introducir un Producto');
            $("input").focus();
            return false;
        }

        //Obtenemos el valor del cantidad
        var cantidad = $(".cantidad").val();
        if (cantidad == "") {
            alertify.error('Debe Introducir cantidad');
            $("input").focus();
            return false;
        }

        //Obtenemos el valor del cantidad
        var observ = $(".observ").val();

        var Onpedido = $(".Onpedido").val();


        //Creamos la Variable que recibira el "Value" de todos los Input que esten dentro del Form
        var obtener = $("#tpedido1").serialize();
        $.ajax({
            type: "GET",
            url: "agregapedido.php",
            data: obtener,
            success: function(data) {
                if(data == "nostock"){
                    alert("Error: No existe stock disponible!!!");
                }
                else if(data == "errorinsertavtadet"){
                    alert("Error: algo salió mal al insertar el producto");
                }
                else{
                    $(".producto, .cantidad, .observ").val(""); //Limpiamos los Input
                    location.reload('');  
                }
                //return false;
            }
        }); //Terminamos la Funcion Ajax
        return false; //Agregamos el Return para que no Recargue la Pagina al Enviar el Formulario  
    }); //Terminamos la Funcion Click
}); //Terminamos la Funcion Ready