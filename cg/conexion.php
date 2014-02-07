<?php @session_start(); include_once("funciones.php");?>
<?php if(isset($_GET["file"])) {
	 $_SESSION["selfile"] = $_GET["file"]; 
	 $_SESSION["x0"] = 0;
	 unset($_SESSION["x0"]);
	 }?>

<?php if(isset($_SESSION["selfile"]))
{ 

	echo "<hr /> <strong>".$_SESSION["selfile"]."</strong><hr>";

}?>

<a href="conexion_nueva.php">Crear Nueva</a><hr />

<?php 

$ar = getdircontent('conexiones');

if(!empty($ar))
{
foreach ($ar as $key => $file) 
{
?>

<a href="?file=<?php echo $file; ?>"> <?php echo $file; ?></a> &nbsp;&nbsp;&nbsp;<a href="conexion_borrar.php?file=<?php echo $file; ?>" onclick="return(confirm('Estas seguro que deseas borrar este archivo?\n\n<?php echo $file; ?>\n'));">Borrar</a><br />

<?php } } ?>

<hr>

<?php  if(isset($_SESSION["selfile"])) { include("conexiones/".$_SESSION["selfile"]); } ?>
