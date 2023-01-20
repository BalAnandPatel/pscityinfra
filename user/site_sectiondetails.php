<?php

include "include/header.php";
$token=$_SESSION['token'];
try{
$url = $URL."Site_SectionDetails/Site_SectionDetails_Read.php";
$SiteName="";
$data = array("SiteName"=>$SiteName);
//print_r($data);
$postdata = json_encode($data);
$client = curl_init($url);
curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
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

?>

<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php if(isset($_SESSION['siteEntry'])){?>
                <div class="alert alert-success" id="success-alert" role="alert">
                <?php echo $_SESSION['siteEntry']; unset($_SESSION['siteEntry'])?> 
               </div>
            <?php  }?>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Site List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Site List</li>
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
                <h3 class="card-title">Site List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                   <?php if($_SESSION['userRole']=='Admin'||$_SESSION['userRole']=='Super_Admin') {?> 
                 <table id="example1" class="table table-bordered table-striped">
                 <?php }else{?>
                 <table id="example2" class="table table-bordered table-striped">
                 <?php }?> 
                 <thead>
                    <tr>
                      <th style="width: 10px">S.N</th>
                      <th>Site Name</th>
					            <th>Section</th>
                      <th>Plot Depth (Feet)</th>
                      <th>Amount (Per Square Feet <span class="fas fa-rupee-sign"></span> ) </th>
                      <th>Total Ploted Area</th>
                      <th>Site Create Date</th>
                      
                     
                    </tr>
                  </thead>
                  <tbody>
                   <?php 
								     $count=0;
                     foreach($result as $key => $value){
                     foreach($value as $key1 => $value1)
                      {
                    ?>

                    <tr>
                      <td><?php echo ++$count; ?> </td>
                      <td><?php echo ucfirst($value1->SiteName) ?> </td>
                      <td><?php echo ucfirst($value1->SiteSection) ?> </td>
					            <td><?php echo $value1->SiteDepth ?>: Feet</td>
                      <td><span class="fas fa-rupee-sign"></span> <?php echo $value1->SitePricePerSquareFeet ?></td>
                      <td><?php echo $value1->SiteTotalArea ?> (Square Feet)</td>
                      <td><?php echo $time = date("d/m/Y",$value1->SiteCreatedOn)=="01/01/1970"?0:date("d/m/Y",$value1->SiteCreatedOn); ?></td>
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


  $(function () {
    $("#example2").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
  

  <!-- /.content-wrapper -->
<?php
include "include/footer.php";
}
catch (Exception $e){

  if($e->getMessage() == "Expired token"){

    
// set response code
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
?>
