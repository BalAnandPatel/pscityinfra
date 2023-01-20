<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get rankincconnection
include_once '../../config/database.php';
include_once '../../objects/Members.php';
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
$MembersRegistration=new members($db);
 $data=json_decode(file_get_contents("php://input"));

 
$headers=apache_request_headers();
//var_dump($headers);
if(isset($headers['Authorization']))
$token=trim(str_replace('Bearer','',$headers['Authorization']));
$mytoken= JWT::decode($token, $SECRET_KEY, array('HS256'));

//print_r($data);  
 if(
   !empty($data->UserId) && //this User id is for agent Userid.
   !empty($data->MemberName) &&
   !empty($data->MemberEmail) &&
   !empty($data->MemberPhone) &&
   !empty($data->MemberAadhar) &&
   !empty($data->MemberPAN)	
)
{
$MembersRegistration->MemberName=$data->MemberName;
$MembersRegistration->FatherName=$data->FatherName;
$MembersRegistration->MemberEmail=$data->MemberEmail;
$MembersRegistration->MemberAddress=$data->MemberAddress;
$MembersRegistration->UserId=$data->UserId;
$MembersRegistration->UserType=$data->UserType;
$MembersRegistration->Member_UserType=$data->Member_UserType;
$MembersRegistration->MemberPhone=$data->MemberPhone;
$MembersRegistration->MemberStatus=$data->MemberStatus;
$MembersRegistration->MemberAadhar=$data->MemberAadhar;
$MembersRegistration->MemberPAN=$data->MemberPAN;
$MembersRegistration->CreatedBy=$data->CreatedBy;
$MembersRegistration->CreatedOn=$data->CreatedOn;
// $MembersRegistration->ApprovedBy=$data->ApprovedBy;
// $MembersRegistration->ApprovedOn=$data->ApprovedOn;

if($MembersRegistration->users_MembersRegistration()){
   http_response_code(201);
  
   echo json_encode(array("message" => "Members Created Successfully"));
}
}
else{
   echo json_encode(array("message" => " Unable to create Members"));

$log_msg="Unable to create Members : " . basename($_SERVER['PHP_SELF']);
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