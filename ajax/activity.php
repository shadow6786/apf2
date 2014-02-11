<?php
include_once("../_BRL/actividades.ext.php");

$objactividades = new cactividades_ext;

if(isset($_GET["gestion"]))
{
	$arr = $objactividades->obteneractividades($_GET["gestion"]);
	//print_r($arr);
	if(count($arr) > 0)
	{
		$tabla = "<table class='table table-bordered'>
            		<tr>
            			<th>
            				Actividad
            			</th>
            			<th>
            				Descripci&oacute;n
            			</th>
            			<th>
            				Descargar
            			</th>
            		</tr>";
		foreach ($arr as $row) {
			$desc = substr($row["descripcion_act"], 0,100);
			$desc = utf8_encode($desc)."...";
			$archivo = "";
			if(!is_null($row["archivo_act"]) && $row["archivo_act"] != "")
			{
				$archivo ="<a href='../archivos_archivo_act/". $row["archivo_act"]."' target='_blank'>Ver archivo</a>";
			}
			else {
				$archivo = "Sin archivo";
			}
			$tabla.= "<tr>
						<td>".$row["nombre_act"]."</td>
						<td>".$desc."</td>
						<td>".$archivo."</td>
			</tr>";
		}
		$tabla.="</table>";
		echo $tabla;
	}
}
?>
