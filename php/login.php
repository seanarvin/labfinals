<?php

require 'db.php';
session_start();
$user = $_POST['username'];
$pass = $_POST['password'];
$sql = "SELECT user_fname,user_lname,password,type,status,user_id FROM user WHERE user_name = ? && password = ?";

//$ayp = get_client_ip();
//
//if ($ayp === "::1"){
//    $ayp = "127.0.0.1";
//}

$ayp = gethostbyname($_SERVER['SERVER_NAME']);


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
        header('Location:../source_ad/Admin/index.php');
    } elseif ($r[3] == "sp") {
        $_SESSION['full'] = strtoupper($r[0] . " " . $r[1]);
        $_SESSION['userType'] =  $r[3];
        $_SESSION['ayd'] =  $r[5];
        header('Location:../source_ad/ServiceProvider/requests.php');
    }elseif ($r[3] == "client") {
        $_SESSION['full'] = strtoupper($r[0] . " " . $r[1]);
        $_SESSION['userType'] =  $r[3];
        $_SESSION['ayd'] =  $r[5];
        header('Location: //'.$ayp.':3000/index/' . $_SESSION['ayd']);
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
                window.location.replace('../index.php');
            </script>
         ";
} else {
    $m = "Wrong Credentials!";
    echo "
            <script type = 'text/javascript'>
                alert('$m');
                window.location.replace('../index.php');
            </script>
         ";
}


// Function to get the client IP address
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}


