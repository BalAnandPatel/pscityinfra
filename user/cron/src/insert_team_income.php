<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../cron/config/database.php';
include_once '../../cron/objects/income.php';
  
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$l_income = new income($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));
//print_r($data);  
// make sure data is not empty
if (

    true
    

) {

    // set admin_login values
    $l_income->UserId = $data->UserId;
    $l_income->sponsorId = $data->sponsorId;
    $l_income->parentId = $data->parentId;
    $l_income->AmountPaid = $data->AmountPaid;
    $l_income->MemberIncomeFlag = $data->MemberIncomeFlag;
   $l_income->TotalAmount=$data->TotalAmount;
    $l_income->IncomeCreatedBy = $data->IncomeCreatedBy;
    $l_income->IncomeCreatedOn = $data->IncomeCreatedOn;
    
    // create the rankincome
    if ($l_income->insert_team_income()) {

        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "team income created."));
    }

    // if unable to create the rankincome, tell the user
    else {

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "Unable to create Team Income."));
    }
}

// tell the user data is incomplete
else {

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create team income. Data is incomplete."));
}
