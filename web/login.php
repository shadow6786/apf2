<?php
@session_start();

include_once("../_DAL/conexion.php");
include_once('../_UTL/seguridad.php');
include_once('../_UTL/funcionesUI.php');
$configuracion = new configuracion();

if(isset($_SESSION['usrlogin']))
{
	$seguridad = unserialize($_SESSION['usrlogin']);
} 
else 
{
	$seguridad = new CSecurity();
}

$nombre = "";
$clave = "";
$logueado = false; 
if (isset( $_POST['usuario'])) {	$nombre = $_POST['usuario']; }
if (isset($_POST['pass'])){ $clave = $_POST['pass']; }
if ($nombre != "")
{
	$seguridad = new CSecurity();
	
	$seguridad->username = $nombre;
	$seguridad->password = $clave;

	if($seguridad->login())
	{
		header("location: circulares.php");
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Asociacion Padres de Familia Colegio Aleman S.C.</title>
<?php include_once("../web/_includes/archivos.php");?>
<script language="JavaScript" src="../js/md5.js"></script>
<script type="text/javascript">
	function encriptar_clave(campo)
    {
		var txtval = new String(campo.value);
	    lenvar = txtval.length;
		if((txtval != '') && (lenvar < 32) )
		{
           	campo.value = md5(txtval);
		}
	}
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
            	<?php
            	if ($seguridad->loggued == "N")
				{
            	?>
				<h3 class="no-space">Inicie Sesión</h3>
				<div class="form-contact">
					<form id="form_login" name="form_login" action="" enctype="multipart/form-data" method="post" onsubmit="encriptar_clave(document.form_login.pass);">
						<table width="100%" cellpadding="2" cellspacing="2">
							<tr>
								<td>
									Usuario
								</td>
								<td>
									<input type="text" autocomplete="off" id="usuario" name="usuario" />
								</td>
							</tr>
							<tr>
								<td>
									Contrase&ntilde;a
								</td>
								<td>
									<input type="password" autocomplete="off" id="pass" name="pass" />
								</td>
							</tr>
							
						</table>
						<div style="text-align: center">
							<button type="suubmit" class="btn btn-inverse">Ingresar</button>
							<button type="reset" class="btn">Limpiar</button>
						</div>
					</form>
				</div>
				<?php
				}
				else
				{
				?>
				<h3 class="no-space">Bienvenido <?php echo $seguridad->nombre;?></h3>
				<div>
					
				</div>
				<?php
				}
				?>
 			</div>
            <div class="clear"></div>
        </div>        
    </div>
    <?php include_once("../web/_includes/footer.php");?>
</div>
</body>
</html>