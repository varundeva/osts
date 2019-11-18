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
$name = $desc="";
$name_err = $desc_err = "";
$msg="";

if($_SERVER["REQUEST_METHOD"] == "POST"){

  //Validate Name`
  if(empty(trim($_POST['name']))){
      $name_err = "Please enter Department Name.";
  } else{
      $name = trim($_POST['name']);
  }

  if(empty(trim($_POST['desc']))){
      $desc_err = "Please Department Description.";
  } else{
      $desc = trim($_POST['desc']);
  }


      // Check input errors before inserting in database
          if(empty($name_err) && empty($desc_err)){

          $sql = "SELECT * FROM department WHERE department_name='$name'";
          $result = mysqli_query($conn,$sql);
          $data = mysqli_num_rows($result);
          if(($data)==0){
          $sql = "INSERT INTO department(department_name,department_desc) VALUES ('$name','$desc')";
          $query = mysqli_query($conn,$sql); // Insert query
          if($query){

            $msg = "<div class='alert alert-success' role='alert'>
                Department Added.....
              </div>";

          }else
          {
            $msg="<div class='alert alert-danger' role='alert'>
                Error....
              </div>";
          }
          }else{
            $msg="<div class='alert alert-danger' role='alert'>
                This Department Already Added...
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

                                  <label for="inputEmail" class="sr-only">Department Name</label>
                                  <input type="text" id="inputName" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Deaprtmment Name" required autofocus>
                                  <span class="help-block"><?php echo $name_err; ?></span>

                                  <label for="inputPhone" class="sr-only">Department Description</label>
                                  <input type="text" id="inputPhone" class="form-control" name="desc" value="<?php echo $desc; ?>"  placeholder="Department Description" required>
                                  <span class="help-block"><?php echo $desc_err; ?></span>

                                <button class="btn btn-outline-success btn-block" name = "register"id="register" type="submit">Submit</button>


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
