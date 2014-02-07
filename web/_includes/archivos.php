<link href="../web/_css/bootstrap.min.css" rel="stylesheet">
<link href="../web/_css/base.css" rel="stylesheet">
<script type="text/javascript" src="../web/_js/jquery_1.9.1_min.js"></script>
<script type="text/javascript" src="../web/_js/jquery-ui-1.10.1.custom.min.js"></script>
<script type="text/javascript" src="../web/_js/bootstrap.min.js"></script>
<script type="text/javascript">
<?php 
$pag =  strtok($_SERVER["REQUEST_URI"],'?');
$arr_pag = explode('/', $pag);

if (count($arr_pag) > 0)
{
	$pag = $arr_pag[count($arr_pag) -1];
}
?>
	$(document).ready(function(){
		var pag = "<?php echo $pag;?>";
		switch(pag)
				{
					case "index.php":
					{
						$('#m_quienessomos').addClass('active');
						break;
					}
					case "directorio.php":
					{
						$('#m_directorio').addClass('active');
						break;
					}
					case "estatutos.php":
					{
						$('#m_estatutos').addClass('active');
						break;
					}
					case "circulares.php":
					{
						$('#m_circulares').addClass('active');
						break;
					}
					case "actividades.php":
					{
						$('#m_actividades').addClass('active');
						break;
					}
					case "accionsocial.php":
					{
						$('#m_accionsocial').addClass('active');
						break;
					}
					case "poleras.php":
					{
						$('#m_poleras').addClass('active');
						break;
					}
					case "login.php":
					{
						break;
					}
					case "contacto.php":
					{
						break;
					}
					default:
					{
						$('#m_quienessomos').addClass('active');
						break;
					}
				}
	});
</script>