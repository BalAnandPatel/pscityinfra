<?php
include "include/header.php";
$url = $URL."admin/notice_read.php";
$data = array();
$postdata = json_encode($data);
$client = curl_init($url);
curl_setopt($client,CURLOPT_RETURNTRANSFER,1);
//curl_setopt($client, CURLOPT_POST, 5);
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
   

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
      
		      	<!-- Main content -->
             <div class="card">
              <div class="card-header">
              <h3 class="card-title">Notice List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <?php if($L_ROLE->role=='Admin'||$L_ROLE->role=='Super_Admin') {?>
              <table id="example1" class="table table-bordered table-striped">
                <?php }else{?>
                  <table id="example2" class="table table-bordered table-striped">
                    <?php }?>
                  <thead>
                    <tr>
                     <th style="width: 5px">S.N</th>
                      <th>Notice Type</th>
					            <th>Content</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                      <th>Status</th>
                      <th>Action</th>
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
                     <td> <?php echo ++$counter; ?> </td>
                      <td> <?php echo $value1->notice_type ?> </td>
                      <td><?php echo $value1->content ?> </td>
					            <td><?php echo $value1->start_date ?></td>
                      <td><?php echo $value1->end_date ?></td>
                      <td><?php echo $value1->status ?> </td>
                      <td ><form action="notice_delete.php" method="post"><input type="hidden" name="cid" 
                      value="<?php echo $value1->id; ?>">
                      <button type="submit" > Delete </button></form></td>
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
