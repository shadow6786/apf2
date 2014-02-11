<?php 
include_once("../_BRL/registropadres.ext.php");
$objregistro = new cregistropadres_ext;
$id = 0;
$msg = "";
$err = "";
if(isset($_POST) && $_POST != FALSE)
{
	$objregistro->nombrepadre_rgp = $_POST["nombrepadre"];
	$objregistro->nombremadre_rgp = $_POST["nombremadre"];
	$objregistro->nombrealumno_rgp = $_POST["nombreestudiante"];
	$objregistro->curso_rpg = $_POST["curso"];
	$objregistro->correo1_rgp = $_POST["correo"];
	$objregistro->usuario_ins = 0;
	$objregistro->usuario_mod = 0;
	$objregistro->fechahora_mod = date("Y-m-d H:i:s");
	$objregistro->fechahora_ins= date("Y-m-d H:i:s");

	$objregistro->insertar();
	$id = $objregistro->id_rgp;
	if($id > 0)
	{
		$msg ="Registro procesado correctamente.";
	}
	else
	{
		$err = "Ocurrio un error durante el preceso, vuelve a intentarlo en unos minutos.";
	}
}

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
				<h3 class="no-space">Formulario de Registro de padres</h3>

				<?php if(strlen($err) > 0){ ?>
                        <div class="alert alert-error">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><i class="icon-exclamation-sign"></i></strong> <?php echo $err; ?>
                        </div>
                    <?php } 
                    if(strlen($msg)>0){ ?>
						 <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><i class="icon-exclamation-sign"></i></strong> <?php echo $msg; ?>
                        </div>
                    <?php }
                    ?>
                
				<div class="margin-bottom-20">
					<form class="form-inline" method="post" action="">
						<table  border="0">
							<tr>
								<td width="30%" height="37"><div align="right"><strong>Nombre Padre:</strong></div></td>
								<td width="357"><label>
									<input name="nombrepadre" type="text"  id="nombrepadre" size="35" required/>
									</label></td>
							</tr>
							<tr>
								<td width="30%" height="37"><div align="right"><strong>Nombre Madre</strong></div></td>
								<td><label>
									  <input name="nombremadre" type="text" id="nombremadre" size="35" required/>
									</label>
								</td>
							</tr>
							<tr>
								<td width="30%" height="41"><div align="right"><strong>Nombre Estudiante:</strong></div></td>
								<td><label>
								  <input name="nombreestudiante" type="text" id="nombreestudiante" size="35" required/>
							  </label></td>
							</tr>
							  <tr>
								<td width="30%" height="33"><div align="right"><strong>Curso:</strong></div></td>
								<td><label>
								  <input type="text" name="curso" id="curso" required/>
								<br />
								</label></td>
							</tr>
							<tr>
								<td width="30%" height="42"><div align="right"><strong>Su Email:</strong></div></td>
								<td><label>
								  <input name="correo" type="text" id="correo" size="35" required/>
								</label></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td><input type="submit" name="enviar" id="enviar" value="Registrar" />
								<input type="reset" name="reset" id="reset" value="Limpiar" /></td>
							</tr>
						</table>
					</form>
					<p>Una vez registrado en la base de datos, para cambiar o actualizar la informacion debe hacerlo mediante el menu de <a href="contacto.php">contacto</a> o enviando un correo a <a href="mailto:apfcolegioaleman2011@gmail.com">apfcolegioaleman2011@gmail.com</a>, especificando el dato a actualizar.</p>
				</div>
			</div>
			<div class="clear"></div>
		</div>        
	</div>
	<?php include_once("../web/_includes/footer.php");?>
</div>
</body>
</html>