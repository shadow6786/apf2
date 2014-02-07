<?php 
class Seguridad
{

	public $conf;
	public $personaid;
	public $userid = 0;
	public $rol = 0;
	public $loggued = 'N';
	public $username = '';
	public $password = '';	
	public $nombre = '';
	public $apellidop = '';
	public $apellidom = '';	
	public $correo = '';
	public $admin = 'N';
	public $login_error = '';
	public $url = 'http://apf-alemansc.com.bo/apf2/';
	public $url_requested = '';
	public $permisos;
	public $sucursalactiva = '';
	public $turnoactivo = '';
	public $fechaproceso = '';
	public $caja = 0;
	public $formulario = 0;
	
	
	
	function __construct()
	{
	 	$con = new DBManager;
		$con->conectar();
		$this->conf = new configuracion();
		@session_start();
	}
	
	private function recordlog($activity)
	{
		$sql = "INSERT INTO  `seg_loginlog` ( `persona_llo` , `activity_llo` , `date_llo` , `ip_llo` , `sessionid_llo` ,`url_llo` ) VALUES ( '".$this->userid."',  '".$activity."', now() ,  '".$_SERVER['REMOTE_ADDR']."',  '".session_id()."',  '".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']."')";
		mysql_query($sql) or die(mysql_error());
	}

	public function savetosession()
	{
		$_SESSION["usrlogin"] = serialize($this);
		
	}
	
	public function logout_usr()
	{	
		$_SESSION["usrlogin"] = $_SESSION["adminlogin"];
	}

	public function logout()
	{
		if(isset($_SESSION["adminlogin"]))
		{
			unset($_SESSION["adminlogin"]);
		}
		
		if(isset($_SESSION["usrlogin"]))
		{
			unset($_SESSION["usrlogin"]);
		}
	}

	public function login()
	{
	$ret = true;	
	 if($this->username != '' && $this->password != '')
	 {
	  
	  try
		 {
			$sql = "SELECT * FROM ext_usuarionegocios u WHERE nombreusuario_eus = '" . mysql_real_escape_string($this->username) . "' AND clave_eus = '".mysql_real_escape_string($this->password)."'";
  						
			$result = mysql_query($sql);
			
			if (mysql_errno()) 
			{ 
				throw new Exception("MySQL error ".mysql_errno().": ".mysql_error().", al querer ejecutar el sql del login: $sql "); 
				$ret = false;
   			}
			 
			if(@mysql_num_rows($result) > 0)
			{
				$row = mysql_fetch_assoc($result);
				
				$this->userid = $row['id_usr'];
				$this->personaid = $this->userid;					
				$this->rol = $row['rol_usr'];
				$this->correo = $row['correoelectronico_usr'];
				$this->loggued = 'S';
				$this->nombre = $row['nombres_usr'];
				$this->apellidop = $row['apellidopaterno_usr'];
				$this->apellidom = $row['apellidomaterno_usr'];
				$this->get_roles();

				$sql_sucursal_activo = "SELECT id_suc, fechaproceso_suc FROM cnf_sucursales WHERE id_suc in (SELECT sucursal_asu FROM seg_accesosucursales WHERE usuario_asu = ". $this->userid." and activo_suc = 'S') limit 1";
		
				$rs = mysql_query($sql_sucursal_activo);
				
				$res=    mysql_fetch_array($rs);
				
				$sql_turno_activo = "SELECT t.id_tur, t.caja_tur, c.formulario_caj FROM tes_turnos t LEFT JOIN tes_cajas c ON t.caja_tur = c.id_caj where t.sucursal_tur = ".$res['id_suc']." and t.persona_tur =".$this->userid." and `cerrado_tur` = 'N' LIMIT 1";
		
				$rs_turno = mysql_query($sql_turno_activo);
				
				$res_turno_activo=    mysql_fetch_array($rs_turno);
	
				$this->sucursalactiva =$res['id_suc'];
				$this->fechaproceso = $res["fechaproceso_suc"];
				$this->caja = $res_turno_activo["caja_tur"];
				$this->formulario = $res_turno_activo["formulario_caj"];
						
				$this->turnoactivo=$res_turno_activo['id_tur'];
				
				
				$this->savetosession();
				mysql_free_result($result);
				
			} else 	
			{
				
				$sql = "SELECT * FROM seg_usuarios WHERE nombreusuario_usr = '" . mysql_real_escape_string($this->username) . "'";
	  			$result = mysql_query($sql);
				if(@mysql_num_rows($result) == 0)
				{
					$this->login_error = "El nombre de usuario ingresado no es valido.";
					$ret = false;
				} else {
					$this->login_error = "La contraseña ingresada no es valida para ese nombre de usuario.";
					$ret = false;
				}
			}
		 }
		 catch(Exception $e)
	   	 {
		   throw $e;
		 }
		
	  if($ret)
	  {
		$this->url = $this->conf->redireccionar_admin;
		
		$this->recordlog("Login Exitoso.");
		if($this->url_requested != "")
		{
			$this->url = $this->url_requested;
			$this->url_requested = "";
		}
	  } else 
	  {
		 // echo "asdasdads"; 
	 	$this->url = $this->conf->redireccionar_fail;
		//$this->recordlog("Login Fallo.");
	  }
	 
	 } else {
	
		$this->login_error = $this->conf->no_defenidos_valores;
		$ret = false;
	 	$this->url = $this->conf->redireccionar_fail;
	 
	 }
	 
	 $this->savetosession();
			
	 return $ret;
	 
	}
	
	public function gotourl()
	{
		echo "<script language=\"javascript\" type=\"text/javascript\">window.open('".$this->url."','_top');</script>";
		exit;
	}
	
	public function verify()
	{
		$ret = false;
		$this->url_requested = "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
		if($this->loggued == 'S')
		{
			foreach($this->permisos as $v )
			{
				if(strstr($_SERVER['PHP_SELF'],$v["ruta_opm"])){ $ret = true;}
			}
		} 
		
		if(!$ret)		
		{
		 	$this->url_requested = "";
			$this->url = $this->conf->redireccionar_fail;
			$this->login_error = $this->conf->no_tiene_permisos;
			$this->savetosession();
		}
		
		$this->savetosession();
		
		return $ret;
	}
	
	public function recoverpassword($email)
	{	
		$ret = false;
		$sql = "SELECT * FROM seg_usuarios WHERE correoelectronico_usr = '" .$email. "'";

		$result = mysql_query($sql) or die (mysql_error());
				
		if($result && mysql_num_rows($result) > 0)
		{
			$row = mysql_fetch_assoc($result);	
			$n = rand(10e16, 10e20);
			$newpass = base_convert($n, 10, 36);
			$message = "Se a recuperado su contraseña:\nSu nombre de usuario es : [!uname] \nsu nueva contraseña es : [!newpass] \n \n Gracias por usar nuestros servicios.";
			$message = str_replace("[!uname]",$row["nombreusuario_usr"],$message);
			$message = str_replace("[!newpass]",$newpass,$message);
			$titulo = " Recuperación de contraseña";
			$to = $row["correoelectronico_usr"];
			$header = "From:".$this->conf->correo_admin;
			mail($to,$titulo,$message,$header);
			$ret = true;
			$id = $row["id_usr"];
			$ant = $row["clave_usr"];
			mysql_free_result($result);
			$sql = "UPDATE seg_usuarios SET clave_usr = '".md5($newpass)."', claveanterior_usr = '$ant' WHERE id_usr = $id";
			$result = mysql_query($sql);		
		} else
		{
			$this->login_error ="No se pudo encontrar este correo electronico en nuestro sistema por favor ingrese el correo con el que se registró.";
		}
		return $ret;
	}
	
	public function get_roles()
	{	
		$ret = false;
		if($this->loggued == 'S')
		{
			$sql = "SELECT r.id_rol, p.id_per, o.id_opm, opcionmenu_per, activo_rol, nombre_opm, ruta_opm, opcionpadre_opm  FROM (seg_roles r LEFT JOIN seg_permisos p ON r.id_rol = p.rol_per ) LEFT JOIN seg_opcionesmenu o ON p.opcionmenu_per = o.id_opm WHERE r.id_rol = ".$this->rol; // EVALUAR activo_rol debe ser Y en el WHERE o se debe pasar y que se evalue en el codigo ???
			$result = mysql_query($sql) or die(mysql_error());
			if(mysql_num_rows($result) > 0)
			{
				$ret = true;
				$row = mysql_fetch_assoc($result);
				$i = 0;
				do{
					$this->permisos[$i] = $row;
					$i++;
				}while($row = mysql_fetch_assoc($result));
				mysql_free_result($result);
			}
		$this->savetosession();
		}

		return $ret;
		
	}




}


?>