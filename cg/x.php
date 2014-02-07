<?php 

$ndb = "db";
$udb = "root";
$pdb = "";

$conn = mysql_pconnect("localhost", $udb, $pdb) or trigger_error(mysql_error(),E_USER_ERROR); 

	mysql_select_db("information_schema");

	//	$tbl["t".$i][0] = $_SESSION["x".$i];
	$sqlss = "SELECT * FROM KEY_COLUMN_USAGE WHERE TABLE_NAME LIKE 'ven_precios' AND COLUMN_NAME LIKE 'ilistaprecio_fk'";
	$rss = mysql_query($sqlss) or die (mysql_error());
	$rowss = mysql_fetch_assoc($rss);	
	
	$tableref = $rowss["REFERENCED_TABLE_NAME"];
	$pkref = $rowss["REFERENCED_COLUMN_NAME"];
	
	mysql_free_result($rss);

	mysql_select_db($ndb);
	$sqlss = "show full columns from $tableref";
	$rss = mysql_query($sqlss) or die (mysql_error()) ;
	$rowss = mysql_fetch_assoc($rss);	
	
	do{
		
	}while($pkref != $rowss["Field"] && $rowss = mysql_fetch_assoc($rss));
	
	$rowss = mysql_fetch_assoc($rss);
	
	print_r($rowss);
	echo "<br />";

	mysql_free_result($rss);


?>