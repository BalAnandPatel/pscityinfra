<?php
include '../../constant.php';
//include '../include/header.php';
 $user_id=$_SESSION['login_session']->agent_id;
 $withdraw_amount= $_POST["amount"];
 $status=0;
 $url = $URL."admin/withdrawReq.php";
 $data = array("agent_id" =>$user_id, "withdraw_amount" =>$withdraw_amount, "status" =>$status);

print_r($data);
$postdata = json_encode($data);
$client = curl_init($url);
curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
$response = curl_exec($client);
print_r($response);
$result = json_decode($response);
print_r($result);
//header("Location: ../withdraw.php"); 
exit();
?>