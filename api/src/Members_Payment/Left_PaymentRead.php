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
include_once '../../../constant.php'; 
include_once '../../../logger.php'; 
include '../../../common/php-jwt/src/JWT.php';
include '../../../common/php-jwt/src/ExpiredException.php';
include '../../../common/php-jwt/src/SignatureInvalidException.php';
include '../../../common/php-jwt/src/BeforeValidException.php';
use \Firebase\JWT\JWT;
try{

$database= new Database();
$db=$database->getConnection();

$MemberDetails=new Members_Payment($db);
$data= json_decode(file_get_contents("php://input"));
//print_r($data);

$MemberDetails->PurchaseInvoiceId=$data->PurchaseInvoiceId;
// $MemberDetails->SiteId=$data->SiteId;
// $MemberDetails->PlotNo=$data->PlotNo;

$headers=apache_request_headers();
//var_dump($headers);
if(isset($headers['Authorization']))
$token=trim(str_replace('Bearer','',$headers['Authorization']));
$mytoken= JWT::decode($token, $SECRET_KEY, array('HS256'));
$stmt= $MemberDetails->Left_PaymentByMemberId();
$num= $stmt->rowCount();
if($num>0){

   $direct_income_arr=array();
   $direct_income_arr["records"]=array();

while($row= $stmt->fetch(PDO::FETCH_ASSOC)){
   extract($row);
//print_r($row);
   $direct_income_obj=array(

      "MemberId"=>$MemberId,
      "PurchaseInvoiceId"=>$PurchaseInvoiceId,
      "MemberName"=>$MemberName,
      "FatherName"=>$FatherName,
      "SitePricePerSquareFeet"=>$SitePricePerSquareFeet,
      "SiteId"=>$SiteId,
      // "PurchasehistoryId"=>$PurchasehistoryId,
      "SiteName"=>$SiteName,
      "SiteSection"=>$SiteSection,
      "SitePurchaseSection"=>$SitePurchaseSection,
      "parentId"=>$parentId,
      "sponsorId"=>$sponsorId,
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
else{
  
   // set response code - 404 Not found
   http_response_code(404);
 
   // tell the user no products found
   echo json_encode(
       array("message" => "Purchase Invoice Details not found.")
   );
}
}
catch (Exception $e){

   if($e->getMessage() == "Expired token"){

       http_response_code(401);
   
       // show error message
       echo json_encode(array(
           "message" => "Access denied.",
           "error" => $e->getMessage()
       ));
   } else {

       die();
       }
   }

?>
