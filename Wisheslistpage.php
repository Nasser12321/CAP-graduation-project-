<?php
 include 'DBcon.php';
session_start();
if(!$_SESSION["useremail"]){
header("Location: index.php");

die;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Wishes list</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
<script src = "jquery-3.6.0.min.js"> </script>
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
<body>
<div class="w3-container">


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
   <form  class="navbar-form navbar-left " action= "Wisheslistpage.php" method="POST">
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
<header class="w3-container w3-theme w3-padding" id="myHeader">
  <i onclick="w3_open()" class="fa fa-bars w3-xlarge w3-button w3-theme"></i> 
  <div class="w3-center">
  <h4>Car accessories & spare parts</h4>
  <h1 class="w3-xxxlarge w3-animate-bottom">CAP</h1>
    <div class="w3-padding-32">
      
    </div>
  </div>
</header>
<br> <br>
<!-- Modal -->


<div class="w3-row-padding w3-center w3-margin-top w3-white">


<?php
 include 'DBcon.php';
 if(isset($_POST["search"])){
  $title = $_POST['search'];
	$user = $_SESSION["useremail"];
  $sql = "Select * from wishes_list Natural join product where '$user' = Email AND Name like '%$title%' AND Item_Quantity > 0" ;

  $result = mysqli_query($con,$sql);
  if (mysqli_num_rows($result) == 0 ) {
    echo " <script> alert(\"No matching items\"); </script>";
    echo "<script> window.location.replace('Wisheslistpage.php'); </script>";
  }
  else {
	while ($row = mysqli_fetch_array($result)) {
		echo "
		<div class='w3-third background-size: cover w3-white'>
        <div class='w3-border w3-border-red  w3-round-xxlarge w3-card w3-container w3-animate-zoom w3-hover-gray w3-white' style='min-height:460px; margin : 20px'>
        <br>
		<img src = '" . $row['Image'].  "' alt = '". $row['Name'] . " image' 
		style = 'width: 140px; height : 140px' class='w3-bar-item w3-circle w3-hide-small'> 
        <br>
		<span style = 'font-size : 17.4px; font-family : Monospace'>" .$row['Name']. " </span>
		<br>  
         <br>
		<span style = 'font-family : Cursive; color : blue'> ". $row["Price"] . "SR </span>
		<br>
      
        <br> 
        <form method = 'POST' action = 'addToCart.php'>
        <button class = 'addcart w3-button' type = 'submit' name = 'addcart'  style = 'font-family : Fantasy; background-color : #3EB61B  ; height : 50px; width : 130px; font-size : 17px; border : 2px solid black; border-radius : 15px;'  > Add to cart </button>
        <input name = 'pid' id = 'pid' type = 'hidden' value = ' ". $row['ID']." '>
        <input name = 'price' id = 'pid' type = 'hidden' value = ' ". $row['Price']." '>
        <input name = 'email' type = 'hidden' value = ' ". $_SESSION["useremail"]." '>
        </form>
    <br> <br>
    <form method = 'POST' action = 'Removefavorite.php'>
		<button  class = 'w3-button' name = 'removefavorite'  style = ' font-family : Fantasy; background-color : red ; height : 50px; font-size : 17px; width : 130px; border : 2px solid black; border-radius : 15px;'  > Remove </button>
		<input name = 'pid' type = 'hidden' value = ' ". $row['ID']." '>
    </form>
		</div>
        </div>
		
		";
    
	}
}
 }
 else {
   
  $user = $_SESSION["useremail"];
  $sql = "Select * from wishes_list Natural join product where '$user' = Email AND Item_Quantity > 0";

  $result = mysqli_query($con,$sql);
 if (mysqli_num_rows($result) == 0) {
  echo " <script> alert(\"The wishes list is empty\"); </script>";
  echo "<script> window.location.replace('homepage.php'); </script>";
 }
 else {
	while ($row = mysqli_fetch_array($result)) {
		echo "
		<div class='w3-third w3-white background-size: cover'>
        <div class='w3-border w3-border-red  w3-round-xxlarge w3-card w3-container w3-animate-zoom w3-hover-gray w3-white' style='min-height:460px; margin : 20px'>
        <br>
		<img src = '" . $row['Image'].  "' alt = '". $row['Name'] . " image' 
		style = 'width: 140px; height : 140px' class='w3-bar-item w3-circle w3-hide-small'> 
        <br>
		<span style = 'font-size : 17.4px; font-family : Monospace'>" .$row['Name']. " </span>
		<br>  
         <br>
		<span style = 'font-family : Cursive; color : blue'> ". $row["Price"] . "SR </span>
		<br>
      
        <br> 
        <form method = 'POST' action = 'addToCart.php'>
        <button class = 'addcart w3-button' type = 'submit' name = 'addcart'  style = 'font-family : Fantasy; background-color : #3EB61B  ; height : 50px; width : 130px; font-size : 17px; border : 2px solid black; border-radius : 15px;'  > Add to cart </button>
        <input name = 'pid' id = 'pid' type = 'hidden' value = ' ". $row['ID']." '>
        <input name = 'price' id = 'pid' type = 'hidden' value = ' ". $row['Price']." '>
        <input name = 'email' type = 'hidden' value = ' ". $_SESSION["useremail"]." '>
        </form>
        
    <br> <br>
    <form method = 'POST' action = 'Removefavorite.php'>
		<button  class = 'w3-button' name = 'removefavorite'  style = ' font-family : Fantasy; background-color : red ; height : 50px; font-size : 17px; width : 130px; border : 2px solid black; border-radius : 15px;'  > Remove </button>
		<input name = 'pid' type = 'hidden' value = ' ". $row['ID']." '>
    </form>
		</div>
        </div>
		
		";
    

	} //end of the items show loop
  
  
}
 }
	

 ?>
  <div class="w3-card w3-container" style="min-height:460px">

</div>

</div>

</div>



<br>

<!-- Footer -->
<footer class="w3-container w3-theme-dark w3-padding-16">
  <p>Riyadh</p>
  <p>Car accessories & spare parts</p>
  <p class="copyright">&copy; 2022.</p>
  
  <div style="position:relative;bottom:55px;" class="w3-tooltip w3-right">
    <span class="w3-text w3-theme-light w3-padding">Go To Top</span>??   
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
