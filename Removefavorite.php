<?php
session_start();
include 'DBcon.php';
$pid = $_POST['pid'];
$useremail = $_SESSION["useremail"];

  mysqli_query($con , "delete from wishes_list where ID = '$pid' AND Email = '$useremail'");
  header('Location:Wisheslistpage.php');
