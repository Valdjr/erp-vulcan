<?php
class Usuario{
    private $nome;
    private $idUsuario;
    private $senha;
    private $acessos;

    public function Usuario ($nome, $idUsuario, $senha, $acessos){
        $this->nome = $nome;
        $this->senha = $senha;
        $this->idUsuario = $idUsuario;
        $this->acessos = $acessos;
    }

    public function getNome(){
        return $this->nome;
    }
    public function getIdUsuario(){
        return $this->idUsuario;
    }

    public function validarSenha(string $senha):bool{
        return $this->senha == $senha;
    }

    public function getAcessos(){
        return $this->acessos;
    }
}
?>