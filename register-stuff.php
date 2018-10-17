<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link rel="stylesheet" href="style/style.css">
    <title>Cadastrar material</title>
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
      <form name="restuff" method="post">
        <h1>Cadastrar novo Material</h1>
        <div>
          <input type="text" name="name" placeholder="Nome do produto" autofocus pattern="^[A-zÁ-ù ]{2-50}$" style="width: 50%;">
        </div>
        <div>
          <input type="text" name="vendor" placeholder="Fornecedor" pattern="^[A-zÁ-ù ]{2-50}$" style="width: 50%;">
        </div>
        <div>
          <input type="number" name="qtd" placeholder="Quantidade" pattern="^[0-9]{0-5}$" style="width: 50%;">
        </div>
        <div>
          <h4>Tipo</h4>
          <select name="type" style="width: 50%;">
            <option value="limpeza">Limpeza</option>
            <option value="higiene">Higiêne</option>
            <option value="alimento">Alimento</option>
            <option value="estrutura">Estrutura</option>
          </select>
        </div>
        <div>
          <input id="loginbtn" name="register" type="submit" value="Cadastrar">
          <input id="clearbtn" name="clear" type="reset" value="Limpar">
        </div>
      </form>
      <?php
        if (isset($_POST['register'])) {
          include 'model/stuff.class.php';
          include 'dao/stuffdao.class.php';
          include 'util/patterns.class.php';
          include 'util/security.class.php';

          $stuff = new Stuff();
          $stuff->name = $_POST['name'];
          $stuff->vendor = $_POST['vendor'];
          $stuff->qtd = $_POST['qtd'];
          $stuff->type = $_POST['type'];

          $stuffDAO = new StuffDAO();
          $stuffDAO->registerStuff($stuff);
        }
      ?>
    </div>
  </body>
</html>
