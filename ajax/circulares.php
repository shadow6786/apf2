<?php 
include_once('../_BRL/circulares.ext.php');
$objcirculares = new ccirculares_ext;
if(isset($_POST) && $_POST != FALSE){
	if(isset($_POST["ges"]) && $_POST["ges"] != ""){
		$circulares = $objcirculares->get_circulares_gestion_tipo($_POST["ges"],$_POST["tip"]);
		$tabla = "<table class='table table-bordered'>
            		<tr>
            			<th>
            				#
            			</th>
            			<th>
            				Circular
            			</th>
            			<th>
            				Descargar
            			</th>
            		</tr>";
		if(count($circulares) > 0)
		{
            foreach ($circulares as  $cir) {
            	$archivo ="";
            	if(!is_null($cir["archivo_crc"]) && $cir["archivo_crc"] != "")
				{
					$archivo ="<a href='../archivos_archivo_crc/". $cir["archivo_crc"]."' target='_blank'>Ver archivo</a>";
				}
				else {
					$archivo = "Sin archivo";
				$tabla.= "<tr>
						<td>".$cir["id_crc"]."</td>
						<td>".$cir["nombre_crc"]."</td>
						<td>".$archivo."</td>
						</tr>";
				}
				$tabla.="</table>";
				echo $tabla;
			}
		}
		else{
			$tabla .= "<tr><td colspan='3'>No hay datos para mostrar.</td></tr></table>";
			echo $tabla;
		}
	}
}

?>