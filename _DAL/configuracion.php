<?php
class configuracion 
{
	var $servidor;
	var $usuario;
	var $clave;
	var $basededatos;
	var $conect;
	var $persistencia;
	//Added by Hans for Seguridad Jul 22
	var $rootpath;
	var $correo_admin;
	var $redireccionar_admin;
	var $redireccionar_user;
	var $redireccionar_fail;
	var $login_no_activo;
	var $usuario_no_valido;
	var $clave_no_valida;
	var $no_defenidos_valores;
	var $no_tiene_permisos;
	var $titulo_recuperar_correo;
	var $recuperar_correo;
	var $nose_encontro_recuperar;	
	//end added
	var $nombre_empresa;
	
	function configuracion()
	{  
		/*
		//Server
		$this->servidor = "localhost";
		$this->usuario = "phpexper_dbuser";
		$this->clave = "hanshans";
		$this->basededatos = "phpexper_db";
		$this->persistencia = false;
		*/
		/*
		//Server APF
		$this->servidor = "mysql5.000webhost.com";
		$this->usuario = "a1692580_admin2";
		$this->clave = "shadow6786";
		$this->basededatos = "a1692580_bdapf2";
		$this->persistencia = false;
		*/
		
		// Localhost
		$this->servidor = "localhost";
		$this->usuario = "root";
		$this->clave = "";
		$this->basededatos = "apf_bd";
		$this->persistencia = false;
		
		//Variables de empresa
 		$this->nombre_empresa = "APF";

		// Root Path para tener la raiz del sitio http://www.misitio.com/  ** notar la barra final / **
		//$this->rootpath = "http://www.apf-alemansc.com.bo/apf2/";
		$this->rootpath = "http://localhost:81/apf2/";
		$this->correo_admin = "clerigo.6786@gmail.com";
		
		// DATOS DE SEGURIDAD 
		
		$this->redireccionar_admin = $this->rootpath  .'frameset.php';
		$this->redireccionar_user = $this->rootpath  . 'frameset.php';
		$this->redireccionar_fail = $this->rootpath  . 'ingreso.php';

		// Mensajes
		$this->login_no_activo = "El usuario se encuentra inactivo por favor contactese con el administrador.";
		$this->usuario_no_valido = "El nombre de usuario ingresado no es valido.";
		$this->clave_no_valida = "La contraseña ingresada no es valida para ese nombre de usuario.";
		$this->no_defenidos_valores = "El nombre de usuario y la contraseña son requeridos para ingresar al sitio seguro.";
		$this->no_tiene_permisos = "No tiene permisos para ingresar a esta pagina por favor ingrese al sitio con su nombre de usuario y contraseña antes de ingresar a esta pagina.";
		$this->nose_encontro_recuperar = "No se pudo encontrar este correo electronico en nuestro sistema por favor ingrese el correo con el que se registro.";
		$this->titulo_recuperar_correo = "A Solicitado recuperar su contraseña.";
		$this->recuperar_correo = "Se a recuperado su contraseña:\nSu nombre de usuario es : [!uname] \nsu nueva contraseña es : [!newpass] \n \n Gracias por usar nuestros servicios."; 
		//recuperar_correo ** texto solamente no html [!newpass] la nueva contraseña [!uname] el nombre de usuario

	}
}
?>