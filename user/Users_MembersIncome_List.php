<?php
//This page is used by agent and it collect the details of customer whose usertype=4 and userId=agent Id. This is for customer.
error_reporting(0);
include "include/header.php";
$token=$_SESSION['token'];
$LoginUserRole=$_SESSION['login_session']->userRole;
if(isset($_POST['submit'])){
$url = $URL."income/Users_MembersIncome_read.php";
$UserId=$_POST['UserId'];
$Member_UserType=4;
$data = array("UserId"=>$UserId);
//print_r($data);
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
}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Team Income List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Team Income List</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>  <!-- Content Header (Page header) -->
   
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
      
		      	<!-- Main content -->

                 <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Please Enter Agent Id</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="#" method="post">
                <div class="card-body">
  
                <input type="text" class="form-control" placeholder="Agent ID" name="UserId"  autocomplete="off" >
                </br>
                <span>OR</span> </br></br>

              <input type="checkbox"  placeholder="Agent ID" name="UserId" value="All_Users"  autocomplete="off" > Get All


                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
           </div>

             <div class="card card-primary">
              <div class="card-header">
              <h3 class="card-title">Team Income List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              
              <?php if($LoginUserRole=='Admin' || $LoginUserRole=='SuperAdmin') {?>
                <table id="example1" class="table table-bordered table-striped">
                  <?php }else{?>
                    <table id="example2" class="table table-bordered table-striped">
                      <?php }?>
                  <thead>
                    <tr>
                      <th style="width: 5px">S.N</th>
                      <th>UserId</th>
                      <th>sponsorId</th>
                      <th>parentId</th>
					            <th>AmountPaid</th>
                      <th>TotalAmount</th>
                      <th>Created Date</th>
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
                      <td><?php echo $value1->UserId; ?></td>
                      <td><?php echo $value1->sponsorId; ?></td>
                      <td><?php echo $value1->parentId; ?></td>
                      <td><?php echo $value1->AmountPaid; ?></td>
                      <td><?php echo $value1->TotalAmount ?></td>
                      <td><?php  $date1=explode(' ',$value1->IncomeCreatedOn);
                      echo $date1[0] ?></td>
            
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
