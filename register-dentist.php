<?php
  ob_start();
  include 'model/dentist.class.php';
  include 'dao/dentistdao.class.php';
  $ddao = new DentistDAO();

  if (isset($_GET['id'])) {
    $array = $ddao->filter($_GET['id'], 'code');
    $dent = $array[0];
    $name = explode(" ", $dent->fullName);
    $date = explode("/", $dent->birthDate);
  }
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
            <li><a href="register-Patient.php">Cadastrar</a></li>
            <li><a href="list-Patient.php">Listar</a></li>
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
      <form name="reemp" method="post">
        <h1>Cadastrar novo Dentista</h1>
        <div>
          <input value="<?php if(isset($dent)){echo $name[0];}?>" type="text" name="fname" placeholder="Nome do dentista" required autofocus pattern="^[A-zÁ-ü ]{2,20}$">
          <input value="<?php if(isset($dent)){echo $name[1];}?>" type="text" name="sname" placeholder="Sobrenome do dentista" required pattern="^[A-zÁ-ü ]{2,20}$">
        </div>
        <div>
          <label for="day"><b>Data de nascimento:</b></label>
          <select name="day" required>
            <?php
              for ($i = 1; $i <= 31; $i++) {
                if (isset($dent)) {
                  if ($date[0] == $i) {
                    echo "<option selected value='$i'>$i</option>";
                    continue;
                  }
                }
                echo "<option value='$i'>$i</option>";
              }
            ?>
          </select>
          <select name="month" required>
            <?php
              for ($i = 1; $i <= 12; $i++) {
                if (isset($dent)) {
                  if ($date[1] == $i) {
                    echo "<option selected value='$i'>$i</option>";
                    continue;
                  }
                }
                echo "<option value='$i'>$i</option>";
              }
            ?>
          </select>
          <select name="year" required>
            <?php
              for ($i = 2018; $i >= 1850; $i--) {
                if (isset($dent)) {
                  if ($date[2] == $i) {
                    echo "<option selected value='$i'>$i</option>";
                    continue;
                  }
                }
                echo "<option value='$i'>$i</option>";
              }
            ?>
          </select>
        </div>
        <div>
          <input value="<?php if (isset($dent)) {echo $dent->rg;} ?>" type="number" name="rg" placeholder="Digite o RG" required pattern="^[0-9]{7,15}$">
          <input value="<?php if (isset($dent)) {echo $dent->cro;} ?>" type="number" name="cro" min="0" placeholder="Digite o CRO" required pattern="^[0-9]{5,20}$">
        </div>
        <div>
        <input value="<?php if (isset($dent)) {echo $dent->cpf;} ?>" type="number" name="cpf" placeholder="Digite o CPF" required pattern="^[0-9]{11}$">
        <label for="day"><b>Turno:</b></label>
        <select name="turn" required>
          <option value="Manhã" <?php if (isset($dent)) {if($dent->turn == "Manhã") {echo "selected";}} ?>>Manhã</option>
          <option value="Tarde" <?php if (isset($dent)) {if($dent->turn == "Tarde") {echo "selected";}} ?>>Tarde</option>
        </select>
        </div>
        <div>
          <input id="loginbtn" name="<?php if (isset($dent)) {echo "alter";} else {echo "register";} ?>" type="submit" value="<?php if (isset($dent)) {echo "Alterar";} else {echo "Cadastrar";} ?>">
          <input id="clearbtn" name="clear" type="reset" value="Limpar">
        </div>
      </form>
      <?php
        if (isset($_POST['register'])) {
          include 'util/patterns.class.php';
          include 'util/security.class.php';

          $d = new Dentist();
          $d->fullName = Patterns::toUpperLower(Patterns::uniteName(Security::checkName($_POST['fname']), Security::checkName($_POST['sname'])));
          $d->birthDate = Security::checkDate($_POST['month'], $_POST['day'], $_POST['year']);
          $d->rg = Security::checkRG($_POST['rg']);
          $d->cpf = Security::checkCPF($_POST['cpf']);
          $d->turn = Patterns::toUpperLower(Security::checkTurn($_POST['turn']));
          $d->cro = Security::checkCRO($_POST['cro']);

          $ddao->registerDentist($d);
          ob_end_flush();
        }

        if (isset($_POST['alter'])) {
          include 'util/patterns.class.php';
          include 'util/security.class.php';

          $d = new Dentist();
          $d->idDentist = $_GET['id'];
          $d->fullName = Patterns::toUpperLower(Patterns::uniteName(Security::checkName($_POST['fname']), Security::checkName($_POST['sname'])));
          $d->birthDate = Security::checkDate($_POST['month'], $_POST['day'], $_POST['year']);
          $d->rg = Security::checkRG($_POST['rg']);
          $d->cpf = Security::checkCPF($_POST['cpf']);
          $d->turn = Patterns::toUpperLower(Security::checkTurn($_POST['turn']));
          $d->cro = Security::checkCRO($_POST['cro']);

          $ddao->alterDentist($d);
          header("location:list-dentist.php");
          ob_end_flush();
        }
      ?>
    </div>
  </body>
</html>
