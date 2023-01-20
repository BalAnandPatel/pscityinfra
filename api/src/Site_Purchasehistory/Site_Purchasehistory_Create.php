<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get rankincconnection
include_once '../../config/database.php';
include_once '../../objects/Site_Purchasehistory.php';

$database = new Database();
$db = $database->getConnection();

$SitePurchaseHistory=new SitePurchaseHistory($db);
$data=json_decode(file_get_contents("php://input"));
//print_r($data);

 if(

  !empty($data->PurchaseInvoiceId) 
  ){

$SitePurchaseHistory->PurchaseInvoiceId=$data->PurchaseInvoiceId;
$SitePurchaseHistory->SiteId=$data->SiteId;
$SitePurchaseHistory->PlotNo=$data->plotId;
$SitePurchaseHistory->SiteTotalAmount=$data->plotAmount;
$SitePurchaseHistory->SitePurchaseSection=$data->plotSectionName;
$SitePurchaseHistory->SitePurchaseName=$data->SiteName;
$SitePurchaseHistory->MemberId=$data->MemberId;
$SitePurchaseHistory->UserId=$data->UserId;
$SitePurchaseHistory->parentId=$data->parentId;
$SitePurchaseHistory->sponsorId=$data->sponsorId;
$SitePurchaseHistory->userFlag=$data->userFlag;
$SitePurchaseHistory->teamFlag=$data->teamFlag;
$SitePurchaseHistory->SitePurchaseWidth=$data->plotWidth;
$SitePurchaseHistory->SitePurchaseDepth=$data->plotDepth;
$SitePurchaseHistory->SitePurchaseCorner=$data->cornerCharge;
$SitePurchaseHistory->SitePurchaseDiscount=$data->discount;
$SitePurchaseHistory->PurchaseAmountLeft=$data->leftAmount;
$SitePurchaseHistory->SitePurchaseAmount=$data->plotTotalAmount;
$SitePurchaseHistory->PurchasedModeId=$data->paymentMode;
$SitePurchaseHistory->ReceiptNo=$data->receiptNumber;
$SitePurchaseHistory->PurchaseAmountPaid=$data->paidAmount;
$SitePurchaseHistory->PurchasedOn=$data->PurchasedOn;
$SitePurchaseHistory->PurchasedBy=$data->PurchasedBy;

if($SitePurchaseHistory->SitePurchaseHistory_Create()){

   http_response_code(201);

   echo json_encode(array("message" => "Site Purchase History created Successfully"));

}
else{

   http_response_code(503);

   echo json_encode(array("message" => "Unable to create Site Purchase History."));

}
}
else{

http_response_code(400);

    echo json_encode(array("message" => "Unable to create Site Purchase History. Data is incomplete."));

 }

 ?>