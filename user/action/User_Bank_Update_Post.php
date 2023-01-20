<?php
//session_start();
include '../../constant.php';
//include '../include/header.php';
 $UserId=$_SESSION['login_session']->UserId;
 $AccountNo= $_POST["AccountNo"];
 $IfscCode= $_POST["IfscCode"];
 $BankName= ucwords($_POST["BankName"]);
 $BranchName= ucwords($_POST["BranchName"]);
 $url = $URL."Users_BankDetails/Users_BankDetails_Update.php";
 $data = array("AccountNo" =>$AccountNo, "IfscCode"=>$IfscCode, "BankName" =>$BankName, "BranchName" =>$BranchName, 
 "UserId" =>$UserId);

//print_r($data);
$postdata = json_encode($data);
$client = curl_init($url);
curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
$response = curl_exec($client);
//print_r($response);
$result = json_decode($response);
//print_r($result);
if($result->message="Acount Details Updated Successfully"){
    $_SESSION["acount_update"]=$result->message;
    header("Location: ../User_Bank_Update.php"); 
}
exit();
?>
