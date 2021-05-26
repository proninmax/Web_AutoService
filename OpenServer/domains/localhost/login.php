<?php require 'db.php';
  if((isset($_POST['email']))&&(isset($_POST['pass']))){
    $email=filter_var(trim($_POST['email']),FILTER_SANITIZE_STRING);
    $pass=filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING);
    $pass = md5("gg".$pass."wp");
    $query = mysqli_query($link,"SELECT * FROM `users` WHERE `email`='$email' AND `pass`='$pass'");
    $user = mysqli_fetch_assoc($query);
    if(count($user)==0){
      echo 'Такой пользователь не найден! <a href="">Вернуться</>';
      exit();
    }
    setcookie('userid',$user['id'],time()+3600,"/");
    setcookie('username',$user['name'],time()+3600,"/");
    header('Location: /');
  }
?>
<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Вход</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap&subset=cyrillic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
  </head>
  <body style="background-color:#1f2218">
      <div class="header">
        <div class="inner-header">
          <div class="logo">
          <a href="/" style="color:white;"><img class="logoimg" src="logo.png"></a>
          </div>
          <div class="auth">
            <?php
              if(isset($_COOKIE['username'])){
                echo '<p style="color:white; font-size:15px; font-family: Montserrat, sans-serif;">'.$_COOKIE['username'].'</p><p><a href="logout.php">Выход</a></p>';
              }else{
                echo '<p><a href="login.php">Вход</a></p><p><a href="registration.php">Регистрация</a></p>';
              }
             ?>

          </div>
        </div>
      </div>
      <form class="center" action="login.php" method="post">

         <p class="text" style="height:20px; color:rgb(217, 231, 12)">E-mail:</p> <input class="input" type="email" name="email"><br>
        <p class="text" style="height:20px;  color:rgb(217, 231, 12)">Пароль:</p> <input class="input" type="password" name="pass"><br>
        <input class="submit" type="submit" value="Войти">
      </form>
    </div>
  </body>
</html>
