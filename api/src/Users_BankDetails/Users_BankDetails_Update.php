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
include_once '../../objects/Users_BankDetails.php';
  
$database = new Database();
$db =  $database->getConnection();
  
$User_Bank= new Users_BankDetails($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input")); 
//print_r($data);  
// make sure data is not empty
if(
    
    
    !empty($data->UserId) &&
    !empty($data->BankName) &&
    !empty($data->BranchName) &&
    !empty($data->IfscCode) 	
)

{
  
    // set admin_login values
   $User_Bank->UserId = $data->UserId;
    $User_Bank->BranchName = $data->BranchName;
    $User_Bank->AccountNo = $data->AccountNo;
    $User_Bank->BankName = $data->BankName;
    $User_Bank->IfscCode = $data->IfscCode;
    
    
    // $stmt=$User_Bank->validateSponsor();
      // create the rankincome
      if($User_Bank->Users_bankDetails_Update()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Acount Details Updated Successfully"));
    }
  
    // if unable to create the rankincome, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to update User's Bank."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update user's Bank. Data is incomplete."));
}
?>