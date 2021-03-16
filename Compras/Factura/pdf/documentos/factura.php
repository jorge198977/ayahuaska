<?php
	 ob_start();
	session_start();
	/* Connect To Database*/
	$con = mysql_connect('localhost', 'root', 'sistema_real2018'); 
	mysql_select_db('sheol2', $con); 

	$session_id= session_id();
	$sql = "select * from sheol2.tmp  where compra_id = ".$_GET['ofactura']."";
	$res = mysql_query($sql);
	$tot = mysql_num_rows($res);

	if ($tot==0)
	{
		echo "<script>alert('No hay productos agregados a la factura')</script>";
		echo "<script>window.close();</script>";
		exit;
	}

	require_once(dirname(__FILE__).'/../html2pdf.class.php');
		
	//Variables por GET
	$cliente=intval($_GET['cliente']);
	$descripcion=mysqli_real_escape_string($con,(strip_tags($_REQUEST['descripcion'], ENT_QUOTES)));
	

	//Fin de variables por GET
	$sql=mysqli_query($con, "select LAST_INSERT_ID(id) as last from sheol2.facturas order by id desc limit 0,1 ");
	$rw=mysqli_fetch_array($sql);
	$numero=$rw['last']+1;	
	$perfil=mysqli_query($con,"select * from sheol2.perfil limit 0,1");//Obtengo los datos de la emprea
	$rw_perfil=mysqli_fetch_array($perfil);
	$tax=$rw_perfil['tax'];
	
	$sql_cliente=mysqli_query($con,"select * from sheol2.clientes where id='$cliente' limit 0,1");//Obtengo los datos del proveedor
	$rw_cliente=mysqli_fetch_array($sql_cliente);
    // get the HTML
    
     include(dirname('__FILE__').'/res/factura_html.php');
    $content = ob_get_clean();

    try
    {
        // init HTML2PDF
        $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        // display the full page
        $html2pdf->pdf->SetDisplayMode('fullpage');
        // convert
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        // send the PDF
        $html2pdf->Output('Factura.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
