<?php 
session_start();

if (isset($_SESSION["useremail"])) {
  header('Location: homepage.php');
}
else if (isset($_SESSION["useremailS"])) {
  header('Location: homepage(S).php');
}

include 'DBcon.php';
include 'mail.php';

$psw = rand(100000,999999);
$email = $_POST['email'];
$role = $_POST['role'];

$password = sha1($psw);

$sql = "select * from user where Email =  '$email' ";
  $result = mysqli_query($con, $sql);
  $count = mysqli_num_rows($result);

  if ($count == 1 && $role == 'User') {
    $sql = "UPDATE user SET Password='$password' WHERE email = '$email' ";
		$result = mysqli_query($con, $sql);
        if ($result) {
            $msg = 'Your new password is: ' . $psw . '<br> you can
            change the password in account settings';
            sendmail($email, 'New password' , $msg);
            echo "<script> alert(\"The message is sent\"); </script>";
            echo "<script> window.location.replace('index.php'); </script>";
            exit();
        }
  }

  $sql = "select * from seller where Email =  '$email' ";
  $result = mysqli_query($con, $sql);
  $count = mysqli_num_rows($result);

  if ($count == 1 && $role == 'Seller') {
    $sql = "UPDATE seller SET password='$password' WHERE Email = '$email' ";
		$result = mysqli_query($con, $sql);
        if ($result) {
            $msg = 'Your new password is: ' . $psw . '<br> you can
            change the password in account settings';
            sendmail($email, 'New password' , $msg);
            echo "<script> alert(\"The message is sent\"); </script>";
            echo "<script> window.location.replace('index.php'); </script>";
            exit();
        }
  }

  $sql = "select * from captain where Email =  '$email' ";
  $result = mysqli_query($con, $sql);
  $count = mysqli_num_rows($result);

  if ($count == 1 && $role == 'Captain') {
    $sql = "UPDATE captain SET password='$password' WHERE Email = '$email' ";
		$result = mysqli_query($con, $sql);
        if ($result) {
            $msg = 'Your new password is: ' . $psw . '<br> you can
            change the password in account settings';
            sendmail($email, 'New password' , $msg);
            echo "<script> alert(\"The message is sent\"); </script>";
            echo "<script> window.location.replace('index.php'); </script>";
            exit();
        }
  }

  $sql = "select * from admin where Email =  '$email' ";
  $result = mysqli_query($con, $sql);
  $count = mysqli_num_rows($result);

  if ($count == 1 && $role == 'Admin') {
    $sql = "UPDATE admin SET password='$password' WHERE email = '$email' ";
		$result = mysqli_query($con, $sql);
        if ($result) {
            $msg = 'Your new password is: ' . $psw . '<br> you can
            change the password in account settings';
            sendmail($email, 'New password' , $msg);
            echo "<script> alert(\"The message is sent\"); </script>";
            echo "<script> window.location.replace('index.php'); </script>";
            exit();
        }
  }

  echo "<script> alert(\"This email is not registered\"); </script>";
  echo "<script> window.location.replace('index.php'); </script>";


