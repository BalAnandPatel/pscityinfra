<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get rankincconnection
include_once '../../config/database.php';
include_once '../../objects/Users.php';

include_once '../../../constant.php'; 
include_once '../../../logger.php'; 
include '../../../common/php-jwt/src/JWT.php';
include '../../../common/php-jwt/src/ExpiredException.php';
include '../../../common/php-jwt/src/SignatureInvalidException.php';
include '../../../common/php-jwt/src/BeforeValidException.php';
use \Firebase\JWT\JWT;
try{  
$database = new Database();
$db =  $database->getConnection();
  
$user_reg= new Users($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input")); 
$headers=apache_request_headers();
//var_dump($headers);
if(isset($headers['Authorization']))
$token=trim(str_replace('Bearer','',$headers['Authorization']));
$mytoken= JWT::decode($token, $SECRET_KEY, array('HS256'));

if(
    
    !empty($data->UserName) &&
    !empty($data->UserEmail) &&
    !empty($data->Phone) &&
    !empty($data->PanNo) &&
    !empty($data->AadharNo) 	
)

{
  
    // set admin_login values
    $user_reg->UserName = $data->UserName;
    $user_reg->sponsorId = $data->sponsorId;
    $user_reg->parentId = $data->parentId;
    $user_reg->position = $data->position;
    $user_reg->UserEmail = $data->UserEmail;
    $user_reg->Phone = $data->Phone;
    $user_reg->PanNo = $data->PanNo;
    $user_reg->AadharNo = $data->AadharNo;
    $user_reg->UserDOB = $data->UserDOB;
    $user_reg->Password = $data->Password;
   // $user_reg->PasswordHistory=$data->PasswordHistory;
     $user_reg->Address = $data->Address;
     $user_reg->CreatedOn = $data->CreatedOn;
     $user_reg->CreatedBy = $data->CreatedBy;
     $user_reg->Status = $data->Status;
     $user_reg->UserType = $data->UserType;
    
    // $stmt=$user_reg->validateSponsor();
      // create the rankincome
      if($user_reg->Users_Registration()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "User Created Successfully"));
    }
  
    // if unable to create the rankincome, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create User."));
        $log_msg="Unable to create user. : " . basename($_SERVER['PHP_SELF']);
    logger($log_msg);
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create customer. Data is incomplete."));
    $log_msg="Unable to read user. Data is incomplete. : " . basename($_SERVER['PHP_SELF']);
    logger($log_msg);
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
