<?php
require 'db.php';

$num = $_GET['num'];

$sql = "UPDATE user SET status = 'disabled' WHERE user_id = '$num'";
if($conn->query($sql)){
    header('Location:../users.php');
}else {


    var_dump($conn->error);
//    $m = "Error! Contact Administrator!";
//    echo "<script type='text/javascript'>
//
//            alert('$m');
//            window.location.replace('../../admin/requests.php');
//        </script>";
}