<?php


$conn = new mysqli("localhost","root","","dbtest");

if(!$conn){
    var_dump($conn->error);
    die;
}
?>