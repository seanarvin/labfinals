<?php
/**
 * Created by PhpStorm.
 * Date: 12/29/2018
 * Time: 11:37 AM
 */
session_start();
$ayd = $_SESSION['ayd'];
require 'db.php';


$work = $_POST['work'];
$from = $_POST['from'];
$spid = $_POST['spid'];


$sql = "INSERT INTO work(service_id, description, priceFrom, priceTo,status) VALUES ('$spid','$work','$from','0','active')";
$res = $conn->query($sql);
if($res){
    $m = "Successfully Added!";
    echo "<script type='text/javascript'>

            alert('$m');
            window.location.replace('../services.php');
        </script>";

}else{
        $m = "Error! Work already exist!";
    echo "<script type='text/javascript'>

            alert('$m');
            window.location.replace('../services.php');
        </script>";
}


