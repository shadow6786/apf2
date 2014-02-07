<?php
/*

Creado En: 29/03/2013 07:45:41;
Creado Por: Sistema;
Modificado Por: ;
Modificado En: ;

*/

@session_start(); 

include_once("../_BRL/actividades.ext.php");
include_once("../_UTL/funcionesUI.php");
include_once("../_UTL/inc_seguridad.php");
include_once("../_UTL/funcionesARCHIVOS.php");

//Isntancia del Objeto
$objactividades=new cactividades_ext;

//Los filtros que se apliquen a la seleccion se guardan en la sesi&oacute;n
if (isset($_SESSION['actividades_filtro']))
{
	$objactividades->filtros = $_SESSION['actividades_filtro'];
}
//Las acciones pueden ser: editar, nuevo, filtrar, guardar o borrar. Seg&uacute;n el valor se mostrar&uacute;n los formularios correspondientes  
$accion = '';
if (isset($_GET['accion'])) 
{  
	$accion = $_GET['accion']; 
}

$vfkgestiones = HacerArray("gestiones","id_gst","nombre_gst");


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
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>actividades</title>
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
		<script src="../js/elrte.min.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" href="../css/elrte.min.css" type="text/css" media="screen" charset="utf-8">
		<!-- elFinder -->
		<link rel="stylesheet" href="../css/elfinder.css" type="text/css" media="screen" charset="utf-8" /> 
		<script src="../js/elfinder.full.js" type="text/javascript" charset="utf-8"></script>
		<script src="../js/i18n/elrte.es.js" type="text/javascript" charset="utf-8"></script>
		<script src="../js/i18n/elfinder.es.js" type="text/javascript" charset="utf-8"></script>
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
			
		var opts = {
					cssClass : 'el-rte',
					lang     : 'en',
					allowSource : 1,  // allow user to view source
					height   : 450,   // height of text area
					toolbar  : 'normal',   // Your options here are 'tiny', 'compact', 'normal', 'complete', 'maxi', or 'custom'
					cssfiles : ['../css/elrte-inner.css'],
					// elFinder
					fmAllow  : 1,
					fmOpen : function(callback) {
						$('<div id="myelfinder" />').elfinder({
							url : '../connectors/php/connector.php', // elFinder configuration file.
							lang : 'en',
							dialog : { width : 700, modal : true, title : 'Files' }, // Open in dialog window
							closeOnEditorCallback : true, // Close after file select
							editorCallback : callback     // Pass callback to file manager
						})
					}
					//end of elFinder
				}
				$('#descripcion_act').elrte(opts); // id of textarea you want rich edit on	

		$('#boton_guardar_validar').click(function() {

		 $('#form_editar_actividades').submit();
		 // $('.wysiwyggen').elrte('updateSource');
		 // Uncomment in case of WYSIWYG
		}); 
		
		$('#form_editar_actividades').validate({
			 submitHandler: function(form) {
				 form.submit();
			 }
		});
		
	

		$('#boton_insertar_validar').click(function() {
		 $('#form_insertar_actividades').submit();
		 // $('.wysiwyggen').elrte('updateSource');
		 // Uncomment in case of WYSIWYG
		}); 
		
		$('#form_insertar_actividades').validate({
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
    <div id="titulo_pagina">Gesti&oacute;n de actividades</div>
   	<?php 
	switch ($accion) 
	{
		case "editar":
		{
			//Muestra el formulario para editar un registro espec&iacute;fico, el de la variable $id
			$objactividades->id_act = $id;
			$objactividades->ObtenerUnRegistro();
	?>
    <!-- Formulario Actualizaci&oacute;n de Registros -->
    <form method='post' name="form_editar_actividades" id="form_editar_actividades" action='?accion=guardar&id=<?php echo $id ?>&pag=<?php echo $pag ?>' enctype='multipart/form-data'>
    <div id="opcionesmenu_registros">
        <ul id="icons" class="ui-widget ui-helper-clearfix">
            <li class="ui-state-default ui-corner-all">
                <a class="dialog_link" onClick="window.location = 'actividades.php?pag=<?php echo $pag ?>'" href="#">
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
                <td class='rs_filas_campo_form'><?php echo $objactividades->id_act ?></td>
            </tr> 
            
    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Nombre</td> 
            <td class='rs_filas_campo_form'><input type='text' id='nombre_act' name='nombre_act' value='<?php echo $objactividades->nombre_act ?>' title="Requerido!" class="{required:true,minlength:1}" size='80' maxlength='150'></td>
        </tr> 

    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Fecha Inicio</td> 
            <td class='rs_filas_campo_form'><script>
	$(function() {
			$( "#fechainicio_act" ).datetimepicker({
			addSliderAccess: true,
			sliderAccessArgs: { touchonly: false },
			showOn: "button",
			buttonImage: "../img/calendar.gif",
			buttonImageOnly: true
		});
	});
	</script><input type='text' id='fechainicio_act' name='fechainicio_act' value='<?php echo $objactividades->fechainicio_act ?>' title="Requerido!" class="{required:true,minlength:1}" size='20' ></td>
        </tr> 

    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Fecha Fin</td> 
            <td class='rs_filas_campo_form'><script>
	$(function() {
			$( "#fechafin_act" ).datetimepicker({
			addSliderAccess: true,
			sliderAccessArgs: { touchonly: false },
			showOn: "button",
			buttonImage: "../img/calendar.gif",
			buttonImageOnly: true
		});
	});
	</script><input type='text' id='fechafin_act' name='fechafin_act' value='<?php echo $objactividades->fechafin_act ?>' title="Requerido!" class="{required:true,minlength:1}" size='20' ></td>
        </tr> 

    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Cargar Archivo</td> 
            <td class='rs_filas_campo_form'><input type='text' id='archivo_act' name='archivo_act' value='<?php echo $objactividades->archivo_act ?>'  size='80' maxlength='80'></td>
        </tr> 

    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Tipo de fecha</td> 
            <td class='rs_filas_campo_form'><input type='text' id='tipofecha_act' name='tipofecha_act' value='<?php echo $objactividades->tipofecha_act ?>'  size='11' maxlength='11'></td>
        </tr> 

    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Gestion</td> 
            <td class='rs_filas_campo_form'><?php echo HacerCombo('gestiones','id_gst','nombre_gst',$objactividades->gestion_act,'gestion_act',''); ?></td>
        </tr> 

    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Activo</td> 
            <td class='rs_filas_campo_form'><input name="activo_act" type="checkbox" id="activo_act" value="S" <?php if($objactividades->activo_act == "S") {echo 'checked="checked"';}  ?> /></td>
        </tr> 

    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Descripci&oacute;n</td> 
            <td class='rs_filas_campo_form'><textarea name="descripcion_act" cols="50" rows="10" id="descripcion_act" ><?php echo utf8_encode($objactividades->descripcion_act); ?></textarea></td>
        </tr> 

            <tr> 
                <td class='rs_fila_nombrecolumna_form'>&Uacute;ltima Modificaci&oacute;n</td> 
                <td class='rs_filas_campo_form'><?php echo ObtenerDatosModificacionRegistro($objactividades->fechahora_mod, $objactividades->usuario_mod); ?></td>
            </tr> 
             <tr> 
                <td class='rs_fila_nombrecolumna_form'>Creaci&oacute;n</td> 
                <td class='rs_filas_campo_form'><?php echo ObtenerDatosCreacionRegistro($objactividades->fechahora_ins, $objactividades->usuario_ins); ?></td>
            </tr> 
            
        </table>
    	</div>
      </div>
    </form>
    <script type="text/javascript" > document.getElementById("nombre_act").focus(); </script>
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
    <form method='post' name="form_insertar_actividades" id="form_insertar_actividades" action='?accion=guardar&pag=<?php echo $pag ?>' enctype='multipart/form-data'>
    <div id="opcionesmenu_registros">
        <ul id="icons" class="ui-widget ui-helper-clearfix">
            <li class="ui-state-default ui-corner-all">
                <a class="dialog_link" onClick="window.location = 'actividades.php?pag=<?php echo $pag ?>'" href="#">
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
            <td class='rs_fila_nombrecolumna_form'>Nombre</td> 
            <td class='rs_filas_campo_form'><input type='text' id='nombre_act' name='nombre_act' value='' title="Requerido!" class="{required:true,minlength:1}" size='80' maxlength='80'></td>
        </tr> 

           <tr> 
            <td class='rs_fila_nombrecolumna_form'>Fecha Inicio</td> 
            <td class='rs_filas_campo_form'><script>
	$(function() {
		$( "#fechainicio_act" ).datetimepicker({
			addSliderAccess: true,
			sliderAccessArgs: { touchonly: false },
			showOn: "button",
			buttonImage: "../img/calendar.gif",
			buttonImageOnly: true
		});
		
	});
	</script><input type='text' id='fechainicio_act' name='fechainicio_act' value='' title="Requerido!" class="{required:true,minlength:1}" size='20' ></td>
        </tr> 

           <tr> 
            <td class='rs_fila_nombrecolumna_form'>Fecha Fin</td> 
            <td class='rs_filas_campo_form'><script>
	$(function() {
		$( "#fechafin_act" ).datetimepicker({
			addSliderAccess: true,
			sliderAccessArgs: { touchonly: false },
			showOn: "button",
			buttonImage: "../img/calendar.gif",
			buttonImageOnly: true
		});
		
	});
	</script><input type='text' id='fechafin_act' name='fechafin_act' value='' title="Requerido!" class="{required:true,minlength:1}" size='20' ></td>
        </tr> 

           <tr> 
            <td class='rs_fila_nombrecolumna_form'>Cargar Archivo</td> 
            <td class='rs_filas_campo_form'><input type='text' id='archivo_act' name='archivo_act' value=''  size='80' maxlength='80'></td>
        </tr> 

           <tr> 
            <td class='rs_fila_nombrecolumna_form'>Tipo de fecha</td> 
            <td class='rs_filas_campo_form'><input type='text' id='tipofecha_act' name='tipofecha_act' value=''  size='11' maxlength='11'></td>
        </tr> 

           <tr> 
            <td class='rs_fila_nombrecolumna_form'>Gestion</td> 
            <td class='rs_filas_campo_form'><?php echo HacerCombo('gestiones','id_gst','nombre_gst','','gestion_act',''); ?></td>
        </tr> 

           <tr> 
            <td class='rs_fila_nombrecolumna_form'>Activo</td> 
            <td class='rs_filas_campo_form'><input id="activo_act" name="activo_act" type="checkbox" value="S" /></td>
        </tr> 

           <tr> 
            <td class='rs_fila_nombrecolumna_form'>Descripci&oacute;n</td> 
            <td class='rs_filas_campo_form'><textarea name="descripcion_act" cols="50" rows="10" id="descripcion_act" ></textarea></td>
           
      </tr> 

          
        </table>
    </div>
    
    </div>
    </form>
    <script type="text/javascript" > document.getElementById("nombre_act").focus(); </script>
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
					
					array("Campo" => "nombre_act", "Relacion" => $_POST['nombre_act_relacion'], "Valor" => $_POST['nombre_act_valor']),
					array("Campo" => "fechainicio_act", "Relacion" => $_POST['fechainicio_act_relacion'], "Valor" => $_POST['fechainicio_act_valor']),
					array("Campo" => "fechafin_act", "Relacion" => $_POST['fechafin_act_relacion'], "Valor" => $_POST['fechafin_act_valor']),
					array("Campo" => "archivo_act", "Relacion" => $_POST['archivo_act_relacion'], "Valor" => $_POST['archivo_act_valor']),
					array("Campo" => "tipofecha_act", "Relacion" => $_POST['tipofecha_act_relacion'], "Valor" => $_POST['tipofecha_act_valor']),
					array("Campo" => "gestion_act", "Relacion" => $_POST['gestion_act_relacion'], "Valor" => $_POST['gestion_act_valor']),
					array("Campo" => "activo_act", "Relacion" => $_POST['activo_act_relacion'], "Valor" => $_POST['activo_act_valor']),
					array("Campo" => "descripcion_act", "Relacion" => $_POST['descripcion_act_relacion'], "Valor" => $_POST['descripcion_act_valor']),
					""
					); 
				$objactividades->filtros = $filtro;
				$_SESSION['actividades_filtro'] = $filtro;
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
				$objactividades->nombre_act  = (isset($_POST['nombre_act'])) ? $_POST['nombre_act'] : '';
			    $objactividades->fechainicio_act  = (isset($_POST['fechainicio_act'])) ? $_POST['fechainicio_act'] : '';
			    $objactividades->fechafin_act  = (isset($_POST['fechafin_act'])) ? $_POST['fechafin_act'] : '';
			    $objactividades->archivo_act  = (isset($_POST['archivo_act'])) ? $_POST['archivo_act'] : '';
			    $objactividades->tipofecha_act  = (isset($_POST['tipofecha_act'])) ? $_POST['tipofecha_act'] : '';
			    $objactividades->gestion_act  = (isset($_POST['gestion_act'])) ? $_POST['gestion_act'] : '';
			    $objactividades->activo_act  = (isset($_POST['activo_act'])) ? $_POST['activo_act'] : 'N';
			    $objactividades->descripcion_act  = (isset($_POST['descripcion_act'])) ? $_POST['descripcion_act'] : '';

				$objactividades->usuario_mod = $seguridad->personaid;

				if ($id > 0)
				{
					//Esto es una actualizaci&oacute;n de datos
					$objactividades->id_act = $id;
					$objactividades->actualizar();	
				}
				else
				{
					//Esto es una inserci&oacute;n de datos
					$objactividades->usuario_ins = $seguridad->personaid;
					$objactividades->insertar();
				}
			}
			catch(Exception $e)
			{
				echo ImprimirError($e);
				exit;
			}
			$objactividades->VaciarVariables();
			break;
		}
		case "borrar":
		{
		   //Borra un regsitro por su llave primaria, el almacenado en la variable $id.
			try
			{
				$objactividades->id_act =  $id;	
				$objactividades->borrar();
			}
			catch(Exception $e)
			{
				echo ImprimirError($e);
				exit;
			}	
			$objactividades->VaciarVariables();
			break;	
		}
	}
	//Buscar aplica el filtro que se haya podido establecer en la sesi&oacute;n.
	
        $rs = $objactividades->buscararr($pag); 
	
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
            	
            Registros: <?php echo $objactividades->totalfilas; 
			if ($objactividades->totalfilas != $objactividades->totalfilasfiltradas)
			echo " / Filtrados: ". $objactividades->totalfilasfiltradas;
			?> 
         	</div>
        </div>
        <!-- Fin Botonera Listados de Regsitros -->
        
        <!-- Listado de Registros -->
        <div>
       
        </div>
        <?php  
        
        if ( $objactividades->totalfilasfiltradas > 0)
			{ ?>
            <div id="tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all" >
			
           <table cellpadding="0" cellspacing="1" class="table_lista">
            <tr class="ui-tabs-nav ui-helper-reset  ui-widget-header ui-corner-all">
              <th class='rs_fila_nombrecolumna'></th>
              <th class='rs_fila_nombrecolumna'></th>
              <th class='rs_fila_nombrecolumna'>Id</th>
              
              <th class='rs_fila_nombrecolumna'>Nombre</th>
              <th class='rs_fila_nombrecolumna'>Fecha Inicio</th>
              <th class='rs_fila_nombrecolumna'>Fecha Fin</th>
              
              <th class='rs_fila_nombrecolumna'>Gestion</th>
              <th class='rs_fila_nombrecolumna'>Activo</th>
              
            </tr>
            <?php 
            
          
				foreach($rs as $userRow) 
				{  ?>
				<tr>
				  <td class='rs_fila_editar' width="1%">
				   <a id="boton_editar" class="ui-state-default ui-corner-all" href="?accion=editar&id=<?php echo $userRow["id_act"]; ?>&pag=<?php echo $pag ?>">
				   <span class="ui-icon ui-icon-pencil"></span>&nbsp;</a>
				  </td>
				  <td class='rs_filas_eliminar' width="1%">
				  <a id="boton_borrar" class="ui-state-default ui-corner-all" href="?accion=borrar&id=<?php echo $userRow["id_act"]; ?>&pag=<?php echo $pag ?>" onClick="return confirm('&iquest;Est&aacute; seguro que desea eliminar el registro con Id: <?php echo $userRow["id_act"]; ?>?')">
				  <span class="ui-icon ui-icon-trash"></span>&nbsp;</a>
				  </td>
				  <td class='rs_filas' width="1%"><?php echo $userRow["id_act"]; ?></td>
				  
                  	    <td class='rs_filas'><?php echo $userRow["nombre_act"]; ?></td>

                  	    <td class='rs_filas'><?php echo $userRow["fechainicio_act"]; ?></td>

                  	    <td class='rs_filas'><?php echo $userRow["fechafin_act"]; ?></td>

                  	    
                  	    <td class='rs_filas'><?php if(array_key_exists($userRow["gestion_act"],$vfkgestiones)) { echo $vfkgestiones[$userRow["gestion_act"]]; } else { echo  $userRow["gestion_act"];} ?></td>

                  	    <td class='rs_filas'><?php if($userRow["activo_act"] == 'S') { echo "<input name='x' type='checkbox' disabled value='x' checked />"; } else { echo "<input name='x' type='checkbox' disabled value='x' />"; } ?></td>

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
            	<td>Nombre</td>
            	<td><select name="nombre_act_relacion" onChange="VaciarValor(this.form, 'nombre_act_relacion' ,'nombre_act_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objactividades->filtros[0]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objactividades->filtros[0]); ?>>distinto</option>
                    <option value="like" <?php ObtenerSeleccionFiltro("like",$objactividades->filtros[0]); ?>>contiene</option>
                    <option value="like_ini" <?php ObtenerSeleccionFiltro("like_ini",$objactividades->filtros[0]); ?>>comienza con</option>
                    <option value="like_fin" <?php ObtenerSeleccionFiltro("like_fin",$objactividades->filtros[0]); ?>>termina con</option>
                </select>
            	</td>
            	<td><input name="nombre_act_valor" value="<?php echo $objactividades->filtros[0]["Valor"]; ?>" /></td>
            </tr>

		 	<tr>
            	<td>Fecha Inicio</td>
            	<td><select name="fechainicio_act_relacion" onChange="VaciarValor(this.form, 'fechainicio_act_relacion' ,'fechainicio_act_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objactividades->filtros[1]); ?> >hoy</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objactividades->filtros[1]); ?>>distinto de hoy</option>
                    <option value="<" <?php ObtenerSeleccionFiltro("<",$objactividades->filtros[1]); ?>>antes de</option>
                    <option value=">" <?php ObtenerSeleccionFiltro(">",$objactividades->filtros[1]); ?>>despues de</option>                                        
                </select>
            	</td>
            	<td><input name="fechainicio_act_valor" value="<?php echo $objactividades->filtros[1]["Valor"]; ?>" /></td>
            </tr>

		 	<tr>
            	<td>Fecha Fin</td>
            	<td><select name="fechafin_act_relacion" onChange="VaciarValor(this.form, 'fechafin_act_relacion' ,'fechafin_act_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objactividades->filtros[2]); ?> >hoy</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objactividades->filtros[2]); ?>>distinto de hoy</option>
                    <option value="<" <?php ObtenerSeleccionFiltro("<",$objactividades->filtros[2]); ?>>antes de</option>
                    <option value=">" <?php ObtenerSeleccionFiltro(">",$objactividades->filtros[2]); ?>>despues de</option>                                        
                </select>
            	</td>
            	<td><input name="fechafin_act_valor" value="<?php echo $objactividades->filtros[2]["Valor"]; ?>" /></td>
            </tr>

		 	<tr>
            	<td>Cargar Archivo</td>
            	<td><select name="archivo_act_relacion" onChange="VaciarValor(this.form, 'archivo_act_relacion' ,'archivo_act_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objactividades->filtros[3]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objactividades->filtros[3]); ?>>distinto</option>
                    <option value="like" <?php ObtenerSeleccionFiltro("like",$objactividades->filtros[3]); ?>>contiene</option>
                    <option value="like_ini" <?php ObtenerSeleccionFiltro("like_ini",$objactividades->filtros[3]); ?>>comienza con</option>
                    <option value="like_fin" <?php ObtenerSeleccionFiltro("like_fin",$objactividades->filtros[3]); ?>>termina con</option>
                </select>
            	</td>
            	<td><input name="archivo_act_valor" value="<?php echo $objactividades->filtros[3]["Valor"]; ?>" /></td>
            </tr>

		 	<tr>
            	<td>Tipo de fecha</td>
            	<td><select name="tipofecha_act_relacion" onChange="VaciarValor(this.form, 'tipofecha_act_relacion' ,'tipofecha_act_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objactividades->filtros[4]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objactividades->filtros[4]); ?>>distinto</option>
                    <option value="like" <?php ObtenerSeleccionFiltro("like",$objactividades->filtros[4]); ?>>contiene</option>
                    <option value="like_ini" <?php ObtenerSeleccionFiltro("like_ini",$objactividades->filtros[4]); ?>>comienza con</option>
                    <option value="like_fin" <?php ObtenerSeleccionFiltro("like_fin",$objactividades->filtros[4]); ?>>termina con</option>
                </select>
            	</td>
            	<td><input name="tipofecha_act_valor" value="<?php echo $objactividades->filtros[4]["Valor"]; ?>" /></td>
            </tr>

		 	<tr>
            	<td>Gestion</td>
            	<td><select name="gestion_act_relacion" onChange="VaciarValor(this.form, 'gestion_act_relacion' ,'gestion_act_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objactividades->filtros[5]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objactividades->filtros[5]); ?>>distinto</option>
                    </select>
            	</td>
            	<td> <?php echo HacerCombo('gestiones','id_gst','nombre_gst',$objactividades->filtros[5]["Valor"],'gestion_act_valor',''); ?></td>
            </tr>

		 	<tr>
            	<td>Activo</td>
            	<td><select name="activo_act_relacion" onChange="VaciarValor(this.form, 'activo_act_relacion' ,'activo_act_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objactividades->filtros[6]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objactividades->filtros[6]); ?>>distinto</option>
                    </select>
            	</td>
            	<td>
                <select name="activo_act_valor" id="activo_act_valor" onChange="VaciarValor(this.form, 'activo_act_relacion' ,'activo_act_valor')">
                	<option value=""></option>
                    <option value="S" <?php ObtenerSeleccionFiltro("S",$objactividades->filtros[6]); ?>>S&iacute;</option>
                    <option value="N" <?php ObtenerSeleccionFiltro("N",$objactividades->filtros[6]); ?>>No</option>
                </select></td>
            </tr>

		 	<tr>
            	<td>Descripci�n</td>
            	<td><select name="descripcion_act_relacion" onChange="VaciarValor(this.form, 'descripcion_act_relacion' ,'descripcion_act_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objactividades->filtros[7]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objactividades->filtros[7]); ?>>distinto</option>
                    <option value="like" <?php ObtenerSeleccionFiltro("like",$objactividades->filtros[7]); ?>>contiene</option>
                    <option value="like_ini" <?php ObtenerSeleccionFiltro("like_ini",$objactividades->filtros[7]); ?>>comienza con</option>
                    <option value="like_fin" <?php ObtenerSeleccionFiltro("like_fin",$objactividades->filtros[7]); ?>>termina con</option>
                </select>
            	</td>
            	<td><input name="descripcion_act_valor" value="<?php echo $objactividades->filtros[7]["Valor"]; ?>" /></td>
            </tr>

            </table>
        </form>
		</div>
		<!-- Fin Dialogo Filtro -->
         <?php if ($objactividades->totalfilas > 20 )  
		{ ?>


         <script type="text/javascript">
		$(function(){
		
			$("#paginacion").paginate({
			count 		: <?php echo ceil (($objactividades->totalfilasfiltradas / 20)) ; ?>,
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