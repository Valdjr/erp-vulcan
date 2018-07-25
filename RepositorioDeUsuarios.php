<?php 
require_once("Sessao.php");
require_once("Usuario.php");
require_once("Conexao.php");

class RepositorioDeUsuarios{
    private $usuarios;

    public function RepositorioDeUsuarios()
    {
        $this->carregarVetor();
    }

    private function carregarVetor()
    {
        $con = new ConnectionDB();
        $result = $con->execute("SELECT * from usuario;");
        $this->usuarios = $result;
        $con->desconnect();
    }
    private function salvarAlteracoesDoVetor()
    {
        Sessao::getInstance()->salvar("VETOR_USUARIOS_PARA_TESTES",$this->usuarios);
    }

    public function adicionar(Usuario $usuario)
    {
        $this->usuarios[] = $usuario;
        $this->salvarAlteracoesDoVetor();
    }
    public function atualizar(Usuario $usuario)
    {
        # code...
    }
    public function remover( Usuario $usuario)
    {
        # code...
    }
    public function buscarTodos():Array
    {
        return $this->usuarios;
    }
    public function buscarPorIdUsuario($idUsuario)
    {
        foreach ($this->usuarios as $usuario) {
            if ($usuario['usuario'] == $idUsuario)
            {   
                $user = $this->parseToUsuario($usuario['usuario'],
                    $usuario['senha'],$usuario['idEmpresa']);
                return $user;
            }
        }
        return null;
    }

    public function parseToUsuario($idUsario,$senha,$idEmpresa){
        $user = new Usuario($idUsario,$senha,$idEmpresa);
        return $user;
    }
}
