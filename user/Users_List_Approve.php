<?php
//This page is used for Agent Listing where usertype=3 . Used by admin
include "include/header.php";
$token=$_SESSION['token'];
$url = $URL."Users/Users_List.php";
$LogingUserType=$_SESSION['login_session']->UserType;
$LoginUserRole=$_SESSION['login_session']->userRole;
$UserType=3;
$Status='1';
$data = array( "UserType"=>$UserType);
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
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Approved Agent List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Approved Agent List</li>
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
              <h3 class="card-title">Approved Agent List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              
              <?php if($LoginUserRole=='Admin'||$LoginUserRole=='Super Admin') {?>
                <table id="example1" class="table table-bordered table-striped">
                  <?php }else{?>
                    <table id="example2" class="table table-bordered table-striped">
                      <?php }?>
                  <thead>
                    <tr>
                      <th style="width: 5px">S.N</th>
                      <th>Agent Id</th>
                      <th>Agent Name</th>
                      <th>Agent Position</th>
                      <th>Password</th>
                      <th>Sponsor Id</th>
                      <th>Parent Id</th>
                      <th>Mobile</th>
                      <th>Pan No</th>
                      <th>Aadhar No</th>
                      <th>Date</th>
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
                      <td> <?php echo $value1->UserId; ?> </td>
                      <td><?php echo ucfirst($value1->UserName); ?> </td>
                      <td><?php echo ucfirst($value1->position); ?> </td>
                      <td><?php echo $value1->Password; ?></td>
                      <td><?php echo ucfirst($value1->sponsorId); ?> </td> 
                      <td><?php echo ucfirst($value1->parentId); ?> </td>
                      <td><?php echo $value1->Phone; ?></td>
                      <td><?php echo $value1->PanNo; ?> </td>
                      <td><?php echo $value1->AadharNo; ?></td>
                      <td><?php echo $time = date("d/m/Y",$value1->CreatedOn);?></td>
                      <td>
                        <form action="Users_List_Approve_update.php" method="post">
                         <input type="hidden" name="UserId" value="<?php echo $value1->UserId; ?> ">
                         <button type="submit" name="update" class="btn btn-success">Update</button>
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
 

  <!-- /.content-wrapper -->
<?php
include "include/footer.php";
?>
