<?php
session_start();
ob_start();

include_once 'dao/patientdao.class.php';
include_once 'model/patient.class.php';

$pdao = new PatientDAO();
$array = $pdao->searchPatient();
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
          echo "<h2>Não há pacientes no banco!</h2>";
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
          <option <?php if (isset($_POST['filter'])) {if ($_POST['filterer'] == 'phone') {echo 'selected';}} ?> value="turn">Telefone</option>
        </select>
        <input type="submit" name="filter" value="Filtrar">
      </form>
      <?php
        if(isset($_POST['filter'])){
          $filterer = $_POST['filterer'];
          $search = $_POST['search'];

          if (!empty($search)) {
            $array = $pdao->filter($search, $filterer);

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
              <th>Telefone</th>
              <th>Alterar</th>
              <th>Excluir</th>
            </thead>
            <tbody>
            <?php
             foreach($array as $p){
               echo "<tr>";
                 echo "<td>$p->fullName</td>";
                 echo "<td>$p->birthDate</td>";
                 echo "<td>$p->rg</td>";
                 echo "<td>$p->cpf</td>";
                 echo "<td>$p->phone</td>";
                 echo "<td><a href='register-patient.php?id=$p->idPatient' id='alterbtn'>Alterar</a></td>";
                 echo "<td><a class='deletebtn' href='list-patient.php?id=$p->idPatient'>Excluir</a></td>";
               echo "</tr>";
             }
            ?>
            </tbody>
            <tfoot>
              <th>Nome</th>
              <th>Data de nascimento</th>
              <th>RG</th>
              <th>CPF</th>
              <th>Telefone</th>
              <th>Alterar</th>
              <th>Excluir</th>
            </tfoot>
          </table>
        </center>
      </article>
    </div>
    <?php
      if (isset($_GET['id'])) {
        $pdao->deletePatient($_GET['id']);
        header("location:list-patient.php");
        unset($_GET['id']);
      }
    ?>
  </body>
</html>
