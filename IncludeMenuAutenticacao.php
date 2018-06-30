<?php
require_once("Sessao.php");
require_once("Autenticacao.php");

$sessao = Sessao::getInstance();

if ($sessao->existe("AUTENTICACAO")){
    $autenticacao = $sessao->recuperar("AUTENTICACAO");
    $nome = $autenticacao->getNome();
}
else{
    $uri = $_SERVER['REQUEST_URI'];
    header("Location: Login.php?uri_origem=$uri");
}
?>