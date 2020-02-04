<?php 

require_once("config.php");

class usuario
{
	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	//Setters
	private function setIdusuario($value)
	{
		$this->idusuario = $value;
	}

	private function setDeslogin($value)
	{
		$this->deslogin = $value;
	}

	private function setDessenha($value)
	{
		$this->dessenha = $value;
	}

	private function setDtcadastro($value)
	{
		$this->dtcadastro = $value;
	}

	//Getters
	public function getIdusuario()
	{
		return $this->idusuario;
	}

	public function getDeslogin()
	{
		return $this->deslogin;
	}

	public function getDessenha()
	{
		return $this->dessenha;
	}

	public function getDtcadastro()
	{
		return $this->dtcadastro;
	}

	//pega linha da tabela utilizando um id especificado 
	public function loadById($id)
	{
		$sql = new Sql();
		$select = "SELECT * FROM tb_usuarios WHERE idusuario = :ID";

		$results = $sql->select($select, array(":ID"=>$id));

		if(count($results) > 0)
		{
			$row = $results[0];

			$this->setIdusuario($id);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));
		}
	}

	public static function listAll()
	{
		$sql = new Sql();
		$select = "SELECT * FROM tb_usuarios ORDER BY deslogin";
		return $sql->select($select);
	}

	public static function search($login)
	{
		$sql = new Sql();
		$select = "SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin";
		return $sql->select($select, array(":SEARCH"=>"%".$login."%"));
	}

	public function login($login,$password)
	{
		$sql = new Sql();
		$select = "SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD";

		$results = $sql->select($select, array(":LOGIN"=>$login,
			":PASSWORD"=>$password));

		if(count($results) > 0)
		{
			$row = $results[0];

			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));
		}
		else 
		{
			throw new Exception("login e/ou senha inválidos.");
		}
	}

	public function __toString()
	{
		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"desenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()
		));	
	}



}

 ?>