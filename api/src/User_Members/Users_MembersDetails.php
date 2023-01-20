<?php
// In this page we read/retrive/fetch the approved members( Customers- Details filled by agent /Admin)
// In this page we retrive Member details (Customer's Details)  and agent user as well as admin user details bcz we need to check which member is created by which user  and approved by which user.


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
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
$database= new Database();
$db=$database->getConnection();

$Members_Details=new Members($db);
$data= json_decode(file_get_contents("php://input"));

$Members_Details->MemberId=$data->MemberId;

$headers=apache_request_headers();
//var_dump($headers);
if(isset($headers['Authorization']))
$token=trim(str_replace('Bearer','',$headers['Authorization']));
$mytoken= JWT::decode($token, $SECRET_KEY, array('HS256'));


$stmt= $Members_Details->Users_MembersDetails();
$num= $stmt->rowCount();
if($num>0){

  $User_MembersDetails_Arr=array();
  $User_MembersDetails_Arr["records"]=array();

while($row= $stmt->fetch(PDO::FETCH_ASSOC)){
   extract($row);

   $User_MembersDetails_obj=array(
      "MemberId"=>$MemberId,
      "MemberName"=>$MemberName,
      "FatherName"=>$FatherName,
      "MemberEmail"=>$MemberEmail,
      "MemberStatus"=>$MemberStatus,
      "StatusName"=>$StatusName,
     "UserRole" => $userRole,
           "MemberPhone" =>$MemberPhone,
      "MemberPAN"=>$MemberPAN,
      "MemberAadhar"=>$MemberAadhar,
      "Member_UserType"=>$Member_UserType,
      "AgentName"=>$AgentName,
      "CreatedOn"=>$CreatedOn,
      "CreatedBy"=>$CreatedBy,
      "UserId"=>$UserId,
      "ApprovedBy"=>$ApprovedBy,
      "ApprovedOn"=>$ApprovedOn,
      "MemberAddress"=>$MemberAddress

   );
   
      array_push($User_MembersDetails_Arr["records"],$User_MembersDetails_obj);
   }
   // set response code - 200 OK
   http_response_code(200);
 
   // show products data in json format
   echo json_encode($User_MembersDetails_Arr);
}
else{
  
   // set response code - 404 Not found
   http_response_code(404);
 
   // tell the user no products found
   echo json_encode(
       array("message" => "User's Members Details not found.")
   );
   $log_msg="User's Members Details not found. : " . basename($_SERVER['PHP_SELF']);
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