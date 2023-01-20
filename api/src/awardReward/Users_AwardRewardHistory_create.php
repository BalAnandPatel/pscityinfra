<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get customer registration
include_once '../../config/database.php';
  
// instantiate customer registration
include_once '../../objects/AwardReward.php';
  
$database = new Database();
$db = $database->getConnection();
  
$awardreward= new Awardreward($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
//print_r($data);  

// make sure data is not empty
if(
     !empty($data->UserId) &&
     !empty($data->RewardId) &&
     !empty($data->RewardCreatedBy) &&
     !empty($data->RewardCreatedOn) 
   
)
{
  
    // set admin_login values
    $awardreward->UserId = $data->UserId;
    $awardreward->RewardId = $data->RewardId;
    $awardreward->RewardCreatedBy = $data->RewardCreatedBy;
    $awardreward->RewardCreatedOn = $data->RewardCreatedOn;
    
  
    // create the rankincome
    if($awardreward->AwardRewardHistryCreate()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "AwardReward histry created Succssfully."));
    }
  
    // if unable to create the rankincome, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create AwardReward histry."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create AwardReward histry. Data is incomplete."));
}
?>