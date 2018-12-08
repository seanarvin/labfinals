<?php

require 'db.php';

$fname = $_POST['first_name'];
$lname = $_POST['last_name'];
$address = $_POST['address'];
$num = $_POST['contact_No'];
$user = $_POST['username'];
$pass = $_POST['password'];
$type = $_POST['acc_Type'];


if($_POST['password'] != $_POST['password2']){
    $m = "Password not Match!";
    echo "
            <script type = 'text/javascript'>
                alert('$m');
                window.location.replace('index.php#toregister');
            </script>
         ";
}else{
    $sql = "INSERT INTO user (first_name, last_name, address, contact_No, username, password, acc_Type, status) 
    VALUES('$fname', '$lname', '$address', '$num', '$user', '$pass', '$type', 'pending')";
    $r = $conn->query($sql);
    if(!$r){ 
        $m = "Error!";

        echo "
            <script type = 'text/javascript'>
                alert('$m');
                window.location.replace('index.php');
            </script>
         ";
    } else{

    $m = "Success!";
    echo "
            <script type = 'text/javascript'>
                alert('$m');
                window.location.replace('index.php');
            </script>
         ";
     }
}

