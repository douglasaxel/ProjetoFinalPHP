<?php
require 'bdconnect.class.php';
 class EmployerDAO {
   private $conn = null;

   public function __construct(){
     $this->conn = BDConnect::getInstance();
   }

   public function __destruct(){}

   public function registerEmployer($employer){
     try{
       $stat=$this->conn->prepare("insert into employer(idemployer,fullname,birthdate,rg,cpf,turn,login,pass) values(null,?,?,?,?,?,?,?)");
       $stat->bindValue(1, $employer->fullName);
       $stat->bindValue(2, $employer->birthDate);
       $stat->bindValue(3, $employer->rg);
       $stat->bindValue(4, $employer->cpf);
       $stat->bindValue(5, $employer->turn);
       $stat->bindValue(6, $employer->login);
       $stat->bindValue(7, $employer->pass);
       $stat->execute();
     }catch(PDOException $e){
       echo "Erro ao cadastrar! ".$e;
     }//fecha catch
   }//fecha cadastrarLivro

   public function searchEmployer(){
     try{
       $stat = $this->conn->query("select * from employer");
       $array = $stat->fetchAll(PDO::FETCH_CLASS, 'employer');
       return $array;
     }catch(PDOException $e){
       echo "Erro ao buscar Funcionários! ".$e;
     }//catch
   }//fecha buscar

   public function deleteEmployer($id){
     try {
       $stat = $this->conn->prepare("delete from employer where idemployer = ?");
       $stat->bindValue(1, $id);
       $stat->execute();
     } catch(PDOException $e) {
       echo "Erro ao deletar! ".$e;
     }
   }//fecha metodo
 }//fecha classe
