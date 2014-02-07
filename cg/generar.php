<?php @session_start();

$mainlabel = "/*

Creado En: ".date("d/m/Y H:i:s").";
Creado Por: Sistema;
Modificado Por: ;
Modificado En: ;

*/";

include_once("conexiones/".$_SESSION["selfile"]);

$specialfields = array();
$mostrarvalordefk = array();

if(!function_exists("getcombo"))
{
function getcombo($t, $f, $conn, $ndb)
{
	mysql_select_db("information_schema", $conn);
	
	$ret = false;
	
	//	$tbl["t".$i][0] = $_SESSION["x".$i];
	$sqlss = "SELECT * FROM KEY_COLUMN_USAGE WHERE TABLE_NAME LIKE '$t' AND COLUMN_NAME LIKE '$f' AND TABLE_SCHEMA LIKE '$ndb'";
	$rss = mysql_query($sqlss, $conn) or die ($sqlss."<br />".mysql_error());
	$rowss = mysql_fetch_assoc($rss);	
	
	$tableref = $rowss["REFERENCED_TABLE_NAME"];
	$pkref = $rowss["REFERENCED_COLUMN_NAME"];
	
	mysql_free_result($rss);

	mysql_select_db($ndb, $conn);
	if($tableref != "")
	{
		$sqlss = "show full columns from $tableref ";
		$rss = mysql_query($sqlss, $conn) or die ($sqlss."<br />".mysql_error()) ;
		$rowss = mysql_fetch_assoc($rss);	
	
	do{
		
	}while($pkref != $rowss["Field"] && $rowss = mysql_fetch_assoc($rss));
	
	$rowss = mysql_fetch_assoc($rss);
	
	$z = preg_split("/_/",$tableref);
	$ret["class"] = $z[1];
	$ret["pk"] = $pkref;
	$ret["name"] = $rowss["Field"];

	mysql_free_result($rss);
	}
	return $ret;
	
}
}

$tbl = array();

for($i = 1;$i <= $_SESSION["x0"]; $i++)
{

	$sql = "show full columns from ".$_SESSION["x".$i] ." WHERE Field <> 'fechahora_mod' AND Field <> 'fechahora_ins' AND Field <> 'usuario_mod' AND Field <> 'usuario_ins'";
	$r = mysql_query($sql) or die ($sql."<br />".mysql_error()) ;
	
	if($row = mysql_fetch_assoc($r))
	{
		$tbl["t".$i][0] = $_SESSION["x".$i];
		$y = 0;
		$mostrarvalordefk["t".$i] = "";
		
		do {
		
// print_r($row);
// [Field] => id_affiliate [Type] => bigint(20) [Collation] => [Null] => NO [Key] => PRI [Default] => [Extra] => auto_increment [Privileges] => select,insert,update,references [Comment] => 11

			if($row["Key"] == "PRI"){
				
				$tbl["t".$i][-1] = $row["Field"];
				
			} else {
				
				$y++;
				$tbl["t".$i]["f".$y] = $row["Field"];

				if($row["Comment"] == "")
				{
					$z = preg_split("/_/",$row["Field"]);
					$tbl["t".$i]["l".$y] = $z[0];
				}
				else
				{
					$tbl["t".$i]["l".$y] = $row["Comment"];
				}
				preg_match('#\((.*?)\)#', $row["Type"], $m);
				if(empty($m))
				{
					$tbl["t".$i]["s".$y] = 20;
				} else {	
					$tbl["t".$i]["s".$y] = $m[1]; //Sizes
				}
				$tbl["t".$i]["t".$y] = $row["Type"];
				$tbl["t".$i]["k".$y] = $row["Key"];
				$tbl["t".$i]["e".$y] = $row["Extra"];
				$tbl["t".$i]["n".$y] = $row["Null"];
				
				if($row["Key"] == "MUL")
				{
					$tbl["t".$i]["fk".$y] = getcombo($tbl["t".$i][0], $row["Field"], $conn, $ndb);
					if($tbl["t".$i]["fk".$y]["class"] != "")
					{
						$mostrarvalordefk["t".$i] .= '$vfk'.$tbl["t".$i]["fk".$y]["class"].' = HacerArray("'.$tbl["t".$i]["fk".$y]["class"].'","'.$tbl["t".$i]["fk".$y]["pk"].'","'.$tbl["t".$i]["fk".$y]["name"].'");'."\n";
					}
				}
			}
		}while($row = mysql_fetch_assoc($r));
		
		$tbl["t".$i][-2] = $y;
	}
}

