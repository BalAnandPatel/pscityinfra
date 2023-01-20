<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get rankincconnection
include_once '../../Config/database.php';
include_once '../../objects/UsersWithdrawal.php';
include_once '../../../constant.php'; 
include_once '../../../logger.php'; 
include '../../../common/php-jwt/src/JWT.php';
include '../../../common/php-jwt/src/ExpiredException.php';
include '../../../common/php-jwt/src/SignatureInvalidException.php';
include '../../../common/php-jwt/src/BeforeValidException.php';
use \Firebase\JWT\JWT;
try{
$database = new Database();
$db = $database->getConnection();
$UsersWithdrawalDetails=new UsersWithdrawal($db);
 $data=json_decode(file_get_contents("php://input"));

 $UsersWithdrawalDetails->WithdrawalId=$data->WithdrawalId;
 $UsersWithdrawalDetails->UserId=$data->UserId;
 $headers=apache_request_headers();
//var_dump($headers);
if(isset($headers['Authorization']))
$token=trim(str_replace('Bearer','',$headers['Authorization']));
$mytoken= JWT::decode($token, $SECRET_KEY, array('HS256'));


//print_r($data);  
 if(
   !empty($data->WithdrawalId) && //this User id is for agent Userid.
    !empty($data->ApprovedBy) &&
   !empty($data->ApprovedOn)	
)
{
   $UsersWithdrawalDetails->WithdrawalId=$data->WithdrawalId;
   $UsersWithdrawalDetails->UserId=$data->UserId;
   $UsersWithdrawalDetails->Remark=$data->Remark;

   $UsersWithdrawalDetails->WithdrawalStatus=$data->WithdrawalStatus;
   $UsersWithdrawalDetails->ApprovedBy=$data->ApprovedBy;
   $UsersWithdrawalDetails->ApprovedOn=$data->ApprovedOn;

if($UsersWithdrawalDetails->Users_WithdrawalUpdate()){
  
   // set response code - 201 created
   http_response_code(201);

   // tell the user
   echo json_encode(array("message" => "Users Withdrawal details updated successfully."));
}

// if unable to create the rankincome, tell the user
else{

   // set response code - 503 service unavailable
   http_response_code(503);

   // tell the user
   echo json_encode(array("message" => "Unable to update Withdrawal details ."));
   $log_msg="Unable to Updated Withdrawal details. : " . basename($_SERVER['PHP_SELF']);
logger($log_msg);
}

}
// tell the user data is incomplete
else{

// set response code - 400 bad request
http_response_code(400);

// tell the user
echo json_encode(array("message" => "Unable to Updated Withdrawal details. Data is incomplete."));
$log_msg="Unable to Updated Withdrawal details. Data is incomplete. : " . basename($_SERVER['PHP_SELF']);
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
