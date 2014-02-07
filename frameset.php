<?php
/*

Creado En: 27/07/2011 02:12:16;
Creado Por: Nicolas Zalles;
Modificado Por: Nicolas Zalles;
Modificado En:  27/07/2011 02:12:16;

*/
@session_start(); 
include_once("_DAL/conexion.php");
include_once('_UTL/seguridad.php');
include_once('_UTL/funcionesUI.php');
$u = "";

if(isset($_GET["u"])) 
{ 
 	$u =  $_GET["u"];
}
 
 
if(isset($_SESSION['usrlogin']))
{
 	$seguridad = unserialize($_SESSION['usrlogin']);
} 
else 
{
	$seguridad = new CSecurity();
}
if($seguridad->userid ==0)
{
	header("Location: ingreso.php?u=frameset.php");
}

$configuracion = new configuracion();
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title><?php echo $configuracion->nombre_empresa ?></title>
	</head>
	<frameset rows="81,100%" frameborder="no" framespacing="0">
		<frame src="frame/encabezado.php" name="encabezado" scrolling="NO" noresize>
		<frameset cols="220px,*" framespacing="1" frameborder="1" >
			<frame src="frame/menu.php" name="menu" scrolling="auto" frameborder="1" >
			<frame src="<?php if(isset($_GET["u"])) { echo $_GET["u"];} else { echo "frame/ingreso.php";} ?>" name="principal" scrolling="auto" frameborder="0" >
		</frameset>
		</frameset><noframes></noframes>
</html>
