<?php
	include('../../intranet/funciones/controlador.php');
	include("../../intranet/funciones/seguridad.php");
  		if(!validaringreso())
    		header('Location:../../index.php?NOCINICIA');
	$perfil = get_perfil();
	$num_factura = get_num_factura();
?>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>SISTEMA REAL</title>
    <!-- BOOTSTRAP CORE STYLE CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- CUSTOM STYLE CSS -->
    <link href="assets/css/style.css" rel="stylesheet" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
</head>

<script type="text/javascript">
function agrega_impuesto() {
  var impuesto = document.getElementById("impuesto_adicional");
  var total = document.getElementById("total");
  if(parseInt(impuesto.value) >= 0){
    total.value = Math.round(
              parseInt(ototal.value) + parseInt(impuesto.value) 
          
    ); 
  }
  
}
function agrega_serv_logistico() {
  var servlog = document.getElementById("servicios_logic");
  var total = document.getElementById("total");
  var impuesto = document.getElementById("impuesto_adicional");
  if(parseInt(servicios_logic.value) >= 0){
    total.value = Math.round(
              parseInt(ototal.value) + parseInt(impuesto.value) + parseInt(servicios_logic.value)
          
    ); 
  }
  
}
function agrega_retencion() {
  var servlog = document.getElementById("servicios_logic");
  var total = document.getElementById("total");
  var impuesto = document.getElementById("impuesto_adicional");
  var retencion = document.getElementById("retencion");
  if(parseInt(retencion.value) >= 0){
    total.value = Math.round(
              parseInt(ototal.value) + parseInt(impuesto.value) + parseInt(servicios_logic.value) + parseInt(retencion.value)
          
    ); 
  }
  
}
function agrega_iaba() {
  var servlog = document.getElementById("servicios_logic");
  var total = document.getElementById("total");
  var impuesto = document.getElementById("impuesto_adicional");
  var retencion = document.getElementById("retencion");
  var iaba = document.getElementById("iaba");
  if(parseInt(iaba.value) >= 0){
    total.value = Math.round(
              parseInt(ototal.value) + parseInt(impuesto.value) + parseInt(servicios_logic.value) + parseInt(retencion.value) + parseInt(iaba.value)
          
    ); 
  }
  
}
function agrega_ila() {
  var servlog = document.getElementById("servicios_logic");
  var total = document.getElementById("total");
  var impuesto = document.getElementById("impuesto_adicional");
  var retencion = document.getElementById("retencion");
  var iaba = document.getElementById("iaba");
  var ila = document.getElementById("ila");
  if(parseInt(ila.value) >= 0){
    total.value = Math.round(
              parseInt(ototal.value) + parseInt(impuesto.value) + parseInt(servicios_logic.value) + parseInt(retencion.value) + parseInt(iaba.value) + parseInt(ila.value)
          
    ); 
  }
  
}
function agrega_descuento() {
  var servlog = document.getElementById("servicios_logic");
  var total = document.getElementById("total");
  var impuesto = document.getElementById("impuesto_adicional");
  var retencion = document.getElementById("retencion");
  var iaba = document.getElementById("iaba");
  var ila = document.getElementById("ila");
  var descuento = document.getElementById("descuento");
  if(parseInt(descuento.value) >= 0){
    total.value = Math.round(
              parseInt(ototal.value) + parseInt(impuesto.value) + parseInt(servicios_logic.value) + parseInt(retencion.value) + parseInt(iaba.value) + parseInt(ila.value) - parseInt(descuento.value)
          
    ); 
  }
  
}


function mostrar_oculto_cheque(){
    element = document.getElementById("contentcheque"); 
    if(fpago.value == 2){
      element.style.display='block';
    }
    else{
      element.style.display='none';
      nro_cheque.value = "0";

    }
  }
</script>


</script>

