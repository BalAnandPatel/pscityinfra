<?php
include '../../constant.php';

if (isset($_POST["UserName"]))
  $token = $_SESSION['token'];
$UserName = ucwords($_POST["UserName"]);
$sponsorId = $_POST["sponsorId"];
$position = $_POST["position"];
$parentId = $_POST["parentId"];
$UserEmail = $_POST["UserEmail"];
$Password = $_POST["Password"];
$UserDOB = $_POST["UserDOB"];
$Address = ucwords($_POST["Address"]);
$UserType = $_POST["UserType"];
$Phone = $_POST["Phone"];
$PanNo = $_POST["PanNo"];
$AadharNo = $_POST["AadharNo"];
$CreatedBy = $_SESSION['login_session']->UserId;
$CreatedOn = strtotime(date('Y-m-d H:i:s'));
if ($_SESSION['UserType'] == 2) {
  $Status = 1;
} else if ($_SESSION['UserType'] == 3) {
  $Status = 0;
}
$url = $URL . "Users/User_Registration.php";

$url_call_sp_get_next_position = $URL . "Users/call_sp_get_next_position.php";
$url_validate_userId = $URL . "Users/user_sponsor_parent_details.php";

$data_validate_user = array("sponsorId" => $sponsorId);

$postdata = json_encode($data_validate_user);

$client = curl_init($url_validate_userId);
curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
curl_setopt(
  $client,
  CURLOPT_HTTPHEADER,
  array(
    'Content-Type: application/json',
    'Authorization: Bearer ' . $token
  )
);
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);

$response_validate_user = curl_exec($client);
$result_validate_user = json_decode($response_validate_user);

//print_r($response_validate_user);
if (!empty($result_validate_user->records[0]->UserId)) {


  $data_call_sp = array("sponsorId" => $sponsorId, "position" => $position);

  $postdata = json_encode($data_call_sp);
  $client = curl_init($url_call_sp_get_next_position);
  curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
  $response_Sp = curl_exec($client);
  $result_sp = json_decode($response_Sp);

  //print_r($result_sp);
  if (isset($result_sp->message)) {
   // echo "inside isset";
    $position = $position;
    $sponsorId = $sponsorId;
    $parentId = $sponsorId;
  }

  if (!empty($result_sp->records[0]->position)) {
   // echo "inside empty feild";
    $position = $result_sp->records[0]->position;
    $parentId = $result_sp->records[0]->parentId;
    $sponsorId = $result_sp->records[0]->sponsorId;
  }


  $data = array(
    "UserName" => $UserName,
    "sponsorId" => $sponsorId,
    "parentId" => $parentId,
    "position" => $position,
    "UserEmail" => $UserEmail,
    "Password" => $Password,
    "UserDOB" => $UserDOB,
    "Address" => $Address,
    "UserType" => $UserType,
    "Phone" => $Phone,
    "PanNo" => $PanNo,
    "AadharNo" => $AadharNo,
    "CreatedBy" => $CreatedBy,
    "CreatedOn" => $CreatedOn,
    "Status" => $Status
  );

   //print_r($data);
  $postdata = json_encode($data);
  $client = curl_init($url);
  curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
  curl_setopt($client,CURLOPT_HTTPHEADER,
      array(
        'Content-Type: application/json',
        'Authorization: Bearer'. $token
      )
    );
  curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
  $response = curl_exec($client);
  $result = json_decode($response);

  //print_r($response);
   //print_r($result);


  if ($result->message == "Unable to create customer. Data is incomplete." || $result->message == "Unable to create User.") {
    $_SESSION['user_create'] = "User not created";
   header('Location:../User_Create.php?id=error creating user');
  } else {

    // echo "User Created Successfully";
    $url_get_MaxUid = $URL . "Users/User_MaxId.php";
    $data = array();
    $postdata = json_encode($data);
    $client = curl_init($url_get_MaxUid);
    curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
curl_setopt($client,CURLOPT_HTTPHEADER,
    array(
      'Content-Type: application/json',
      'Authorization: Bearer'. $token
    )
  );
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
    $response_MaxId = curl_exec($client);
    //print_r($response);
    $result_MaxId = json_decode($response_MaxId);

   if($result->message=="User Created Successfully"){

    $urlBank = $URL . "Users_BankDetails/UsersBankDetailsEntry.php";
    $UserId = $result_MaxId->records[0]->UserId;
    $CreatedBy = $_SESSION['login_session']->UserId;
    $CreatedOn = date('Y-m-d H:i:s');

    $data = array("UserId" => $UserId, "CreatedBy" => $UserId, "CreatedOn" => $CreatedOn);
    //print_r($data);
    $postdata = json_encode($data);
    $client = curl_init($urlBank);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
    //curl_setopt($client, CURLOPT_POST, 5);
    curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
    $ResponseBank = curl_exec($client);
    //print_r($ResponseBank);
    $resultBank = json_decode($ResponseBank);
    //print_r($resultBank);
    
    //------- text message code start ------------//
        
    $smsid="Glintel-Technologies";
    $smspass="q12345";
    $smsagentid=$result_MaxId->records[0]->UserId;
    $smsuser = strtok($UserName, " ");
    //print_r($smsagentid);
    
    $qry_str = "http://37.59.76.46/api/mt/SendSMS?user=Glintel-Technologies&password=q12345&senderid=PSINFR&channel=Trans&DCS=0&flashsms=0&number=".$Phone."&text=Dear%20".$smsuser."%20you%20are%20successfully%20register%20on%20PS%20City%20Portal%20your%20id%20".$smsagentid."%20and%20password%20".$Password."%20please%20visit%20our%20website%20https://pscityinfra.com&DLTtemplateid=1207166615600802629&route=06";
    $smsresult =file_get_contents($qry_str);
    //var_dump( $smsresult);
    
    }else{
        //echo "user not created";
        header('Location:../User_Create.php?id=error creating user');
    }
    

    //------- text message code end ------------//

    //echo "inserted all data";
   $_SESSION['user_create'] = $result->message;
   header('Location:../User_Registration_View.php?Uid=' . $result_MaxId->records[0]->UserId);
  }
} else {
  $_SESSION['user_create'] = "Sponsor/Parent ID is not available.";
  header('Location:../User_Create.php?id=error creating user');
}


exit();
