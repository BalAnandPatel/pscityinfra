<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// database connection will be here

// include database and object files
include_once '../../config/database.php';
include_once '../../objects/Users.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$Users_list = new Users($db);
  
// read products will be here
$data = json_decode(file_get_contents("php://input"));
//print_r($data);

$Users_list->UserId= $data->UserId; 
 

$stmt = $Users_list->User_List_ById();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $Users_list_arr=array();
    $Users_list_arr["records"]=array();
  
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);
  
        $Users_list_item=array(

            "UserId"=>$UserId,
            "position"=>$position,
            "UserName"=>$UserName,
            "sponsorId"=>$sponsorId,
            "parentId"=>$parentId,
            "Phone"=>$Phone,
            "AadharNo"=>$AadharNo,
            "PanNo"=>$PanNo,
            "Password"=>$Password
        );
  
        array_push($Users_list_arr["records"], $Users_list_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($Users_list_arr);
}
  
// no products found will be here
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No user's details found.")
    );
}

?>