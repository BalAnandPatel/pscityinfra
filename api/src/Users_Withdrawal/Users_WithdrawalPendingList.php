<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get rankincconnection
include_once '../../config/database.php';
include_once '../../objects/UsersWithdrawal.php';
include_once '../../../constant.php'; 
include_once '../../../logger.php'; 
include '../../../common/php-jwt/src/JWT.php';
include '../../../common/php-jwt/src/ExpiredException.php';
include '../../../common/php-jwt/src/SignatureInvalidException.php';
include '../../../common/php-jwt/src/BeforeValidException.php';
use \Firebase\JWT\JWT;
try{

//Database connection
$dbconnection= new Database();
$db=$dbconnection->getConnection();
$WithdrawalList=new UsersWithdrawal($db);
$data = json_decode(file_get_contents("php://input"));

$WithdrawalList->WithdrawalStatus= $data->WithdrawalStatus; 
$headers=apache_request_headers();
//var_dump($headers);
if(isset($headers['Authorization']))
$token=trim(str_replace('Bearer','',$headers['Authorization']));
$mytoken= JWT::decode($token, $SECRET_KEY, array('HS256'));


$stmt = $WithdrawalList->Users_WithdrawalPendingList();
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
            "WithdrawalId" => $WithdrawalId,
            "WithdrawalAmount" => $WithdrawalAmount,
            "TDS" =>  $TDS,
            "UserId"=>$UserId,
            "AdminCharges" =>  $AdminCharges,
            "CreatedBy" =>  $CreatedBy,
            "CreatedOn" =>  $CreatedOn,
            "UserName"=>$UserName,
            "UserEmail"=>$UserEmail,
            "Phone"=>$Phone,
            "DirectIncome"=>$DirectIncome,
            "TeamIncome"=>$TeamIncome,
            "AmountAfterCharges"=>$AmountAfterCharges,
            "WithdrawalStatus"=>$WithdrawalStatus
        );
        array_push($Withdrawal_read_array["records"], $Withdrawal_Obj);
    }
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($Withdrawal_read_array);
}

else {

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
        array("message" => "User Withdrwal List not Found.")
    );
    $log_msg="User Withdrwal List not Found. : " . basename($_SERVER['PHP_SELF']);
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
