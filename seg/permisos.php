<?php
/*

Creado En: 27/07/2011 02:12:16;
Creado Por: Nicolás Zalles;
Modificado Por: Nicolás Zalles;
Modificado En: 27/07/2011 02:12:16 ;

*/
 @session_start();
include_once("../_DAL/conexion.php");
include_once('../_UTL/seguridad.php');
include_once('../_UTL/funcionesUI.php');
include_once("../_BRL/permisos.ext.php");
include_once("../_BRL/roles.ext.php");


if(isset($_SESSION['usrlogin']))
{
 	$seguridad = unserialize($_SESSION['usrlogin']);
	
} else {
	$seguridad = new CSecurity();
}


//Isntancia del Objeto
$objpermisos=new cpermisos_ext;

$rol = "0";
if (isset($_GET["rol"])) 
{  
	$rol = $_GET["rol"]; 
}

$op_menu = '';
if (isset($_GET['op_menu'])) 
{  
	$op_menu = $_GET['op_menu']; 
	
}
	
$accion = '';
if (isset($_GET['accion'])) 
{  
	$accion = $_GET['accion']; 
}

	
if ($accion == "guardar")
{ 
	
	
	// borrar todos los permisos primero
	try
	{
		$objpermisos->rol_per =  $rol;	
		$objpermisos->borrarPorRol();
	}
	catch(Exception $e)
	{
		echo ImprimirError($e);
		exit;
	}	
			
		
	 $tempInput = preg_split('/,/', $op_menu);
	 $indexCount=0;
	 foreach($tempInput as $values)
     {
			
			try
			{
				
				//guardar
				if ($tempInput[$indexCount] != 0 ) 
				{ 
					$objpermisos->rol_per  = $rol;
					$objpermisos->opcionmenu_per = $tempInput[$indexCount];
					$objpermisos->usuario_ins =$seguridad->userid;;
					$objpermisos->usuario_mod =$seguridad->userid;;
					$objpermisos->insertar();
				}
			}
			catch(Exception $e)
			{
				echo ImprimirError($e);
				
			}

		$indexCount++; 
	 }

}

function RevisarMarcacion($id)
{
	$objpermisos=new cpermisos_ext;
	$rol = "0";
if (isset($_GET["rol"])) 
{  
	$rol = $_GET["rol"]; 
}
	return $objpermisos->TienePermisos($id,$rol);
}
?>                   
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Permisos</title>
	<link type="text/css" href="../css/redmond/jquery-ui-1.8.14.custom.css" rel="stylesheet" />	
	<script type="text/javascript" src="../js/jquery-1.5.1.min.js"></script>
    <script type="text/javascript" src="../js/jquery-ui-1.8.14.custom.min.js"></script>
    <link rel="stylesheet" href="../css/mgEstiloAdmin.css" type="text/css">
    <script type="text/javascript" src="../js/jquery.dynatree.js"></script>
    <script type="text/javascript" src="../js/jquery.cookie.js"></script>
    <link href="../css/skintreeview/ui.dynatree.css" rel="stylesheet" type="text/css" id="skinSheet">
   
	<script type="text/javascript">

	/* 
	TreeView: http://wwwendt.de/tech/dynatree/doc/dynatree-doc.html
	*/
	var treeData = [
	
	
		<?php 
		
			include_once("../_BRL/opcionesmenu.ext.php");
			
			$objE = new copcionesmenu_ext;
			
			$rs = $objE->ObtenerAgrupadores(); 
						
            for ($i= 0; $i < $rs->rowCount(); $i++) 
            {  
			      $userRow = $rs->getNext(new copcionesmenu_ext());
				  
				  ?>
              {title: "<?php echo $userRow->nombre_opm; ?>", select:  <?php echo RevisarMarcacion($userRow->id_opm) ?>, isFolder: true, key: "<?php echo $userRow->id_opm; ?>", children: [
               	
                		<?php
						$objE2 = new copcionesmenu_ext;
			
						$rs2 = $objE2->ObtenerContenidoAgrupadores($userRow->id_opm); 
						
						 for ($i2= 0; $i2 < $rs2->rowCount(); $i2++) 
						{  
							  $userRow2 = $rs2->getNext(new copcionesmenu_ext());
							?>
									{title: "<?php echo $userRow2->nombre_opm; ?>", select:  <?php echo RevisarMarcacion($userRow2->id_opm) ?>, key: "<?php echo $userRow2->id_opm; ?>" }
								<?php
								if ($i2 < $rs2->rowCount()-1 ) echo ","; 
							 }
						?>
                   	]
					

				}<?php  if ($i < $rs->rowCount()-1 ) echo ",";   ?>
				
			
               <?php  } ?>	  
    	
   
   ];
		
	$(function(){

		// Tabs
			$('#tabs').tabs();
			$('#tabs2').tabs();
			
			$('ul#icons li, #boton_editar, #boton_borrar').hover(
			function() { $(this).addClass('ui-state-hover'); }, 
			function() { $(this).removeClass('ui-state-hover'); }
			);
			
			$("#btnCollapseAll").click(function(){

			$("#arbol").dynatree("getRoot").visit(function(node){

				node.expand(false);

			});

			return false;

		});

		$("#btnExpandAll").click(function(){

			$("#arbol").dynatree("getRoot").visit(function(node){

				node.expand(true);

			});

			return false;

		});

		$("#arbol").dynatree({

			checkbox: true,

			selectMode: 2,

			children: treeData,

			onSelect: function(select, node) {

				// Get a list of all selected nodes, and convert to a key array:

				var selKeys = $.map(node.tree.getSelectedNodes(), function(node){

					return node.data.key;

				});

				$("#echoSelection3").text(selKeys.join(", "));

				// Get a list of all selected TOP nodes

				var selRootNodes = node.tree.getSelectedNodes(true);

				// ... and convert to a key array:

				var selRootKeys = $.map(selRootNodes, function(node){

					return node.data.key;

				});

				$("#echoSelectionRootKeys3").text(selRootKeys.join(", "));

				$("#echoSelectionRoots3").text(selRootNodes.join(", "));

			},

			onDblClick: function(node, event) {

				node.toggleSelect();

			},

			onKeydown: function(node, event) {

				if( event.which == 32 ) {

					node.toggleSelect();

					return false;

				}

			},

			// The following options are only required, if we have more than one tree on one page:

			//initId: "treeData",

			cookieId: "dynatree-Cb3",

			idPrefix: "dynatree-Cb3-"

		});

	});

	function guardar()
	{
		var node = $("#arbol").dynatree("getRoot");
		if( node ){
			
			
				var selKeys = $.map(node.tree.getSelectedNodes(), function(node){

					return node.data.key;

				});
	var opciones = selKeys.join(", ");
	//alert(opciones);
	
	window.location = "permisos.php?accion=guardar&rol=<?php echo $rol ?>&op_menu=" + opciones;
    
}	


	
	
	}
	
	function cambiorol()
{
	var id_rol = document.getElementById("ddlRol"); 
	window.location = "permisos.php?rol="+id_rol.value ;
	
	
}
</script>

