<?php
//error_reporting(0);
include "../constant.php";
$UserType = $_SESSION['login_session']->UserType;
$UserName=$_SESSION['login_session']->UserName;
$role = $_SESSION['login_session']->userRole;
// $url = $URL . "admin/notice_read.php";
// $UserId = $_SESSION['login_session']->UserId;
// $data = array("agent_id" => $UserId);
// $postdata = json_encode($data);
// $client = curl_init($url);
// curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
// //curl_setopt($client, CURLOPT_POST, 5);
// curl_setopt($client, CURLOPT_POSTFIELDS, $postdata);
// $response = curl_exec($client);
// //print_r($response);
// $result = json_decode($response);
// //print_r($result);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>


<style>
.hide {
  display: none;
}
    
.myDIV:hover + .hide {
  display: block;
  color: red;
}
</style>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Real Estate</title>
   <!---link to style sheet----->
   <link rel="stylesheet" href="../common/css/style.css">
   <link rel="stylesheet" href="../common/css/payment_slip.css">
   <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
   <link rel="stylesheet" href="../common/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
   <link rel="stylesheet" href="../common/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
   <link rel="stylesheet" href="../common/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
   <link rel="stylesheet" href="../common/dist/css/adminlte.min.css?v=3.2.0">
   <!-- Google Font: Source Sans Pro -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="../common/plugins/fontawesome-free/css/all.min.css">
   <!-- Ionicons -->
   <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
   <!-- Tempusdominus Bootstrap 4 -->
   <link rel="stylesheet" href="../common/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
   <!-- iCheck -->
   <link rel="stylesheet" href="../common/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
   <!-- JQVMap -->
   <link rel="stylesheet" href="../common/plugins/jqvmap/jqvmap.min.css">
   <!-- Theme style -->
   <link rel="stylesheet" href="../common/dist/css/adminlte.min.css">
   <!-- overlayScrollbars -->
   <link rel="stylesheet" href="../common/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
   <!-- Daterange picker -->
   <link rel="stylesheet" href="../common/plugins/daterangepicker/daterangepicker.css">
   <!-- summernote -->
  <link rel="stylesheet" href="../common/plugins/summernote/summernote-bs4.min.css">
 <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
   <div class="wrapper">
      <!-- Preloader -->
      <!--<div class="preloader flex-column justify-content-center align-items-center">-->
      <!--   <img class="animation__shake" src="../common/assets/img/logo/pscitylogo.png" alt="AdminLTELogo" height="60" width="60">-->
      <!--</div>-->
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-dark">
         <!-- Left navbar links -->
         <ul class="navbar-nav">
            <li class="nav-item">
               <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
               <a href="dashboard.php" class="nav-link">Dashboard</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
               <a href="User_Profile.php" class="nav-link">Profile</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
               <a href="Change_Password.php" class="nav-link">Change Password</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
               <a href="logout.php" class="nav-link">Logout</a>
            </li>

         </ul>
         <!-- Right navbar links -->
         <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
               <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="fab fa-facebook-square fa-lg"></i>
               </a>
            </li>
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
               <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="fab fa-twitter-square fa-lg"></i>
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="#" role="button">
                  <i class="fab fa-invision fa-lg"></i>
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                  <i class="fas fa-expand-arrows-alt fa-lg"></i>
               </a>
            </li>
         </ul>
      </nav>
      <!-- /.navbar -->
      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
         <!-- Brand Logo -->
         <a href="#" class="brand-link">
            <img src="../common/assets/img/logo/pscitylogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity:.8; background-color:#ffffff;">
            <span class="brand-text font-weight-light"> <b> Real State</span>
         </a>
         <!-- Sidebar -->
         <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
               <div class="image">
               </div>
               <div class="info">
                  <a href="User_Profile.php" class="d-block"><?php echo ucfirst($role) ?></a>
               </div>
            </div>
            <!-- SidebarSearch Form -->
            <div class="form-inline">
               <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                  <div class="input-group-append">
                     <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                     </button>
                  </div>
               </div>
            </div>
            <!-- Sidebar Menu -->
            <nav class="mt-2">
               <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
                  with font-awesome or any other icon font library -->

                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p style="color:#2e86de">
                           Plot & Site Details
                           <i class="right fas fa-angle-left"></i>
                        </p>
                     </a>
                     <ul class="nav nav-treeview">
                       <?php
                          if (strpos($ROLE, $SITE_ENTRY) !== false) {
                        ?>
                           <li class="nav-item">
                              <a href="site_section_entry.php" class="nav-link">
                              <i class="nav-icon fa fa-plus-circle"></i>

                                 <p>New Site Entry </p>
                              </a>
                           </li>
                           <?php }?>
                           <?php
                           if (strpos($ROLE, $SITE_LIST) !== false) {
                           ?>
                           <li class="nav-item">
                              <a href="site_sectiondetails.php" class="nav-link">
                                 <i class="nav-icon fas fa-list"></i>
                                 </i>
                                 <p>Site List</p>
                              </a>
                           </li>
                           <?php }?>
                           <?php
                        if (strpos($ROLE, $AVAILABLE_PLOT) !== false) {
                        ?>
                           <li class="nav-item">
                              <a href="available_plot.php" class="nav-link">
                                 <i class="nav-icon fas fa-boxes"></i>
                                 </i>
                                 <p>Available Plot List</p>
                              </a>
                           </li>
                           <?php }?>
                           <?php
                             if (strpos($ROLE, $PLOT_SALE) !== false) {
                           ?>
                           <li class="nav-item">
                              <a href="site_purchase.php" class="nav-link">
                                 <i class="nav-icon fas fa-cart-plus"></i>
                                 </i>
                                 <p>Plot Sale</p>
                              </a>
                           </li>
                           <?php }?>
                           <?php
                            if(strpos($ROLE, $PLOT_PAYMENT) !== false){
                           ?>
                           <li class="nav-item">
                              <a href="installment.php" class="nav-link">
                                 <i class="nav-icon fas fa-cart-plus"></i>
                                 </i>
                                 <p>Plot Payment</p>
                              </a>
                           </li>
                           <?php }?>
                  </li>
               </ul>
               <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p style="color:#2e86de">
                           Withdraw
                           <i class="right fas fa-angle-left"></i>
                        </p>
                     </a>
                     <ul class="nav nav-treeview">
                       <?php
                          if (strpos($ROLE, $USER_WITHDRAWAL) !== false) {
                        ?>
                           <li class="nav-item">
                              <a href="User_Withdrawal.php" class="nav-link">
                              <i class="nav-icon fa fa-plus-circle"></i>

                                 <p>Withdraw Req</p>
                              </a>
                           </li>
                           <?php }?>
                           <?php
                           if (strpos($ROLE, $USER_WITHDRAWAL_LIST) !== false) {
                           ?>
                           <li class="nav-item">
                              <a href="User_Withdrawal_List.php" class="nav-link">
                                 <i class="nav-icon fas fa-list"></i>
                                 </i>
                                 <p>Withdraw List</p>
                              </a>
                           </li>
                           <?php }?>
                           <?php
                        if (strpos($ROLE, $USER_WITHDRAWAL_LIST_FOR_ADMIN) !== false) {
                        ?>
                           <li class="nav-item">
                              <a href="User_Withdrawal_List_For_Admin.php" class="nav-link">
                                 <i class="nav-icon fas fa-boxes"></i>
                                 </i>
                                 <p>Withdraw Requested</p>
                              </a>
                           </li>
                           <?php }?>
                           </ul>
                  </li>
               
               <!-- </li> -->


               <li class="nav-item">
                  <a href="#" class="nav-link">
                     <i class="nav-icon fas fa-gift"></i>
                     <p style="color:#2e86de">
                        Award & Reward
                        <i class="right fas fa-angle-left"></i>
                     </p>
                  </a>
                  
                  <ul class="nav nav-treeview">
              
                  <?php
                            if(strpos($ROLE, $AWARD_REWARD_ENTRY) !== false){
                           ?>
                  <li class="nav-item">
                     <a href="award_reward_entry.php" class="nav-link">
                        <i class="nav-icon fa fa-plus-circle"></i>
                        <p>Award & Reward Entry</p>
                     </a>
                  </li>
                  <?php }?>
                  <?php
                            if(strpos($ROLE, $AWARD_REWARD_LIST) !== false){
                           ?>
                  <li class="nav-item">
                     <a href="award_reward_list.php" class="nav-link">
                        <i class="nav-icon fa fa-list"></i>
                        <p>Award & Reward List</p>
                     </a>
                  </li>
                  <?php }?>
                  </ul>
               </li>
                  

               <li class="nav-item">
                  <a href="#" class="nav-link">
                     <i class="nav-icon fas fa-user-secret"></i>
                     <p style="color:#2e86de">
                        Agent
                        <i class="right fas fa-angle-left"></i>
                     </p>
                  </a>
                  <ul class="nav nav-treeview">
               </li>
               <?php
                            if(strpos($ROLE, $USER_CREATE) !== false){
                           ?>
                  <li class="nav-item">
                     <a href="User_Create.php" class="nav-link">
                     <i class="nav-icon fa fa-plus-circle"></i>
                        <p>New Agent</p>
                     </a>
                  </li>
                  <?php }?>
              <!-- This is the listing of the team member of agent -- My Team List-->
             
              <?php
                            if(strpos($ROLE, $USER_ALL_LIST) !== false){
                           ?>
              <li class="nav-item">
                     <a href="Users_List_Approve.php" class="nav-link">
                        <i class="nav-icon fa fa-list"></i>
                        <p>Agent List</p>
                     </a>
                  </li>
                  <?php } ?>
                  <?php
                            if(strpos($ROLE, $NETWORK_TREE) !== false){
                           ?>
                <li class="nav-item">
                     <a href="network_tree_search.php" class="nav-link">
                        <i class="nav-icon fa fa-list"></i>
                        <p>Search My Team</p>
                     </a>
                  </li>
              <?php } ?>

               <?php
                            if(strpos($ROLE, $NETWORK_TREE) !== false){
                           ?>
                <li class="nav-item">
                     <a href="network_tree.php" class="nav-link">
                        <i class="nav-icon fa fa-list"></i>
                        <p>My Team</p>
                     </a>
                  </li>
              <?php } ?>
             
                  <?php
                    if (strpos($ROLE, $NOTICE_ENTRY) !== false) {
                  ?>
                  <li class="nav-item">
                     <a href="notice_entry.php" class="nav-link">
                     <i class="nav-icon fa fa-plus-circle"></i>
                        <p>Agent Notice</p>
                     </a>
                  </li>
                  <?php } ?>
                  <?php
                     if (strpos($ROLE, $NOTICE_LIST) !== false) {
                   ?>
                  <li class="nav-item">
                     <a href="notice_list.php" class="nav-link">
                     <i class="nav-icon fa fa-list"></i>
                        <p>Notice List</p>
                     </a>
                  </li>
                  <?php } ?>
               </ul>
               </li>
               <?php
                     if (strpos($ROLE, $USER_PROFILE) !== false) {
                   ?>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-id-card"></i>
                        <p style="color:#2e86de">
                           Agent Profile
                           <i class="right fas fa-angle-left"></i>
                        </p>
                     </a>
                     <ul class="nav nav-treeview">
               
                     <?php
                     if (strpos($ROLE, $USER_PROFILE) !== false) {
                   ?>
                        <li class="nav-item">
                           <a href="User_Profile.php" class="nav-link">
                              <i class="nav-icon fa fa-university"></i>
                              <p>Update Profile Detail</p>
                           </a>
                        </li>
                        <?php } ?>
                        <?php
                     if (strpos($ROLE, $USER_BANK_UPDATE) !== false) {
                   ?>
                        <li class="nav-item">
                           <a href="User_Bank_Update.php" class="nav-link">
                              <i class="nav-icon fa fa-edit"></i>
                              <p>Agent Acount Update</p>
                           </a>
                        </li>
                        <?php } ?>
                        <?php
                     if (strpos($ROLE, $MY_TEAM_LIST) !== false) {
                   ?>
                        <li class="nav-item">
                           <a href="Users_Direct_Team_List.php" class="nav-link">
                           <i class="nav-icon fa fa-list-ol"></i>
                              <p>My Team List</p>
                           </a>
                        </li>
                        <?php } ?>
                        <?php
                     if (strpos($ROLE, $USERS_MEMBERS_CREATE) !== false) {
                   ?>
                        <li class="nav-item">
                           <a href="Users_Members_Create.php" class="nav-link">
                           <i class="nav-icon fa fa-plus-circle"></i>
                              <p>Customer Entry </p>
                           </a>
                        </li>
                     <?php } ?>

                        <?php
                     if (strpos($ROLE, $UPLOAD_PAN) !== false) {
                   ?>
                        <li class="nav-item">
                           <a href="#upload_pan.php" class="nav-link">
                              <i class="nav-icon fa fa-address-card"></i>
                              <p>Upload Pan Card</p>
                           </a>
                        </li>
                        <?php } ?>
                        <?php
                     if (strpos($ROLE, $UPLOAD_PHOTO) !== false) {
                   ?>
                        <li class="nav-item">
                           <a href="#upload_photo.php" class="nav-link">
                              <i class="nav-icon fa fa-image"></i>
                              <p>Upload Profile Photo</p>
                           </a>
                        </li>
                        <?php } ?>
                        <?php
                     if (strpos($ROLE, $NETWORK_TREE) !== false) {
                   ?>
                        <li class="nav-item">
                           <a href="network_tree.php" class="nav-link">
                              <i class="nav-icon fas fa-network-wired"></i>
                              <p>
                                 Go to Network
                              </p>
                           </a>
                        </li>
                        <?php } ?>
                     </ul>
                  </li>
               <?php } ?>

