<?php 
include '../../constant.php';
include '../../common/php-jwt/src/JWT.php';
include '../../common/php-jwt/src/ExpiredException.php';
include '../../common/php-jwt/src/SignatureInvalidException.php';
include '../../common/php-jwt/src/BeforeValidException.php';
use \Firebase\JWT\JWT;
try{
$token=$_SESSION['token'];
$UserId=$_SESSION['login_session']->UserId;
$Password=$_POST['Password'];
$url = $URL."Users/Update_User_Password.php";
$data = array("Password" =>$Password, "UserId" =>$UserId);

$postdata = json_encode($data);
$client = curl_init($url);
curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
curl_setopt(
    $client,
    CURLOPT_HTTPHEADER,
    array(
      'Content-Type: application/json',
      'Authorization: Bearer ' . $token
    )
  );  
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
$response = curl_exec($client);
$result = json_decode($response);
print_r($response);
print_r($result);
if ($result->message == "Access denied." && $result->error == "Expired token") {
    unset($_SESSION['login_session']);
  }  
if($result->message=="Password Updated Successfully"){
    $_SESSION['change_password_page']=$result->message;
}
header('Location:../dashboard.php');
}
catch (Exception $e){

   if($e->getMessage() == "Expired token"){

     
 // set response code
       http_response_code(401);
   
       // show error message
       echo json_encode(array(
           "message" => "Access denied.",
           "error" => $e->getMessage()
       ));

          
   } else {

       die();
       }
   }

?>