<?php 
function GuardarFormMultilinea($val)
{
	include_once("../_BRL/".$val[0]["clasefk"].".ext.php");
	$midclase = "c".$val[0]["clasefk"]. "_ext";
	$objMid =  new $midclase;
	
	$objMid->filtros = array( array("Campo" => $val[0]["campopk"], "Relacion" => "=", "Valor" => $val[0]["valorpk"] ) );
	$objMid->BorrarPorFiltro();
	
	$post = $val[0]["post"];
	$personaid = $val[0]["personaid"];
	
	if(!is_null($post[$val[0]["idfk"]]))
	{
		foreach($post[$val[0]["idfk"]] as $key => $valor)
		{
			
			$objMid->$val[0]["campopk"] = $val[0]["valorpk"];
		
			foreach($val as $keyx => $valorx)
			{
				if($keyx != 0)
				{
					if(isset($post[$val[$keyx]["nombrecampo"]][$key]))
					{
						$objMid->$val[$keyx]["nombrecampo"] = $post[$val[$keyx]["nombrecampo"]][$key];
					} else
					{
						$objMid->$val[$keyx]["nombrecampo"] = 'N';
					}
				}
			}
			try{
				$objpersonas->id_per = $post[$val[0]["idfk"]][$key];
				$objMid->usuario_mod = $personaid;
				$objMid->usuario_ins = $personaid;
				$objMid->insertar();
			}catch(Exception $e){
				$x = $e->getMessage();
			}
		}
	}
	
}

