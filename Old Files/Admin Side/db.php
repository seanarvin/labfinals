<?php


$conn = new mysqli("localhost","root","toor","db");

if(!$conn){
    echo "Error Connecting to DB " . $conn->error;
    die;
}