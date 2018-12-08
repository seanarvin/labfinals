<?php
    include_once('db.php');

    $hostname = "www.db.com";
    $username = "root1";
    $password = "";
    $databaseName = "db";
    $id = $_GET['delete'];
    
    // connect to mysql
    $connect = mysqli_connect($hostname, $username, $password, $databaseName);
    // mysql delete query 
    $query = "DELETE FROM `users` WHERE `user_id` = $id";
    $result = mysqli_query($connect, $query);

    mysqli_close($connect); 
    
    header("Refresh:0.5; ../approve.deny.php");
?>



