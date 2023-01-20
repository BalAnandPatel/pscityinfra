<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get rankincconnection
include_once '../../config/database.php';
  
// instantiate rankincobject
include_once '../../objects/SitePurchaseMode.php';
//Database connection
$dbconnection= new Database();
$db=$dbconnection->getConnection();

$UserDetailsRead=new SitePurchaseMode($db);
$data = json_decode(file_get_contents("php://input"));

$UserDetailsRead->PurchaseModeId=$data->PurchaseModeId;
$stmt=$UserDetailsRead->PurchaseModeRead();
  $num= $stmt->rowCount();
if($num>0){

$PurchaseMode_array=array();
$PurchaseMode_array["PurchaseModeArray"]= array();

   while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
extract($row);

echo $PurchaseMode_ObjRead=array(

"PurchaseModeId"=> $PurchaseModeId,
"PurchaseModeName"=>$PurchaseModeName,
"CreatedBy"=>$CreatedBy,
 "CreatedOn"=>$CreatedOn,
"UserName"=>$UserName

);
array_push($PurchaseMode_array["PurchaseModeArray"], $PurchaseMode_ObjRead);
   }
   http_response_code(200);
  
   echo json_encode($PurchaseMode_array);

}

?>