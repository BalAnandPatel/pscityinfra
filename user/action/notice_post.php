<?php
include '../../constant.php';
//include '../include/header.php';
 $uid=$_SESSION['login_session']->agent_id;;
 $notice_type= $_POST["notice_type"];
 $content= $_POST["content"];
 $start_date= $_POST["start_date"];
 $end_date= $_POST["end_date"];
 $status= 1;
$url = $URL."admin/notice_create.php";
$time=strtotime(date('Y-m-d H:i:s'));
$data = array( "notice_type" =>$notice_type, "content" =>$content, "start_date" =>$start_date,
"end_date" =>$end_date, "status" =>$status, "created_on"=>$time, "created_by"=>$uid);
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
header('Location:../notice_list.php');
exit();

 

?>