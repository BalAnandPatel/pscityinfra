<?php
include '../../constant.php';
//include '../include/header.php';
if(isset($_POST["name"]))
//$agent_id= $_POST["agent_id"];
$name = $_POST["name"];
$mobile = $_POST["mobile"];
$email = $_POST["email"];
$pan = $_POST["pan"];
$aadhaar = $_POST["aadhaar"];
$sponsor_id = $_POST["sponsor_id"];
$password = (rand(500, 100000));
$role = "Agent";
$url = $URL . "admin/agent_registration.php";
$url_get_agent = $URL . "admin/agent_registration_read.php";
$url_bank = $URL . "admin/agent_bank_registration.php";
$url_agent_login = $URL . "admin/agent_login_create.php";
$time = strtotime(date('Y-m-d H:i:s'));


$data = array(
  "name" => $name, "mobile" => $mobile,
  "email" => $email, "pan" => $pan, "aadhaar" => $aadhaar, "sponsor_id" => $sponsor_id, "created_on" => $time,
  "created_by" => "admin"
);


$postdata = json_encode($data);

$client = curl_init($url);
curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);



$response = curl_exec($client);
$result = json_decode($response);

print_r($response);
print_r($result);


if ($result->message == "Unable to create agent. Data is incomplete" || $result->message == "Unable to create agent") {
  header('Location:../agent_create.php?id=error creating user');
} else {


  $data_get_agent = array("pan" => $pan, "agent_id" => "NONE");
  $postdata_get_agent = json_encode($data_get_agent);

  $get_agent_details = curl_init($url_get_agent);
  curl_setopt($get_agent_details, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($get_agent_details, CURLOPT_POSTFIELDS, $postdata_get_agent);
  $response_agent_login = curl_exec($get_agent_details);

  $agent_resp = json_decode($response_agent_login);


    $data_bank = array("agent_id" => $agent_resp->records[0]->agent_id,  "created_on" => $time, "created_by" => "admin");
    $data_agent_login = array(
      "agent_id" => $agent_resp->records[0]->agent_id, "role" => $role, "password" => $password, "created_on" => $time,
      "created_by" => "admin"
    );


    $postdata_bank = json_encode($data_bank);
    $postdata_agent_login = json_encode($data_agent_login);


    $client_bank = curl_init($url_bank);
    $client_login = curl_init($url_agent_login);

    curl_setopt($client_bank, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($client_login, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($client_bank, CURLOPT_POSTFIELDS, $postdata_bank);
    curl_setopt($client_login, CURLOPT_POSTFIELDS, $postdata_agent_login);

    $response_bank = curl_exec($client_bank);
    $response_agent_login = curl_exec($client_login);


    $result_bank = json_decode($response_bank);

    $result_login = json_decode($response_agent_login);

  //header('Location:../agent_reg_view.php?id=' . $agent_resp->records[0]->agent_id);
}

exit();
