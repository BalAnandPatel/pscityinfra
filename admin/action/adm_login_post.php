<?php
session_start();
include '../../constant.php';
include '../../common/php-jwt/src/JWT.php';
include '../../common/php-jwt/src/ExpiredException.php';
include '../../common/php-jwt/src/SignatureInvalidException.php';
include '../../common/php-jwt/src/BeforeValidException.php';


use \Firebase\JWT\JWT;
$pwd= $_POST["password"]; 
$email= $_POST["email"];
$url = $URL."admin_login/admin_login.php";
$data = array( "password" =>$pwd, "email" =>$email);
//print_r($data);
$postdata = json_encode($data);
$client = curl_init($url);

curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($client, CURLOPT_CONNECTTIMEOUT, 0); 
curl_setopt($client, CURLOPT_TIMEOUT, 4); //timeout in seconds
curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
$response = curl_exec($client);
curl_close($client);
//print_r($response);

$decode = (json_decode($response));

 
 //print_r($result);
if(!isset($result->data->message)){

$result = JWT::decode($decode->access_token, $SECRET_KEY, array('HS256'));

 $uid=$result->data->id;
 $name=$result->data->full_name;

 $_SESSION["ID"]=$uid;
 $_SESSION["EMAIL"]=$email;
 $_SESSION["NAME"]=$name;
 $_SESSION["JWT"]=$result;
 $_SESSION['MEMBBER_FROM']=$result->data->created_on;
 //print_r($_SESSION['SPONSOR_ID']);

 header('Location:../adm_dashboard.php');
} else
{
header('Location:../index.php?msg='.$result->message);
}

function giplCurl($api,$postdata){
   $url = $api; 
   $client = curl_init($url);
    curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
    $response = curl_exec($client);
  //  print_r($response);
    return $result = json_decode($response);
}

?>