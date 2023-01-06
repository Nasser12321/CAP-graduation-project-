<?php
session_start();
if(!$_SESSION["useremailA"]){
header("Location: index.php");

die;
}
?>

<?php
 include 'DBcon.php';

 if (isset($_POST['done'])) {
 
    $rid = $_POST['rid'];
    $sql = "DELETE FROM report WHERE ReportID = '$rid'";
    $result = mysqli_query($con, $sql);
    echo " <script> alert(\"The report is reviewed\"); </script>";
 }


  ?>
<!DOCTYPE html>
<html>
<head>
<title>Reports</title>
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

//$uid = $_SESSION['userid'];
 $sql = "Select * from report, product WHERE ID = productID";
 $result = mysqli_query($con,$sql);
 if (mysqli_num_rows($result) == 0 ) {
    echo " <script> alert(\"There are no reports\"); </script>";
    echo "<script> window.location.replace('homepage(A).php'); </script>";
  } 
  else {
    while ($row = mysqli_fetch_array($result)) {
    echo "

   
    <div class=' w3-container w3-pale-red w3-card-4 '>
    <div class='w3-border w3-border-green  w3-round-xxlarge w3-card w3-container w3-animate-zoom w3-white' style='min-height:230px; margin : 30px'>
    <img src = '" . $row['Image'].  "' alt = '". $row['Name'] . " image' 
    style = 'width:200px; height : 200px' class='w3-left w3-bar-item w3-circle w3-hide-small'> 
    <br>
    <span style = 'font-size : 20px; font-family : Monospace'>Prodcut Name:" .$row['Name']. " </span>
    <br>  <br>
    <span style = 'font-size : 20px; font-family : Monospace'>Product ID: " .$row['productID']. " </span>
    <br>  <br>
    <span style = 'font-size : 20px; font-family : Monospace'>Title: " .$row['Title']. " </span>
    <br>  <br>
    <span style = 'font-size : 20px; font-family : Monospace'>" .$row['Body']. " </span>
    <br>  <br>
    <span class = 'w3-middle' style = 'font-size : 20px; font-family : Monospace; margin-left : 220px'>Date: " .$row['Time']. " </span>
    <br>  <br>
    <form action = 'viewReport.php' method = 'POST'>
    <input name = 'pid2' type = 'hidden' value = '" .$row['productID'] ."' >
    <input name = 'rid' type = 'hidden' value = '" .$row['ReportID'] ."' >
    <button class = 'w3-button w3-orange'  name = 'done'  style = ' font-family : Fantasy;  height : 40px; font-size : 17px; width : 100px; border : 2px solid black; border-radius : 15px;'> DONE </button>
    </form> 
    <br> 
  
    <br>
  
    <br> <br>
    </div> 
    </div>"
        ; 
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
