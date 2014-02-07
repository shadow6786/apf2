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
            	<h3 class="no-space">Formulario de contacto</h3>
				<div class="form-contact">
					<form id="frm_contacto" name="frm_contacto" method="post" action="enviar.php">
						<table width="100%" cellpadding="2px" cellspacing="2px">
							<tr>
								<td>
									Su email
								</td>
								<td>
									<input type="text" class="input-block-level" />
								</td>
							</tr>
							<tr>
								<td>
									Nombre del padre
								</td>
								<td>
									<input type="text" class="input-block-level" />
								</td>
							</tr>
							<tr>
								<td>
									Nombre del estudiante
								</td>
								<td>
									<input type="text" class="input-block-level" />
								</td>
							</tr>
							<tr>
								<td>
									Curso
								</td>
								<td>
									<input type="text" class="input-block-level" />
								</td>
							</tr>
							<tr>
								<td>
									Asunto
								</td>
								<td>
									<input type="text" class="input-block-level" />
								</td>
							</tr>
							<tr>
								<td>
									Destinatario
								</td>
								<td>
									<input type="text" class="input-block-level" value="apfcolegioaleman2011@gmail.com" readonly="readonly" />
								</td>
							</tr>
							<tr>
								<td>
									Mensaje
								</td>
								<td>
									<textarea class="input-block-level" style="height: 150px;"></textarea>
								</td>
							</tr>
						</table>
						<div style="text-align: center">
							<button type="reset" class="btn">Enviar</button>
							<button type="submit" class="btn">Limpiar</button>
						</div>
					</form>
				</div>
 			</div>
            <div class="clear"></div>
        </div>        
    </div>
    <?php include_once("../web/_includes/footer.php");?>
</div>
</body>
</html>