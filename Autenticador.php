<?php
require_once("Autenticacao.php");
require_once("RepositorioDeUsuarios.php");
require_once("RetornoDaAutenticacao.php");
    class Autenticador{
        public function autenticar(string $idUsuario, string $senha):RetornoDaAutenticacao{
            $retorno = new RetornoDaAutenticacao();
            
            $rep = new RepositorioDeUsuarios();
            $usuario = $rep->buscarPorIdUsuario($idUsuario);
            if ($usuario == null)
            {
                $retorno->adicionarErro("Usuário não encontrado.");
                return $retorno;
            }
            
            if (!$usuario->validarSenha($senha))
            {
                $retorno->adicionarErro("Senha invália.");
                return $retorno;
            }

            $autenticacao = new Autenticacao($usuario->getNome(),date('d/m/Y H:i:s'), $usuario->getAcessos());
            $retorno->setAutenticacao($autenticacao);

            return $retorno;
        }
    }
?>