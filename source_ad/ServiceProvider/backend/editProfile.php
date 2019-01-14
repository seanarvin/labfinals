<?php
/**
 * Created by PhpStorm.
 * Date: 12/29/2018
 * Time: 11:37 AM
 */

require 'db.php';
session_start();
$ayd = $_SESSION['ayd'];


$sql = "SELECT user_fname,user_lname,streetnum,housenumber,barangay,municipality,city,contact_no,email,password FROM user WHERE user_id = '$ayd'";
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

$streetnum = $_POST['streetnum'];
if(empty($streetnum)){
    $streetnum = $r[2];
}
$housenum = $_POST['housenum'];
if(empty($housenum)){
    $housenum = $r[3];
}
$bar = $_POST['bar'];
if(empty($bar)){
    $bar = $r[4];
}
$mun = $_POST['mun'];
if(empty($mun)){
    $mun = $r[5];
}
$city = $_POST['city'];
if(empty($city)){
    $city = $r[6];
}

$num = $_POST['num'];
if(empty($num)){
    $num = $r[7];
}

$email = $_POST['email'];
if(empty($email)){
    $email = $r[8];
}

$pass = $_POST['pass'];
if(empty($pass)){
    $pass = $r[9];
}


$pass2 = $_POST['pass2'];

if ($pass == $pass2){
    $p = password_hash($pass,PASSWORD_DEFAULT);
    $sql = "UPDATE user SET user_fname = '$fname',user_lname = '$lname',streetnum = '$streetnum',housenumber = '$housenum',barangay = '$bar',municipality = '$mun',city = '$city',contact_no = '$num',email = '$email',password = '$p' WHERE user_id = '$ayd'";

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





