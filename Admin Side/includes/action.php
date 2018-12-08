<?php
    include_once('db.php');

    $hostname = "www.db.com";
    $username = "root1";
    $password = "";
    $databaseName = "db";
    $id = $_GET['change'];
    $stat = $_GET['stat'];

    $active = "active";

    $connect = mysqli_connect($hostname, $username, $password, $databaseName);
 
    if($stat == $active) { 
        $query = "UPDATE `users` SET `status`='deactivated' where user_id=$id ";
        $result = mysqli_query($connect, $query);
        mysqli_close($connect);
        header("Refresh:0; ../home.php");

    } 
    else { 
        $query = "UPDATE `users` SET `status`='active' where user_id=$id ";
        $result = mysqli_query($connect, $query);
        mysqli_close($connect);
        header("Refresh:0; ../home.php");
    } 
?>