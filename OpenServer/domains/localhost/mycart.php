<?php
require 'db.php';
$userid=$_COOKIE['userid'];

$sumOfPrice=0;
if(!isset($userid)){
  header("Location: /login.php");
}else{
  if(isset($_GET['buy'])){
    mysqli_query($link, "DELETE FROM `orderscar` WHERE `User_ID`='$userid'");
    mysqli_query($link, "DELETE FROM `orderszap` WHERE `User_ID`='$userid'");
    echo '<p style="font-size:20pt; height:100%; text-align:center; margin-left:auto; background:black; color:yellow">Счастливого пути</p>';
    exit();
  }
}
if(isset($_POST["delorder"])){
  $or=$_POST["delorder"];
  mysqli_query($link,"DELETE FROM `orderscar` WHERE `Car_ID`='$or'");
}
if(isset($_POST["delorderz"])){
  $orz=$_POST["delorderz"];
  mysqli_query($link,"DELETE FROM `orderszap` WHERE `Zap_ID`='$orz'");
}
 ?>
<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap&subset=cyrillic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <title>Список покупок</title>
  </head>
  <body style="background-color:#171710d4">
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
  <div>
    <?php
    echo '<div style="width: 100%">';
    $q=mysqli_query($link,"SELECT * FROM `orderscar` WHERE `User_ID`='$userid'");
    $count_of_orders=mysqli_fetch_assoc(mysqli_query($link,"SELECT COUNT(`id`) as `a` FROM `orderscar` WHERE `User_ID`='$userid'"))['a'];
    while ($order = mysqli_fetch_assoc($q)) {
      $carid=$order['Car_ID'];
      $carname=mysqli_fetch_assoc(mysqli_query($link,"SELECT `model` from `cars` where `ID`=$carid"))['model'];
      $carmarka=mysqli_fetch_assoc(mysqli_query($link,"SELECT `marka` from `cars` where `ID`=$carid"))['marka'];
      $carimj=mysqli_fetch_assoc(mysqli_query($link,"SELECT `href_car_imj` from `cars` where `ID`=$carid"))['href_car_imj'];
      $carid=$order['Car_ID'];
      $sumOfPrice+=$order['price'];
      echo '<form method="POST" class="center" action="mycart.php" style="width: 30%; margin-top:5%; margin-left:35%"> <p class="text" style="width:100%; height:auto; color:rgb(217, 231, 12); margin-buttom:3%">' . $carname . '<br>'. $carmarka.'<br><img src="img/' . $carimj .'" width="100%" height="70%"> Цена:' . $order['price'] . ' </p><input type="hidden" name="delorder" value="'. $order['Car_ID'] .'"><input class="submit" style="width: 105%" type="submit" value="Удалить из корзины"></form></div>';
    }
    echo'</div>';

    $qz=mysqli_query($link,"SELECT * FROM `orderszap` WHERE `User_ID`='$userid'");
    $count_of_ordersz=mysqli_fetch_assoc(mysqli_query($link,"SELECT COUNT(`id`) as `a` FROM `orderszap` WHERE `User_ID`='$userid'"))['a'];
    while ($order = mysqli_fetch_assoc($qz)) {
      $zapid=$order['Zap_ID'];
      $zapname=mysqli_fetch_assoc(mysqli_query($link,"SELECT `Name` from `zapchasti` where `ID`=$zapid"))['Name'];
      $zapmarka=mysqli_fetch_assoc(mysqli_query($link,"SELECT `Proizv` from `zapchasti` where `ID`=$zapid"))['Proizv'];
      $zapimj=mysqli_fetch_assoc(mysqli_query($link,"SELECT `imjz` from `zapchasti` where `ID`=$zapid"))['imjz'];
      $zapid=$order['Zap_ID'];
      $sumOfPrice+=$order['price'];
      echo '<form method="POST" class="center" action="mycart.php" style="width: 30%; margin-top:5%; margin-left:35%"> <p class="text" style="width:100%; margin-bottom:10px; height:auto; color:rgb(217, 231, 12)">' . $zapname . '<br>'. $zapmarka.'<br><img src="img/' . $zapimj .'" width="100%" height="70%"> Цена:' . $order['price'] . ' </p><input type="hidden" name="delorderz" value="'. $order['Zap_ID'] .'"><input class="submit" type="submit" value="Удалить из корзины"></form>';

    }

    if(($count_of_orders==0)&($count_of_ordersz==0)){
      echo '<p style="color:yellou; margin-left:10%; font-size: 20pt; width:100%">Ваша корзина пуста, сначала добавьте в неё товары </p><br>';
    }else{
      echo '<div style="margin-left: -9%; margin-top: 5%"><button type="button" class="submit center" style="width:30%;" name="button"><a href="?buy=1" style="text-decoration:none; color:yellow; font-size:18pt">Приобрести все</a></button>';
      echo '<p class="center" style="margin-left:50%; color:rgb(217, 231, 12); font-size: 18pt;">Итого:' . $sumOfPrice . '</p></div>';
    }
     ?>
  </body>
</html>