</head>

<body>
 
<div id="titulo_pagina">Permisos</div>
  <div id="xopcionesmenu_registros">
         	<ul id="icons"  class="ui-widget ui-helper-clearfix">
            	<li class="ui-state-default ui-corner-all" style="padding-left:3px; padding-right:3px">
                Filtrar por Rol:
               <?php
			  
			 
			  
//Isntancia del Objeto

$objE=new croles_ext;
?> 
<select id="ddlRol" name="ddlRol" onchange="javascript:cambiorol();" style="z-index:10000; flOat:left;">
<option value="0" <?php if ($rol=="0" ) echo 'selected="selected"'  ?>  >--Seleccione un Rol--</option>
			<?php 
            $rs = $objE->ObtenerRolesActivos(); 
			
            for ($i= 0; $i < $rs->rowCount(); $i++) 
            {  
		
                $userRow = $rs->getNext(new croles()); 
				echo  '<option value="'.  $userRow->id_rol . '"';
				 if ($rol==$userRow->id_rol ) echo 'selected="selected"'; 
				echo  '>' . $userRow->nombre_rol . ' </option> ';
             } 
         ?>
         </select>
         
       
                </li>
                
                <li  id="btnExpandAll" class="ui-state-default ui-corner-all">
                    <a href="#">
                    <span class="ui-icon ui-icon-circlesmall-plus"></span>Expandir &aacute;rbol&nbsp;&nbsp;
                    </a>
                </li>
                <li id="btnCollapseAll" class="ui-state-default ui-corner-all">
                    <a href="#" >
                        <span class="ui-icon ui-icon-circlesmall-minus"></span>Colapsar &aacute;rbol&nbsp;&nbsp;
                    </a>
                </li>
                 <li id="btnCollapseAll" class="ui-state-default ui-corner-all">
                    <a  onclick="guardar()" href="#">
                        <span class="ui-icon ui-icon-disk"></span>Guardar Permisos&nbsp;&nbsp;
                    </a>
                </li>
            </ul>
        	<div id="sector_totalregistros">&nbsp;	</div>
        </div>
        <!-- Fin Botonera Listados de Regsitros -->
        
        <!-- Listado de Registros -->
            
           <table cellpadding="0" cellspacing="2" width="100%">
           

            <tr>
            	 <td style="vertical-align:top;">
                 <div id="tabs">
    <ul>
        <li><a href="#tabs-1">Usuarios</a></li>
    </ul>
    <div id="tabs-1">
                 	 <?php 
					 
					 
					 
					if ($rol > 0 )
					{
					?>
                    <?php
					
						include_once("../_BRL/usuarios.ext.php");
						$objusuarios=new cusuarios_ext;
						$rs = $objusuarios->UsuariosPorRol($rol);
						
					
                        if ($rs->TotalFilas() > 0)
                        {
							echo "<b>Usuarios:  </b>";
							$str_usuarios = "";
							for ($i= 0; $i < $rs->rowCount(); $i++) 
							{  
								$userRow = $rs->getNext(new cusuarios_ext());
								
								$str_usuarios .= "<a href='usuarios.php?accion=editar&id=".$userRow->id_usr."'>" . $userRow->usuario_usr . "</a>, "; 
								} 
								
								echo substr( $str_usuarios, 0, strlen( $str_usuarios) - 2);
								
								echo "<br/><br/><b>Cantidad de Usuarios en este rol:</b> ". $rs->TotalFilas(); 
								
						}
						else
						{
							echo 'Este rol no tiene usuarios asignados. <a href="usuarios.php?accion=nuevo">Crear usuarios?</a>';	
						}
					}
					else
					{
						echo 'Selecciona un rol para ver los usuarios asignados';	
					
					}
					?>
					
					</div>
                    
                    </div>
                    
                    </div>
                    
					</td><td style="vertical-align:top;">
                    
                      <div id="tabs2">
    <ul>
        <li><a href="#tabs-1">Permisos</a></li>
    </ul>
    <div id="tabs-1">
					<?php 
					if ($rol > 0 )
					{
					?>
						<div id="arbol"></div>
					<?php 
					}
					else
					{
						echo '<div class="cuadro">Seleccione un Rol para ver los permisos respectivos</div>';	
						echo '<div id="arbol" style="visibility:hidden"></div>';
					}
					
					?>
              
              </div></div>
                </td>
               
            </tr>
            </table>

</body>
</html>