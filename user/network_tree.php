<?php
//error_reporting(0);
include "include/header.php";
$url = $URL . "Users/User_Child_Read.php";

$user_id = (isset($_GET['id']) && ($_GET['id']!="") && ($_GET['id']!="X") )?$_GET['id']:$_SESSION['UserId'];

$tree_data=array();
//$curr_user=array();
$tree_data[0]=array(
            "UserId" => $user_id,
            "userName"=>"",
            "parentId" => "",
            "sponsorId" =>  "",
            "position" => ""
        );
generate_tree($user_id,$url);


function generate_tree($user_id,$url){
if($user_id!="X"){
$data = array("UserId" => $user_id);
$postdata = json_encode($data);
$client = curl_init($url);
curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
$response = curl_exec($client);

$result = json_decode($response);

$count=count($result->records);

if($count>1){ 
$GLOBALS['tree_data'][sizeof($GLOBALS['tree_data'])]=(array)$result->records[0];
$GLOBALS['tree_data'][sizeof($GLOBALS['tree_data'])]=(array)$result->records[1];

} elseif($count>0){
  if($result->records[0]->position=="L"){
    $GLOBALS['tree_data'][sizeof($GLOBALS['tree_data'])]=(array)$result->records[0];
    $GLOBALS['tree_data'][sizeof($GLOBALS['tree_data'])]=array(
             "UserId" => "X",
            "userName"=>"",
            "parentId" => "",
            "sponsorId" =>  "",
            "position" => ""
        );;
  }else{
    $GLOBALS['tree_data'][sizeof($GLOBALS['tree_data'])]=array(
              "UserId" => "X",
            "userName"=>"",
            "parentId" => "",
            "sponsorId" =>  "",
            "position" => ""
        );;
    $GLOBALS['tree_data'][sizeof($GLOBALS['tree_data'])]=(array)$result->records[0];
  }
}else{
  $GLOBALS['tree_data'][sizeof($GLOBALS['tree_data'])]=array(
             "UserId" => "X",
            "userName"=>"",
            "parentId" => "",
            "sponsorId" =>  "",
            "position" => ""
        );;
  $GLOBALS['tree_data'][sizeof($GLOBALS['tree_data'])]=array(
            "UserId" => "X",
            "userName"=>"",
            "parentId" => "",
            "sponsorId" =>  "",
            "position" => ""
        );;
}

}
 }

for($j=1; $j<15; $j++){
    

    
// echo "------------------------------------------------".$tree_data[$j]['UserId']."<br>";
  generate_tree($tree_data[$j]['UserId'],$url);

}


///////////////Define tree function/////////////////
?>


<!-- <link rel="stylesheet" href="../css/network.css"> -->
<link rel="stylesheet" href="../css/networks.css">
<style>
.hide {
  display: none;
}
    
.myDIV:hover + .hide {
  display: block;
  color:#fff;
  /*border:solid 1px;*/
  width:150px;
  height:150px;
  text-align:justify;
}
</style>

<script>
$(document).ready(function(){
$('[data-toggle="popover"]').popover(); 
 });
</script>


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="conttrent-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Your Team</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="network_tree.php?id=">Home</a></li>
              <li class="breadcrumb-item active">Your Team</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  <!-- Main content -->
  <section class="content">
  <div class="container-fluid">
        <div class="row">
         
          <div class="col-md-11">
                <!---------------************--------->
<!-- Main content -->
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Network Tree</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
             
        </div>
     

        <div class="row">
    <div class="col-sm-3">
    </div>
    <div class="col-sm">
        <?php //print_r($tree_data);?>
    <div class="tree">
<ul>
<li>
    
