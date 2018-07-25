<?php
class Autenticacao{
    private $idEmpresa;

    public function Autenticacao($idEmpresa){
        $this->idEmpresa = $idEmpresa;
    }

    public function getIdEmpresa(){
        return $this->idEmpresa;
    }
}
