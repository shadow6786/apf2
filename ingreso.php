<?php
include_once("_DAL/conexion.php");
include_once('_UTL/seguridad.php');
include_once('_UTL/funcionesUI.php');

@session_start();
$u = "";
if(isset($_GET["u"])) { $u =  $_GET["u"]; }
 
$configuracion = new configuracion();

if(isset($_SESSION['usrlogin']))
{
	$seguridad = unserialize($_SESSION['usrlogin']);
} 
else 
{
	$seguridad = new CSecurity();
}

	
if(isset($_GET['action']))
{
	if($_GET['action'] == 'forgot')
	{
		$u = $seguridad->url_requested;
		$seguridad = new CSecurity();
		$seguridad->url_requested = $u;
		$seguridad->recoverpassword($_GET['e']); 
	}

	if($_GET['action'] == 'logout')
	{
		$seguridad->logout();
		$seguridad = new CSecurity();
		header("location: ingreso.php");
	}

} else {


 $nombre = "";
 $clave = "";
 if (isset( $_POST['txtNombre'])) {	$nombre = $_POST['txtNombre']; }
 if (isset($_POST['txtClave'])){ $clave = $_POST['txtClave']; }

 if ($nombre != "")
 {
	$u = $seguridad->url_requested;
	
	$seguridad = new CSecurity();
  
	$seguridad->url_requested = $u;
	
	$seguridad->username = $nombre;
	$seguridad->password = $clave;
	  
	if($seguridad->login())
	{
		$seguridad->gotourl();
	}
  }

}
			
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title><?php echo $configuracion->nombre_empresa ?> - Admin</title>
        <script language="JavaScript" src="js/md5.js"></script>
        <script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
        <script language="JavaScript" src="js/jquery.metadata.js"></script>
        <script language="JavaScript" src="js/jquery.validate.js"></script>
        <link rel="stylesheet" href="css/mgEstiloAdmin.css" type="text/css">
        <link type="text/css" href="css/redmond/jquery-ui-1.8.14.custom.css" rel="stylesheet" />
        <style type="text/css"> 
        body {
		font: 62.5% "Trebuchet MS", sans-serif;
		margin: 0px;
		}
		#form_autentificacion {  
		margin:0 auto 0 auto; width:550px;  position:absolute;
		top:50%;  left: 50%;
		margin-top: -150px;
		margin-left: -275px;
		font-size:12px;
		}
		.titulo
		{
		font-size:xx-large; font-weight:bold;
		padding: 5px;
		background:#f2f2f2 url(img/bkg_body.gif) 0 0 repeat;
		color:#ffaf0f;
		}
		.menu
		{
		background-color:#555555;
		padding: 2px;
		font-size:10px;	color:#fff}
		#form_autentificacion  label.error { color: red; }
		#btnIngresar { cursor:pointer}
		#btnrecuperar { cursor:pointer}
		</style> 
        <script type="text/javascript">
        $().ready(function() {
            $("#form_autentificacion").validate({
                errorLabelContainer: $("#form_autentificacion div.error")
            });
            $(".cancel").click(function() {
                validator.resetForm();
            });
            
        });
		
		$(function(){
			$('#btnIngresar, #btnrecuperar').hover(
			function() { $(this).addClass('ui-state-hover'); }, 
			function() { $(this).removeClass('ui-state-hover'); }
			);
			
			});
	
        //Encripta el Password para enviarlo al Servidor en MD5
        function encriptar_clave(campo)
        {
			var txtval = new String(campo.value);
			
	        lenvar = txtval.length;
	
			if((txtval != '') && (lenvar < 32) )
			{
            	campo.value = md5(txtval);
			}
			
        }
		
		function abrirrecordatorioclave()
		{
			var div_recordatorio = document.getElementById('fp');
			
			if (div_recordatorio.style.display == "none") 
			{
				div_recordatorio.style.display = "block"; 
			}
			else
			{
				div_recordatorio.style.display = "none"; 
			}
			return false;	
		}
		
        </script> 
    </head>
    <body>
        <!-- Formulario de autentificaci�n  -->
        <table cellpadding="0" cellspacing="0" height="81px" width="100%">
	<tr>
		<td class="titulo"><span id="nombreempresa"><?php echo $configuracion->nombre_empresa ?></span></td>
     </tr>
     <tr>
        <td class="menu">&nbsp;   
        	
            </td>
	</tr>
	</table>
             
        <form action="ingreso.php" method="post" id="form_autentificacion" enctype="multipart/form-data" onsubmit="encriptar_clave(document.form_autentificacion.txtClave);" name="form_autentificacion">
        <fieldset> 
                <legend>Auntentificaci&oacute;n</legend>      
        <table>
            <tr>
                <td>Usuario: </td>
                <td><input id="txtNombre" autocomplete="off" name="txtNombre" type="text" title="*" class="{required:true,minlength:5}" /></td>
                <td>&nbsp;</td>
                <td>Clave: </td>
                <td><input id="txtClave" autocomplete="off" name="txtClave" type="password" title="*" class="{required:true,minlength:5}" /></td>
                <td><input type="submit" id="btnIngresar"  class="ui-state-default ui-corner-all dialog_link"  name="btnIngresar" value="Ingresar" /></td>
            </tr>
           
            <tr>
                <td colspan="6"><a id="link_abre_div_recordatorio" href="#" onclick="javascript:abrirrecordatorioclave()">�No recuerdas tu usuario y/o clave?</a></td>
            </tr>
          </table>
<div id='fp' style="display:none;">
<table>
            <tr>
                <td>Correo Electr&oacute;nico: </td>
                <td><input id="txtemail" type="text" /></td>
                <td>
                <input type="button" class="ui-state-default ui-corner-all dialog_link" id="btnrecuperar"  name="btnrecuperar" value="Recordar Contrase�a" onclick="window.open('index.php?action=forgot&e='+document.getElementById('txtemail').value,'_self');" /> 
                </td>
             
            </tr>
         
        </table>
</div>
        <?php
		if(isset($_POST['txtNombre']) && isset($seguridad->login_error)  && $seguridad->login_error != "" ) { $err=  new Exception($seguridad->login_error); echo ImprimirError($err);}
        if( isset($_GET['action']) && isset($seguridad->login_error) && $seguridad->login_error != "" ) { $err=  new Exception($seguridad->login_error); echo ImprimirError($err);}?>
        </fieldset> 
        </form>
        <!-- Fin Formulario de autentificaci�n  -->
		
		<script type="text/javascript" >
			document.getElementById("txtNombre").focus();
        </script> 
    </body>
</html>