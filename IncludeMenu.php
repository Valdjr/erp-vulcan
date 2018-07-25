<?php
    require_once ("Sessao.php");
    $sessao = Sessao::getInstance();
    $autenticacao = $sessao->recuperar("AUTENTICACAO");
    if(empty($autenticacao)){
 	   require_once ("IncludeMenuAutenticacao.php");	
    }
