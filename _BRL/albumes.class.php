<?php 
include_once("../_DAL/conexion.php");
include_once("../_UTL/funcionesBRL.php");
include_once("DataSet.php");

class calbumes
{
	 
	public $id_alm;
	
	public $nombre_alm;
	public $gestion_alm;
	public $portada_alm;
	public $descripcion_alm;
	public $activo_alm;
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
		$this->id_alm = "";
		
		$this->nombre_alm = "";
		$this->gestion_alm = "";
		$this->portada_alm = "";
		$this->descripcion_alm = "";
		$this->activo_alm = "";
		$this->fechahora_mod="";
		$this->fechahora_ins="";
		$this->usuario_mod="";
		$this->usuario_ins="";
	}
	
	public function borrar()
	{
  		 try
		 {
			$sql = "DELETE FROM smc_albumes WHERE id_alm=" . mysql_real_escape_string($this->id_alm);
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
			$sql = "INSERT INTO smc_albumes SET
					
					nombre_alm='" . mysql_real_escape_string($this->nombre_alm) . "',
  
					gestion_alm='" . mysql_real_escape_string($this->gestion_alm) . "',
  
					portada_alm='" . mysql_real_escape_string($this->portada_alm) . "',
  
					descripcion_alm='" . ($this->descripcion_alm) . "',
  
					activo_alm='" . mysql_real_escape_string($this->activo_alm) . "',
  
					fechahora_mod=now(), 
					fechahora_ins=now(), 
					usuario_mod=" . mysql_real_escape_string($this->usuario_mod) . ", 
					usuario_ins=" . mysql_real_escape_string($this->usuario_ins) ;
	
			mysql_query($sql);
			$this->id_alm = mysql_insert_id();
			
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
  			$sql = "UPDATE smc_albumes SET
        			
						nombre_alm='" . mysql_real_escape_string($this->nombre_alm) . "',
  
						gestion_alm='" . mysql_real_escape_string($this->gestion_alm) . "',
  
						portada_alm='" . mysql_real_escape_string($this->portada_alm) . "',
  
						descripcion_alm='" . ($this->descripcion_alm) . "',
  
						activo_alm='" . mysql_real_escape_string($this->activo_alm) . "',
  
				fechahora_mod=now(),
				usuario_mod=" . mysql_real_escape_string($this->usuario_mod) . "
      			WHERE
        		id_alm="   . mysql_real_escape_string($this->id_alm);
  
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
  			$sql = 'SELECT * FROM smc_albumes WHERE id_alm=\'' . mysql_real_escape_string($this->id_alm)."'";
			$result = mysql_query($sql);	
			$c = mysql_num_rows($result);
			if( $c > 0)
			{
				$row = mysql_fetch_array($result);			   		
				$this->id_alm = $row['id_alm'];
				
				$this->nombre_alm = $row['nombre_alm'];
				$this->gestion_alm = $row['gestion_alm'];
				$this->portada_alm = $row['portada_alm'];
				$this->descripcion_alm = $row['descripcion_alm'];
				$this->activo_alm = $row['activo_alm'];
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
			$sql = "DELETE FROM smc_albumes ";

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
		    $sql = "SELECT * FROM smc_albumes";
        	$sql_total = "SELECT count(*) as cantidad_filas FROM smc_albumes"; 
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
		$sql = "SELECT * FROM smc_albumes";
        	$sql_total = "SELECT count(*) as cantidad_filas FROM smc_albumes"; 
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
                                $res[$row["id_alm"]] = $row;
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