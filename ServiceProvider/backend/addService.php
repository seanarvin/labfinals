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

$sql = "INSERT INTO sp";

$st = $conn->prepare($sql);
$st->bind_param('is',$ayd,$cat);
if($st->execute()){
    $sql = "INSERT INTO spwork(work,spservice_id,price) VALUES ('$work','')"
}else{
    var_dump($conn->error);
}

if($conn->query($sql)){
    header('Location:../requests.php');
}else {

}