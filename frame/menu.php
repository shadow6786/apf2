<?php @session_start();
include_once("../_DAL/conexion.php");
include_once('../_UTL/seguridad.php');
include_once('../_UTL/funcionesUI.php');

if(isset($_SESSION['usrlogin']))
{
 	$seguridad = unserialize($_SESSION['usrlogin']);
	
} else {
	$seguridad = new CSecurity();
}
?>
	
<!doctype html public "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=iso-8859-1" />
		<title>menu</title>
	    <link type="text/css" href="../css/redmond/jquery-ui-1.8.14.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="../js/jquery-1.5.1.min.js"></script>
		<script type="text/javascript" src="../js/jquery-ui-1.8.14.custom.min.js"></script>
        <link rel="stylesheet" href="../css/mgEstiloAdmin.css" type="text/css">
        <script type="text/javascript">
			$(function(){
			
				// Accordion
				$("#accordion").accordion({ header: "h5" });
				
				$('ul#icons li, #boton_editar, #boton_borrar').hover(
				function() { $(this).addClass('ui-state-hover'); }, 
				function() { $(this).removeClass('ui-state-hover'); }
				);
				
				$('#datepicker').datepicker({
				dayNames: ['Domingo', 'Lunes', 'Martes', 'Mi?rcoles', 'Jueves', 'Viernes', 'S?bado'],
				dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'], 
				firstDay:1 ,
				inline: true,
				prevText: "Mes anterior",
				nextText: "Pr?ximo anterior",
				autoSize: true 
				});
	
			});
		</script>
     
</head>

<body style="margin:0px; padding:4px">
<!-- <div id="datepicker"></div> -->
<div id="accordion">
			
			<?php 
			include_once("../_BRL/opcionesmenu.ext.php");
			
			$rol =$seguridad->rol;
			$objE = new copcionesmenu_ext;
			
			
			
			$rs = $objE->ObtenerAgrupadoresPorRol($rol); 
						
            for ($i= 0; $i < $rs->rowCount(); $i++) 
            {  
			      $userRow = $rs->getNext(new copcionesmenu_ext());
				  
				  ?>
               <div>
               		<h5><a href="#"><?php echo $userRow->nombre_opm; ?></a></h5>
					<div>
                		<?php
						$objE2 = new copcionesmenu_ext;
			
						$rs2 = $objE2->ObtenerContenidoAgrupadoresPorRol($userRow->id_opm, $rol); 
						
						 for ($i2= 0; $i2 < $rs2->rowCount(); $i2++) 
						{  
							  $userRow2 = $rs2->getNext(new copcionesmenu_ext());
							?>
								<a href="..<?php echo $userRow2->ruta_opm; ?>" target="principal" ><?php echo $userRow2->nombre_opm; ?></a><br/>
                            	<?php
								
							 }
							   
				  
						?>
                        
               		</div>
			
           		</div>
               <?php  } ?>	  
   
		
        </div>
<!-- Accordion -->
		
		<!-- Datepicker -->
        <div  class="ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" style="padding:5px" >
        <br/>
			<strong>Usuario:</strong> <?php echo $seguridad->username; ?> <br/>
            <?php
			include_once('../_BRL/roles.ext.php');
			$rol = new croles_ext();
			$rol->id_rol = $seguridad->rol;
			$rol->ObtenerUnRegistro();
			?>
            <strong>Rol:</strong> <?php echo $rol->nombre_rol ?><br/>
           <strong> IP:</strong> <?php echo $_SERVER['REMOTE_ADDR'] . ":". $_SERVER['SERVER_PORT']?> <br/>
			
			<?php 
			if ($seguridad->sucursalactiva > 0)
			{
				?> 
<strong>Sucursal:</strong> <span id="PanelSucursalMarcada">                
                <?php
			//Sucursales
			$objSucursales=new csucursales_ext;
			echo $seguridad->sucursalactiva;
			$objSucursales->id_suc = $seguridad->sucursalactiva;
			$objSucursales->ObtenerUnRegistro();
			
			echo $objSucursales->nombre_suc; 
			
			
			?>  <a href="#" onClick="javascript:MostrarPanelCambioSucursal()">Cambiar?</a> </span>
       		<span id="PanelCambioSucursal" style="display:none">
            <select id="ddlSelectorSucursal" name="ddlSelectorSucursal" onChange="javascript:CambiarSucursal()">
            <?php
			include_once('../_BRL/sucursales.ext.php');
			$suc = new csucursales_ext();
			$rs = $suc->ObtenerSucursalesPermitidas($seguridad->userid);
			
			for ($i= 0; $i < $rs->rowCount(); $i++) 
			{  
				  $fila = $rs->getNext(new csucursales_ext());
				?>
					<option value="<?php echo $fila->id_suc; ?>" ><?php echo $fila->nombre_suc; ?></option>
					<?php
					
				 }
			?>
            </select>
            <a href="#" onClick="javascript:MostrarPanelCambioSucursal()">Cancelar</a>
          
            </span>
          
            <br/> <br/>  <?php } ?>
     <ul id="icons"  class="ui-widget ui-helper-clearfix">
            	<li class="ui-state-default ui-corner-all" style="padding:0px">
                    <a class="dialog_link" id="boton_cerrar_sesion" target="_top" href="../ingreso.php?action=logout" style=" padding-right:5px">
                       <span class="ui-icon ui-icon-power"></span> Cerrar Sesi&oacute;n 
                    </a>
                </li>
               
               
            </ul>
            
         </div>  

</body>
</html>
