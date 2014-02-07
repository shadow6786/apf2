<?php if(isset($_GET["temp"])) {

		 $_SESSION["temp"] = $_GET["temp"]; 

	 }?>

<?php if(isset($_SESSION["temp"]))
{ 

	echo "<hr /> <strong>".$_SESSION["temp"]."</strong><hr>";

}?>

<a href="template_new.php">Crear Nuevo</a><hr />

<?php 

$ar = getdircontent('templates');

if(!is_null($ar) && !empty($ar))
{
foreach ($ar as $key => $file) 
{
?>

<a href="?temp=<?php echo $file; ?>"> <?php echo $file; ?></a> &nbsp;&nbsp;&nbsp;<a href="template_borrar.php?file=<?php echo $file; ?>" onclick="return(confirm('Estas seguro que deseas borrar este archivo?\n\n<?php echo $file; ?>\n'));">Borrar</a><br />

<?php } } ?>