<div class="tooltips">
  <div class="myDIV">
        <a class="bg-warning" href="network_tree.php?id=<?php echo $tree_data[0]['UserId'] ?>" data-toggle="popover" data-placement="right" data-trigger="hover" data-html="true" title="ID- <?php echo $tree_data[0]['UserId'];?>" 
        data-content="Name: <?php echo $tree_data[0]['userName'];?>
        <br>Position: <?php echo $tree_data[0]['position'] ?>
        <br>Sponsor ID: <?php echo $tree_data[0]['sponsorId'] ?>
        <br>Parent ID: <?php echo $tree_data[0]['parentId'] ?>
        "><img class="img-fluid img-circle" src="image/profile.jpg" width="50px" height="50px"><br><?php echo $tree_data[0]['UserId'];?></a>
       
</div>
    <ul>
<li>
    <div class="tooltips1">
    <div class="myDIV">
      <!--<a href="network_tree.php?id=<?php //echo $tree_data[1]['UserId']?>">-->
      <!--<?php //echo $tree_data[1]['UserId'] ?></a>-->
        <a class="bg-warning" href="network_tree.php?id=<?php echo $tree_data[1]['UserId'] ?>" data-toggle="popover" data-placement="right" data-trigger="hover" data-html="true" title="ID- <?php echo $tree_data[1]['UserId'];?>" 
        data-content="Name: <?php echo $tree_data[1]['userName'];?>
        <br>Position: <?php echo $tree_data[1]['position'] ?>
        <br>Sponsor ID: <?php echo $tree_data[1]['sponsorId'] ?>
        <br>Parent ID: <?php echo $tree_data[1]['parentId'] ?>
        "><img class="img-fluid img-circle" src="image/profile.jpg" width="50px" height="50px"><br><?php echo $tree_data[1]['UserId'];?></a>
    </div>
    
<ul>
            <li>
                <div class="tooltips3">
                <div class="myDIV">
                <!--<a href="network_tree.php?id=<?php //echo $tree_data[3]['UserId'] ?>"><?php //echo $tree_data[3]['UserId'] ?></a>-->
                <a class="bg-warning" href="network_tree.php?id=<?php echo $tree_data[3]['UserId'] ?>" data-toggle="popover" data-placement="right" data-trigger="hover" data-html="true" title="ID- <?php echo $tree_data[3]['UserId'];?>" 
                data-content="Name: <?php echo $tree_data[3]['userName'];?>
                <br>Position: <?php echo $tree_data[3]['position'] ?>
                <br>Sponsor ID: <?php echo $tree_data[3]['sponsorId'] ?>
                <br>Parent ID: <?php echo $tree_data[3]['parentId'] ?>
                "><img class="img-fluid img-circle" src="image/profile.jpg" width="50px" height="50px"><br><?php echo $tree_data[3]['UserId'];?></a>
              </div>
        
                 <ul>
            <li >
                <div class="tooltips7">
                  <div class="myDIV">
                  <!--<a href="network_tree.php?id=<?php //echo $tree_data[7]['UserId'] ?>"><?php //echo $tree_data[7]['UserId'] ?></a>-->
                  <a class="bg-warning" href="network_tree.php?id=<?php echo $tree_data[7]['UserId'] ?>" data-toggle="popover" data-placement="right" data-trigger="hover" data-html="true" title="ID- <?php echo $tree_data[7]['UserId'];?>" 
                  data-content="Name: <?php echo $tree_data[7]['userName'];?>
                  <br>Position: <?php echo $tree_data[7]['position'] ?>
                  <br>Sponsor ID: <?php echo $tree_data[7]['sponsorId'] ?>
                  <br>Parent ID: <?php echo $tree_data[7]['parentId'] ?>
                  "><img class="img-fluid img-circle" src="image/profile.jpg" width="50px" height="50px"><br><?php echo $tree_data[7]['UserId'];?></a>
                 </div>
