<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer\src\Exception.php';
require 'PHPMailer\src\PHPMailer.php';
require 'PHPMailer\src\SMTP.php';


function sendmail($reciever, $subject, $msg) {
    $mail = new PHPMailer(true);
try {

    $mail->isSMTP();                                      
    $mail->Host       = 'smtp.gmail.com';               
    $mail->SMTPAuth   = true;                                  
    $mail->Username   = 'caracessoriesx@gmail.com';                     
    $mail->Password   = 'iomxtotcihdpuneg';                              
    $mail->SMTPSecure = 'ssl';            
    $mail->Port       = 465;                                   

    $mail->setFrom('caracessoriesx@gmail.com', 'CAP');
    $mail->addAddress($reciever);    
        




    //$mail->addAttachment('/var/tmp/file.tar.gz');         


    $mail->isHTML(true);                                 
    $mail->Subject = $subject;
    $mail->Body    = $msg;
   

    $mail->send();
   // echo "<script>alert('Message is sent to your mail');</script>";
} catch (Exception $e) {
        echo 'Failed to send message';
}

}