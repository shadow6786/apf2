<?php
/*

Creado En: 29/03/2013 07:45:41;
Creado Por: Sistema;
Modificado Por: ;
Modificado En: ;

*/

@session_start(); 

include_once("../_BRL/correos.ext.php");
include_once("../_UTL/funcionesUI.php");
include_once("../_UTL/inc_seguridad.php");
include_once("../_UTL/funcionesARCHIVOS.php");

//Isntancia del Objeto
$objcorreos=new ccorreos_ext;

//Los filtros que se apliquen a la seleccion se guardan en la sesi&oacute;n
if (isset($_SESSION['correos_filtro']))
{
	$objcorreos->filtros = $_SESSION['correos_filtro'];
}
//Las acciones pueden ser: editar, nuevo, filtrar, guardar o borrar. Seg&uacute;n el valor se mostrar&uacute;n los formularios correspondientes  
$accion = '';
if (isset($_GET['accion'])) 
{  
	$accion = $_GET['accion']; 
}



//Id es el arhivo que se edita
$id = '';
if (isset($_GET['id'])) 
{  
	$id = $_GET['id']; 
}

//pag es la p&aacute;gina actual que se est&aacute; visualizando. Inicia en 0
$pag = 0;
if (isset($_GET['pag'])) 
{  
	$pag = $_GET['pag']; 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>correos</title>
        <link type="text/css" href="../css/redmond/jquery-ui-1.8.14.custom.css" rel="stylesheet" />	
		<script type="text/javascript" >
        txtval = new String(top.location);
		
		if(txtval.search('frameset.php') < 0)
		{
			window.open('../frameset.php?u='+top.location,'_top');
		}
     
        </script>
        <script type="text/javascript" src="../js/jquery-1.5.1.min.js"></script>
        <script type="text/javascript" src="../js/jquery-ui-1.8.14.custom.min.js"></script>
        <link rel="stylesheet" href="../css/mgEstiloAdmin.css" type="text/css">
        <script src="../js/jquery.paginate.js" type="text/javascript"></script>
        <script language="JavaScript" src="../js/jquery.metadata.js"></script>
        <script language="JavaScript" src="../js/jquery.validate.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/paginacion.css" media="screen"/>
	
		<!--TIMEPICKER-->
        <link rel="stylesheet" type="text/css" href="../css/jquery-ui-timepicker.css" media="screen"/>
        <script language="JavaScript" src="../js/jquery.ui.timepicker.js"></script>
        
        <script type="text/javascript">
		$(function(){
			$('ul#icons li, #boton_editar, #boton_borrar').hover(
			function() { $(this).addClass('ui-state-hover'); }, 
			function() { $(this).removeClass('ui-state-hover'); }
			);
			
			// Dialog			
			$('#sector_filtros').dialog({
			autoOpen: false,
			width: 400,
			buttons: {
			"Ok": function() { 
			document.getElementById('form_filtrar').submit();
			$(this).dialog("close"); 
			}, 
			"Cancel": function() { 
			$(this).dialog("close"); 
			} 
			}
			});
			
			// Dialog Link
			$('#boton_filtro').click(function(){
			$('#sector_filtros').dialog('open');
			return false;
			});
			
			// Tabs
			$('#tabs').tabs();
	
		});
		
		
		function VaciarValor(form, campo1, campo2)
		{
			if (form.elements[campo1].value == "")
			{	
			form.elements[campo2].value = "";
			}
		}
		
		
		$(document).ready(function(){

		$('#boton_guardar_validar').click(function() {

		 $('#form_editar_correos').submit();
		 // $('.wysiwyggen').elrte('updateSource');
		 // Uncomment in case of WYSIWYG
		}); 
		
		$('#form_editar_correos').validate({
			 submitHandler: function(form) {
				 form.submit();
			 }
		});
		
	

		$('#boton_insertar_validar').click(function() {
		 $('#form_insertar_correos').submit();
		 // $('.wysiwyggen').elrte('updateSource');
		 // Uncomment in case of WYSIWYG
		}); 
		
		$('#form_insertar_correos').validate({
			 submitHandler: function(form) {
				 form.submit();
			 }
		});
		
		});
		
		</script>
        <script language="JavaScript" src="../js/datetimepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/datetimepicker.css"/>
        
    </head>
    <body>
    <div id="titulo_pagina">Gesti&oacute;n de correos</div>
   	<?php 
	switch ($accion) 
	{
		case "editar":
		{
			//Muestra el formulario para editar un registro espec&iacute;fico, el de la variable $id
			$objcorreos->id_mail = $id;
			$objcorreos->ObtenerUnRegistro();
	?>
    <!-- Formulario Actualizaci&oacute;n de Registros -->
    <form method='post' name="form_editar_correos" id="form_editar_correos" action='?accion=guardar&id=<?php echo $id ?>&pag=<?php echo $pag ?>' enctype='multipart/form-data'>
    <div id="opcionesmenu_registros">
        <ul id="icons" class="ui-widget ui-helper-clearfix">
            <li class="ui-state-default ui-corner-all">
                <a class="dialog_link" onClick="window.location = 'correos.php?pag=<?php echo $pag ?>'" href="#">
                    <span class="ui-icon ui-icon-arrowreturnthick-1-w"></span>Cancelar
                </a>
            </li>
             <li class="ui-state-default ui-corner-all">
                <a class="dialog_link" id="boton_guardar_validar" href="#">
                    <span class="ui-icon ui-icon-disk"></span>Aceptar
                </a>
            </li>
        </ul>
    </div>
    <div id="tabs">
    <ul>
        <li><a href="#tabs-1">Editar</a></li>
    </ul>
    <div id="tabs-1">
        <table  cellpadding="0" cellspacing="1" class="table_editar" > 
            
            <tr> 
                <td class='rs_fila_nombrecolumna_form'>Id</td> 
                <td class='rs_filas_campo_form'><?php echo $objcorreos->id_mail ?></td>
            </tr> 
            
    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Origen</td> 
            <td class='rs_filas_campo_form'><input type='text' id='origen_mail' name='origen_mail' value='<?php echo $objcorreos->origen_mail ?>' title="Requerido!" class="{required:true,minlength:1}" size='150' maxlength='150'></td>
        </tr> 

    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Destinatario</td> 
            <td class='rs_filas_campo_form'><input type='text' id='destinio_mail' name='destinio_mail' value='<?php echo $objcorreos->destinio_mail ?>' title="Requerido!" class="{required:true,minlength:1}" size='150' maxlength='150'></td>
        </tr> 

    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Asunto</td> 
            <td class='rs_filas_campo_form'><input type='text' id='asunto_mail' name='asunto_mail' value='<?php echo $objcorreos->asunto_mail ?>' title="Requerido!" class="{required:true,minlength:1}" size='150' maxlength='150'></td>
        </tr> 

    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Fecha de envio</td> 
            <td class='rs_filas_campo_form'><script>
	$(function() {
			$( "#fechaenvio_mail" ).datetimepicker({
			addSliderAccess: true,
			sliderAccessArgs: { touchonly: false },
			showOn: "button",
			buttonImage: "../img/calendar.gif",
			buttonImageOnly: true
		});
	});
	</script><input type='text' id='fechaenvio_mail' name='fechaenvio_mail' value='<?php echo $objcorreos->fechaenvio_mail ?>' title="Requerido!" class="{required:true,minlength:1}" size='20' ></td>
        </tr> 

    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Mensaje</td> 
            <td class='rs_filas_campo_form'><textarea name="mensaje_mail" cols="50" rows="10" id="mensaje_mail" class="wysiwyggen"><?php echo $objcorreos->mensaje_mail ?></textarea> <?php include("../_UTL/wysiwyg.php"); ?>
        
		<script type="text/javascript">
		$(function(){
			
			$('#mensaje_mail').elrte(opts);

                            });
                            </script></td>
        </tr> 

            <tr> 
                <td class='rs_fila_nombrecolumna_form'>&Uacute;ltima Modificaci&oacute;n</td> 
                <td class='rs_filas_campo_form'><?php echo ObtenerDatosModificacionRegistro($objcorreos->fechahora_mod, $objcorreos->usuario_mod); ?></td>
            </tr> 
             <tr> 
                <td class='rs_fila_nombrecolumna_form'>Creaci&oacute;n</td> 
                <td class='rs_filas_campo_form'><?php echo ObtenerDatosCreacionRegistro($objcorreos->fechahora_ins, $objcorreos->usuario_ins); ?></td>
            </tr> 
            
        </table>
    	</div>
      </div>
    </form>
    <script type="text/javascript" > document.getElementById("origen_mail").focus(); </script>
    <!-- Fin Formulario Actualizaci&oacute;n de Registros -->
      </body>
</html>
	<?php
			exit;
		}
		case "nuevo":
		{
			//Abre le formulario para insertar un nuevo regsitro
		?>
        
    <!-- Formulario Inserci&oacute;n Registros -->
    <form method='post' name="form_insertar_correos" id="form_insertar_correos" action='?accion=guardar&pag=<?php echo $pag ?>' enctype='multipart/form-data'>
    <div id="opcionesmenu_registros">
        <ul id="icons" class="ui-widget ui-helper-clearfix">
            <li class="ui-state-default ui-corner-all">
                <a class="dialog_link" onClick="window.location = 'correos.php?pag=<?php echo $pag ?>'" href="#">
                    <span class="ui-icon ui-icon-arrowreturnthick-1-w"></span>Cancelar
                </a>
            </li>
             <li class="ui-state-default ui-corner-all">
                <a class="dialog_link"  id="boton_insertar_validar" href="#">
                    <span class="ui-icon ui-icon-disk"></span>Aceptar
                </a>
            </li>
        </ul>
    </div>
     <div id="tabs">
    <ul>
        <li><a href="#tabs-1">Nuevo</a></li>
    </ul>
    <div id="tabs-1">
    
        <table  cellpadding="0" cellspacing="0" class="table_agregar" > 
         
    
           <tr> 
            <td class='rs_fila_nombrecolumna_form'>Origen</td> 
            <td class='rs_filas_campo_form'><input type='text' id='origen_mail' name='origen_mail' value='' title="Requerido!" class="{required:true,minlength:1}" size='150' maxlength='150'></td>
        </tr> 

           <tr> 
            <td class='rs_fila_nombrecolumna_form'>Destinatario</td> 
            <td class='rs_filas_campo_form'><input type='text' id='destinio_mail' name='destinio_mail' value='' title="Requerido!" class="{required:true,minlength:1}" size='150' maxlength='150'></td>
        </tr> 

           <tr> 
            <td class='rs_fila_nombrecolumna_form'>Asunto</td> 
            <td class='rs_filas_campo_form'><input type='text' id='asunto_mail' name='asunto_mail' value='' title="Requerido!" class="{required:true,minlength:1}" size='150' maxlength='150'></td>
        </tr> 

           <tr> 
            <td class='rs_fila_nombrecolumna_form'>Fecha de envio</td> 
            <td class='rs_filas_campo_form'><script>
	$(function() {
		$( "#fechaenvio_mail" ).datetimepicker({
			addSliderAccess: true,
			sliderAccessArgs: { touchonly: false },
			showOn: "button",
			buttonImage: "../img/calendar.gif",
			buttonImageOnly: true
		});
		
	});
	</script><input type='text' id='fechaenvio_mail' name='fechaenvio_mail' value='' title="Requerido!" class="{required:true,minlength:1}" size='20' ></td>
        </tr> 

           <tr> 
            <td class='rs_fila_nombrecolumna_form'>Mensaje</td> 
            <td class='rs_filas_campo_form'><textarea name="mensaje_mail" cols="50" rows="10" id="mensaje_mail" class="wysiwyggen"></textarea> <?php include("../_UTL/wysiwyg.php"); ?>
        
		<script type="text/javascript">
		$(function(){
			
			$('#mensaje_mail').elrte(opts);

                            });
                            </script></td>
           
      </tr> 

          
        </table>
    </div>
    
    </div>
    </form>
    <script type="text/javascript" > document.getElementById("origen_mail").focus(); </script>
    <!-- Fin Formulario Inserci&oacute;n Registros -->
      </body>
</html>
	<?php
			exit;
		}
		case "filtrar":
		{
			//Crea un array con los valores de los filtros, lo pasa a la clase y lo almacena en la sesi&oacute;n.
			try
			{
				$filtro =  array( 
					
					array("Campo" => "origen_mail", "Relacion" => $_POST['origen_mail_relacion'], "Valor" => $_POST['origen_mail_valor']),
					array("Campo" => "destinio_mail", "Relacion" => $_POST['destinio_mail_relacion'], "Valor" => $_POST['destinio_mail_valor']),
					array("Campo" => "asunto_mail", "Relacion" => $_POST['asunto_mail_relacion'], "Valor" => $_POST['asunto_mail_valor']),
					array("Campo" => "fechaenvio_mail", "Relacion" => $_POST['fechaenvio_mail_relacion'], "Valor" => $_POST['fechaenvio_mail_valor']),
					array("Campo" => "mensaje_mail", "Relacion" => $_POST['mensaje_mail_relacion'], "Valor" => $_POST['mensaje_mail_valor']),
					""
					); 
				$objcorreos->filtros = $filtro;
				$_SESSION['correos_filtro'] = $filtro;
			}
			catch(Exception $e)
			{
				echo ImprimirError($e);
				exit;
			}
			break;
		}
		case "guardar":
		{
			//Inserta o Actualiza un registro en la base de Datos. Dependiendo si la variable $id es mayor a 0 hace una actualizaci&oacute;n, caso contrario una inserci&oacute;n
			try
			{
				
				
				
				
				
				
				
				
					    $objcorreos->origen_mail  = (isset($_POST['origen_mail'])) ? $_POST['origen_mail'] : '';

					    $objcorreos->destinio_mail  = (isset($_POST['destinio_mail'])) ? $_POST['destinio_mail'] : '';

					    $objcorreos->asunto_mail  = (isset($_POST['asunto_mail'])) ? $_POST['asunto_mail'] : '';

					    $objcorreos->fechaenvio_mail  = (isset($_POST['fechaenvio_mail'])) ? $_POST['fechaenvio_mail'] : '';

					    $objcorreos->mensaje_mail  = (isset($_POST['mensaje_mail'])) ? $_POST['mensaje_mail'] : '';


				$objcorreos->usuario_mod = $seguridad->personaid;

				if ($id > 0)
				{
					//Esto es una actualizaci&oacute;n de datos
					$objcorreos->id_mail = $id;
					$objcorreos->actualizar();	
				}
				else
				{
					//Esto es una inserci&oacute;n de datos
					$objcorreos->usuario_ins = $seguridad->personaid;
					$objcorreos->insertar();
				}
			}
			catch(Exception $e)
			{
				echo ImprimirError($e);
				exit;
			}
			$objcorreos->VaciarVariables();
			break;
		}
		case "borrar":
		{
		   //Borra un regsitro por su llave primaria, el almacenado en la variable $id.
			try
			{
				$objcorreos->id_mail =  $id;	
				$objcorreos->borrar();
			}
			catch(Exception $e)
			{
				echo ImprimirError($e);
				exit;
			}	
			$objcorreos->VaciarVariables();
			break;	
		}
	}
	//Buscar aplica el filtro que se haya podido establecer en la sesi&oacute;n.
	
        $rs = $objcorreos->buscararr($pag); 
	
	?>
        <!-- Botonera Listados de Regsitros -->
         <div id="opcionesmenu_registros">
         	<ul id="icons" style="float:right" class="ui-widget ui-helper-clearfix">
            	<li class="ui-state-default ui-corner-all">
                    <a class="dialog_link" id="boton_filtro"  href="#">
                        <span class="ui-icon ui-icon-wrench"></span>Filtros 
                    </a>
                </li>
               
                <li class="ui-state-default ui-corner-all">
                    <a class="dialog_link" href="?accion=nuevo&pag=<?php echo $pag ?>">
                        <span class="ui-icon ui-icon-document"></span>Nuevo Registro
                    </a>
                </li>
            </ul>
        	<div id="sector_totalregistros">
         	 <?php  ?>
            	
            Registros: <?php echo $objcorreos->totalfilas; 
			if ($objcorreos->totalfilas != $objcorreos->totalfilasfiltradas)
			echo " / Filtrados: ". $objcorreos->totalfilasfiltradas;
			?> 
         	</div>
        </div>
        <!-- Fin Botonera Listados de Regsitros -->
        
        <!-- Listado de Registros -->
        <div>
       
        </div>
        <?php  
        
        if ( $objcorreos->totalfilasfiltradas > 0)
			{ ?>
            <div id="tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all" >
			
           <table cellpadding="0" cellspacing="1" class="table_lista">
            <tr class="ui-tabs-nav ui-helper-reset  ui-widget-header ui-corner-all">
              <th class='rs_fila_nombrecolumna'></th>
              <th class='rs_fila_nombrecolumna'></th>
              <th class='rs_fila_nombrecolumna'>Id</th>
              
              <th class='rs_fila_nombrecolumna'>Origen</th>
              <th class='rs_fila_nombrecolumna'>Destinatario</th>
              <th class='rs_fila_nombrecolumna'>Asunto</th>
              <th class='rs_fila_nombrecolumna'>Fecha de envio</th>
              <th class='rs_fila_nombrecolumna'>Mensaje</th>
            </tr>
            <?php 
            
          
				foreach($rs as $userRow) 
				{  ?>
				<tr>
				  <td class='rs_fila_editar' width="1%">
				   <a id="boton_editar" class="ui-state-default ui-corner-all" href="?accion=editar&id=<?php echo $userRow["id_mail"]; ?>&pag=<?php echo $pag ?>">
				   <span class="ui-icon ui-icon-pencil"></span>&nbsp;</a>
				  </td>
				  <td class='rs_filas_eliminar' width="1%">
				  <a id="boton_borrar" class="ui-state-default ui-corner-all" href="?accion=borrar&id=<?php echo $userRow["id_mail"]; ?>&pag=<?php echo $pag ?>" onClick="return confirm('&iquest;Est&aacute; seguro que desea eliminar el registro con Id: <?php echo $userRow["id_mail"]; ?>?')">
				  <span class="ui-icon ui-icon-trash"></span>&nbsp;</a>
				  </td>
				  <td class='rs_filas' width="1%"><?php echo $userRow["id_mail"]; ?></td>
				  
                  	    <td class='rs_filas'><?php echo $userRow["origen_mail"]; ?></td>

                  	    <td class='rs_filas'><?php echo $userRow["destinio_mail"]; ?></td>

                  	    <td class='rs_filas'><?php echo $userRow["asunto_mail"]; ?></td>

                  	    <td class='rs_filas'><?php echo $userRow["fechaenvio_mail"]; ?></td>

                  	    <td class='rs_filas'><?php echo $userRow["mensaje_mail"]; ?></td>

                </tr>
            <?php } ?>
			
			
          </table>    
            <br/> 
             <!-- Paginaci&oacute;n -->
        <div id="paginacion"></div>
        <!-- Fin Paginaci&oacute;n -->    
       
			</div>
          
              
          <?php 
          }
		?>
        <!-- Fin Listado de Registros -->
        
       
		<!-- Dialogo Filtro -->
		<div id="sector_filtros" title="Filtro">
			<form  method='post' id="form_filtrar"  name="form_filtrar"  action='?accion=filtrar' enctype='multipart/form-data'>
            <table cellpadding="0" cellspacing="1" class="table_filtro">
        
		 	<tr>
            	<td>Origen</td>
            	<td><select name="origen_mail_relacion" onChange="VaciarValor(this.form, 'origen_mail_relacion' ,'origen_mail_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objcorreos->filtros[0]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objcorreos->filtros[0]); ?>>distinto</option>
                    <option value="like" <?php ObtenerSeleccionFiltro("like",$objcorreos->filtros[0]); ?>>contiene</option>
                    <option value="like_ini" <?php ObtenerSeleccionFiltro("like_ini",$objcorreos->filtros[0]); ?>>comienza con</option>
                    <option value="like_fin" <?php ObtenerSeleccionFiltro("like_fin",$objcorreos->filtros[0]); ?>>termina con</option>
                </select>
            	</td>
            	<td><input name="origen_mail_valor" value="<?php echo $objcorreos->filtros[0]["Valor"]; ?>" /></td>
            </tr>

		 	<tr>
            	<td>Destinatario</td>
            	<td><select name="destinio_mail_relacion" onChange="VaciarValor(this.form, 'destinio_mail_relacion' ,'destinio_mail_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objcorreos->filtros[1]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objcorreos->filtros[1]); ?>>distinto</option>
                    <option value="like" <?php ObtenerSeleccionFiltro("like",$objcorreos->filtros[1]); ?>>contiene</option>
                    <option value="like_ini" <?php ObtenerSeleccionFiltro("like_ini",$objcorreos->filtros[1]); ?>>comienza con</option>
                    <option value="like_fin" <?php ObtenerSeleccionFiltro("like_fin",$objcorreos->filtros[1]); ?>>termina con</option>
                </select>
            	</td>
            	<td><input name="destinio_mail_valor" value="<?php echo $objcorreos->filtros[1]["Valor"]; ?>" /></td>
            </tr>

		 	<tr>
            	<td>Asunto</td>
            	<td><select name="asunto_mail_relacion" onChange="VaciarValor(this.form, 'asunto_mail_relacion' ,'asunto_mail_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objcorreos->filtros[2]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objcorreos->filtros[2]); ?>>distinto</option>
                    <option value="like" <?php ObtenerSeleccionFiltro("like",$objcorreos->filtros[2]); ?>>contiene</option>
                    <option value="like_ini" <?php ObtenerSeleccionFiltro("like_ini",$objcorreos->filtros[2]); ?>>comienza con</option>
                    <option value="like_fin" <?php ObtenerSeleccionFiltro("like_fin",$objcorreos->filtros[2]); ?>>termina con</option>
                </select>
            	</td>
            	<td><input name="asunto_mail_valor" value="<?php echo $objcorreos->filtros[2]["Valor"]; ?>" /></td>
            </tr>

		 	<tr>
            	<td>Fecha de envio</td>
            	<td><select name="fechaenvio_mail_relacion" onChange="VaciarValor(this.form, 'fechaenvio_mail_relacion' ,'fechaenvio_mail_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objcorreos->filtros[3]); ?> >hoy</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objcorreos->filtros[3]); ?>>distinto de hoy</option>
                    <option value="<" <?php ObtenerSeleccionFiltro("<",$objcorreos->filtros[3]); ?>>antes de</option>
                    <option value=">" <?php ObtenerSeleccionFiltro(">",$objcorreos->filtros[3]); ?>>despues de</option>                                        
                </select>
            	</td>
            	<td><input name="fechaenvio_mail_valor" value="<?php echo $objcorreos->filtros[3]["Valor"]; ?>" /></td>
            </tr>

		 	<tr>
            	<td>Mensaje</td>
            	<td><select name="mensaje_mail_relacion" onChange="VaciarValor(this.form, 'mensaje_mail_relacion' ,'mensaje_mail_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objcorreos->filtros[4]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objcorreos->filtros[4]); ?>>distinto</option>
                    <option value="like" <?php ObtenerSeleccionFiltro("like",$objcorreos->filtros[4]); ?>>contiene</option>
                    <option value="like_ini" <?php ObtenerSeleccionFiltro("like_ini",$objcorreos->filtros[4]); ?>>comienza con</option>
                    <option value="like_fin" <?php ObtenerSeleccionFiltro("like_fin",$objcorreos->filtros[4]); ?>>termina con</option>
                </select>
            	</td>
            	<td><input name="mensaje_mail_valor" value="<?php echo $objcorreos->filtros[4]["Valor"]; ?>" /></td>
            </tr>

            </table>
        </form>
		</div>
		<!-- Fin Dialogo Filtro -->
         <?php if ($objcorreos->totalfilas > 20 )  
		{ ?>


         <script type="text/javascript">
		$(function(){
		
			$("#paginacion").paginate({
			count 		: <?php echo ceil (($objcorreos->totalfilasfiltradas / 20)) ; ?>,
			start 		: <?php if ($pag==0) { echo '1';} else {echo $pag;} ?>,
			display     : 10,
			border					: true,
			border_color			: '#fff',
			text_color  			: '#fff',
			background_color    	: '#666666',	
			border_hover_color		: '#ccc',
			text_hover_color  		: '#000',
			background_hover_color	: '#fff', 
			images					: false,
			mouse					: 'press',
			onChange     			: function(page){ window.location = "?pag=" + page; }
			});
		});
				
			
		</script> <?php } ?>
        
  </body>
</html>