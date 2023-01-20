<?php
include '../../constant.php';
//include '../include/header.php';
//$UserId=$_SESSION['login_session']->UserId;
$WithdrawalId=$_POST['WithdrawalId'];
$UserID=$_POST['UserId'];
$WithdrawalStatus=0;
$url_update_withdrawal_status=$URL."Users_Withdrawal/Update_User_Withdrawal_status.php";
$data=array("WithdrawalStatus" =>$WithdrawalStatus,"UserId"=>$UserID,"WithdrawalId"=>$WithdrawalId);
//print_r($data);
$postdata = json_encode($data);
$client = curl_init($url_update_withdrawal_status);
curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
$response = curl_exec($client);
//print_r($response);
$result = json_decode($response);
//print_r($result);
header("Location: ../User_Withdrawal.php"); 
// exit();
?>