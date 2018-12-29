<?php

require 'db.php';

$user_id = $_POST['user_id'];
$password = $_POST['password'];
$user_fname = $_POST['user_fname'];
$user_lname = $_POST['user_lname'];
$user_contact_no = $_POST['contact_no'];
$address = $_POST['address'];
$user_role = $_POST['user_role'];
$user_name = $_POST['user_name'];
$email = $_POST['email'];


if($_POST['password'] != $_POST['password2']){
    $m = "Password not Match!";
    echo "
            <script type = 'text/javascript'>
                alert('$m');
                window.location.replace('index.php#toregister');
            </script>
         ";
}else{
    $sql = "INSERT INTO user (user_id, password, user_fname, user_lname, contact_no, address, user_role, user_name, email) 
    VALUES('$user_fname', '$user_lname', '$address', '$user', '$user_name', '$password', 'pending')";
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

