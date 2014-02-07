<?php 

function getdircontent($dir) 
{
	$files = "";
	$d = dir($dir); 
	while (false !== ($file = $d->read())) 
	{
		if($file != "." && $file != "..")
		{
			$files[$file] = $file; 
		}
	}

	$d->close(); 
	if($files != "")
	{
		asort($files);
	}
	
	return $files;

}

?>