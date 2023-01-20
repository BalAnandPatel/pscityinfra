<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get rankincconnection
include_once '../../config/database.php';
// include_once '../../../logger.php';
include_once '../../../constant.php';
// instantiate rankincobject
include_once '../../objects/Users.php';
// include '../../../common/php-jwt/src/JWT.php';
// include '../../../common/php-jwt/src/ExpiredException.php';
// include '../../../common/php-jwt/src/SignatureInvalidException.php';
// include '../../../common/php-jwt/src/BeforeValidException.php';
// use \Firebase\JWT\JWT;
try{  
$database = new Database();
$db = $database->getConnection();
  
$updaete_user_password= new Users($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
$updaete_user_password->UserId=$data->UserId;
$updaete_user_password->Password=$data->Password;
     
//      $headers=apache_request_headers();
//     if(isset($headers['Authorization']))
//    $token=trim(str_replace('Bearer','',$headers['Authorization']));
//     $mytoken= JWT::decode($token, $SECRET_KEY, array('HS256'));

if(
    
    !empty($data->Password) &&
    !empty($data->UserId)
   
)

{
  
     $updaete_user_password->Password = $data->Password;
    $updaete_user_password->UserId = $data->UserId;

    
    
    // create the rankincome
    if($updaete_user_password->updateUserPassword()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Password Updated Successfully"));
    }
  
    
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to change password"));
        $log_msg="Unable to updated password : " . basename($_SERVER['PHP_SELF']);
    logger($log_msg);
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to change Updated. Plese chack api"));
    $log_msg="Unable to password Updated. Data is incomplete : " . basename($_SERVER['PHP_SELF']);
    logger($log_msg);
}
}
catch (Exception $e){

   if($e->getMessage() == "Expired token"){
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