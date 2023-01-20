<?php
// In this page we read/retrive/fetch the approved members( Customers- Details filled by agent /Admin)
// In this page we retrive Member details (Customer's Details)  and agent user as well as admin user details bcz we need to check which member is created by which user  and approved by which user.

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get rankincconnection
include_once '../../config/database.php';
include_once '../../objects/Members_Payment.php';
$database= new Database();
$db=$database->getConnection();

$MemberDetails=new Members_Payment($db);
$data= json_decode(file_get_contents("php://input"));
//print_r($data);

$MemberDetails->MemberId=$data->MemberId;

$stmt= $MemberDetails->Total_PaymentByMemberId();
$num= $stmt->rowCount();
if($num>0){

   $direct_income_arr=array();
   $direct_income_arr["records"]=array();

while($row= $stmt->fetch(PDO::FETCH_ASSOC)){
   extract($row);

   $direct_income_obj=array(
      "MemberId"=>$MemberId,
      "PurchaseInvoiceId"=>$PurchaseInvoiceId,
      // "PurchasehistoryId"=>$PurchasehistoryId,
      "MemberName"=>$MemberName,
      "FatherName"=>$FatherName,
      "SitePricePerSquareFeet"=>$SitePricePerSquareFeet,
      "SiteId"=>$SiteId,
      "SiteName"=>$SiteName,
      "SiteSection"=>$SiteSection,
      "SoldArea"=>$SoldArea,
      "SiteDepth"=>$SiteDepth,
      "SiteTotalArea"=>$SiteTotalArea,
      "SiteTotalAmount"=>$SiteTotalAmount,
      "MemberAddress"=>$MemberAddress,
      "PlotNo"=>$PlotNo,
      "ReceiptNo"=>$ReceiptNo,
      "PurchaseModeName"=>$PurchaseModeName,
      "UserId"=>$UserId,
      "UserName"=>$UserName,
      "MemberPhone"=>$MemberPhone,
      "PurchaseAmountPaid"=>$PurchaseAmountPaid,
      "PurchaseAmountLeft"=> $PurchaseAmountLeft,
      "SitePurchaseName"=> $SitePurchaseName,
      "SitePurchaseSection"=> $SitePurchaseSection,
      "SitePurchaseDepth"=> $SitePurchaseDepth,
      "SitePurchaseWidth"=> $SitePurchaseWidth,
      "SitePurchaseCorner"=>$SitePurchaseCorner,
      "SitePurchaseDiscount"=>$SitePurchaseDiscount,
      "SitePurchaseAmount"=>$SitePurchaseAmount,
      "PurchasedOn"=>$PurchasedOn
   );
   
      array_push($direct_income_arr["records"],$direct_income_obj);
   }
   // set response code - 200 OK
   http_response_code(200);
 
   // show products data in json format
   echo json_encode($direct_income_arr);
}


?>