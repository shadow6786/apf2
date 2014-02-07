<?php
require_once("usuarios.class.php");

class cusuarios_ext extends cusuarios
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
		
		$sql = "SELECT * FROM seg_usuarios";
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
	public function encontrar_Id_por_Usuario($usuario)

    {

       try

	   {

		    $sql = "SELECT id_usr FROM seg_usuarios where nombreusuario_usr ='" . $usuario . "' ";

        	$rs = mysql_query($sql);

			return mysql_fetch_assoc($rs);

	   }

	   catch(Exception $e)

	   {

		   throw $e;

	   }

    }
	

	public function UsuariosPorRol($rol)

    {

       try

	   {

		    $sql = "SELECT * FROM seg_usuarios where rol_usr =" . $rol;

        	$rs = mysql_query($sql);

			$num_rows = mysql_num_rows($rs);

			return new DataSet($rs,$num_rows,$num_rows);

	   }

	   catch(Exception $e)

	   {

		   throw $e;

	   }

    }
	
	 public function getAutoAutoC(){
		try{
			$sql = "SELECT * FROM seg_usuarios";
			$result = mysql_query($sql);
			$cadena = "";
			while($row = mysql_fetch_array($result)){
				$nombre = $row['nombreusuario_usr'];
				$idCliente = $row['id_usr'];
				$cadena = $cadena.$nombre."|$idCliente\n";
			}
			return $cadena;
		}catch(Exception $e){
			throw $e;
		}
	}

	

	public function CambiarClave($var)
	{

		try

		{
			$this->id_usr = $var["usuarioid"];
  			$this->ObtenerUnRegistro();

			

			if ($var["nueva_clave"] == $this->claveanterior_usr) 

			{

				throw new Exception("La nueva clave no puede ser igual a la anterior. ");	

			}

			if ($var["nueva_clave"] == $this->clave_usr) 

			{

				throw new Exception("La nueva clave es igual a la actual. ");	

			}
			

			$sql = "UPDATE seg_usuarios SET

				

				

				clave_usr='" . mysql_real_escape_string($var["nueva_clave"]) . "',
				
				claveanterior_usr='".$this->clave_usr ."',
				
				fechahora_mod=now(),

				usuario_mod=" . mysql_real_escape_string($var["usuario_cambia"]) . "

      			WHERE

        		id_usr="   . mysql_real_escape_string($var["usuarioid"]);

  

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
	
	
	
	public function iniciar($var)
    {
       try
	   {
		/*
			//Set Varable before you call the function
			customfunction(array("nombrevariable1" => "valor1", "nombrevariable2" => "valor2" ));
			///use inside the function
			$var["nombrevariable"];
		*/
		
		$sql = "SELECT * FROM seg_usuarios LEFT JOIN sis_dentistas d 
				ON u.nombreusuario_usr = d.usuario_dnt
				WHERE nombreusuario_usr =  '".$var["user"]."'
				AND clave_usr =  '".$var["pass"]."' ";
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
    */
    
}
?>