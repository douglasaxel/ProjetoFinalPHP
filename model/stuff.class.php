<?php
class Stuff{
  private $idStuff;
  private $name;
  private $vendor;
  private $qtd;
  private $type;

  public function __construct(){}
  public function __destruct(){}
  public function __set($a, $v){$this->$a = $v;}
  public function __get($a){return $this->$a;}
  public function __toString(){
    return nl2br("Nome: $this->name
                  Fornecedor: $this->vendor
                  Quantidade: $this->qtd
                  Tipo: $this->type");
  }
}
