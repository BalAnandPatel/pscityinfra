<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get rankincconnection
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
$database = new Database();
$db =  $database->getConnection();

$SiteSectionDetails=new Site_SectionDetails($db);
$data = json_decode(file_get_contents("php://input")); 
//print_r($data);

$headers=apache_request_headers();
//var_dump($headers);
if(isset($headers['Authorization']))
$token=trim(str_replace('Bearer','',$headers['Authorization']));
$mytoken= JWT::decode($token, $SECRET_KEY, array('HS256'));
if(
!empty($data->SiteName)&&
!empty($data->SiteSection)&&
!empty($data->SiteDepth)&&
!empty($data->SiteTotalArea)&&
!empty($data->SitePricePerSquareFeet)

){
$SiteSectionDetails->SiteName=$data->SiteName;
$SiteSectionDetails->SiteSection=$data->SiteSection;
$SiteSectionDetails->SiteDepth=$data->SiteDepth;
$SiteSectionDetails->SiteTotalArea=$data->SiteTotalArea;
$SiteSectionDetails->SiteCurrentAvailableArea=$data->SiteCurrentAvailableArea;
$SiteSectionDetails->SoldArea=$data->SoldArea;
$SiteSectionDetails->SitePricePerSquareFeet=$data->SitePricePerSquareFeet;
$SiteSectionDetails->SiteStatus=$data->SiteStatus;
$SiteSectionDetails->SiteCreatedBy=$data->SiteCreatedBy;
$SiteSectionDetails->SiteCreatedOn=$data->SiteCreatedOn;


//echo (" Entry details : " + $data);
if($SiteSectionDetails->Site_SectionDetailsEntry())
{

   http_response_code(201);
   echo json_encode(array("message" => "Site_Section Details Created Successfully"));

}
else{
   http_response_code(503);
   echo json_encode(array("message" =>"Unable to create Site section details"));
   $log_msg="Unable to create Site section details : " . basename($_SERVER['PHP_SELF']);
    logger($log_msg);
}
}
else{
  
   // set response code - 400 bad request
   http_response_code(400);
 
   // tell the user
   echo json_encode(array("message" => "Unable to create Site. Data is incomplete"));
   $log_msg="Unable to Create Site. Data is incomplete : " . basename($_SERVER['PHP_SELF']);
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