for($i = 1;$i <= $_SESSION["x0"]; $i++)
{	

	$handle = fopen("templates/".$_SESSION["temp"], "r");

	$x = fgets($handle);
	$overwrite = fgets($handle);
	$nf = fgets($handle);
	
	$tablenp = preg_split("/_/",$tbl["t".$i][0]);
	$prefixtable = $tablenp[0];
	$tablenp = $tablenp[1];

	$x = str_replace("[#tablenp]",$tablenp,$x);
	$x = str_replace("[#table]",$tbl["t".$i][0],$x);
	$x = str_replace("[#prefixtable]",$prefixtable,$x);

	$nf = str_replace("[#tablenp]",$tablenp,$nf);
	$nf = str_replace("[#table]",$tbl["t".$i][0],$nf);
	$nf = str_replace("[#prefixtable]",$prefixtable,$nf);
	
	$cont = "";

	while(!feof($handle))
	{
	
		$var = fgets($handle);

		if(strstr($var,"**!"))
		{
			$xx = fgets($handle);
			while(!strstr($xx,"!**"))
				{
					if(strstr($xx,"<parameter>"))
					{
						$v1 = "";
						$v2 = "";
						$v3 = "";
						$v4 = "";
						$v5 = "";
						// add for the upload
						$v6 = "";
						$v7 = "";
						
						$xx = fgets($handle);
						while(!strstr($xx,"</parameter>"))
						{
							if(strstr($xx,"<vartype>"))
							{
								$xx = fgets($handle);
								while(!strstr($xx,"</vartype>"))
								{
									$v1 .=  $xx;
									$xx = fgets($handle);
								}
							}
							
							if(strstr($xx,"<formfieldi>"))
							{
								$xx = fgets($handle);
								while(!strstr($xx,"</formfieldi>"))
								{
									$v2 .=  $xx;
									$xx = fgets($handle);
								}
							}
							
							if(strstr($xx,"<formfieldu>"))
							{
								$xx = fgets($handle);
								while(!strstr($xx,"</formfieldu>"))
								{
									$v4 .=  $xx;
									$xx = fgets($handle);
								}
							}
							
							if(strstr($xx,"<filterfield>"))
							{
								$xx = fgets($handle);
								while(!strstr($xx,"</filterfield>"))
								{
									$v3 .=  $xx;
									$xx = fgets($handle);
								}
							}
							
							if(strstr($xx,"<formfieldsh>"))
							{
								$xx = fgets($handle);
								while(!strstr($xx,"</formfieldsh>"))
								{
									$v5 .=  $xx;
									$xx = fgets($handle);
								}
							}
							
							if(strstr($xx,"<precode>"))
							{
								$xx = fgets($handle);
								while(!strstr($xx,"</precode>"))
								{
									$v6 .=  $xx;
									$xx = fgets($handle);
								}
							}
							
							if(strstr($xx,"<code>"))
							{
								$xx = fgets($handle);
								while(!strstr($xx,"</code>"))
								{
									$v7 .=  $xx;
									$xx = fgets($handle);
								}
							}
							
						$xx = fgets($handle);
						}
					$specialfields[trim($v1)] =array('frmfi' => $v2, 'filf' => $v3, 'frmfu' => $v4, 'formfieldsh' => $v5, 'precode' => $v6, 'code' => $v7 );
					}
					$xx = fgets($handle);
				}
			$var = fgets($handle);

		}
		
		if(strstr($var,"[!"))
		{
			$var = str_replace("[!","",$var);
			$org = "";
			$xx = "";
                        $xxz = "";
				do{					
					$xx = fgets($handle);
					if(!strstr($xx,"!]"))
                                        {
                                            $org .= $xx;
                                        } else {
                                            $xxz = "!]";
                                        }
                                     
				}while(!strstr($xxz,"!]"));

			$org = str_replace("[!","",$org);
			$org = str_replace("!]","",$org);
			
			for($ii = 1; $ii <= $tbl["t".$i][-2]; $ii++)
			{
				$orgx = $org;
				
				if( isset($specialfields))
				{
						  if(array_key_exists($tbl["t".$i]["t".$ii],$specialfields))
						  {
							  $orgx = str_replace("[#formfieldu]", $specialfields[$tbl["t".$i]["t".$ii]]["frmfu"], $orgx);
							  $orgx = str_replace("[#formfieldi]", $specialfields[$tbl["t".$i]["t".$ii]]["frmfi"], $orgx);
							  $orgx = str_replace("[#formfieldf]", $specialfields[$tbl["t".$i]["t".$ii]]["filf"], $orgx);
   							  $orgx = str_replace("[#formfieldsh]", $specialfields[$tbl["t".$i]["t".$ii]]["formfieldsh"], $orgx);
							  $orgx = str_replace("[#precode]", $specialfields[$tbl["t".$i]["t".$ii]]["precode"], $orgx);
							  $orgx = str_replace("[#code]", $specialfields[$tbl["t".$i]["t".$ii]]["code"], $orgx);
						  }
						  
						  if($tbl["t".$i]["k".$ii] == "MUL" && array_key_exists("MUL",$specialfields))
						  {
							  $orgx = str_replace("[#formfieldu]", $specialfields["MUL"]["frmfu"], $orgx);
							  $orgx = str_replace("[#formfieldi]", $specialfields["MUL"]["frmfi"], $orgx);
							  $orgx = str_replace("[#formfieldf]", $specialfields["MUL"]["filf"], $orgx);
 							  $orgx = str_replace("[#formfieldsh]", $specialfields["MUL"]["formfieldsh"], $orgx);
							  $orgx = str_replace("[#precode]", $specialfields["MUL"]["precode"], $orgx);
							  $orgx = str_replace("[#code]", $specialfields["MUL"]["code"], $orgx);
						  }
						   
						  if(strstr($orgx,"[#formfield") || strstr($orgx,"[#precode") || strstr($orgx,"[#code"))
						  {
							  $orgx = str_replace("[#formfieldu]", $specialfields["DEF"]["frmfu"], $orgx);
							  $orgx = str_replace("[#formfieldi]", $specialfields["DEF"]["frmfi"], $orgx);
							  $orgx = str_replace("[#formfieldf]", $specialfields["DEF"]["filf"], $orgx);
 							  $orgx = str_replace("[#formfieldsh]", $specialfields["DEF"]["formfieldsh"], $orgx);
							  $orgx = str_replace("[#precode]", $specialfields["DEF"]["precode"], $orgx);
							  $orgx = str_replace("[#code]", $specialfields["DEF"]["code"], $orgx);
						  }
				}
				
				$text = $tbl["t".$i]["t".$ii];
				preg_match('#\((.*?)\)#', $text, $match);
				//print_r($match);
				if($tbl["t".$i]["n".$ii] == "NO")
				{
					$req = "title=\"Requerido!\" class=\"{required:true,minlength:1}\"";
				}
				else
				{
					$req = "";
				}
				
				if($tbl["t".$i]["k".$ii] == "MUL")
				{
					$combo = $tbl["t".$i]["fk".$ii];
					$orgx = str_replace("[#fkclass]", $combo["class"], $orgx);
					$orgx = str_replace("[#fkpk]", $combo["pk"], $orgx);
					$orgx = str_replace("[#fkprimercampo]", $combo["name"], $orgx);
					$orgx = str_replace("[#field]",$tbl["t".$i]["f".$ii],$orgx);
				}				
				
				$orgx = str_replace("[#field]",$tbl["t".$i]["f".$ii],$orgx);
				$orgx = str_replace("[#size]", $tbl["t".$i]["s".$ii], $orgx);
				$orgx = str_replace("[#label]",$tbl["t".$i]["l".$ii],$orgx);
				$orgx = str_replace("[#totcol]", $tbl["t".$i][-2], $orgx);
				$orgx = str_replace("[#pk]", $tbl["t".$i][-1], $orgx);
				$orgx = str_replace("[#table]", $tbl["t".$i][0], $orgx);
				$orgx = str_replace("[#tablenp]", $tablenp, $orgx);
				$orgx = str_replace("[#req]", $req, $orgx);
				$orgx = str_replace("[#ct++]", $ii-1, $orgx);
				
				$var .= $orgx;
			}	

			//$var .= $xx;
				
		}
		
		if(isset($tbl["t".$i])) 
		{
			$var = str_replace("[#pk]", $tbl["t".$i][-1], $var);
			$var = str_replace("[#table]", $tbl["t".$i][0], $var);
			$var = str_replace("[#tablenp]", $tablenp, $var);
			$var = str_replace("[#totcol]", $tbl["t".$i][-2], $var);
			$var = str_replace("[#1stfield]", $tbl["t".$i]["f1"], $var);
			$var = str_replace("[#mainlabel]", $mainlabel, $var);
		}
		
		$cont .= $var;
		
	}
	
	fclose($handle);
	$cont = str_replace("[#mostrarvalordefk]", $mostrarvalordefk["t".$i], $cont);
?>


<?php 
	
if(!function_exists('verificarsisemodifico'))
{
	function verificarsisemodifico($file)
	{
	   	$ret = false;
		if(file_exists($file))
		{
			$handle = fopen($file, "r");
			$txt = "";
			for($r = 0;$r < 15;$r++)
			{
				$x = fgets($handle);
				if(strstr($x,"Modificado Por"))
				{
					$z = preg_split("/;/",$x);
					$z = preg_split("/:/",$z[0]);
					$resp = $z[1];
					$resp = str_replace(" ","",$resp);
					$resp = str_replace("_","",$resp);
					if($resp != "")
					{
						$ret = true;
					}
				} 
			}
			fclose($handle);
		}
		return $ret;

	}
}

	@mkdir("../".trim($x));
	
	$filename = "../".trim($x)."/".trim($nf).".php";
	if(strstr($overwrite,"N"))
	{
	if(!file_exists($filename))
	 {
		 $handle = fopen($filename, "w");
		 fwrite($handle, $cont);
		 fclose($handle);
		 echo '<textarea cols="50" rows="20">'.$cont.'</textarea>';
	 }
	} else 
	{
		if(!verificarsisemodifico($filename))
		{
			$handle = fopen($filename, "w");
			fwrite($handle, $cont);
			fclose($handle);
			echo '<textarea cols="50" rows="20">'.$cont.'</textarea>';
		}
	}
}

// $specialfields["DEF"]["frmf"];
// $specialfields["DEF"]["filf"];
// header("Location:index.php");

?>