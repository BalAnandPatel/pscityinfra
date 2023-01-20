<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get rankincconnection
include_once '../../cron/config/database.php';
// instantiate rankincobject
include_once '../../cron/objects/income.php';
  
$database = new Database();
$db = $database->getConnection();
  
$userFlagDetails= new income($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
$userFlagDetails->PucrhaseHistoryId=$data->PucrhaseHistoryId;

//print_r($data);  
// make sure data is not empty
if(
    !empty($data->Status)
)

{
  
    // set admin_login values
    $userFlagDetails->userFlag = $data->userFlag;
    $userFlagDetails->PurchaseUpdatedBy = $data->PurchaseUpdatedBy;
    $userFlagDetails->PurchaseUpdatedOn = $data->PurchaseUpdatedOn;
    $userFlagDetails->PucrhaseHistoryId = $data->PucrhaseHistoryId;
    
  
    // create the rankincome
    if($userFlagDetails->updateUserFlag()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "user list updated."));
    }
  
    // if unable to create the rankincome, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to update user list."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update user list. Data is incomplete."));
}
?>