<?php 
@session_start();
unlink("conexiones/".$_GET["file"]);
unset($_SESSION["selfile"]);
header("Location:index.php");

?>