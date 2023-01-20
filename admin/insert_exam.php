<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Exam Details</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../common/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../common/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../common/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../common/build/scss/pages/_login_and_register.scss"
</head>

<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="#"><b></b></a>
  </div>
  <div class="card card-success card-outline">
    <div class="card-body register-card-body">
      
      
      <h2 class="login-box-msg"><b><u>Exam Details</u></b></h2>
      
      <hr>
     
      <form action="action/insert_exam_post.php" method="post" enctype="multipart/form-data">
      <div class="container-fluid">

  <div class="row">
    
         
  <div class="col-sm-6">
               <div class="form-group">
  <label for="input">Exam Name </label>

          <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-boxes"></span>
              </div>
              <input type="text" class="form-control" placeholder="Exam Name" name="exam_name" autocomplete="off" required  data-toggle="tooltip" title="Please Enter Full Name">         
          
          </div>
          </div>
            </div>

            <div class="col-sm-6">
               <div class="form-group">
  <label for="input">Exam Type</label>

          <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-boxes"></span>
              </div>
              <input type="text" class="form-control" placeholder="Exam Type" name="type" autocomplete="off" required  data-toggle="tooltip" title="Please Enter Full Name">         
          
          </div>
          </div>
            </div>
            </div>
 
  <div class="row">
  <div class="col-sm-6">
               <div class="form-group">
  <label for="input">Exam Amount</label>

          <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-boxes"></span>
              </div>
              <input type="text" class="form-control" placeholder="Exam Amount" name="amount" autocomplete="off" required  data-toggle="tooltip" title="Please Enter Full Name">         
          
          </div>
          </div>
            </div>
          
            <div class="col-sm-6">
               <div class="form-group">
  <label for="input">Age</label>

          <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-boxes"></span>
              </div>
              <input type="text" class="form-control" placeholder="Age" name="age" autocomplete="off" required  data-toggle="tooltip" title="Please Enter Full Name">         
          
          </div>
          </div>
            </div>
          </div>

            <div class="row">
  <div class="col-sm-6">
               <div class="form-group">
  <label for="input">Eligibility</label>

          <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-boxes"></span>
              </div>
              <input type="text" class="form-control" placeholder="Exam Eligibility" name="eligibility" autocomplete="off" required  data-toggle="tooltip">         
          
          </div>
          </div>
            </div>
          
            <div class="col-sm-6">
               <div class="form-group">
  <label for="input">Total Post</label>

          <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-boxes"></span>
              </div>
              <input type="text" class="form-control" placeholder="Total Post" name="total_post" autocomplete="off" required  data-toggle="tooltip">         
          
          </div>
          </div>
            </div>
          </div>

            <div class="row">

    
            <div class="col-sm-6">
          <div class="form-group">
  <label for="input">Exam Start Date </label>

          <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-boxes"></span>
              </div>
            <input type="date" class="form-control" name="exam_date_start" autocomplete="off" required  data-toggle="tooltip" title="Please Enter Date of Birth">         

            </div>
          </div>
            </div>

             <div class="col-sm-6">
          <div class="form-group">
  <label for="input">Exam End date </label>

          <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-boxes"></span>
              </div>
            <input type="date" class="form-control" name="exam_date_end" autocomplete="off" required  data-toggle="tooltip" title="Please Enter Date of Birth">         

            </div>
          </div>
            </div>
            </div>

            <div class="row">


             <div class="col-sm-6">
          <div class="form-group">
  <label for="input">Admit Card Release Date </label>

          <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-boxes"></span>
              </div>
            <input type="date" class="form-control" placeholder="Admit Card Release Date" name="admit_card_date" autocomplete="off" required  data-toggle="tooltip" title="Please Enter Date of Birth">         

            </div>
          </div>
            </div>

               <div class="col-sm-6">
          <div class="form-group">
  <label for="input">Result Release Date</label>

          <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-boxes"></span>
              </div>
            <input type="date" class="form-control" placeholder="Result Release Date" name="result_date" autocomplete="off" required  data-toggle="tooltip" title="Please Enter Date of Birth">         

            </div>
          </div>
            </div>
            </div>
           
                  
          <div class="col-4"  style="margin: 0px 281px 0px;">
            <button type="submit" class="btn btn-success btn-block">Submit</button>
          </div>
          <!-- /.col -->
        </div>
      </div>
      </form>

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
