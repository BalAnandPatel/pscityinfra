<?php
include "include/header.php";
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
             <div class="card card-primary">
              <div class="card-header">
              <h3 class="card-title">Site Name List </h3>
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
                      <th style="width: 10px">S.N</th>
                      <th>Site Name</th>
					            <th>Amount Per Square Feet</th>
                      <th>Status</th>
                      <th>Total Plot</th>
                    </tr>
                  </thead>
                  <tbody>
                 
                    <tr>
                      <td> </td>
                      <td> </td>
					            <td></td>
                      <td>New Video</td>
                      <td> </td>
                      
                     
             
                      
                      
                    </tr>
                                        
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
