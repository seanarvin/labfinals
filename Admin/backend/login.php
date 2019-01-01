<?php

require 'db.php';
session_start();
$user = $_POST['username'];
$pass = $_POST['password'];
$sql = "SELECT user_fname,user_lname,password,type,status,user_id FROM user WHERE user_fname = ? && password = ?";


$st = $conn->prepare($sql);
$st->bind_param('ss', $user, $pass);
$st->execute();
$res = $st->get_result();
$r = $res->fetch_row();
if ($res->num_rows > 0 && $r[4] == 'active') {

    if ($r[3] == "admin") {
        $_SESSION['full'] = strtoupper($r[0] . " " . $r[1]);
        $_SESSION['userType'] =  $r[3];
        $_SESSION['ayd'] =  $r[5];
        header('Location:../dashboard.php');
    } elseif ($r[3] == "sp") {
        $_SESSION['full'] = strtoupper($r[0] . " " . $r[1]);
        $_SESSION['userType'] =  $r[3];
        $_SESSION['ayd'] =  $r[5];
        header('Location:../../Admin/services.php');
    }elseif ($r[3] == "user") {
        $_SESSION['full'] = strtoupper($r[0] . " " . $r[1]);
        $_SESSION['userType'] =  $r[3];
        $_SESSION['ayd'] =  $r[5];
        header('Location:../user/delivery.php');
    } else {
        $m = "Error login, Unknown user type! Contact Administrator";
        echo "
            <script type = 'text/javascript'>
                alert('$m');
                window.location.replace('../index.php');
            </script>
         ";
    }
} elseif ($res->num_rows > 0 && $r[4] == 'disabled') {
    $m = "Account is Disabled! Please contact administrator";
    echo "
            <script type = 'text/javascript'>
                alert('$m');
                window.location.replace('../../index.php');
            </script>
         ";
} else {
    $m = "Wrong Credentials!";
    echo "
            <script type = 'text/javascript'>
                alert('$m');
                window.location.replace('../../index.php');
            </script>
         ";
}