<body >
    <div class="container outer-section" >
        
       <form class="form-horizontal" role="form" id="datos_factura" method="post" action="../../intranet/funciones/procesamoderador2.php">
        <div id="print-area">
	        <div class="row pad-top font-big">
		        <div class="col-lg-4 col-md-4 col-sm-4">
		         <img src="../../assets/img/brand/logo.jpg" width="300" heigth="300" />
		        </div>
		        <div class="col-lg-4 col-md-4 col-sm-4">
		            <strong>E-mail : </strong> ayahuaskaovalle@gmail.com
		            <br />
		            <strong>Teléfono :</strong> 532622186 <br />
					<strong>Sitio web :</strong> AYAHUSKA 
		           
		        </div>
		        <div class="col-lg-4 col-md-4 col-sm-4">
		            <strong>AYAHUSKA  </strong>
		            <br />
		            Dirección : David perry 45
		        </div>
		    </div>
          
            
            

            <div class="row ">
			<hr />
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <h2>Detalles del cliente :</h2>
                     <select class="cliente form-control" name="cliente" id="cliente" required>
						<option value="">Selecciona el cliente</option>
					</select>
                    <span id="direccion"></span>
                    <h4><strong>E-mail: </strong><span id="email"></span></h4>
                    <h4><strong>Teléfono: </strong><span id="telefono"></span></h4>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <h2>Detalles de la factura:</h2>
                    <h4><strong>Factura #: </strong><?php echo $num_factura;?><strong></h4>
                    <h4><strong>Fecha #: </strong><?php echo date("d/m/Y");?><strong> </h4>
                </div>
            </div>

            <div class="row ">
            	<hr />
                <div class="col-lg-12 col-md-6 col-sm-12">
                    <h2>Datos Internos:</h2>
                    <h4><strong>Vencimiento #: </strong><input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" required placeholder="Fecha de Vencimiento"><br>
					<h4><strong>Nro de Factura #: </strong><input type="text" class="form-control" id="numerofactura" name="numerofactura" placeholder="Nro de Factura" required><br>
					<select name="fpago" id="fpago" class="form-control input-lg" onchange="javascript:mostrar_oculto_cheque()" required>
                      <option value="">Ingrese Forma pago</option>
                      <?php
                        $formas_pagos = get_formas_pagos_compras();
                        foreach ($formas_pagos as $key => $forma_pago) {
                      ?>
                        <option value="<?php echo $forma_pago['id'] ?>"><?php echo $forma_pago['descripcion'] ?></option>
                      <?php
                      }
                      ?>
                    </select>
                </div>

                <div class="col-lg-12 col-md-6 col-sm-12" id="contentcheque" style="display: none;">
                    <h4><strong>Ingrese # de cheque: </strong><input type="text" class="form-control" id="nro_cheque" name="nro_cheque" placeholder="Nro de cheque"><br>
                </div>
            </div>
            
         
            <div class="row">
			<hr />
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-striped  table-hover">
                            <thead>
                                <tr>
                                    <th class='text-center'>Item</th>
									<th>Descripción</th>
									<th class='text-center'>Cantidad</th>
                                    <th class='text-right'>Precio unitario</th>
                                    <th class='text-right'>Total</th>
									<th class='text-right'></th>
                                </tr>
                            </thead>
                            <tbody class='items'>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
           
           <input type="hidden" class="form-control" id="ofacturaIngresa" name="ofacturaIngresa"  value="<?php echo  $num_factura ?>">
            
		
        </div>
       <div class="row"> <hr /></div>
        <div class="row pad-bottom  pull-right">
		
            <div class="col-lg-12 col-md-12 col-sm-12">
                <button type="submit" class="btn btn-success ">Guardar factura</button>
           
            </div>
        </div>
		</form>
    </div>
	<form class="form-horizontal" name="guardar_item" id="guardar_item">
			<!-- Modal -->
			<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Nuevo Producto</h4>
				  </div>
				  <div class="modal-body">
				  	<div class="row">
					  	<div class="col-md-12">
		                    <label>Familia</label>
		                    <select name="producto" id="producto" class="form-control input-lg">
		                    <option value="">Seleccione Producto</option>
		                      <?php
		                          $familias = get_all_familias();
		                          foreach ($familias as $key => $familia) {
		                      ?>
		                          <option value="<?php echo $familia['id'] ?>"><?php echo $familia['nombre'] ?></option>
		                      <?php 
		                          }
		                      ?>    
		                    </select>
		                </div>
		            </div>
					
					  <div class="row">
						<div class="col-md-12">
							<label>Descripción del producto/servicio</label>
							<select name="nombreProducto" id="nombreProducto" 
                                            class="form-control input-lg nombreProducto">
                            </select>
							<input type="hidden" class="form-control" id="action" name="action"  value="ajax">
							<input type="hidden" class="form-control" id="ofactura" name="ofactura"  value="<?php echo  $num_factura ?>">
						</div>
						
					  </div>

					  <div class="row">
					  	<div class="col-md-8">
							<label>FORMATO</label>
							<select name="formato" id="formato" class="form-control">
      							<option value="">Seleccione estado</option>
								<?php
									$ccs =  get_all_ccs();
									foreach ($ccs as $key => $cc) {
								?>
										<option value="<?php echo $cc['id'] ?>"><?php echo $cc['cc']." / ".$cc['onzas'] ?></option>
								<?php
									}
								?>
							</select>
						</div> 

						<div class="col-md-4">
							<label>Cantidad</label>
							<input type="text" class="form-control" id="cantidad" name="cantidad" required>
						</div>
					  
						<div class="col-md-12">
							<label>Precio unitario</label>
						  <input type="text" class="form-control" id="precio" name="precio" required>
						</div>
						
					  </div>
				
					
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-info" >Guardar</button>
					
				  </div>
				</div>
			  </div>
			</div>
	</form>
	
   
