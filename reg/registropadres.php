<?php
/*

Creado En: 29/03/2013 07:45:41;
Creado Por: Sistema;
Modificado Por: ;
Modificado En: ;

*/

@session_start(); 

include_once("../_BRL/registropadres.ext.php");
include_once("../_UTL/funcionesUI.php");
include_once("../_UTL/inc_seguridad.php");
include_once("../_UTL/funcionesARCHIVOS.php");

//Isntancia del Objeto
$objregistropadres=new cregistropadres_ext;

//Los filtros que se apliquen a la seleccion se guardan en la sesi&oacute;n
if (isset($_SESSION['registropadres_filtro']))
{
	$objregistropadres->filtros = $_SESSION['registropadres_filtro'];
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
		<title>registropadres</title>
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

		 $('#form_editar_registropadres').submit();
		 // $('.wysiwyggen').elrte('updateSource');
		 // Uncomment in case of WYSIWYG
		}); 
		
		$('#form_editar_registropadres').validate({
			 submitHandler: function(form) {
				 form.submit();
			 }
		});
		
	

		$('#boton_insertar_validar').click(function() {
		 $('#form_insertar_registropadres').submit();
		 // $('.wysiwyggen').elrte('updateSource');
		 // Uncomment in case of WYSIWYG
		}); 
		
		$('#form_insertar_registropadres').validate({
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
    <div id="titulo_pagina">Gesti&oacute;n de registropadres</div>
   	<?php 
	switch ($accion) 
	{
		case "editar":
		{
			//Muestra el formulario para editar un registro espec&iacute;fico, el de la variable $id
			$objregistropadres->id_rgp = $id;
			$objregistropadres->ObtenerUnRegistro();
	?>
    <!-- Formulario Actualizaci&oacute;n de Registros -->
    <form method='post' name="form_editar_registropadres" id="form_editar_registropadres" action='?accion=guardar&id=<?php echo $id ?>&pag=<?php echo $pag ?>' enctype='multipart/form-data'>
    <div id="opcionesmenu_registros">
        <ul id="icons" class="ui-widget ui-helper-clearfix">
            <li class="ui-state-default ui-corner-all">
                <a class="dialog_link" onClick="window.location = 'registropadres.php?pag=<?php echo $pag ?>'" href="#">
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
                <td class='rs_filas_campo_form'><?php echo $objregistropadres->id_rgp ?></td>
            </tr> 
            
    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Nombre Padre</td> 
            <td class='rs_filas_campo_form'><input type='text' id='nombrepadre_rgp' name='nombrepadre_rgp' value='<?php echo $objregistropadres->nombrepadre_rgp ?>'  size='200' maxlength='200'></td>
        </tr> 

    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Nombre Madre</td> 
            <td class='rs_filas_campo_form'><input type='text' id='nombremadre_rgp' name='nombremadre_rgp' value='<?php echo $objregistropadres->nombremadre_rgp ?>'  size='200' maxlength='200'></td>
        </tr> 

    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Nombre Alumno</td> 
            <td class='rs_filas_campo_form'><input type='text' id='nombrealumno_rgp' name='nombrealumno_rgp' value='<?php echo $objregistropadres->nombrealumno_rgp ?>'  size='200' maxlength='200'></td>
        </tr> 

    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Curso</td> 
            <td class='rs_filas_campo_form'><input type='text' id='curso_rpg' name='curso_rpg' value='<?php echo $objregistropadres->curso_rpg ?>'  size='200' maxlength='200'></td>
        </tr> 

    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Telefono 1</td> 
            <td class='rs_filas_campo_form'><input type='text' id='telefono1_rgp' name='telefono1_rgp' value='<?php echo $objregistropadres->telefono1_rgp ?>'  size='20' maxlength='20'></td>
        </tr> 

    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Telefono 2</td> 
            <td class='rs_filas_campo_form'><input type='text' id='telefono2_rgp' name='telefono2_rgp' value='<?php echo $objregistropadres->telefono2_rgp ?>'  size='20' maxlength='20'></td>
        </tr> 

    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Correo 1</td> 
            <td class='rs_filas_campo_form'><input type='text' id='correo1_rgp' name='correo1_rgp' value='<?php echo $objregistropadres->correo1_rgp ?>'  size='200' maxlength='200'></td>
        </tr> 

    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Correo 2</td> 
            <td class='rs_filas_campo_form'><input type='text' id='correo2_rgp' name='correo2_rgp' value='<?php echo $objregistropadres->correo2_rgp ?>'  size='200' maxlength='200'></td>
        </tr> 

    	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>Fecha de registro</td> 
            <td class='rs_filas_campo_form'><script>
	$(function() {
			$( "#fecharegistro_rgp" ).datetimepicker({
			addSliderAccess: true,
			sliderAccessArgs: { touchonly: false },
			showOn: "button",
			buttonImage: "../img/calendar.gif",
			buttonImageOnly: true
		});
	});
	</script><input type='text' id='fecharegistro_rgp' name='fecharegistro_rgp' value='<?php echo $objregistropadres->fecharegistro_rgp ?>'  size='20' ></td>
        </tr> 

            <tr> 
                <td class='rs_fila_nombrecolumna_form'>&Uacute;ltima Modificaci&oacute;n</td> 
                <td class='rs_filas_campo_form'><?php echo ObtenerDatosModificacionRegistro($objregistropadres->fechahora_mod, $objregistropadres->usuario_mod); ?></td>
            </tr> 
             <tr> 
                <td class='rs_fila_nombrecolumna_form'>Creaci&oacute;n</td> 
                <td class='rs_filas_campo_form'><?php echo ObtenerDatosCreacionRegistro($objregistropadres->fechahora_ins, $objregistropadres->usuario_ins); ?></td>
            </tr> 
            
        </table>
    	</div>
      </div>
    </form>
    <script type="text/javascript" > document.getElementById("nombrepadre_rgp").focus(); </script>
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
    <form method='post' name="form_insertar_registropadres" id="form_insertar_registropadres" action='?accion=guardar&pag=<?php echo $pag ?>' enctype='multipart/form-data'>
    <div id="opcionesmenu_registros">
        <ul id="icons" class="ui-widget ui-helper-clearfix">
            <li class="ui-state-default ui-corner-all">
                <a class="dialog_link" onClick="window.location = 'registropadres.php?pag=<?php echo $pag ?>'" href="#">
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
            <td class='rs_fila_nombrecolumna_form'>Nombre Padre</td> 
            <td class='rs_filas_campo_form'><input type='text' id='nombrepadre_rgp' name='nombrepadre_rgp' value=''  size='200' maxlength='200'></td>
        </tr> 

           <tr> 
            <td class='rs_fila_nombrecolumna_form'>Nombre Madre</td> 
            <td class='rs_filas_campo_form'><input type='text' id='nombremadre_rgp' name='nombremadre_rgp' value=''  size='200' maxlength='200'></td>
        </tr> 

           <tr> 
            <td class='rs_fila_nombrecolumna_form'>Nombre Alumno</td> 
            <td class='rs_filas_campo_form'><input type='text' id='nombrealumno_rgp' name='nombrealumno_rgp' value=''  size='200' maxlength='200'></td>
        </tr> 

           <tr> 
            <td class='rs_fila_nombrecolumna_form'>Curso</td> 
            <td class='rs_filas_campo_form'><input type='text' id='curso_rpg' name='curso_rpg' value=''  size='200' maxlength='200'></td>
        </tr> 

           <tr> 
            <td class='rs_fila_nombrecolumna_form'>Telefono 1</td> 
            <td class='rs_filas_campo_form'><input type='text' id='telefono1_rgp' name='telefono1_rgp' value=''  size='20' maxlength='20'></td>
        </tr> 

           <tr> 
            <td class='rs_fila_nombrecolumna_form'>Telefono 2</td> 
            <td class='rs_filas_campo_form'><input type='text' id='telefono2_rgp' name='telefono2_rgp' value=''  size='20' maxlength='20'></td>
        </tr> 

           <tr> 
            <td class='rs_fila_nombrecolumna_form'>Correo 1</td> 
            <td class='rs_filas_campo_form'><input type='text' id='correo1_rgp' name='correo1_rgp' value=''  size='200' maxlength='200'></td>
        </tr> 

           <tr> 
            <td class='rs_fila_nombrecolumna_form'>Correo 2</td> 
            <td class='rs_filas_campo_form'><input type='text' id='correo2_rgp' name='correo2_rgp' value=''  size='200' maxlength='200'></td>
        </tr> 

           <tr> 
            <td class='rs_fila_nombrecolumna_form'>Fecha de registro</td> 
            <td class='rs_filas_campo_form'><script>
	$(function() {
		$( "#fecharegistro_rgp" ).datetimepicker({
			addSliderAccess: true,
			sliderAccessArgs: { touchonly: false },
			showOn: "button",
			buttonImage: "../img/calendar.gif",
			buttonImageOnly: true
		});
		
	});
	</script><input type='text' id='fecharegistro_rgp' name='fecharegistro_rgp' value=''  size='20' ></td>
        </tr> 

          
        </table>
    </div>
    
    </div>
    </form>
    <script type="text/javascript" > document.getElementById("nombrepadre_rgp").focus(); </script>
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
					
					array("Campo" => "nombrepadre_rgp", "Relacion" => $_POST['nombrepadre_rgp_relacion'], "Valor" => $_POST['nombrepadre_rgp_valor']),
					array("Campo" => "nombremadre_rgp", "Relacion" => $_POST['nombremadre_rgp_relacion'], "Valor" => $_POST['nombremadre_rgp_valor']),
					array("Campo" => "nombrealumno_rgp", "Relacion" => $_POST['nombrealumno_rgp_relacion'], "Valor" => $_POST['nombrealumno_rgp_valor']),
					array("Campo" => "curso_rpg", "Relacion" => $_POST['curso_rpg_relacion'], "Valor" => $_POST['curso_rpg_valor']),
					array("Campo" => "telefono1_rgp", "Relacion" => $_POST['telefono1_rgp_relacion'], "Valor" => $_POST['telefono1_rgp_valor']),
					array("Campo" => "telefono2_rgp", "Relacion" => $_POST['telefono2_rgp_relacion'], "Valor" => $_POST['telefono2_rgp_valor']),
					array("Campo" => "correo1_rgp", "Relacion" => $_POST['correo1_rgp_relacion'], "Valor" => $_POST['correo1_rgp_valor']),
					array("Campo" => "correo2_rgp", "Relacion" => $_POST['correo2_rgp_relacion'], "Valor" => $_POST['correo2_rgp_valor']),
					array("Campo" => "fecharegistro_rgp", "Relacion" => $_POST['fecharegistro_rgp_relacion'], "Valor" => $_POST['fecharegistro_rgp_valor']),
					""
					); 
				$objregistropadres->filtros = $filtro;
				$_SESSION['registropadres_filtro'] = $filtro;
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
				
				
				
				
				
				
				
				
				
				
				
				
					    $objregistropadres->nombrepadre_rgp  = (isset($_POST['nombrepadre_rgp'])) ? $_POST['nombrepadre_rgp'] : '';

					    $objregistropadres->nombremadre_rgp  = (isset($_POST['nombremadre_rgp'])) ? $_POST['nombremadre_rgp'] : '';

					    $objregistropadres->nombrealumno_rgp  = (isset($_POST['nombrealumno_rgp'])) ? $_POST['nombrealumno_rgp'] : '';

					    $objregistropadres->curso_rpg  = (isset($_POST['curso_rpg'])) ? $_POST['curso_rpg'] : '';

					    $objregistropadres->telefono1_rgp  = (isset($_POST['telefono1_rgp'])) ? $_POST['telefono1_rgp'] : '';

					    $objregistropadres->telefono2_rgp  = (isset($_POST['telefono2_rgp'])) ? $_POST['telefono2_rgp'] : '';

					    $objregistropadres->correo1_rgp  = (isset($_POST['correo1_rgp'])) ? $_POST['correo1_rgp'] : '';

					    $objregistropadres->correo2_rgp  = (isset($_POST['correo2_rgp'])) ? $_POST['correo2_rgp'] : '';

					    $objregistropadres->fecharegistro_rgp  = (isset($_POST['fecharegistro_rgp'])) ? $_POST['fecharegistro_rgp'] : '';


				$objregistropadres->usuario_mod = $seguridad->personaid;

				if ($id > 0)
				{
					//Esto es una actualizaci&oacute;n de datos
					$objregistropadres->id_rgp = $id;
					$objregistropadres->actualizar();	
				}
				else
				{
					//Esto es una inserci&oacute;n de datos
					$objregistropadres->usuario_ins = $seguridad->personaid;
					$objregistropadres->insertar();
				}
			}
			catch(Exception $e)
			{
				echo ImprimirError($e);
				exit;
			}
			$objregistropadres->VaciarVariables();
			break;
		}
		case "borrar":
		{
		   //Borra un regsitro por su llave primaria, el almacenado en la variable $id.
			try
			{
				$objregistropadres->id_rgp =  $id;	
				$objregistropadres->borrar();
			}
			catch(Exception $e)
			{
				echo ImprimirError($e);
				exit;
			}	
			$objregistropadres->VaciarVariables();
			break;	
		}
	}
	//Buscar aplica el filtro que se haya podido establecer en la sesi&oacute;n.
	
        $rs = $objregistropadres->buscararr($pag); 
	
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
            	
            Registros: <?php echo $objregistropadres->totalfilas; 
			if ($objregistropadres->totalfilas != $objregistropadres->totalfilasfiltradas)
			echo " / Filtrados: ". $objregistropadres->totalfilasfiltradas;
			?> 
         	</div>
        </div>
        <!-- Fin Botonera Listados de Regsitros -->
        
        <!-- Listado de Registros -->
        <div>
       
        </div>
        <?php  
        
        if ( $objregistropadres->totalfilasfiltradas > 0)
			{ ?>
            <div id="tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all" >
			
           <table cellpadding="0" cellspacing="1" class="table_lista">
            <tr class="ui-tabs-nav ui-helper-reset  ui-widget-header ui-corner-all">
              <th class='rs_fila_nombrecolumna'></th>
              <th class='rs_fila_nombrecolumna'></th>
              <th class='rs_fila_nombrecolumna'>Id</th>
              
              <th class='rs_fila_nombrecolumna'>Nombre Padre</th>
              <th class='rs_fila_nombrecolumna'>Nombre Madre</th>
              <th class='rs_fila_nombrecolumna'>Nombre Alumno</th>
              <th class='rs_fila_nombrecolumna'>Curso</th>
              <th class='rs_fila_nombrecolumna'>Telefono 1</th>
              <th class='rs_fila_nombrecolumna'>Telefono 2</th>
              <th class='rs_fila_nombrecolumna'>Correo 1</th>
              <th class='rs_fila_nombrecolumna'>Correo 2</th>
              <th class='rs_fila_nombrecolumna'>Fecha de registro</th>
            </tr>
            <?php 
            
          
				foreach($rs as $userRow) 
				{  ?>
				<tr>
				  <td class='rs_fila_editar' width="1%">
				   <a id="boton_editar" class="ui-state-default ui-corner-all" href="?accion=editar&id=<?php echo $userRow["id_rgp"]; ?>&pag=<?php echo $pag ?>">
				   <span class="ui-icon ui-icon-pencil"></span>&nbsp;</a>
				  </td>
				  <td class='rs_filas_eliminar' width="1%">
				  <a id="boton_borrar" class="ui-state-default ui-corner-all" href="?accion=borrar&id=<?php echo $userRow["id_rgp"]; ?>&pag=<?php echo $pag ?>" onClick="return confirm('&iquest;Est&aacute; seguro que desea eliminar el registro con Id: <?php echo $userRow["id_rgp"]; ?>?')">
				  <span class="ui-icon ui-icon-trash"></span>&nbsp;</a>
				  </td>
				  <td class='rs_filas' width="1%"><?php echo $userRow["id_rgp"]; ?></td>
				  
                  	    <td class='rs_filas'><?php echo $userRow["nombrepadre_rgp"]; ?></td>

                  	    <td class='rs_filas'><?php echo $userRow["nombremadre_rgp"]; ?></td>

                  	    <td class='rs_filas'><?php echo $userRow["nombrealumno_rgp"]; ?></td>

                  	    <td class='rs_filas'><?php echo $userRow["curso_rpg"]; ?></td>

                  	    <td class='rs_filas'><?php echo $userRow["telefono1_rgp"]; ?></td>

                  	    <td class='rs_filas'><?php echo $userRow["telefono2_rgp"]; ?></td>

                  	    <td class='rs_filas'><?php echo $userRow["correo1_rgp"]; ?></td>

                  	    <td class='rs_filas'><?php echo $userRow["correo2_rgp"]; ?></td>

                  	    <td class='rs_filas'><?php echo $userRow["fecharegistro_rgp"]; ?></td>

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
            	<td>Nombre Padre</td>
            	<td><select name="nombrepadre_rgp_relacion" onChange="VaciarValor(this.form, 'nombrepadre_rgp_relacion' ,'nombrepadre_rgp_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objregistropadres->filtros[0]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objregistropadres->filtros[0]); ?>>distinto</option>
                    <option value="like" <?php ObtenerSeleccionFiltro("like",$objregistropadres->filtros[0]); ?>>contiene</option>
                    <option value="like_ini" <?php ObtenerSeleccionFiltro("like_ini",$objregistropadres->filtros[0]); ?>>comienza con</option>
                    <option value="like_fin" <?php ObtenerSeleccionFiltro("like_fin",$objregistropadres->filtros[0]); ?>>termina con</option>
                </select>
            	</td>
            	<td><input name="nombrepadre_rgp_valor" value="<?php echo $objregistropadres->filtros[0]["Valor"]; ?>" /></td>
            </tr>

		 	<tr>
            	<td>Nombre Madre</td>
            	<td><select name="nombremadre_rgp_relacion" onChange="VaciarValor(this.form, 'nombremadre_rgp_relacion' ,'nombremadre_rgp_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objregistropadres->filtros[1]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objregistropadres->filtros[1]); ?>>distinto</option>
                    <option value="like" <?php ObtenerSeleccionFiltro("like",$objregistropadres->filtros[1]); ?>>contiene</option>
                    <option value="like_ini" <?php ObtenerSeleccionFiltro("like_ini",$objregistropadres->filtros[1]); ?>>comienza con</option>
                    <option value="like_fin" <?php ObtenerSeleccionFiltro("like_fin",$objregistropadres->filtros[1]); ?>>termina con</option>
                </select>
            	</td>
            	<td><input name="nombremadre_rgp_valor" value="<?php echo $objregistropadres->filtros[1]["Valor"]; ?>" /></td>
            </tr>

		 	<tr>
            	<td>Nombre Alumno</td>
            	<td><select name="nombrealumno_rgp_relacion" onChange="VaciarValor(this.form, 'nombrealumno_rgp_relacion' ,'nombrealumno_rgp_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objregistropadres->filtros[2]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objregistropadres->filtros[2]); ?>>distinto</option>
                    <option value="like" <?php ObtenerSeleccionFiltro("like",$objregistropadres->filtros[2]); ?>>contiene</option>
                    <option value="like_ini" <?php ObtenerSeleccionFiltro("like_ini",$objregistropadres->filtros[2]); ?>>comienza con</option>
                    <option value="like_fin" <?php ObtenerSeleccionFiltro("like_fin",$objregistropadres->filtros[2]); ?>>termina con</option>
                </select>
            	</td>
            	<td><input name="nombrealumno_rgp_valor" value="<?php echo $objregistropadres->filtros[2]["Valor"]; ?>" /></td>
            </tr>

		 	<tr>
            	<td>Curso</td>
            	<td><select name="curso_rpg_relacion" onChange="VaciarValor(this.form, 'curso_rpg_relacion' ,'curso_rpg_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objregistropadres->filtros[3]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objregistropadres->filtros[3]); ?>>distinto</option>
                    <option value="like" <?php ObtenerSeleccionFiltro("like",$objregistropadres->filtros[3]); ?>>contiene</option>
                    <option value="like_ini" <?php ObtenerSeleccionFiltro("like_ini",$objregistropadres->filtros[3]); ?>>comienza con</option>
                    <option value="like_fin" <?php ObtenerSeleccionFiltro("like_fin",$objregistropadres->filtros[3]); ?>>termina con</option>
                </select>
            	</td>
            	<td><input name="curso_rpg_valor" value="<?php echo $objregistropadres->filtros[3]["Valor"]; ?>" /></td>
            </tr>

		 	<tr>
            	<td>Telefono 1</td>
            	<td><select name="telefono1_rgp_relacion" onChange="VaciarValor(this.form, 'telefono1_rgp_relacion' ,'telefono1_rgp_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objregistropadres->filtros[4]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objregistropadres->filtros[4]); ?>>distinto</option>
                    <option value="like" <?php ObtenerSeleccionFiltro("like",$objregistropadres->filtros[4]); ?>>contiene</option>
                    <option value="like_ini" <?php ObtenerSeleccionFiltro("like_ini",$objregistropadres->filtros[4]); ?>>comienza con</option>
                    <option value="like_fin" <?php ObtenerSeleccionFiltro("like_fin",$objregistropadres->filtros[4]); ?>>termina con</option>
                </select>
            	</td>
            	<td><input name="telefono1_rgp_valor" value="<?php echo $objregistropadres->filtros[4]["Valor"]; ?>" /></td>
            </tr>

		 	<tr>
            	<td>Telefono 2</td>
            	<td><select name="telefono2_rgp_relacion" onChange="VaciarValor(this.form, 'telefono2_rgp_relacion' ,'telefono2_rgp_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objregistropadres->filtros[5]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objregistropadres->filtros[5]); ?>>distinto</option>
                    <option value="like" <?php ObtenerSeleccionFiltro("like",$objregistropadres->filtros[5]); ?>>contiene</option>
                    <option value="like_ini" <?php ObtenerSeleccionFiltro("like_ini",$objregistropadres->filtros[5]); ?>>comienza con</option>
                    <option value="like_fin" <?php ObtenerSeleccionFiltro("like_fin",$objregistropadres->filtros[5]); ?>>termina con</option>
                </select>
            	</td>
            	<td><input name="telefono2_rgp_valor" value="<?php echo $objregistropadres->filtros[5]["Valor"]; ?>" /></td>
            </tr>

		 	<tr>
            	<td>Correo 1</td>
            	<td><select name="correo1_rgp_relacion" onChange="VaciarValor(this.form, 'correo1_rgp_relacion' ,'correo1_rgp_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objregistropadres->filtros[6]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objregistropadres->filtros[6]); ?>>distinto</option>
                    <option value="like" <?php ObtenerSeleccionFiltro("like",$objregistropadres->filtros[6]); ?>>contiene</option>
                    <option value="like_ini" <?php ObtenerSeleccionFiltro("like_ini",$objregistropadres->filtros[6]); ?>>comienza con</option>
                    <option value="like_fin" <?php ObtenerSeleccionFiltro("like_fin",$objregistropadres->filtros[6]); ?>>termina con</option>
                </select>
            	</td>
            	<td><input name="correo1_rgp_valor" value="<?php echo $objregistropadres->filtros[6]["Valor"]; ?>" /></td>
            </tr>

		 	<tr>
            	<td>Correo 2</td>
            	<td><select name="correo2_rgp_relacion" onChange="VaciarValor(this.form, 'correo2_rgp_relacion' ,'correo2_rgp_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objregistropadres->filtros[7]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objregistropadres->filtros[7]); ?>>distinto</option>
                    <option value="like" <?php ObtenerSeleccionFiltro("like",$objregistropadres->filtros[7]); ?>>contiene</option>
                    <option value="like_ini" <?php ObtenerSeleccionFiltro("like_ini",$objregistropadres->filtros[7]); ?>>comienza con</option>
                    <option value="like_fin" <?php ObtenerSeleccionFiltro("like_fin",$objregistropadres->filtros[7]); ?>>termina con</option>
                </select>
            	</td>
            	<td><input name="correo2_rgp_valor" value="<?php echo $objregistropadres->filtros[7]["Valor"]; ?>" /></td>
            </tr>

		 	<tr>
            	<td>Fecha de registro</td>
            	<td><select name="fecharegistro_rgp_relacion" onChange="VaciarValor(this.form, 'fecharegistro_rgp_relacion' ,'fecharegistro_rgp_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$objregistropadres->filtros[8]); ?> >hoy</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$objregistropadres->filtros[8]); ?>>distinto de hoy</option>
                    <option value="<" <?php ObtenerSeleccionFiltro("<",$objregistropadres->filtros[8]); ?>>antes de</option>
                    <option value=">" <?php ObtenerSeleccionFiltro(">",$objregistropadres->filtros[8]); ?>>despues de</option>                                        
                </select>
            	</td>
            	<td><input name="fecharegistro_rgp_valor" value="<?php echo $objregistropadres->filtros[8]["Valor"]; ?>" /></td>
            </tr>

            </table>
        </form>
		</div>
		<!-- Fin Dialogo Filtro -->
         <?php if ($objregistropadres->totalfilas > 20 )  
		{ ?>


         <script type="text/javascript">
		$(function(){
		
			$("#paginacion").paginate({
			count 		: <?php echo ceil (($objregistropadres->totalfilasfiltradas / 20)) ; ?>,
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