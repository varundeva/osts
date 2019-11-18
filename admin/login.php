<?php
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(isset($_SESSION['admin_id']) || !empty($_SESSION['admin_id']))
{
  header("location: index.php");
}
require 'include/conn.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
$email = $password = "";
$email_err = $password_err ="";
$msg="";

//Email Validation
  if(strlen($_POST['email']) == 0)
  {
    $email_err="Enter Email Id";
  }
  else
  {
    $email=$_POST["email"];
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

	//our sql statement that we will execute
	$sql = "SELECT * FROM admin WHERE admin_email='$email' AND admin_pass='$password'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
      if($row = mysqli_fetch_assoc($result)) {
        $_SESSION['admin_id']=$row['admin_id'];
        header("Location:index.php");
        exit();
      } else {
        $msg="<div class='alert alert-danger' role='alert'>
              Error : Something Went Wrong </div>";      }
  } else {
    $msg="<div class='alert alert-danger' role='alert'>
          Error : Invalid Login Credentials </div>";
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
    <!-- Include JS File Here -->

    <script type="text/javascript" src="js/registration.js"></script>
    <title>Login</title>

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
     <!-- Custom styles for this template -->
    <link href="css/usersmgmt.css" rel="stylesheet">
  </head>
  <body>
<div class="bg-image"></div>




    <form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <img class="rounded mx-auto d-block" src="img/symbol.png" alt="Symbol" width="100" height="100">
  <h1 class="h3 mb-3 font-weight-normal text-center text-white">OSTS Admin Login</h1>
<div class="form-group">
  <label for="inputEmail" class="sr-only">Email address</label>
  <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
</div>
<div class="form-group">
  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
</div>
  <button class="btn btn-outline-success btn-block mt-2" type="submit">Sign in</button>
  <span><?php if(!empty($msg)) echo $msg;?></span>
  <p class="mt-5 text-center text-black">CopyRight &copy; 2019 OSTS</p>
</form><div class="bg-image"></div>








    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
