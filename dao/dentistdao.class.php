<?php
require 'bdconnect.class.php';
 class DentistDAO {
   private $conn = null;

   public function __construct(){
     $this->conn = BDConnect::getInstance();
   }

   public function __destruct(){}

   public function registerDentist($dentist){
     try{
       $stat=$this->conn->prepare("insert into dentist(iddentist,fullname,birthdate,rg,cpf,turn,cro,login,pass) values(null,?,?,?,?,?,?,?,?)");
       $stat->bindValue(1, $dentist->fullName);
       $stat->bindValue(2, $dentist->birthDate);
       $stat->bindValue(3, $dentist->rg);
       $stat->bindValue(4, $dentist->cpf);
       $stat->bindValue(5, $dentist->turn);
       $stat->bindValue(6, $dentist->cro);
       $stat->bindValue(7, $dentist->login);
       $stat->bindValue(8, $dentist->pass);
       $stat->execute();
     }catch(PDOException $e){
       echo "Erro ao cadastrar o dentista! ".$e;
     }//fecha catch
   }//fecha cadastrarLivro

   public function searchDentist(){
     try{
       $stat = $this->conn->query("select * from dentist");
       $array = $stat->fetchAll(PDO::FETCH_CLASS, 'dentist');
       return $array;
     }catch(PDOException $e){
       echo "Erro ao buscar dentista! ".$e;
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
           $query = "where idDentist = {$search}";
           break;
           case "name":
           $query = "where fullName like '%{$search}%'";
           break;
         case 'birth':
           $query = "where birthDate like '%{$search}%'";
           break;
         case 'rg':
           $query = "where rg like '%".$search."%'";
           break;
         case 'cpf':
           $query = "where cpf like '%".$search."%'";
           break;
         case 'turn':
           $query = "where turn like '%".$search."%'";
           break;
         case 'cro':
           $query = "where cro like '%".$search."%'";
           break;
       }
       $stat = $this->conn->query("select * from dentist {$query}");
       $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Dentist');
       return $array;
     } catch (PDOException $e) {
       echo "Erro ao filtrar dentistas!";
     }
   }

   public function alterDentist($dentist){
     try {
       $stat = $this->conn->prepare("update dentist set fullname = ?, birthdate= ?, rg = ?, cpf = ?, turn = ?, cro = ?, login = ?, pass = ? where idDentist = ?");
       $stat->bindValue(1, $dentist->fullName);
       $stat->bindValue(2, $dentist->birthDate);
       $stat->bindValue(3, $dentist->rg);
       $stat->bindValue(4, $dentist->cpf);
       $stat->bindValue(5, $dentist->turn);
       $stat->bindValue(6, $dentist->cro);
       $stat->bindValue(7, $dentist->login);
       $stat->bindValue(8, $dentist->pass);
       $stat->bindValue(9, $dentist->idDentist);
       $stat->execute();
     } catch(PDOException $e) {
       echo "Erro ao alterar! ".$e;
     }
   }//fecha metodo

   public function deleteDentist($id){
     try {
       $stat = $this->conn->prepare("delete from dentist where iddentist = ?");
       $stat->bindValue(1, $id);
       $stat->execute();
     } catch(PDOException $e) {
       echo "Erro ao deletar! ".$e;
     }
   }//fecha metodo
 }//fecha classe
