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

$database = new database();
$db = $database->getConnection();

$SitePurchaseHistory=new SitePurchaseHistory($db);
$sitePurchasedata=json_decode(file_get_contents("php://input"));
//print_r($sitePurchasedata);

 if(
     !empty($sitePurchasedata->PurchaseInvoiceId)&&
     !empty($sitePurchasedata->SiteId)&&
     !empty($sitePurchasedata->plotId)&&
     !empty($sitePurchasedata->plotTotalAmount)&&
     !empty($sitePurchasedata->plotAmount)&&
     !empty($sitePurchasedata->plotSectionName)&&
     !empty($sitePurchasedata->SiteName)&&
     !empty($sitePurchasedata->MemberId)&&
     !empty($sitePurchasedata->UserId)&&
     !empty($sitePurchasedata->plotWidth)&&
     !empty($sitePurchasedata->plotDepth)&&
     !empty($sitePurchasedata->leftAmount)&&
     !empty($sitePurchasedata->SitePurchaseAmount)&&
     !empty($sitePurchasedata->paymentMode)&&
     !empty($sitePurchasedata->paidAmount)
  ){

$SitePurchaseHistory->PurchaseInvoiceId=$sitePurchasedata->PurchaseInvoiceId;
$SitePurchaseHistory->SiteId=$sitePurchasedata->SiteId;
$SitePurchaseHistory->PlotNo=$sitePurchasedata->plotId;
$SitePurchaseHistory->SiteTotalAmount=$sitePurchasedata->plotAmount;
$SitePurchaseHistory->SitePurchaseSection=$sitePurchasedata->plotSectionName;
$SitePurchaseHistory->SitePurchaseName=$sitePurchasedata->SiteName;
$SitePurchaseHistory->MemberId=$sitePurchasedata->MemberId;
$SitePurchaseHistory->UserId=$sitePurchasedata->UserId;
$SitePurchaseHistory->SitePurchaseWidth=$sitePurchasedata->plotWidth;
$SitePurchaseHistory->SitePurchaseDepth=$sitePurchasedata->plotDepth;
$SitePurchaseHistory->SitePurchaseCorner=$sitePurchasedata->cornerCharge;
$SitePurchaseHistory->SitePurchaseDiscount=$sitePurchasedata->discount;
$SitePurchaseHistory->PurchaseAmountLeft=$sitePurchasedata->leftAmount;
$SitePurchaseHistory->SitePurchaseAmount=$sitePurchasedata->plotTotalAmount;
$SitePurchaseHistory->PurchasedModeId=$sitePurchasedata->paymentMode;
$SitePurchaseHistory->ReceiptNo=$sitePurchasedata->receiptNumber;
$SitePurchaseHistory->PurchaseAmountPaid=$sitePurchasedata->paidAmount;
$SitePurchaseHistory->PurchasedOn=$sitePurchasedata->PurchasedOn;
$SitePurchaseHistory->PurchasedBy=$sitePurchasedata->PurchasedBy;

if($SitePurchaseHistory->sitePurchaseDetails_Create()){

   http_response_code(201);

   echo json_encode(array("message" => "Site Purchase Details created Successfully"));

}
else{

   http_response_code(503);

   echo json_encode(array("message" => "Unable to create Site Purchase Details"));

}
}
else{

http_response_code(400);

    echo json_encode(array("message" => "Unable to create Site Purchase Details. sitePurchasedata is incomplete."));

 }

 ?>