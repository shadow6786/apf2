<?php

function ObtenerWhere($filtros)
{
	
	//print_r($filtros);
	
	$retorno = "";

	for ($row = 0; $row < count($filtros); $row++)
	{

		if (isset($filtros[$row]["Valor"]) && strlen($filtros[$row]["Valor"]) > 0 && strlen($filtros[$row]["Relacion"])>0 )
		{
			switch ($filtros[$row]["Relacion"])
			{
				case "=":
				{
					$retorno .=  $filtros[$row]["Campo"] . " = '" . $filtros[$row]["Valor"] . "' ";
					break;
				}
				case "!=":
				{
					$retorno .=  $filtros[$row]["Campo"] . " != '" . $filtros[$row]["Valor"] . "' ";
					break;
				}
				case "like":
				{
					$retorno .=  $filtros[$row]["Campo"] . " like '%" . $filtros[$row]["Valor"] . "%' ";
					break;
				}
				
				case "like_ini":
				{
					$retorno .=  $filtros[$row]["Campo"] . " like '" . $filtros[$row]["Valor"] . "%' ";
					break;
				}
				case "like_fin":
				{
					$retorno .=  $filtros[$row]["Campo"] . " like '" . $filtros[$row]["Valor"] . "%' ";
					break;
				}
				
			}
			$retorno .= " AND ";
		}
		 
	}
	//echo substr( $retorno, 0, strlen( $retorno) - 5);
	return substr( $retorno, 0, strlen( $retorno) - 5);
}

?>