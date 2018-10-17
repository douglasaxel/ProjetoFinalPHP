<?php
session_start();
ob_start();

include_once 'dao/studantdao.class.php';
include_once 'model/studant.class.php';

$stuDAO = new StudantDAO();
$array = $stuDAO->searchStudant();
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
          echo "<h2>Não há estudantes no banco!</h2>";
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
              <th>Ensino</th>
              <th>Excluir</th>
            </thead>
            <tbody>
            <?php
             foreach($array as $studant){
               echo "<tr>";
                 echo "<td>$studant->fullName</td>";
                 echo "<td>$studant->birthDate</td>";
                 echo "<td>$studant->rg</td>";
                 echo "<td>$studant->cpf</td>";
                 echo "<td>$studant->turn</td>";
                 echo "<td>$studant->grade</td>";
                 echo "<td><a class='deletebtn' href='list-studant.php?id=$studant->idStudant'>Excluir</a></td>";
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
              <th>Ensino</th>
              <th>Excluir</th>
            </tfoot>
          </table>
        </center>
      </article>
    </div>
    <?php
      if (isset($_GET['id'])) {
        $stuDAO->deleteStudant($_GET['id']);
        header("location:list-studant.php");
        unset($_GET['id']);
      }
    ?>
  </body>
</html>
