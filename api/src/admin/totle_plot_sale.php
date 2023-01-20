<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// database connection will be here

// include database and object files
include_once '../../config/database.php';
include_once '../../../constant.php'; 
include_once '../../objects/admin.php';
include_once '../../../logger.php'; 
include '../../../common/php-jwt/src/JWT.php';
include '../../../common/php-jwt/src/ExpiredException.php';
include '../../../common/php-jwt/src/SignatureInvalidException.php';
include '../../../common/php-jwt/src/BeforeValidException.php';
use \Firebase\JWT\JWT;
// instantiate database and product object
try{
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$agentPlotCount = new admin($db);
  
// read products will be here
$data = json_decode(file_get_contents("php://input"));
//print_r($data);
$agentPlotCount->UserId=$data->UserId;
$agentPlotCount->UserType=$data->UserType; 

$headers=apache_request_headers();
//var_dump($headers);
if(isset($headers['Authorization']))
$token=trim(str_replace('Bearer','',$headers['Authorization']));
$mytoken= JWT::decode($token, $SECRET_KEY, array('HS256'));

// query products
$stmt = $agentPlotCount->agentPlotCount();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $agentPlotCount_arr=array();
    $agentPlotCount_arr["records"]=array();
  
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
       
        extract($row);
        
        $agentPlotCount_item=array(
            
            "totalPlot" => $totalPlot
            
        );
  
        array_push($agentPlotCount_arr["records"], $agentPlotCount_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($agentPlotCount_arr);
}
  
// no products found will be here
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No totle Plot sale found.")
    );
    $log_msg="No Plot found : " . basename($_SERVER['PHP_SELF']);
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

       

       //echo "*********************************************hello";
      header('Location: ' . $e->getMessage());
   
   } else {

       die();
       }
   }

?>