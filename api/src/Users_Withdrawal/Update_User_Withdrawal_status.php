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

$database = new Database();
$db = $database->getConnection();
$UsersWithdrawalDetails=new UsersWithdrawal($db);
 $data=json_decode(file_get_contents("php://input"));

 $UsersWithdrawalDetails->WithdrawalId=$data->WithdrawalId;
 $UsersWithdrawalDetails->UserId=$data->UserId;
 
//print_r($data);  
 if(
   !empty($data->WithdrawalId) //this User id is for agent Userid.
   
)
{
   $UsersWithdrawalDetails->WithdrawalId=$data->WithdrawalId;
   $UsersWithdrawalDetails->WithdrawalStatus=$data->WithdrawalStatus;

if($UsersWithdrawalDetails->Update_User_Withdrawal_Status()){
  
   // set response code - 201 created
   http_response_code(201);

   // tell the user
   echo json_encode(array("message" => "Users Withdrawal details updated.."));
}

// if unable to create the rankincome, tell the user
else{

   // set response code - 503 service unavailable
   http_response_code(503);

   // tell the user
   echo json_encode(array("message" => "Unable to update Withdrawal details ."));
}

}
// tell the user data is incomplete
else{

// set response code - 400 bad request
http_response_code(400);

// tell the user
echo json_encode(array("message" => "Unable to Updated Withdrawal details. Data is incomplete."));
}

?>