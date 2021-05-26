<?php
  require 'db.php';
  $userid=$_COOKIE['userid'];
  $zapid = $_POST['zapid'];
  $carid = $_POST['carid'];
  $qcar = mysqli_fetch_assoc(mysqli_query($link,"SELECT * from `orderszap` where `Zap_ID`='$zapid' AND `User_ID`='$userid'"))['id'];
  $price = mysqli_fetch_assoc(mysqli_query($link,"SELECT `pricez` from `zapchasti` where `ID`='$zapid'"))['pricez'];
  mysqli_query($link,"INSERT INTO `orderszap` VALUES(null,'$zapid','$userid','$price')");
  header("Location: /");
?>