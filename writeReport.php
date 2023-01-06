<?php
session_start();
if(!$_SESSION["useremail"]){
header("Location: index.php");

die;
}

include 'DBcon.php';


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

<script src = "jquery-3.6.0.min.js"> </script>

<style>
 button.pass1:hover {
    background-color: white;
}

</style>
</head>
<div id = "b1" class="w3-container " >
  

<div class="w3-bar w3-theme">
  <a href="homepage.php" class="w3-bar-item w3-button w3-padding-16"><i class="fa fa-home" style="font-size:36px"></i></a>
  <a href="Account.php" class="w3-bar-item w3-button w3-padding-16"><i class="fa fa-user" style="font-size:36px"></i></a>
  <a href="cart.php" class="w3-bar-item w3-button w3-padding-16"><i class="fa fa-shopping-basket" style="font-size:36px;"></i></a>
  <a href="Wisheslistpage.php" class="w3-bar-item w3-button w3-padding-16"><i class="fa fa-star" style="font-size:36px"></i></a>
  
  
  
  <br>
  <form  class="navbar-form navbar-left " action= "homepage.php" method="POST">
				  <span class="form-group ">
					<input type="search" class="form-control" placeholder="Search" name="search" style="color: black;">
</span>

				 <span> <button type="submit" class="btn btn-default w3-button w3-dark-grey"  name = "srch"><i class="fa fa-search" ></i></button> </span>
				  
				</form>
</div>
<!-- Side Navigation -->
<nav class="w3-sidebar w3-bar-block w3-card w3-animate-left w3-center" style="display:none" id="mySidebar">

  <button class="w3-bar-item w3-button" onclick="w3_close()">Close <i class="fa fa-remove"></i></button>
  <a href="signout.php" class="w3-bar-item w3-button">Sign out</a>

</nav>

<!-- Header -->
<header class="w3-container w3-theme w3-padding " id="myHeader">
  <i onclick="w3_open()" class="fa fa-bars w3-xlarge w3-button w3-theme"></i> 
  <div class="w3-center ">
  <h4 class = "w3-cursive">Car accessories & spare parts</h4>
  <h1 class="w3-cursive w3-xxxlarge w3-animate-bottom">CAP</h1>
    <div class="w3-padding-32 ">
      
    </div>
  </div>
</header> 
<div class="w3-row-padding w3-center w3-margin-right">

<h4> Report </h4>
   <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
   <input type="text" placeholder="Title" name="title"> <br> <br>
   <textarea name="report" rows="5" cols="40" placeholder="Write your problem about the product here"></textarea>
   <input type="hidden" name="pid1" value = "<?php echo $_POST["pid"]; ?>"> 
   <input type="hidden" name="email1" value = "<?php echo $_POST["email"]; ?>">
   <br>
   <button type="submit" class="btn btn-default w3-button w3-black w3-round-xxlarge"  name = "sr" value="Send">Send </button>
   </form>   
   <br>  
</div>
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


</script>

</body>
</html>



<?php
if (isset($_POST['sr'])) {

    $title = $_POST['title'];
    $body = $_POST['report'];
    $email = $_POST['email1'];
    $pid = $_POST['pid1'];
    $time = date("y-m-d");

    $sql = "insert into report (Title,	Body,	Time, UserEmail, productID) 
VALUES ('$title', '$body', '$time', '$email','$pid') ";
    $result = mysqli_query($con,$sql);
    if( $result ) {
        echo "<script>alert('Report is sent');</script>";
        echo "<script>window.location.replace('homepage.php')</script>";
    }
    else {
        echo "<script>alert('Report can.t be sent');</script>";
    }
}
mysqli_close($con);

?>