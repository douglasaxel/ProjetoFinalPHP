<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link rel="stylesheet" href="style/style.css">
    <title>Inicio</title>
    <style>
      a {
        text-decoration: none;
        color: #000;
      }

      a:hover {
        color: #3288fa;
      }

      li {
        font-size: 25px;
      }

      h1 {
        font-size: 35px;
        background-color: #3288fa;
        border-radius: 10px;
        color: #fff;
      }
    </style>
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
    </nav>
    <div class="homescreen">
      <h1>Sistema de gerenciamento de escola</h1>
      <ul>
        <li><a href="list-employer.php">Controle de Funcionários</a></li>
        <li><a href="list-studant.php">Controle de Alunos</a></li>
        <li><a href="list-stuff.php">Controle de Materiais</a></li>
      </ul>
    </div>
  </body>
</html>
