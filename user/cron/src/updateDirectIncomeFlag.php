<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once '../../cron/config/database.php';
include_once '../../cron/objects/income.php';
  
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$customer_payment_update = new income($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
//$customer_payment_update->agent_id=$data->agent_id;
$customer_payment_update->IncomeCreatedOn=$data->IncomeCreatedOn;    
$customer_payment_update->DirectIncomeFlag=$data->DirectIncomeFlag;  

//print_r($data);  
// make sure data is not empty
if(
   true 
	
)

{
  
    // set admin_login values
    $customer_payment_update->DirectIncomeFlag = $data->DirectIncomeFlag;
    $customer_payment_update->IncomeCreatedOn = $data->IncomeCreatedOn;

    $customer_payment_update->updatedOn = $data->updatedOn;
    $customer_payment_update->updatedBy = $data->updatedBy;
    
  
    // create the rankincome
    if($customer_payment_update->updateDirectIncomeFlag()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Direct Income flag updated."));
    }
  
    // if unable to create the purchage_plot, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to update Direct Income Flag."));
        $log_msg="Unable to plot update : " . basename($_SERVER['PHP_SELF']);
        logger($log_msg);
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to flag update. Data is incomplete."));
}
?>