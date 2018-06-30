<?php
class RetornoDaAutenticacao{
    private $erros = [];
    private $temErros = false;
    private $autenticacao;
    
    public function setAutenticacao(Autenticacao $aut){
        $this->autenticacao = $aut;
    }
    public function getAutenticacao(){
        return $this->autenticacao;
    }

    public function getTemErros(){
        return $this->temErros;
    }

    public function adicionarErro(string $mensagem){
        $this->erros[] = $mensagem;
        $this->temErros = true;
    }
    public function getErros():array{
        return $this->erros;
    }
}
?>