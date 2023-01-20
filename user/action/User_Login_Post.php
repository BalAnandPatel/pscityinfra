<?php
include '../../constant.php';
include_once '../../logger.php';
include '../../common/php-jwt/src/JWT.php';
include '../../common/php-jwt/src/ExpiredException.php';
include '../../common/php-jwt/src/SignatureInvalidException.php';
include '../../common/php-jwt/src/BeforeValidException.php';

use \Firebase\JWT\JWT;

try {
  $UserId = $_POST["UserId"];
  $Password = $_POST["Password"];


  $url = $URL."Users/User_Login.php";
  $data = array("UserId" => $UserId, "Password" => $Password);
  //print_r($data);
  $postdata = json_encode($data);
  //var_dump($postdata);
  $client = curl_init($url);
  curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
  curl_setopt($client, CURLOPT_CONNECTTIMEOUT, 0);
  curl_setopt($client, CURLOPT_POST, 5);
  curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($client);
  //print_r($response);
  $decode = (json_decode($response));
  //print_r($decode);
  
  if (!isset($decode->message)) {

       $result = JWT::decode($decode->access_token, $SECRET_KEY, array('HS256'));
        // $result = ($decode);
    if (
      $result->data->UserId == $_POST['UserId'] &&
      $result->data->Password == $_POST['Password']
    ) {
      // echo "Got Login Details";
      $_SESSION['login_session'] = $result->data;
      $_SESSION['token'] = $decode->access_token;
      $_SESSION['UserId'] = $result->data->UserId;
      $_SESSION['UserName'] = $result->data->UserName;
      $_SESSION['UserType'] = $result->data->UserType;
      $_SESSION['userRole'] = $result->data->userRole;
      $_SESSION['UserEmail'] = $result->data->UserEmail;
      $_SESSION['Password'] = $result->data->Password;
      $_SESSION['Status'] = $result->data->Status;

      $_SESSION['status'] = "Welcome to Dashaboard : " . $_SESSION['UserName'];

      $log_msg = "User Login : " . basename($_SERVER['PHP_SELF']  . " id " . $result->data->UserId);
      logger($log_msg);
      header('Location:../dashboard.php');
    } else {
      $_SESSION['loginFailed'] = " Incorrect Username or Password! Please try again";
      $login_flag = 1;
      header('Location:../index.php');
    }
  } else {
    $_SESSION['loginFailed'] = "Login Failed! Please try again";
    //$login_flag = 1;
   header('Location:../index.php');
  }
} catch (Exception $e) {

  if ($e->getMessage() == "Expired token") {

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

exit();
