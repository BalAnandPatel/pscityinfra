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
include_once '../../objects/Members_Payment.php';
include_once '../../../constant.php'; 
include_once '../../../logger.php'; 
include '../../../common/php-jwt/src/JWT.php';
include '../../../common/php-jwt/src/ExpiredException.php';
include '../../../common/php-jwt/src/SignatureInvalidException.php';
include '../../../common/php-jwt/src/BeforeValidException.php';
use \Firebase\JWT\JWT;
try{
$database = new Database();
$db = $database->getConnection();
  
$members_payment= new Members_Payment($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input")); 
//print_r($data);

// make sure data is not empty
if(

     !empty($data->agentId) && 	
     !empty($data->MemberId) &&
     !empty($data->PlotNo) &&
     !empty($data->SiteId) &&
     !empty($data->SitePurchaseSection) &&
     !empty($data->SiteTotalAmount) &&
     !empty($data->SitePurchaseName) &&
     !empty($data->SitePurchaseWidth) &&
     !empty($data->SitePurchaseDepth) &&	
     !empty($data->SitePurchaseAmount) &&	
     !empty($data->PurchasedModeId) &&	
     !empty($data->receiptNumber) &&	
     !empty($data->PurchaseAmountPaid) &&	
     !empty($data->PurchaseAmountLeft) 
)

{
  
    // set admin_login values
    $members_payment->UserId = $data->agentId;
    $members_payment->MemberId = $data->MemberId;
    $members_payment->PlotNo = $data->PlotNo;
    $members_payment->SiteId = $data->SiteId;
    $members_payment->parentId = $data->parentId;
    $members_payment->sponsorId = $data->sponsorId;
    $members_payment->SitePurchaseSection = $data->SitePurchaseSection;
    $members_payment->SiteTotalAmount = $data->SiteTotalAmount;
    $members_payment->SitePurchaseName = $data->SitePurchaseName;
    $members_payment->SitePurchaseWidth = $data->SitePurchaseWidth;
    $members_payment->SitePurchaseDepth = $data->SitePurchaseDepth;
    $members_payment->SitePurchaseCorner = $data->SitePurchaseCorner;
    $members_payment->SitePurchaseDiscount = $data->SitePurchaseDiscount;
    $members_payment->SitePurchaseAmount = $data->SitePurchaseAmount;
    $members_payment->PurchaseAmountPaid = $data->PurchaseAmountPaid;
    $members_payment->PurchaseAmountLeft = $data->PurchaseAmountLeft;
    $members_payment->PurchaseInvoiceId = $data->PurchaseInvoiceId;
    $members_payment->userFlag = $data->userFlag;
    $members_payment->teamFlag = $data->teamFlag;
    $members_payment->PurchasedModeId = $data->PurchasedModeId;
    $members_payment->ReceiptNo = $data->receiptNumber;
    $members_payment->PurchasedOn = $data->updatedOn;
    $members_payment->PurchasedBy = $data->updatedBy;
  
    // create the rankincome
    if($members_payment->membersPaymentHistryCreate()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Member payment hisrty created successfully."));
    }
  
    // if unable to create the rankincome, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create Member payment hisrty"));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create Member payment hisrty. Data is incomplete."));
    $log_msg="Unable to create Member payment hisrty. Data is incomplete : " . basename($_SERVER['PHP_SELF']);
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