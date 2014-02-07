<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Generador de Codigo</title>
</head>

<body> 
<div style="height:450px; width:150px; float:left; clear:left; margin-right:10px;">
<h3>CONEXION</h3>
<?php include("conexion.php");?>
</div>

<div style="height:450px; width:250px; float:left; margin-right:10px; overflow:scroll; margin-right:10px;">
<h3>TABLAS</h3>
<?php include("listartablas.php");?>
</div>

<div style="height:450px; width:250px; margin-right:10px; overflow:scroll; margin-right:10px;">
<h3>TEMPLATES</h3>
<?php include("template.php");?>
</div>

<?php if(isset($_SESSION["selfile"])) { ?>
<hr /> <a href="menu.php">Generador de Menus! </a> <hr />
<?php } ?>

<?php if(isset($_SESSION["selfile"]) && isset($_SESSION["x0"]) ) { ?>
<hr /> <a href="generar_todos.php">Generar Codigo de TODOS LOS TEMPLATES! </a> <hr />
<?php } ?>

<?php if(isset($_SESSION["selfile"]) && isset($_SESSION["x0"]) && isset($_SESSION["temp"])) { ?>
<hr /> <a href="generar.php">Generar Codigo ! </a> <hr />
<?php } ?></body>
</html>