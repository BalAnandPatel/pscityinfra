<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
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

$MemberDetails=new Members($db);
$data= json_decode(file_get_contents("php://input"));
$MemberDetails->UserId=$data->UserId;
$MemberDetails->Member_UserType=$data->Member_UserType;

$headers=apache_request_headers();
//var_dump($headers);
if(isset($headers['Authorization']))
$token=trim(str_replace('Bearer','',$headers['Authorization']));
$mytoken= JWT::decode($token, $SECRET_KEY, array('HS256'));
$stmt= $MemberDetails->User_DirectMembers_List();
$num= $stmt->rowCount();
if($num>0){

   $Users_MembersListArray=array();
   $Users_MembersListArray["records"]=array();

while($row= $stmt->fetch(PDO::FETCH_ASSOC)){
   extract($row);

   $Users_MembersList_Object=array(
      "MemberId"=>$MemberId,
      "UserId"=>$UserId,
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
      "ApprovedOn"=>$ApprovedOn,
      "ApprovedBy"=>$ApprovedBy
     
   );
   
      array_push($Users_MembersListArray["records"],$Users_MembersList_Object);
   }
   // set response code - 200 OK
   http_response_code(200);
 
   // show products data in json format
   echo json_encode($Users_MembersListArray);
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