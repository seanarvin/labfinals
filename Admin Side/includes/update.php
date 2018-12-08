<?php
    include_once('db.php');

    
    $hostname = "www.db.com";
    $username = "root1";
    $password = "";
    $databaseName = "db";
    $id = $_GET['update'];
    
    // connect to mysql
    $connect = mysqli_connect($hostname, $username, $password, $databaseName);
    // mysql delete query 
    $query = "UPDATE `users` SET `status`='active' where user_id=$id ";
    $result = mysqli_query($connect, $query);

    mysqli_close($connect); 

   header("Location:approve.deny.php");
?>