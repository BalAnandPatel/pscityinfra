<?php 
session_start();
$uid=$_SESSION['ID'];
$target_dir = "../img/";

if(!"../img/".$uid."//profile/")
mkdir("../img/".$uid."//profile/", 0777, true);

$target_file = $target_dir .$uid."//profile/". $uid.".png";

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
     "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
     "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
   "Sorry, file already exists.";
  //$uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 900000) {
   "Sorry, your file is too large.";
  $uploadOk = 0;
}



// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  header('Location:../profile_upload.php?msg=failed');
  //echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
     "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
     "Sorry, there was an error uploading your file.";
  }
 header('Location:../profile_upload.php?msg=success');
}
?>

