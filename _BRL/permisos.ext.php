<?php
require_once("permisos.class.php");

class cpermisos_ext extends cpermisos
{
	public function __construct()
    {
        	parent:: __construct();
    }
	
	public function customfunction($var)
    {
       try
	   {
		/*
			//Set Varable before you call the function
			customfunction(array("nombrevariable1" => "valor1", "nombrevariable2" => "valor2" ));
			///use inside the function
			$var["nombrevariable"];
		*/
		
		$sql = "SELECT * FROM seg_permisos";
   		$rs = mysql_query($sql);
		$total_filas = mysql_num_rows($rs);
			
                        $res = array();
                        
                        if($total_filas > 0)
                        {
                            $row = mysql_fetch_assoc($rs);

                            do{
                                $res[] = $row;
                            }while($row = mysql_fetch_assoc($rs));
                        }
                        $this->totalfilas = $total_filas;
                        $this->totalfilasfiltradas = $total_filas;
                        
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
	public function borrarPorRol()
	{
  		 try
		 {
			$sql = "DELETE FROM seg_permisos WHERE rol_per=" . mysql_real_escape_string($this->rol_per);
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
	public function TienePermisos($op_menu,$rol)
  	{
    	try
		{
			$valor_retorno = "false"; 
  			$sql = 'SELECT * FROM seg_permisos WHERE opcionmenu_per = '. $op_menu . ' and rol_per =  ' .$rol ;
			$result = mysql_query($sql);	
			$c = mysql_num_rows($result);
			if( $c > 0)
			{
				$valor_retorno="true";
			}
			
			
			return $valor_retorno;
		}
	 	catch(Exception $e)
	 	{
	   		throw $e;
	 	}
    }
    /*
	public function buscararr($pag,$todos = 'N')
    {
       try
	   {
		$sql = "SELECT * FROM seg_permisos";
        	$sql_total = "SELECT count(*) as cantidad_filas FROM seg_permisos"; 
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
                                $res[$row["id_per"]] = $row;
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
    */
    
}
?>