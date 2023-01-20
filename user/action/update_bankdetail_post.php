<?php
//session_start();
include '../../constant.php';
//include '../include/header.php';
 $user_id=$_SESSION['login_session']->agent_id;
 $account_no= $_POST["account_no"];
 $ifsc_code= $_POST["ifsc_code"];
 $bank_name= $_POST["bank_name"];
 $branch_name= $_POST["branch_name"];
 $url = $URL."admin/agent_bank_update.php";
 $data = array("account_no" =>$account_no, "agent_id"=>$user_id, "bank_name" =>$bank_name, "branch_name" =>$branch_name, 
 "ifsc_code" =>$ifsc_code);

//print_r($data);
$postdata = json_encode($data);
$client = curl_init($url);
curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
$response = curl_exec($client);
//print_r($response);
$result = json_decode($response);
//print_r($result);
header("Location: ../agent_acount.php"); 

exit();
?>
