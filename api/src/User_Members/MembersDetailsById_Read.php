<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../../config/database.php';
include_once '../../objects/Members.php';

try{ 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$MemberDetais = new Members($db);
  
// read products will be here
$data = json_decode(file_get_contents("php://input"));
//print_r($data);
$MemberDetais->MemberId=$_POST['MemberId']; 

$stmt = $MemberDetais->MembersDetailsById();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $MemberDetais_arr=array();
    $MemberDetais_arr["records"]=array();
  
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
        extract($row);
        
        $MemberDetais_item=array(

            "MemberId" => $MemberId,
            "MemberName" => $MemberName,
            "FatherName" => $FatherName,
            "MemberPhone" => $MemberPhone,
            "MemberAddress" => $MemberAddress
			
        );
  
        array_push($MemberDetais_arr["records"], $MemberDetais_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($MemberDetais_arr);
}
  
// no products found will be here
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "User's Members Details  by ID not found.")
    );
    $log_msg="User's Members Details  by ID not found: " . basename($_SERVER['PHP_SELF']);
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