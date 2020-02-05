<?php 

require_once("config.php");

/*
$sql = new Sql();

$usuarios = $sql->select("SELECT * FROM tb_usuarios");

//echo json_encode($usuarios);

//usuario unico
$tb = new usuario();
$tb->loadById(4);
echo $tb->getDeslogin();
echo $tb;

echo "---------------------------------<br>";

//todos usuarios 
$lista = usuario::listAll();
echo json_encode($lista);

echo "---------------------------------<br>";

//lista de usuarios buscado pelo login 
$search = usuario::search("jo");

echo json_encode($search);

echo "---------------------------------<br>";

//lista pelo usuario e senha
$usuario = new usuario();
$usuario->login("Davi", "DDD123");

echo $usuario;

//inserir novo cadastro
$novoAluno = new usuario();

echo $novoAluno->insert("LUCAS", "1213");


//Atualiza os dados de um usuario carregado
$atualizar = new usuario();
$atualizar->loadById(11);

echo $atualizar->update("Carla","@!4");
*/

$delete = new usuario();

$delete->loadById(12);
echo $delete->update("lucas", "luquita");

 ?>