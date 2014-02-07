<?php @session_start();
include_once("../_DAL/conexion.php");
include_once('../_UTL/seguridad.php');
include_once('../_UTL/funcionesUI.php');

if(isset($_SESSION['usrlogin']))
{
 	$seguridad = unserialize($_SESSION['usrlogin']);
	
} else {
	$seguridad = new CSecurity();
}

if(!$seguridad->verify())
{
	$seguridad->gotourl();
}
?>