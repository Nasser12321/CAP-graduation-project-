<?php

session_start();
if(!$_SESSION["useremailS"]){
header("Location: index.php");

die;
}
include 'DBcon.php';
$pid = $_POST['pid'];
if (isset($_POST["edit"])) {
    
	$name =mysqli_real_escape_string($con, $_POST['name']);
 $price =mysqli_real_escape_string($con, $_POST['price']);
 $description = mysqli_real_escape_string($con, $_POST['description']);
 $quantity = mysqli_real_escape_string($con, $_POST['quantity']);
 if($price <= 0 || $quantity <= 0) {
  echo " <script> alert(\"Wrong inputs\"); </script>";
  echo "<script> window.location.replace('homepage(S).php'); </script>";
  exit();
}
else {
		$sql = "UPDATE product SET 
    Name='$name', Price='$price', Description='$description' , Item_Quantity = '$quantity' 
     WHERE ID = '$pid'";

		$result = mysqli_query($con, $sql);
		if ($result) {
			echo "<script>alert('Product updated successfully.');</script>";
      echo "<script> window.location.replace('homepage(S).php'); </script>";
		} else {
			echo "<script>alert('Product can not updated.');</script>";
		}	
  }
}

if (isset($_POST["editImage"])) {
  $image = $_FILES['image']['name'];
 $imageTmp = $_FILES['image']['tmp_name'];
 $imageError = $_FILES['image']['error'];
 $imageSize = $_FILES['image']['size'];
 $imageExt = explode('.', $image);
$imageActualExt = strtolower(end($imageExt)); 
$allowed = array('jpg', 'jpeg', 'png');

if(in_array($imageActualExt,$allowed) && $imageError === 0 && $imageSize < 1000000) {
  $imageNewName =  uniqid('',true) . "." . $imageActualExt;
  $imageDestenation = 'images/' . $imageNewName;
  move_uploaded_file($imageTmp, $imageDestenation);
  
$sql = "UPDATE product SET image ='images/$imageNewName' WHERE ID = '$pid'";
$result = mysqli_query($con,$sql);
if ($result) {
echo "<script> alert(\" The image is changed successfully \")</script>";
echo "<script> window.location.replace('homepage(S).php'); </script>";
}
else {
  echo "<script> alert(\" Image failed to be changed \")</script>";
}
} else {
  echo "<script> alert(\"Wrong inputs\")</script>";
}

}

if (isset($_POST["discount"])) {
  $price =mysqli_real_escape_string($con, $_POST['price']);
  $oldprice =mysqli_real_escape_string($con, $_POST['oldprice']);
  if($price <= 0 || $price >= 100 ) {
    echo " <script> alert(\"Wrong inputs\"); </script>";
    echo "<script> window.location.replace('homepage(S).php'); </script>";
    exit();
  }
  else {
    $sql = "UPDATE product SET Price= Price - (Price * ('$price'/100)) WHERE ID = '$pid'";
     $result = mysqli_query($con, $sql);
     if ($result) {
       echo "<script>alert('Discount is given successfully');</script>";
       echo "<script> window.location.replace('homepage(S).php'); </script>";
     } else {
       echo "<script>alert('Discount can not be given');</script>";
     }	
   }
  }

?>


<!DOCTYPE html>
<html>
<head>
<title> Edit product </title>
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
  <a href="addItem.php" class="w3-bar-item w3-button w3-padding-16 w3-cursive">new item</a>
  
  <br>
  <form class="navbar-form navbar-left" action= "homepage(S).php" method="POST">
				  <span class="form-group">
					<input type="text" class="form-control" placeholder="Search" name="search" style="color: black;">
</span>

				 <span> <button type="submit" class="btn btn-default" style="background-color: white;" name = "srch"><i class="fa fa-search" ></i></button> </span>
				  
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



  <div class="w3-card w3-container" style="min-height:460px">

  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="container" method="POST">
  <?php 
		
		$sql = "SELECT * FROM product WHERE ID ='$pid' ";

		$result = mysqli_query($con, $sql);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
		?> 
  <h1>Edit the Item</h1>
    
    <div id="empty" style="color: red;"></div>

    <label for="name"><b>Name</b></label>
    <br>
    <input type="text" placeholder="Enter Name" name="name" id = "name" value="<?php echo $row['Name']; ?>" required>
    <br>
    <!--check of the price type in database (number or text)-->
    <label for="price"><b>Price</b></label>
    <br>
    <input type="text" placeholder="Enter Price" name="price" id = "price" value="<?php echo $row['Price']; ?>" required>
    <br>
    <label for="description"><b>Description</b></label>
    <br>
    <input type="text" placeholder="Enter Description" name="description" id = "description" value="<?php echo $row['Description']; ?>">
    <br>
    <label for="quantity"><b>Quantity</b></label>
    <br>
    <input type="number" placeholder="Enter Quantity" name="quantity" id = "quantity" value="<?php echo $row['Item_Quantity']; ?>" required>
    <br>
    <input name = 'pid' id = 'pid1' type = 'hidden' value = "<?php echo $pid; ?>">
    <br>
    <button type="submit" class="w3-button w3-red w3-round-xxlarge w3-border w3-border-black" name = "edit" id = "sub" onclick="check">Edit</button>


  </form>
</div>


</div>

</div>
<hr>


<div class="w3-row-padding w3-center w3-margin-top">
<div class="w3-card w3-container" style="min-height:200px">
<h1>Change image</h1> <br>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="container" method="POST"
enctype="multipart/form-data">
<label for="image"><b>New Image</b></label>
    <br>
    <input type="file" name="image" id = "image" required>
    <input name = 'pid' id = 'pid1' type = 'hidden' value = "<?php echo $pid; ?>">
    <button type="submit" class="w3-button w3-blue w3-round-xxlarge w3-border w3-border-black" name = "editImage"  onclick="check">Change Image</button>
  </form>
</div>
</div>
<hr>

<div class="w3-row-padding w3-center w3-margin-top">
<div class="w3-card w3-container" style="min-height:200px">

<h1>Discount</h1> <br>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="container" method="POST">
<label for="discount"><b>For giving a discount for this product</b></label>
    <br>
    <input type="text" placeholder="Enter the percent of discount" name="price" id = "price" required>
    <input name = 'pid' id = 'pid1' type = 'hidden' value = "<?php echo $pid; ?>">
    <input type="hidden"  name="oldprice" id = "price" value="<?php echo $row['Price']; ?>">
    <button type="submit" class="w3-button w3-orange w3-round-xxlarge w3-border w3-border-black" name = "discount"  onclick="check">Set</button>
  </form>
</div>
</div>
<hr>
<br>
<?php
			}
		}
		
		
		?>
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

mysqli_close($con);
?>