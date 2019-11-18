


<?php
require 'include/conn.php';
// Initialize the session
session_start();
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id']))
{
  header("location: login.php");
}
$user_id = $_SESSION['user_id'];

  $ticketstatus="";
  if(!empty($_GET["ticketstatus"])){
    $ticketstatus = $_GET["ticketstatus"];

  }

function statusfun($status){
  switch ($status) {
    case 'CLOSED':
      return '<span class="badge badge-danger float-right">'. $status.'</span>';
      break;
      case 'CREATED':
        return '<span class="badge badge-success float-right">'. $status.'</span>';
        break;
      case 'STAFF REPLY':
        return '<span class="badge badge-secondary float-right">'. $status.'</span>';
        break;
      case 'USER REPLY':
        return '<span class="badge badge-warning float-right">'. $status.'</span>';
        break;
    default:
      // code...
      break;
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

                <!-- Contents Here -->


                <?php
                $sql = "SELECT * FROM tickets,department WHERE user_id='$user_id' AND department.department_id=tickets.department_id ORDER BY timestamp desc";
                if($ticketstatus){
                  switch ($ticketstatus) {
                    case 'staffreply':
                    $sql = "SELECT * FROM tickets,department WHERE user_id='$user_id' AND department.department_id=tickets.department_id and tickets.ticket_status='STAFF REPLY' ORDER BY timestamp desc";
                      break;
                      case 'userreply':
                      $sql = "SELECT * FROM tickets,department WHERE user_id='$user_id' AND department.department_id=tickets.department_id and tickets.ticket_status='USER REPLY' ORDER BY timestamp desc";
                        break;
                      case 'created':
                      $sql = "SELECT * FROM tickets,department WHERE user_id='$user_id' AND department.department_id=tickets.department_id and tickets.ticket_status='CREATED' ORDER BY timestamp desc";
                        break;
                      case 'closed':
                      $sql = "SELECT * FROM tickets,department WHERE user_id='$user_id' AND department.department_id=tickets.department_id and tickets.ticket_status='CLOSED' ORDER BY timestamp desc";
                          break;
                    default:
                    $sql = "SELECT * FROM tickets,department WHERE user_id='$user_id' AND department.department_id=tickets.department_id ORDER BY timestamp desc";
                      break;
                  }
                }
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                  while($row = mysqli_fetch_assoc($result)) {
                    $title=$row['ticket_title'];
                    $desc=$row['ticket_desc'];
                    $status = $row['ticket_status'];
                    $dept = $row['department_name'];
                    $time=$row['timestamp'];
                    $id=$row['ticket_id'];


                    echo '<div class="col-12 media border p-3">
                        <div class="media-body col-12">
                        <h4><a href="ticketdetail.php?id='.$id.'">'.$title.'</a>&nbsp&nbsp&nbsp'. statusfun($status).'</h4>
                        <p>'.substr($desc, 0, 75).'...</p>
                        <small class="float-right"><i>Created on '.$time.'</i></small>
                      </div>
                    </div>';
                    //echo '<option value="'.$id.'">'.$name.'</option>';
            }
        }
                 ?>
                <!-- Contents Above -->

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
