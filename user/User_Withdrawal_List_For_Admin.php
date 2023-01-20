<?php
// this pag eis for agent 
include "include/header.php";
$token=$_SESSION['token'];
$url = $URL."Users_Withdrawal/Users_WithdrawalPendingList.php";
$UserId=$_SESSION['login_session']->UserId;
$UserRole=$_SESSION['login_session']->userRole;
$data = array("WithdrawalStatus"=>0);
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
  < <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      <?php if (isset($_SESSION['withdrawal'])) { ?>
        <div class="alert alert-success" id="success-alert" role="alert">
          <?php echo $_SESSION['withdrawal'];
          unset($_SESSION['withdrawal']) ?>
        </div>
      <?php  } ?>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Withdraw List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Withdraw List</li>
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
              <h3 class="card-title">Withdraw List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <?php if($UserRole=='Agent'||$UserRole=='Admin') {?>
              <table id="example1" class="table table-bordered table-striped">
                <?php }else{?>
                  <table id="example2" class="table table-bordered table-striped">
                    <?php }?>
                  <thead>
                    <tr>
                    
                      <th style="width: 5px">Agent id</th>
                      <th style="width: 5px">Agent Name</th>
                     
                      <th style="width: 5px">Agent Phone</th>
					<th style="width: 10px">Total Amount</th>
                      <th style="width: 10px">TDS +Admin Charges(%)</th>
                     
                      <th style="width: 10px">Withdraw Amount with (%)</th>
                      
                     
                      <th  colspan="2"  style="width: 10px">Action</th>
                      <th style="width: 10px">Remark</th>
                      <th style="width: 10px">Date</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
								     
                     foreach($result as $key => $value){
                     foreach($value as $key1 => $value1)
                      {
                    ?>

                    <tr>
                      <td> <?php echo $value1->UserId ?> </td>
                      <td> <?php echo $value1->UserName ?> </td>
                     
                      <td> <?php echo $value1->Phone ?> </td>

                      <td><?php echo $value1->WithdrawalAmount ?> </td>
					           
                      <td><?php echo ($value1->TDS+$value1->AdminCharges) ?></td>
                     
                      <td><?php echo $value1->AmountAfterCharges ?></td>
                     
                            
                      
                      <td> <form action="action/User_Withdrawal_Post_ByAdmin.php" method="post" enctype="multipart/form-data">
                      <input type="text" name="UserId" value="<?php echo $value1->UserId ?>"  hidden>
                      <input type="text" name="WithdrawalId" value="<?php echo $value1->WithdrawalId ?>"  hidden>
                      <input type="text" name="actionApprove" value="Approve"  hidden>
                      <button type="submit" class="btn btn-primary">Approve</button>  
                    </form> </td>
                      <td>
                      <form action="action/User_Withdrawal_Post_ByAdmin.php" method="post" enctype="multipart/form-data">
                      <input type="text" name="UserId" value="<?php echo $value1->UserId ?>"  hidden>
                      <input type="text" name="WithdrawalId" value="<?php echo $value1->WithdrawalId ?>"  hidden>
                      <input type="text" name="actionReject" value="Reject"  hidden>
                      <button type="submit" class="btn btn-danger">Reject</button>
                    </form> </td>
                    <td style="width: 5px"><textarea name="remark" required ></textarea></td>
                    <td><?php echo $date1=date("d-m-Y",$value1->CreatedOn) ?></td>
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
