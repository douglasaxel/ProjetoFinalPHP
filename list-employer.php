<?php
session_start();
ob_start();

include_once 'dao/employerdao.class.php';
include_once 'model/employer.class.php';

$edao = new EmployerDAO();
$array = $edao->searchEmployer();
?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link rel="stylesheet" href="style/style.css">
    <title>Inicio</title>
  </head>
  <body style="background-image: url('imgs/loginbg.jpg');">
    <input type="checkbox" id="btnmenu">
    <label for="btnmenu">&#9776;</label>
    <nav class="menu">
      <ul>
        <li><a href="#">Funcionários</a>
          <ul>
            <li><a href="register-employer.php">Cadastrar</a></li>
            <li><a href="list-employer.php">Listar</a></li>
          </ul>
        </li>
        <li><a href="#">Alunos</a>
          <ul>
            <li><a href="register-studant.php">Cadastrar</a></li>
            <li><a href="list-studant.php">Listar</a></li>
          </ul>
        </li>
        <li><a href="#">Materiais</a>
          <ul>
            <li><a href="register-stuff.php">Cadastrar</a></li>
            <li><a href="list-stuff.php">Listar</a></li>
          </ul>
        </li>
      </ul>
      <ul>
        <li id="logout"><a href="">Logout</a></li>
      </ul>
    </nav>
    <div class="homescreen">
      <?php
        if(count($array) == 0){
          echo "<h2>Não há funcionários no banco!</h2>";
          return;
        }
      ?>
      <article>
        <center>
          <table align="center">
            <thead>
              <th>Nome</th>
              <th>Data de nascimento</th>
              <th>RG</th>
              <th>CPF</th>
              <th>Turno</th>
              <th>Excluir</th>
            </thead>
            <tbody>
              <?php
               foreach($array as $emp){
                 echo "<tr>";
                   echo "<td>$emp->fullName</td>";
                   echo "<td>$emp->birthDate</td>";
                   echo "<td>$emp->rg</td>";
                   echo "<td>$emp->cpf</td>";
                   echo "<td>$emp->turn</td>";
                   echo "<td><a href='list-employer.php?id=$emp->idEmployer' class='deletebtn'>Excluir</a></td>";
                 echo "</tr>";
               }
              ?>
            </tbody>
            <tfoot>
              <th>Nome</th>
              <th>Data de nascimento</th>
              <th>RG</th>
              <th>CPF</th>
              <th>Turno</th>
              <th>Excluir</th>
            </tfoot>
          </table>
        </center>
      </article>
    </div>
    <?php
      if (isset($_GET['id'])) {
        $edao->deleteEmployer($_GET['id']);
        header("location:list-employer.php");
        unset($_GET['id']);
      }
    ?>
  </body>
</html>
