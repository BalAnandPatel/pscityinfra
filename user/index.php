<?php include '../constant.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PSCity Land Developer | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../common/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../common/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../common/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>PSCity </b>Land Developer</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
               <!-- <button type="button" class="btn btn-success toastrDefaultSuccess"> </button> -->
                <?php if(isset($_SESSION["loginFailed"])){?>
                <div class="alert alert-danger" id="success-alert" role="alert">
                <?php echo $_SESSION['loginFailed']; unset($_SESSION['loginFailed']);?>
               </div><?php }?>
               <?php if(isset($_SESSION["ForgotPassword"])){?>
                <div class="alert alert-success" id="success-alert" role="alert">
                <?php echo $_SESSION['ForgotPassword']; unset($_SESSION['ForgotPassword']);?>
               </div><?php }?>
      <p class="login-box-msg">Sign in to
        start your session</p>

      <form action="action/User_Login_Post.php" method="post">
        <div class="input-group mb-3">
          
          <input type="text" name="UserId" class="form-control" placeholder="USER ID" autocomplete="off" require>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="Password" class="form-control" placeholder="Password" require>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1">
        <a href="User_Forgot_Password.php">Forgot Password?</a>
      </p>
      <!-- <p class="mb-0">
        <a href="register.php" class="text-center">Register a new membership</a>
      </p> -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<script>
   $("#success-alert").fadeTo(2000, 2500).slideUp(2500, function(){
    $("#success-alert").slideUp(2500);
});
</script>
<!-- jQuery -->
<script src="../common/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../common/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../common/dist/js/adminlte.min.js"></script>
</body>
</html>
