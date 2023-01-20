<?php
include '../../constant.php';

if(isset($_POST["registration_no"])){

 $registration_no=strtoupper($_POST["registration_no"]);
 $id=$_POST["id"];
 $status=2;

 $url=$URL. "registration/reg_update_approve.php";
 $data = array("registration_no"=>$registration_no, "id"=>$id, "status"=>$status);

 //print_r($data);
 $postdata = json_encode($data);
 $result=url_encode_Decode($url,$postdata);
 //print_r($result);
 if($result->message=="Successfull"){
 header('Location:../rejected_registration_list.php');
 } 
 header('Location:../rejected_registration_list.php');
 }

 function url_encode_Decode($url,$postdata){
 $client = curl_init($url);
 curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
 $response = curl_exec($client);
 //print_r($response);
 $result = json_decode($response);
 return $result;

}

?>