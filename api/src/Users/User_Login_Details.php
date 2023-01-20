<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get rankincconnection
include_once '../../config/database.php';
include_once '../../objects/Users.php';
include_once '../../../constant.php'; 
include_once '../../../logger.php'; 

 try{
//Database connection
$dbconnection= new Database();
$db=$dbconnection->getConnection();
$UserDetails=new Users($db);
$data = json_decode(file_get_contents("php://input"));
// we  have to retrive the Users.
$UserDetails->UserId= $data->UserId; 


$stmt = $UserDetails->User_Login_Details();

$num = $stmt->rowCount();

if($num>0 ){
  
    // products array
    $Users_read_array=array();
    $Users_read_array["records"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $Users_read_Object=array(
            "UserId" => $UserId,
            "sponsorId"=>$sponsorId,
            "parentId"=>$parentId,
            "position" => $position,
            "UserName" => $UserName,
            "UserEmail" =>  $UserEmail,
            "Phone" =>  $Phone,
            "AadharNo" =>  $AadharNo,
            "PanNo" =>  $PanNo,
           "userRole" =>  $userRole,
            "UserType"=>$UserType,
            "UserDOB" =>  $UserDOB,
            "Password"=> $Password,
            "CreatedBy"=>$CreatedBy,
            "CreatedOn"=>$CreatedOn,
            "Password"=>$Password,
            "Status"=>$Status,
            "Address"=>$Address
        );
        array_push($Users_read_array["records"], $Users_read_Object);
    }
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($Users_read_array);
}

else {

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
        array("message" => "User Login details not found..")
    );
    $log_msg="User Login details not found. : " . basename($_SERVER['PHP_SELF']);
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
