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
$awardreward->AwardRewardId = $data->AwardRewardId; 
//print_r($data);

// make sure data is not empty
if(

    !empty($data->UserId) &&
    !empty($data->RewardId) 
)

{
  
    // set admin_login values
    $awardreward->UserId = $data->UserId;
    $awardreward->RewardId = $data->RewardId;
  
    // create the rankincome
    if($awardreward->AwardRewardHistryUpdate()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Award reward hostry Update."));
    }
  
    // if unable to create the rankincome, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to Update Award reward hostry ."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to Update Award reward hostry. Data is incomplete."));
}
?>