<?php $host = "localhost";
	
$ndb = "apf_bd";
$udb = "root";
$pdb = "";

$conn = mysql_pconnect($host, $udb, $pdb) or trigger_error(mysql_error(),E_USER_ERROR); 

mysql_select_db($ndb);

?>