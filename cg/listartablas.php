<hr>
<script defer="defer" language="javascript" type="text/javascript">
function selectToggle(toggle, form) {
     var myForm = document.forms[form];
     for( var i=0; i < myForm.length; i++ ) { 
          if(toggle) {
               myForm.elements[i].checked = "checked";
          } 
          else {
               myForm.elements[i].checked = "";
          }
     }
}
</script>
<input name="" type="button" value="Seleccionar Todos" onclick="selectToggle(true, 'f1'); document.getElementById('f1').submit();" />
<form action="seltables.php" method="post" name="f1" id="f1">
<?php 
@session_start();

if(isset($_SESSION["x0"]))
{ 

	for($i = 1;$i <= $_SESSION["x0"]; $i++)
	{
		echo " <strong>".$_SESSION["x".$i]."</strong><br>";
	}
	
	echo "<hr />";

}
echo '<input name="" type="submit" value="Seleccionar"><br>';

$sql = "SHOW TABLES FROM $ndb";
$r = mysql_query($sql);

if($row = mysql_fetch_assoc($r))
{

$x = "";

foreach($row as $k => $v)
{
	$x = $k;
}

do{

echo '<input name="seltable[]" id="seltable[]" type="checkbox" value="'.$row[$x].'">'.$row[$x]."<br>\n";

}while($row = mysql_fetch_assoc($r));

} else { echo "No se encontraron tablas";}


?></form>