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
       $stat=$this->conn->prepare("insert into stuff(idStuff,name,vendor,qtd,type) values(null,?,?,?,?)");
       $stat->bindValue(1, $stuff->name);
       $stat->bindValue(2, $stuff->vendor);
       $stat->bindValue(3, $stuff->qtd);
       $stat->bindValue(4, $stuff->type);
       $stat->bindValue(5, $stuff->dueDate);
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

   public function filter($search, $filter){
     try {
       $query = "";
       switch ($filter) {
         case 'all':
           $query = "";
           break;
         case 'code':
           $query = "where idStuff = {$search}";
           break;
           case "name":
           $query = "where name like '%{$search}%'";
           break;
         case 'vendor':
           $query = "where vendor like '%{$search}%'";
           break;
         case 'qtd':
           $query = "where qtd like '%".$search."%'";
           break;
         case 'type':
           $query = "where type like '%".$search."%'";
           break;
         case 'duedate':
           $query = "where type like '%".$search."%'";
           break;
       }
       $stat = $this->conn->query("select * from stuff {$query}");
       $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Stuff');
       return $array;
     } catch (PDOException $e) {
       echo "Erro ao filtrar materiais!";
     }
   }

   public function alterStuff($stuff){
     try {
       $stat=$this->conn->prepare("update stuff set name = ?, vendor = ?, qtd = ?, type = ?, dueDate = ? where idStuff = ?");
       $stat->bindValue(1, $stuff->name);
       $stat->bindValue(2, $stuff->vendor);
       $stat->bindValue(3, $stuff->qtd);
       $stat->bindValue(4, $stuff->type);
       $stat->bindValue(5, $stuff->dueDate);
       $stat->bindValue(6, $stuff->idStuff);
       $stat->execute();
     } catch(PDOException $e) {
       echo "Erro ao alterar! ".$e;
     }
   }//fecha metodo

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
