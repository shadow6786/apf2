<?php 
include_once("../_DAL/conexion.php");
include_once("../_UTL/funcionesBRL.php");
include_once("DataSet.php");

class cusuarios
{
	 
	public $id_usr;
	
	public $nombres_usr;
	public $apellidopaterno_usr;
	public $apellidomaterno_usr;
	public $clave_usr;
	public $usuario_usr;
	public $claveanterior_usr;
	public $rol_usr;
	public $activo_usr;
	public $fechahora_mod;
	public $fechahora_ins;
	public $usuario_mod;
	public $usuario_ins;
	public $filtros;
	public $totalfilas;
	public $totalfilasfiltradas;        

	function __construct()
	{
	 	$con = new DBManager;
		$con->conectar();
	}
	
	public function VaciarVariables()
	{
		$this->id_usr = "";
		
		$this->nombres_usr = "";
		$this->apellidopaterno_usr = "";
		$this->apellidomaterno_usr = "";
		$this->clave_usr = "";
		$this->usuario_usr = "";
		$this->claveanterior_usr = "";
		$this->rol_usr = "";
		$this->activo_usr = "";
		$this->fechahora_mod="";
		$this->fechahora_ins="";
		$this->usuario_mod="";
		$this->usuario_ins="";
	}
	
	public function borrar()
	{
  		 try
		 {
			$sql = "DELETE FROM seg_usuarios WHERE id_usr=" . mysql_real_escape_string($this->id_usr);
  			mysql_query($sql);
			if (mysql_errno()) 
			{ 
				throw new Exception("MySQL error ".mysql_errno().": ".mysql_error().", al querer ejecutar: $sql "); 
   			} 
		 }
		 catch(Exception $e)
	   	 {
		   throw $e;
		 }
	}


	public function insertar()	
	{
		try
		 {
			$sql = "INSERT INTO seg_usuarios SET
					
					nombres_usr='" . mysql_real_escape_string($this->nombres_usr) . "',
  
					apellidopaterno_usr='" . mysql_real_escape_string($this->apellidopaterno_usr) . "',
  
					apellidomaterno_usr='" . mysql_real_escape_string($this->apellidomaterno_usr) . "',
  
					clave_usr='" . mysql_real_escape_string($this->clave_usr) . "',
  
					usuario_usr='" . mysql_real_escape_string($this->usuario_usr) . "',
  
					claveanterior_usr='" . mysql_real_escape_string($this->claveanterior_usr) . "',
  
					rol_usr='" . mysql_real_escape_string($this->rol_usr) . "',
  
					activo_usr='" . mysql_real_escape_string($this->activo_usr) . "',
  
					fechahora_mod=now(), 
					fechahora_ins=now(), 
					usuario_mod=" . mysql_real_escape_string($this->usuario_mod) . ", 
					usuario_ins=" . mysql_real_escape_string($this->usuario_ins) ;
	
			mysql_query($sql);
			$this->id_usr = mysql_insert_id();
			
  			if (mysql_errno()) 
			{ 
				throw new Exception("MySQL error ".mysql_errno().": ".mysql_error().", al querer ejecutar: $sql "); 
   			} 
		 }
		 catch(Exception $e)
	   	 {
		   throw $e;
		 }
		 
	}

	public function actualizar()
	{
		try
		{
  			$sql = "UPDATE seg_usuarios SET
        			
						nombres_usr='" . mysql_real_escape_string($this->nombres_usr) . "',
  
						apellidopaterno_usr='" . mysql_real_escape_string($this->apellidopaterno_usr) . "',
  
						apellidomaterno_usr='" . mysql_real_escape_string($this->apellidomaterno_usr) . "',
  
						clave_usr='" . mysql_real_escape_string($this->clave_usr) . "',
  
						usuario_usr='" . mysql_real_escape_string($this->usuario_usr) . "',
  
						claveanterior_usr='" . mysql_real_escape_string($this->claveanterior_usr) . "',
  
						rol_usr='" . mysql_real_escape_string($this->rol_usr) . "',
  
						activo_usr='" . mysql_real_escape_string($this->activo_usr) . "',
  
				fechahora_mod=now(),
				usuario_mod=" . mysql_real_escape_string($this->usuario_mod) . "
      			WHERE
        		id_usr="   . mysql_real_escape_string($this->id_usr);
  
			mysql_query($sql);
			if (mysql_errno()) 
			{ 
				throw new Exception("MySQL error ".mysql_errno().": ".mysql_error().", al querer ejecutar: $sql "); 
   			} 
		 }
		 catch(Exception $e)
	   	 {
		   throw $e;
		 }
	}
	
