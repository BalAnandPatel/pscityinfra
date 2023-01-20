<?php
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
//Database connection
$dbconnection= new Database();
$db=$dbconnection->getConnection();
$UserDetails=new Users($db);
$data = json_decode(file_get_contents("php://input"));
// we  have to retrive the Users.
$UserDetails->sponsorId= $data->sponsorId; 
$headers=apache_request_headers();
//var_dump($headers);
if(isset($headers['Authorization']))
$token=trim(str_replace('Bearer','',$headers['Authorization']));
$mytoken= JWT::decode($token, $SECRET_KEY, array('HS256'));

$stmt = $UserDetails->user_sponsor_parent_details();

$num = $stmt->rowCount();

if($num>0 ){
  
    // products array
    $Users_read_array=array();
    $Users_read_array["records"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $Users_read_Object=array(
            "UserId" => $UserId,
            "sponsorId"=>$sponsorId,
            "parentId"=>$parentId,
            "UserName" => $UserName,
            "UserEmail" =>  $UserEmail,
            "AadharNo" =>  $AadharNo,
            "PanNo" =>  $PanNo,
           "userRole" =>  $userRole,
            "UserType"=>$UserType,
            "UserDOB" =>  $UserDOB,
            "Password"=> $Password,
            "CreatedBy"=>$CreatedBy,
            "CreatedOn"=>$CreatedOn,
            "Password"=>$Password,
            "Status"=>$Status,
            "Address"=>$Address
        );
        array_push($Users_read_array["records"], $Users_read_Object);
    }
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($Users_read_array);
}

  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "User sponsor and parent details not found. Data is incomplete."));
    $log_msg="User sponsor and parent details not found. Data is incomplete. : " . basename($_SERVER['PHP_SELF']);
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
