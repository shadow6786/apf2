<?php @session_start();
include_once("funciones.php");

$ar = getdircontent('templates');

if(!is_null($ar) && !empty($ar))
{
 
 foreach ($ar as $key => $file) 
 {
	if($file != "." && $file != "..")
	{  
		$_SESSION["temp"] = $file;
		include("generar.php");
	}
 } 

unset($_SESSION["temp"]);

} 


?>