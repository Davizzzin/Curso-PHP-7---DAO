<?php 

require_once("config.php");

class usuario
{
	private $sql;



	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function __construct()
	{
		$this->sql = new Sql();
	}

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
		$select = "SELECT * FROM tb_usuarios WHERE idusuario = :ID";

		$results = $this->sql->select($select, array(":ID"=>$id));

		if(count($results) > 0)
		{
			$this->setData($results[0]);
		}
	}

	public static function listAll()
	{
		$sqlStatic = new Sql();
		$select = "SELECT * FROM tb_usuarios ORDER BY deslogin";
		return $sqlStatic->select($select);
	}

	public static function search($login)
	{
		$sqlStatic = new Sql();
		$select = "SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin";
		return $sqlStatic->select($select, array(":SEARCH"=>"%".$login."%"));
	}

	public function login($login,$password)
	{
		$select = "SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD";

		$results = $this->sql->select($select, array(":LOGIN"=>$login,
			":PASSWORD"=>$password));

		if(count($results) > 0)
		{
			$this->setData($results[0]);		
		}
		else 
		{
			throw new Exception("login e/ou senha inválidos.");
		}
	}

	public function insert() : int
	{
		$select = "SELECT idusuario FROM tb_usuarios WHERE deslogin = :LOGIN";
		$result = $this->sql->select($select, array(":LOGIN"=>$login));

		if($result==NULL)
		{
			$inserir = "INSERT INTO tb_usuarios (deslogin, dessenha) VALUES (:LOGIN, :PASSWORD)";

			$linhasAfetadas = $sql->query($inserir, array(':LOGIN'=>$this->getDeslogin(),
				':PASSWORD'=>$this->getDessenha()), true);

			return $linhasAfetadas;
		}
		else 
		{
			throw new Exception("Login informado já cadastrado.");
		}
	}

	public function update($login,$password)
	{
		$this->setDeslogin($login);
		$this->setDessenha($password);

		$update="UPDATE tb_usuarios SET deslogin = :LOGIN , dessenha = :PASSWORD WHERE idusuario = :ID";

		$linhasAfetadas = $this->sql->query($update, array(':LOGIN'=>$this->getDeslogin(), 
			':PASSWORD'=> $this->getDessenha(),
			':ID'=>$this->getIdusuario()),true);

		return $linhasAfetadas;
	}

	public function delete()
	{
		$delete = "DELETE FROM tb_usuarios WHERE idusuario = :ID";
		$linhasAfetadas = $this->sql->query($delete, array(":ID"=>$this->getIdusuario()),true);

		$this->setIdusuario(0);
		$this->setDeslogin("");
		$this->setDessenha("");
		$this->setDtcadastro(NULL);

		return $linhasAfetadas;
	}


	public function setData($data)
	{
			$this->setIdusuario($data['idusuario']);
			$this->setDeslogin($data['deslogin']);
			$this->setDessenha($data['dessenha']);
			$this->setDtcadastro(new DateTime($data['dtcadastro']));
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