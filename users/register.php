<?php

// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(isset($_SESSION['user_id']) || !empty($_SESSION['user_id']))
{
  header("location: index.php");
}

require 'include/conn.php';
//Define variable
$name = $email = $password =$confirm_password = $phone ="";
$name_err = $email_err = $password_err = $confirm_password_err = $phone_err = "";
$msg="";
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

  // Validate password
      if(empty(trim($_POST['password']))){
          $password_err = "Please enter a password.";
      } elseif(strlen(trim($_POST['password'])) < 6){
          $password_err = "Password must have atleast 6 characters.";
      } else{
          $password = trim($_POST['password']);
      }

      // Validate confirm password
      if(empty(trim($_POST["confirm_password"]))){
          $confirm_password_err = 'Please confirm password.';
      } else{
          $confirm_password = trim($_POST['confirm_password']);
          if($password != $confirm_password){
              $confirm_password_err = 'Password did not match.';
          }else {
            $password = md5($password);
          }
      }

      // Check input errors before inserting in database
          if(empty($name_err) && empty($email_err) && empty($phone_err) && empty($password_err) && empty($confirm_password_err)){

          $sql = "SELECT * FROM users WHERE user_email='$email'";
          $result = mysqli_query($conn,$sql);
          $data = mysqli_num_rows($result);
          if(($data)==0){
          $sql = "INSERT INTO users(user_name,user_email,user_phone,user_pass) VALUES ('$name','$email','$phone','$password')";
          $query = mysqli_query($conn,$sql); // Insert query
          if($query){
          $msg="<div class='alert alert-success' role='alert'>
              You have Successfully Registered.....
            </div>";

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 <script
      src="https://code.jquery.com/jquery-3.4.1.min.js"
      integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
      crossorigin="anonymous"></script>
    <title>Register</title>
     <!-- Custom styles for this template -->
    <link href="css/usersmgmt.css" rel="stylesheet">
    <script type="text/javascript" src="js/registration.js"></script>
      <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>


  </head>
  <body>
<div class="bg-image"></div>
<form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <img class="rounded mx-auto d-block" src="img/symbol.png" alt="Symbol" width="100" height="100">
  <h1 class="h3 mb-3 font-weight-normal text-center text-white">OSTS Users Register</h1>

  <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
  <label for="inputEmail" class="sr-only">Full Name</label>
  <input type="text" id="inputName" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Full Name" required autofocus>
  <span class="help-block"><?php echo $name_err; ?></span>
  </div>

  <div class="form-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
  <label for="inputPhone" class="sr-only">Phone Number</label>
  <input type="text" id="inputPhone" class="form-control" name="phone" value="<?php echo $phone; ?>"  placeholder="Phone Number" required>
  <span class="help-block"><?php echo $phone_err; ?></span>
  <div>

  <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
  <label for="inputEmail" class="sr-only">Email address</label>
  <input type="email" id="inputEmail" name="email" class="form-control" value="<?php echo $email; ?>"  placeholder="Email address" required>
  <span class="help-block"><?php echo $email_err; ?></span>
  </div>

  <div class="form-group  <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" id="inputPassword" name="password" class="form-control" value="<?php echo $password; ?>" placeholder="Password" required>
  <span class="help-block"><?php echo $password_err; ?></span>
  <div>

  <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
  <label for="inputPassword" class="sr-only">Confirm Password</label>
  <input type="password" id="inputCnfPassword" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>"  placeholder="Confirm Password" required>
   <span class="help-block"><?php echo $confirm_password_err; ?></span>
</div>

  <p class="text-center text-white mt-2">Already Registerd? Login Now <a href="login.php">Click Here</a></p>
<span id="loading">
  <div class="text-center">
  <div class="spinner-border text-light" role="status">
    <span class="sr-only">Loading...</span>
  </div>
</div>
</span>
<div class="form-group">
  <button class="btn btn-outline-success btn-block" name = "register"id="register" type="submit">Register</button>
</div>
<span><?php if(!empty($msg)) echo $msg;?></span>
  <p class="mt-5 text-center text-black">CopyRight &copy; 2019 OSTS</p>
</form>





    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
