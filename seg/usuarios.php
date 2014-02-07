<?php
/*

Creado En: 29/03/2013 07:45:41;
Creado Por: Sistema;
Modificado Por: ;
Modificado En: ;

*/

@session_start(); 

include_once("../_BRL/usuarios.ext.php");
include_once("../_UTL/funcionesUI.php");
include_once("../_UTL/inc_seguridad.php");
include_once("../_UTL/funcionesARCHIVOS.php");

//Isntancia del Objeto
$objusuarios=new cusuarios_ext;

//Los filtros que se apliquen a la seleccion se guardan en la sesi&oacute;n
if (isset($_SESSION['usuarios_filtro']))
{
	$objusuarios->filtros = $_SESSION['usuarios_filtro'];
}
//Las acciones pueden ser: editar, nuevo, filtrar, guardar o borrar. Seg&uacute;n el valor se mostrar&uacute;n los formularios correspondientes  
$accion = '';
if (isset($_GET['accion'])) 
{  
	$accion = $_GET['accion']; 
}

$vfkroles = HacerArray("roles","id_rol","nombre_rol");


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
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>usuarios</title>
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

		 $('#form_editar_usuarios').submit();
		 // $('.wysiwyggen').elrte('updateSource');
		 // Uncomment in case of WYSIWYG
		}); 
		
		$('#form_editar_usuarios').validate({
			 submitHandler: function(form) {
				 form.submit();
			 }
		});
		
	

		$('#boton_insertar_validar').click(function() {
		 $('#form_insertar_usuarios').submit();
		 // $('.wysiwyggen').elrte('updateSource');
		 // Uncomment in case of WYSIWYG
		}); 
		
		$('#form_insertar_usuarios').validate({
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
    <div id="titulo_pagina">Gesti&oacute;n de usuarios</div>
   	<?php 
	switch ($accion) 
	{
		case "editar":
		{
			//Muestra el formulario para editar un registro espec&iacute;fico, el de la variable $id
			$objusuarios->id_usr = $id;
			$objusuarios->ObtenerUnRegistro();
	?>
    <!-- Formulario Actualizaci&oacute;n de Registros -->
    <form method='post' name="form_editar_usuarios" id="form_editar_usuarios" action='?accion=guardar&id=<?php echo $id ?>&pag=<?php echo $pag ?>' enctype='multipart/form-data'>
    <div id="opcionesmenu_registros">
        <ul id="icons" class="ui-widget ui-helper-clearfix">
            <li class="ui-state-default ui-corner-all">
                <a class="dialog_link" onClick="window.location = 'usuarios.php?pag=<?php echo $pag ?>'" href="#">
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
                <td class='rs_filas_campo_form'><?php echo $objusuarios->id_usr ?></td>
            </tr> 
            
    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Nombres</td> 
            <td class='rs_filas_campo_form'><input type='text' id='nombres_usr' name='nombres_usr' value='<?php echo $objusuarios->nombres_usr ?>' title="Requerido!" class="{required:true,minlength:1}" size='30' maxlength='30'></td>
        </tr> 

    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Apellido Paterno</td> 
            <td class='rs_filas_campo_form'><input type='text' id='apellidopaterno_usr' name='apellidopaterno_usr' value='<?php echo $objusuarios->apellidopaterno_usr ?>' title="Requerido!" class="{required:true,minlength:1}" size='80' maxlength='80'></td>
        </tr> 

    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Apellido Materno</td> 
            <td class='rs_filas_campo_form'><input type='text' id='apellidomaterno_usr' name='apellidomaterno_usr' value='<?php echo $objusuarios->apellidomaterno_usr ?>'  size='80' maxlength='80'></td>
        </tr> 

    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Clave</td> 
            <td class='rs_filas_campo_form'><input type='password" ' id='clave_usr' name='clave_usr' value='<?php echo $objusuarios->clave_usr ?>' title="Requerido!" class="{required:true,minlength:1}" size='128' maxlength='128'></td>
        </tr> 

    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Usuario</td> 
            <td class='rs_filas_campo_form'><input type='text' id='usuario_usr' name='usuario_usr' value='<?php echo $objusuarios->usuario_usr ?>' title="Requerido!" class="{required:true,minlength:1}" size='150' maxlength='150'></td>
        </tr> 

    	   

    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Rol</td> 
            <td class='rs_filas_campo_form'><?php echo HacerCombo('roles','id_rol','nombre_rol',$objusuarios->rol_usr,'rol_usr',''); ?></td>
        </tr> 

    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Activo</td> 
            <td class='rs_filas_campo_form'><input name="activo_usr" type="checkbox" id="activo_usr" value="S" <?php if($objusuarios->activo_usr == "S") {echo 'checked="checked"';}  ?> /></td>
        </tr> 

            <tr> 
                <td class='rs_fila_nombrecolumna_form'>&Uacute;ltima Modificaci&oacute;n</td> 
                <td class='rs_filas_campo_form'><?php echo ObtenerDatosModificacionRegistro($objusuarios->fechahora_mod, $objusuarios->usuario_mod); ?></td>
            </tr> 
             <tr> 
                <td class='rs_fila_nombrecolumna_form'>Creaci&oacute;n</td> 
                <td class='rs_filas_campo_form'><?php echo ObtenerDatosCreacionRegistro($objusuarios->fechahora_ins, $objusuarios->usuario_ins); ?></td>
            </tr> 
            
        </table>
    	</div>
      </div>
    </form>
    <script type="text/javascript" > document.getElementById("nombres_usr").focus(); </script>
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
    <form method='post' name="form_insertar_usuarios" id="form_insertar_usuarios" action='?accion=guardar&pag=<?php echo $pag ?>' enctype='multipart/form-data'>
    <div id="opcionesmenu_registros">
        <ul id="icons" class="ui-widget ui-helper-clearfix">
            <li class="ui-state-default ui-corner-all">
                <a class="dialog_link" onClick="window.location = 'usuarios.php?pag=<?php echo $pag ?>'" href="#">
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
            <td class='rs_fila_nombrecolumna_form'>Nombres</td> 
            <td class='rs_filas_campo_form'><input type='text' id='nombres_usr' name='nombres_usr' value='' title="Requerido!" class="{required:true,minlength:1}" size='30' maxlength='30'></td>
        </tr> 

           <tr> 
            <td class='rs_fila_nombrecolumna_form'>Apellido Paterno</td> 
            <td class='rs_filas_campo_form'><input type='text' id='apellidopaterno_usr' name='apellidopaterno_usr' value='' title="Requerido!" class="{required:true,minlength:1}" size='80' maxlength='80'></td>
        </tr> 

           <tr> 
            <td class='rs_fila_nombrecolumna_form'>Apellido Materno</td> 
            <td class='rs_filas_campo_form'><input type='text' id='apellidomaterno_usr' name='apellidomaterno_usr' value=''  size='80' maxlength='80'></td>
        </tr> 

           <tr> 
            <td class='rs_fila_nombrecolumna_form'>Clave</td> 
            <td class='rs_filas_campo_form'><input type='password" ' id='clave_usr' name='clave_usr' value='' title="Requerido!" class="{required:true,minlength:1}" size='128' maxlength='128'></td>
        </tr> 

           <tr> 
            <td class='rs_fila_nombrecolumna_form'>Usuario</td> 
            <td class='rs_filas_campo_form'><input type='text' id='usuario_usr' name='usuario_usr' value='' title="Requerido!" class="{required:true,minlength:1}" size='150' maxlength='150'></td>
        </tr> 

           <tr> 
            <td class='rs_fila_nombrecolumna_form'>Rol</td> 
            <td class='rs_filas_campo_form'><?php echo HacerCombo('roles','id_rol','nombre_rol','','rol_usr',''); ?></td>
        </tr> 

           <tr> 
            <td class='rs_fila_nombrecolumna_form'>Activo</td> 
            <td class='rs_filas_campo_form'><input id="activo_usr" name="activo_usr" type="checkbox" value="S" /></td>
        </tr> 

          
        </table>
    </div>
    
    </div>
    </form>
    <script type="text/javascript" > document.getElementById("nombres_usr").focus(); </script>
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
					
					array("Campo" => "nombres_usr", "Relacion" => $_POST['nombres_usr_relacion'], "Valor" => $_POST['nombres_usr_valor']),
					array("Campo" => "apellidopaterno_usr", "Relacion" => $_POST['apellidopaterno_usr_relacion'], "Valor" => $_POST['apellidopaterno_usr_valor']),
					array("Campo" => "apellidomaterno_usr", "Relacion" => $_POST['apellidomaterno_usr_relacion'], "Valor" => $_POST['apellidomaterno_usr_valor']),
					array("Campo" => "clave_usr", "Relacion" => $_POST['clave_usr_relacion'], "Valor" => $_POST['clave_usr_valor']),
					array("Campo" => "usuario_usr", "Relacion" => $_POST['usuario_usr_relacion'], "Valor" => $_POST['usuario_usr_valor']),
					array("Campo" => "claveanterior_usr", "Relacion" => $_POST['claveanterior_usr_relacion'], "Valor" => $_POST['claveanterior_usr_valor']),
					array("Campo" => "rol_usr", "Relacion" => $_POST['rol_usr_relacion'], "Valor" => $_POST['rol_usr_valor']),
					array("Campo" => "activo_usr", "Relacion" => $_POST['activo_usr_relacion'], "Valor" => $_POST['activo_usr_valor']),
					""
					); 
				$objusuarios->filtros = $filtro;
				$_SESSION['usuarios_filtro'] = $filtro;
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
				$objusuarios->nombres_usr  = (isset($_POST['nombres_usr'])) ? $_POST['nombres_usr'] : '';
			    $objusuarios->apellidopaterno_usr  = (isset($_POST['apellidopaterno_usr'])) ? $_POST['apellidopaterno_usr'] : '';
			    $objusuarios->apellidomaterno_usr  = (isset($_POST['apellidomaterno_usr'])) ? $_POST['apellidomaterno_usr'] : '';
			    $objusuarios->clave_usr  = (isset($_POST['clave_usr'])) ? $_POST['clave_usr'] : '';
			    $objusuarios->usuario_usr  = (isset($_POST['usuario_usr'])) ? $_POST['usuario_usr'] : '';
			    $objusuarios->claveanterior_usr  = (isset($_POST['claveanterior_usr'])) ? $_POST['claveanterior_usr'] : '';
			    $objusuarios->rol_usr  = (isset($_POST['rol_usr'])) ? $_POST['rol_usr'] : '';
			    $objusuarios->activo_usr  = (isset($_POST['activo_usr'])) ? $_POST['activo_usr'] : 'N';
				$objusuarios->usuario_mod = $seguridad->personaid;

				if ($id > 0)
				{
					//Esto es una actualizaci&oacute;n de datos
					$objusuarios->id_usr = $id;
					$objusuarios->actualizar();	
				}
				else
				{
					//Esto es una inserci&oacute;n de datos
					$objusuarios->usuario_ins = $seguridad->personaid;
					$objusuarios->insertar();
				}
			}
			catch(Exception $e)
			{
				echo ImprimirError($e);
				exit;
			}
			$objusuarios->VaciarVariables();
			break;
		}
		case "borrar":
		{
		   //Borra un regsitro por su llave primaria, el almacenado en la variable $id.
			try
			{
				$objusuarios->id_usr =  $id;	
				$objusuarios->borrar();
			}
			catch(Exception $e)
			{
				echo ImprimirError($e);
				exit;
			}	
			$objusuarios->VaciarVariables();
			break;	
		}
	}
	//Buscar aplica el filtro que se haya podido establecer en la sesi&oacute;n.
	
        $rs = $objusuarios->buscararr($pag); 
	
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
            	
            Registros: <?php echo $objusuarios->totalfilas; 
			if ($objusuarios->totalfilas != $objusuarios->totalfilasfiltradas)
			echo " / Filtrados: ". $objusuarios->totalfilasfiltradas;
			?> 
         	</div>
        </div>
        <!-- Fin Botonera Listados de Regsitros -->
        
        <!-- Listado de Registros -->
        <div>
       
        </div>
        <?php  
        
        if ( $objusuarios->totalfilasfiltradas > 0)
			{ ?>
            <div id="tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all" >
			
           <table cellpadding="0" cellspacing="1" class="table_lista">
            <tr class="ui-tabs-nav ui-helper-reset  ui-widget-header ui-corner-all">
              <th class='rs_fila_nombrecolumna'></th>
              <th class='rs_fila_nombrecolumna'></th>
              <th class='rs_fila_nombrecolumna'>Id</th>
              
              <th class='rs_fila_nombrecolumna'>Nombres</th>
              <th class='rs_fila_nombrecolumna'>Apellido Paterno</th>
              <th class='rs_fila_nombrecolumna'>Apellido Materno</th>
              
              <th class='rs_fila_nombrecolumna'>Usuario</th>
              
              <th class='rs_fila_nombrecolumna'>Rol</th>
              <th class='rs_fila_nombrecolumna'>Activo</th>
            </tr>
            <?php 
            
          
				foreach($rs as $userRow) 
				{  ?>
				<tr>
				  <td class='rs_fila_editar' width="1%">
				   <a id="boton_editar" class="ui-state-default ui-corner-all" href="?accion=editar&id=<?php echo $userRow["id_usr"]; ?>&pag=<?php echo $pag ?>">
				   <span class="ui-icon ui-icon-pencil"></span>&nbsp;</a>
				  </td>
				  <td class='rs_filas_eliminar' width="1%">
				  <a id="boton_borrar" class="ui-state-default ui-corner-all" href="?accion=borrar&id=<?php echo $userRow["id_usr"]; ?>&pag=<?php echo $pag ?>" onClick="return confirm('&iquest;Est&aacute; seguro que desea eliminar el registro con Id: <?php echo $userRow["id_usr"]; ?>?')">
				  <span class="ui-icon ui-icon-trash"></span>&nbsp;</a>
				  </td>
				  <td class='rs_filas' width="1%"><?php echo $userRow["id_usr"]; ?></td>
				  
                  	    <td class='rs_filas'><?php echo $userRow["nombres_usr"]; ?></td>

                  	    <td class='rs_filas'><?php echo $userRow["apellidopaterno_usr"]; ?></td>

                  	    <td class='rs_filas'><?php echo $userRow["apellidomaterno_usr"]; ?></td>

                  	    

                  	    <td class='rs_filas'><?php echo $userRow["usuario_usr"]; ?></td>

                  	   

                  	    <td class='rs_filas'><?php if(array_key_exists($userRow["rol_usr"],$vfkroles)) { echo $vfkroles[$userRow["rol_usr"]]; } else { echo  $userRow["rol_usr"];} ?></td>

                  	    <td class='rs_filas'><?php if($userRow["activo_usr"] == 'S') { echo "<input name='x' type='checkbox' disabled value='x' checked />"; } else { echo "<input name='x' type='checkbox' disabled value='x' />"; } ?></td>

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
            	<td>Nombres</td>
            	<td><select name="nombres_usr_relacion" onChange="VaciarValor(this.form, 'nombres_usr_relacion' ,'nombres_usr_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objusuarios->filtros[0]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objusuarios->filtros[0]); ?>>distinto</option>
                    <option value="like" <?php ObtenerSeleccionFiltro("like",$objusuarios->filtros[0]); ?>>contiene</option>
                    <option value="like_ini" <?php ObtenerSeleccionFiltro("like_ini",$objusuarios->filtros[0]); ?>>comienza con</option>
                    <option value="like_fin" <?php ObtenerSeleccionFiltro("like_fin",$objusuarios->filtros[0]); ?>>termina con</option>
                </select>
            	</td>
            	<td><input name="nombres_usr_valor" value="<?php echo $objusuarios->filtros[0]["Valor"]; ?>" /></td>
            </tr>

		 	<tr>
            	<td>Apellido Paterno</td>
            	<td><select name="apellidopaterno_usr_relacion" onChange="VaciarValor(this.form, 'apellidopaterno_usr_relacion' ,'apellidopaterno_usr_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objusuarios->filtros[1]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objusuarios->filtros[1]); ?>>distinto</option>
                    <option value="like" <?php ObtenerSeleccionFiltro("like",$objusuarios->filtros[1]); ?>>contiene</option>
                    <option value="like_ini" <?php ObtenerSeleccionFiltro("like_ini",$objusuarios->filtros[1]); ?>>comienza con</option>
                    <option value="like_fin" <?php ObtenerSeleccionFiltro("like_fin",$objusuarios->filtros[1]); ?>>termina con</option>
                </select>
            	</td>
            	<td><input name="apellidopaterno_usr_valor" value="<?php echo $objusuarios->filtros[1]["Valor"]; ?>" /></td>
            </tr>

		 	<tr>
            	<td>Apellido Materno</td>
            	<td><select name="apellidomaterno_usr_relacion" onChange="VaciarValor(this.form, 'apellidomaterno_usr_relacion' ,'apellidomaterno_usr_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objusuarios->filtros[2]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objusuarios->filtros[2]); ?>>distinto</option>
                    <option value="like" <?php ObtenerSeleccionFiltro("like",$objusuarios->filtros[2]); ?>>contiene</option>
                    <option value="like_ini" <?php ObtenerSeleccionFiltro("like_ini",$objusuarios->filtros[2]); ?>>comienza con</option>
                    <option value="like_fin" <?php ObtenerSeleccionFiltro("like_fin",$objusuarios->filtros[2]); ?>>termina con</option>
                </select>
            	</td>
            	<td><input name="apellidomaterno_usr_valor" value="<?php echo $objusuarios->filtros[2]["Valor"]; ?>" /></td>
            </tr>

		 	<tr>
            	<td>Clave</td>
            	<td><select name="clave_usr_relacion" onChange="VaciarValor(this.form, 'clave_usr_relacion' ,'clave_usr_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objusuarios->filtros[3]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objusuarios->filtros[3]); ?>>distinto</option>
                    <option value="like" <?php ObtenerSeleccionFiltro("like",$objusuarios->filtros[3]); ?>>contiene</option>
                    <option value="like_ini" <?php ObtenerSeleccionFiltro("like_ini",$objusuarios->filtros[3]); ?>>comienza con</option>
                    <option value="like_fin" <?php ObtenerSeleccionFiltro("like_fin",$objusuarios->filtros[3]); ?>>termina con</option>
                </select>
            	</td>
            	<td><input name="clave_usr_valor" value="<?php echo $objusuarios->filtros[3]["Valor"]; ?>" /></td>
            </tr>

		 	<tr>
            	<td>Usuario</td>
            	<td><select name="usuario_usr_relacion" onChange="VaciarValor(this.form, 'usuario_usr_relacion' ,'usuario_usr_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objusuarios->filtros[4]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objusuarios->filtros[4]); ?>>distinto</option>
                    <option value="like" <?php ObtenerSeleccionFiltro("like",$objusuarios->filtros[4]); ?>>contiene</option>
                    <option value="like_ini" <?php ObtenerSeleccionFiltro("like_ini",$objusuarios->filtros[4]); ?>>comienza con</option>
                    <option value="like_fin" <?php ObtenerSeleccionFiltro("like_fin",$objusuarios->filtros[4]); ?>>termina con</option>
                </select>
            	</td>
            	<td><input name="usuario_usr_valor" value="<?php echo $objusuarios->filtros[4]["Valor"]; ?>" /></td>
            </tr>

		 	<tr>
            	<td>Clave Anterior</td>
            	<td><select name="claveanterior_usr_relacion" onChange="VaciarValor(this.form, 'claveanterior_usr_relacion' ,'claveanterior_usr_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objusuarios->filtros[5]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objusuarios->filtros[5]); ?>>distinto</option>
                    <option value="like" <?php ObtenerSeleccionFiltro("like",$objusuarios->filtros[5]); ?>>contiene</option>
                    <option value="like_ini" <?php ObtenerSeleccionFiltro("like_ini",$objusuarios->filtros[5]); ?>>comienza con</option>
                    <option value="like_fin" <?php ObtenerSeleccionFiltro("like_fin",$objusuarios->filtros[5]); ?>>termina con</option>
                </select>
            	</td>
            	<td><input name="claveanterior_usr_valor" value="<?php echo $objusuarios->filtros[5]["Valor"]; ?>" /></td>
            </tr>

		 	<tr>
            	<td>Rol</td>
            	<td><select name="rol_usr_relacion" onChange="VaciarValor(this.form, 'rol_usr_relacion' ,'rol_usr_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objusuarios->filtros[6]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objusuarios->filtros[6]); ?>>distinto</option>
                    </select>
            	</td>
            	<td> <?php echo HacerCombo('roles','id_rol','nombre_rol',$objusuarios->filtros[6]["Valor"],'rol_usr_valor',''); ?></td>
            </tr>

		 	<tr>
            	<td>Activo</td>
            	<td><select name="activo_usr_relacion" onChange="VaciarValor(this.form, 'activo_usr_relacion' ,'activo_usr_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objusuarios->filtros[7]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objusuarios->filtros[7]); ?>>distinto</option>
                    </select>
            	</td>
            	<td>
                <select name="activo_usr_valor" id="activo_usr_valor" onChange="VaciarValor(this.form, 'activo_usr_relacion' ,'activo_usr_valor')">
                	<option value=""></option>
                    <option value="S" <?php ObtenerSeleccionFiltro("S",$objusuarios->filtros[7]); ?>>S&iacute;</option>
                    <option value="N" <?php ObtenerSeleccionFiltro("N",$objusuarios->filtros[7]); ?>>No</option>
                </select></td>
            </tr>

            </table>
        </form>
		</div>
		<!-- Fin Dialogo Filtro -->
         <?php if ($objusuarios->totalfilas > 20 )  
		{ ?>


         <script type="text/javascript">
		$(function(){
		
			$("#paginacion").paginate({
			count 		: <?php echo ceil (($objusuarios->totalfilasfiltradas / 20)) ; ?>,
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