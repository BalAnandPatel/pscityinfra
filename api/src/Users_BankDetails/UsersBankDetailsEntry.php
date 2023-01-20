<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get rankincconnection
include_once '../../config/database.php';
include_once '../../objects/Users_BankDetails.php';

$database = new Database();
$db = $database->getConnection();
$UsersBankDetails=new Users_BankDetails($db);
$data=json_decode(file_get_contents("php://input"));
//print_r($data);

 if(
   !empty($data->UserId)//&&
// !empty($data->BankName)&&
// !empty($data->BranchName)&&
// !empty($data->IfscCode)
 ){
$UsersBankDetails->UserId=$data->UserId;
// $UsersBankDetails->AccountNo=$data->AccountNo;
// $UsersBankDetails->BankName=$data->BankName;
// $UsersBankDetails->BranchName=$data->BranchName;
$UsersBankDetails->CreatedBy=$data->CreatedBy;
$UsersBankDetails->CreatedOn=$data->CreatedOn;
if($UsersBankDetails->Users_BankDetailsEntry()){

   http_response_code(201);
  echo json_encode("User's Bank details created Successfully");
}
else{

   http_response_code(503);
   echo json_encode(array("message" => "Unable to Insert User's Bank details."));
}
}
else{
http_response_code(400);
    echo json_encode(array("message" => "Unable to create user's Bank details. Data is incomplete."));

 }
 ?>