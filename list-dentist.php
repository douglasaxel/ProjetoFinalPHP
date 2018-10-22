<?php
session_start();
ob_start();

include_once 'dao/dentistdao.class.php';
include_once 'model/dentist.class.php';

$ddao = new DentistDAO();
$array = $ddao->searchDentist();
?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link rel="stylesheet" href="style/style.css">
    <title>Inicio</title>
  </head>
  <body>
    <input type="checkbox" id="btnmenu">
    <label for="btnmenu">&#9776;</label>
    <nav class="menu">
      <ul>
        <li><a href="home.php">Início</a></li>
        <li><a href="#">Dentistas</a>
          <ul>
            <li><a href="register-dentist.php">Cadastrar</a></li>
            <li><a href="list-dentist.php">Listar</a></li>
          </ul>
        </li>
        <li><a href="#">Pacientes</a>
          <ul>
            <li><a href="register-patient.php">Cadastrar</a></li>
            <li><a href="list-patient.php">Listar</a></li>
          </ul>
        </li>
        <li><a href="#">Materiais</a>
          <ul>
            <li><a href="register-stuff.php">Cadastrar</a></li>
            <li><a href="list-stuff.php">Listar</a></li>
          </ul>
        </li>
      </ul>
    </nav>
    <div class="homescreen">
      <?php
        if(count($array) == 0){
          echo "<h2>Não há Dentistas no banco!</h2>";
          return;
        }
      ?>
      <form action="" method="post" action="">
        <input type="text" name="search" placeholder="Pesquise aqui" value="<?php if (isset($_POST['filter'])) {echo $_POST['search'];} ?>">
        <select name="filterer" style="width: auto;">
          <option <?php if (isset($_POST['filter'])) {if ($_POST['filterer'] == 'all') {echo 'selected';}} ?> value="all">Todos</option>
          <option <?php if (isset($_POST['filter'])) {if ($_POST['filterer'] == 'name') {echo 'selected';}} ?> value="name">Nome</option>
          <option <?php if (isset($_POST['filter'])) {if ($_POST['filterer'] == 'birth') {echo 'selected';}} ?> value="birth">Data de nascimento</option>
          <option <?php if (isset($_POST['filter'])) {if ($_POST['filterer'] == 'rg') {echo 'selected';}} ?> value="rg">RG</option>
          <option <?php if (isset($_POST['filter'])) {if ($_POST['filterer'] == 'cpf') {echo 'selected';}} ?> value="cpf">CPF</option>
          <option <?php if (isset($_POST['filter'])) {if ($_POST['filterer'] == 'turn') {echo 'selected';}} ?> value="turn">Turno</option>
          <option <?php if (isset($_POST['filter'])) {if ($_POST['filterer'] == 'cro') {echo 'selected';}} ?> value="cro">CRO</option>
        </select>
        <input type="submit" name="filter" value="Filtrar">
      </form>
      <?php
        if(isset($_POST['filter'])){
          $filterer = $_POST['filterer'];
          $search = $_POST['search'];

          if (!empty($search)) {
            $array = $ddao->filter($search, $filterer);

            if(count($array) == 0){
              echo "<h3>Sua pesquisa retornou nada!</h3>";
              return;
            }
          } else {
            echo "Digite uma pesquisa!";
          }
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
              <th>CRO</th>
              <th>Alterar</th>
              <th>Excluir</th>
            </thead>
            <tbody>
              <?php
               foreach($array as $dent){
                 echo "<tr>";
                   echo "<td>$dent->fullName</td>";
                   echo "<td>$dent->birthDate</td>";
                   echo "<td>$dent->rg</td>";
                   echo "<td>$dent->cpf</td>";
                   echo "<td>$dent->turn</td>";
                   echo "<td>$dent->cro</td>";
                   echo "<td><a href='register-dentist.php?id=$dent->idDentist' id='alterbtn'>Alterar</a></td>";
                   echo "<td><a href='list-dentist.php?id=$dent->idDentist' class='deletebtn'>Excluir</a></td>";
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
              <th>CRO</th>
              <th>Alterar</th>
              <th>Excluir</th>
            </tfoot>
          </table>
        </center>
      </article>
    </div>
    <?php
      if (isset($_GET['id'])) {
        $ddao->deleteDentist($_GET['id']);
        header("location:list-dentist.php");
        unset($_GET['id']);
        ob_end_flush();
      }
    ?>
  </body>
</html>
