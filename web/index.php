<?php
include_once("../_BRL/paginaprincipal.ext.php");
$objpaginap = new cpaginaprincipal_ext;

$arr_paginap = $objpaginap->obtener_contenidoprincipal();
$content = $arr_paginap["0"]["descripcion_ppl"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Asociacion Padres de Familia Colegio Aleman S.C.</title>
<?php include_once("../web/_includes/archivos.php");?>

</head>
<body>
<div id="page">
    <div class="container">
        <?php include_once("../web/_includes/banner.php");?>
        <?php include_once("../web/_includes/menu.php");?>
        <?php include_once("../web/_includes/barras_laterales.php");?>
        <div class="maincontent">            
            <div class="content">            	
            	<?php
					echo utf8_encode($content);
				?>
 			</div>
            <div class="clear"></div>
        <?php include_once("../web/_includes/footer.php");?>  
        </div>  
    </div>
</div>
</body>
</html>