<?php
session_start();
if(!$_SESSION["useremailA"]){
header("Location: index.php");

die;
}
?>

<?php
 include 'DBcon.php';
if (isset($_POST['delete'])) {
  $id = $_POST['sid'];
	$query = "DELETE seller, product FROM seller INNER JOIN product ON seller.SellerID = product.SellerID WHERE seller.SellerID='$id'";
	$query_run = mysqli_query ($con, $query);
  if($query_run){
    echo "<script> alert(\"The Seller is removed successfuly\"); </script>";
    }
    else {
      echo "<script> alert(\"Failed to delete\"); </script>";
    }
  
}



  ?>
<!DOCTYPE html>
<html>
<head>
<title>Admin page</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-green.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
<script src = "jquery-3.6.0.min.js"> </script>
<style>
 button.pass1:hover {
    background-color: white;
}
a{
  text-decoration: none;
}
</style>
</head>
<body>
<div class="w3-container">


<div class="w3-bar w3-theme">
<a href="homepage(A).php" class="w3-bar-item w3-button w3-padding-16"><i class="fa fa-home" style="font-size:36px; "></i></a>
  <a href="Account(A).php" class="w3-bar-item w3-button w3-padding-16"><i class="fa fa-user" style="font-size:36px;"></i></a>

  
  
  
  <br>
  <form  class="navbar-form navbar-left " action= "Slist.php" method="POST">
				  <span class="form-group ">
					<input type="search" class="form-control w3-round w3-round-xxlarge w3-light-blue" placeholder="Search" name="search" style="color: black;">
</span>

				 <span> <button id = "srch" type="submit" class="btn btn-default w3-button w3-dark-grey"  name = "srch"><i class="fa fa-search" ></i></button> </span>
				  
				</form>
</div>
<!-- Side Navigation -->
<nav class="w3-sidebar w3-bar-block w3-card w3-animate-left w3-center" style="display:none" id="mySidebar">

  <button class="w3-bar-item w3-button" onclick="w3_close()">Close <i class="fa fa-remove"></i></button>
  <a href="viewReport.php" class="w3-bar-item w3-button">Reports</a>
  <a href="signout.php" class="w3-bar-item w3-button">Sign out</a>

</nav>

<!-- Header -->
<header class="w3-container w3-theme w3-padding" id="myHeader">
  <i onclick="w3_open()" class="fa fa-bars w3-xlarge w3-button w3-theme"></i> 
  <div class="w3-center">
  <h4 class = "w3-cursive">Car accessories & spare parts</h4>
  <h1 class="w3-xxxlarge w3-animate-bottom w3-cursive">CAP</h1>
  <h3 class="w3-xlarge w3-cursive">Admin</h3>
    <div class="w3-padding-32">
      
    </div>
  </div>
</header>
<!-- Modal -->


<div class="w3-row-padding w3-center w3-margin-top">

<?php
 include 'DBcon.php';
 if(isset($_POST["search"])){
	$title = $_POST['search'];

	$sql = "Select * from seller WHERE Seller_name like '%$title%' AND Accepted_registration = 1";
	$result = mysqli_query($con,$sql);
  if (mysqli_num_rows($result) == 0 ) {
    echo " <script> alert(\"Sellers list is empty\"); </script>";
    echo "<script> window.location.replace('homepage(A).php'); </script>";
  }
  else {
   
	while ($row = mysqli_fetch_array($result)) {
		echo "
		<div class='w3-third  background-size: cover'>
        <div class=' w3-card w3-container w3-animate-zoom w3-hover-gray' style='min-height:460px; margin : 20px'>
        <br>
		<i class='fa fa-user' style='font-size:36px;'></i>
        <br>
		<span style = 'font-size : 17.4px; font-family : Monospace'>" .$row['Seller_name']. " </span>
		<br>  
         <br>
		<span style = 'font-family : Cursive; color : green'> ". $row["phone_number"] . "</span>
		<br> <br>
      
        
    <form method = 'POST' action = 'Slist.php'>
    <button class = 'w3-button' type = 'submit' name = 'delete'  style = 'font-family : Fantasy; background-color : red  ; height : 50px; width : 130px; font-size : 17px; border : 2px solid black; border-radius : 15px;'  > Remove </button>
    <input name = 'sid' id = 'sid' type = 'hidden' value = ' ". $row['SellerID']." '>
    </form>
        <br> 
   
		</div>
        </div>
		
		";
    
	}
}
 }
 
  else {
    $sql = "Select * from seller WHERE Accepted_registration = 1";
	$result = mysqli_query($con,$sql);
  if (mysqli_num_rows($result) == 0 ) {
    echo " <script> alert(\"Seller list is empty\"); </script>";
    echo "<script> window.location.replace('homepage(A).php'); </script>";
  }else {
    while ($row = mysqli_fetch_array($result)) {
    
      echo "
      <div class='w3-third  background-size: cover'>
      <div class=' w3-card w3-container w3-animate-zoom w3-hover-gray' style='min-height:460px; margin : 20px'>
      <br>
  <i class='fa fa-user' style='font-size:80px;'></i>
      <br> <br>
  <span style = 'font-size : 17.4px; font-family : Monospace'>" .$row['Seller_name']. " </span>
  <br>  
       <br>
  <span style = 'font-family : Cursive; color : green'> ". $row["phone_number"] . "</span>
  <br> <br>
    
      
      <form method = 'POST' action = 'Slist.php'>
      <button class = 'w3-button' type = 'submit' name = 'delete'  style = 'font-family : Fantasy; background-color : red  ; height : 50px; width : 130px; font-size : 17px; border : 2px solid black; border-radius : 15px;'  > Remove </button>
      <input name = 'sid' id = 'sid' type = 'hidden' value = ' ". $row['SellerID']." '>
      </form>
      <br> 
 
  </div>
      </div> 
      ";
      
  
    } 
}
}

     
mysqli_close($con);
 ?>

</div>
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


</script>

</body>
</html>
