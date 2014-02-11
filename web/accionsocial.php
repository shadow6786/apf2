<?php 
include_once("../_BRL/accionsocial.ext.php");
$objaccionsocial = new caccionsocial_ext;
$accionsocial = $objaccionsocial->buscararr(0,'S');
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
            	<h3 class="no-space">ACCION SOCIAL</h3> 
                <div class="margin-bottom-20">
                    <table class='table table-bordered'>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                Evento
                            </th>
                            <th>
                                Enlace
                            </th>
                        </tr>
                        <?php if(count($accionsocial) > 0){ 
                            foreach ($accionsocial as $acc) { ?>
                                <tr>
                                    <td><?php echo $acc["id_acs"]; ?></td>
                                    <td><?php echo $acc["nombre_acs"]; ?></td>
                                    <td><?php if(!is_null($acc["archivo_acs"]) && $acc["archivo_acs"] != ""){ echo "<a href='../archivos_archivo_acs/".$acc["archivo_acs"]."' target='_blank'>Ver Archivo</a>"; }else{ echo "Sin archivo."; } ?></td>
                                </tr>
                            <?php }
                        } ?>
                    </table>
                </div>              
 			</div>
            <div class="clear"></div>
        </div>
        
    </div>
    <?php include_once("../web/_includes/footer.php");?>
</div>
</body>
</html>