<?php
session_start();
if(!$_SESSION["useremailS"]){
header("Location: index.php");

die;
}
?>

<?php
 include 'DBcon.php';
if (isset($_POST['delete'])) {
	$id = $_POST['ID']; // get the ID of targeted product
	$query = "DELETE FROM product WHERE ID='$id'";
	$query_run = mysqli_query ($con, $query);
  if($query_run){
  echo "<script> alert(\"The item is deleted successfuly\"); </script>";
  }
  else {
    echo "<script> alert(\"Failed to be deleted\"); </script>";
  }
}



  ?>
<!DOCTYPE html>
<html>
<head>
<title>Home</title>
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
  <a href="previousOrders(S).php" class="w3-bar-item w3-button">Previous orders</a>
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
<div id="conf" style="color: green;"></div>

<?php

 if(isset($_POST["search"])){
	$title = $_POST['search'];
  $sid = $_SESSION['id'];
	$sql = "Select * from product Natural join seller WHERE Name like '%$title%' AND  SellerID = '$sid'";
	$result = mysqli_query($con,$sql);
  if (mysqli_num_rows($result) == 0 ) {
    echo " <script> alert(\"No matching items\"); </script>";
    echo "<script> window.location.replace('homepage(S).php'); </script>";
  }
  else {
	while ($row = mysqli_fetch_array($result)) {
   
		echo "
        
    <div class='w3-third' >
     <div class='w3-card w3-container w3-animate-zoom w3-hover-gray' style='min-height:460px; margin : 20px'>
        <br>
		<img src = '" . $row['Image'].  "' alt = '". $row['Name'] . " image' 
		style = 'width: 140px; height : 140px' class='w3-bar-item w3-circle w3-hide-small'> 
        <br>
		<span style = 'font-size : 17.4px; font-family : Monospace'>" .$row['Name']. " </span>
		<br>  
         <br>
		<span style = 'font-family : Cursive; color : blue'> ". $row["Price"] . "SR </span>
		<br>
    <form method = 'POST' action = 'editItem.php'>	       
    <button class = 'w3-button' id = 'change' name = 'changePrice' type = 'submit' name = 'price'  style = 'font-family : Fantasy; background-color : #3F75C8   ; height : 50px; width : 130px; font-size : 17px; border : 2px solid black; border-radius : 15px;'  > Edit </button>
    <input name = 'pid' id = 'pid1' type = 'hidden' value = ' ". $row['ID']." '>
    </form>
        <br> 	
       
        <form method = 'POST' action = 'homepage(S).php'>
        <button class = 'w3-button'  name = 'delete'  style = ' font-family : Fantasy; background-color : #C31919   ; height : 50px; font-size : 17px; width : 130px; border : 2px solid black; border-radius : 15px;'  > Delete </button>
        <input name = 'ID' id = 'pid1' type = 'hidden' value = ' ". $row['ID']." '>
        </form>
		</div>
        </div>

		";
    
	}
}
 }
 else {
  $sid = $_SESSION['id'];
	$sql = "Select * from product Natural join seller where SellerID = '$sid'";
	$result = mysqli_query($con,$sql);
  if (mysqli_num_rows($result) == 0 ) {
    echo " <script> alert(\"You don't have any offered products\"); </script>";
    echo " <script> window.location.replace('addItem.php'); </script>";
  }
  else {
	while ($row = mysqli_fetch_array($result)) {
		echo "
		<div class='w3-third' >
     <div class='w3-card w3-container w3-animate-zoom w3-hover-gray' style='min-height:460px; margin : 20px'>
        <br>
		<img src = '" . $row['Image'].  "' alt = '". $row['Name'] . " image' 
		style = 'width: 140px; height : 140px' class='w3-bar-item w3-circle w3-hide-small'> 
        <br>
		<span style = 'font-size : 17.4px; font-family : Monospace'>" .$row['Name']. " </span>
		<br>  
         <br>
		<span style = 'font-family : Cursive; color : blue'> ". $row["Price"] . "SR </span>
		<br>
    <form method = 'POST' action = 'editItem.php'>	       
    <button class = 'w3-button' id = 'change' name = 'changePrice' type = 'submit' name = 'price'  style = 'font-family : Fantasy; background-color : #3F75C8   ; height : 50px; width : 130px; font-size : 17px; border : 2px solid black; border-radius : 15px;'  > Edit </button>
    <input name = 'pid' id = 'pid1' type = 'hidden' value = ' ". $row['ID']." '>
    </form>
      
        <br> 	
        <form method = 'POST' action = 'homepage(S).php'>
        <button  class = 'w3-button' name = 'delete'  style = ' font-family : Fantasy; background-color : #C31919   ; height : 50px; font-size : 17px; width : 130px; border : 2px solid black; border-radius : 15px;'  > Delete </button>
        <input name = 'ID' id = 'pid1' type = 'hidden' value = ' ". $row['ID']." '>
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
<hr>
</div>

<hr>

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
