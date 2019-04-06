<?php

require_once "config.php";

//carrega um usuario
//$root = new Usuario();

//$root->loadById(4);

//echo $root;

//list de usuarios

/* $lista = Usuario::getList();

echo json_encode($lista); */

//carrega uma lista de usarios buscando pelo login

/* $search = Usuario::search("r");

echo json_encode($search); */

//carrega um usuario usando o login e senha

/* $usuario = new Usuario();
$usuario->login('ramiro', 'asdfaewkfhjdsfdsfs');

echo $usuario; */

//Criando um novo usuario
/* $aluno = new Usuario("andre", "@aluno");

$aluno->insert();

echo $aluno; */

//Update Usuario alterar usuario

/* $usuario = new Usuario();

$usuario->loadById(5);

$usuario->update("tomate", "tomate2");

echo $usuario;
 */

$usuario = new Usuario();

$usuario->loadById(10);
$usuario->delete();
echo $usuario;
