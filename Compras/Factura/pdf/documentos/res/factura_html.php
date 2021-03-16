<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }
.class-theme{
	background:#4cc2c5;
	padding: 5px;
	color:white;
	font-weight:bold;
	font-size:12px;
}
.silver{
	background:white;
	padding: 5px;
}
.clouds{
	background:#ecf0f1;
	padding: 5px;
}
.border-top{
	border-top: solid 2px #eee;
	
}
.border-left{
	border-left: solid 2px #eee;
}
.border-right{
	border-right: solid 2px #eee;
}
.border-bottom{
	border-bottom: solid 2px #eee;
}

table.page_header{
	width: 100%;
	padding:0px;
	background-color:#22b24b;

}

table.page_footer{
	width: 100%;
	padding:0px;
	
}
.border-bottom{
	border-bottom: #4cc2c5 3px;
	padding-bottom:10px
}
.orange-top{
	border-top: #4cc2c5 3px;
}
.orange-left{
	border-left: #4cc2c5 3px;
}
.white{
	border-bottom:white 3px;
}
table{
	color:#2c3e50;
}
 .inpar{
	 background-color: #f0eeed;
 }

-->
</style>
<page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
<page_header>
        <table class="page_header" cellspacing=0 cellpadding=0 style="width:100%">
            
			

			<tr style='' >

                
				<td style="width:30%;vertical-align: middle;height:40mm;padding-left:10mm">
                   <img style="width: 100%;" src="../../assets/img/logo.png" alt="Logo">
                </td>
				<td style="width:30%;"> &nbsp;</td>
				<td style="width:40%;color:white;vertical-align: bottom;height:30mm">
				<strong><?php echo $rw_perfil['nombre_comercial'];?> </strong> <br>
                  
					<strong>Teléfono : </strong> <?php echo $rw_perfil['telefono'];?><br>
						
				<strong>Dirección : </strong> <?php echo $rw_perfil['direccion'];?><br>
                </td>
               
            </tr>
        </table>
    </page_header>
	<page_footer>
        <table class="page_footer" cellspacing=0 cellpadding=0 >
			<tr>
				<td colspan=3 style="padding-left:10mm">
				 <strong>E-mail : </strong> <?php echo $rw_perfil['email'];?>, <strong>E-mail : </strong> <?php echo $rw_perfil['web'];?>
				</td>
			</tr>
			
           <tr>

                
				<td style="width:33%;min-height:100px;background-color:#961019">
                   &nbsp;
                </td>
				
				<td style="width:34%;min-height:100px;background-color:#22b24b;">
                   &nbsp;
                </td>
				
				<td style="width:33%;min-height:100px;background-color:#233f9a ">
                   &nbsp;test
                </td>
               
            </tr>


			
        </table>
    </page_footer>
	<p style='margin-top:15mm'>&nbsp;</p>
	<p style='color:#961019;font-size:20px;font-weight:bold'>Factura Nº: <?php echo $numero;?></p>
	<p style='color:#233f9a;margin-top:-10px'><?php echo date("d/m/Y");?></p>
	
	<p >
		<span style='color:#961019;font-size:20px;font-weight:bold'>Facturar a:</span><br>
		<span style='font-size:15px;color:#222f3e'><strong>Nombre: </strong> <?php echo $rw_cliente['nombre'];?><br>
			<strong>Dirección: </strong> <?php echo $rw_cliente['direccion'];?><br>
			<strong>E-mail: </strong> <?php echo $rw_cliente['email'];?><br>
			<strong>Teléfono: </strong> <?php echo $rw_cliente['telefono'];?>
		</span>
	</p>
	
	
        <table   cellspacing=0 cellpadding=0 style="width:100%;font-size:14px;color:#222f3e" >
           <tr style="background-color:#233f9a;color:white;">

                
				<td style="width:10%;text-align:center;height:8mm;vertical-align:middle;">
                   Nº
                </td>
				<td style="width:45%;text-align:left;height:8mm;vertical-align:middle;">
                   DESCRIPCIÓN
                </td>
				<td style="width:15%;text-align:right;height:8mm;vertical-align:middle;">
                   PRECIO
                </td>
				<td style="width:15%;text-align:center;height:8mm;vertical-align:middle;">
                   CANTIDAD
                </td>
				<td style="width:15%;text-align:right;height:8mm;vertical-align:middle;padding-right:4px">
                   TOTAL
                </td>
               
            </tr>
			<?php
			$query=mysqli_query($con,"select * from tmp order by id");
			$items=1;
			$suma=0;
			while($row=mysqli_fetch_array($query)){
				$total=$row['cantidad']*$row['precio'];
				$total=number_format($total,2,'.','');
				
				if ($items%2==1){
					$clase_tr="inpar";
				} else{
					$clase_tr='';
				}
			?>
			<tr class='<?php echo $clase_tr;?>'>
		
				<td style='width:10%;text-align:center;height:8mm;vertical-align:middle'><?php echo $items;?></td>
				<td style='width:45%;text-align:left;height:8mm;vertical-align:middle'><?php echo $row['descripcion'];?></td>
				<td style='width:15%;text-align:right;height:8mm;vertical-align:middle'><?php echo $row['precio'];?></td>
				<td style='width:15%;text-align:center;height:8mm;vertical-align:middle'><?php echo $row['cantidad'];?></td>
				<td style='width:15%;text-align:right;height:8mm;vertical-align:middle;padding-right:4px'><?php echo $total;?></td>
				

			</tr>
			<?php
			$items++;
			$suma+=$total;
			$detalle=mysqli_query($con,"INSERT INTO `detalle` (`id`, `descripcion`, `cantidad`, `precio`, `id_factura`) VALUES (NULL, '".$row['descripcion']."', '".$row['cantidad']."', '".$row['precio']."', '$numero');");
			}
			
			$iva=$suma * ($tax / 100);
			$total_iva=number_format($iva,2,'.','');	
			$total=$suma + $total_iva;
			
			?>


			
        </table>
		<br>
		<table   cellspacing=0 cellpadding=0 style="width:100%;font-size:14px;color:#222f3e" >
           <tr>
				<td style="width:70%;"></td>
				<td style="width:15%;text-align:right;height:8mm;vertical-align:middle;background-color:#f0eeed  ">
                   NETO
                </td>
				<td style="width:15%;text-align:right;height:8mm;vertical-align:middle;padding-right:4px;background-color:#f0eeed ">
                   <?php echo number_format($suma,2);?>
                </td>
           </tr>
		   
		   <tr>
				<td style="width:70%;"></td>
				<td style="width:15%;text-align:right;height:8mm;vertical-align:middle;">
                   IVA <?php echo $tax;?>%
                </td>
				<td style="width:15%;text-align:right;height:8mm;vertical-align:middle;padding-right:4px;">
                   <?php echo number_format($total_iva,2);?>
                </td>
           </tr>
		   
		   <tr>
				<td style="width:70%;"></td>
				<td style="width:15%;text-align:right;height:8mm;vertical-align:middle;background-color:#233f9a;color:white;">
                   TOTAL
                </td>
				<td style="width:15%;text-align:right;height:8mm;vertical-align:middle;padding-right:4px;background-color:#233f9a;color:white;">
                   <?php echo number_format($total,2);?>
                </td>
           </tr>
		</table>
		
		<p>
			<span style='color:#961019'>Otros comentarios</span><br>
			<?php echo $descripcion;?>
		</p>

		
</page>   
<?php
//Guardando los datos del presupuesto
$fecha=date("Y-m-d H:i:s");
$sql="INSERT INTO `facturas` (`id`, `fecha`, `id_cliente`, `descripcion`, `monto`) VALUES (NULL, '$fecha', '$cliente', '$descripcion', '$suma');";
$save=mysqli_query($con,$sql);
$delete=mysqli_query($con,"delete from tmp");
?> 