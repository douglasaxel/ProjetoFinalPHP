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
      <form name="reemp" method="post">
        <h1>Cadastrar novo Funcionário</h1>
        <div>
          <input type="text" name="fname" placeholder="Nome do funcionário" autofocus pattern="^[A-zÁ-ù ]{2-20}$">
          <input type="text" name="sname" placeholder="Sobrenome do funcionário" pattern="^[A-zÁ-ù ]{2-20}$">
        </div>
        <div>
          <label for="day"><b>Data de nascimento:</b></label>
          <select name="day">
            <?php
              for ($i = 1; $i <= 31; $i++) {
                echo "<option value='$i'>$i</option>";
              }
            ?>
          </select>
          <select name="month">
            <?php
              for ($i = 1; $i <= 12; $i++) {
                echo "<option value='$i'>$i</option>";
              }
            ?>
          </select>
          <select name="year">
            <?php
              for ($i = 2018; $i >= 1850; $i--) {
                echo "<option value='$i'>$i</option>";
              }
            ?>
          </select>
        </div>
        <div>
          <input type="number" name="rg" placeholder="Digite o RG" pattern="^[0-9]{7-15}$">
        </div>
        <div>
        <input type="number" name="cpf" placeholder="Digite o CPF" pattern="^[0-9]{11}$">
        <label for="day"><b>Turno:</b></label>
        <select name="turn">
          <option value="manha">Manhã</option>
          <option value="tarde">Tarde</option>
          <option value="noite">Noite</option>
        </select>
        </div>
        <div>
          <input type="text" name="login" placeholder="Login deste funcionário" pattern="^[a-z]{2,15}$">
          <input type="password" name="pass" placeholder="Senha deste funcionário" pattern="^[A-z0-9]{4,20}$">
        </div>
        <div>
          <input id="loginbtn" name="register" type="submit" value="Cadastrar">
          <input id="clearbtn" name="clear" type="reset" value="Limpar">
        </div>
      </form>
      <?php
        if (isset($_POST['register'])) {
          include 'model/employer.class.php';
          include 'dao/employerdao.class.php';
          include 'util/patterns.class.php';
          include 'util/security.class.php';

          $emp = new Employer();
          $emp->fullName = $_POST['fname'].$_POST['sname'];
          $emp->birthDate = $_POST['month'].$_POST['day'].$_POST['year'];
          $emp->rg = $_POST['rg'];
          $emp->cpf = $_POST['cpf'];
          $emp->turn = $_POST['turn'];
          $emp->login = $_POST['login'];
          $emp->pass = $_POST['pass'];

          $empDAO = new EmployerDAO();
          $empDAO->registerEmployer($emp);
        }
      ?>
    </div>
  </body>
</html>
