<?php
include '../../constant.php';
//include '../include/header.php';
 //$id="50";

 $name= $_POST["name"];
 $amount= $_POST["amount"];
 $level= $_POST["level"];
 $duration= $_POST["duration"];
 
$url = $URL."reward_award/reward.php";
$data = array( "name" =>$name, "amount" =>$amount, "level" =>$level,
"duration" =>$duration);
//print_r($data);
$postdata = json_encode($data);
$client = curl_init($url);
curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
//curl_setopt($client, CURLOPT_POST, 5);
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
$response = curl_exec($client);
//print_r($response);

$result = json_decode($response);
//print_r($result);
header('Location:../reward_list.php');
exit();

 

?>