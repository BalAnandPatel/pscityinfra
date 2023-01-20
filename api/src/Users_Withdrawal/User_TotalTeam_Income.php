<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get rankincconnection
include_once '../../config/database.php';
  
// instantiate rankincobject
include_once '../../objects/UsersWithdrawal.php';
//Database connection
$dbconnection= new Database();
$db=$dbconnection->getConnection();
$UserWithdrawal=new UsersWithdrawal($db);
$data = json_decode(file_get_contents("php://input"));

$UserWithdrawal->UserId= $data->UserId; 
$stmt = $UserWithdrawal->Team_TotalIncome();
// query products

$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0 ){
  
    // products array
    $Withdrawal_read_array=array();
    $Withdrawal_read_array["records"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $Withdrawal_Obj=array(
        "Commission"=>$Commission,
            "UserId" =>  $UserId
            // "SitePurchaseAmount" =>  $SitePurchaseAmount,
           
        );
        array_push($Withdrawal_read_array["records"], $Withdrawal_Obj);
    }
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($Withdrawal_read_array);
}



?>