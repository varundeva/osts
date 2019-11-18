<?php
require 'include/conn.php';
// Initialize the session
session_start();
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id']))
{
  header("location: login.php");
}


if($_SERVER["REQUEST_METHOD"] == "POST"){
  $title = $desc = $dept ="";
  $title_err = $desc_err = $dept_err="";
  $msg="";
  $user_id = $_SESSION['user_id'];
  $status = "CREATED";

  if(empty(trim($_POST['title']))){
    //$title_err ="Enter Ticket Title";
    $title_err ="<div class='alert alert-danger' role='alert'>
          Error : Ticket Title is Empty </div>";
  }else {
    $title = trim($_POST['title']);
  }

  if(empty(trim($_POST['desc']))){
    //$desc_err ="Enter Ticket Description";
    $desc_err ="<div class='alert alert-danger' role='alert'>
          Error : Write Ticket Description </div>";
  }else {
    $desc = trim($_POST['desc']);
  }

  if((trim($_POST['department']))=="Choose Department"){
    //$dept_err ="Select Ticket Department";
    $dept_err ="<div class='alert alert-danger' role='alert'>
          Error : Select Ticket Department </div>";
  }else {
    $dept = trim($_POST['department']);
  }

    if(empty($title_err) && empty($desc_err) && empty($dept_err)){

      $sql = "INSERT INTO tickets (ticket_title,ticket_desc,ticket_status,user_id,department_id) VALUES('$title','$desc','$status','$user_id','$dept')";
      $query = mysqli_query($conn,$sql); // Insert query
      if($query){
      $msg="<div class='alert alert-success' role='alert'>
          Successfully Created Ticket..
        </div>";

      }else
      {
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
              <div class="col-8">

                <!-- Contents Here -->

  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <h4>Create New Ticket </h4>
  <div class="form-group col-12">
    <label for="inputAddress">Ticket Title</label>
    <input name="title" required type="text" class="form-control" id="inputAddress" placeholder="Cart Not Working in my machine">
    <span><?php if(!empty($title_err)) echo $title_err;?></span>
  </div>
  <div class="form-group col-12">
  <label for="comment">Ticket Description</label>
  <textarea name="desc" required class="form-control" rows="4" id="comment"></textarea>
  <span><?php if(!empty($desc_err)) echo $desc_err;?></span>
</div>
    <div class="form-group col-12">
      <label for="inputState">Select Department</label>
      <select id="inputState" name="department" class="form-control">
        <option>Choose Department</option>
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
  </div>
  <button type="submit" class="btn btn-success">Create Ticket</button>
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
