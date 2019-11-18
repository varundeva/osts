<?php
// Initialize the session
session_start();
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id']))
{
  header("location: login.php");
}
$title=$desc=$status = $dept_id = $time= $id = $user_id=$staff_id ="";

$user_id = isset($_SESSION['user_id']);

if(!empty($_POST['id'])){
  $id = $_POST['id'];
}else if(!empty($_GET['id'])){
  $id = $_GET['id'];
}else {
  header("location: tickets.php");
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


if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Submit'])){
  $status = "USER REPLY";
  $cmnt ="";
  $cmnt_err = $err ="";


  if(empty(trim($_POST['comment']))){
    //$title_err ="Enter Ticket Title";
    $cmnt_err ="<div class='alert alert-danger' role='alert'>
          Error : Ticket Title is Empty </div>";
  }else {
    $cmnt = trim($_POST['comment']);
  }

  if(empty(trim($_POST['staffid']))){
    //$title_err ="Enter Ticket Title";
    $err ="<div class='alert alert-danger' role='alert'>
          Error : Ticket Title is Empty </div>";
  }else {
    $staff_id = trim($_POST['staffid']);
  }
  if(empty(trim($_POST['deptid']))){
    //$title_err ="Enter Ticket Title";
    $err ="<div class='alert alert-danger' role='alert'>
          Error : Ticket Title is Empty </div>";
  }else {
    $dept_id = trim($_POST['deptid']);
  }
    if(empty($cmnt_err)){
    echo $id;
    require 'include/conn.php';
  //$sql = "INSERT INTO `message`(`msg_id`,`msg_content`, `ticket_id`, `user_id`, `staff_id`, `department_id`, `replied_by`,`timestamp`) VALUES ('$cmnt','$id','$user_id','$staff_id','$dept_id','$status')";
      $sql = "INSERT INTO message (msg_content,ticket_id,user_id,staff_id,department_id,replied_by) VALUES('$cmnt','$id','$user_id','$staff_id','$dept_id','$status')";
      $query = mysqli_query($conn,$sql); // Insert query
      if($query){
        $sql="UPDATE tickets SET ticket_status='$status' WHERE ticket_id='$id'";
        if(mysqli_query($conn,$sql))
        {
          $msg="<div class='alert alert-success' role='alert'>
          Successfully Replied..
        </div>";
        }
      }else
      {
        $msg="<div class='alert alert-danger' role='alert'>
            Error : Something Went Wrong..
          </div>";
      }
    }
  }


  function closebutton($status){
    if($status!="CLOSED"){
    return  '<button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#closeModal">Close Ticket</button>';
    }
  }

  if(isset($_POST['closeticket'])) {
    require 'include/conn.php';
      $sql = "UPDATE `tickets` SET `ticket_status`= 'CLOSED' WHERE `ticket_id`= $id";
      if(mysqli_query($conn, $sql))
      {
        $msg="<div class='alert alert-success' role='alert'>
        Ticket Closed..
      </div>";
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
    <style>
    .pb-cmnt-container {
        font-family: Lato;
        margin-top: 100px;
    }

    .pb-cmnt-textarea {
        resize: none;
        padding: 20px;
        height: 130px;
        width: 100%;
        border: 1px solid #F2F2F2;
    }

    .container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}

</style>
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

              <?php
              require 'include/conn.php';
              $sql = "SELECT * FROM tickets,department WHERE ticket_id='$id' AND department.department_id=tickets.department_id ORDER BY timestamp desc";
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                  $title=$row['ticket_title'];
                  $desc=$row['ticket_desc'];
                  $status = $row['ticket_status'];
                  $dept = $row['department_name'];
                  $time=$row['timestamp'];
                  $dept_id= $row['department_id'];

                  echo '<div class="media border p-3">
                    <div class="media-body">
                      <h4>'.$title.''. statusfun($status).'
                      </h4>
                      '.closebutton($status).'
                      <p>'.$desc.'</p>

                        <small class="float-right"><i>Created on '.$time.'</i></small>
                    </div>
                  </div>';
                  }
                }
                ?>

<!-- Conversation Section Starts -->
<?php
require 'include/conn.php';
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM message WHERE ticket_id='$id' AND user_id = '$user_id' ORDER BY timestamp asc";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    $msg_id = $row['msg_id'];
    $msg_cont = $row['msg_content'];
    $time=$row['timestamp'];
    $replyby=$row['replied_by'];
    $staff_id = $row['staff_id'];
  //  $user_name=$row['user_name'];
  //  $staff_name=$row['staff_name'];

    if($replyby =="STAFF REPLY")
    echo '<div class="container">
      <img src="img/staff.png" alt="Avatar" style="width:100%;">
      <p>'.$msg_cont.'</p>
      <span class="time-right">'.$time.'</span>
    </div>';
    else
    echo '<div class="container darker">
      <img src="img/user.png" alt="Avatar" class="right" style="width:100%;">
      <p>'.$msg_cont.'</p>
      <span class="time-left">'.$time.'</span>
    </div>';

    }
  }
  ?>
<!-- Conversation Secction Ends Here -->
                  <?php
                  if($status!="CLOSED")
                  {?>
                    <div class="media border p-3">
                      <div class="media-body">
                      <div class="row">
                          <div class="col-md-12 col-md-offset-3">
                              <div class="panel panel-info">
                                  <div class="panel-body">
                                      <form class="form-inline" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                          <textarea placeholder="Write your comment here!" name="comment" class="pb-cmnt-textarea "></textarea>
                                          <input hidden name="id" value="<?php echo $id; ?>">
                                          <input hidden name="deptid" value="<?php echo $dept_id; ?>">
                                          <input hidden name="staffid" value="<?php echo $staff_id; ?>">
                                          <button class="btn btn-primary mt-1 pull-right" name="Submit" type="submit">Submit</button>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  </div>
                <?php }else { ?>
                  <div class="media border p-3">
                    <div class="media-body">
                    <div class="row">
                        <div class="col-md-12 col-md-offset-3">
                            <div class="panel panel-info">
                                <div class="panel-body">
                                    <form class="form-inline">
                                        <textarea disabled required placeholder="Write your comment here!" class="pb-cmnt-textarea "></textarea>
                                        <button disabled class="btn btn-primary mt-1 pull-right" type="button">Submit</button>
                                    </form>
                                    <span><?php if(!empty($cmnt_err)) echo $cmnt_err;?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="alert alert-danger">
                  <strong>Sorry!</strong> Cannot Reply For Closed Tickets.
                </div>
                <?php }
                    ?>
                    <span><?php if(!empty($msg)) echo $msg;?></span>






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

          <!-- Close Ticket Modal-->
          <div class="modal fade" id="closeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Do you really want to Close this Ticket?</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">If you close the ticket you can't reply to this ticket anymore. If your issue is resolved you can close this. </div>
                <div class="modal-footer">
                  <form method="post">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                  <button class="btn btn-primary" name="closeticket" type="submit" >Yes Close</button>
                </form>

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
