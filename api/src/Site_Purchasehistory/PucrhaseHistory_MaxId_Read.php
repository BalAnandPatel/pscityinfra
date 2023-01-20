<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../../config/database.php';
include_once '../../objects/Site_Purchasehistory.php';
include_once '../../../constant.php'; 
include_once '../../../logger.php'; 
include '../../../common/php-jwt/src/JWT.php';
include '../../../common/php-jwt/src/ExpiredException.php';
include '../../../common/php-jwt/src/SignatureInvalidException.php';
include '../../../common/php-jwt/src/BeforeValidException.php';
use \Firebase\JWT\JWT;
try{
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$PurchaseHistory_MaxId = new SitePurchaseHistory($db);
  
// read products will be here
$data = json_decode(file_get_contents("php://input"));
//print_r($data);
//$PurchaseHistory_MaxId->MemberId=$_POST['MemberId']; 

$headers=apache_request_headers();
//var_dump($headers);
if(isset($headers['Authorization']))
$token=trim(str_replace('Bearer','',$headers['Authorization']));
$mytoken= JWT::decode($token, $SECRET_KEY, array('HS256'));
// query products
$stmt = $PurchaseHistory_MaxId->PucrhaseHistory_MaxId();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $PurchaseHistory_MaxId_arr=array();
    $PurchaseHistory_MaxId_arr["records"]=array();
  
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
        extract($row);
        
        $PurchaseHistory_MaxId_item=array(

            "PurchaseHistoryId" => $PurchaseHistoryId
			
        );
  
        array_push($PurchaseHistory_MaxId_arr["records"], $PurchaseHistory_MaxId_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($PurchaseHistory_MaxId_arr);
}
  
// no products found will be here
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "SitePurchaseHistory max id not found.")
    );
    $log_msg="Site Purchase History max id not found : " . basename($_SERVER['PHP_SELF']);
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