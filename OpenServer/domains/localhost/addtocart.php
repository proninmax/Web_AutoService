<?php
  require 'db.php';
  $userid=$_COOKIE['userid'];
  $carid = $_POST['carid'];
  $zapid = $_POST['zapid'];
  $qcar = mysqli_fetch_assoc(mysqli_query($link,"SELECT * from `orderscar` where `Car_ID`='$carid' AND `User_ID`='$userid'"))['id'];
  $price = mysqli_fetch_assoc(mysqli_query($link,"SELECT `price` from `cars` where `ID`='$carid'"))['price'];
  mysqli_query($link,"INSERT INTO `orderscar` VALUES(null,'$carid','$userid','$price')");
  header("Location: /");
?>
