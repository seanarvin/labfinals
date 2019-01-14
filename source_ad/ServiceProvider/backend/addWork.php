<?php
/**
 * Created by PhpStorm.
 * Date: 12/29/2018
 * Time: 11:37 AM
 */
session_start();
$ayd = $_SESSION['ayd'];
$c = $_POST['waha'];
require 'db.php';


$work = $_POST['work'];
$from = $_POST['from'];
$to = $_POST['to'];


$sql = "INSERT INTO work(service_id, description, priceFrom, priceTo) VALUES ('$c','$work','$from','$to')";
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


