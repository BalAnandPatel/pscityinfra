<?php
 include "../../constant.php";
 $user_id=$_SESSION['login_session']->agent_id;
 $address= $_POST["address"];
 $father_name= $_POST["father_name"];
 $dob= $_POST["dob"];
 $url = $URL."admin/agent_registration_update.php";
 echo $time=strtotime(date('Y-m-d H:i:s'));
 $data = array( "address" =>$address, "father_name" =>$father_name, "dob" =>$dob, "updated_on" =>$time,
  "updated_by" =>$user_id, "agent_id" =>$user_id,);
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
header('Location:../profile.php');
exit();

?>