<?php
// Initialize the session
session_start();
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id']))
{
  header("location: login.php");
}

require 'include/conn.php';
//Define variable
$name = $email = $password =$confirm_password = $phone = $dept="";
$name_err = $email_err = $password_err = $confirm_password_err = $dept_err = $phone_err = "";
$msg="";

if(isset($_SESSION['msg']) || !empty($_SESSION['msg']))
{
  $msg = $_SESSION['msg'];
  $_SESSION['msg']=false;
}


if($_SERVER["REQUEST_METHOD"] == "POST"){

  //Validate Name`
  if(empty(trim($_POST['name']))){
      $name_err = "Please enter name.";
  } else{
      $name = trim($_POST['name']);
  }

//Email Validation
  if(strlen($_POST['email']) == 0)
  {
    $email_err="Enter Email Id";
  }
  else
  {
    $email=$_POST["email"];
  }

  //Mobile Number Validation
	if(!preg_match("/[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]/",$_POST["phone"]))
	{
		$phone_err = "!Please enter a valid Mobile Number";
	}
  else {
    $phone=$_POST["phone"];
  }

  if((trim($_POST['department']))=="Choose Department"){
    //$dept_err ="Select Ticket Department";
    $dept_err ="<div class='alert alert-danger' role='alert'>
          Error : Select Ticket Department </div>";
  }else {
    $dept = trim($_POST['department']);
  }

  // Validate password
      if(empty(trim($_POST['password']))){
          $password_err = "Please enter a password.";
      } elseif(strlen(trim($_POST['password'])) < 6){
          $password_err = "Password must have atleast 6 characters.";
      } else{
          $password = trim($_POST['password']);
          $password = md5($password);
      }



      // Check input errors before inserting in database
          if(empty($name_err) &&empty($dept_err)&& empty($email_err) && empty($phone_err) && empty($password_err)){

          $sql = "SELECT * FROM staff WHERE staff_email='$email'";
          $result = mysqli_query($conn,$sql);
          $data = mysqli_num_rows($result);
          if(($data)==0){
          $sql = "INSERT INTO staff(staff_name,staff_phone,staff_email,staff_pass,department_id) VALUES ('$name','$phone','$email','$password','$dept')";
          $query = mysqli_query($conn,$sql); // Insert query
          if($query){

            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>
                Staff Added.....
              </div>";
            header("Location:addstaff.php");

          }else
          {
            $msg="<div class='alert alert-danger' role='alert'>
                Error....
              </div>";
          }
          }else{
            $msg="<div class='alert alert-danger' role='alert'>
                This email is already registered, Please try another email...
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
              <div class="col-2"></div>
              <div class="col-8">




                                <form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                  <img class="rounded mx-auto d-block" src="img/symbol.png" alt="Symbol" width="100" height="100">

                                  <label for="inputEmail" class="sr-only">Full Name</label>
                                  <input type="text" id="inputName" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Staff Name" required autofocus>
                                  <span class="help-block"><?php echo $name_err; ?></span>

                                  <label for="inputPhone" class="sr-only">Phone Number</label>
                                  <input type="text" id="inputPhone" class="form-control" name="phone" value="<?php echo $phone; ?>"  placeholder="Staff Phone Number" required>
                                  <span class="help-block"><?php echo $phone_err; ?></span>

                                  <label for="inputEmail" class="sr-only">Email address</label>
                                  <input type="email" id="inputEmail" name="email" class="form-control" value="<?php echo $email; ?>"  placeholder="Staff Email address" required>
                                  <span class="help-block"><?php echo $email_err; ?></span>

                                  <label for="inputPassword" class="sr-only">Password</label>
                                  <input type="password" id="inputPassword" name="password" class="form-control" value="<?php echo $password; ?>" placeholder="Password" required>
                                  <span class="help-block"><?php echo $password_err; ?></span>


                                     <select id="inputState" name="department" class="form-control">
                                       <option>Choose Staff Department</option>
                                       <?php
                                       $sql = "SELECT * FROM department";
                                       $result = mysqli_query($conn, $sql);
                                       if (mysqli_num_rows($result) > 0) {
                                         while($row = mysqli_fetch_assoc($result)) {
                                           $id=$row['department_id'];
                                           $name=$row['department_name'];
                                           echo '<option value="'.$id.'">'.$name.'</option>';
                                   }
                               }
                               ?>
                                     </select>
                                     <span><?php if(!empty($dept_err)) echo $dept_err;?></span>


                                <button class="btn btn-outline-success btn-block" name = "register"id="register" type="submit">Register</button>


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
