<?php

$conn = new mysqli("localhost","root","","db");
if(!$conn){
    echo "Database Error" . $conn->error;
}