<?php 
include_once("../_BRL/directorios.ext.php");
$objdirectorio = new cdirectorios_ext;
$directorios = $objdirectorio->get_directorio_gestion();
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
            	<h3 class="no-space">Directorio</h3>
                <div class="margin-bottom-20">
                    <table class='table table-bordered'>
                        <tr>
                            <th>
                                Nombre
                            </th>
                            <th>Directorio</th>
                            <th>Archivo</th>
                        </tr>
                        <?php if(count($directorios)){
                            foreach ($directorios as $dir) { ?>
                                <tr>
                                    <td><?php echo $dir["nombre_dir"]; ?></td>
                                    <td><?php echo $dir["nombre_gst"]; ?></td>
                                    <td><?php if(!is_null($dir["archivo_dir"]) && $dir["archivo_dir"] !="" ){ echo "<a href='../archivos_archivo_dir/".$dir["archivo_dir"]."' target='_blank'>Ver archivo</a>"; }else{ echo "Sin archivo."; }?></td>
                                </tr>
                            <?php }
                            } ?>
                    </table>
                </div>
 			</div>
        </div>
        
    </div>
    <?php include_once("../web/_includes/footer.php");?>
</div>
</body>
</html>