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
  
$d_income= new Income($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
//print_r($data);  

// make sure data is not empty
if(
    !empty($data->PucrhaseHistoryId) &&
    !empty($data->PurchaseInvoiceId) &&
    !empty($data->ReceiptNo) &&
    !empty($data->UserId) &&
    !empty($data->paidAmount) &&
    !empty($data->PlotPaidAmount) &&
    !empty($data->DirectIncomeFlag) &&
    !empty($data->parentId) &&
    !empty($data->sponsorId) 
   
)
{
  
    // set admin_login values
    $d_income->PucrhaseHistoryId = $data->PucrhaseHistoryId;
    $d_income->PurchaseInvoiceId = $data->PurchaseInvoiceId;
    $d_income->ReceiptNo = $data->ReceiptNo;
    $d_income->PurchaseModeId = $data->PurchaseModeId;
    $d_income->UserId = $data->UserId;
    $d_income->MemberId = $data->MemberId;
    $d_income->AmountPaid = $data->paidAmount;
    $d_income->PlotPaidAmount = $data->PlotPaidAmount;
    $d_income->DirectIncomeFlag = $data->DirectIncomeFlag;
    $d_income->parentId = $data->parentId;
    $d_income->sponsorId = $data->sponsorId;
    $d_income->IncomeCreatedBy = $data->IncomeCreatedBy;
    $d_income->IncomeCreatedOn = $data->IncomeCreatedOn;
    
  
    // create the rankincome
    if($d_income->DirectIncomeCreate()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Direct income created Succssfully."));
    }
  
    // if unable to create the rankincome, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create directincome."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to directincome customer. Data is incomplete."));
}
?>