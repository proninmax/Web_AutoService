<?php
require 'db.php';
$userid=$_COOKIE["userid"];
if(!isset($userid)) $userid=-1;
$q=mysqli_query($link,"SELECT * FROM `users` WHERE `id`='$userid' AND `isAdmin`='1'");
$user=mysqli_fetch_assoc($q);
if(count($user)==0):
  header("Location: /");
else:?>
<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap&subset=cyrillic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <title>Панель администратора</title>
  </head>
  <body>
    <div class="wrapper">
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
    <div style="float:left; padding-left: 140px; ">
      <p>Добавление автомобиля:</p>
      <form action="admin.php" method="post">
        <p>Марка</p><input type="text" name="marca">
        <p>Модель</p><input type="text" name="model">
        <p>Год выпуска:</p><input type="number" name="year" value="2010">
        <p>Цена:</p><input type="number" name="price">
        <p>Новая или бу</p>
        <select name="new">
          <option value="1">Новая</option>
          <option value="2">б.у.</option>
        </select>
        <p>Номер изображения</p><input type="text" name="img">
        <br>
        <br>
        <input type="submit" value="Внести авто в базу">
      </form>
      <form action="admin.php" method="post" enctype="multipart/form-data">
        <p>Изображение авто:</p>
        <input type="file" name="up load">
        <button>Загрузить</button>
      </form>
      <?php
        $filePath  = $_FILES['upload']['tmp_name'];
        if(isset($filePath)){
          if (!move_uploaded_file($filePath, __DIR__ . '/img/' . $_FILES['upload']['name'])) {
            die('При записи изображения на диск произошла ошибка.');
          }
        }
      ?>
    </div>
    <?php
      if (isset($_POST["marca"])) {
        $marca=$_POST['marca'];
        $model=$_POST['model'];
        $year=$_POST['year'];
        $price=$_POST['price'];
        $new= $_POST['new'];
        $image=$_POST['img'];
        mysqli_query($link,"INSERT INTO `cars` VALUES(NULL,'$marca','$model','$year','$price','$new','$image')");
        echo mysqli_error($link);
      }
     ?>


      <div style="float:left; padding-left: 40px; ">
      <p>Добавление запчасти:</p>
      <form action="admin.php" method="post">
        <p>Наименование:</p><input type="text" name="name_z">
        <p>Производитель:</p><input type="text" name="proizv">
        <p>Для марки:</p><input type="text" name="marca_z">
        <p>Для модели:</p><input type="text" name="model_z">
        <br>
        <p>Для отечественных/иномарок</p>
        <select name="for_z">
          <option value="1">Отечественные</option>
          <option value="2">Иномарки</option>
        </select>
        <p>Цена</p><input type="number" name="price_z">
        <p>Номер изображения</p><input type="text" name="img_z">
        <br>
        <br>
        <input type="submit" value="Внести запчасть в базу">
      </form>
      <form action="admin.php" method="post" enctype="multipart/form-data">
        <p>Изображение запчасти:</p>
        <input type="file" name="upload">
        <button>Загрузить</button>
      </form>
      <?php
        $filePath  = $_FILES['upload']['tmp_name'];
        if(isset($filePath)){
          if (!move_uploaded_file($filePath, __DIR__ . '/img/' . $_FILES['upload']['name'])) {
            die('При записи изображения на диск произошла ошибка.');
          }
        }
      ?>
    </div>
    <?php
      if (isset($_POST["name_z"])) {
        $name=$_POST['name_z'];
        $proizv=$_POST['proizv'];
        $marca_z=$_POST['marca_z'];
        $model_z=$_POST['model_z'];
        $for_z= $_POST['for_z'];
        $price_z = $_POST['price_z']; 
        $img_z=$_POST['img_z'];
        mysqli_query($link,"INSERT INTO `zapchasti` VALUES(NULL,'$name','$proizv','$marca_z','$model_z','$for_z','$price_z','$img_z')");
        echo mysqli_error($link);
      }
     ?>
    <div style="float:left; padding-left: 40px">
      <p>Удаление авто:</p>
       <form action="admin.php" method="post">
       <?php
        $Carf=mysqli_query($link,"SELECT * FROM `cars`");
        echo'<select name="delited">';
        while($car=mysqli_fetch_assoc($Carf)) {
          echo"<option value=".$car['ID'].">".$car['marka']." ".$car['model']."</option>";
        }
          echo '</select>
          <input type="submit" value="Удалить">';
          ?>
       </form>
       <?php
        if(isset($_POST['delited'])){
          $delited=$_POST['delited'];
          mysqli_query($link,"DELETE FROM `cars` WHERE `ID`='$delited'");
        }
        ?>
    </div>
    <div style="float:left; padding: 40px">
      <p>Удаление запчасти:</p>
       <form action="admin.php" method="post">
       <?php
        $zapf=mysqli_query($link,"SELECT * FROM `zapchasti`");
        echo'<select name="delitedz">';
        while($zap=mysqli_fetch_assoc($zapf)) {
          echo"<option value=".$zap['ID'].">".$zap['Name']." для ".$zap['For_model']."</option>";
        }
          echo '</select>
          <input type="submit" value="Удалить">';
        ?>
       </form>
       <?php
        if(isset($_POST['delitedz'])){
          $delitedz=$_POST['delitedz'];
          mysqli_query($link,"DELETE FROM `zapchasti` WHERE `ID`='$delitedz'");
        }
        ?>
    </div>
   <div style="float:left; padding-left: 40px">
      <form action="admin.php" method="post">
        <p>Редактирование авто:</p>
        <!-- <p>Введите id авто:</p> -->
        <?php
        $Carf=mysqli_query($link,"SELECT * FROM `cars`");
        echo'<select name="id">';
        while($car=mysqli_fetch_assoc($Carf)) {
          echo"<option value=".$car['ID'].">".$car['marka']." ".$car['model']."</option>";
        }
          echo '</select>
          <input type="submit" value="Показать данные">';
        ?>
        <?php
          if(isset($_POST['id'])){
            $kk=$_POST['id'];
            $newItem=mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM `cars` WHERE `ID`='$kk'"));
            echo '<form action="admin.php" method="post" enctype="multipart/form-data">
              <input type="number" name="uid" hidden value="'.$newItem['ID'].'">
              <p>Марка:<input type="text" name="umarka" value="'.$newItem['marka'].'"></p>
              <p>Модель:<input type="text" name="umodel" value="'.$newItem['model'].'"></p>
              <p>Год:<input type="number" name="uyear" value="'.$newItem['year'].'"></p>
              <p>Стоимость:<input type="number" name="uprice" value="'.$newItem['price'].'"></p>
              <p>Новая/бу:<input type="text" name="unew" value="'.$newItem['new'].'"></p>
              <p>Изображения:<input type="text" name="uimage" value="'.$newItem['href_car_imj'].'"></p>
              ';
                echo '<img src="img/'.$newItem['href_car_imj'].'" width="250px" height="180px"><span>
                <br>
                <form action="admin.php" method="post" enctype="multipart/form-data">
                <br>
                <input type="file" name="up load">
                <button>Загрузить</button>
              </form>';
                $filePath  = $_FILES['upload']['tmp_name'];
                if(isset($filePath)){
                  if (!move_uploaded_file($filePath, __DIR__ . '/img/' . $_FILES['upload']['name'])) {
                    die('При записи изображения на диск произошла ошибка.');
                  }
                }
                echo'<p><input type="submit" value="Обновить"></p>';
          }
          ?>
      </form>
      <?php
        if(isset($_POST['umarka'])){
          $uid=$_POST['uid'];
          $umarka=$_POST['umarka'];
          $umodel=$_POST['umodel'];
          $uyear=$_POST['uyear'];
          $uprice=$_POST['uprice'];
          $unew=$_POST['unew'];
          $uimage=$_POST['uimage'];
          mysqli_query($link,"UPDATE `cars` SET `marka`='$umarka',
                                           `model`='$umodel',
                                           `year`='$uyear',
                                           `price`='$uprice',
                                           `new`='$unew',
                                           `href_car_imj`='$uimage'
                                            WHERE `ID`='$uid'");
        }
       ?>
    </div>

    <div style="float:left; padding-left: 40px">
      <form action="admin.php" method="post">
        <p>Редактирование запчастей:</p>
        <?php
        $zapf=mysqli_query($link,"SELECT * FROM `zapchasti`");
        echo'<select name="idz">';
        while($zap=mysqli_fetch_assoc($zapf)) {
          echo"<option value=".$zap['ID'].">".$zap['Name']." для ".$zap['For_model']."</option>";
        }
          echo '</select>
          <input type="submit" value="Показать данные">';
        ?>
        <?php
          if(isset($_POST['idz'])){
            $zkk=$_POST['idz'];
            $newItemz=mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM `zapchasti` WHERE `ID`='$zkk'"));
            echo '<form action="admin.php" method="post" enctype="multipart/form-data">
              <input type="number" name="zid" hidden value="'.$newItemz['ID'].'">
              <p>Наименование:<input type="text" name="zname" value="'.$newItemz['Name'].'"></p>
              <p>Производитель:<input type="text" name="zproizv" value="'.$newItemz['Proizv'].'"></p>
              <p>Для марки:<input type="text" name="zmarсa" value="'.$newItemz['For_marca'].'"></p>
              <p>Для модели:<input type="text" name="zmodel" value="'.$newItemz['For_model'].'"></p>
              <p>Для отечественной/иномарки:<input type="text" name="zfor" value="'.$newItemz['For_in'].'"></p>
              <p>Цена:<input type="number" name="zpricez" value="'.$newItemz['pricez'].'"></p>
              <p>Изображение:<input type="text" name="zimjz" value="'.$newItemz['imjz'].'"></p>
              ';
                echo '<img src="img/'.$newItemz['imjz'].'" width="250px" height="180px"><span>
                <br>
                <form action="admin.php" method="post" enctype="multipart/form-data">
                <input type="file" name="up load">
                <button>Загрузить</button>
              </form>';
                $filePath  = $_FILES['upload']['tmp_name'];
                if(isset($filePath)){
                  if (!move_uploaded_file($filePath, __DIR__ . '/img/' . $_FILES['upload']['name'])) {
                    die('При записи изображения на диск произошла ошибка.');
                  }
                }
                echo'<p><input type="submit" value="Обновить"></p></form>';
          }
        ?>
      </form>
      <?php
        if(isset($_POST['zname'])){
          $zid=$_POST['zid'];
          $zname=$_POST['zname'];
          $zproizv=$_POST['zproizv'];
          $zmarca=$_POST['zmarсa'];
          $zmodel=$_POST['zmodel'];
          $zfor=$_POST['zfor'];
          $zpricez=$_POST['zpricez'];
          $zimjz=$_POST['zimjz'];
          mysqli_query($link,"UPDATE `zapchasti` SET `Name`='$zname',
                                           `Proizv`='$zproizv',
                                           `For_marca`='$zmarca',
                                           `For_model`='$zmodel',
                                           `For_in`='$zfor',
                                           `pricez`='$zpricez',
                                           `imjz`='$zimjz'
                                            WHERE `ID`='$zid'");
        }
       ?>
    </div>
  </body>
</html>
<?php endif; ?>
