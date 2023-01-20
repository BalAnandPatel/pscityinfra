<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// database connection will be here

// include database and object files
include_once '../../config/database.php';
include_once '../../../constant.php'; 
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
$agent_count = new admin($db);
  
// read products will be here
$data = json_decode(file_get_contents("php://input"));
$agent_count->userId=$data->UserId;
$agent_count->UserType=$data->UserType;
//print_r($data);
// query products

//echo "****";
$headers=apache_request_headers();
//var_dump($headers);
if(isset($headers['Authorization']))
$token=trim(str_replace('Bearer','',$headers['Authorization']));
$mytoken= JWT::decode($token, $SECRET_KEY, array('HS256'));

$stmt = $agent_count->agentCount();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $agent_count_arr=array();
    $agent_count_arr["records"]=array();
  
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
        extract($row);
  
        $agent_count_item=array(
            "agent_count" => $agent_count
        );
  
        array_push($agent_count_arr["records"], $agent_count_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($agent_count_arr);
}
  
// no products found will be here
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "agent count not found")
    );
    $log_msg="No Site is find : " . basename($_SERVER['PHP_SELF']);
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