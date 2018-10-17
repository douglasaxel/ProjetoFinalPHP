<?php
class Studant{
  private $idStudant;
  private $fullName;
  private $birthDate;
  private $rg;
  private $cpf;
  private $turn;
  private $grade;

  public function __construct(){}
  public function __destruct(){}
  public function __set($a, $v){$this->$a = $v;}
  public function __get($a){return $this->$a;}
  public function __toString(){
    return nl2br("Nome: $this->fullName
                  Data de Nascimento: $this->birthDate
                  RG: $this->rg
                  CPF: $this->cpf
                  Turno: $this->turn
                  Classe: $this->grade");
  }
}
