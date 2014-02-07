<?php
function pdf2file($file, $html)
{
	require_once("../dompdf/dompdf_config.inc.php");

	if(strstr(strtolower($html),"html") && strstr(strtolower($html),"body") && $html != "" && strstr(strtolower($file),".pdf"))
	{
		
		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->render();

		$output = $dompdf->output();
				
		file_put_contents($file, $output);
		
		$ret = true;
		
	} else 
	{
		$ret = false;
	}
	
	return $ret;
}

function pdf2download($file, $html)
{
	require_once("../dompdf_config.inc.php");

	if(strstr(strtolower($html),"html") && strstr(strtolower($html),"body") && $html != "" && strstr(strtolower($file),".pdf"))
	{

		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream($file);

		$ret = true;

	} else {
		
		$ret = false;
		
	}
	
	return $ret;
}
?>