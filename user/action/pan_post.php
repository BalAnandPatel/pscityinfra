<?php 
include '../../constant.php';
session_start();
$uid=$_SESSION['ID'];
$pan=$_POST['pan'];
$url = $URL."registration/update_pan.php";
$data = array("pan" =>$pan, "uid" =>$uid);
 //print_r($data);

//print_r($data);
$postdata = json_encode($data);
$client = curl_init($url);
curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
$response = curl_exec($client);
//print_r($response);
$result = json_decode($response);
//print_r($result);
$target_dir = "../img/";
if(!"../img/".$uid."//pan/")
mkdir("../img/".$uid."//pan/", 0777, true);

echo $target_file = $target_dir .$uid."//pan/". $uid.".png";
echo "<br>";
$uploadOk = 1;
echo $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    //$uploadOk = 0;
  }
}

// Check if file already exists
// if (file_exists($target_file)) {
//   echo "Sorry, file already exists.";
//   $uploadOk = 0;
// }

// Check file size
if ($_FILES["fileUpload"]["size"] > 9000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}



// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  //header('Location:../pan_upload.php?msg=failed');
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileUpload"]["name"])). " has been uploaded.";



    $url = $URL."/registration/update_pan.php";
    $data = array( "pan" =>$pan, "u_id" =>$uid);
    $postdata = json_encode($data);
    $client = curl_init($url);
    
    curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
    curl_setopt($client, CURLOPT_CONNECTTIMEOUT, 0); 
    curl_setopt($client, CURLOPT_TIMEOUT, 4); //timeout in seconds
    curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
    $response = curl_exec($client);
  //  print_r($response);    
     $result = json_decode($response);
//print_r($result);
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
 header('Location:../pan_upload.php?msg=Success');
}
?>

