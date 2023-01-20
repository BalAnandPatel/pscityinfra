
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registration Psp News</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../common/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../common/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../common/dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="index2.html"><b>PSP</b>NEWS</a>
  </div>
  <div class="card-body">
                <button type="button" class="btn btn-success toastrDefaultSuccess">
                  <?php
                   echo $_GET['msg'];
                   ?>
                </button>
</div>
  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="action/register_post.php" method="post">
	  <div class="input-group mb-3">
          <select class="form-control" name="group">
             <option class="form-control" value="Please Select">Please Select</option>
             <option class="form-control" value="SP NES LIVES">SP NEWS LIVE</option>
             <!-- <option class="form-control" value="PSP GROUP">PSP GROUP</option> -->
             
         </select>
       </div>
		<div class="input-group mb-3">
         <select class="form-control" name="rank">
         <option class="form-control" value="Rank">Please Your Rank</option>
             <option class="form-control" value="india">India</option>
             <option class="form-control" value="Pradesh">Pradesh</option>
             <option class="form-control" value="Mandal">Mandal</option>
             <option class="form-control" value="District">Distric</option>
             <option class="form-control" value="Tehshil">Tehshil</option>
             <option class="form-control" value="Block">Block/Police Station</option>
             <option class="form-control" value="Np">Nayay Panchayant</option>
         </select>

        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Full name" name="name" autocomplete="off" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" autocomplete="off" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Sponsor ID" name="sponsor_id" autocomplete="off" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password"  required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      
      <i class="fa fa-sign-in-alt"></i>
      <a href="index.php" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="../common/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../common/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../common/dist/js/adminlte.min.js"></script>
</body>
</html>
