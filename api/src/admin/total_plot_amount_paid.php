<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// database connection will be here

// include database and object files
include_once '../../config/database.php';
include_once '../../objects/admin.php';
include_once '../../../logger.php'; 
include_once '../../../constant.php'; 
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
$totlePlotPaidAmount = new admin($db);
  
// read products will be here
$data = json_decode(file_get_contents("php://input"));
//print_r($data);
$totlePlotPaidAmount->UserId=$data->UserId;
$totlePlotPaidAmount->UserType=$data->UserType;
 
// query products
//$SECRET_KEY="dKgLINTEL2021aN99840$@#";
//echo "****";
$headers=apache_request_headers();
//var_dump($headers);
if(isset($headers['Authorization']))
$token=trim(str_replace('Bearer','',$headers['Authorization']));
$mytoken= JWT::decode($token, $SECRET_KEY, array('HS256'));

$stmt = $totlePlotPaidAmount->readTotalPlotPaidAmount();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $totlePlotPaidAmount_arr=array();
    $totlePlotPaidAmount_arr["records"]=array();
  
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
        extract($row);
  
        $totlePlotPaidAmount_item=array(

            "totalPlotPaidAmount" => $totalPlotPaidAmount
            
        );
  
        array_push($totlePlotPaidAmount_arr["records"], $totlePlotPaidAmount_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($totlePlotPaidAmount_arr);
}
  
// no products found will be here
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "Totle plot paid amount not found")
    );
    $log_msg="No Site is find : " . basename($_SERVER['PHP_SELF']);
    logger($log_msg);
}
}
catch (Exception $e){

   if($e->getMessage() == "Expired token"){

   
       // set response code
       http_response_code(401);
   
       // show error message
       echo json_encode(array(
           "message" => "Access denied.",
           "error" => $e->getMessage()
       ));

       

   //    echo "*********************************************hello";
      header('Location: ' . $e->getMessage());
   
   } else {

       die();
       }
  }

?>