</li>
<li>
<div class="tooltips8">
  <div class="myDIV">
    <!--<a href="network_tree.php?id=<?php //echo $tree_data[8]['UserId'] ?>">-->
    <!--<?php //echo $tree_data[8]['UserId'] ?></a>-->
     <a class="bg-warning" href="network_tree.php?id=<?php echo $tree_data[8]['UserId'] ?>" data-toggle="popover" data-placement="right" data-trigger="hover" data-html="true" title="ID- <?php echo $tree_data[8]['UserId'];?>" 
     data-content="Name: <?php echo $tree_data[8]['userName'];?>
     <br>Position: <?php echo $tree_data[8]['position'] ?>
     <br>Sponsor ID: <?php echo $tree_data[8]['sponsorId'] ?>
     <br>Parent ID: <?php echo $tree_data[8]['parentId'] ?>
     "><img class="img-fluid img-circle" src="image/profile.jpg" width="50px" height="50px"><br><?php echo $tree_data[8]['UserId'];?></a>
</div>

</li>
</ul>
</li>
<li>
   <div class="tooltips4">
    <div class="myDIV">
    <!--  <a href="network_tree.php?id=<?php //echo $tree_data[4]['UserId'] ?>">-->
    <!--<?php //echo $tree_data[4]['UserId'] ?></a>-->
     <a class="bg-warning" href="network_tree.php?id=<?php echo $tree_data[4]['UserId'] ?>" data-toggle="popover" data-placement="right" data-trigger="hover" data-html="true" title="ID- <?php echo $tree_data[4]['UserId'];?>" 
     data-content="Name: <?php echo $tree_data[4]['userName'];?>
     <br>Position: <?php echo $tree_data[4]['position'] ?>
     <br>Sponsor ID: <?php echo $tree_data[4]['sponsorId'] ?>
     <br>Parent ID: <?php echo $tree_data[4]['parentId'] ?>
     "><img class="img-fluid img-circle" src="image/profile.jpg" width="50px" height="50px"><br><?php echo $tree_data[4]['UserId'];?></a>
</div>

                 <ul>
            <li>
                <div class="tooltips9">
                  <div class="myDIV">
                  <!--<a href="network_tree.php?id=<?php //echo $tree_data[9]['UserId'] ?>">-->
                  <!--<?php //echo $tree_data[9]['UserId'] ?></a>-->
                  <a class="bg-warning" href="network_tree.php?id=<?php echo $tree_data[9]['UserId'] ?>" data-toggle="popover" data-placement="right" data-trigger="hover" data-html="true" title="ID- <?php echo $tree_data[9]['UserId'];?>" 
                  data-content="Name: <?php echo $tree_data[9]['userName'];?>
                  <br>Position: <?php echo $tree_data[9]['position'] ?>
                  <br>Sponsor ID: <?php echo $tree_data[9]['sponsorId'] ?>
                  <br>Parent ID: <?php echo $tree_data[9]['parentId'] ?>
                  "><img class="img-fluid img-circle" src="image/profile.jpg" width="50px" height="50px"><br><?php echo $tree_data[9]['UserId'];?></a>
             </div>

</li>
<li>
   <div class="tooltips10">
    <div class="myDIV">
    <!--<a href="network_tree.php?id=<?php //echo $tree_data[10]['UserId'] ?>">-->
    <!--<?php //echo $tree_data[10]['UserId'] ?></a>-->
    <a class="bg-warning" href="network_tree.php?id=<?php echo $tree_data[10]['UserId'] ?>" data-toggle="popover" data-placement="right" data-trigger="hover" data-html="true" title="ID- <?php echo $tree_data[10]['UserId'];?>" 
     data-content="Name: <?php echo $tree_data[10]['userName'];?>
     <br>Position: <?php echo $tree_data[10]['position'] ?>
     <br>Sponsor ID: <?php echo $tree_data[10]['sponsorId'] ?>
     <br>Parent ID: <?php echo $tree_data[10]['parentId'] ?>
     "><img class="img-fluid img-circle" src="image/profile.jpg" width="50px" height="50px"><br><?php echo $tree_data[10]['UserId'];?></a>
</div>

