<?php 

if(isset($_POST["db"]))
{
	
	$handle = fopen("conexiones/".$_POST["db"].".php", "w");
	
	$x = '<?php $host = "'.$_POST["sdb"].'";
	
$ndb = "'.$_POST["ndb"].'";
$udb = "'.$_POST["udb"].'";
$pdb = "'.$_POST["pdb"].'";

$conn = mysql_pconnect($host, $udb, $pdb) or trigger_error(mysql_error(),E_USER_ERROR); 

mysql_select_db($ndb);

?>';
	
	fwrite($handle, $x);
	
	fclose($handle);
	
	header("Location:index.php");
	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Generador de codigo</title>
</head>

<body>

<label for="textfield"></label>
<form id="form1" name="form1" method="post" action="">
  <p>Nombre de la Conexion:
    <input name="db" type="text" id="db" value="conn_" />
  </p>
  <p>
    Servidor:
      <input name="sdb" type="text" id="sdb" value="localhost" />
  </p>
  <p>Usuario de la Base de Datos:
    <input type="text" name="udb" id="udb" />
</p>
  <p>Contraseña de la Base de Datos:
    <input type="text" name="pdb" id="pdb" />
</p>
  <p>Nombre de la Base de Datos:
    <input type="text" name="ndb" id="ndb" />
</p>
  <p>
    <input type="submit" name="button" id="button" value="Crear Coneccion" />
  </p>
</form>
</body>
</html>