<?php


require 'db.php';
$first = $_POST['first_name'];
$last = $_POST['last_name'];
$address = $_POST['address'];
$num = $_POST['num'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
//$password = password_hash($pass,PASSWORD_BCRYPT);
$type = $_POST['type'];


if ($password == $password2) {
    $sql = "INSERT INTO user(password, user_fname, user_lname, contact_no, address, user_name, email, status, type) VALUES('$password','$first','$last','$num','$address','$username','$email','pending','$type')";
    if ($conn->query($sql)) {

        header('Location:../index.php');
    } else {


        var_dump($conn->error);
//    $m = "Error! Contact Administrator!";
//    echo "<script type='text/javascript'>
//
//            alert('$m');
//            window.location.replace('../../admin/requests.php');
//        </script>";
    }
}else{
    $m = "Error! Password dont match!";
    echo "<script type='text/javascript'>

            alert('$m');
            window.location.replace('../index.php#toregister');
        </script>";

}


