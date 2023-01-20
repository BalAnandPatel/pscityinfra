<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// include database and object files
include_once '../../config/database.php';
include_once '../../objects/Site_SectionDetails.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$Site_SectionDetails = new Site_SectionDetails($db);
$data= json_decode(file_get_contents("php://input"));
//print_r($data);
  
// read products will be here
 $Site_SectionDetails->SiteName=$_POST['Site_location_name'];
 $Site_SectionDetails->SiteSection=$_POST['SiteSection'];

// query products

if($Site_SectionDetails->SiteSection=="NONE"){

    $stmt = $Site_SectionDetails->Site_SectionRead();
    $num = $stmt->rowCount();

 }else{

     $stmt = $Site_SectionDetails->Read_Site_SectionDepth();
     $num = $stmt->rowCount();

 }


// check if more than 0 record found
if($num>0){
  
    // products array
    $Site_SectionDetails_arr=array();
    $Site_SectionDetails_arr["records"]=array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      extract($row);

      $Site_SectionDetails_item=array(
           "SiteId"=>$SiteId,
           "SiteSection" => $SiteSection,      
           "SiteDepth"=>$SiteDepth,
           "SitepricePerSquareFeet"=>$SitepricePerSquareFeet,   
           "SiteTotalArea"=>$SiteTotalArea,
           "SiteCurrentAvailableArea"=>$SiteCurrentAvailableArea,
           "SoldArea"=>$SoldArea
      );

      array_push($Site_SectionDetails_arr["records"], $Site_SectionDetails_item);
  }

  // set response code - 200 OK
  http_response_code(200);

  // show products data in json format
  echo json_encode($Site_SectionDetails_arr);
}

// no products found will be here
else{

  // set response code - 404 Not found
  http_response_code(404);

  // tell the user no products found
  echo json_encode(
      array("message" => "No Site Section Found.")
  );
}
?>