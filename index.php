<?php 

require_once("config.php");

$sql = new Sql();

$usuarios = $sql->select("SELECT * FROM tb_usuarios");

//echo json_encode($usuarios);


$tb = new usuario();
$tb->loadById(4);
echo $tb->getDeslogin();
echo $tb;

 ?>