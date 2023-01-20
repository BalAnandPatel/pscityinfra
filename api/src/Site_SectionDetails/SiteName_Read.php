<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../../config/database.php';
include_once '../../objects/Site_SectionDetails.php';
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

$SiteSectionRead= new Site_SectionDetails($db);

$data= json_decode(file_get_contents("php://input"));
//print_r($data);

$headers=apache_request_headers();
//var_dump($headers);
// if(isset($headers['Authorization']))
// $token=trim(str_replace('Bearer','',$headers['Authorization']));
// $mytoken= JWT::decode($token, $SECRET_KEY, array('HS256'));
$stmt = $SiteSectionRead->Site_NameRead();

$num = $stmt->rowCount();
if($num>0){
$siteSection_Read_Array=array();
$siteSection_Read_Array["record"]=array();
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
extract($row);

$siteSection_Object_array=array(

 "SiteName" => $SiteName

);

 array_push($siteSection_Read_Array["record"],$siteSection_Object_array);

}

http_response_code(200);
  
// show products data in json format
echo json_encode($siteSection_Read_Array);


}
else{
    echo json_encode(array("message" =>"Unable to Read Site section details"));
    $log_msg="Unable to Read Site section details : " . basename($_SERVER['PHP_SELF']);
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
 
        
    } else {
 
        die();
        }
    }
 


?>