function HacerFormMultilinea($val)
{
	// $titulo 			Titulo del marco donde se mostrara el formulario multilinea
	// $ancho 			Ancho del marco sonde se mostrara el formulario multilinea
	
	$ret = "";
	$label = "<td></td>";

	include_once("../_BRL/".$val[0]["clasefk"].".ext.php");
	
	$ret = "";
	
	$midclase = "c".$val[0]["clasefk"]. "_ext";
	$objMid =  new $midclase;
	
	$objMid->filtros = array( array("Campo" => $val[0]["campopk"], "Relacion" => "=", "Valor" => $val[0]["valorpk"] ) );
	$rs = $objMid ->buscar(0,'S');
	
	$ret .= '<div class="ui-tabs ui-widget ui-widget-content ui-corner-all" style="width: '.$val[0]["ancho"].'px; ">
    <span class="count"></span>
    <div> 
    <script language="javascript" type="text/javascript">
	function del(obj,id)
	{
		document.getElementById(obj).innerHTML = "";
	}

	function addRow(id,val){
    var tbody = document.getElementById(id).getElementsByTagName("TBODY")[0];
    var row = document.createElement("TR");
	row.setAttribute("id","tr" + val);
	var td0 = document.createElement("TD");
    td0.innerHTML = \''.'<input type="hidden" id="'.$val[0]["idfk"]."['+val+']".'" name="'.$val[0]["idfk"]."['+val+']".'" value="0" >'.'\';
    row.appendChild(td0);
';


	foreach($val as $key => $valor)
	{
		if($key != 0)
		{
			$label .= "<td>".$val[$key]["label"]."</td>";
			$ret .= 'var td'.$key.' = document.createElement("TD");
    td'.$key.'.innerHTML = \''.str_replace("[#nombredecampo]",$val[$key]["nombrecampo"]."['+val+']",$val[$key]["campo"]).'\';
    row.appendChild(td'.$key.');';
		}
	}
	
	$key++;
	
	$ret .= 'var td'.$key.' = document.createElement("TD");
    td'.$key.'.innerHTML = \''.'<a href="#" onClick="del('."'+\"'tr\"+val+\"',\"+val+'".');  return false;">Borrar</a>\';
    row.appendChild(td'.$key.');';
	
	$ret.=	'tbody.appendChild(row);
  }
  
      valrow = 0;
    </script>
    <a href="javascript:valrow++; addRow(\'multiFormSel\',valrow); return false;">Nueva</a>
    <table id="multiFormSel" name="multiFormSel" border="0" cellspacing="0" cellpadding="4">
  <tr>
    '.$label.'
  </tr>';
	$ret .= '</table>
</div>
</div>';


if($rs->rowCount() > 0)
	{
$ret .='
    <script language="javascript" type="text/javascript">
	';
		for ($i= 0; $i < $rs->rowCount(); $i++) 
		{
			$fila = $rs->getNext(new $midclase());
			$ret .='
			
				valrow++;
				addRow(\'multiFormSel\',valrow);
				';
				$ret .= "document.getElementById('".$val[0]["idfk"]."['+valrow+']').value = '".$fila->$val[0]["idfk"]."';
				";
				
			foreach($val as $key => $valor)
			{
				if($key != 0)
				{
					$ret .= "
					
					if(document.getElementById('".$val[$key]["nombrecampo"]."['+valrow+']').type != 'checkbox'){ 
						document.getElementById('".$val[$key]["nombrecampo"]."['+valrow+']').value = '".$fila->$val[$key]["nombrecampo"]."';
					} else {
					
						if('".$fila->$val[$key]["nombrecampo"]."' == 'S')
						{
							document.getElementById('".$val[$key]["nombrecampo"]."['+valrow+']').checked = true;
						}
					}
					";
				}
			}	
		}
	
	$ret .='</script>';
	}

/*$ret .='
    <script language="javascript" type="text/javascript">
	valrow++;
	addRow(\'multiFormSel\',valrow); 
	</script>
	'; // HABILITAR UNO DESDE EL COMIENZO
*/		
	return $ret;
}

function HacerMultilist($nombre, $valorpk, $foraneaclass, $nombrecampofk, $intermediaclass, $campopk, $campofk, $campolabelfk, $filtrofk = "" )
{

// CREA UNA LISTA DE DATOS EN UNA LISTA MULTISELECT PARA SER USADA EN UN FORMULARIO

// $nombre 				Nombre del Campo Multiselect
// $valorpk 			Valor del ID del de la tabla principal por ejemplo : usuario
// $foraneaclass 		Clase de la tabla foranea por ejemplo : pais
// $nombrecampofk		Nombre del campo principal en la tabla foranea
// $intermediaclass 	Clase de la tabla intermedia
// $campopk 			Nombre del campo foraneo en la tabla intermedia relacionado con el ID de la tabla principal
// $campofk 			Nombre del campo foraneo en la tabla intermedia relacionado con el ID de la tabla foranea
// $campolabelfk		Nombre del campo en la tabla foranea que contiene la descripcion o label de los datos a poner en el multiselect
// $filtrofk 			Es el filtro que se aplicara a la tabla foranea para los valores que se mostraran se espera un Array
/*

echo HacerMultilist("cursosentri", $objtrimestres->id_con, "cursos", "id_cur", "cursosentrimestres", "trimestre_cot", "curso_cot", "titulo_cur", $filtrofk = "" );

<script>
 	$(function(){
		
			$(".available, .selected").css("width","350px");
			$(".ui-multiselect").css("width","701px");
		});
 
  </script>
  
*/
	include_once("../_BRL/".$foraneaclass.".ext.php");
	include_once("../_BRL/".$intermediaclass.".ext.php");
	
	$ret = "";
	
	$fkclase = "c".$foraneaclass. "_ext";
	$midclase = "c".$intermediaclass. "_ext";
	$objFk = new $fkclase;
	$objMid =  new $midclase;
	
	if($filtrofk != "") 
	{
		$objFk->filtros = $filtrofk;
	}

	$objMid->filtros = array( array("Campo" => $campopk, "Relacion" => "=", "Valor" => $valorpk ) );
	$rs = $objMid ->buscar(0,'S');
	
	$midsel = array();
	
	for ($i= 0; $i < $rs->rowCount(); $i++) 
	{
		$fila = $rs->getNext(new $midclase()); 
		$midsel[$fila->$campofk] = "1" ;
	}

	$rs = $objFk->buscar(0,'S');

	$ret = '<select id="'.$nombre.'" class="multiselect" multiple="multiple" name="'.$nombre.'" >';

	for ($i= 0; $i < $rs->rowCount(); $i++) 
	{
		$fila = $rs->getNext(new $fkclase()); 
		if(array_key_exists($fila->$nombrecampofk,$midsel))
		{ 
			$sel = 'SELECTED="SELECTED"';
		} else 
		{
			$sel = "";
		}
		$ret .= '<option value="'.$fila->$nombrecampofk.'" '.$sel.'>'.$fila->$campolabelfk.'</option>'; 
	}

	$ret .= "</select>";
	
	$js = '        <link type="text/css" href="../css/multiselect/ui.multiselect.css" rel="stylesheet">
			<script type="text/javascript" src="../js/multiselect/plugins/localisation/jquery.localisation-min.js"></script>
			<script type="text/javascript" src="../js/multiselect/plugins/scrollTo/jquery.scrollTo-min.js"></script>
			<script type="text/javascript" src="../js/multiselect/ui.multiselect.js"></script>
			
			<script type="text/javascript">
				$(function(){
					$.localise("ui-multiselect", {language: "es", path: "../js/multiselect/locale/"});
					$(".multiselect").multiselect();
				});
			</script>';
			
	return $js."\n\n\n".$ret;

}

function GuardarMultilist($multivalores, $valorpk, $intermediaclass, $campopk, $campofk, $personaid)
{

// GUARDA LOS DATOS MULTISELECCIONADOS EN UNA LISTA MULTISELECT POSTEADOS DESDE UN FORMULARIO

// $multivalores		Este es el nombre del valor que se esta posteando desde el Formulario
// $valorpk 			Valor del ID del de la tabla principal por ejemplo : usuario
// $intermediaclass 	Clase de la tabla intermedia
// $campopk 			Nombre del campo foraneo en la tabla intermedia relacionado con el ID de la tabla principal
// $campofk 			Nombre del campo foraneo en la tabla intermedia relacionado con el ID de la tabla foranea
// $personaid 			ID del Usuario Logueado
/*

GuardarMultilist($_POST['cursosendipl'],$objdiplomados->id_dip  , "cursosendiplomado", "diplomado_ced", "curso_ced", $seguridad->personaid);

*/
	include_once("../_BRL/".$intermediaclass.".ext.php");
	$midclase = "c".$intermediaclass. "_ext";
	$objMid =  new $midclase;
	
	$objMid->filtros = array( array("Campo" => $campopk, "Relacion" => "=", "Valor" => $valorpk ) );
	$objMid->BorrarPorFiltro();
	if(!is_null($multivalores))
	{
		foreach($multivalores as $valor)
		{
			$objMid->$campopk = $valorpk;
			$objMid->$campofk = $valor;
			$objMid->usuario_mod = $personaid;
			$objMid->usuario_ins = $personaid;
			$objMid->insertar();
		}
	}
	
}

function HacerArray($obj,$llave,$campo)
{
	include_once("../_BRL/".$obj.".ext.php");
	//Isntancia del Objeto
	$clase = "c".$obj. "_ext";
	$objE=new $clase;
	
	// $rs = $objE->buscar(0); 
	
	$row = $objE->buscararr(0,'S');
	
	$array_valores = array();
	
	foreach($row as $k => $v) 
	{
		$array_valores[$v[$llave]] = $v[$campo];
	}
	
	return $array_valores ;
}

function HacerCombo($obj,$llave,$campo,$valor_seleccionado,$nombredelddl,$nombrefuncion,$agregarenblanco = "N")
{
	include_once("../_BRL/".$obj.".ext.php");
	//Isntancia del Objeto
	$clase = "c".$obj. "_ext";
	$objE = new $clase;
	$str_retorno = '<select id="'.$nombredelddl. '" name="'.$nombredelddl. '" >';
	$str_retorno .= '<option value="0">-- Seleccione --</option>';
	if($agregarenblanco!="N")
	{
		$str_retorno .= '<option value="0"></option>';
	}
	
	if ($nombrefuncion!='')
	{		
		$rs = $objE->$nombrefuncion();
	}
	$objE->orden = " ORDER BY $campo ASC ";
	$rs = $objE->buscararr(0,'S'); 	
	foreach($rs as $userRow) 
	{
	
	$s = "c". $obj;
		 //$userRow = $rs->getNext(new croles()); 
		$str_retorno .= '<option value="'.  $userRow[$llave] . '"';
		if ($valor_seleccionado ==  $userRow[$llave])
			$str_retorno .= ' selected="selected" ';
		$str_retorno .= '>' . $userRow[$campo] . ' </option> ';
	 } 
	  $str_retorno .= '</select>';
	  
	  return $str_retorno;
	
}

function HacerComboPersonalizado($arr, $nombrecb, $valorseleccionado)
{
	$result = "<select id='".$nombrecb."' name='".$nombrecb."' >";
	foreach ($arr as $row) {
		
	}
}

function HacerComboJQ($obj,$llave,$campo,$valor_seleccionado,$nombredelddl,$nombrefuncion,$agregarenblanco = "N")
{
	include_once("../_BRL/".$obj.".ext.php");
	//Isntancia del Objeto
	$clase = "c".$obj. "_ext";
	$objE = new $clase;
	$str_retorno = '';
/*	if($agregarenblanco!="N")
	{
		$str_retorno .= 'todos:----Selecione----';
	}*/
	
	if ($nombrefuncion!='')
	{		
		$rs = $objE->$nombrefuncion();
	}
	$rs = $objE->buscararr(0,'S'); 	
	$num = count($rs);
	$i = 1;
	$coma = ';';
	if($num == 0) $coma = '';
	$str_retorno .=  '0:--- Seleccione---'.$coma;
	foreach($rs as $userRow) 
	{
		
		if($num == $i) $coma = '';
		$str_retorno .= $i . ':'.$userRow[$campo].'|'.$userRow[$llave].$coma;
		$i++;
	 } 
	 return $str_retorno;
	
}

/*
Esta función retorna la fecha y el usuario, que obtiene de la Base de Datos, de un registro creado.
*/
function ObtenerDatosCreacionRegistro($fecha,$usr)
{	
	include_once("../_BRL/usuarios.ext.php");

	$objE = new cusuarios_ext();
	$objE->id_usr = $usr;
	$objE->ObtenerUnRegistro();
	
	$str_retorno =  date_es("j F  Y, g:i a",$fecha,"") . " - ".$objE->nombres_usr." ".$objE->apellidopaterno_usr." ".$objE->apellidomaterno_usr;
	return $str_retorno;
}


function ObtenerDatosModificacionRegistro($fecha,$usr)
{
	
	include_once("../_BRL/usuarios.ext.php");
	$objE = new cusuarios_ext();
	$objE->id_usr = $usr;
	$objE->ObtenerUnRegistro();
	$str_retorno =  date_es("j F  Y, g:i a",$fecha,"") . " - ".$objE->nombres_usr." ".$objE->apellidopaterno_usr." ".$objE->apellidomaterno_usr;
	
	return $str_retorno;
	 
}
function ObtenerSeleccionFiltro($signo, $arreglo)
{
        if (count ($arreglo) > 0)
        {
                if (in_array($signo,$arreglo)) 
                        echo "selected='selected'";
        }
}

function ImprimirError($msg)
{
	
	$str_error ="";
	if (isset($msg))
	{
	$str_error = '
	 <div class="ui-widget">
		<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
			<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
			<strong>Error:</strong> '.$msg->getMessage().' </p>
			<br/>
			 <a href="javascript:history.back(1)">Volver Atr&aacute;s...</a>
			 <br/>
			  <br/>
		</div>
	</div> ';
	}
	//Guardar en regsitro de Logs
	
	return $str_error;
}

function date_es($formato="d F Y",$fecha=0) { 
		if (preg_match("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})/", $fecha,$partes)) { 
			if (checkdate($partes[2],$partes[3],$partes[1])) { 
				$fecha=strtotime($fecha); 
			} else { 
				return(-1); 
			} 
		} elseif ($fecha==0) { 
			$fecha=time(); 
		} 
		$dias=array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"); 
		$dias_c=array("Dom","Lun","Mar","Mie","Jue","Vie","Sab"); 
		$meses=array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); 
		$meses_c=array("","Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"); 
	
		$valores=explode("|",date ("a|A|B|d|D|F|g|G|h|H|i|I|j|l|L|m|M|n|O|r|s|S|t|T|U|  w|W|Y|y|z|Z",$fecha)); 
		$claves= array ("a","A","B","d","D","F","g","G","h","H","i","I","j","l","L","m","M","n","O","r","s","S","t","T","U","w","W","Y","y","z","Z"); 
		for ($i=0;$i<count($claves);$i++) { 
			$conv[$claves[$i]]=$valores[$i]; 
		} 
		$conv["D"]=$dias_c[intval($conv["w"])];
		$conv["l"]=$dias[intval($conv["w"])]; 
		$conv["F"]=$meses[$conv["n"]]; 
		$conv["M"]=$meses_c[$conv["n"]]; 
		$conv["r"]=$conv["d"]." ".$conv["M"]." ".$conv["Y"].", ".$conv["H"].":".$conv["i"].":".$conv["s"]." GMT ".$conv["O"]; 
		$conv["S"]="o"; 
		$escape='\\\\\\'; 
		$escapado=0; 
		$f=$formato; 
		$res=""; 
		for ($t=0;$t<strlen($formato);$t++) { 
			if ($escapado==1) { 
				$res.=$f{$t}; 
				$escapado=0; 
			} else { 
				if($f{$t}==$escape) { 
					$escapado=1; 
				} else { 
					if (isset($conv[$f[$t]])){ 
						$res.=$conv[$f[$t]]; 
					} else { 
						$res.=$f{$t}; 
					} 
				} 
			} 
		} 
		return $res; 
	}

function ImprimirAlerta($msg)
{
	$str_alerta = "";
	if (isset($msg))
	{
	$str_alerta = '

<div class="ui-widget">

			<div class="ui-state-highlight ui-corner-all" style=" padding: 0 .7em;"> 

				<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>

				<strong>Hey!</strong> '.$msg->getMessage().'</p>

			</div>

		</div>
';
	}
	//Guardar en regsitro de Logs
	
	return $str_alerta;
}

?>