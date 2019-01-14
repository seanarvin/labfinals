<?php
/**
 * Created by PhpStorm.
 * Date: 12/29/2018
 * Time: 11:37 AM
 */

require 'db.php';


$num = $_GET['num'];

$sql = "UPDATE services SET status = 'disabled' WHERE service_id = '$num'";

if($conn->query($sql)){
    header('Location:../services.php');
}else {


    var_dump($conn->error);
//    $m = "Error! Contact Administrator!";
//    echo "<script type='text/javascript'>
//
//            alert('$m');
//            window.location.replace('../../admin/requests.php');
//        </script>";
}