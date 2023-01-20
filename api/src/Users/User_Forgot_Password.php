<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get rankincconnection
include_once '../../config/database.php';
  
// instantiate rankincobject
include_once '../../objects/Users.php';
//Database connection
$dbconnection= new Database();
$db=$dbconnection->getConnection();
$UserDetails=new Users($db);
$data = json_decode(file_get_contents("php://input"));

$UserDetails->UserEmail=$data->UserEmail;
$stmt = $UserDetails->User_forgot_Password();
// query products

$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0 ){
  
    // products array
    $Users_read_array=array();
    $Users_read_array["records"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $Usertype_Read_Obj=array(
            
           "UserEmail" =>  $UserEmail,
            "UserName"=>$UserName,
            "Password"=>$Password,
            "UserId"=>$UserId,
        );
        array_push($Users_read_array["records"], $Usertype_Read_Obj);
    }
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($Users_read_array);
}
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to Read User data. Data is incomplete."));
    $log_msg="Unable to Read User data. Data is incomplete. : " . basename($_SERVER['PHP_SELF']);
    logger($log_msg);
}



?>