<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link rel="stylesheet" href="style/style.css">
    <title>Login no sistema</title>
  </head>
  <body style="background-image: url('imgs/loginbg.jpg');">
    <div class="tela">
      <form action="control/control.php" method="post">
        <div>
          <input type="text" name="login" placeholder="Nome de usuário" required autofocus pattern="^[a-z]{2,15}$">
        </div>
        <div>
          <input type="password" name="pass" placeholder="Senha" required pattern="^[A-z0-9]{4,20}$">
        </div>
        <div>
          <input id="loginbtn" type="submit" value="Login">
          <input id="clearbtn" type="reset" value="Limpar">
        </div>
      </form>
    </div>
  </body>
</html>
