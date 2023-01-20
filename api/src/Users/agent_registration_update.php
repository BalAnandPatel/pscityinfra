<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get rankincconnection
include_once '../../config/database.php';
// instantiate rankincobject
include_once '../../objects/admin.php';
  
$database = new Database();
$db = $database->getConnection();
  
$agent_reg= new admin($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
$agent_reg->agent_id=$data->agent_id;
//print_r($data);  
// make sure data is not empty
if(
    !empty($data->agent_id)&&
    !empty($data->father_name) &&
    !empty($data->dob) &&
    !empty($data->address) &&
    !empty($data->updated_on) &&
    !empty($data->updated_by)  
	
)

{
  
    // set admin_login values
    $agent_reg->agent_id = $data->agent_id;
    $agent_reg->father_name = $data->father_name;
    $agent_reg->dob = $data->dob;
    $agent_reg->address = $data->address;
    $agent_reg->updated_on = $data->updated_on;
    $agent_reg->updated_by = $data->updated_by;
    
  
    // create the rankincome
    if($agent_reg->agent_update()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "agent update."));
    }
  
    // if unable to create the rankincome, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to agent update ."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to agent update. Data is incomplete."));
}
?>