	public function ObtenerUnRegistro()
  	{
    	try
		{
  			$sql = 'SELECT * FROM seg_usuarios WHERE id_usr=\'' . mysql_real_escape_string($this->id_usr)."'";
			$result = mysql_query($sql);	
			$c = mysql_num_rows($result);
			if( $c > 0)
			{
				$row = mysql_fetch_array($result);			   		
				$this->id_usr = $row['id_usr'];
				
				$this->nombres_usr = $row['nombres_usr'];
				$this->apellidopaterno_usr = $row['apellidopaterno_usr'];
				$this->apellidomaterno_usr = $row['apellidomaterno_usr'];
				$this->clave_usr = $row['clave_usr'];
				$this->usuario_usr = $row['usuario_usr'];
				$this->claveanterior_usr = $row['claveanterior_usr'];
				$this->rol_usr = $row['rol_usr'];
				$this->activo_usr = $row['activo_usr'];
				$this->fechahora_mod = $row['fechahora_mod'];
				$this->fechahora_ins = $row['fechahora_ins'];
				$this->usuario_mod = $row['usuario_mod'];
				$this->usuario_ins = $row['usuario_ins'];
			}
			else
			{
				$this->VaciarVariables();
			}
			
			return $c;
			
		}
	 	catch(Exception $e)
	 	{
	   		throw $e;
	 	}
    }

	public function BorrarPorFiltro()
	{
	
	  	 try
		 {
			$sql = "DELETE FROM seg_usuarios ";

  			$where = ObtenerWhere($this->filtros);
			
			if ($where != "")
			{
				$sql .= " WHERE " . $where;
				mysql_query($sql);
			}
			
			if (mysql_errno()) 
			{ 
				throw new Exception("MySQL error ".mysql_errno().": ".mysql_error().", al querer ejecutar: $sql "); 
   			} 
		 }
		 catch(Exception $e)
	   	 {
		   throw $e;
		 }
	}
  
    public function buscar($pag,$todos = 'N')
    {
       try
	   {
		    $sql = "SELECT * FROM seg_usuarios";
        	$sql_total = "SELECT count(*) as cantidad_filas FROM seg_usuarios"; 
			$sql_filtrado = "";
			$where = array();
			
			$where = ObtenerWhere($this->filtros);
			
			if ($where != "")
			{
				$sql .= " WHERE " . $where;
			}	
			if ($pag <1)
			{ 
				$pag_ini =0;
			}
			else
			{
				$pag_ini = ($pag-1)*20;
			}
			$sql_filtrado = $sql;
			$sql .=  " LIMIT ".$pag_ini.",20";
			
			//registros
			if($todos == 'N')
			{
				$rs = mysql_query($sql);
			} else 
			{
				$rs = mysql_query($sql_filtrado);
			}
			
			//total_regsitros
			$rs_total = mysql_query($sql_total);
			$total_filas =  mysql_result($rs_total, 0, "cantidad_filas"); ;
			
			//registros_filtrados
			$rs_filtrado = mysql_query($sql_filtrado);
			$total_filas_filtradas = mysql_num_rows($rs_filtrado);
			
			return new DataSet($rs,$total_filas_filtradas,$total_filas);
			if ($total_filas == 0) 
			{ 
				throw new Exception("no hay regsitros"); 
   			} 
			
	   }
	   catch(Exception $e)
	   {
		   throw $e;
	   }
    }
    public function buscararr($pag,$todos = 'N')
    {
       try
	   {
		$sql = "SELECT * FROM seg_usuarios";
        	$sql_total = "SELECT count(*) as cantidad_filas FROM seg_usuarios"; 
		$sql_filtrado = "";
		$where = array();
			
		$where = ObtenerWhere($this->filtros);
			
		if ($where != "")
		{
			$sql .= " WHERE " . $where;
		}	
		if ($pag <1)
		{ 
			$pag_ini =0;
		}
		else
		{
			$pag_ini = ($pag-1)*20;
		}
		$sql_filtrado = $sql;
		$sql .=  " LIMIT ".$pag_ini.",20";
			
			//registros
			if($todos == 'N')
			{
				$rs = mysql_query($sql);
			} else 
			{
				$rs = mysql_query($sql_filtrado);
			}
			
			//total_regsitros
			$rs_total = mysql_query($sql_total);
			$total_filas =  mysql_result($rs_total, 0, "cantidad_filas"); ;
			
			//registros_filtrados
			$rs_filtrado = mysql_query($sql_filtrado);
			$total_filas_filtradas = mysql_num_rows($rs_filtrado);
			
                        $res = array();
                        
                        if($total_filas_filtradas > 0)
                        {
                            $row = mysql_fetch_assoc($rs);

                            do{
                                $res[$row["id_usr"]] = $row;
                            }while($row = mysql_fetch_assoc($rs));
                        }
                        $this->totalfilas = $total_filas;
                        $this->totalfilasfiltradas = $total_filas_filtradas;
                        
                        return $res;
                        
                        if ($total_filas == 0) 
			{ 
				throw new Exception("no hay regsitros"); 
   			}
			
	   }
	   catch(Exception $e)
	   {
		   throw $e;
	   }
    }

 }
?>