</li>
</ul>
</li>
</ul>
</li>
<li>
    <div class="tooltips2">
    <div class="myDIV">
      <!--<a href="network_tree.php?id=<?php //echo $tree_data[2]['UserId'] ?>">-->
      <!--<?php //echo $tree_data[2]['UserId'] ?></a>-->
     <a class="bg-warning" href="network_tree.php?id=<?php echo $tree_data[2]['UserId'] ?>" data-toggle="popover" data-placement="right" data-trigger="hover" data-html="true" title="ID- <?php echo $tree_data[2]['UserId'];?>" 
     data-content="Name: <?php echo $tree_data[2]['userName'];?>
     <br>Position: <?php echo $tree_data[2]['position'] ?>
     <br>Sponsor ID: <?php echo $tree_data[2]['sponsorId'] ?>
     <br>Parent ID: <?php echo $tree_data[2]['parentId'] ?>
     "><img class="img-fluid img-circle" src="image/profile.jpg" width="50px" height="50px"><br><?php echo $tree_data[2]['UserId'];?></a>
</div>


<ul>
<ul>
            <li> <div class="tooltips5">
            <div class="myDIV">  
            <!--<a href="network_tree.php?id=<?php //echo $tree_data[5]['UserId'] ?>">-->
            <!--<?php //echo $tree_data[5]['UserId'] ?></a>-->
             <a class="bg-warning" href="network_tree.php?id=<?php echo $tree_data[5]['UserId'] ?>" data-toggle="popover" data-placement="right" data-trigger="hover" data-html="true" title="ID- <?php echo $tree_data[5]['UserId'];?>" 
             data-content="Name: <?php echo $tree_data[5]['userName'];?>
             <br>Position: <?php echo $tree_data[5]['position'] ?>
             <br>Sponsor ID: <?php echo $tree_data[5]['sponsorId'] ?>
             <br>Parent ID: <?php echo $tree_data[5]['parentId'] ?>
             "><img class="img-fluid img-circle" src="image/profile.jpg" width="50px" height="50px"><br><?php echo $tree_data[5]['UserId'];?></a>
</div>
      
              <ul>
            <li>
                 <div class="tooltips11">
                 <div class="myDIV"> 
                 <!--<a href="network_tree.php?id=<?php //echo $tree_data[11]['UserId'] ?>">-->
                 <!--<?php //echo $tree_data[11]['UserId'] ?></a>-->
                 <a class="bg-warning" href="network_tree.php?id=<?php echo $tree_data[11]['UserId'] ?>" data-toggle="popover" data-placement="right" data-trigger="hover" data-html="true" title="ID- <?php echo $tree_data[11]['UserId'];?>" 
                 data-content="Name: <?php echo $tree_data[11]['userName'];?>
                <br>Position: <?php echo $tree_data[11]['position'] ?>
                <br>Sponsor ID: <?php echo $tree_data[11]['sponsorId'] ?>
                <br>Parent ID: <?php echo $tree_data[11]['parentId'] ?>
                "><img class="img-fluid img-circle" src="image/profile.jpg" width="50px" height="50px"><br><?php echo $tree_data[11]['UserId'];?></a>
</div>


</li>
<li>
    <div class="tooltips12">
    <div class="myDIV">  
    <!--<a href="network_tree.php?id=<?php //echo $tree_data[12]['UserId'] ?>">-->
    <!--<?php //echo $tree_data[12]['UserId'] ?></a>-->
    <a class="bg-warning" href="network_tree.php?id=<?php echo $tree_data[12]['UserId'] ?>" data-toggle="popover" data-placement="right" data-trigger="hover" data-html="true" title="ID- <?php echo $tree_data[12]['UserId'];?>" 
    data-content="Name: <?php echo $tree_data[12]['userName'];?>
    <br>Position: <?php echo $tree_data[12]['position'] ?>
    <br>Sponsor ID: <?php echo $tree_data[12]['sponsorId'] ?>
    <br>Parent ID: <?php echo $tree_data[12]['parentId'] ?>
    "><img class="img-fluid img-circle" src="image/profile.jpg" width="50px" height="50px"><br><?php echo $tree_data[12]['UserId'];?></a>
