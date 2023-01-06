<?php
session_start();
if(!$_SESSION["useremail"]){
header("Location: index.php");

die;
}
include 'DBcon.php';
$pid = $_POST['pid']; // Product id choosen by the user
$price = $_POST['price']; // product price
$uid = $_SESSION["userid"];  // user id

$sql2 = "select * from cart where ProductID = '$pid' ";
$result2 = mysqli_query($con, $sql2);
$count = mysqli_num_rows($result2);
if ($count == 1) { //if the product already exist in the cart
    echo " <script> alert(\"The Product is already exist in the cart\"); </script>"; // message
    echo "<script> window.location.replace('homepage.php'); </script>"; // back to home page
}

else { // the product is not exist in the cart, so add it.
$sql = "insert into cart (ProductID, UserID, Quantity, Total_Price) 
 VALUES ('$pid', '$uid', 1, '$price') ";
	$result = mysqli_query($con,$sql);
    if ($result) {
    echo " <script> alert(\"The Product is added to Cart\"); </script>"; // message
    echo "<script> window.location.replace('homepage.php'); </script>";  // back to home page 
    }
}
?>