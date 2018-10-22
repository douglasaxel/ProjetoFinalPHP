<?php
require 'bdconnect.class.php';
 class PatientDAO {
   private $conn = null;

   public function __construct(){
     $this->conn = BDConnect::getInstance();
   }

   public function __destruct(){}

   public function registerPatient($patient){
     try{
       $stat=$this->conn->prepare("insert into patient(idPatient,fullName,birthDate,rg,cpf,phone) values(null,?,?,?,?,?)");
       $stat->bindValue(1, $patient->fullName);
       $stat->bindValue(2, $patient->birthDate);
       $stat->bindValue(3, $patient->rg);
       $stat->bindValue(4, $patient->cpf);
       $stat->bindValue(5, $patient->phone);
       $stat->execute();
     }catch(PDOException $e){
       echo "Erro ao cadastrar! ".$e;
     }//fecha catch
   }//fecha cadastrarLivro

   public function searchPatient(){
     try{
       $stat = $this->conn->query("select * from patient");
       $array = $stat->fetchAll(PDO::FETCH_CLASS, 'patient');
       return $array;
     }catch(PDOException $e){
       echo "Erro ao buscar pac! ".$e;
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
           $query = "where idPatient = {$search}";
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
         case 'phone':
           $query = "where turn like '%".$search."%'";
           break;
       }
       $stat = $this->conn->query("select * from patient {$query}");
       $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Patient');
       return $array;
     } catch (PDOException $e) {
       echo "Erro ao filtrar pacientes!";
     }
   }

   public function alterPatient($patient){
     try {
       $stat = $this->conn->prepare("update patient set fullName = ?, birthDate= ?, rg = ?, cpf = ?, phone = ? where idPatient = ?");
       $stat->bindValue(1, $patient->fullName);
       $stat->bindValue(2, $patient->birthDate);
       $stat->bindValue(3, $patient->rg);
       $stat->bindValue(4, $patient->cpf);
       $stat->bindValue(5, $patient->phone);
       $stat->bindValue(6, $patient->idPatient);
       $stat->execute();
     } catch(PDOException $e) {
       echo "Erro ao alterar! ".$e;
     }
   }//fecha metodo

   public function deletePatient($id){
     try {
       $stat = $this->conn->prepare("delete from patient where idpatient = ?");
       $stat->bindValue(1, $id);
       $stat->execute();
     } catch(PDOException $e) {
       echo "Erro ao deletar! ".$e;
     }
   }//fecha metodo
 }//fecha classe
