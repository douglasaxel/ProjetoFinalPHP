<?php
  ob_start();
  include 'model/stuff.class.php';
  include 'dao/stuffdao.class.php';
  $sdao = new StuffDAO();

  if (isset($_GET['id'])) {
    $array = $sdao->filter($_GET['id'], 'code');
    $stu = $array[0];
    $date = explode("/", $stu->dueDate);
  }
?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link rel="stylesheet" href="style/style.css">
    <title>Cadastrar material</title>
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
        <li><a href="#">Paciente</a>
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
      <form name="restuff" method="post">
        <h1>Cadastrar novo Material</h1>
        <div>
          <input value="<?php if (isset($stu)) {echo $stu->name;} ?>" type="" name="name" placeholder="Nome do produto" required autofocus style="width: 50%;" pattern="^[A-zÁ-ù ]{2,50}$">
        </div>
        <div>
          <input value="<?php if (isset($stu)) {echo $stu->vendor;} ?>" type="text" name="vendor" placeholder="Fornecedor" required style="width: 50%;" pattern="^[A-zÁ-ù ]{2,50}$">
        </div>
        <div>
          <input value="<?php if (isset($stu)) {echo $stu->qtd;} ?>" type="number" min="0" name="qtd" placeholder="Quantidade" required style="width: 50%;" pattern="^[0-9]{0,5}$">
        </div>
        <div>
          <h4>Tipo</h4>
          <select name="type" style="width: 50%;" required>
            <option <?php if (isset($stu)) {if ($stu->type == 'Limpeza') {echo 'selected';}} ?> value="Limpeza">Limpeza</option>
            <option <?php if (isset($stu)) {if ($stu->type == 'Higiêne') {echo 'selected';}} ?> value="Higiêne">Higiêne</option>
            <option <?php if (isset($stu)) {if ($stu->type == 'Hospitalar') {echo 'selected';}} ?> value="Hospitalar">Hospitalar</option>
            <option <?php if (isset($stu)) {if ($stu->type == 'Estrutura') {echo 'selected';}} ?> value="Estrutura">Estrutura</option>
          </select>
        </div>
        <div>
          <label for="day"><b>Data de vencimento:</b></label>
          <select name="day" required>
            <?php
              for ($i = 1; $i <= 31; $i++) {
                if (isset($stu)) {
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
                if (isset($stu)) {
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
              for ($i = 2018; $i <= 3000; $i++) {
                if (isset($stu)) {
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
          <input id="loginbtn" name="<?php if (isset($stu)) {echo "alter";} else {echo "register";} ?>" type="submit" value="<?php if (isset($stu)) {echo "Alterar";} else {echo "Cadastrar";} ?>">
          <input id="clearbtn" name="clear" type="reset" value="Limpar">
        </div>
      </form>
      <?php
        if (isset($_POST['register'])) {
          include 'util/patterns.class.php';
          include 'util/security.class.php';

          $stuff = new Stuff();
          $stuff->name = Security::antiXSS(Patterns::toUpperLower(Security::checkStuffName($_POST['name'])));
          $stuff->vendor = Security::antiXSS(Patterns::toUpperLower(Security::checkVendor($_POST['vendor'])));
          $stuff->qtd = Security::antiXSS(Security::checkQTD($_POST['qtd']));
          $stuff->type = Security::antiXSS(Security::checkType($_POST['type']));
          $stuff->dueDate = Security::antiXSS(Security::checkDate($_POST['month'], $_POST['day'], $_POST['year']));

          $sdao->registerStuff($stuff);
        }

        if (isset($_POST['alter'])) {
          include 'util/patterns.class.php';
          include 'util/security.class.php';

          $stuff = new Stuff();
          $stuff->idStuff = $_GET['id'];
          $stuff->name = Security::antiXSS(Patterns::toUpperLower(Security::checkStuffName($_POST['name'])));
          $stuff->vendor = Security::antiXSS(Patterns::toUpperLower(Security::checkVendor($_POST['vendor'])));
          $stuff->qtd = Security::antiXSS(Security::checkQTD($_POST['qtd']));
          $stuff->type = Security::antiXSS(Security::checkType($_POST['type']));
          $stuff->dueDate = Security::antiXSS(Security::checkDate($_POST['month'], $_POST['day'], $_POST['year']));

          $sdao->alterStuff($stuff);
          header("location:list-stuff.php");
        }
      ?>
    </div>
  </body>
</html>
