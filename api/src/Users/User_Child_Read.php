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
$get_tree=new Users($db);
$data = json_decode(file_get_contents("php://input"));

//print_r($data);

// we  have to retrive the Users.
$get_tree->UserId=$data->UserId; 
//$UserDetails->Password=$data->Password;

$stmt = $get_tree->get_child();
// query products

$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0 ){
      
    // products array
    $get_tree_array=array();
    $get_tree_array["records"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $get_tree_Object=array(
            "UserId"=>$UserId,
            "userName"=>$UserName,
            "parentId"=>$parentId,
            "sponsorId"=>$sponsorId,
            "position"=>$position
        );
        array_push($get_tree_array["records"], $get_tree_Object);
    }
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($get_tree_array);
}
else{
      $get_tree_array1=array();
    $get_tree_array1["records"]=array();
     $get_tree_Object1=array(
            "UserId"=>"X",
            "userName"=>"",
            "parentId"=>"",
            "sponsorId"=>"",
            "position"=>""
        );
        array_push($get_tree_array1["records"], $get_tree_Object1);
           echo json_encode($get_tree_array1);
}


?>