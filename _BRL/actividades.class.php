<?php 
include_once("../_DAL/conexion.php");
include_once("../_UTL/funcionesBRL.php");
include_once("DataSet.php");

class cactividades
{
	 
	public $id_act;
	
	public $nombre_act;
	public $fechainicio_act;
	public $fechafin_act;
	public $archivo_act;
	public $tipofecha_act;
	public $gestion_act;
	public $activo_act;
	public $descripcion_act;
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
		$this->id_act = "";
		
		$this->nombre_act = "";
		$this->fechainicio_act = "";
		$this->fechafin_act = "";
		$this->archivo_act = "";
		$this->tipofecha_act = "";
		$this->gestion_act = "";
		$this->activo_act = "";
		$this->descripcion_act = "";
		$this->fechahora_mod="";
		$this->fechahora_ins="";
		$this->usuario_mod="";
		$this->usuario_ins="";
	}
	
	public function borrar()
	{
  		 try
		 {
			$sql = "DELETE FROM smc_actividades WHERE id_act=" . mysql_real_escape_string($this->id_act);
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
			$sql = "INSERT INTO smc_actividades SET
					
					nombre_act='" . mysql_real_escape_string($this->nombre_act) . "',
  
						fechainicio_act='" . mysql_real_escape_string(date("Y-m-d H:i:s",strtotime($this->fechainicio_act))) . "',
  
						fechafin_act='" . mysql_real_escape_string(date("Y-m-d H:i:s",strtotime($this->fechafin_act))) . "',
  
					archivo_act='" . mysql_real_escape_string($this->archivo_act) . "',
  
					tipofecha_act='" . mysql_real_escape_string($this->tipofecha_act) . "',
  
					gestion_act='" . mysql_real_escape_string($this->gestion_act) . "',
  
					activo_act='" . mysql_real_escape_string($this->activo_act) . "',
  
					descripcion_act='" . ($this->descripcion_act) . "',
  
					fechahora_mod=now(), 
					fechahora_ins=now(), 
					usuario_mod=" . mysql_real_escape_string($this->usuario_mod) . ", 
					usuario_ins=" . mysql_real_escape_string($this->usuario_ins) ;
	
			mysql_query($sql);
			$this->id_act = mysql_insert_id();
			
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
  			$sql = "UPDATE smc_actividades SET
        			
						nombre_act='" . mysql_real_escape_string($this->nombre_act) . "',
  
						fechainicio_act='" . mysql_real_escape_string(date("Y-m-d H:i:s",strtotime($this->fechainicio_act))) . "',
  
						fechafin_act='" . mysql_real_escape_string(date("Y-m-d H:i:s",strtotime($this->fechafin_act))) . "',
  
						archivo_act='" . mysql_real_escape_string($this->archivo_act) . "',
  
						tipofecha_act='" . mysql_real_escape_string($this->tipofecha_act) . "',
  
						gestion_act='" . mysql_real_escape_string($this->gestion_act) . "',
  
						activo_act='" . mysql_real_escape_string($this->activo_act) . "',
  
						descripcion_act='" . ($this->descripcion_act) . "',
  
				fechahora_mod=now(),
				usuario_mod=" . mysql_real_escape_string($this->usuario_mod) . "
      			WHERE
        		id_act="   . mysql_real_escape_string($this->id_act);
  
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
  			$sql = 'SELECT * FROM smc_actividades WHERE id_act=\'' . mysql_real_escape_string($this->id_act)."'";
			$result = mysql_query($sql);	
			$c = mysql_num_rows($result);
			if( $c > 0)
			{
				$row = mysql_fetch_array($result);			   		
				$this->id_act = $row['id_act'];
				
				$this->nombre_act = $row['nombre_act'];
				$this->fechainicio_act = $row['fechainicio_act'];
				$this->fechafin_act = $row['fechafin_act'];
				$this->archivo_act = $row['archivo_act'];
				$this->tipofecha_act = $row['tipofecha_act'];
				$this->gestion_act = $row['gestion_act'];
				$this->activo_act = $row['activo_act'];
				$this->descripcion_act = $row['descripcion_act'];
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
			$sql = "DELETE FROM smc_actividades ";

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
		    $sql = "SELECT * FROM smc_actividades";
        	$sql_total = "SELECT count(*) as cantidad_filas FROM smc_actividades"; 
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
		$sql = "SELECT * FROM smc_actividades";
        	$sql_total = "SELECT count(*) as cantidad_filas FROM smc_actividades"; 
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
                                $res[$row["id_act"]] = $row;
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