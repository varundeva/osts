<?php
//starting session
session_start();
//destroying all session that exists including our username session name
//you can also remove a single session
//eg session_unset('username'); this will remove only for the username session if you have many

unset($_SESSION['user_id']);

//after destroying redirecting to login page
header("Location: index.php");
//finish();
?>
