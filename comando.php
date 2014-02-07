<?php
	$servidor="mysql5.000webhost.com";
	$usuario="a1692580_admin2";
	$pass="shadow6786";
	$bd="a1692580_bdapf2";
    $conexcion=mysql_connect($servidor,$usuario,$pass);
	
    echo mysql_select_db($bd);
   
?> 