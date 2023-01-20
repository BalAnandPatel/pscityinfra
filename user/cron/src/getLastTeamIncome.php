<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once '../../cron/config/database.php';
include_once '../../cron/objects/income.php';
  
$database = new Database();
$db = $database->getConnection();
  
$UserDetails=new income($db);
$data = json_decode(file_get_contents("php://input"));
//print_r($data);

// we  have to retrive the Users.
$UserDetails->UserId=$data->UserId;

$stmt = $UserDetails->getPreviousTeamIncome();
// query products

$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0 ){
  
    // products array
    $Users_read_array=array();
    $Users_read_array["records"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $Users_read_Object=array(
            "UserId"=>$UserId,
            "AmountPaid"=>$AmountPaid,
            "TotalAmount"=>$TotalAmount
        );
        array_push($Users_read_array["records"], $Users_read_Object);
    }
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($Users_read_array);
}
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No previous team income found.")
    );
}


?>