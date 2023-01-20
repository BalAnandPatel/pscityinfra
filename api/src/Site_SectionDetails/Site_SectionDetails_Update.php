<?php
//required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../../config/database.php';
  
// instantiate site_sectiondetails object
include_once '../../objects/Site_SectionDetails.php';
include_once '../../../logger.php';
include '../../../constant.php';
include '../../common/php-jwt/src/JWT.php';
include '../../common/php-jwt/src/ExpiredException.php';
include '../../common/php-jwt/src/SignatureInvalidException.php';
include '../../common/php-jwt/src/BeforeValidException.php';
use \Firebase\JWT\JWT;
try{  
$database = new Database();
$db = $database->getConnection();
  
$site_sectiondetails = new Site_SectionDetails($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
//print_r($data);

// set ID property of site_sectiondetailss to be edited
$site_sectiondetails->SiteId = $data->SiteId;

if(
    !empty($data->plotAvailableArea) &&
    !empty($data->SiteUpdatedOn) &&
    !empty($data->SiteUpdatedBy) 
)
{
    $site_sectiondetails->SiteCurrentAvailableArea = $data->plotAvailableArea;
    $site_sectiondetails->SoldArea = $data->plotTotalProposedArea;
    $site_sectiondetails->SiteCurrentAvailableArea = $data->plotAvailableArea;
    $site_sectiondetails->SiteUpdatedOn = $data->SiteUpdatedOn;
    $site_sectiondetails->SiteUpdatedBy = $data->SiteUpdatedBy;

    if($site_sectiondetails->Site_SectionDetailsUpdate()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => " site_sectiondetails table has been Updated "));
    }
    // if unable to create the site_sectiondetails, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to update site_sectiondetails table Please check api"));
        $log_msg="Unable to update site_sectiondetails.: " . basename($_SERVER['PHP_SELF']);
        logger($log_msg);
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update site_sectiondetails. Data is incomplete."));
    $log_msg="Unable to update site_sectiondetails. Data is incomplete. : " . basename($_SERVER['PHP_SELF']);
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