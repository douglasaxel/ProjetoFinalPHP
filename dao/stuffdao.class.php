<?php
require 'bdconnect.class.php';
 class StuffDAO {
   private $conn = null;

   public function __construct(){
     $this->conn = BDConnect::getInstance();
   }

   public function __destruct(){}

   public function registerStuff($stuff){
     try{
       $stat=$this->conn->prepare("insert into stuff(idstuff,name,vendor,qtd,type) values(null,?,?,?,?)");
       $stat->bindValue(1, $stuff->name);
       $stat->bindValue(2, $stuff->vendor);
       $stat->bindValue(3, $stuff->qtd);
       $stat->bindValue(4, $stuff->type);
       $stat->execute();
     }catch(PDOException $e){
       echo "Erro ao cadastrar! ".$e;
     }//fecha catch
   }//fecha cadastrarLivro

   public function searchStuff(){
     try{
       $stat = $this->conn->query("select * from stuff");
       $array = $stat->fetchAll(PDO::FETCH_CLASS, 'stuff');
       return $array;
     }catch(PDOException $e){
       echo "Erro ao buscar Materiais! ".$e;
     }//catch
   }//fecha buscar

   public function deleteStuff($id){
     try {
       $stat = $this->conn->prepare("delete from stuff where idstuff = ?");
       $stat->bindValue(1, $id);
       $stat->execute();
     } catch(PDOException $e) {
       echo "Erro ao deletar! ".$e;
     }
   }//fecha metodo
 }//fecha classe
