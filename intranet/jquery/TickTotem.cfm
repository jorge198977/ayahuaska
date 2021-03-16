<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>TICKET</title>
<link href="´jquery.keypad.css" rel="stylesheet">
<style type="text/css">
<!--
body {
	background-color: #1F2D8E;
}
#inlineKeypad { width: 10em; }
-->
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="jquery.plugin.js"></script>
<script src="jquery.keypad.js"></script>
<script>
$(function () {
	$('#txt_clinum').keypad();
	$('#inlineKeypad').keypad({onClose: function() {
		alert($(this).val());
	}});
});
</script>

</head>

<body>

<cfform name="form" format="flash" width="300" height="300" style="themeColor:##1F2D8E; background-color:##1F2D8E;" action="TickTotem2.cfm" timeout="300">
<cfformgroup type="panel" style="headerHeight: 3; cornerRadius: 6;">
<cfformgroup type="panel" style="headerColors: ##3366CC, ##1F2D8E; fontWeight:bold;" label="INGRESE NUMERO DE CLIENTE">
<cfformgroup type="page" label="DATOS GENERALES" height="50" style="headerColors: ##1F2D8E, ##9CC1DC; fontWeight:bold;">	
	<cfinput type="text" name="txt_clinum" id="txt_clinum" size="10" label="CLIENTE:" required="yes" message="Debe ingresar el Número de Cliente">		   
	</cfformgroup>
	</cfformgroup>
	<cfformgroup type="horizontal" style="horizontalAlign:center">
	<cfinput type="Submit" name="guarda" value="Consultar">
	
	</cfformgroup>
	</cfformgroup>
	
 </cfform>
 </body>
 </html>