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
$SiteDetailUpdatedata=json_decode(file_get_contents("php://input"));
//print_r($SiteDetailUpdatedata);

$SitePurchaseHistory->SiteId=$SiteDetailUpdatedata->SiteId;
$SitePurchaseHistory->PlotNo=$SiteDetailUpdatedata->PlotNo;
$SitePurchaseHistory->PurchaseInvoiceId=$SiteDetailUpdatedata->PurchaseInvoiceId;



//print_r($data)

 if(
     !empty($SiteDetailUpdatedata->PurchaseAmountPaid)
   )
   {
$SitePurchaseHistory->PurchaseAmountLeft=$SiteDetailUpdatedata->PurchaseAmountLeft;
$SitePurchaseHistory->PurchaseAmountPaid=$SiteDetailUpdatedata->PurchaseAmountPaid;
$SitePurchaseHistory->UpdatedOn=$SiteDetailUpdatedata->UpdatedOn;
$SitePurchaseHistory->UpdatedBy=$SiteDetailUpdatedata->UpdatedBy;
$SitePurchaseHistory->PurchaseInvoiceId=$SiteDetailUpdatedata->PurchaseInvoiceId;
$SitePurchaseHistory->SiteId=$SiteDetailUpdatedata->SiteId;
$SitePurchaseHistory->PlotNo=$SiteDetailUpdatedata->PlotNo;

if($SitePurchaseHistory->sitePurchaseDetails_Update()){

   http_response_code(201);

   echo json_encode(array("message" => "Site Purchase Details Updated Successfully"));

}
else{

   http_response_code(503);

   echo json_encode(array("message" => "Unable to Update Site Purchase Details"));

}
}
else{

http_response_code(400);

    echo json_encode(array("message" => "Unable to Update Site Purchase Details. Data is incomplete."));

 }

 ?>