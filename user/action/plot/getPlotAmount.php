<?php
 include '../../../constant.php';
 $plot_location_name= $_GET["q"];
$url = $URL."plot/plot_amount_read.php";
$time=strtotime(date('Y-m-d H:i:s'));
$data = array( "plot_location_name" =>$plot_location_name,"status"=>1);
//print_r($data);
$postdata = json_encode($data);
$client = curl_init($url);
curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
//curl_setopt($client, CURLOPT_POST, 5);
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
$response = curl_exec($client);
$result = json_decode($response);
print_r($result);
echo "2334";
exit();

 {}

?>