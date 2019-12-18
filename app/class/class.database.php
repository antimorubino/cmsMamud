<?php 

class database {
	
	public $mysqli;
	public $sqlquery;
	
	
	public function __construct($mysqli) {
	
	$this->mysqli=$mysqli;

	}

	public function risultati_query()
	{
		
		$mysqli = $this->mysqli;
							
		//echo $query;
									
		$result = $mysqli->query($this->sqlquery);
		
		return $result;
			
	}
	
	public function numero_righe()
	{
		
	$mysqli = $this->mysqli;
		
	$righe = num_rows();
	
	echo $righe;
			
	}	
	
	
}



?>