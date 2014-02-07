<?php
require_once("opcionesmenu.class.php");

class copcionesmenu_ext extends copcionesmenu
{
	public function __construct()
    {
        	parent:: __construct();
    }
	
	public function ObtenerAgrupadores()
    {
       try
	   {
		    $sql = "SELECT * FROM seg_opcionesmenu where opcionpadre_opm = 1 and nombre_opm !='Inicio' ";
        	$rs = mysql_query($sql);
			$num_rows = mysql_num_rows($rs);
			return new DataSet($rs,$num_rows,$num_rows);
	   }
	   catch(Exception $e)
	   {
		   throw $e;
	   }
    }
	public function ObtenerContenidoAgrupadores($val)
    {
       try
	   {
		    $sql = "SELECT * FROM seg_opcionesmenu where opcionpadre_opm =" . $val ;
        	$rs = mysql_query($sql);
			$num_rows = mysql_num_rows($rs);
			return new DataSet($rs,$num_rows,$num_rows);
	   }
	   catch(Exception $e)
	   {
		   throw $e;
	   }
    }
	public function ObtenerAgrupadoresPorRol($rol)
    {
       try
	   {
		    $sql = "SELECT o.*, tot FROM seg_opcionesmenu o INNER JOIN (SELECT x.opcionpadre_opm as id, count(x.opcionpadre_opm) as tot FROM seg_opcionesmenu x LEFT JOIN seg_opcionesmenu xx ON x.id_opm = xx.opcionpadre_opm GROUP BY x.opcionpadre_opm ) om ON o.id_opm = om.id WHERE o.opcionpadre_opm = 1 and o.nombre_opm !='Inicio' AND o.id_opm in ( SELECT ou.opcionmenu_per FROM seg_permisos ou WHERE ou.rol_per =".$rol."  )";

        	$rs = mysql_query($sql);
			$num_rows = mysql_num_rows($rs);
			return new DataSet($rs,$num_rows,$num_rows);
	   }
	   catch(Exception $e)
	   {
		   throw $e;
	   }
    }
	public function ObtenerContenidoAgrupadoresPorRol($val, $rol)
    {
       try
	   {
		    $sql = "SELECT * FROM seg_opcionesmenu where opcionpadre_opm =" . $val . "  and id_opm in ( SELECT opcionmenu_per FROM seg_permisos WHERE rol_per =".$rol." )";
        	$rs = mysql_query($sql);
			$num_rows = mysql_num_rows($rs);
			return new DataSet($rs,$num_rows,$num_rows);
	   }
	   catch(Exception $e)
	   {
		   throw $e;
	   }
    }
    
    public function buscarAll()
    {
       try
	   {
		    $sql = "SELECT * FROM seg_opcionesmenu ORDER BY orden_opm ASC";
        	$sql_total = "SELECT count(*) as cantidad_filas FROM seg_opcionesmenu"; 
			
			
			$rs = mysql_query($sql);
			
			//total_regsitros
			$rs_total = mysql_query($sql_total);
			$total_filas =  mysql_result($rs_total, 0, "cantidad_filas"); ;
			
			//registros_filtrados
			$rs_filtrado = mysql_query($sql);
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
	
	public function ObtenerHijos($id)
    {
       try
	   {
		    $sql = "SELECT * FROM seg_opcionesmenu om WHERE om.opcionpadre_opm = ".$id.' ORDER BY om.orden_opm';
        	$sql_total = "SELECT count(*) as cantidad_filas FROM seg_opcionesmenu om WHERE om.opcionpadre_opm = ".$id.' ORDER BY om.orden_opm'; 
			
			
			$rs = mysql_query($sql);
			
			//total_regsitros
			$rs_total = mysql_query($sql_total);
			$total_filas =  mysql_result($rs_total, 0, "cantidad_filas"); ;
			
			//registros_filtrados
			$rs_filtrado = mysql_query($sql);
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
	
    /*
    public function actualizaralgo()
	{
		try
		{
  			$sql = "UPDATE seg_opcionesmenu SET FIELD='" . mysql_real_escape_string($this->FIELD) . "' WHERE PK="   . mysql_real_escape_string($this->PK);
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
    */
    
}
?>
