<?php 
class DataSet {
	// This member variable will hold the native result set
  	private $rs;
	private $total_filas_filtradas;
	private $total_filas;
	// Assign the native result set to an instance variable
  function __construct($rs, $total_filas_filtradas, $total_filas)
  {
    $this->rs = $rs;
	$this->total_filas_filtradas = $total_filas_filtradas;
	$this->total_filas = $total_filas;
	
  }

	// Receives an instance of the DataObject we're working on
  function getNext($dataobject)
  {
    $row = mysql_fetch_array($this->rs);

    // Use reflection to fetch the DO's field names
    $class = new ReflectionObject($dataobject);
    $properties = $class->getProperties();

    // Loop through the properties to set them from the current row
    for ($i = 0; $i < count($properties)-3; $i++) {
      $prop_name        = $properties[$i]->getName();
      $dataobject->$prop_name = $row[$prop_name];
    }
    
    return $dataobject;
  }

  // Move the pointer back to the beginning of the result set
  function reset($num)
  {
    mysql_data_seek($this->rs,$num);
  }

  // Return the number of rows in the result set
  function rowCount()
  {
    return mysql_num_rows($this->rs);
  }
  
   function TotalFilas()
  {
    return $this->total_filas;
  }
   function TotalFilasFiltradas()
  {
    return $this->total_filas_filtradas;
  }
  
}
?>