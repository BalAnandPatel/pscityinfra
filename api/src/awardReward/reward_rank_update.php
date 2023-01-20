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
$awardreward->RewardId = $data->RewardId; 
//print_r($data);

// make sure data is not empty
if(

      !empty($data->AwardName) &&	
      !empty($data->RewardAccessories) &&	
      !empty($data->RewardDuration) &&
      !empty($data->RankPercentage) &&	
      !empty($data->FamilSupportBonus) &&
      !empty($data->RewardStatus) 
)

{
  
    // set admin_login values
    $awardreward->AwardName = $data->AwardName;
    $awardreward->RewardAccessories = $data->RewardAccessories;
    $awardreward->AmountUpto = $data->AmountUpto;
    $awardreward->RewardDuration = $data->RewardDuration;
    $awardreward->RankPercentage = $data->RankPercentage;
    $awardreward->FamilSupportBonus = $data->FamilSupportBonus;
    $awardreward->RewardStatus = $data->RewardStatus;
  
    // create the rankincome
    if($awardreward->AwardRankUpdate()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Award rank table Update."));
    }
  
    // if unable to create the rankincome, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to Update award rank table ."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to Update award rank table. Data is incomplete."));
}
?>