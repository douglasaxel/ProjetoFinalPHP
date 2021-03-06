<?php
session_start();
ob_start();

include_once 'dao/stuffdao.class.php';
include_once 'model/stuff.class.php';

$stuffDAO = new StuffDAO();
$array = $stuffDAO->searchStuff();
//var_dump($array);
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
          echo "<h2>Não há materiais no banco!</h2>";
          die();
        }
      ?>
      <form action="" method="post" action="">
        <input type="text" name="search" placeholder="Pesquise aqui" value="<?php if (isset($_POST['filter'])) {echo $_POST['search'];} ?>">
        <select name="filterer" style="width: auto;">
          <option <?php if (isset($_POST['filter'])) {if ($_POST['filterer'] == 'all') {echo 'selected';}} ?> value="all">Todos</option>
          <option <?php if (isset($_POST['filter'])) {if ($_POST['filterer'] == 'name') {echo 'selected';}} ?> value="name">Nome</option>
          <option <?php if (isset($_POST['filter'])) {if ($_POST['filterer'] == 'vendor') {echo 'selected';}} ?> value="birth">Fornecedor</option>
          <option <?php if (isset($_POST['filter'])) {if ($_POST['filterer'] == 'qtd') {echo 'selected';}} ?> value="rg">Quantidade</option>
          <option <?php if (isset($_POST['filter'])) {if ($_POST['filterer'] == 'type') {echo 'selected';}} ?> value="cpf">Tipo</option>
          <option <?php if (isset($_POST['filter'])) {if ($_POST['filterer'] == 'duedate') {echo 'selected';}} ?> value="duedate">Data de vencimento</option>
        </select>
        <input type="submit" name="filter" value="Filtrar">
      </form>
      <?php
        if(isset($_POST['filter'])){
          $filterer = $_POST['filterer'];
          $search = $_POST['search'];

          if (!empty($search)) {
            $array = $stuffDAO->filter($search, $filterer);

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
              <th>Fornecedor</th>
              <th>Quantidade</th>
              <th>Tipo</th>
              <th>Data de vencimento</th>
              <th>Alterar</th>
              <th>Excluir</th>
            </thead>
            <tbody>
            <?php
             foreach($array as $stuff){
               echo "<tr>";
                 echo "<td>$stuff->name</td>";
                 echo "<td>$stuff->vendor</td>";
                 echo "<td>$stuff->qtd</td>";
                 echo "<td>$stuff->type</td>";
                 echo "<td>$stuff->dueDate</td>";
                 echo "<td><a href='register-stuff.php?id=$stuff->idStuff' id='alterbtn'>Alterar</a></td>";
                 echo "<td><a href='list-stuff.php?id=$stuff->idStuff' class='deletebtn'>Excluir</a></td>";
               echo "</tr>";
             }
            ?>
            </tbody>
            <tfoot>
              <th>Nome</th>
              <th>Fornecedor</th>
              <th>Quantidade</th>
              <th>Tipo</th>
              <th>Data de vencimento</th>
              <th>Alterar</th>
              <th>Excluir</th>
            </tfoot>
          </table>
        </center>
      </article>
    </div>
    <?php
      if (isset($_GET['id'])) {
        $stuffDAO->deleteStuff($_GET['id']);
        header("location:list-stuff.php");
        unset($_GET['id']);
      }
    ?>
  </body>
</html>
