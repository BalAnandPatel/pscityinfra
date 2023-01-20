<?php
//This page is used for Approve agent list

include "../../constant.php";
$url = $URL . "Users/User_Forgot_Password.php";
$UserEmail = $_POST["UserEmail"];
$data = array("UserEmail" => $UserEmail);
//print_r($data);
$postdata = json_encode($data);
$client = curl_init($url);
curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($client, CURLOPT_POST, 5);
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
$response = curl_exec($client);
//print_r($response);
$result = json_decode($response);
print_r($result);

if (isset($result->message)) {

   $_SESSION['ForgotPassword'] = "Enter Email Address does not match!! Please enter valid email address.";
    header('Location:../index.php');
} 
else
 {
    if (!empty($result->records[0]->UserEmail)){
       $Password= $result->records[0]->UserEmail;
    }
    echo $to = $result->records[0]->UserEmail;
    echo $subject = "Reset Password";
    echo $message = "Dear Member," . "<br>". "<br>". "Your password is : " . $Password;
    "<html>
        <head>
        <title>Reset Password</title>
        </head>
        <body><p>Your Password is</p>
        </body>
        </html>";
    $headers = "MIME-Version: 1.0";
    $headers .= "Content-type:text/html;charset=UTF-8";
    $headers .= 'From: giplanand@gmail.com';
    mail($to, $subject, $message, $headers);
    $_SESSION['ForgotPassword'] = "Password sent to your email address : " .$UserEmail ;
   header('Location:../index.php'); 

}

exit();
