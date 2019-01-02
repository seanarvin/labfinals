<?php

$conn = new mysqli("localhost","root","toor","db");
if(!$conn){
    echo "Database Error" . $conn->error;
}