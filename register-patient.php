<?php
  ob_start();
  include 'model/patient.class.php';
  include 'dao/patientdao.class.php';
  $pdao = new PatientDAO();

  if (isset($_GET['id'])) {
    $array = $pdao->filter($_GET['id'], 'code');
    $pat = $array[0];
    $name = explode(" ", $pat->fullName);
    $date = explode("/", $pat->birthDate);
  }
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link rel="stylesheet" href="style/style.css">
    <title>Cadastrar Aluno</title>
  </head>
  <body>
    <input type="checkbox" id="btnmenu">
    <label for="btnmenu">&#9776;</label>
    <nav class="menu">
      <ul>
        <li><a href="home.php">Início</a></li>
        <li><a href="#">Dentista</a>
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
      <form name="restu" method="post">
        <h1>Cadastrar novo Paciente</h1>
        <div>
          <input value="<?php if(isset($pat)){echo $name[0];}?>" type="text" name="fname" placeholder="Nome do paciente" required autofocus pattern="^[A-zÁ-ü ]{2,20}$">
          <input value="<?php if(isset($pat)){echo $name[1];}?>" type="text" name="sname" placeholder="Sobrenome do paciente" required pattern="^[A-zÁ-ü ]{2,20}$">
        </div>
        <div>
          <label for="day"><b>Data de nascimento:</b></label>
          <select name="day" required>
            <?php
              for ($i = 1; $i <= 31; $i++) {
                if (isset($pat)) {
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
                if (isset($pat)) {
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
                if (isset($pat)) {
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
          <input value="<?php if (isset($pat)) {echo $pat->rg;} ?>" type="number" name="rg" placeholder="Digite o RG" required pattern="^[0-9]{7,15}$">
          <input value="<?php if (isset($pat)) {echo $pat->cpf;} ?>" type="number" name="cpf" min="0" placeholder="Digite o CPF" required pattern="^[0-9]{11}$">
        </div>
        <div>
          <input value="<?php if (isset($pat)) {echo $pat->phone;} ?>" type="text" name="phone" placeholder="Telefone" required pattern="^[0-9]{9,16}$">
        </div>
        <div>
          <input id="loginbtn" name="<?php if (isset($pat)) {echo "alter";} else {echo "register";} ?>" type="submit" value="<?php if (isset($pat)) {echo "Alterar";} else {echo "Cadastrar";} ?>">
          <input id="clearbtn" name="clear" type="reset" value="Limpar">
        </div>
      </form>
      <?php
        if (isset($_POST['register'])) {
          include 'util/patterns.class.php';
          include 'util/security.class.php';

          $p = new Patient();
          $p->fullName = Patterns::toUpperLower(Patterns::uniteName(Security::checkName($_POST['fname']), Security::checkName($_POST['sname'])));
          $p->birthDate = Security::checkDate($_POST['month'], $_POST['day'], $_POST['year']);
          $p->rg = Security::checkRG($_POST['rg']);
          $p->cpf = Security::checkCPF($_POST['cpf']);
          $p->phone = Security::checkPhone($_POST['phone']);

          $pdao->registerPatient($p);
          ob_end_flush();
        }

        if (isset($_POST['alter'])) {
          include 'util/patterns.class.php';
          include 'util/security.class.php';

          $p = new Patient();
          $p->idPatient = $_GET['id'];
          $p->fullName = Patterns::toUpperLower(Patterns::uniteName(Security::checkName($_POST['fname']), Security::checkName($_POST['sname'])));
          $p->birthDate = Security::checkDate($_POST['month'], $_POST['day'], $_POST['year']);
          $p->rg = Security::checkRG($_POST['rg']);
          $p->cpf = Security::checkCPF($_POST['cpf']);
          $p->phone = Security::checkPhone($_POST['phone']);

          $pdao->alterPatient($p);
          header("location:list-patient.php");
          ob_end_flush();
        }
      ?>
    </div>
  </body>
</html>
