<?php
session_start(); 
function validaringreso(){
if($_SESSION['inicia'] == "ACEPTADO"){
	return true;	
}
else{
	return false;	
}
}
?>