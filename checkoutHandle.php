<?php 
session_start();
if(!$_SESSION["useremail"]){
    header("Location: index.php");
    
    die;
    }
    include 'DBcon.php';
    include 'mail.php';
    $sql = "SELECT * FROM cart";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result);
    $confirmation_code= rand(10000,99999); // generate random code with five digits
    $userID = $row['UserID']; // the user who complete the order
    $date = date("Y/m/d"); // get today's date to make it the date of order
    $mode = "";
    
    //determine the delivary mode
    if($_SESSION['install'] == 0) { 
        $mode = 'delivary';
    }
    else {
        $mode = 'delivary and install';
    }


   $sql1 = "Select SUM(Total_Price) from cart";
    $result1 = mysqli_query($con,$sql1);
    $row1 = mysqli_fetch_array($result1);
    $cost = $row1['SUM(Total_Price)'] + 30 + $_SESSION['install']; // calculate the total cost of the order


    $sql2 = "Select SUM(Quantity) from cart";
    $result2 = mysqli_query($con,$sql2);
    $row2 = mysqli_fetch_array($result2);
    $quantity = $row2['SUM(Quantity)']; // get the total number of all products quantity

    $sql9 = "Select COUNT(ProductID) from cart";
    $result9 = mysqli_query($con,$sql9);
    $row9 = mysqli_fetch_array($result9);
    $num_product = $row9['COUNT(ProductID)']; // determine the number of ordered product (not qunatity of items)

    $sql = "insert into orders (Confirmation_code, order_status, Date, userID, delivary_mode,
    cost, order_quantity, number_of_product) 
 VALUES ('$confirmation_code', 'ordered', '$date', '$userID', ' $mode', '$cost', '$quantity',
  $num_product) "; // add the order information in the database
 
 $result = mysqli_query($con,$sql);


 $sql6 = "SELECT order_ID FROM orders where Confirmation_code = '$confirmation_code' ";
 // as the order number is auto increament, so we get here the order number by the confirmation code 
 $result6 = mysqli_query($con,$sql6);
$row6 = mysqli_fetch_array($result6);
$orderID = $row6['order_ID'];
 $sql4 = "SELECT * FROM cart";
 $result4 = mysqli_query($con,$sql4);

 
 while($row4 = mysqli_fetch_array($result4)) { // add the ordered product in the order_product table in the database
    $productID = $row4['ProductID'];
    $OPquantity = $row4['Quantity'];
    $sql5 = "insert into ordered_product (OP_OrderId, OP_ProductID, OP_quantity) 
 VALUES ('$orderID','$productID', '$OPquantity') ";
 $result5 = mysqli_query($con,$sql5);
}

$email = $_SESSION["useremail"]; // get the email of user who do the order 
$msg = 'Thank you for choosing CAP <br>
        Order number:' . $orderID . '<br>
        Confirmation code: '. $confirmation_code . '<br>
        The Captain will contact you when the order becomes ready to be delivered and installed' ;

            sendmail($email, 'Order info' , $msg);
 $sql3 = "DELETE FROM cart"; // delete the items in the cart
 $result3 = mysqli_query($con,$sql3);
 


 echo " <script> alert(\"The order is completed\"); </script>"; // message to show the current system status 
 echo "<script> window.location.replace('homepage.php'); </script>"; // back to home page
?>