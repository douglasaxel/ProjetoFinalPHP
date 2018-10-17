<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link rel="stylesheet" href="style/style.css">
    <title>Cadastrar Aluno</title>
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
      <form name="restu" method="post">
        <h1>Cadastrar novo Aluno</h1>
        <div>
          <input type="text" name="fname" placeholder="Nome do aluno" autofocus pattern="^[A-zÁ-ù ]{2-20}$">
          <input type="text" name="sname" placeholder="Sobrenome do aluno" pattern="^[A-zÁ-ù ]{2-20}$">
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
          <input type="number" name="cpf" placeholder="Digite o CPF" pattern="^[0-9]{11}$">
        </div>
        <div>
          <label for="turn"><b>Turno:</b></label>
          <select name="turn">
            <option value="manha">Manhã</option>
            <option value="tarde">Tarde</option>
            <option value="noite">Noite</option>
          </select>
          <label for="grade"><b>Ensino:</b></label>
          <select name="grade" style="width: 150px;">
            <option value="fundamental">Fundamental</option>
            <option value="medio">Médio</option>
          </select>
        </div>
        <div>
          <input id="loginbtn" name="register" type="submit" value="Cadastrar">
          <input id="clearbtn" name="clear" type="reset" value="Limpar">
        </div>
      </form>
      <?php
        if (isset($_POST['register'])) {
          include 'model/studant.class.php';
          include 'dao/studantdao.class.php';
          include 'util/patterns.class.php';
          include 'util/security.class.php';

          $s = new Studant();
          $s->fullName = $_POST['fname'];
          $s->birthDate = $_POST['day'];
          $s->rg = $_POST['rg'];
          $s->cpf = $_POST['cpf'];
          $s->turn = $_POST['turn'];
          $s->grade = $_POST['grade'];

          $sdao = new StudantDAO();
          $sdao->registerStudant($s);
        }
      ?>
    </div>
  </body>
</html>
