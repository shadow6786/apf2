<?php 


if(isset($_POST["n"]))
{
	
	$handle = fopen("templates/".$_POST["n"].".php", "w");
	
	$x = $_POST["f"]."\n".$_POST["p"]."\n".
	$_POST["t"];
	
	fwrite($handle, $x);
	
	fclose($handle);
	
	header("Location:index.php");
	
}

?><form id="form1" name="form1" method="post" action="">
  <p>Nombre del Template<br />
    <label for="n"></label>
  <input type="text" name="n" id="n" />
  </p>
  <p>Folder del Template donde se crearan los archivos desde el root<em> (sin la barra inicial o final / )</em><br />
    <label for="f"></label>
    <input type="text" name="f" id="f" />
  </p>
  <p>Prefijo del nombre de Archivo<em></em><br />
    <label for="p"></label>
    <input type="text" name="p" id="p" />
  </p>
  <p>Template<br />
    <label for="t"></label>
    <textarea name="t" id="t" cols="65" rows="25">
</textarea>
  </p>
  <p>
    <input type="submit" name="button" id="button" value="Crear Template" />
  </p>
</form>
