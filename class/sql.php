<?php 

class Sql extends PDO
{
	private $conn;


	public function __construct()
	{
		$this->conn = new PDO("mysql:host=localhost;dbname=dbphp7", "root", "");
	}

	private function setParams($stament,$parameters = array())
	{
		foreach ($parameters as $key => $value) {
			$this->setParam($stament,$key,$value);
		}
	}

	private function setParam($stament,$key,$value)
	{
		$stament->bindparam($key,$value);
	}

	public function query($rawquery,$params = array(), $var = false)
	{
		$stmt = $this->conn->prepare($rawquery);

		$this->setParams($stmt,$params);

		if($var)
		return $stmt->execute();
		else 
		{
			$stmt->execute();
			return $stmt;
		}
		
	}

	public function select($rawquery,$params = array()):array
	{
		$stmt = $this->query($rawquery,$params);

		return $stmt->fetchall(PDO::FETCH_ASSOC);		
	}

}
































?>