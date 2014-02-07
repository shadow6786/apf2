<?php
/*

Creado En: 29/03/2013 05:35:13;
Creado Por: Sistema;
Modificado Por: ;
Modificado En: ;

*/

@session_start(); 

include_once("../_BRL/opcionesmenu.ext.php");
include_once("../_UTL/funcionesUI.php");
include_once("../_UTL/inc_seguridad.php");
include_once("../_UTL/funcionesARCHIVOS.php");

//Isntancia del Objeto
$objopcionesmenu=new copcionesmenu_ext;

//Los filtros que se apliquen a la seleccion se guardan en la sesi&oacute;n
if (isset($_SESSION['opcionesmenu_filtro']))
{
	$objopcionesmenu->filtros = $_SESSION['opcionesmenu_filtro'];
}
//Las acciones pueden ser: editar, nuevo, filtrar, guardar o borrar. Seg&uacute;n el valor se mostrar&uacute;n los formularios correspondientes  
$accion = '';
if (isset($_GET['accion'])) 
{  
	$accion = $_GET['accion']; 
}

$vfk = HacerArray("opcionesmenu","id_opm","nombre_opm");

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
		<title>Opciones de menú</title>
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

		 $('#form_editar_opcionesmenu').submit();
		 // $('.wysiwyggen').elrte('updateSource');
		 // Uncomment in case of WYSIWYG
		}); 
		
		$('#form_editar_opcionesmenu').validate({
			 submitHandler: function(form) {
				 form.submit();
			 }
		});
		
		$('#boton_insertar_validar').click(function() {
		 $('#form_insertar_opcionesmenu').submit();
		 // $('.wysiwyggen').elrte('updateSource');
		 // Uncomment in case of WYSIWYG
		}); 
		
		$('#form_insertar_opcionesmenu').validate({
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
    <div id="titulo_pagina">Gesti&oacute;n de opciones de men&uacute;</div>
   	<?php 
	switch ($accion) 
	{
		case "editar":
		{
			//Muestra el formulario para editar un registro espec&iacute;fico, el de la variable $id
			$objopcionesmenu->id_opm = $id;
			$objopcionesmenu->ObtenerUnRegistro();
	?>
    <!-- Formulario Actualizaci&oacute;n de Registros -->
    <form method='post' name="form_editar_opcionesmenu" id="form_editar_opcionesmenu" action='?accion=guardar&id=<?php echo $id ?>&pag=<?php echo $pag ?>' enctype='multipart/form-data'>
    <div id="opcionesmenu_registros">
        <ul id="icons" class="ui-widget ui-helper-clearfix">
            <li class="ui-state-default ui-corner-all">
                <a class="dialog_link" onClick="window.location = 'opcionesmenu.php?pag=<?php echo $pag ?>'" href="#">
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
                <td class='rs_filas_campo_form'><?php echo $objopcionesmenu->id_opm ?></td>
            </tr> 
            
    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Nombre</td> 
            <td class='rs_filas_campo_form'><input type='text' id='nombre_opm' name='nombre_opm' value='<?php echo $objopcionesmenu->nombre_opm ?>' title="Requerido!" class="{required:true,minlength:1}" size='50' maxlength='50'></td>
        </tr> 

    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Ruta</td> 
            <td class='rs_filas_campo_form'><input type='text' id='ruta_opm' name='ruta_opm' value='<?php echo $objopcionesmenu->ruta_opm ?>' title="Requerido!" class="{required:true,minlength:1}" size='50' maxlength='50'></td>
        </tr> 

    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>orden</td> 
            <td class='rs_filas_campo_form'><input type='text' id='orden_opm' name='orden_opm' value='<?php echo $objopcionesmenu->orden_opm ?>' title="Requerido!" class="{required:true,minlength:1}" size='20' maxlength='20'></td>
        </tr> 

    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Opci&oacute;n Padre</td> 
            <td class='rs_filas_campo_form'><?php echo HacerCombo('opcionesmenu','id_opm','nombre_opm',$objopcionesmenu->opcionpadre_opm,'opcionpadre_opm',''); ?></td>
        </tr> 

            <tr> 
                <td class='rs_fila_nombrecolumna_form'>&Uacute;ltima Modificaci&oacute;n</td> 
                <td class='rs_filas_campo_form'><?php echo ObtenerDatosModificacionRegistro($objopcionesmenu->fechahora_mod, $objopcionesmenu->usuario_mod); ?></td>
            </tr> 
             <tr> 
                <td class='rs_fila_nombrecolumna_form'>Creaci&oacute;n</td> 
                <td class='rs_filas_campo_form'><?php echo ObtenerDatosCreacionRegistro($objopcionesmenu->fechahora_ins, $objopcionesmenu->usuario_ins); ?></td>
            </tr> 
            
        </table>
    	</div>
      </div>
    </form>
    <script type="text/javascript" > document.getElementById("nombre_opm").focus(); </script>
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
    <form method='post' name="form_insertar_opcionesmenu" id="form_insertar_opcionesmenu" action='?accion=guardar&pag=<?php echo $pag ?>' enctype='multipart/form-data'>
    <div id="opcionesmenu_registros">
        <ul id="icons" class="ui-widget ui-helper-clearfix">
            <li class="ui-state-default ui-corner-all">
                <a class="dialog_link" onClick="window.location = 'opcionesmenu.php?pag=<?php echo $pag ?>'" href="#">
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
            <td class='rs_filas_campo_form'><input type='text' id='nombre_opm' name='nombre_opm' value='' title="Requerido!" class="{required:true,minlength:1}" size='50' maxlength='50'></td>
        </tr> 

           <tr> 
            <td class='rs_fila_nombrecolumna_form'>Ruta</td> 
            <td class='rs_filas_campo_form'><input type='text' id='ruta_opm' name='ruta_opm' value='' title="Requerido!" class="{required:true,minlength:1}" size='50' maxlength='50'></td>
        </tr> 

           <tr> 
            <td class='rs_fila_nombrecolumna_form'>orden</td> 
            <td class='rs_filas_campo_form'><input type='text' id='orden_opm' name='orden_opm' value='' title="Requerido!" class="{required:true,minlength:1}" size='20' maxlength='20'></td>
        </tr> 

           <tr> 
            <td class='rs_fila_nombrecolumna_form'>Opci&oacute;n Padre</td> 
            <td class='rs_filas_campo_form'><?php echo HacerCombo('opcionesmenu','id_opm','nombre_opm','','opcionpadre_opm',''); ?></td>
        </tr> 
        </table>
    </div>
    
    </div>
    </form>
    <script type="text/javascript" > document.getElementById("nombre_opm").focus(); </script>
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
					
					array("Campo" => "nombre_opm", "Relacion" => $_POST['nombre_opm_relacion'], "Valor" => $_POST['nombre_opm_valor']),
					array("Campo" => "ruta_opm", "Relacion" => $_POST['ruta_opm_relacion'], "Valor" => $_POST['ruta_opm_valor']),
					array("Campo" => "orden_opm", "Relacion" => $_POST['orden_opm_relacion'], "Valor" => $_POST['orden_opm_valor']),
					array("Campo" => "opcionpadre_opm", "Relacion" => $_POST['opcionpadre_opm_relacion'], "Valor" => $_POST['opcionpadre_opm_valor']),
					""
					); 
				$objopcionesmenu->filtros = $filtro;
				$_SESSION['opcionesmenu_filtro'] = $filtro;
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
			    $objopcionesmenu->nombre_opm  = (isset($_POST['nombre_opm'])) ? $_POST['nombre_opm'] : '';
			    $objopcionesmenu->ruta_opm  = (isset($_POST['ruta_opm'])) ? $_POST['ruta_opm'] : '';
			    $objopcionesmenu->orden_opm  = (isset($_POST['orden_opm'])) ? $_POST['orden_opm'] : '';
				$opcionpadre = 1;
				if(isset($_POST["opcionpadre_opm"]))
				{
					if($_POST["opcionpadre_opm"] != 0)
						$opcionpadre = $_POST["opcionpadre_opm"];
				}
			    $objopcionesmenu->opcionpadre_opm  = $opcionpadre;
				$objopcionesmenu->usuario_mod = $seguridad->personaid;
				if ($id > 0)
				{
					//Esto es una actualizaci&oacute;n de datos
					$objopcionesmenu->id_opm = $id;
					$objopcionesmenu->actualizar();	
				}
				else
				{
					//Esto es una inserci&oacute;n de datos
					$objopcionesmenu->usuario_ins = $seguridad->personaid;
					$objopcionesmenu->insertar();
				}
			}
			catch(Exception $e)
			{
				echo ImprimirError($e);
				exit;
			}
			$objopcionesmenu->VaciarVariables();
			break;
		}
		case "borrar":
		{
		   //Borra un regsitro por su llave primaria, el almacenado en la variable $id.
			try
			{
				$objopcionesmenu->id_opm =  $id;	
				$objopcionesmenu->borrar();
			}
			catch(Exception $e)
			{
				echo ImprimirError($e);
				exit;
			}	
			$objopcionesmenu->VaciarVariables();
			break;	
		}
	}
	//Buscar aplica el filtro que se haya podido establecer en la sesi&oacute;n.
	
        $rs = $objopcionesmenu->buscararr($pag); 
	
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
            	
            Registros: <?php echo $objopcionesmenu->totalfilas; 
			if ($objopcionesmenu->totalfilas != $objopcionesmenu->totalfilasfiltradas)
			echo " / Filtrados: ". $objopcionesmenu->totalfilasfiltradas;
			?> 
         	</div>
        </div>
        <!-- Fin Botonera Listados de Regsitros -->
        
        <!-- Listado de Registros -->
        <div>
       
        </div>
        <?php  
        
        if ( $objopcionesmenu->totalfilasfiltradas > 0)
			{ ?>
            <div id="tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all" >
			
           <table cellpadding="0" cellspacing="1" class="table_lista">
            <tr class="ui-tabs-nav ui-helper-reset  ui-widget-header ui-corner-all">
              <th class='rs_fila_nombrecolumna'></th>
              <th class='rs_fila_nombrecolumna'></th>
              <th class='rs_fila_nombrecolumna'>Id</th>
              
              <th class='rs_fila_nombrecolumna'>Nombre</th>
              <th class='rs_fila_nombrecolumna'>Ruta</th>
              <th class='rs_fila_nombrecolumna'>orden</th>
              <th class='rs_fila_nombrecolumna'>Opci&oacute;n Padre</th>
            </tr>
            <?php 
            
          
				foreach($rs as $userRow) 
				{  ?>
				<tr>
				  <td class='rs_fila_editar' width="1%">
				   <a id="boton_editar" class="ui-state-default ui-corner-all" href="?accion=editar&id=<?php echo $userRow["id_opm"]; ?>&pag=<?php echo $pag ?>">
				   <span class="ui-icon ui-icon-pencil"></span>&nbsp;</a>
				  </td>
				  <td class='rs_filas_eliminar' width="1%">
				  <a id="boton_borrar" class="ui-state-default ui-corner-all" href="?accion=borrar&id=<?php echo $userRow["id_opm"]; ?>&pag=<?php echo $pag ?>" onClick="return confirm('&iquest;Est&aacute; seguro que desea eliminar el registro con Id: <?php echo $userRow["id_opm"]; ?>?')">
				  <span class="ui-icon ui-icon-trash"></span>&nbsp;</a>
				  </td>
				  <td class='rs_filas' width="1%"><?php echo $userRow["id_opm"]; ?></td>
				  
                  	    <td class='rs_filas'><?php echo $userRow["nombre_opm"]; ?></td>

                  	    <td class='rs_filas'><?php echo $userRow["ruta_opm"]; ?></td>

                  	    <td class='rs_filas'><?php echo $userRow["orden_opm"]; ?></td>

                  	    <td class='rs_filas'><?php if(array_key_exists($userRow["opcionpadre_opm"],$vfk)) { echo $vfk[$userRow["opcionpadre_opm"]]; } else { echo  $userRow["opcionpadre_opm"];} ?></td>

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
            	<td><select name="nombre_opm_relacion" onChange="VaciarValor(this.form, 'nombre_opm_relacion' ,'nombre_opm_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objopcionesmenu->filtros[0]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objopcionesmenu->filtros[0]); ?>>distinto</option>
                    <option value="like" <?php ObtenerSeleccionFiltro("like",$objopcionesmenu->filtros[0]); ?>>contiene</option>
                    <option value="like_ini" <?php ObtenerSeleccionFiltro("like_ini",$objopcionesmenu->filtros[0]); ?>>comienza con</option>
                    <option value="like_fin" <?php ObtenerSeleccionFiltro("like_fin",$objopcionesmenu->filtros[0]); ?>>termina con</option>
                </select>
            	</td>
            	<td><input name="nombre_opm_valor" value="<?php echo $objopcionesmenu->filtros[0]["Valor"]; ?>" /></td>
            </tr>

		 	<tr>
            	<td>Ruta</td>
            	<td><select name="ruta_opm_relacion" onChange="VaciarValor(this.form, 'ruta_opm_relacion' ,'ruta_opm_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objopcionesmenu->filtros[1]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objopcionesmenu->filtros[1]); ?>>distinto</option>
                    <option value="like" <?php ObtenerSeleccionFiltro("like",$objopcionesmenu->filtros[1]); ?>>contiene</option>
                    <option value="like_ini" <?php ObtenerSeleccionFiltro("like_ini",$objopcionesmenu->filtros[1]); ?>>comienza con</option>
                    <option value="like_fin" <?php ObtenerSeleccionFiltro("like_fin",$objopcionesmenu->filtros[1]); ?>>termina con</option>
                </select>
            	</td>
            	<td><input name="ruta_opm_valor" value="<?php echo $objopcionesmenu->filtros[1]["Valor"]; ?>" /></td>
            </tr>

		 	<tr>
            	<td>orden</td>
            	<td><select name="orden_opm_relacion" onChange="VaciarValor(this.form, 'orden_opm_relacion' ,'orden_opm_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objopcionesmenu->filtros[2]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objopcionesmenu->filtros[2]); ?>>distinto</option>
                    <option value="like" <?php ObtenerSeleccionFiltro("like",$objopcionesmenu->filtros[2]); ?>>contiene</option>
                    <option value="like_ini" <?php ObtenerSeleccionFiltro("like_ini",$objopcionesmenu->filtros[2]); ?>>comienza con</option>
                    <option value="like_fin" <?php ObtenerSeleccionFiltro("like_fin",$objopcionesmenu->filtros[2]); ?>>termina con</option>
                </select>
            	</td>
            	<td><input name="orden_opm_valor" value="<?php echo $objopcionesmenu->filtros[2]["Valor"]; ?>" /></td>
            </tr>

		 	<tr>
            	<td>Opci&oacute;n Padre</td>
            	<td><select name="opcionpadre_opm_relacion" onChange="VaciarValor(this.form, 'opcionpadre_opm_relacion' ,'opcionpadre_opm_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objopcionesmenu->filtros[3]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objopcionesmenu->filtros[3]); ?>>distinto</option>
                    </select>
            	</td>
            	<td> <?php echo HacerCombo('','','',$objopcionesmenu->filtros[3]["Valor"],'opcionpadre_opm_valor',''); ?></td>
            </tr>

            </table>
        </form>
		</div>
		<!-- Fin Dialogo Filtro -->
         <?php if ($objopcionesmenu->totalfilas > 20 )  
		{ ?>


         <script type="text/javascript">
		$(function(){
		
			$("#paginacion").paginate({
			count 		: <?php echo ceil (($objopcionesmenu->totalfilasfiltradas / 20)) ; ?>,
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