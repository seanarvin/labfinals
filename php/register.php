<?php


require 'db.php';
$first = $_POST['first_name'];
$last = $_POST['last_name'];
$barangay = $_POST['barangay'];
$housenum = $_POST['housenum'];
$streetnum = $_POST['streetnum'];
$mun = $_POST['mun'];
$city = $_POST['city'];
$num = $_POST['num'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$type = $_POST['type'];


if ($password == $password2) {


    $p = password_hash($password, PASSWORD_DEFAULT);


    $sql = "INSERT INTO user(password, user_fname, user_lname, contact_no, barangay,housenumber,street,municipality,city,user_name, email, status, type) VALUES('$p','$first','$last','$num','$barangay','$housenum','$streetnum','$mun','$city','$username','$email','pending','$type')";
    if ($conn->query($sql)) {
        $m = "Success! Waiting for approval.";
        echo "<script type='text/javascript'>

            alert('$m');
            window.location.replace('../index.php');
        </script>";
    } else {


        var_dump($conn->error);

    }
} else {
    $m = "Error! Password dont match!";
    echo "<script type='text/javascript'>

            alert('$m');
            window.location.replace('../index.php#toregister');
        </script>";

}


