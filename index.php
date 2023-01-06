<?php
 
session_start();

if (isset($_SESSION["useremail"])) {
  header('Location: homepage.php');
}
else if (isset($_SESSION["useremailA"])) {
  header('Location: homepage(A).php');
}
else if (isset($_SESSION["useremailS"])) {
  header('Location: homepage(S).php');
}
else if (isset($_SESSION["useremailC"])) {
  header('Location: homepage(C).php');
}

include 'DBcon.php';


if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {
  $email = $_POST["email"];
  $psw = $_POST["psw"];

  
  $sql = "select * from admin where email =  '$email' AND  password = '$psw' ";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($result);
  $count = mysqli_num_rows($result);
  if ($count == 1 ) { // if there is one matched account
    $_SESSION["useremailA"] = $email;
    header("Location: homepage(A).php");
    exit();
  }
 
  $psw = sha1($psw); // Decrypt the password
  $sql = "select * from user where Email =  '$email' AND  Password = '$psw' ";
  $result = mysqli_query($con, $sql);
  $count = mysqli_num_rows($result);
  $row = mysqli_fetch_assoc($result);
  

  if ($count == 1 ) {  // if there is one matched account
    $_SESSION["useremail"] = $email;
    $_SESSION["userid"] = $row['UserID'];
    $sql = "DELETE FROM cart";
  $result = mysqli_query($con, $sql);
    header("Location: homepage.php");
    exit();
  }
  $sql = "select * from seller where Email =  '$email' AND  password = '$psw' ";
  $result = mysqli_query($con, $sql);
  $count = mysqli_num_rows($result);
  $row = mysqli_fetch_array($result);

  if ($count == 1 && $row['Accepted_registration'] == 1)  // if there is one matched account and the sell is accepted
  {
    $_SESSION["useremailS"] = $email; 
    $_SESSION["id"] = $row['SellerID'];
    header("Location: homepage(S).php");
    exit();
  }

    $sql = "select * from captain where email =  '$email' AND  password = '$psw' ";
  $result = mysqli_query($con, $sql);
  $count = mysqli_num_rows($result);
  $row = mysqli_fetch_array($result);
  
  if ($count == 1 && $row['Accepted_registration'] == 1) {  // if there is one matched account and the sell is accepted
    $_SESSION["CaptainID"] = $row['CaptainID'];
    $_SESSION["useremailC"] = $email;
    header("Location: homepage(C).php");
    exit();
  }
    else {
    echo " <script> alert(\"Wrong email or password\"); </script>";
    }

}
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

<!-- Modal -->


<div class="w3-row-padding w3-center w3-margin-top">

<!-- the base form-->
<form method = "POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" 
class="w3-container w3-animate-right w3-round-large w3-monospace" style=
"background-color:LightGray;
  margin-top: 10px;
  margin-bottom: 1px;
  margin-right: 400px;
  margin-left: 400px;
  border-style: groove;
  border-color: rgb(136, 0, 68);
  border-width : 10px">
  
  <h3 class = "w3-cursive">Login to CAP </h3>
  

  <div class="inputbox">
  <label for="email"><b>Email</b></label> <br>
  <input class="w3-input w3-border w3-round" type="text" placeholder="Enter Email" name="email" required>
  <br>
  <br>
</div>
<div class="inputbox">
  <label for="psw"><b>Password</b></label> <br>
  <input class="w3-input w3-border w3-round" type="password" placeholder="Enter Password" name="psw" required>

  <br>
   
</div>

  <input type="submit" class="w3-button w3-indigo w3-round w3-border w3-border-black" name = "log" value="Login"
  style = "border : 2px">
  <br> 
  <a href="selectRole.php" class="w3-hover-blue"> Create an account</a>  <br>
  <a href="forgetPassword.php" class="w3-hover-blue"> Forget your password</a>  
  <br> <br>
  </form>
  <br>  </br>
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


</script>

</body>
</html>

    
</body>
</html>

<?php
mysqli_close($con);

?>