<?php
/**
 * Created by PhpStorm.
 * Date: 12/29/2018
 * Time: 11:37 AM
 */
session_start();
$ayd = $_SESSION['ayd'];

require 'db.php';


$cat = $_POST['category'];


$sp_services = "SELECT * FROM services WHERE service_name = '$cat' and sp_id = '$ayd'";
$res = $conn->query($sp_services);

if($res->num_rows == 0){
    $sql = "INSERT INTO services(service_name,sp_id,status) VALUES ('$cat','$ayd','active')";
    $conn->query($sql);
    $m = "Successfully Added!";
    echo "<script type='text/javascript'>

            alert('$m');
            window.location.replace('../services.php');
        </script>";

}else{
        $m = "Error! Category already exist!";
    echo "<script type='text/javascript'>

            alert('$m');
            window.location.replace('../services.php');
        </script>";
}


