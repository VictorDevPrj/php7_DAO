<?php

require_once("config.php");

//===============================================================
/*
$sql = new Sql();
$usuarios = $sql->select("SELECT * FROM tb_usuario");
echo json_encode($usuarios);
*/

// ==============================================================

/*
//CARREGA UM USUÁRIO
$root = new Usuario();
$root->loadById(7);
echo $root;
*/

// ==============================================================

/*
//CARREGA UMA LISTA DE USUARIO
$lista = Usuario::getList();
echo json_encode($lista);
*/

// ==============================================================

/*
//CARREGA UMA LISTA DE USUARIO BUSCAND PELO LOGIN
$search = Usuario::search("se");
echo json_encode($search);
*/

// ==============================================================

/*
//CARREGA UM USUARIO USANDO O LOGIN E A SENHA
$usuario = new Usuario();
$usuario->login("jao", "2020S");
echo $usuario;
*/

// ==============================================================

/*
// inserindo dados
$aluno = new Usuario("aluno", "dfsvhbnkl33");
// OS dados estao sendo passado direto -- para o construct
$aluno->insert();
echo $aluno;
*/

// ==============================================================

/*
// Alterar um usuario
$usuario = new Usuario();
$usuario->loadById(10);
echo $usuario;
$usuario->update("Aluna", "zenhasr");
echo $usuario
*/

// ==============================================================

//deletar

$usuario = new Usuario();

$usuario->loadById(5);

echo $usuario;

$usuario->delete();

echo $usuario;
?>