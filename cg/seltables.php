<?php session_start();

$i = 0;

foreach($_POST["seltable"] as $value)
{

$i++;

$_SESSION["x".$i] = $value;

}

$_SESSION["x0"] = $i;

header("location:index.php");
	
?>