<?php

function SubirImagen($inputfile,$ruta,$tamanomax,$anchomax,$altomax,$hacerimagenligera,$anchoimagenligera,$altoimagenligera)
{
	$nombre_archivo = $inputfile['name'];
	$tipo_archivo = $inputfile['type'];
	$tamano_archivo = $inputfile['size'];
	list($ancho_archivo, $alto_archivo) = getimagesize($inputfile['tmp_name']); 
						
	$nombre_archivo = limpiarNombreArchivo($nombre_archivo); 
		
	if ($tamano_archivo<= ( $tamanomax*1024) )
	{
		if ($tipo_archivo == "image/pjpeg" || $tipo_archivo == "image/jpeg" || $tipo_archivo == "image/gif" || $tipo_archivo == "image/png" )
		{
			if ( $ancho_archivo < $anchomax || $alto_archivo < $altomax )
			{
				if(move_uploaded_file($inputfile['tmp_name'], $ruta."/".date('Ymd'). '-' .$nombre_archivo))
				{
					if ($hacerimagenligera == true)
					{
						if (file_exists($ruta."/".date('Ymd'). "-" .$nombre_archivo))
						{ 
								
								switch ($tipo_archivo)
								{
								case "image/jpeg":
								{	
									$fuente = imagecreatefromjpeg( $ruta. "/".date('Ymd'). "-".$nombre_archivo); 
									$imgAncho = imagesx ($fuente); 
									$imgAlto =imagesy($fuente); 
									$imagen = imagecreatetruecolor($anchoimagenligera ,$altoimagenligera); 
									ImageCopyResized($imagen,$fuente,0,0,0,0,$anchoimagenligera,$altoimagenligera,$imgAncho,$imgAlto); 
									imagejpeg($imagen,$ruta. "/" . date('Ymd'). "-il-" .  $nombre_archivo,100); 
									break;
								}
								case "image/gif":
								{	
									$fuente = imagecreatefromgif( $ruta. "/".date('Ymd'). "-".$nombre_archivo); 
									$imgAncho = imagesx ($fuente); 
									$imgAlto =imagesy($fuente); 
									$imagen = imagecreatetruecolor($anchoimagenligera ,$altoimagenligera); 
									ImageCopyResized($imagen,$fuente,0,0,0,0,$anchoimagenligera,$altoimagenligera,$imgAncho,$imgAlto); 
									imagegif($imagen,$ruta. "/" . date('Ymd'). "-il-" .  $nombre_archivo,100); 
									break;
								}
								case "image/png":
								{	
									$fuente = imagecreatefrompng( $ruta. "/".date('Ymd'). "-".$nombre_archivo); 
									$imgAncho = imagesx ($fuente); 
									$imgAlto =imagesy($fuente); 
									$imagen = imagecreatetruecolor($anchoimagenligera ,$altoimagenligera); 
									ImageCopyResized($imagen,$fuente,0,0,0,0,$anchoimagenligera,$altoimagenligera,$imgAncho,$imgAlto); 
									imagepng($imagen,$ruta. "/" . date('Ymd'). "-il-" .  $nombre_archivo); 
									break;
								}
							}
						
							ImageCopyResized($imagen,$fuente,0,0,0,0,$anchoimagenligera,$altoimagenligera,$ancho_archivo,$alto_archivo); 
							imagedestroy($fuente);
							imagedestroy($imagen); 
		
						}
						else
						{
							throw new Exception("Ocurrió un error haciendo la imagen ligera"); 
						}
			
					}
				}
				else
				{
					throw new Exception("Ocurrió un error, no se pudo subir el archivo"); 
				}
			}
			else
			{
				throw new Exception("Las dimensiones del archivo pueden ser como máximo " .$anchomax . " de ancho y " . $altomax . " de alto." ); 
			}
		}
		else
		{
			throw new Exception("La extensión del archivo debe ser: jpg, gif o png"); 
		}
	}
	else
	{
		throw new Exception("Archivo excede los ".$tamanomax." Kb. de Peso. Reduzca el tamaño y vuelva a intentarlo."); 
	}
	
}


function SubirArchivo($inputfile,$ruta,$tamanomax)
{
	

	
	
	$nombre_archivo = $inputfile['name'];
	$tipo_archivo = $inputfile['type'];
	$tamano_archivo = $inputfile['size'];
	
	$nombre_archivo = limpiarNombreArchivo($nombre_archivo); 
	
	if ($tamano_archivo<= ( $tamanomax*1024) )
	{
				
		if(!move_uploaded_file($inputfile['tmp_name'], $ruta."/".date('Ymd'). '-' . $nombre_archivo))
		{
			throw new Exception("Ocurrió un error, no se pudo subir el archivo"); 
		}
	}
	else
	{
		throw new Exception("Archivo excede los ".$tamanomax." Kb. de Peso. Reduzca el tamaño y vuelva a intentarlo."); 
	}
	
}

function limpiarNombreArchivo($nombre_archivo)
{
	$nombre_archivo = str_replace("-","",$nombre_archivo);
	$nombre_archivo = str_replace("á","a",$nombre_archivo);
	$nombre_archivo = str_replace("é","e",$nombre_archivo);
	$nombre_archivo = str_replace("í","i",$nombre_archivo);
	$nombre_archivo = str_replace("ó","o",$nombre_archivo);
	$nombre_archivo = str_replace("ú","u",$nombre_archivo);
	$nombre_archivo = str_replace("ñ","n",$nombre_archivo);
	$nombre_archivo = str_replace("Á","A",$nombre_archivo);
	$nombre_archivo = str_replace("É","E",$nombre_archivo);
	$nombre_archivo = str_replace("Í","I",$nombre_archivo);
	$nombre_archivo = str_replace("Ó","O",$nombre_archivo);
	$nombre_archivo = str_replace("Ú","U",$nombre_archivo);
	$nombre_archivo = str_replace("Ñ","N",$nombre_archivo);
	$nombre_archivo = str_replace(" ","",$nombre_archivo);
	
	return $nombre_archivo;
}
?>