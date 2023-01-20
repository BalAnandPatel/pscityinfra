<?php
// Used by Admin, This page shows pending and rejected list of customer.
include "include/header.php";
$token=$_SESSION['token'];
$url = $URL."User_Members/Users_MembersPendingList.php";
// $LogingUserType=$_SESSION['login_session']->UserType;
$LoginUserRole=$_SESSION['login_session']->userRole;
// $UserType=3;
$data = array();
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
///echo $result;
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pending Members List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pending Members List</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>  <!-- Content Header (Page header) -->
   
    <section class="content">
      <div class="container-fluid">
      <?php if (isset($_SESSION['User_status'])) { ?>
        <div class="alert alert-success" id="success-alert" role="alert">
          <?php echo $_SESSION['User_status'];
          unset($_SESSION['User_status']) ?>
        </div>
      <?php  } ?>
        <div class="row">
            <div class="col-md-12">
      
		      	<!-- Main content -->
             <div class="card card-primary">
              <div class="card-header">
              <h3 class="card-title">Pending Members List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              
              <?php if($LoginUserRole=='Admin'|| $LoginUserRole=='SuperAdmin') {?>
                <table id="example1" class="table table-bordered table-striped">
                  <?php }else{?>
                    <table id="example2" class="table table-bordered table-striped">
                      <?php }?>
                  <thead>
                    <tr>
                      <th style="width: 5px">S.N</th>
                      <th>Member Name</th>
                      <th>Member Role</th>
                      <th>Member Status</th>
					            <th>Agent Name</th>
                      <th>Member Phone</th>
                      <th>Pan No</th>
                      <th>Aadhar No</th>
                      <th>Created On</th>
                      <th>Update</th>
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
                      <td> <?php echo ucfirst($value1->MemberName) ?> </td>
                      <td><?php echo ucfirst($value1->UserRole) ?></td>
                      <td><?php echo $value1->StatusName ?> </td>
                      <td><?php echo ucfirst($value1->AgentName) ?> </td>
                      <td><?php echo $value1->MemberPhone ?></td>
                      <td><?php echo $value1->MemberPAN ?> </td>
                      <td><?php echo $value1->MemberAadhar ?></td>
                      <td><?php  $date1=explode(' ',$value1->CreatedOn);
                     echo $date1[0] ?></td>
                
                  <td>
                    <form action="Users_Members_Update.php" method="get" enctype="multipart/form-data">
                      <input type="text" name="Mid" value="<?php echo $value1->MemberId ?>"  hidden>
                      <button type="submit" class="btn btn-primary">Update</button>
                    </form>                   
                 </td>
            
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

    <!-- Main content -->

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
