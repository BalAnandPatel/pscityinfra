<?php
//This page is used for Approve agent list
if(isset($_POST["submit"])){

    include "../../constant.php";
    $token = $_SESSION['token'];
    $url = $URL."Users/user_list_pending_update.php";
    $UserId=$_POST["UserId"];
    $Status='1';
    $UpdatedBy=$_SESSION['login_session']->userRole;
    $UpdatedOn=strtotime(date('Y-m-d H:i:s'));
    $data = array( "UserId"=>$UserId, "Status"=>$Status, "UpdatedBy"=>$UpdatedBy, "UpdatedOn"=>$UpdatedOn);
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
    print_r($response);
    $result = json_decode($response);
    print_r($result);
    if($result->message == "user list updated."){
    $_SESSION['User_status']="Agent Details Approved Successfully" ;
        header('Location:../Users_List_Pending.php');

    }else{
        $_SESSION['User_status']="Unable to Approve Agent." ;
        header('Location:../Users_List_Pending.php');
    }
    

}
exit();
?>