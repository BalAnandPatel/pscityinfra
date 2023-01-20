<?php

include "include/header.php";
$token=$_SESSION['token'];
$url = $URL."income/Users_DirectIncome_List.php";
$UserRole = $_SESSION['login_session']->userRole;
$UserId=$_SESSION['login_session']->UserId;
$data = array("UserId"=>$UserId);
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
//print_r($response);
$result = json_decode($response);
//print_r($result);
?>

<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Direct Income</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Direct Income</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
      
		      	<!-- Main content -->
             <div class="card card-primary">
              <div class="card-header">
              <h3 class="card-title">Direct Income</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <?php if($UserRole=='Admin'||$UserRole=='SuperAdmin') {?>
              <table id="example1" class="table table-bordered table-striped">
                <?php }else{?>
                  <table id="example2" class="table table-bordered table-striped">
                    <?php }?>
                  <thead>
                    <tr>
                      <th  style="width: 2px">S.N</th>
                      <th>Agent ID</th>
                      <th>Agent Name</th>
                      <th>Plot Name</th>
                      <th>Plot ID</th>
                      <th>Plot Amount</th>
                      <th  style="width: 5px">Plot Amount(with charges)</th>
					            <th>Agent Income</th>
                      <th>Date</th>
                     
                      </tr>
                  </thead>
                  <tbody>
                  <?php 
								     $counter=0;
                     foreach($result as $key => $value){
                     foreach($value as $key1 => $value1)
                      {
                    ?>

                    <tr>
                      <td><?php echo ++$counter; ?> </td>
                      <td><?php echo $value1->UserId ?> </td>
                      <td><?php echo $value1->UserName ?> </td>
                      <td><?php echo $value1->SitePurchaseName ?> </td>
                      <td><?php echo $value1->PlotNo ?> </td>
                      <td><?php echo $value1->SiteTotalAmount ?> </td>
                      <td>lllll<?php echo $value1->SitePurchaseAmount ?></td>
                      <td><?php echo $value1->AmountPaid ?> </td>
                      <td><?php echo $date1=date("d-m-Y",$value1->IncomeCreatedOn) ?></td>                   

                      </tr>
                    <?php
      }
    } 
 ?>                      
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
         <!-----------*******************------->			
            </div>
          </div>
       </div>
 </section>
    <!-- /.content -->
  </div>
  <script>
    //YouTube
var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

if(<?php echo $vid!=""?true:false ?>){
$(function(){
  var youtubePlayer;
  var myWindow = window;
  onYouTubeIframeAPIReady = function(){
   youtubePlayer = new YT.Player('youtube', {
     height: '200',
     width: '300',
     videoId: '<?php echo $vid;?>',
     events: {
       'onReady': onPlayerReady,
       'onStateChange': onPlayerStateChange
     }
   });
  }

  onPlayerReady = function(event) {
    time = youtubePlayer.getDuration();
    $(".dur").val(time);
    title = youtubePlayer.getVideoData().title
    $(".title").val(title);
  };

  onPlayerStateChange = function(event) {
   if (event.data == YT.PlayerState.PLAYING) {
     console.log("play");
     $("#status").text("Playing!");
     myWindow.focus();
     myWindow.onblur = function() {
      $("#status").text("You went away!");
       youtubePlayer.stopVideo();
       
     };

   

     
   }
    if(event.data == YT.PlayerState.PAUSED){
    $("#status").text("You paused the video!");
   }
    if(event.data == YT.PlayerState.ENDED){
      console.log("pcompletelay");
     
$.ajax({

url : '<?php echo $insert_url; ?>',
type : 'POST',
contentType: 'application/json',

data :JSON.stringify( {
  
  'u_id':'<?php echo $uid ?>', 
  'v_id':'<?php echo $id ?>',
  'v_name': '<?php echo $title ?>',
  'v_duration':'<?php echo $duration ?>', 
  'v_remark':'video played..',
  'v_amount': '<?php echo $amt ?>' 
}),
dataType:'json',
success : function(data) {              
   // alert('Data: '+data);
},
error : function(request,error)
{
    //alert("Request: "+JSON.stringify(request));
}
});
    $("#status").text("Completed");
   }

  };  
})
}
    </script>

  <!-- /.content-wrapper -->
<?php
include "include/footer.php";
?>
