<?php
class Autenticacao{
    private $nome;
    private $hora;
    private $permissoes;

    public function Autenticacao($nome, $hora, $permissoes){
        $this->nome = $nome;
        $this->hora = $hora;
        $this->permissoes = $permissoes;
    }

    public function getNome(){
        return $this->nome;
    }
    public function getHora(){
        return $this->hora;
    }
    public function getPermissoes(){
        return $this->permissoes;
    }

}
?>