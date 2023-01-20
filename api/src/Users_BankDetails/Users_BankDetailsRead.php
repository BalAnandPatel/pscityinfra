<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get rankincconnection
include_once '../../config/database.php';
// instantiate rankincobject
include_once '../../objects/Users_BankDetails.php';

//Database connection
$dbconnection= new Database();
$db=$dbconnection->getConnection();
$UserDetailsRead= new Users_BankDetails($db);
$data = json_decode(file_get_contents("php://input"));
//print_r($data);
// we  have to retrive the Users.
$UserDetailsRead->UserId=$data->UserId;

$stmt=$UserDetailsRead->users_BankdetailsRead();
  $num= $stmt->rowCount();
if($num>0){

$Users_BankReadArray=array();
$Users_BankReadArray["records"]= array();

   while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
extract($row);

 $Users_BankDetails_ReadObj=array(
"UserName"=>$UserName,
"UserEmail"=>$UserEmail,
"sponsorId"=>$sponsorId,
"UserDOB"=>$UserDOB,
"Address"=>$Address,
"UserRole"=>$userRole,
 "UserType"=> $UserType,
 "UserCreatedOn"=>$CreatedOn,
 "UserAadharNo"=>$AadharNo,
 "UserPanNo"=>$PanNo,
 "BankId"=>$BankId,
 "BankName"=>$BankName,
 "BranchName"=>$BranchName,
 "IfscCode"=>$IfscCode,
 "AccountNo"=>$AccountNo,
 "Phone"=>$Phone,
 "PanNo"=>$PanNo,
 "AadharNo"=>$AadharNo,
 "CreatedBy"=>$CreatedBy
);
array_push($Users_BankReadArray["records"], $Users_BankDetails_ReadObj);
   }
   http_response_code(200);
  
   echo json_encode($Users_BankReadArray);

}


?>