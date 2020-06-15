<?php

require_once("config.php");

/*
$sql = new Sql();

$usuarios = $sql->select("SELECT * FROM tb_usuario");

echo json_encode($usuarios);
*/

/*
CARREGA UM USUÁRIO

$root = new Usuario();

$root->loadById(7);

echo $root;
*/

// CARREGA UMA LISTA DE USUARIO
//$lista = Usuario::getList();

//echo json_encode($lista);

// CARREGA UMA LISTA DE USUARIO BUSCAND PELO LOGIN
//$search = Usuario::search("se");

//echo json_encode($search);

//CARREGA UM USUARIO USANDO O LOGIN E A SENHA
$usuario = new Usuario();
$usuario->login("jao", "2020S");

echo $usuario;
?>