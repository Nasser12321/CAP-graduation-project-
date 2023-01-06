<?php
session_start();
include 'DBcon.php';
$pid = $_POST['pid'];
$useremail = $_SESSION["useremail"];
$sql = "Select * from wishes_list WHERE ID = '$pid'";
$result = mysqli_query($con,$sql);
if (mysqli_num_rows($result) == 0 ){
  mysqli_query($con , "insert into wishes_list (ID , Email) values ('$pid' , '$useremail')");
  header('Location:homepage.php');
}
else {
  echo " <script> alert(\"The item is already exist in wishes list\"); </script>";
  echo "<script> window.location.replace('homepage.php'); </script>";
}
  

