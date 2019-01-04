<?php
/**
 * Created by PhpStorm.
 * Date: 12/29/2018
 * Time: 11:37 AM
 */

require 'db.php';


$note = $_POST['note'];
$ayd = $_POST['ayd'];


$sql = "UPDATE requests SET status = 'cancelled',note = '$note' WHERE req_id = '$ayd'";

if($conn->query($sql)){
    header('Location:../requests.php');
}else {


    var_dump($conn->error);
//    $m = "Error! Contact Administrator!";
//    echo "<script type='text/javascript'>
//
//            alert('$m');
//            window.location.replace('../../admin/requests.php');
//        </script>";
}