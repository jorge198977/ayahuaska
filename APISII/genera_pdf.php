<?php
require_once 'Clases/File.php';

function crea_pdf($xml, $nrointerno, $empresa){
	$fecha_hoy = date("Y-m-d");
	$dir_pdf = "/var/www/realdev.cl/turquesa/APISII/PDF/TURQUESA/$fecha_hoy";
	if (!file_exists($dir_pdf)) {
	    mkdir($dir_pdf, 0777, true);
	}

	$EnvioDte = new EnvioDte();
	$EnvioDte->loadXML($xml);
	$Caratula = $EnvioDte->getCaratula();
	$Documentos = $EnvioDte->getDocumentos();

	// directorio temporal para guardar los PDF
	$dir = sys_get_temp_dir().'/dte_'.$Caratula['RutEmisor'].'_'.$Caratula['RutReceptor'].'_'.str_replace(['-', ':', 'T'], '', $Caratula['TmstFirmaEnv']);
	if (is_dir($dir))
	    File::rmdir($dir);
	if (!mkdir($dir))
	    die('No fue posible crear directorio temporal para DTEs');

	// procesar cada DTEs e ir agregándolo al PDF
	foreach ($Documentos as $DTE) {
	    if (!$DTE->getDatos())
	        die('No se pudieron obtener los datos del DTE');
	    $pdf = new DtePdf(true); // =false hoja carta, =true papel contínuo (false por defecto si no se pasa)
	    $pdf->setFooterText();    
	    //$pdf->setLogo('/home/debian/webcc/public/APISII/Images/logo.png'); // debe ser PNG!
	    $pdf->setResolucion(['FchResol'=>$Caratula['FchResol'], 'NroResol'=>$Caratula['NroResol']]);
	    //$pdf->setCedible(true);
	    $pdf->agregar($DTE->getDatos(), $DTE->getTED());
	    $pdf->setFooterText();
	    $ubic_pdf = $dir_pdf."/".$nrointerno.'.pdf';
	    //$pdf->Output('/home/debian/webcc/public/APISII/PDF/dte_vta_'.$nrointerno.'_'.$DTE->getID().'.pdf', 'F');
	    $pdf->Output($ubic_pdf, 'F');
    	//$ubicacion = '/home/debian/webcc/public/APISII/PDF/dte_vta_'.$nrointerno.'_'.$DTE->getID().'.pdf';

	    //$pdf->Output($dir.'/dte_'.$Caratula['RutEmisor'].'_'.$DTE->getID().'.pdf', 'F');
	}
}


?>
