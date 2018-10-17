<?php
class BDConnect extends PDO {
  private static $instance = null;

  public function __construct($dsn, $user, $pass){
    parent::__construct($dsn, $user, $pass);
  }

  public static function getInstance(){
    try{
        if(!isset(self::$instance)){
          self::$instance = new
          BDConnect("mysql:dbname=school;host=localhost","root","");
        }
        return self::$instance;
    }catch(PDOException $e){
        echo "Erro ao conectar no banco! ".$e;
    }//fecha catch
  }//fecha getInstance
}//fecha classe
