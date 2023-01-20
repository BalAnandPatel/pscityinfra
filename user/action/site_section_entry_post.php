<?php

include '../../constant.php';
$token = $_SESSION['token'];
$SiteName = ucfirst($_POST["SiteName"]);
$SiteSection = ucfirst($_POST["SiteSection"]);
$SiteDepth = $_POST["SiteDepth"];
$SiteTotalArea = $_POST["SiteTotalArea"];
$SiteCurrentAvailableArea = $_POST["SiteTotalArea"];
$SoldArea = 0;
$SitePricePerSquareFeet = $_POST["SitePricePerSquareFeet"];
$SiteStatus = 0;
$SiteCreatedBy = $_SESSION['login_session']->UserId;

$url = $URL . "Site_SectionDetails/Site_SectionDetails_Create.php";
$time = strtotime(date('Y-m-d H:i:s'));

$data = array(
   "SiteName" => $SiteName,
   "SiteSection" => $SiteSection,
   "SiteDepth" => $SiteDepth,
   "SiteTotalArea" => $SiteTotalArea,
   "SoldArea" => $SoldArea,
   "SiteCurrentAvailableArea" => $SiteCurrentAvailableArea,
   "SitePricePerSquareFeet" => $SitePricePerSquareFeet,
   "SiteStatus" => $SiteStatus,
   "SiteCreatedOn" => $time,
   "SiteCreatedBy" => $SiteCreatedBy
);

//print_r($data);

$postdata = json_encode($data);
$client = curl_init($url);
curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
curl_setopt(
   $client,
   CURLOPT_HTTPHEADER,
   array(
      'Content-Type: application/json',
      'Authorization: Bearer ' . $token
   )
);
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
$response = curl_exec($client);
//print_r($response);
$result = json_decode($response);
//print_r($result);
if ($result->message == "Unable to create Site section details" || $result->message == "Unable to create Site. Data is incomplete") {
   $_SESSION["siteEntry"] = "Site already present";
   header('Location:../site_section_entry.php');
} else {
   $_SESSION["siteEntry"] = "Site Created Successfully";
   header('Location:../site_sectiondetails.php');
}

exit();
