<?php require 'db.php';
$current_category=$_GET['cur_cat'];
/*$current_categoryz=$_GET['cur_catz'];*/
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap&subset=cyrillic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>Auto</title>
    <script type="text/javascript" src="scripts.js"></script>
  </head>
  <body>
  <div class="wrapper">
      <div class="header">
        <div class="inner-header">
          <div class="logo">
          <a href="/" style="color:white;"><img class="logoimg" src="logo.png"></a>
          </div>
          <div class="nav">
          <ul>
              <li curl_share_setopt="menu-item">
                <a style="margin-left:-170px" href="#" id="hovered" onclick="ShowList()">Запчасти</a>
                <ul id="submenu" style="position:relative; align: center">
                  <li> <a href="?catz=1" style="height:55px;">Для отечественных</a> </li>
                  <li> <a href="?catz=2" style="height:55px;">Для иномарок</a> </li>
                  <li style="height:35px;" onclick="closeList()">&#8593; Свернуть</li>
                </ul>
              </li>
            </ul>
            <ul>
              <li curl_share_setopt="menu-item">
                <a style="margin-left:-100px" href="#!" id="hovered" onclick="ShowList1()">Автомобили</a>
                <ul id="submenu1" style="position:relative;">
                  <li  class="submenu-item"> <a href="?cat=1" style="height:55px;">Новые</a> </li>
                  <li  class="submenu-item"> <a href="?cat=2" style="height:55px;">С пробегом</a> </li>
                  <li style="height:35px;" onclick="closeList1()">&#8593; Свернуть</li>
                </ul>
              </li>
            </ul>
            <ul><li class="menu-item"> <a id="hovered" href="mycart.php" style="margin-left:-30px">Корзина</a> </li></ul>
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


      <div class="row">  <!-- osn shast -->
        <div class="sidebar">
          <div class="inner-side">
          <form class="form1" action="index.php" method="get">
              <ul id="categories">
              <span style="font-family: 'Montserrat', sans-serif; font-size:18pt; color:#d6ba1dd0">Автомобили</span>
              <br>
              <br>
                <li><a href="?cat=1"><span>Новые</span></a></li>
                <br>
                <li><a href="?cat=2"><span>С пробегом</span></a></li>
              </ul>
              <ul id="categories">
              <span style="font-family: 'Montserrat', sans-serif;font-size:18pt; color:#d6ba1dd0">Запчасти</span>
              <br>
              <br>
                <li><a href="?catz=1"><span>Для отечественных</span></a></li>
                <br>
                <li><a href="?catz=2"><span>Для иномарок</span></a></li>
              </ul>
              <p style="font-family: 'Montserrat', sans-serif;">Фильтр</p>
              <table style="width:100%;">
                <tr>
                  <td colspan="2" style="  font-family: 'Montserrat', sans-serif;">Цена:</td>
                </tr>
                <tr><td style="font-family: 'Montserrat', sans-serif;">От:</td> <td style="font-family:'Montserrat', sans-serif;">До:</td>  </tr>
                <tr>
                  <td>
                    <input type="number" name="min" value=0 id="inp1">
                  </td>
                  <td>
                    <input type="number" name="max" value="<?php if($maxprice!='') echo $maxpriceA?>"  id="inp2">
                  </td>
                </tr>
                <tr>
                  <td> <input type="submit" value="Показать"  class="submit" ></td>
                  <td> <input type="reset" value="Очистить" id="res"> </td>
                </tr>
              </table>
            </form>
          </div>
        </div>

        <div class="main">
            <div class="all"> 




            <?php
            while($car=mysqli_fetch_assoc($cars)) {
                echo '
                <form action="addtocart.php" method="post">
                <input type="hidden" name="carid" value="'. $car['ID'] .'">
                <div class="card">
                   <div class="inner-card">
                     <div class="imgCard">
                      <img src="img/' . $car['href_car_imj'] .'" width="100%" height="100%">
                      </div>
                      <p> Марка:' . $car['marka'] . '</p>
                      <p>Модель:' .$car['model']. '</p>
                      <p>Год выпуска:'  .$car['year'].'</p>
                      <p>Цена:<span>'. $car['price'].'</span></p>
                      <div class="">
                        <input type="submit" name="" value="В корзину">
                      </div>
                   </div>
                 </div>
                 </form>
                ';
              }
            while($zapch=mysqli_fetch_assoc($zap)) {
                echo '
                <form action="addtocart1.php" method="post">
                <input type="hidden" name="zapid" value="'. $zapch['ID'] .'">
                <div class="card">
                   <div class="inner-card">
                     <div class="imgCard">
                      <img src="img/' . $zapch['imjz'] .'" width="100%" height="100%">
                      </div>
                      <p> Наименование:'.$zapch['Name'].'</p>
                      <p> Марка:' . $zapch['For_marca'] . '</p>
                      <p>Модель:' .$zapch['For_model']. '</p>
                      <p>Цена:<span>'. $zapch['pricez'].'</span></p>
                      <div>
                        <input type="submit" name="" value="В корзину"></div><div style="width:50%; float:left;">
                      </div>
                   </div>
                 </div>
                 </div>
                 </form>
                ';
              }
         ?>




</div>
 </div>
 <div class="desktop">
			<article id="slider">
					<input checked type="radio" name="slider" id="switch1" style="visibility:hidden">
					<input type="radio" name="slider" id="switch2" style="visibility:hidden">
					<input type="radio" name="slider" id="switch3" style="visibility:hidden">
					<input type="radio" name="slider" id="switch4" style="visibility:hidden">
					<input type="radio" name="slider" id="switch5" style="visibility:hidden">
				<div id="slides">
					<div id="overflow">
						<div class="image">
							<article><img src="img/1sl.jpg"></article>
							<article><img src="img/2sl.jpg"></article>
							<article><img src="img/3sl.jpg"></article>
							<article><img src="img/4sl.jpg"></article>
							<article><img src="img/5sl.jpg"></article>
						</div>
					</div>
				</div>
				<div id="controls">
					<label for="switch1"></label>
					<label for="switch2"></label>
					<label for="switch3"></label>
					<label for="switch4"></label>
					<label for="switch5"></label>
				</div>
				<div id="active">
					<label for="switch1"></label>
					<label for="switch2"></label>
					<label for="switch3"></label>
					<label for="switch4"></label>
					<label for="switch5"></label>
				</div>
      </article>
            </div>  
            </div>


            </div>         
        </div>

        <div class="footer">
        <div class="inner-footer">
          <?php
          echo '<p  style="font-size:16pt; text-align:left">Связаться с нами: <a href="https://www.instagram.com"> <img class="footerimg" src="Instagram.png" alt="Инстаграм"></a>';
            $userid=$_COOKIE["userid"];
            if(isset($userid)){
            $q=mysqli_query($link,"SELECT * FROM `users` WHERE `id`='$userid' AND `isAdmin`='1'");
            $user=mysqli_fetch_assoc($q);
            if(count($user)!=0)
              echo '<div><p><a href="admin.php" style="color:yellow; font-size:15pt; margin-left:30px; width:100%">Панель администратора</a></div></p>';
            }
          ?>
        </div>
      </div>

      </div>    
  </body>
</html>