</div>

</li>
</ul>

</li>
<li>
<div class="tooltips6">
  <div class="myDIV">
  <!--<a href="network_tree.php?id=<?php //echo $tree_data[6]['UserId'] ?>">-->
  <!--<?php //echo $tree_data[6]['UserId'] ?></a>-->
 <a class="bg-warning" href="network_tree.php?id=<?php echo $tree_data[6]['UserId'] ?>" data-toggle="popover" data-placement="right" data-trigger="hover" data-html="true" title="ID- <?php echo $tree_data[6]['UserId'];?>" 
    data-content="Name: <?php echo $tree_data[6]['userName'];?>
    <br>Position: <?php echo $tree_data[6]['position'] ?>
    <br>Sponsor ID: <?php echo $tree_data[6]['sponsorId'] ?>
    <br>Parent ID: <?php echo $tree_data[6]['parentId'] ?>
    "><img class="img-fluid img-circle" src="image/profile.jpg" width="50px" height="50px"><br><?php echo $tree_data[6]['UserId'];?></a>
</div>

                 <ul>
            <li>
<div class="tooltips13">
  <div class="myDIV">
  <!--<a href="network_tree.php?id=<?php //echo $tree_data[13]['UserId'] ?>">-->
  <!--<?php //echo $tree_data[13]['UserId'] ?></a>-->
   <a class="bg-warning" href="network_tree.php?id=<?php echo $tree_data[13]['UserId'] ?>" data-toggle="popover" data-placement="right" data-trigger="hover" data-html="true" title="ID- <?php echo $tree_data[13]['UserId'];?>" 
    data-content="Name: <?php echo $tree_data[13]['userName'];?>
    <br>Position: <?php echo $tree_data[13]['position'] ?>
    <br>Sponsor ID: <?php echo $tree_data[13]['sponsorId'] ?>
    <br>Parent ID: <?php echo $tree_data[13]['parentId'] ?>
    "><img class="img-fluid img-circle" src="image/profile.jpg" width="50px" height="50px"><br><?php echo $tree_data[13]['UserId'];?></a>
</div>

</li>
<li>
<div class="tooltips14">
  <div classs="myDIV">
  <!--<a href="network_tree.php?id=<?php //echo $tree_data[14]['UserId'] ?>">-->
  <!--<?php //echo $tree_data[14]['UserId'] ?></a>-->
     <a class="bg-warning" href="network_tree.php?id=<?php echo $tree_data[14]['UserId'] ?>" data-toggle="popover" data-placement="right" data-trigger="hover" data-html="true" title="ID- <?php echo $tree_data[14]['UserId'];?>" 
    data-content="Name: <?php echo $tree_data[14]['userName'];?>
    <br>Position: <?php echo $tree_data[14]['position'] ?>
    <br>Sponsor ID: <?php echo $tree_data[14]['sponsorId'] ?>
    <br>Parent ID: <?php echo $tree_data[14]['parentId'] ?>
    "><img class="img-fluid img-circle" src="image/profile.jpg" width="50px" height="50px"><br><?php echo $tree_data[14]['UserId'];?></a>
</div>
<!--<div class="hide alert alert-secondary">-->
<!--              <span class="tooltiptext14">-->
<!--                <br>Name:<?php //echo $tree_data[14]['userName'] ?>-->
<!--                <br>Position: <?php //echo $tree_data[14]['position'] ?>-->
<!--                <br>Sponsor ID: <?php //echo $tree_data[14]['sponsorId'] ?>-->
<!--                <br>Parent ID: <?php //echo $tree_data[14]['parentId'] ?>-->
<!--              </span>-->
<!--</div>            -->
</li>
</ul>
</li>
</ul>
</ul>
</li>
</ul>
</li>
</ul>
</div>
    </div>
      </div>

</div>
</div>
</div>
</div>
 </section>
</div>

<?php

include "include/footer.php";
?>