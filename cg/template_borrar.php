<?php 
@session_start();
unlink("templates/".$_GET["file"]);
unset($_SESSION["temp"]);
header("Location:index.php");

?>