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
$work = $_POST['work'];
$price = $_POST['price'];


$sql = "INSERT INTO services(service_name,sp_id,status) VALUES ('$cat','$ayd','active')";
if($conn->query($sql)){
    $lid = $conn->insert_id;

    $sql = "INSERT INTO work(service_id,description, priceFrom, priceTo) VALUES ('$lid','$work','$price','0')";
    $conn->query($sql);

    if(!$conn){
        var_dump($conn->error);
        die;
    }

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


