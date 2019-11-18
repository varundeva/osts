<?php
// Initialize the session
session_start();
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id']))
{
  header("location: login.php");
}

$user_id = $_SESSION['user_id'];

$name = $phone = $email = $dob =$mailopt=$msg="";
$name_err = $phone_err = $email_err = $dob_err =$mailopt_err="";


$sql = "SELECT * FROM users WHERE user_id = '$user_id'";
require_once 'include/conn.php';
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0){
  while($row=mysqli_fetch_assoc($result)){
    $name=$row['user_name'];
    $phone = $row['user_phone'];
    $email = $row['user_email'];
    if($row['user_dob']!=NULL)
    {$dob=$row['user_dob'];}
    if($row['user_mailopt']== 1 || $row['user_mailopt']== true){
      $mailopt="checked";
    }
  }
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

  if(empty(trim($_POST['name']))){
    $name_err ="<div class='alert alert-danger' role='alert'>
          Error : Name Should Not be Empty </div>";
  }else {
    $name = trim($_POST['name']);
  }

  if(empty(trim($_POST['email']))){
    $email_err ="<div class='alert alert-danger' role='alert'>
          Error : E-Mail Should Not be Empty </div>";
  }else {
    $email = trim($_POST['email']);
  }

  if(empty(trim($_POST['phone']))){
    $phone_err ="<div class='alert alert-danger' role='alert'>
          Error : Phone Should Not be Empty </div>";
  }else {
    $phone = trim($_POST['phone']);
  }

  if(empty(trim($_POST['dob']))){
    $dob_err ="<div class='alert alert-danger' role='alert'>
          Error : DOB Should Not be Empty </div>";
  }else {
    $dob = trim($_POST['dob']);
  }

  if(isset($_POST['mailopt']) && $_POST['mailopt'] == 'true'){
    $mailopt = 1;
  }else {
    $mailopt=0;
  }


  if(empty($name_err) && empty($phone_err) && empty($email_err) && empty($dob_err)){
    $sql = "UPDATE users SET user_name='$name',user_email='$email',user_phone='$phone',user_dob='$dob',user_mailopt='$mailopt' WHERE user_id='$user_id'";
    require_once 'include/conn.php';
    if(mysqli_query($conn,$sql))
    {
      $msg="<div class='alert alert-success' role='alert'>
          Successfully Profile Updated..
        </div>";
    }else {
      $msg="<div class='alert alert-danger' role='alert'>
          Error: Something Went Wrong..
        </div>";
    }
  }

}

?>





<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
    <title>OSTS</title>
  </head>
  <body class="fixed-nav sticky-footer bg-dark" id="page-top">
      <!-- Navigation Menu Include Start-->
    <?php
    include('include/navigation.php');
    ?>
      <!-- Navigation Menu Include End-->


        <div class="content-wrapper">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">



                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                  <h4>User Profile</h4>
                <div class="form-group col-12">
                  <label for="inputAddress">User Name</label>
                  <input name="name" required type="text" value="<?php echo $name; ?>" class="form-control" id="inputName" placeholder="Your Name">
                  <span><?php if(!empty($name_err)) echo $name_err;?></span>
                </div>
                <div class="form-group col-12">
                  <label for="inputAddress">User E-Mail</label>
                  <input name="email" required type="text" class="form-control" value="<?php echo $email; ?>" id="inputEmail" placeholder="Your Email Address">
                  <span><?php if(!empty($email_err)) echo $email_err;?></span>
                </div>
                <div class="form-group col-12">
                  <label for="inputAddress">User Phone</label>
                  <input name="phone" required type="text" class="form-control" value="<?php echo $phone; ?>" id="inputPhone" placeholder="Your Mobile Number">
                  <span><?php if(!empty($phone_err)) echo $phone_err;?></span>
                </div>
                <div class="form-group col-12">
                  <label for="inputAddress">User DOB</label>
                  <input name="dob" required type="date" class="form-control" value="<?php echo $dob; ?>" id="inputDOB" placeholder="Cart Not Working in my machine">
                  <span><?php if(!empty($dob_err)) echo $dob_err;?></span>
                </div>
                <div class="form-group col-12">
                  <label for="inputAddress">User Mail Newsletter</label><br>
                  <div class="form-check form-check-inline">
                    <input name="mailopt" class="form-check-input" type="checkbox" value="true" id="inlineCheckbox1" <?php echo $mailopt; ?>>
                    <label class="form-check-label" for="inlineCheckbox1">Yes! I Want to Recieve E-Mails from OSTS</label>
                  </div>
                  <span><?php if(!empty($mailopt_err)) echo $mailopt_err;?></span>
                </div>
                <button type="submit" class="btn btn-success">Update Profile</button>
                <span><?php if(!empty($msg)) echo $msg;?></span>
              </form>



              </div>
                </div>
            </div>
          </div>
          <!-- /.container-fluid-->

          <!-- /.content-wrapper-->
          <footer class="sticky-footer">
            <div class="container">
              <div class="text-center">
                <small>Copyright © 2019 </small>
              </div>
            </div>
          </footer>
          <!-- Scroll to Top Button-->
          <a class="scroll-to-top rounded" href="#page-top">
            <i class="fa fa-angle-up"></i>
          </a>
          <!-- Logout Modal-->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                  <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
              </div>
            </div>
          </div>






    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
  </body>
</html>
