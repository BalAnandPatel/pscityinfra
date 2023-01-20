<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// get rankincconnection
include_once '../../config/database.php';
  
// instantiate rankincobject
include_once '../../objects/Users.php';
//Database connection
$dbconnection= new Database();
$db=$dbconnection->getConnection();
$UserDetails=new Users($db);
$data = json_decode(file_get_contents("php://input"));
$UserDetails->UserId=$data->UserId;
$UserDetails->ilevel=$data->ilevel;


// query products
$stmt = $UserDetails->Call_sp_get_network_tree();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $UserDetails_arr=array();
    $UserDetails_arr["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
        
        $UserDetails_item=array(
          "id"=>$id,
          "sponsorId"=>$sid,
          "parentId"=>$pid,
          "position"=>$position,
          "level"=>$level
        );
       // var_dump($UserDetails_item);
 
        array_push($UserDetails_arr["records"], $UserDetails_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($UserDetails_arr);
}
  
// no products found will be here
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No next position found.")
    );
}
?>