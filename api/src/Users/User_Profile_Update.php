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
  
$User_Profile_update= new Users($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input")); 

$headers=apache_request_headers();
//var_dump($headers);
if(isset($headers['Authorization']))
$token=trim(str_replace('Bearer','',$headers['Authorization']));
$mytoken= JWT::decode($token, $SECRET_KEY, array('HS256'));

if(
    
    
    !empty($data->UserEmail) &&
    !empty($data->Phone) &&
    !empty($data->PanNo) &&
    !empty($data->AadharNo) 	
)

{
  
    // set admin_login values
   $User_Profile_update->UserId = $data->UserId;
    $User_Profile_update->UserName = $data->UserName;
    $User_Profile_update->UserEmail = $data->UserEmail;
    $User_Profile_update->Phone = $data->Phone;
    $User_Profile_update->PanNo = $data->PanNo;
    $User_Profile_update->AadharNo = $data->AadharNo;
    $User_Profile_update->UserDOB = $data->UserDOB;
    $User_Profile_update->Password = $data->Password;
   // $User_Profile_update->PasswordHistory=$data->PasswordHistory;
     $User_Profile_update->Address = $data->Address;
    $User_Profile_update->CreatedOn = $data->CreatedOn;
   $User_Profile_update->CreatedBy = $data->CreatedBy;
   $User_Profile_update->Status = $data->Status;
   $User_Profile_update->UserType = $data->UserType;
       $User_Profile_update->UpdatedBy = $data->UpdatedBy;
     $User_Profile_update->UpdatedOn = $data->UpdatedOn;
    
    // $stmt=$User_Profile_update->validateSponsor();
      // create the rankincome
      if($User_Profile_update->User_Profile_Update()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "User Profile Updated Successfully"));
    }
  
    // if unable to create the rankincome, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to update User."));
        $log_msg="Unable to update user. : " . basename($_SERVER['PHP_SELF']);
        logger($log_msg);
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update user. Data is incomplete."));
    $log_msg="Unable to update user. Data is incomplete. : " . basename($_SERVER['PHP_SELF']);
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
