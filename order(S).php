<?php
session_start();
if(!$_SESSION["useremailS"]){
header("Location: index.php");

die;
}
?>

<?php
 include 'DBcon.php';
 include 'mail.php';

 if (isset($_POST['confirm'])) { // if seller clicks ready for a product 
	$pid1 = $_POST['pid3']; // get the confirmed product by the seller
  $orderID = $_POST['orderId']; // get the order id of confiremed prodcut
  $quantity = $_POST['quantity']; // get the quantity of ordered product
	$sql = "insert into ready_product (RI_ProductID, RI_OrderID) 
 VALUES ('$pid1','$orderID') "; // add the product to ready products table
 $result = mysqli_query($con,$sql);


$sql1 = "SELECT number_of_product FROM orders WHERE order_ID = '$orderID'  ";
 $result1 = mysqli_query($con,$sql1);
 $row1 = mysqli_fetch_array($result1);
$n1 = $row1['number_of_product']; // the number of ordered product of this order

$sql2 = "SELECT COUNT(RI_OrderID) FROM ready_product WHERE RI_OrderID = '$orderID'  ";
 $result2 = mysqli_query($con,$sql2);
 $row2 = mysqli_fetch_array($result2);
$n2 = $row2['COUNT(RI_OrderID)'];// the number of ready product of this order

 if ($n1 <= $n2) { // if number of ready product equals the number of ordered products, the order status will changed to ready, otherwise it will remains ordered
  $sql3 = "UPDATE orders SET order_status = 'ready' WHERE order_ID = '$orderID'";
  $result3 = mysqli_query($con,$sql3);

  $sql4 = "SELECT Email FROM captain";
  $result4 = mysqli_query($con,$sql4);

  while ($row4 = mysqli_fetch_array($result4)) { // send to all captains about the new ready order
    $email = $row4['Email'];
    $msg = 'Please check the new orders list in your account if you available<br>
    There is unassigned order<br>
    Order number: ' . $orderID . '<br> Thank you' ;
    sendmail($email, 'New order' , $msg);
  }

  
 }
 
  $sql6 = "UPDATE product SET Item_Quantity = (Item_Quantity - '$quantity') WHERE ID = '$pid1' "; // decrease the number of products in the database for the ordered ready products
   $result6 = mysqli_query($con,$sql6);
}


  ?>
<!DOCTYPE html>
<html>
<head>
<title>Orders</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-indigo.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
<script src = "jquery-3.6.0.min.js"> </script>
<style>
 button.pass1:hover {
    background-color: white;
}
</style>
</head>
<body>
<div class="w3-container">


<div class="w3-bar w3-theme">
  <a href="homepage(S).php" class="w3-bar-item w3-button w3-padding-16 w3-cursive">Home</a>
  <a href="Account(S).php" class="w3-bar-item w3-button w3-padding-16 w3-cursive">Account</a>
  <a href="addItem.php" class="w3-bar-item w3-button w3-padding-16 w3-cursive">New item</a>
  <a href="order(S).php" class="w3-bar-item w3-button w3-padding-16 w3-cursive">Orders</a>
  
  
  
  <br>
  <form class="navbar-form navbar-left" action= "homepage(S).php" method="POST">
				  <span class="form-group">
					<input type="text" class="form-control" placeholder="Search" name="search" style="color: black;">
</span>

				 <span> <button type="submit" class="btn btn-default w3-button indigo"  name = "srch"><i class="fa fa-search" ></i></button> </span>
				  
				</form>
</div>
<!-- Side Navigation -->
<nav class="w3-sidebar w3-bar-block w3-card w3-animate-left w3-center" style="display:none" id="mySidebar">

  <button class="w3-bar-item w3-button" onclick="w3_close()">Close <i class="fa fa-remove"></i></button>
  <a href="signout.php" class="w3-bar-item w3-button">Sign out</a>

</nav>

<!-- Header -->
<header class="w3-container w3-theme w3-padding" id="myHeader">
  <i onclick="w3_open()" class="fa fa-bars w3-xlarge w3-button w3-theme"></i> 
  <div class="w3-center">
  <h4 class = "w3-cursive">Car accessories & spare parts</h4>
  <h1 class="w3-xxxlarge w3-animate-bottom w3-cursive">CAP</h1>
    <div class="w3-padding-32">
      
    </div>
  </div>
</header>

<!-- Modal -->
<div class="w3-row-padding w3-center w3-margin-top">
<?php 
 $sid =  $_SESSION['id'];
