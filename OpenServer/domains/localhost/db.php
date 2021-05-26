<?php
$db_host='localhost';
$db_user='root';
$db_pass='root';
$db_database='mybase_db';
$link = mysqli_connect($db_host,$db_user,$db_pass);
mysqli_select_db($link,$db_database) or exit("Нет подключения ".mysqli_error());
$minprice=$_GET['min'];
$maxprice=$_GET['max'];
$maxpriceA=mysqli_fetch_assoc(mysqli_query($link,"SELECT MAX(`price`) AS `max` FROM `cars`"))['max'];
if(($minprice!='')&&($maxprice!='')){
  $cars=mysqli_query($link,"SELECT * FROM `cars` WHERE `price`<='$maxprice' AND `price`>='$minprice'");
  $zap=mysqli_query($link,"SELECT * FROM `zapchasti` WHERE `pricez`<='$maxprice' AND `pricez`>='$minprice'");
}
else {
  $cars=mysqli_query($link,"SELECT * FROM `cars`");
  $zap=mysqli_query($link,"SELECT * FROM `zapchasti`");
}


if (isset($_GET['cat'])||(isset($_GET['catz']))){
  $cat=$_GET['cat'];
  $zap=$_GET['catz'];
  $zap=mysqli_query($link,"SELECT * FROM `zapchasti` WHERE `For_in`='$zap'");
  $cars=mysqli_query($link,"SELECT * FROM `cars` WHERE `new`='$cat'");
}
?>