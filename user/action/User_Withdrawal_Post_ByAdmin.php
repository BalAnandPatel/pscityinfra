<?php
include '../../constant.php';
//include '../include/header.php';
$token=$_SESSION['token'];
$UserId=$_SESSION['login_session']->UserId;
 $WithdrawalId=$_POST['WithdrawalId'];
$UserID=$_POST['UserId'];
if (isset($_POST['actionApprove'])) {
    $WithdrawalStatus= 1;
  } else {
    $WithdrawalStatus= 2;
  }
  $Remark=$_POST['Remark'];
  if($Remark==""){
   if($WithdrawalStatus==1){
    $Remark="Approved";
   }else{
    $Remark="Rejected";
   }
  }
$url_update_withdrawal_status=$URL."Users_Withdrawal/Users_WithdrawalUpdate.php";
$data=array("WithdrawalStatus" =>$WithdrawalStatus,"UserId"=>$UserID,"Remark"=>$Remark, "WithdrawalId"=>$WithdrawalId,"ApprovedBy"=>$_SESSION['login_session']->UserId,"ApprovedOn"=>strtotime(date('Y-m-d H:i:s')));
//print_r($data);
$postdata = json_encode($data);
$client = curl_init($url_update_withdrawal_status);
curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
curl_setopt($client,CURLOPT_HTTPHEADER,
    array(
      'Content-Type: application/json',
      'Authorization: Bearer'. $token
    )
  );
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
$response = curl_exec($client);
//print_r($response);
$result = json_decode($response);
//print_r($result);

if($result->message="Users Withdrawal details updated successfully."){
$_SESSION["withdrawal"]=$result->message;
header("Location: ../User_Withdrawal_List_For_Admin.php"); 
}
else{
  $_SESSION["withdrawal"]="Unable to update withdrawal request.";
header("Location: ../User_Withdrawal_List_For_Admin.php"); 
}
// exit();
?>