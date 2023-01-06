<?php
   session_start(); 
   include 'DBcon.php';
	$id = $_POST['ID'];
	$query = "DELETE FROM product WHERE ID='$id'";
	echo "<script> alert(\"The item is deleted successfuly\"); </script>";
	$query_run = mysqli_query ($con, $query);
	header('Location:homepage(A).php');