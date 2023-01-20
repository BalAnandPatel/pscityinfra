<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// database connection will be here

// include database and object files
include_once '../../config/database.php';
include_once '../../objects/Members_Payment.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$members_paid_amount = new Members_Payment($db);
  
// read products will be here
$data = json_decode(file_get_contents("php://input"));
$members_paid_amount->UserId=$data->UserId;
$members_paid_amount->PlotNo=$data->PlotNo; 
$members_paid_amount->MemberId=$data->MemberId;

// query products
$stmt = $members_paid_amount->membersTotalPaidAmount();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $members_paid_amount_arr=array();
    $members_paid_amount_arr["records"]=array();
  
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
        extract($row);
  
        $members_paid_amount_item=array(
            "PurchaseAmountPaid" => $PurchaseAmountPaid			
        );
  
        array_push($members_paid_amount_arr["records"], $members_paid_amount_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($members_paid_amount_arr);
}
  
// no products found will be here
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "Members Paid Amount not found.")
    );
}
?>