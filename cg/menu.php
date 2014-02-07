<?php 
@session_start();

include_once("conexiones/".$_SESSION["selfile"]);

$sql = "SHOW TABLES FROM $ndb";
$r = mysql_query($sql);

if($row = mysql_fetch_assoc($r))
{

	$x = "";

	foreach($row as $k => $v)
	{
		$x = $k;
	}
$i = 1;
$ii = 0;
$ant = "yyy";
$act = "xxx";
	echo "
	INSERT INTO `seg_roles` (`id_rol`, `nombre_rol`, `activo_rol`, `fechahora_mod`, `fechahora_ins`, `usuario_mod`, `usuario_ins`) VALUES
(1, 'Administrador', 'S', now(), now(), 0, 0);<br />
<br />
	INSERT INTO `vetlab`.`seg_usuarios` (`id_usr`, `nombreusuario_usr`, `clave_usr`, `claveanterior_usr`, `persona_usr`, `fechahora_mod`, `fechahora_ins`, `usuario_mod`, `usuario_ins`, `rol_usr`) VALUES (NULL, 'admin', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', '0', now(), now(), '0', '0', 'S');<br />
<br />
INSERT INTO `seg_opcionesmenu` (`id_opm`, `nombre_opm`, `ruta_opm`, `opcionpadre_opm`, `fechahora_mod`, `fechahora_ins`, `usuario_mod`, `usuario_ins`) VALUES 
<br>
($i, 'Inicio', '#', 0, '2011-07-25 09:00:00', '2011-07-25 09:00:00', 1, 1);<br /><br /><br />	<br />	
	<br />	<br />
	<br /><br />
	
	DELETE FROM `seg_opcionesmenu` WHERE `seg_opcionesmenu`.`id_opm` <> `opcionpadre_opm` and `opcionpadre_opm` <> 1;<br />
	DELETE FROM `seg_opcionesmenu` WHERE `id_opm` <> 1 and `opcionpadre_opm` = 1;<br />
	
	TRUNCATE `seg_permisos`;<br />
	<br /><br />
<br />
	";
	
	echo "INSERT INTO `seg_opcionesmenu` (`id_opm`, `nombre_opm`, `ruta_opm`, `opcionpadre_opm`, `fechahora_mod`, `fechahora_ins`, `usuario_mod`, `usuario_ins`) VALUES ";
	echo "<br>";
	$xcoma = "";
	do{
		$i++;
		$z = preg_split("/_/",$row[$x]);
		$ruta =  "/".$z[0]."/".$z[1].".php";
		$act = $z[0];
		if($act != $ant) {
			$ant = $act;
			$ii = $i;
			echo "$xcoma($i, '$act', '#',1, now(), now(), 1, 1)";
			echo "<br>";
			$i++;
		}
	    $xcoma = ",";
		echo "$xcoma($i, '".$z[1]."', '$ruta', $ii, now(), now(), 1, 1)";
		echo "<br>";		
		
	}while($row = mysql_fetch_assoc($r));

	echo "; <br>
<br>
insert into seg_permisos (`opcionmenu_per`,`rol_per`, `fechahora_mod`, `fechahora_ins`, `usuario_mod`, `usuario_ins`) SELECT id_opm, 1, now(),now(),1,1 FROM `seg_opcionesmenu` ;";
		
} else { 

	echo "No se encontraron tablas";
	
}


?>