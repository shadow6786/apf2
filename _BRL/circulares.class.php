<?php 
include_once("../_DAL/conexion.php");
include_once("../_UTL/funcionesBRL.php");
include_once("DataSet.php");

class ccirculares
{
	 
	public $id_crc;
	
	public $nombre_crc;
	public $archivo_crc;
	public $gestion_crc;
	public $tipocircular_crc;
	public $descripcion_crc;
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
		$this->id_crc = "";
		
		$this->nombre_crc = "";
		$this->archivo_crc = "";
		$this->gestion_crc = "";
		$this->tipocircular_crc = "";
		$this->descripcion_crc = "";
		$this->fechahora_mod="";
		$this->fechahora_ins="";
		$this->usuario_mod="";
		$this->usuario_ins="";
	}
	
	public function borrar()
	{
  		 try
		 {
			$sql = "DELETE FROM smc_circulares WHERE id_crc=" . mysql_real_escape_string($this->id_crc);
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
			$sql = "INSERT INTO smc_circulares SET
					
					nombre_crc='" . mysql_real_escape_string($this->nombre_crc) . "',
  
					archivo_crc='" . mysql_real_escape_string($this->archivo_crc) . "',
  
					gestion_crc='" . mysql_real_escape_string($this->gestion_crc) . "',
  
					tipocircular_crc='" . mysql_real_escape_string($this->tipocircular_crc) . "',
  
					descripcion_crc='" . ($this->descripcion_crc) . "',
  
					fechahora_mod=now(), 
					fechahora_ins=now(), 
					usuario_mod=" . mysql_real_escape_string($this->usuario_mod) . ", 
					usuario_ins=" . mysql_real_escape_string($this->usuario_ins) ;
	
			mysql_query($sql);
			$this->id_crc = mysql_insert_id();
			
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
  			$sql = "UPDATE smc_circulares SET
        			
						nombre_crc='" . mysql_real_escape_string($this->nombre_crc) . "',
  
						archivo_crc='" . mysql_real_escape_string($this->archivo_crc) . "',
  
						gestion_crc='" . mysql_real_escape_string($this->gestion_crc) . "',
  
						tipocircular_crc='" . mysql_real_escape_string($this->tipocircular_crc) . "',
  
						descripcion_crc='" . ($this->descripcion_crc) . "',
  
				fechahora_mod=now(),
				usuario_mod=" . mysql_real_escape_string($this->usuario_mod) . "
      			WHERE
        		id_crc="   . mysql_real_escape_string($this->id_crc);
  
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
  			$sql = 'SELECT * FROM smc_circulares WHERE id_crc=\'' . mysql_real_escape_string($this->id_crc)."'";
			$result = mysql_query($sql);	
			$c = mysql_num_rows($result);
			if( $c > 0)
			{
				$row = mysql_fetch_array($result);			   		
				$this->id_crc = $row['id_crc'];
				
				$this->nombre_crc = $row['nombre_crc'];
				$this->archivo_crc = $row['archivo_crc'];
				$this->gestion_crc = $row['gestion_crc'];
				$this->tipocircular_crc = $row['tipocircular_crc'];
				$this->descripcion_crc = $row['descripcion_crc'];
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
			$sql = "DELETE FROM smc_circulares ";

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
		    $sql = "SELECT * FROM smc_circulares";
        	$sql_total = "SELECT count(*) as cantidad_filas FROM smc_circulares"; 
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
		$sql = "SELECT * FROM smc_circulares";
        	$sql_total = "SELECT count(*) as cantidad_filas FROM smc_circulares"; 
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
                                $res[$row["id_crc"]] = $row;
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