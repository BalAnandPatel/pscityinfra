<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get rankincconnection
include_once '../../Config/database.php';
  
// instantiate rankincobject
include_once '../../objects/UsersWithdrawal.php';
  
$database = new Database();
$db =  $database->getConnection();
  
$WithdrawalDetails= new UsersWithdrawal($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input")); 
//print_r($data);  
// make sure data is not empty
if(
  true 
)
{
    $WithdrawalDetails->WithdrawalAmount = $data->WithdrawalAmount;
    $WithdrawalDetails->TDS = $data->TDS;
    $WithdrawalDetails->AdminCharges = $data->AdminCharges;
    $WithdrawalDetails->TotalWithdrawalAmount = $data->TotalWithdrawalAmount;
    $WithdrawalDetails->WithdrawalStatus = $data->WithdrawalStatus;
    $WithdrawalDetails->CreatedBy = $data->CreatedBy;
    $WithdrawalDetails->CreatedOn = $data->CreatedOn;
    
   // echo "before method";
      if($WithdrawalDetails->Users_WithdrawalCreate()){
        // set response code - 201 createds
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "User Withdrawal create Successfully"));
    }
  
    // if unable to create the rankincome, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create Withdrawal ."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create user withdrawal. Data is incomplete."));
}


?>