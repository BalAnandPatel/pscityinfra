<?php

include '../../constant.php';
//include '../include/header.php';
 //$id="50";

 $plot_location_name= $_POST["plot_location_name"];
 

$url = $URL."plot/plot_reg_read.php";
$data = array( "plot_location_name" =>$plot_location_name);
print_r($data);
$postdata = json_encode($data);
$client = curl_init($url);
curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
//curl_setopt($client, CURLOPT_POST, 5);
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
$response = curl_exec($client);
print_r($response);

$result = json_decode($response);
print_r($result);
//header('Location:../profile.php');
exit();

 

?>