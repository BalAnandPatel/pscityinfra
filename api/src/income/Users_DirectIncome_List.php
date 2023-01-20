<?php
//This page is for direct total income of agents.
//This page used by Admin. 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// get rankincconnection
include_once '../../config/database.php';
include_once '../../objects/income.php';
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

$DirectIncome=new income($db);
$data= json_decode(file_get_contents("php://input"));

$DirectIncome->UserId=$data->UserId;

$headers=apache_request_headers();
if(isset($headers['Authorization']))
$token=trim(str_replace('Bearer','',$headers['Authorization']));
$mytoken= JWT::decode($token, $SECRET_KEY, array('HS256'));

$stmt= $DirectIncome->All_User_PaymentList();
$num= $stmt->rowCount();
if($num>0){

   $direct_income_arr=array();
   $direct_income_arr["records"]=array();

while($row= $stmt->fetch(PDO::FETCH_ASSOC)){
   extract($row);

   $direct_income_obj=array(
     
      "UserId"=>$UserId,
      "UserName"=>$UserName,
      "PlotNo"=>$PlotNo,
      "SiteId"=>$SiteId,
      "Phone"=>$Phone,
     "PurchaseAmountPaid"=>$PurchaseAmountPaid,
      "AmountPaid"=>$AmountPaid,
     "PurchaseInvoiceId"=>$PurchaseInvoiceId,
     "PucrhaseHistoryId"=>$PucrhaseHistoryId,
     "PurchaseModeId"=>$PurchaseModeId,
     "IncomeCreatedOn"=>$IncomeCreatedOn,
     "SitePurchaseName"=>$SitePurchaseName,
     "SitePurchaseSection"=>$SitePurchaseSection,
     "SitePurchaseDepth"=>$SitePurchaseDepth,
     "SitePurchaseWidth"=>$SitePurchaseWidth,
     "SitePurchaseCorner"=>$SitePurchaseCorner,
     "SitePurchaseDiscount"=>$SitePurchaseDiscount,
     "SitePurchaseAmount"=>$SitePurchaseAmount,
     "SiteTotalAmount"=>$SiteTotalAmount,

   );
   
      array_push($direct_income_arr["records"],$direct_income_obj);
   }
   // set response code - 200 OK
   http_response_code(200);
 
   // show products data in json format
   echo json_encode($direct_income_arr);
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