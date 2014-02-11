<?php
include_once("../_BRL/actividades.ext.php");
include_once("../_BRL/gestiones.ext.php");
include_once("../_UTL/funcionesUI.php");

$objactividades = new cactividades_ext;
$objgestiones = new cgestiones_ext;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Asociacion Padres de Familia Colegio Aleman S.C.</title>
<?php include_once("../web/_includes/archivos.php");?>
<script type="text/javascript" src="../js/ajax.js"></script>
<script>
	$(document).ready(function(){
		$('#gestion_act').css('margin-top','10px');
		$('#mostrar').click(function(){
			var gestion = $('#gestion_act').val();
		});
		$('#gestion_act').change(function(){
			var valor = $('#gestion_act').val();
			if(valor == 0)
			{	alert("Seleccione una opción diferente."); $('#actividades').html(); return false; }
			else{
				get_actividades(valor);
				}
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
            	<h3 class="no-space">Actividades</h3>
            	<div>
            		Seleccione una gesti&oacute;n &nbsp;
					<?php echo HacerCombo('gestiones','id_gst','nombre_gst',$objactividades->gestion_act,'gestion_act','');?>&nbsp;
				</div>	
				<br />	
				<div id="actividades" style="display: none"></div>
            	
 			</div>
            <div class="clear"></div>
        </div>
        
    </div>
    <?php include_once("../web/_includes/footer.php");?>
</div>
</body>
</html>