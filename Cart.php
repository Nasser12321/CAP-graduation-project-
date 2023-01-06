<?php
session_start();
if(!$_SESSION["useremail"]){
header("Location: index.php");

die;
}
include 'DBcon.php';

if (isset($_POST['Remove'])) {
  $id = $_POST['ID'];
  $query = "DELETE FROM cart WHERE ProductID='$id'";
  $query_run = mysqli_query ($con, $query);
}

if (isset($_POST['increase'])) { // user clicks increase
  $id = $_POST['ID']; // product id
  $sql = "SELECT * FROM cart, product where ID = ProductID AND ProductID = '$id'";
  $result = mysqli_query($con,$sql);
  $row = mysqli_fetch_array($result);
  $inputQuantity = $row['Quantity']; // quantity of items of the products that added to the cart 
  $actualQuantity = $row['Item_Quantity']; // avalilable product quantity registered in the system
  if ($inputQuantity < $actualQuantity ){ // purchased quantity should not exceeds the actual quantity of the product in the stock
 
  $query = "UPDATE cart SET Quantity = Quantity + 1 WHERE ProductID='$id'"; // Update the quantity of the product in the cart
  $query_run = mysqli_query ($con, $query); // run the query 

  $sql1 = "SELECT * FROM product where ID = '$id'";
  $result1 = mysqli_query($con,$sql1);
  $row1 = mysqli_fetch_array($result1);
  $itemPrice = $row1['Price'];
  $query1 = "UPDATE cart SET Total_Price = ('$itemPrice' * Quantity) WHERE ProductID='$id'"; // Update the total price of a specific product
  $query_run1 = mysqli_query ($con, $query1);
  }
  else {
    echo " <script> alert(\"You exceeds the maximum quantity of this product\"); </script>"; 
  }
  
 
}

