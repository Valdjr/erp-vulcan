<?php 
class Sessao{
    private static $instance;
    
    public static function getInstance():Sessao{

        if (!isset(self::$instance))
        {
            self::$instance = new Sessao();
            session_start();   
        }
        
        return self::$instance;
    }
    private function Sessao(){
    }
    public function salvar (string $chave, $conteudo){
     $json = serialize($conteudo);
     $_SESSION[$chave] = $json;
 }
 
 public function recuperar(string $chave){
    if (!$this->existe($chave)){
        return null;
    }

    $conteudo = unserialize($_SESSION[$chave]);

    return $conteudo;
}
public function existe(string $chave):bool{
    return isset($_SESSION[$chave]);
}

public function encerrar(){
    unset($_SESSION['AUTENTICACAO']);
}
}
?>