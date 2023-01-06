<?php
session_start();
include 'DBcon.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>CAP</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
<script src = "jquery-3.6.0.min.js"> </script>
<style>
 button.pass1:hover {
    background-color: white;
}
</style>

 <!-----google-maps----->
 <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBkvy8bboVBvvh7Lld5u5bCrGc7MgPYrMo"></script>
        <script type="text/javascript" src="assets/js/Googlemap.js"></script>

</head>


<body>

<div class="w3-container " >



<!-- Header -->
<header class="w3-container w3-theme w3-padding " id="myHeader">
 
  <div class="w3-center" style = "margin-top : 10px;">

   <img src="images\logo5.jpg" class="w3-circle" style="margin-top: 50px; ">


    <div class="w3-padding-32">
      
    </div>
  </div>
</header>

<div class="w3-row-padding w3-center w3-margin-top">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="POST"
class="w3-container w3-animate-right w3-round-large w3-monospace" style=
"background-color:LightGray;
  margin-top: 10px;
  margin-bottom: 1px;
  margin-right: 400px;
  margin-left: 400px;
  border-style: groove;
  border-color: rgb(136, 0, 68);
  border-width : 10px">
    <h3 class = "w3-cursive"> Register </h3>
    <div class="inputbox">
  <label for="name"><b>Name</b></label> <br>
  <input class="w3-input w3-border w3-round" type="text" placeholder="Enter name" name="name" required>
   <br>
   <br>
</div>
    <div class="inputbox">
  <label for="email"><b>Email</b></label> <br>
  <input class="w3-input w3-border w3-round" type="email" placeholder="Enter Email" name="email" required>
  <br>
  <br>
</div>
<div class="inputbox">
  <label for="psw"><b>Password</b></label> <br>
  <input class="w3-input w3-border w3-round" type="password" placeholder="Enter Password" name="psw" required>
   <br>
   <br>
</div>
<div class="inputbox">
  <label for="phone"><b>Phone number</b></label> <br>
  <input class="w3-input w3-border w3-round" type="text" placeholder="Enter Phone number"
   name="phone" required>
   <br>
   <br>
</div>

<div>
     <!-----google-maps----->
  <label for="location"><b>Location</b></label>
  <br>
  <br>
<input type="hidden" id="latitude" name="lat">
<input type="hidden" id="longitude" name="lng">

<div id="map" style="height: 500px"></div>

<br>
</div>

<!-----google-maps----->
  <input type="submit" class="w3-button w3-indigo w3-round w3-border w3-border-black" name = "reg"
   value="Register"
  style = " border : 2px">
  <br> <br>
  </form>
  <br> <br>
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

    
</body>
</html>

</body>
 <?php
 if(isset($_POST['reg'])) 

 {
 
  $name = $_POST['name'];
  $email = $_POST['email'];
  $psw = $_POST['psw'];
  $phn = $_POST['phone'];
  $lat = $_POST['lat'];
  $lng = $_POST['lng'];
  
$sql2 = "select * from user where Email = '$email' ";
$result2 = mysqli_query($con, $sql2);
$count = mysqli_num_rows($result2);
if ($count == 1) { //if the email already registered
    echo " <script> alert(\"This email is already registered in the system\"); </script>"; // message
    echo "<script> window.location.replace('index.php'); </script>"; // back to log in page
}

else {
 if (strlen($psw) < 4 ) {
   echo "<script> alert(\"number of alphanumeric for password must be more than 4\"); </script>";
 }
 else if ($lat > 24.971320 || $lat < 24.526383 || $lng > 46.843450 || $lng < 46.564269) {
  echo "<script> alert(\"The location is out of CAP boundaries\"); </script>";
 }
 else {
  $psw = sha1($psw);
 $sql = "insert into user (user_name,	Email,	Password, phone_number,latitude,longitude) 
 VALUES ( '$name', '$email', '$psw', '$phn','$lat','$lng') ";
 
 $result = mysqli_query($con,$sql);
 if ( !$result ) {
   echo "<script>alert(\"email is already used\");</script>";
 }
 else {
  echo "<script>alert(\"You registered successfully\");</script>";
  echo "<script> window.location.replace('index.php'); </script>";
 }
 
 }
 }
}
 mysqli_close($con);
 ?>
</html>
