<?php
// In this page we read/retrive/fetch the approved members( Customers- Details filled by agent /Admin)
// In this page we retrive Member details (Customer's Details)  and agent user as well as admin user details bcz we need to check which member is created by which user  and approved by which user.


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
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

$MemberDetails->PurchaseInvoiceId = $data->PurchaseInvoiceId;

$headers=apache_request_headers();
//var_dump($headers);
if(isset($headers['Authorization']))
$token=trim(str_replace('Bearer','',$headers['Authorization']));
$mytoken= JWT::decode($token, $SECRET_KEY, array('HS256'));
$stmt= $MemberDetails->Members_PaymentDetailsList();
$num= $stmt->rowCount();
if($num>0){

   $direct_income_arr=array();
   $direct_income_arr["records"]=array();

while($row= $stmt->fetch(PDO::FETCH_ASSOC)){
   extract($row);

   $direct_income_obj=array(
      "MemberId"=>$MemberId,
      "UserId"=>$UserId,
      "MemberName"=>$MemberName,
      "UserName"=>$UserName,
      "PlotNo"=>$PlotNo,
      "SiteId"=>$SiteId,
      "SiteTotalAmount"=>$SiteTotalAmount,
      "MemberPhone"=>$MemberPhone,
      "PurchaseAmountPaid"=>$PurchaseAmountPaid,
      "PurchaseAmountLeft"=>$PurchaseAmountLeft,
     "PurchaseInvoiceId"=>$PurchaseInvoiceId,
     "SitePurchaseAmount"=>$SitePurchaseAmount, 
     "SitePurchaseName"=>$SitePurchaseName,
     "SitePurchaseSection"=>$SitePurchaseSection,
     "SitePurchaseDepth"=>$SitePurchaseDepth,
     "SitePurchaseWidth"=>$SitePurchaseWidth,
     "SitePurchaseCorner"=>$SitePurchaseCorner,
     "SitePurchaseDiscount"=>$SitePurchaseDiscount,
     "PurchasedOn"=>$PurchasedOn
   );
   
      array_push($direct_income_arr["records"],$direct_income_obj);
   }
   // set response code - 200 OK
   http_response_code(200);
 
   // show products data in json format
   echo json_encode($direct_income_arr);
}

// no products found will be here
else{
  
   // set response code - 404 Not found
   http_response_code(404);
 
   // tell the user no products found
   echo json_encode(
       array("message" => "Member Payment List not found.")
   );
   $log_msg="Member Payment List not found. : " . basename($_SERVER['PHP_SELF']);
   logger($log_msg);
}
}
catch (Exception $e){

  if($e->getMessage() == "Expired token"){

      //echo "#################################";
  
      // set response code
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