<?php
require_once("circulares.class.php");

class ccirculares_ext extends ccirculares
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
		
		$sql = "SELECT * FROM smc_circulares";
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

    public function get_circulares_tipo($var)
    {
       try
	   {

		$sql = "SELECT *
		FROM smc_circulares where tipocircular_crc = ".$var;
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
	
    /*
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
    */
    
}
?>