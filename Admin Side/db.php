<?php


$conn = new mysqli("localhost","root","","db");

if(!$conn){
    echo "Error Connecting to DB " . $conn->error;
    die;
}