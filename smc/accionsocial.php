<?php
/*

Creado En: 11/02/2014 08:00:29;
Creado Por: Sistema;
Modificado Por: ;
Modificado En: ;

*/

@session_start(); 

include_once("../_BRL/accionsocial.ext.php");
include_once("../_UTL/funcionesUI.php");
include_once("../_UTL/inc_seguridad.php");
include_once("../_UTL/funcionesARCHIVOS.php");

//Isntancia del Objeto
$objaccionsocial=new caccionsocial_ext;

//Los filtros que se apliquen a la seleccion se guardan en la sesi&oacute;n
if (isset($_SESSION['accionsocial_filtro']))
{
	$objaccionsocial->filtros = $_SESSION['accionsocial_filtro'];
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
		<title>accionsocial</title>
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

		 $('#form_editar_accionsocial').submit();
		 // $('.wysiwyggen').elrte('updateSource');
		 // Uncomment in case of WYSIWYG
		}); 
		
		$('#form_editar_accionsocial').validate({
			 submitHandler: function(form) {
				 form.submit();
			 }
		});
		
	

		$('#boton_insertar_validar').click(function() {
		 $('#form_insertar_accionsocial').submit();
		 // $('.wysiwyggen').elrte('updateSource');
		 // Uncomment in case of WYSIWYG
		}); 
		
		$('#form_insertar_accionsocial').validate({
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
    <div id="titulo_pagina">Gesti&oacute;n de accionsocial</div>
   	<?php 
	switch ($accion) 
	{
		case "editar":
		{
			//Muestra el formulario para editar un registro espec&iacute;fico, el de la variable $id
			$objaccionsocial->id_acs = $id;
			$objaccionsocial->ObtenerUnRegistro();
	?>
    <!-- Formulario Actualizaci&oacute;n de Registros -->
    <form method='post' name="form_editar_accionsocial" id="form_editar_accionsocial" action='?accion=guardar&id=<?php echo $id ?>&pag=<?php echo $pag ?>' enctype='multipart/form-data'>
    <div id="opcionesmenu_registros">
        <ul id="icons" class="ui-widget ui-helper-clearfix">
            <li class="ui-state-default ui-corner-all">
                <a class="dialog_link" onClick="window.location = 'accionsocial.php?pag=<?php echo $pag ?>'" href="#">
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
                <td class='rs_filas_campo_form'><?php echo $objaccionsocial->id_acs ?></td>
            </tr> 
            
    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Nombre</td> 
            <td class='rs_filas_campo_form'><input type='text' id='nombre_acs' name='nombre_acs' value='<?php echo $objaccionsocial->nombre_acs ?>'  size='200' maxlength='200'></td>
        </tr> 

    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Archivo</td> 
            <td class='rs_filas_campo_form'><input type='file' id='archivo_acs' name='archivo_acs'></td>
        </tr> 

    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Orden</td> 
            <td class='rs_filas_campo_form'><input type='text' id='orden_acs' name='orden_acs' value='<?php echo $objaccionsocial->orden_acs ?>'  size='10' maxlength='10'></td>
        </tr> 

    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Activo</td> 
            <td class='rs_filas_campo_form'><input name="activo_acs" type="checkbox" id="activo_acs" value="S" <?php if($objaccionsocial->activo_acs == "S") {echo 'checked="checked"';}  ?> /></td>
        </tr> 

            <tr> 
                <td class='rs_fila_nombrecolumna_form'>&Uacute;ltima Modificaci&oacute;n</td> 
                <td class='rs_filas_campo_form'><?php echo ObtenerDatosModificacionRegistro($objaccionsocial->fechahora_mod, $objaccionsocial->usuario_mod); ?></td>
            </tr> 
             <tr> 
                <td class='rs_fila_nombrecolumna_form'>Creaci&oacute;n</td> 
                <td class='rs_filas_campo_form'><?php echo ObtenerDatosCreacionRegistro($objaccionsocial->fechahora_ins, $objaccionsocial->usuario_ins); ?></td>
            </tr> 
            
        </table>
    	</div>
      </div>
    </form>
    <script type="text/javascript" > document.getElementById("nombre_acs").focus(); </script>
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
    <form method='post' name="form_insertar_accionsocial" id="form_insertar_accionsocial" action='?accion=guardar&pag=<?php echo $pag ?>' enctype='multipart/form-data'>
    <div id="opcionesmenu_registros">
        <ul id="icons" class="ui-widget ui-helper-clearfix">
            <li class="ui-state-default ui-corner-all">
                <a class="dialog_link" onClick="window.location = 'accionsocial.php?pag=<?php echo $pag ?>'" href="#">
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
            <td class='rs_filas_campo_form'><input type='text' id='nombre_acs' name='nombre_acs' value=''  size='200' maxlength='200'></td>
        </tr> 

           <tr> 
            <td class='rs_fila_nombrecolumna_form'>Archivo</td> 
            <td class='rs_filas_campo_form'><input type='file' id='archivo_acs' name='archivo_acs'></td>
        </tr> 

           <tr> 
            <td class='rs_fila_nombrecolumna_form'>Orden</td> 
            <td class='rs_filas_campo_form'><input type='text' id='orden_acs' name='orden_acs' value=''  size='10' maxlength='10'></td>
        </tr> 

           <tr> 
            <td class='rs_fila_nombrecolumna_form'>Activo</td> 
            <td class='rs_filas_campo_form'><input id="activo_acs" name="activo_acs" type="checkbox" value="S" /></td>
        </tr> 

          
        </table>
    </div>
    
    </div>
    </form>
    <script type="text/javascript" > document.getElementById("nombre_acs").focus(); </script>
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
					
					array("Campo" => "nombre_acs", "Relacion" => $_POST['nombre_acs_relacion'], "Valor" => $_POST['nombre_acs_valor']),
					array("Campo" => "archivo_acs", "Relacion" => $_POST['archivo_acs_relacion'], "Valor" => $_POST['archivo_acs_valor']),
					array("Campo" => "orden_acs", "Relacion" => $_POST['orden_acs_relacion'], "Valor" => $_POST['orden_acs_valor']),
					array("Campo" => "activo_acs", "Relacion" => $_POST['activo_acs_relacion'], "Valor" => $_POST['activo_acs_valor']),
					""
					); 
				$objaccionsocial->filtros = $filtro;
				$_SESSION['accionsocial_filtro'] = $filtro;
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
				
				
				    // inicio file upload	
				
                @mkdir("../archivos_archivo_acs");
                
                if($_FILES['archivo_acs']['name'] !="")
				{
					SubirArchivo($_FILES['archivo_acs'],"../archivos_archivo_acs","8184");
				}

				if($id > 0)
				{
					$objaccionsocial->id_acs = $id;
					$objaccionsocial->ObtenerUnRegistro();
					if($_FILES['archivo_acs']['name'] !="")
					{ 
					  $objaccionsocial->archivo_acs =  date('Ymd'). '-' . limpiarNombreArchivo($_FILES['archivo_acs']['name']);
					}
				}
				else
				{
					$objaccionsocial->archivo_acs =  date('Ymd'). '-'.limpiarNombreArchivo($_FILES['archivo_acs']['name']);	
				}
	// fin file upload

				
				
				
				
					    $objaccionsocial->nombre_acs  = (isset($_POST['nombre_acs'])) ? $_POST['nombre_acs'] : '';

				
					    $objaccionsocial->orden_acs  = (isset($_POST['orden_acs'])) ? $_POST['orden_acs'] : '';

					    $objaccionsocial->activo_acs  = (isset($_POST['activo_acs'])) ? $_POST['activo_acs'] : 'N';


				$objaccionsocial->usuario_mod = $seguridad->personaid;

				if ($id > 0)
				{
					//Esto es una actualizaci&oacute;n de datos
					$objaccionsocial->id_acs = $id;
					$objaccionsocial->actualizar();	
				}
				else
				{
					//Esto es una inserci&oacute;n de datos
					$objaccionsocial->usuario_ins = $seguridad->personaid;
					$objaccionsocial->insertar();
				}
			}
			catch(Exception $e)
			{
				echo ImprimirError($e);
				exit;
			}
			$objaccionsocial->VaciarVariables();
			break;
		}
		case "borrar":
		{
		   //Borra un regsitro por su llave primaria, el almacenado en la variable $id.
			try
			{
				$objaccionsocial->id_acs =  $id;	
				$objaccionsocial->borrar();
			}
			catch(Exception $e)
			{
				echo ImprimirError($e);
				exit;
			}	
			$objaccionsocial->VaciarVariables();
			break;	
		}
	}
	//Buscar aplica el filtro que se haya podido establecer en la sesi&oacute;n.
	
        $rs = $objaccionsocial->buscararr($pag); 
	
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
            	
            Registros: <?php echo $objaccionsocial->totalfilas; 
			if ($objaccionsocial->totalfilas != $objaccionsocial->totalfilasfiltradas)
			echo " / Filtrados: ". $objaccionsocial->totalfilasfiltradas;
			?> 
         	</div>
        </div>
        <!-- Fin Botonera Listados de Regsitros -->
        
        <!-- Listado de Registros -->
        <div>
       
        </div>
        <?php  
        
        if ( $objaccionsocial->totalfilasfiltradas > 0)
			{ ?>
            <div id="tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all" >
			
           <table cellpadding="0" cellspacing="1" class="table_lista">
            <tr class="ui-tabs-nav ui-helper-reset  ui-widget-header ui-corner-all">
              <th class='rs_fila_nombrecolumna'></th>
              <th class='rs_fila_nombrecolumna'></th>
              <th class='rs_fila_nombrecolumna'>Id</th>
              
              <th class='rs_fila_nombrecolumna'>Nombre</th>
              <th class='rs_fila_nombrecolumna'>Archivo</th>
              <th class='rs_fila_nombrecolumna'>Orden</th>
              <th class='rs_fila_nombrecolumna'>Activo</th>
            </tr>
            <?php 
            
          
				foreach($rs as $userRow) 
				{  ?>
				<tr>
				  <td class='rs_fila_editar' width="1%">
				   <a id="boton_editar" class="ui-state-default ui-corner-all" href="?accion=editar&id=<?php echo $userRow["id_acs"]; ?>&pag=<?php echo $pag ?>">
				   <span class="ui-icon ui-icon-pencil"></span>&nbsp;</a>
				  </td>
				  <td class='rs_filas_eliminar' width="1%">
				  <a id="boton_borrar" class="ui-state-default ui-corner-all" href="?accion=borrar&id=<?php echo $userRow["id_acs"]; ?>&pag=<?php echo $pag ?>" onClick="return confirm('&iquest;Est&aacute; seguro que desea eliminar el registro con Id: <?php echo $userRow["id_acs"]; ?>?')">
				  <span class="ui-icon ui-icon-trash"></span>&nbsp;</a>
				  </td>
				  <td class='rs_filas' width="1%"><?php echo $userRow["id_acs"]; ?></td>
				  
                  	    <td class='rs_filas'><?php echo $userRow["nombre_acs"]; ?></td>

                  	    <td class='rs_filas'><?php echo $userRow["archivo_acs"]; ?></td>

                  	    <td class='rs_filas'><?php echo $userRow["orden_acs"]; ?></td>

                  	    <td class='rs_filas'><?php if($userRow["activo_acs"] == 'S') { echo "<input name='x' type='checkbox' disabled value='x' checked />"; } else { echo "<input name='x' type='checkbox' disabled value='x' />"; } ?></td>

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
            	<td><select name="nombre_acs_relacion" onChange="VaciarValor(this.form, 'nombre_acs_relacion' ,'nombre_acs_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objaccionsocial->filtros[0]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objaccionsocial->filtros[0]); ?>>distinto</option>
                    <option value="like" <?php ObtenerSeleccionFiltro("like",$objaccionsocial->filtros[0]); ?>>contiene</option>
                    <option value="like_ini" <?php ObtenerSeleccionFiltro("like_ini",$objaccionsocial->filtros[0]); ?>>comienza con</option>
                    <option value="like_fin" <?php ObtenerSeleccionFiltro("like_fin",$objaccionsocial->filtros[0]); ?>>termina con</option>
                </select>
            	</td>
            	<td><input name="nombre_acs_valor" value="<?php echo $objaccionsocial->filtros[0]["Valor"]; ?>" /></td>
            </tr>

		 	<tr>
            	<td>Archivo</td>
            	<td><select name="archivo_acs_relacion" onChange="VaciarValor(this.form, 'archivo_acs_relacion' ,'archivo_acs_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objaccionsocial->filtros[1]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objaccionsocial->filtros[1]); ?>>distinto</option>
                    <option value="like" <?php ObtenerSeleccionFiltro("like",$objaccionsocial->filtros[1]); ?>>contiene</option>
                    <option value="like_ini" <?php ObtenerSeleccionFiltro("like_ini",$objaccionsocial->filtros[1]); ?>>comienza con</option>
                    <option value="like_fin" <?php ObtenerSeleccionFiltro("like_fin",$objaccionsocial->filtros[1]); ?>>termina con</option>
                </select>
            	</td>
            	<td><input name="archivo_acs_valor" value="<?php echo $objaccionsocial->filtros[1]["Valor"]; ?>" /></td>
            </tr>

		 	<tr>
            	<td>Orden</td>
            	<td><select name="orden_acs_relacion" onChange="VaciarValor(this.form, 'orden_acs_relacion' ,'orden_acs_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objaccionsocial->filtros[2]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objaccionsocial->filtros[2]); ?>>distinto</option>
                    <option value="like" <?php ObtenerSeleccionFiltro("like",$objaccionsocial->filtros[2]); ?>>contiene</option>
                    <option value="like_ini" <?php ObtenerSeleccionFiltro("like_ini",$objaccionsocial->filtros[2]); ?>>comienza con</option>
                    <option value="like_fin" <?php ObtenerSeleccionFiltro("like_fin",$objaccionsocial->filtros[2]); ?>>termina con</option>
                </select>
            	</td>
            	<td><input name="orden_acs_valor" value="<?php echo $objaccionsocial->filtros[2]["Valor"]; ?>" /></td>
            </tr>

		 	<tr>
            	<td>Activo</td>
            	<td><select name="activo_acs_relacion" onChange="VaciarValor(this.form, 'activo_acs_relacion' ,'activo_acs_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objaccionsocial->filtros[3]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objaccionsocial->filtros[3]); ?>>distinto</option>
                    </select>
            	</td>
            	<td>
                <select name="activo_acs_valor" id="activo_acs_valor" onChange="VaciarValor(this.form, 'activo_acs_relacion' ,'activo_acs_valor')">
                	<option value=""></option>
                    <option value="S" <?php ObtenerSeleccionFiltro("S",$objaccionsocial->filtros[3]); ?>>S&iacute;</option>
                    <option value="N" <?php ObtenerSeleccionFiltro("N",$objaccionsocial->filtros[3]); ?>>No</option>
                </select></td>
            </tr>

            </table>
        </form>
		</div>
		<!-- Fin Dialogo Filtro -->
         <?php if ($objaccionsocial->totalfilas > 20 )  
		{ ?>


         <script type="text/javascript">
		$(function(){
		
			$("#paginacion").paginate({
			count 		: <?php echo ceil (($objaccionsocial->totalfilasfiltradas / 20)) ; ?>,
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