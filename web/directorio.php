<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Asociacion Padres de Familia Colegio Aleman S.C.</title>
<?php include_once("../web/_includes/archivos.php");?>
<script type="text/javascript">
	$(document).ready(function(){
		$.getJSON('getip.php', function(data){
	 		alert('Your ip is: ' +  data.ip);
		});
	});
	
</script>

</head>
<body>
<div id="page">
    <div class="container">
        <?php include_once("../web/_includes/banner.php");?>
        <?php include_once("../web/_includes/menu.php");?>
        <?php include_once("../web/_includes/barras_laterales.php");?>
        <div class="maincontent">            
            <div class="content">
            	<h3 class="no-space">Directorio</h3>
 			</div>
            <div style="clear:both;height:0;font-size: 1px;line-height: 0px;"></div>
        </div>
        
    </div>
    <?php include_once("../web/_includes/footer.php");?>
</div>
</body>
</html>