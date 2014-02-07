<?php

include_once("../_DAL/conexion.php");


	include_once("../_UTL/seguridad.php");
	
	@session_start();

$configuracion = new configuracion();
$seguridad  = unserialize( $_SESSION["usrlogin"] );
 
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

<head>

	<title>Menu</title>

	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

    <style type="text/css">

	body {

	font: 62.5% "Trebuchet MS", sans-serif;

	background:#f2f2f2 url(../img/bkg_body.gif) 0 0 repeat; 

	margin: 0px;



	color:#49a005;

	}

	

	.titulo

	{

	font-size:xx-large; font-weight:bold;

		padding: 5px;

		

	}

	#nombreempresa{ text-align:left; color:#ffaf0f}

	#relog{ position:absolute; right:0px; padding:5px}

	

	a{ 

		color:#000000; text-decoration:none;

	}

	a:hover{font-weight:bolder;}

	.menu

	{

		background-color:#555555;

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

	<SCRIPT LANGUAGE="JavaScript">

		function myprint() {

		parent.principal.focus();

		parent.principal.print();

		}

	</script>

</head>

<body > 		

<table cellpadding="0" cellspacing="0" height="81px" width="100%">

	<tr>

	  <td width="76%" class="titulo"><span id="nombreempresa"><?php echo $configuracion->nombre_empresa ?></span>

        

        </td>

		<td width="24%"><div style="font-size:12px; float:right; padding-right:20px">
         

	    </div></td>

  </tr>

     <tr>

        <td colspan="2" class="menu">   

        	<a href="ingreso.php" target="principal">Inicio</a>&nbsp;|&nbsp;
            
            <a href="ingreso.php?cc=true" target="principal">Cambiar Clave</a>&nbsp;|&nbsp;
            

            <a href="#" onClick="myprint()">Imprimir</a>&nbsp;|&nbsp;

            <a href="acercade.php" target="principal" >Acerca de</a>

          	<!--&nbsp;|&nbsp<a href="consultas.php" target="principal">Consultas al WebMaster</a>-->

            </td>

    </tr>

	</table>

</body></html>

