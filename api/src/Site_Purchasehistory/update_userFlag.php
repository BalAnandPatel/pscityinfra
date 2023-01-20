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
//print_r($SiteDetailUpdatedata);


$SitePurchaseHistory->PurchaseInvoiceId=$data->PurchaseInvoiceId;



//print_r($data)

 if(
     true
   )
   {

$SitePurchaseHistory->userFlag=$data->userFlag;
$SitePurchaseHistory->updatedOn=$data->updatedOn;
$SitePurchaseHistory->updatedBy=$data->updatedBy;
$SitePurchaseHistory->PurchaseInvoiceId=$data->PurchaseInvoiceId;
if($SitePurchaseHistory->updateDirectIncomeFlag()){

   http_response_code(201);

   echo json_encode(array("message" => "User Flag Updated Successfully"));

}
else{

   http_response_code(503);

   echo json_encode(array("message" => "Unable to Update User Flag"));

}
}
else{

http_response_code(400);

    echo json_encode(array("message" => "Unable to Update User Flag. Data is incomplete."));

 }

 ?>