<!-- //  members family bonus -->
                             
                     <li class="nav-item">
                        <a href="#" class="nav-link">
                           <i class="nav-icon fas fa-user"></i>
                           <p style="color:#2e86de">
                              Customer
                              <i class="right fas fa-angle-left"></i>
                           </p>
                        </a>
                        <ul class="nav nav-treeview">
                        <?php
                         if (strpos($ROLE, $USER_DIRECTMEMBERS_LIST) !== false){
                         ?>
                        <li class="nav-item">
                           <a href="User_DirectMembers_List.php" class="nav-link">
                              <i class="nav-icon fa fa-list"></i>
                              <p>Direct Customer List</p>
                           </a>
                        </li>
                        <?php } ?>    
                        <li class="nav-item">
                              <a href="Members_PaymentList.php" class="nav-link">
                                 <i class="nav-icon fa fa-list"></i>
                                 <p>Customer Payment  List</p>
                              </a>
                           </li>
                           <?php
                                 if (strpos($ROLE, $MEMBER_CREATE_BY_ADMIN) !== false) {
                           ?>
                        <li class="nav-item">
                              <a href="Members_ByAdmin_Create.php" class="nav-link">
                              <i class="nav-icon fa fa-plus-circle"></i>
                                 <p>Customer Entry By Admin </p>
                              </a>
                           </li>
                           <?php } ?>
                           <?php
                                 if (strpos($ROLE, $USERS_MEMBER_LIST) !== false) {
                           ?>
                           <li class="nav-item">
                              <a href="Users_Members_List.php" class="nav-link">
                                 <i class="nav-icon fa fa-list"></i>
                                 <p>Customer List</p>
                              </a>
                           </li>
                           <?php } ?>


                           <?php
                                 if (strpos($ROLE, $Customer_Payment_List) !== false) {
                           ?>
                           <li class="nav-item">
                              <a href="Customer_Payment_List.php" class="nav-link">
                                 <i class="nav-icon fa fa-list"></i>
                                 <p>Customer Plot Purchase List</p>
                              </a>
                           </li>
                           <?php } ?>

                                                  </ul>
                     </li>
                     <li class="nav-item">
                        <a href="#" class="nav-link">
                           <i class="nav-icon fas fa-coins"></i>
                           <p style="color:#2e86de">
                              Income
                              <i class="right fas fa-angle-left"></i>
                           </p>
                        </a>
                        <ul class="nav nav-treeview">
                     </li>
                          <?php
                                 if (strpos($ROLE, $USER_DIRECT_INCOME) !== false) {
                           ?>
                        <li class="nav-item">
                           <a href="User_DirectIncome.php" class="nav-link">
                              <i class="nav-icon fas fa-arrow-alt-circle-down"></i>
                              <p>Agent Direct Income</p>
                           </a>
                        </li>
                        <?php } ?>
                        <?php
                                 if (strpos($ROLE, $AWARD_INCOME) !== false) {
                           ?>
                        <li class="nav-item">
                           <a href="award_income_list.php" class="nav-link">
                              <i class="nav-icon fas fa-arrow-alt-circle-down"></i>
                              <p>Award Income</p>
                           </a>
                        </li>
                        <?php } ?>
                        <?php
                                 if (strpos($ROLE, $REWARD_INCOME) !== false) {
                           ?>
                        <li class="nav-item">
                           <a href="reward_income_list.php" class="nav-link">
                              <i class="nav-icon fas fa-arrow-alt-circle-down"></i>
                              <p>Reward Income</p>
                           </a>
                        </li>
                        <?php } ?>
                        <?php
                                 if (strpos($ROLE, $FAMILY_INCOME) !== false) {
                           ?>
                        <li class="nav-item">
                           <a href="family_income_list.php" class="nav-link">
                              <i class="nav-icon fas fa-arrow-alt-circle-down"></i>
                              <p>Family Income</p>
                           </a>
                        </li>
                        <?php } ?>
                        <?php
                                 if (strpos($ROLE, $USER_DIRECT_PAYMENT_INCOME) !== false) {
                           ?>
                        <li class="nav-item">
                           <a href="Users_MembersIncome_List.php" class="nav-link">
                              <i class="nav-icon fas fa-arrow-alt-circle-down"></i>
                              <p>Team Income</p>
                           </a>
                        </li>
                        <?php } ?>
                        </li>
                     </ul>



                     </li>
                     </ul>
            </nav>
            <!-- /.sidebar-menu -->
         </div>
         <!-- /.sidebar -->
      </aside>
            