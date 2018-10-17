<?php
require 'bdconnect.class.php';
 class StudantDAO {
   private $conn = null;

   public function __construct(){
     $this->conn = BDConnect::getInstance();
   }

   public function __destruct(){}

   public function registerStudant($studant){
     try{
       $stat=$this->conn->prepare("insert into studant(idStudant,fullName,birthDate,rg,cpf,turn,grade) values(null,?,?,?,?,?,?)");
       $stat->bindValue(1, $studant->fullName);
       $stat->bindValue(2, $studant->birthDate);
       $stat->bindValue(3, $studant->rg);
       $stat->bindValue(4, $studant->cpf);
       $stat->bindValue(5, $studant->turn);
       $stat->bindValue(6, $studant->grade);
       $stat->execute();
     }catch(PDOException $e){
       echo "Erro ao cadastrar! ".$e;
     }//fecha catch
   }//fecha cadastrarLivro

   public function searchStudant(){
     try{
       $stat = $this->conn->query("select * from studant");
       $array = $stat->fetchAll(PDO::FETCH_CLASS, 'studant');
       return $array;
     }catch(PDOException $e){
       echo "Erro ao buscar Estudantes! ".$e;
     }//catch
   }//fecha buscar

   public function deleteStudant($id){
     try {
       $stat = $this->conn->prepare("delete from studant where idstudant = ?");
       $stat->bindValue(1, $id);
       $stat->execute();
     } catch(PDOException $e) {
       echo "Erro ao deletar! ".$e;
     }
   }//fecha metodo
 }//fecha classe
