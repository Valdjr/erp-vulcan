<?php 

require_once("./Sessao.php");

Sessao::getInstance()->encerrar();

header("Location: ./index.php");

?>