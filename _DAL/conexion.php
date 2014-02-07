<?php 
 include_once("configuracion.php");

 class DBManager
 {
	
  var $db_connect_id;
  var $query_result;
    var $row = array();
    var $rowset = array();
    var $num_queries = 0;
	
  //Método que se encargará de la verificar y realizar
  //la conexión
  function conectar() 
  {
	 global $glconn;
	 
	 if(!isset($glconn))
	 {
	   $ret = true;
	   $configuracion = new configuracion();
	   if($configuracion->persistencia) 
	   {
		   $this->db_connect_id =@mysql_pconnect($configuracion->servidor,$configuracion->usuario,$configuracion->clave);
	   }
	   else
	   {
		   $this->db_connect_id =@mysql_connect($configuracion->servidor,$configuracion->usuario,$configuracion->clave);
	   }
	   
	   if ( ! $this->db_connect_id )
	   {
		  throw new Exception("Error al conectar a la base de datos"); 
		  $ret = false;
		  exit();
	   }
	   
	   if (!@mysql_select_db($configuracion->basededatos, $this->db_connect_id)) 
	   {
			throw new Exception("Error al seleccionar la base de datos");  
			$ret = false;
			exit();
	   }
	   $glconn = $this->db_connect_id;
	   $this->conect= $this->db_connect_id;
	 //  mysql_set_charset("Latin-1");
	   register_shutdown_function(array(&$this, "desconectar"));
	   
     }
	 else
	 {
	   $ret = true;
	   $this->conect = $glconn;
	   $this->db_connect_id = $glconn;
	 }
     //mysql_query("SET NAMES 'latin'");
	 mysql_set_charset('latin1');
     return $ret; 
  }
  
  function desconectar() 
  {
    if($this->db_connect_id) 
	{
      if($this->query_result) 
	  {
        @mysql_free_result($this->query_result);
      }
      $result = @mysql_close($this->db_connect_id);
    } else {
      $result = false;
    }
	
	return $result;	
  }
 }
 
?>
