<?php
/**
 * Created by PhpStorm.
 * Date: 12/29/2018
 * Time: 11:37 AM
 */
session_start();
$ayd = $_SESSION['ayd'];

require 'db.php';


$cat = $_POST['category'];
$work = $_POST['work'];
$price = $_POST['price'];


$sql = "INSERT INTO spservices(category, sp_id) VALUES ('$cat','$ayd')";
if($conn->query($sql)){
    $lid = $conn->insert_id;
}else{
    var_dump($conn->error);
}



$sql = "INSERT INTO spwork(work, spservice_id, price) VALUES ('$work','$lid','$price')";

if($conn->query($sql)){
    header('Location:../requests.php');
}else {
    var_dump($conn->error);
}