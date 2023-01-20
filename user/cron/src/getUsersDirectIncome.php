<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../../cron/config/database.php';
include_once '../../cron/objects/income.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$directIncome = new income($db);

// read products will be here
$data = json_decode(file_get_contents("php://input"));
// query products
$directIncome->IncomeCreatedOn=$data->IncomeCreatedOn;
$stmt = $directIncome->getUsersDirectIncome();
$num = $stmt->rowCount();

// check if more than 0 record found
if ($num > 0) {

    // products array
    $directIncome_arr = array();
    $directIncome_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        extract($row);

        $directIncome_item = array(

            "UserId" => $UserId,
            "AmountPaid"=>$AmountPaid,
            "IncomeCreatedBy"=>$IncomeCreatedBy,
            "IncomeCreatedOn"=>$IncomeCreatedOn

        );

        array_push($directIncome_arr["records"], $directIncome_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show products data in json format
    echo json_encode($directIncome_arr);
}

// no products found will be here
else {

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
        array("message" => "user direct income not found.")
    );
}
