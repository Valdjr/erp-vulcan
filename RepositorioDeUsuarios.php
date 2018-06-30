<?php 
require_once("Sessao.php");
require_once("Usuario.php");

class RepositorioDeUsuarios{
    private $usuarios;

    public function RepositorioDeUsuarios()
    {
        $this->carregarVetor();
    }

    private function carregarVetor()
    {
        $sessao = Sessao::getInstance();

        if ($sessao->existe("VETOR_USUARIOS_PARA_TESTES"))
        {
            $this->usuarios = $sessao->recuperar("VETOR_USUARIOS_PARA_TESTES");
        }
        else{
            $this->usuarios = array();
            $user = new Usuario("Administrador", "admin", "admin", "1111111");
            $this->usuarios[] = $user;
        }
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
            if ($usuario->getIdUsuario() == $idUsuario)
            {
                return $usuario;
            }
        }
        return null;
    }
}
?>