$sql = "SELECT * FROM ordered_product, product WHERE ID = OP_ProductID AND SellerID = '$sid' AND 
(OP_ProductID, OP_OrderId) NOT IN (SELECT RI_ProductID, RI_OrderID FROM ready_product, ordered_product WHERE 
RI_ProductID = OP_ProductID AND RI_OrderID = OP_OrderId)";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) == 0 ) {
    echo " <script> alert(\"There are no orders need to be confirmed\"); </script>";
    echo "<script> window.location.replace('homepage(S).php'); </script>";
  }
  else{
while ($row = mysqli_fetch_array($result)) { 
    echo "
    <div class='w3-third w3-white'>
    <div class=' w3-card w3-container w3-animate-zoom w3-hover-gray' style='min-height:460px; margin : 20px'>
    <br>
    <img src = '" . $row['Image'].  "' alt = '". $row['Name'] . " image' 
    style = 'width: 140px; height : 140px' class='w3-bar-item w3-circle w3-hide-small'> 
    <br>
    <span style = 'font-size : 17.4px; font-family : Monospace'>" .$row['Name']. " </span>
    <br>  
     <br>
    <span style = 'font-family : Cursive; color : green'>Product ID: ". $row["ID"] . "</span>
    <br> <br>
    <span style = 'font-family : Cursive; color : green'>Order ID: ". $row["OP_OrderId"] . "</span>
    <br> <br>
    <span style = 'font-family : Cursive; color : green'>Quantity: ". $row["OP_quantity"] . "</span>
    <br> <br>
    
<form method = 'POST' action = 'order(S).php'>

<button class = 'w3-button' type = 'submit' name = 'confirm'  style = 'font-family : Fantasy; background-color : green  ; height : 50px; width : 130px; font-size : 17px; border : 2px solid black; border-radius : 15px;'  >Ready</button>
<input name = 'pid3' type = 'hidden' value = ' ". $row['ID']." '>
<input name = 'orderId' type = 'hidden' value = ' ". $row['OP_OrderId']." '>
<input name = 'quantity' type = 'hidden' value = ' ". $row["OP_quantity"]." '>
</form>
    <br> 

    </div>
    </div>
    
    ";
}
  }
?>
</div>



        
   
<!-- Footer -->
<footer class="w3-container w3-theme-dark w3-padding-16">
  <p>Riyadh</p>
  <p>Car accessories & spare parts</p>
  <p class="copyright">&copy; 2022.</p>
  
  <div style="position:relative;bottom:55px;" class="w3-tooltip w3-right">
    <span class="w3-text w3-theme-light w3-padding">Go To Top</span>    
    <a class="w3-text-white" href="#myHeader"><span class="w3-xlarge">
    <i class="fa fa-chevron-circle-up"></i></span></a>
  </div>
  
</footer>

<!-- Script for Sidebar, Tabs, Accordions, Progress bars and slideshows -->
<script>
// Side navigation
function w3_open() {
  var x = document.getElementById("mySidebar");
  x.style.width = "100%";
  x.style.fontSize = "40px";
  x.style.paddingTop = "10%";
  x.style.display = "block";
}
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
}

// Tabs
function openCity(evt, cityName) {
  var i;
  var x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  var activebtn = document.getElementsByClassName("testbtn");
  for (i = 0; i < x.length; i++) {
    activebtn[i].className = activebtn[i].className.replace(" w3-dark-grey", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " w3-dark-grey";
}

var mybtn = document.getElementsByClassName("testbtn")[0];
mybtn.click();

// Accordions
function myAccFunc(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}

// Slideshows
var slideIndex = 1;

function plusDivs(n) {
  slideIndex = slideIndex + n;
  showDivs(slideIndex);
}

function showDivs(n) {
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = x.length} ;
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  x[slideIndex-1].style.display = "block";  
}

showDivs(1);

// Progress Bars
function move() {
  var elem = document.getElementById("myBar");   
  var width = 5;
  var id = setInterval(frame, 10);
  function frame() {
    if (width == 100) {
      clearInterval(id);
    } else {
      width++; 
      elem.style.width = width + '%'; 
      elem.innerHTML = width * 1  + '%';
    }
  }
}

/*function changePrice () {
  const xhttp = new XMLHttpRequest();
  let price = prompt("Please enter the new price");
  xhttp.onload = function() {
    //document.getElementById("conf").innerHTML = "The price is changed successfully";
    alert("The price is changed successfully");
    window.location.reload();
  }
  xhttp.open("GET", "ChangePrice.php?q=" + price + "&i=" + document.getElementById("pid1").value);
  xhttp.send();
} */

</script>

</body>
</html>
 <?php 
 
 

mysqli_close($con);
 ?>