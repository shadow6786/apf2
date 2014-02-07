<?php
session_start();
if (isset ($_GET['cerrar']))
{
	$_SESSION = array(); 
	session_destroy();
	header("Location:index.php");

	}
?>	
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" href="../css/mgEstiloAdminEncabezado.css" type="text/css">
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Pie</title>
<style type="text/css">
	body {
	font: 62.5% "Trebuchet MS", sans-serif;
	background:#f2f2f2 url(../img/bkg_body.gif) 0 0 repeat; 
	margin: 0px;

	color:#00C;
	}
	
	.titulo
	{
	font-size:xx-large; font-weight:bold;
		padding: 5px;
		
	}
	#nombreempresa{ text-align:left; color:#00C}
	#relog{ position:absolute; right:0px; padding:5px}
	
	a{ 
		color:#000000; text-decoration:none;
	}
	a:hover{font-weight:bolder;}
	.menu
	{
		background-color:#00C;
		padding: 2px;
		font-size:10px;	color:#fff}
	.menu a
	{
		color:#fff;
		
	}
	.menu a:hover
	{
	font-weight:bolder;
		
	}
	
	img { margin:0px 0px 0px 0px; border-style:none}
	.link{
	color:#FFFFFF;
		font-size:14px;
		height:20px;
		font-weight: bold;
		text-decoration: none;
		
		
	}
	.sublink{
		height:20px;
		font-size:14px;
		width: 100%;
		position:absolute;
		visibility: hidden;
		color: #ffffff;
		background-color:#66CCFF
		
	}

	</style>
    
</head>

<body style="color:#000; background-color:#666666; font-size:11px; vertical-align:middle ">

&nbsp;Usuario: xxx &nbsp;-&nbsp;
<a href="?cerrar=1" target="_top">[Cerrar Sesión]</a>

</body>
</html>
