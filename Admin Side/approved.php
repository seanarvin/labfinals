<?php

require 'db.php';

$aa = $_GET['num'];


$sql = "UPDATE user SET status = 'approved' WHERE user_Id = '$aa'";
$conn->query($sql);


header('Location:users.php');