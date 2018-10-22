<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link rel="stylesheet" href="style/style.css">
    <title>Inicio</title>
    <style>
      div a {
        text-decoration: none;
        color: #000;
        font-size: 30px;
        margin: 10px 0;
      }

      div a:hover {
        color: #3288fa;
        font-size: 40px;
      }

      li {
        font-size: 25px;
        list-style: none;
      }

      h1 {
        font-size: 35px;
        background-color: #3288fa;
        border-radius: 10px;
        color: #fff;
      }
    </style>
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
      <h1>Sistema de gerenciamento clínica odontológica</h1>
      <ul>
        <li><a href="list-dentist.php">Lista de Dentistas</a></li>
        <li><a href="list-patient.php">Lista de Pacientes</a></li>
        <li><a href="list-stuff.php">Lista de Materiais</a></li>
      </ul>
    </div>
  </body>
</html>
