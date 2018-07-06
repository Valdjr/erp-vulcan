<?php

class ConnectionDB{
  var $user = "root";
  var $passoword = "";
  var $sid = "localhost";
  var $bank = "vulcan";
  var $consult = "";
  var $link = "";

  function connectionDB(){
    $this->connect();
  }

  function connect(){
    $this->link = mysqli_connect($this->sid,$this->user,$this->passoword, $this->bank);
    if (!$this->link)
    {
      die("Problema na Conexão com o banco de Dados");
    }
    elseif (!mysqli_select_db($this->link,$this->bank))
    {
      die("Problema na Conexão");
    }

  }

  function desconnect(){
    return mysqli_close($this->link);
  }

  function execute($consult){
    $this->consult = $consult;
    if ($resultado = mysqli_query($this->link,$this->consult)){
      if($resultado instanceof MySQLi_Result){
      	$resultados = [];
        while($obj = mysqli_fetch_array($resultado)){
          $resultados[] = $obj;
        }
      }
		  return $resultados;
    } else {
      return 0;
    }
  }

  function insert($insert) {
  	mysqli_query($this->link, $insert);
  }

}
