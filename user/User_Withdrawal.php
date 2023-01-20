<?php
include "include/header.php";
$token=$_SESSION['token'];
$url = $URL . "Users_Withdrawal/User_Withdrawal_List.php";
$UserId = $_SESSION['login_session']->UserId;
//echo $UserId;
$UserRole = $_SESSION['login_session']->userRole;
$data = array("UserId" => $UserId);
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
              <?php if ($UserRole == 'Agent' || $UserRole == 'Admin') { ?>
                <table id="example1" class="table table-bordered table-striped">
                <?php } else { ?>
                  <table id="example2" class="table table-bordered table-striped">
                  <?php } ?>
                  <thead>
                    <tr>

                      <th style="width: 5px">Agent id</th>
                      <th style="width: 10px">Direct Amount</th>
                      <th style="width: 10px">Team Amount</th>
                      <th style="width: 10px">Withdraw Amount</th>
                      <th style="width: 10px">Amount After Charges</th>
                      <th style="width: 10px">Status</th>
                      <th style="width: 10px">Date</th>
                      <th style="width: 10px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    foreach ($result as $key => $value) {
                      foreach ($value as $key1 => $value1) {
                    ?>

                        <tr>
                          <td> <?php echo $value1->UserId ?> </td>
                          <td><?php echo $value1->DirectIncome ?> </td>
                          <td><?php echo $value1->TeamIncome ?> </td>
                          <td><?php echo $value1->WithdrawalAmount ?> </td>
                          <td><?php echo $value1->AmountAfterCharges ?> </td>
                          <td><?php
                              if ($value1->WithdrawalStatus == 0) {
                                echo "Pending From Admin Side";
                              }
                              if ($value1->WithdrawalStatus == 1) {
                                echo "Approved";
                              }
                              if ($value1->WithdrawalStatus == 3) {
                                echo "Raise Withdrawal Request";
                              }
                              if ($value1->WithdrawalStatus == 2) {
                                echo "Rejected";
                                echo  "-(  $value1->Remark  ) ";
                              }

                              ?></td>
                          <td><?php
                              if (($value1->WithdrawalStatus == 1) || ($value1->WithdrawalStatus == 2)) {
                                echo $date1 = date("d-m-Y", $value1->ApprovedOn);
                              } else
                                echo $date1 = date("d-m-Y", $value1->CreatedOn)

                              ?></td>


                          <td>
                            <form action="action/User_WithdrawalRequest_Post.php" method="post" enctype="multipart/form-data">
                              <input type="text" name="UserId" value="<?php echo $value1->UserId ?>" hidden>
                              <input type="text" name="WithdrawalId" value="<?php echo $value1->WithdrawalId ?>" hidden>

                              <button type="submit" <?php
                                                    if (($value1->WithdrawalStatus == 1) || ($value1->WithdrawalStatus == 0)) { ?> disabled="disabled" <?php } ?> class="btn btn-primary">Raise Withdraw</button>
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
  <!-- /.content -->
  </div>
  <script>
    //YouTube
    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    if (<?php echo $vid != "" ? true : false ?>) {
      $(function() {
        var youtubePlayer;
        var myWindow = window;
        onYouTubeIframeAPIReady = function() {
          youtubePlayer = new YT.Player('youtube', {
            height: '200',
            width: '300',
            videoId: '<?php echo $vid; ?>',
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
          if (event.data == YT.PlayerState.PAUSED) {
            $("#status").text("You paused the video!");
          }
          if (event.data == YT.PlayerState.ENDED) {
            console.log("pcompletelay");

            $.ajax({

              url: '<?php echo $insert_url; ?>',
              type: 'POST',
              contentType: 'application/json',

              data: JSON.stringify({

                'u_id': '<?php echo $uid ?>',
                'v_id': '<?php echo $id ?>',
                'v_name': '<?php echo $title ?>',
                'v_duration': '<?php echo $duration ?>',
                'v_remark': 'video played..',
                'v_amount': '<?php echo $amt ?>'
              }),
              dataType: 'json',
              success: function(data) {
                // alert('Data: '+data);
              },
              error: function(request, error) {
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