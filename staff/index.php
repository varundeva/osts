<?php
// Initialize the session
session_start();
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['staff_id']) || empty($_SESSION['staff_id']))
{
  header("location: login.php");
}

$user_id = $_SESSION['staff_id'];

  
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





                <!-- Icon Cards-->
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-comments"></i>
                </div>
                <?php
                include('include/conn.php');
                $sql = "SELECT * FROM `tickets` WHERE ticket_status='STAFF REPLY'";
                if($result= mysqli_query($conn,$sql)){
                      $staffreply=mysqli_num_rows($result);
                      echo '<div class="ml-5"><b><h1>'.$staffreply.'</h1></b></div>';
                      mysqli_free_result($result);
                }
                ?>
                <div class="mr-5"> Tickets Waiting for User Reply</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="viewtickets.php?ticketstatus=staffreply">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fa fa-angle-right" aria-hidden="true"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-list"></i>
                </div>
                <?php
                include('include/conn.php');
                $sql = "SELECT * FROM `tickets` WHERE ticket_status='USER REPLY'";
                if($result= mysqli_query($conn,$sql)){
                      $youreply=mysqli_num_rows($result);
                      echo '<div class="ml-5"><b><h1>'.$youreply.'</h1></b></div>';
                      mysqli_free_result($result);
                }
                ?>
                <div class="mr-5"> Tickets Waiting for Your Reply</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="viewtickets.php?ticketstatus=userreply">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fa fa-angle-right" aria-hidden="true"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-shopping-cart"></i>
                </div>
                <?php
                include('include/conn.php');
                $sql = "SELECT * FROM `tickets` WHERE ticket_status='CREATED'";
                if($result= mysqli_query($conn,$sql)){
                  $closed=mysqli_num_rows($result);
                  echo '<div class="ml-5"><b><h1>'.$closed.'</h1></b></div>';
                  mysqli_free_result($result);
                }
                ?>
                <div class="mr-5">Tickets are Open/Created</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="viewtickets.php?ticketstatus=created">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fa fa-angle-right" aria-hidden="true"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-life-ring"></i>
                </div>
                <?php
                include('include/conn.php');
                $sql = "SELECT * FROM `tickets` WHERE ticket_status='CLOSED'";
                if($result= mysqli_query($conn,$sql)){
                  $closed=mysqli_num_rows($result);
                  echo '<div class="ml-5"><b><h1>'.$closed.'</h1></b></div>';
                  mysqli_free_result($result);
                }
                ?>
                <div class="mr-5">Tickets are Closed</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="viewtickets.php?ticketstatus=closed">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fa fa-angle-right" aria-hidden="true"></i>
                </span>
              </a>
            </div>
          </div>
        </div>



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
