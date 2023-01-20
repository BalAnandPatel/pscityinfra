<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require '../../../common/php-jwt/src/JWT.php';
require '../../../common/php-jwt/src/ExpiredException.php';
require '../../../common/php-jwt/src/SignatureInvalidException.php';
require '../../../common/php-jwt/src/BeforeValidException.php';
include_once '../../../logger.php'; 
include_once '../../../constant.php'; 

use \Firebase\JWT\JWT;
try{
$issuedat_claim = time(); // issued at
$notbefore_claim = $issuedat_claim ; //not before in seconds
$expire_claim = $issuedat_claim + 50000000; // expire time in seconds
  
// get rankincconnection
include_once '../../config/database.php';
  
// instantiate rankincobject
include_once '../../objects/Users.php';
//Database connection
$dbconnection= new Database();
$db=$dbconnection->getConnection();
//print_r($db);
$UserDetails=new Users($db);
$data = json_decode(file_get_contents("php://input"));
//print_r($data);

// we  have to retrive the Users.
$UserDetails->UserId=$data->UserId; 
$UserDetails->Password=$data->Password;

//print_r($UserDetails);
$stmt = $UserDetails->User_Read();
// query products

$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0 ){
      
    // products array
    $Users_read_array=array();
    $Users_read_array["records"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $token = array(
            "iss" => $ISSUER_CLAIM,
            "aud" => $AUDIENCE_CLAIM,
            "iat" => $issuedat_claim,
            "nbf" => $notbefore_claim,
            "exp" => $expire_claim,
            "data" =>array(
            "UserId" => $UserId,
            "UserName" => $UserName,
            "UserEmail" =>  $UserEmail,
            "Status"=>$Status,
           "userRole" =>  $userRole,
            "UserType"=>$UserType,
            "Password"=> $Password,
        ));
         // print_r($token);
         http_response_code(200);
         //echo "------";
        $jwt = JWT::encode($token, $SECRET_KEY);
         //print_r($jwt);
         
         echo json_encode(
             array(
                 "access_token" => $jwt
                                                     
             ));
    }
}
else{
    $log_msg="Login Failed : " . basename($_SERVER['PHP_SELF']);
    logger($log_msg);

    http_response_code(401);
    echo json_encode(array("message" => $LOGIN_FAILED_MSG));
}

}
catch (Exception $e){

   if($e->getMessage() == "Expired token"){

       //echo "#################################";
   
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