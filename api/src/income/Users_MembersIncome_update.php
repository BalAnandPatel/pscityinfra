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
include_once '../../objects/income.php';
  
$database = new Database();
$db = $database->getConnection();
  
$m_income= new income($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
$m_income->MembersIncomeId = $data->MembersIncomeId; 
//print_r($data);  
// make sure data is not empty
if(
    !empty($data->UserId) &&
    !empty($data->MemberId) &&
    !empty($data->AmountPaid) &&
    !empty($data->Commission)  
	
)

{
  
    // set admin_login values
    $m_income->UserId = $data->UserId;
    $m_income->MemberId = $data->MemberId;
    $m_income->AmountPaid = $data->AmountPaid;
    $m_income->AmountLeft = $data->AmountLeft;
    $m_income->Commission = $data->Commission;
    
  
    // create the rankincome
    if($m_income->MemberIncomeUpdate()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Member Income Upadate."));
    }
  
    // if unable to create the rankincome, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to Member Income Upadate."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to Family Income Upadate. Data is incomplete."));
}
?>