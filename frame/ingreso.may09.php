<?php @session_start();
include_once('../_UTL/seguridad.php');
include_once('../_UTL/funcionesUI.php');
include_once("../_DAL/conexion.php");
include_once("../_BRL/roles.ext.php");
include_once("../_BRL/turnos.ext.php");
include_once("../_BRL/usuarios.ext.php");
include_once("../_UTL/funcionesfechas.php");

$configuracion = new configuracion();


if(isset($_SESSION['usrlogin']))
{
 	$seguridad = unserialize($_SESSION['usrlogin']);
	
} else {
	$seguridad = new CSecurity();
}

include_once("../_BRL/cajas.ext.php");
$cc = '';
if (isset($_GET['cc'])) 
{  
	$cc = $_GET['cc']; 
}


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>Ingreso</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link type="text/css" href="../css/redmond/jquery-ui-1.8.14.custom.css" rel="stylesheet" />	
	 <script language="JavaScript" src="../js/md5.js"></script>
	 <script type="text/javascript" src="../js/jquery-1.5.1.min.js"></script>
        <script type="text/javascript" src="../js/jquery-ui-1.8.14.custom.min.js"></script>
            <link rel="stylesheet" href="../css/mgEstiloAdmin.css" type="text/css">
	<style type="text/css" >
	.cajas{ float:left; margin-top:3px; margin-right:4px; margin-bottom:4px;  }
	.encabezado_caja{ font-weight:bolder;  color:#FFFFFF; text-align:left; padding:2px; font-size:11px}
	.cuerpo_caja{padding:10px; height:200px;   overflow: auto; }
	</style>
    <script>
	$(function(){
			$('ul#icons li').hover(
			function() { $(this).addClass('ui-state-hover'); }, 
			function() { $(this).removeClass('ui-state-hover'); }
			);
			
			});
			
	function abrircaja()
	{
		var monto = document.getElementById("txtMonto");
		var caja = document.getElementById("ddlCajas");
		
		if (caja.value <= 0)
		{ 	
			alert('Debe seleccionar una caja, para poder aperturar turno');
			caja.focus();
		}
		else
		{
			if (isNaN(monto.value))
			{
				alert('Debe ingresar un valor numérico en el campo monto');
				monto.focus();
			}
			else
			{
				$.ajax({
				type: "POST",
				url: "../ajax/abrirturno.php",
				data: "m=" + monto.value + "&c=" +caja.value,
   				cache: false,
				success: function(html){
					document.getElementById("form_apertura").style.display = "none";
				
					if (html == "1")
				 	{
						document.getElementById("msg_apertura_caja").innerHTML = '<div class="ui-widget"><div class="ui-state-highlight ui-corner-all" > <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em; margin-left: .3em;"></span>Turno abierto correctamente</p></div></div>';actualizarTablaTurnoAbierto();
					}
					else
					{
						document.getElementById("msg_apertura_caja").innerHTML = '<div class="ui-widget"><div class="ui-state-error ui-corner-all"> <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em; margin-left: .3em;"></span>Hubo un error abriendo el turno: '+html+' </p></div></div>';
					}
				}
				});	
			}
		}
		
	}
	
	function actualizarTablaTurnoAbierto()
	{
		document.getElementById("tabla_tunos_abierto").innerHTML='';
				
	$.ajax({
				
				type: "POST",
				url: "../ajax/turnosabiertos.php",
				cache: false,
				success: function(html){
					document.getElementById("tabla_tunos_abierto").innerHTML = html;
					}
				});	
	}
	
	function cerrarturno(turno)
	{
				
	$.ajax({
				
				type: "POST",
				url: "../ajax/cerrarturno.php",
				data: "t=" + turno,
				cache: false,
				success: function(html){
					document.getElementById("form_apertura").style.display = "none";
				
				if (html == "1")
				 	{
						document.getElementById("msg_apertura_caja").innerHTML = '<div class="ui-widget"><div class="ui-state-highlight ui-corner-all" > <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em; margin-left: .3em;"></span>Turno cerrado correctamente</p></div></div>';
						actualizarTablaTurnoAbierto();
						
						
						var url = "ingreso.php";    
						$(location).attr('href',url);


					}
					else
					{
						document.getElementById("msg_apertura_caja").innerHTML = '<div class="ui-widget"><div class="ui-state-error ui-corner-all"> <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em; margin-left: .3em;"></span>Hubo un cerrando abriendo el turno: '+html+'</p></div></div>';}
					
					
				}
				});	
	}
	
	function CambiarTurno(turno_nuevo)
	{
		document.getElementById("tabla_tunos_abierto").innerHTML='';
				
	$.ajax({
				
				type: "POST",
				url: "../ajax/turnosabiertos.php",
				data: "tn=" + turno_nuevo,
				cache: false,
				success: function(html){
					document.getElementById("tabla_tunos_abierto").innerHTML = html;
					}
				});	
	}
	
	function CambiarClave()
	{
		var clave1 = md5(document.getElementById("txtnueva_clave").value);
		var clave2 = md5(document.getElementById("txtrepita_clave").value);
		if (clave1 != clave2)
		{
			alert('Las claves no coinciden, verifique que el campo "nueva clave" nueva sea igual a "repita clave"');
		}
		else
		{
			$.ajax({
				
				type: "POST",
				url: "../ajax/cambioclave.php",
				data: "c=" + clave1,
				cache: false,
				success: function(html){
						if (html == "1")
				 	{
						document.getElementById("msg_mensaje_cambioclave").innerHTML = '<div class="ui-widget"><div class="ui-state-highlight ui-corner-all" > <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em; margin-left: .3em;"></span>Clave cambiada con éxito</p></div></div>';
						actualizarTablaTurnoAbierto();
					}
					else
					{
						document.getElementById("msg_mensaje_cambioclave").innerHTML = '<div class="ui-widget"><div class="ui-state-error ui-corner-all"> <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em; margin-left: .3em;"></span>Ocurrió un error cambiando la clave: '+html+'</p></div></div>';}
					
					
				
				
						}
				});	
		}
	}
	
	
	</script>
</head>

<body>
	<div id="titulo_pagina">Inicio</div>
    <div id="opcionesmenu_registros">
     <ul id="icons" style="float:right" class="ui-widget ui-helper-clearfix">
            	<li class="ui-state-default ui-corner-all">
                    <a class="dialog_link" id="boton_filtro"  href="ingreso.php">
                        <span class="ui-icon ui-icon-arrowrefresh-1-e"></span>Actualizar 
                    </a>
                </li>
            </ul>
    </div>
    <div id="sector_totalregistros">Actualizado hrs:
         	 <?php  
            	
           echo  date(" H:i"); 
			?> 
         	</div>
            
	<div style="clear:both;">

    <?php 
	
	$objrol=new croles_ext;
	$objrol->id_rol = $seguridad->rol;
	$objrol->ObtenerUnRegistro();
	
	if ($objrol->abreturno_rol == "S" && $seguridad->sucursalactiva > 0)
	{
	?>
    
    	<div class="cajas" style="width:505px">
         <div class="ui-tabs ui-widget ui-widget-content ui-corner-all">
            <div class="actions ui-widget-header ui-helper-clearfix ui-corner-all encabezado_caja">Turno</div>
            <div class="cuerpo_caja"  >
                <div id="form_apertura">  Utilice esta opción para aperturar una caja, recuerde que debe realizar un arqueo al finalizar el turno. 
                <br/><br/><form name="form_abrir_caja" action="" method="get">
            
                <table border="0" cellspacing="0" cellpadding="0" >
                  <tr>
                    <td>Monto:</td>
                    <td><input id="txtMonto" name="txtMonto" type="text" maxlength="7" size="9"></td>
                    <td><?php 			  
                //Isntancia del Objeto
                
                $objE=new ccajas_ext;
                ?> 
               <select id="ddlCajas" name="ddlCajas" >
                <option value="0" >--Seleccione una Caja--</option>
                            <?php 
							if($seguridad->sucursalactiva > 0)
							{
                            $rs = $objE->ObtenerCajaSinAbrir($seguridad->sucursalactiva); 
                            
                            for ($i= 0; $i < $rs->rowCount(); $i++) 
                            {  
                        
                                $userRow = $rs->getNext(new ccajas()); 
                                echo  '<option value="'.  $userRow->id_caj . '"';
                                echo  '>' . $userRow->nombre_caj . ' </option> ';
                             } 
							}
							
							
                         ?>
                         </select> 
                         
                         </td>
                    <td><input name="Abrir Caja" type="button" value="Abrir Turno" onClick="abrircaja()"></td>
                  </tr>
                </table>
                
                </form>
                </div>
                <div id="msg_apertura_caja" class="error"> </div>
                <div id="tabla_tunos_abierto"></div> 
                <script>actualizarTablaTurnoAbierto(); </script>
            </div>
        </div>
         </div>
         <?php
					
					$objturnos=new cturnos_ext;
					$rs_turnos = $objturnos->ListaTurnosPorArquear($seguridad->userid,$seguridad->sucursalactiva); 
					
					 if ( $objturnos->totalfilasfiltradas > 0 )
					 {
         ?>
         <div class="cajas" style="width:250px">
         <div class="ui-tabs ui-widget ui-widget-content ui-corner-all">
            <div class="actions ui-widget-header ui-helper-clearfix ui-corner-all encabezado_caja">Arqueos</div>
            <div class="cuerpo_caja"  >
                <div id="form_arqueo">  Listado de turnos pendientes por arquear: </div><br>

                <div id="tabla_tunos_arquear">
                	
					 <?php
					foreach($rs_turnos as $userRow_tur) 
					{ 
						echo  date_es("j F, g:i a",	$userRow_tur["fechahoracierre_tur"],"") .  " - <a href='../tes/arqueo.php?id=".$userRow_tur["id_tur"]."&accion=nuevo'>Turno nro.:" . $userRow_tur["id_tur"] . "</a>"; 
						echo "<br/>";
                    
					}
					
					
                    ?>
                    
                </div> 
               
            </div>
        </div>
         </div>
        
         
    	<?php  } } ?>
        
        <?php 
			$objusuario=new cusuarios_ext;
			$objusuario->id_usr = $seguridad->userid;
			$objusuario->ObtenerUnRegistro();
			$fecha_ultimo_cambio = $objusuario->fechahora_mod;
			//echo $fecha_ultimo_cambio;
			//date('d-m-Y',$fecha_ultimo_cambio)
			$timestamp = strtotime($fecha_ultimo_cambio);
			
			$dias =  restaFechas( date('d-m-Y',$timestamp) , date('d-m-Y') );
		
			if ($dias > 30 || $cc == "true") {
				?>
        <div class="cajas" style="width:250px">
         <div class="ui-tabs ui-widget ui-widget-content ui-corner-all ">
            <div class="actions ui-widget-header ui-helper-clearfix ui-corner-all encabezado_caja">Cambio Clave de Acceso</div>
            <div class="cuerpo_caja"  >
            <div id="msg_mensaje_cambioclave"></div>
             La última vez que cambió su clave fue hace <strong><?php
			$objusuario=new cusuarios_ext;
			$objusuario->id_usr = $seguridad->userid;
			$objusuario->ObtenerUnRegistro();
			$fecha_ultimo_cambio = $objusuario->fechahora_mod;
			//echo $fecha_ultimo_cambio;
			//date('d-m-Y',$fecha_ultimo_cambio)
			$timestamp = strtotime($fecha_ultimo_cambio);
			
			echo restaFechas( date('d-m-Y',$timestamp) , date('d-m-Y') );
			 
			?>
            
         </strong> días. Es recomendable cambiarla por lo menos una vez al mes.<br><br>


          <table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>Nueva Clave:&nbsp;</td>
                <td> <input id="txtnueva_clave" type="password" name="txtnueva_clave" width="20" value=""></td>
              </tr>
              <tr>
                <td> Repita Clave: &nbsp;</td>
                <td><input id="txtrepita_clave" type="password" name="txtrepita_clave" width="20" value=""></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input name="btnCambiarclave" id="btnCambiarClave" type="button" value="Cambiar Clave" onClick="javascript:CambiarClave();" ></td>
              </tr>
            </table>

        	
           
            </div>
        </div>
         </div>
         <?php } ?>
         
         <div class="cajas" style="width:250px">
             <div class="ui-tabs ui-widget ui-widget-content ui-corner-all ">
                <div class="actions ui-widget-header ui-helper-clearfix ui-corner-all encabezado_caja">Análisis por Realizar</div>
                    <div class="cuerpo_caja"  >
                    Pendiente
                    
                    </div>
                </div>
            </div>
   		</div>
        
        <div class="cajas" style="width:250px">
             <div class="ui-tabs ui-widget ui-widget-content ui-corner-all ">
                <div class="actions ui-widget-header ui-helper-clearfix ui-corner-all encabezado_caja">Cuentas por Cobrar</div>
                    <div class="cuerpo_caja"  >
                    Pendiente
                    
                    </div>
                </div>
            </div>
   		</div>
        
         <div class="cajas" style="width:250px">
             <div class="ui-tabs ui-widget ui-widget-content ui-corner-all ">
                <div class="actions ui-widget-header ui-helper-clearfix ui-corner-all encabezado_caja">Otro Panel</div>
                    <div class="cuerpo_caja"  >
                    Pendiente
                    
                    </div>
                </div>
            </div>
   		</div>
         <div class="cajas" style="width:250px">
             <div class="ui-tabs ui-widget ui-widget-content ui-corner-all ">
                <div class="actions ui-widget-header ui-helper-clearfix ui-corner-all encabezado_caja">Otro Panel</div>
                    <div class="cuerpo_caja"  >
                    Pendiente
                    
                    </div>
                </div>
            </div>
   		</div>
         <div class="cajas" style="width:250px">
             <div class="ui-tabs ui-widget ui-widget-content ui-corner-all ">
                <div class="actions ui-widget-header ui-helper-clearfix ui-corner-all encabezado_caja">Otro Panel</div>
                    <div class="cuerpo_caja"  >
                    Pendiente
                    
                    </div>
                </div>
            </div>
   		</div>
         <div class="cajas" style="width:250px">
             <div class="ui-tabs ui-widget ui-widget-content ui-corner-all ">
                <div class="actions ui-widget-header ui-helper-clearfix ui-corner-all encabezado_caja">Otro Panel</div>
                    <div class="cuerpo_caja"  >
                    Pendiente
                    
                    </div>
                </div>
            </div>
   		</div>
         <div class="cajas" style="width:250px">
             <div class="ui-tabs ui-widget ui-widget-content ui-corner-all ">
                <div class="actions ui-widget-header ui-helper-clearfix ui-corner-all encabezado_caja">Otro Panel</div>
                    <div class="cuerpo_caja"  >
                    Pendiente
                    
                    </div>
                </div>
            </div>
   		</div>
</html>
