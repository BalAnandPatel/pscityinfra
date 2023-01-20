<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get customer registration
include_once '../../cron/config/database.php';
// instantiate customer registration
include_once '../../cron/objects/income.php';
  
$database = new Database();
$db = $database->getConnection();
  
$d_income= new income($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
//print_r($data);  

// make sure data is not empty
if(true
   
   
)
{
  
    // set admin_login values
    $d_income->WithdrawalAmount = $data->WithdrawalAmount;
    $d_income->AmountAfterCharges = $data->AmountAfterCharges;
    $d_income->AdminCharges = $data->AdminCharges;
    $d_income->TDS = $data->TDS;
    $d_income->UserId = $data->UserId;
    $d_income->DirectIncome = $data->DirectIncome;
    $d_income->TeamIncome = $data->TeamIncome;
    $d_income->WithdrawalStatus = $data->WithdrawalStatus;
    $d_income->CreatedBy = $data->CreatedBy;
    $d_income->CreatedOn = $data->CreatedOn;
    
  
    // create the rankincome
    if($d_income->insertUsersWithdrawal()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Users Withdrawal created Succssfully."));
    }
  
    // if unable to create the rankincome, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create Users Withdrawal."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to  create Users Withdrawal . Data is incomplete."));
}
?>