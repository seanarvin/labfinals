<?php
/**
 * Created by PhpStorm.
 * Date: 12/29/2018
 * Time: 11:37 AM
 */

require 'db.php';
session_start();
$ayd = $_SESSION['ayd'];


$sql = "SELECT user_fname,user_lname,address,contact_no,email,password FROM user WHERE user_id = '$ayd'";
$res = $conn->query($sql);
$r = $res->fetch_row();


$fname = $_POST['fname'];
if(empty($fname)){
    $fname = $r[0];
}


$lname = $_POST['lname'];
if(empty($lname)){
    $lname = $r[1];
}

$addr = $_POST['addr'];
if(empty($addr)){
    $addr = $r[2];
}

$num = $_POST['num'];
if(empty($num)){
    $num = $r[3];
}

$email = $_POST['email'];
if(empty($email)){
    $email = $r[4];
}

$pass = $_POST['pass'];
if(empty($pass)){
    $pass = $r[5];
}


$pass2 = $_POST['pass2'];

if ($pass == $pass2){
    $p = password_hash($pass,PASSWORD_DEFAULT);
    $sql = "UPDATE user SET user_fname = '$fname',user_lname = '$lname',address = '$addr',contact_no = '$num',email = '$email',password = '$p' WHERE user_id = '$ayd'";

    if($conn->query($sql)) {
        $_SESSION['full'] = strtoupper($fname . " " .$lname);
        header('Location:../requests.php');
    }else{
        var_dump($conn->error);
        die();
    }
}else{

    $m = "Password dont match!";
    echo "<script type='text/javascript'>

            alert('$m');
            window.location.replace('../requests.php');
        </script>";
}





