<?php
session_start();
if(!$_SESSION["useremailC"]){
header("Location: index.php");

die;
}
?>

<?php
 include 'DBcon.php';

  ?>
<!DOCTYPE html>
<html>
<head>
<title>Captain home page</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-deep-orange.css">
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
  <a href="homepage(C).php" class="w3-bar-item w3-button w3-padding-16 w3-cursive">Home</a>
  <a href="Account(C).php" class="w3-bar-item w3-button w3-padding-16 w3-cursive">Account</a>
  
  
  
  <br>

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



  <div class="w3-card w3-container" style="min-height:460px">
  <h2>Profile</h2>
  
	<form action="Account(C).php" method="post" 
  class="w3-container w3-animate-right w3-round-large w3-monospace w3-pale-red" style=
" margin-top: 10px;
  margin-bottom: 1px;
  margin-right: 400px;
  margin-left: 400px;
  border-style: groove;
  border-color: rgb(136, 0, 68);
  border-width : 10px">
		<?php 
		
		$sql = "SELECT * FROM captain WHERE Email='{$_SESSION["useremailC"]}'";
		$result = mysqli_query($con, $sql);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
		?>
		<div class="inputbox">
    <label for="password">Name</label> <br>
			<input type="text" id="name" name="name" placeholder="Name" value="<?php echo $row['Captain_name']; ?>" required>
		</div>
		<div class="inputbox">
    <label for="password">Email</label> <br>
			<input type="email" id="email" name="email" placeholder="Email Address" value="<?php echo $row['Email']; ?>" required>
		</div>
    <div class="inputbox">
			<label for="phone_number">Phone Number</label> <br>
			<input type="tel" id="password" name="phone" placeholder="Phone number" value="<?php echo $row['phone_number']; ?>" required>
		</div>
		<div class="inputbox">
			<label for="password">Password</label> <br>
			<input type="password" id="password" name="password" placeholder="Password"  required>
		</div>
		<div class="inputbox">
			<label for="cpassword">Confirm Password</label> <br>
			<input type="password" id="cpassword" name="cpassword" placeholder="Confirm Password"required>
      <br> <br  >

      
	
     

		<div>
			<button type="submit" name="submit" class="w3-button w3-light-green w3-round">Update Profile</button>
      <br> <br>

     
		</div>
    </form>

    <br> <br>
    </div>
		<?php
			}
		}
		
		?>
   

  <br> <br>
</div>

<?php

if (isset($_POST["submit"])) {
	$name = mysqli_real_escape_string($con, $_POST["name"]);
	$email = mysqli_real_escape_string($con, $_POST["email"]);
  $phone = mysqli_real_escape_string($con, $_POST["phone"]);
	$password = mysqli_real_escape_string($con, $_POST["password"]);
	$cpassword = mysqli_real_escape_string($con, $_POST["cpassword"]);
	if ($password == $cpassword) {
    $password = sha1($password);
		$sql = "UPDATE captain SET Captain_name='$name', Email='$email', password='$password',
    phone_number = '$phone'
     WHERE Email = '{$_SESSION["useremailC"]}'";
		$result = mysqli_query($con, $sql);
		if ($result) {
			echo "<script>alert('Profile updated successfully.');</script>";
		} else {
			echo "<script>alert('Profile can not updated.');</script>";
		}

	} else {
		echo "<script>alert('Password not matched. Please try again.');</script>";
	}
  echo "<script>window.location.replace('homepage(C).php')</script>";   
}
mysqli_close($con);
?>
</div>

</div>
<hr>


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