</body>

	<script language="javascript" src="../../js/jquery-1.2.6.js"></script>

  	<script language="javascript">

  		$(document).ready(function(){
  var $impuesto_adicional = $('#impuesto_adicional');
  
  $impuesto_adicional.on('keyup', function(e) {

    // $total.val(
    //       Math.round(
    //          parseInt($totpag.val()) + parseInt($propinamonto.val()) 
          
    //       ) 

    // );
  });

  // var $vuelto = $('#vuelto');
  // var $propina = $('#propina');
  // var $totpag = $('#totpag');
  // var $totcpropina = $('#totcpropina');
  // var $propinamonto = $('#propinamonto');
  // var $descuento = $('#descuento');
  
  // $montopagado.on('keyup', function(e) {
  //     check = document.getElementById("propina");
  // if (check.checked) {
   
  // var $acancelar = $('#totcpropina') ;  
  // }
  // else{
  // var $acancelar = $('#totcpropinano');  
  // }
  // $vuelto.val(
  //         Math.round(
  //            parseInt($montopagado.val()) - parseInt($acancelar.val()) 
          
  //         ) 

  //   );
  // });



  // $propinamonto.on('keyup', function(e) {
  //   $totcpropina.val(
  //         Math.round(
  //            parseInt($totpag.val()) + parseInt($propinamonto.val()) 
          
  //         ) 

  //   );
  // });
 
});

	    $(document).ready(function(){
	       $("#producto").change(function () {
	               $("#producto option:selected").each(function () {
	                id_producto = $(this).val();
	                $.post("nombreproducto.php", { id_producto: id_producto }, function(data){
	                    $("#nombreProducto").html(data);
	                });            
	            });
	       })
	    });
	</script>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
	    $( ".cliente" ).select2({        
	    ajax: {
	        url: "ajax/clientes_json.php",
	        dataType: 'json',
	        delay: 250,
	        data: function (params) {
	            return {
	                q: params.term // search term
	            };
	        },
	        processResults: function (data) {
	            return {
	                results: data
	            };
	        },
	        cache: true
	    },
	    minimumInputLength: 2
	}).on('change', function (e){
			var email = $('.cliente').select2('data')[0].email;
			var telefono = $('.cliente').select2('data')[0].telefono;
			var rol = $('.cliente').select2('data')[0].rol;
			$('#email').html(email);
			$('#telefono').html(telefono);
			$('#rol').html(rol);
	})
	});

	function mostrar_items(){
		var parametros={"action":"ajax"};
		$.ajax({
			url:'ajax/items.php',
			data: parametros,
			 beforeSend: function(objeto){
			 $('.items').html('Cargando...');
		  },
			success:function(data){
				$(".items").html(data).fadeIn('slow');
		}
		})
	}
	function eliminar_item(id){
		$.ajax({
			type: "GET",
			url: "ajax/items.php",
			data: "action=ajax&id="+id,
			 beforeSend: function(objeto){
				 $('.items').html('Cargando...');
			  },
			success: function(data){
				$(".items").html(data).fadeIn('slow');

			}
		});
	}
	
	$( "#guardar_item" ).submit(function( event ) {
		parametros = $(this).serialize();
		//alert(parametros);
		$.ajax({
			type: "POST",
			url:'ajax/items.php',
			data: parametros,
			 beforeSend: function(objeto){
				 $('.items').html('Cargando...');
			  },
			success:function(data){
				$(".items").html(data).fadeIn('slow');
				$("#myModal").modal('hide');
				document.getElementById("nombreProducto").value = " ";
				document.getElementById("producto").value = " ";
				document.getElementById("cantidad").value = " ";
				document.getElementById("precio").value = " ";
			}
		})
		
	  event.preventDefault();
	})
	$("#datos_factura").submit(function(){
		  var cliente = $("#cliente").val();
		  var ofactura = $("#ofactura").val();
		 
		  
		  if (cliente>0)
		 {
		 	window.location('Location: ../../funciones/procesamoderador2.php?ofacturaIngresa='+ofactura+'&cliente='+cliente+'');
			//VentanaCentrada('factura.php?cliente='+cliente+'&ofactura='+ofactura,'Presupuesto','','1024','768','true');	
		 } else {
			 alert("Selecciona el cliente");
			 return false;
		 }
		 
	 });
		

		mostrar_items();
		
		
</script>
</html>
