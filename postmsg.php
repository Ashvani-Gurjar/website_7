<?php

include 'db_connect.php';


 $msg =$_POST['text'];
 $room =$_POST['room'];
 $ip=$_POST['ip'];

$sql = "INSERT INTO `msgs` (`msg`, `room`, `ip`, `stime`) VALUES ('$msg', '$room', '$ip', CURRENT_TIMESTAMP);";
mysqli_query($conn,$sql);
mysqli_close($conn);

 ?>
