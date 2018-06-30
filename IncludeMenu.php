<?php
    require_once ("IncludeMenuAutenticacao.php");
    require_once ("Sessao.php");
    $sessao = Sessao::getInstance();
    $autenticacao = $sessao->recuperar("AUTENTICACAO");
?>