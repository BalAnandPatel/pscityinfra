<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once '../../cron/config/database.php';
include_once '../../cron/objects/income.php';
  
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$team_read = new income($db);
// read products will be here
$data = json_decode(file_get_contents("php://input"));

// query products
$stmt = $team_read->read_team_income_job();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $team_read_arr=array();
    $team_read_arr["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $team_read_item=array(
         "ParentId"=>$ParentId,
            "UserId" => $UserId,
            "amount" => $amount,
            "teamFlag" => $teamFlag,
        );
  
        array_push($team_read_arr["records"], $team_read_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($team_read_arr);
}
  
// no products found will be here
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No team_income_job detail found.")
    );
}
?>