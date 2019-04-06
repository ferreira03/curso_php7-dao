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

$usuario = new Usuario();
$usuario->login('ramiro', 'asdfaewkfhjdsfdsfs');

echo $usuario;
