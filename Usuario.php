<?php
class Usuario{
    private $idUsuario;
    private $senha;
    private $idEmpresa;

    public function Usuario ($idUsuario, $senha, $idEmpresa){
        $this->senha = $senha;
        $this->idUsuario = $idUsuario;
        $this->idEmpresa = $idEmpresa;
    }

    public function getIdUsuario(){
        return $this->idUsuario;
    }

    public function validarSenha(string $senha):bool{
        return $this->senha == $senha;
    }

    public function getIdEmpresa(){
        return $this->idEmpresa;
    }
}
?>