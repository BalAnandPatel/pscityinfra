<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../../config/database.php';
include_once '../../objects/AwardReward.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$awardreward = new Awardreward($db);
  
// read products will be here
$data = json_decode(file_get_contents("php://input"));
//print_r($data);
$awardreward->AwardRewardId=$data->AwardRewardId; 

// query products
$stmt = $awardreward->AwardRewardHistryRead();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $awardreward_arr=array();
    $awardreward_arr["records"]=array();
  
       while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
       
        extract($row);
  
        $awardreward_item=array(

            "AwardRewardId" => $AwardRewardId,
            "UserId" => $UserId,
            "RewardId" => $RewardId,
            "RewardCreatedBy" => $RewardCreatedBy,
            "RewardCreatedOn" => $RewardCreatedOn
			
        );
  
        array_push($awardreward_arr["records"], $awardreward_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($awardreward_arr);
}
  
// no products found will be here
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No awardreward hisrory list found.")
    );
}
?>