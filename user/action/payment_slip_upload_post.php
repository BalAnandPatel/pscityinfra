
<?php
session_start();
include '../constant.php';


if(isset($_POST["submit"])) {
 $amount= $_POST["rank_amount"];
 $payment_mod= $_POST["payment_mode"];
 $slip_no= $_POST["rank_slip_no"];
 $rank_payment_date= $_POST["rank_payment_date"];
$name="India";
 $uid= $_SESSION['ID'];



 $url = $URL."payment_slip/create.php";
$data = array("rank_amount" =>$amount, "payment_mod" =>$payment_mod, "slip_no" =>$slip_no, 
"rank_payment_date"=>$rank_payment_date, "id"=>$uid);
$postdata = json_encode($data);

$client = curl_init($url);
curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
$response = curl_exec($client);
//print_r($response);
$result = json_decode($response);
//print_r($result);





$target_dir = "../img/";
if(!"../img/".$uid."//rank_receipt/")
mkdir("../img/".$uid."//rank_receipt/", 0777, true);

echo $target_file = $target_dir .$uid."//rank_receipt/". $slip_no."_".$amount.".00.png";
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
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileUpload"]["size"] > 900000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}



// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileUpload"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

header('Location:../payment_slip_upload.php?msg=success');

}
else
{
header('Location:../payment_slip_upload.php?msg=failed');

}

?>