if (isset($_POST['decrease'])) { // user clicks decrease 
  $id = $_POST['ID']; // product id
  $sql = "SELECT * FROM cart where ProductID = '$id'";
  $result = mysqli_query($con,$sql);
  $row = mysqli_fetch_array($result);
  $quantity = $row['Quantity'];
  if ($quantity > 1){ 
  $query = "UPDATE cart SET Quantity = Quantity - 1 WHERE ProductID='$id'";
  $query_run = mysqli_query ($con, $query);

  $sql1 = "SELECT * FROM product where ID = '$id'";
  $result1 = mysqli_query($con,$sql1);
  $row1 = mysqli_fetch_array($result1);
  $itemPrice = $row1['Price'];
  $query1 = "UPDATE cart SET Total_Price = ('$itemPrice' * Quantity) WHERE ProductID='$id'";
  $query_run1 = mysqli_query ($con, $query1);
  }
  else { // if the qunatity of items is 1, the product will be removed from cart.
    $query = "DELETE FROM cart WHERE ProductID='$id'";
    $query_run = mysqli_query ($con, $query);
  
  }
  
 
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
<!-- awesome4 -->
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src = "jquery-3.6.0.min.js"> 

</script>

<style>
 button.pass1:hover {
    background-color: white;
}
body {
  background-image: url(images/background.png);
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover
}

</style>
</head>
<body >
<div id = "b1" class="w3-container " >
  

<div class="w3-bar w3-theme">
  <a href="homepage.php" class="w3-bar-item w3-button w3-padding-16"><i class="fa fa-home" style="font-size:36px; color:blue"></i></a>
  <a href="Account.php" class="w3-bar-item w3-button w3-padding-16"><i class="fa fa-user" style="font-size:36px; color:white"></i></a>
  <a href="Cart.php" class="w3-bar-item w3-button w3-padding-16">
  <?php 
 $sql = "SELECT SUM(Quantity)from cart";
 $result = mysqli_query($con,$sql);
 $count = mysqli_num_rows($result);
 $row = mysqli_fetch_array($result);
 if ($count > 0){
 echo "<div class = 'w3-small w3-left w3-red w3-circle' > " . $row['SUM(Quantity)'] . "</div>";
}
 ?>  
  <i class="fa fa-shopping-basket" style="font-size:36px; color:orange"></i></a>
  <a href="Wisheslistpage.php" class="w3-bar-item w3-button w3-padding-16"><i class="fa fa-star" style="font-size:36px; color:yellow"></i></a>
  
  
  
  <br>
  <form  class="navbar-form navbar-left " action= "homepage.php" method="POST">
				  <span class="form-group ">
					<input type="search" class="form-control w3-round w3-round-xxlarge w3-light-blue" placeholder="Search" name="search" style="color: black;">
</span>

				 <span> <button id = "srch" type="submit" class="btn btn-default w3-button w3-dark-grey"  name = "srch"><i class="fa fa-search" ></i></button> </span>
				  
				</form>
</div>
<!-- Side Navigation -->
<nav class="w3-sidebar w3-bar-block w3-card w3-animate-left w3-center" style="display:none" id="mySidebar">

  <button class="w3-bar-item w3-button" onclick="w3_close()">Close <i class="fa fa-remove"></i></button>
  <a href="signout.php" class="w3-bar-item w3-button">Sign out</a>

</nav>

<!-- Header -->
<header class="w3-container w3-theme w3-padding " id="myHeader" >
  <i onclick="w3_open()" class="fa fa-bars w3-xlarge w3-button w3-theme"></i> 
  <div class="w3-center ">
  <h4 class = "w3-cursive w3-animate-top">Car accessories & spare parts</h4>
  <h1 class="w3-cursive w3-xxxlarge w3-animate-bottom">CAP</h1>
  <h4> CART </h4>
    <div class="w3-padding-32 ">
      
    </div>
  </div>
</header>
<br> <br> <br> <br> <br>
<!-- Modal -->


<div class="w3-row-padding w3-center w3-margin-top">

<?php 

$uid = $_SESSION['userid'];
 $sql = "Select * from cart,product WHERE ProductID = ID AND UserID = '$uid' ";
 $result = mysqli_query($con,$sql);
 if (mysqli_num_rows($result) == 0 ) {
    echo " <script> alert(\"The Cart is empty\"); </script>";
    echo "<script> window.location.replace('homepage.php'); </script>";
  } 
  else {
    while ($row = mysqli_fetch_array($result)) {
    echo "

   
    <div class=' w3-container w3-pale-yellow w3-card-4 '>
    <div class='w3-border w3-border-green  w3-round-xxlarge w3-card w3-container w3-animate-zoom w3-white' style='min-height:230px; margin : 30px'>
    <br>
    <img src = '" . $row['Image'].  "' alt = '". $row['Name'] . " image' 
    style = 'width:200px; height : 200px' class='w3-left w3-bar-item w3-circle w3-hide-small'> 
    <br>
    <span style = 'font-size : 20px; font-family : Monospace'>" .$row['Name']. " </span>
    <br>  
     <br> 
    <span style = 'font-size : 20px; font-family : Cursive; color : brown'> ". $row["Total_Price"] . "SR </span>
    <br><br>
    <form action = " . htmlspecialchars($_SERVER["PHP_SELF"]) . " method = POST>
    <input name = 'ID' id = 'pid1' type = 'hidden' value = ' ". $row['ID']." '>
    <span class = 'w3-border w3-border-red w3-round-xxlarge' style = 'font-size : 20px; font-family : Monospace'> Quantity: " .$row['Quantity']. " </span>
    <span style = 'font-size : 20px; font-family : Monospace'><button class = 'w3-button' name = 'increase'> <i class='fa fa-cart-plus' style='font-size:30px; color : green'></i></button> </span>
    <span style = 'font-size : 20px; font-family : Monospace'><button class = 'w3-button' name = 'decrease'> <i class='fa fa-cart-arrow-down' style='font-size:30px; color : red'></i></button> </span>
    </form>
    <br> <br>
    <form action = " . htmlspecialchars($_SERVER["PHP_SELF"]) . " method = POST>
    <input name = 'ID' id = 'pid1' type = 'hidden' value = ' ". $row['ID']." '>
    <button class = 'w3-button'  name = 'Remove'  style = ' font-family : Fantasy; background-color : #C31919   ; height : 50px; font-size : 17px; width : 130px; border : 2px solid black; border-radius : 15px;'  > Remove </button>
    </form>
    <br> <br>
    </div> 
    </div>"
        ; 
    }
  }
  echo
   '<form action = "Cart.php" method = "POST" id = "mode-form">
   <div class = "w3-pale-yellow w3-xlarge w3-cursive">
  delivary mode
  <select  class="w3-large w3-middle w3-round-xxlarge w3-border-red" name = "mode" required>
  <option value="delivary">delivary only</option>
  <option value="delivary and install">delivary and install</option> 
  <br>
  </select>
  <button class = "w3-button w3-orange w3-round w3-round-xxlarge" type = "submit" name = "setMode"> set </button>
  <br>

  </div> 
  </form>';
 $sql = "Select SUM(Total_Price) from cart";
 $result = mysqli_query($con,$sql);
 $row = mysqli_fetch_array($result);
 $pc = $row['SUM(Total_Price)'] + 30;

 $sql3 = "Select SUM(Quantity) from cart";
 $result3 = mysqli_query($con,$sql3);
 $row3 = mysqli_fetch_array($result3);
 $itemQ = 0;
 $_SESSION["install"] = $itemQ;
 if (isset($_POST['setMode'])) { 
  if ($_POST['mode'] == 'delivary') {
    $itemQ = 0;
    $_SESSION["install"] = $itemQ;
 echo '<div class = "w3-pale-yellow w3-xlarge w3-cursive"><br>Delivary: ' . 30 . ' SR</div>';
 echo '<div class = "w3-pale-yellow w3-xlarge w3-cursive">Total: ' . $pc . ' SR</div>';
  }
  else {
    $itemQ = $row3['SUM(Quantity)'] * 10;
    $_SESSION["install"] = $itemQ;
    echo '<div class = "w3-pale-yellow w3-xlarge w3-cursive"><br>Delivary: ' . 30 . ' SR</div>';
    echo '<div class = "w3-pale-yellow w3-xlarge w3-cursive">Total cost of install (10SR for every item): ' . $itemQ . ' SR</div>';
    echo '<div class = "w3-pale-yellow w3-xlarge w3-cursive">Total: ' . $pc + $itemQ . ' SR</div>';
  }
 }
 else { 
  // if user didn't set mode
  $itemQ = 0;
  $_SESSION["install"] = $itemQ;
echo '<div class = "w3-pale-yellow w3-xlarge w3-cursive"><br>Delivary: ' . 30 . ' SR</div>';
echo '<div class = "w3-pale-yellow w3-xlarge w3-cursive">Total: ' . $pc . ' SR</div>';
 }
 mysqli_close($con);
?>
<br>
<?php

include 'Payment API/PaymentAPI.php';
?>
</div>

<br> 
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


</script>

</body>
</html>
