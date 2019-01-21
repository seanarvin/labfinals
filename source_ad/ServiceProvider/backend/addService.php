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
$w = [];
foreach ($work as $a){
    array_push($w,$a);
}
$price = $_POST['price'];
$p = [];
foreach ($price as $a){
    array_push($p,$a);
}


$sql = "INSERT INTO services(service_name,sp_id,status) VALUES ('$cat','$ayd','active')";
if($conn->query($sql)){
    $lid = $conn->insert_id;

    for($i = 0;count($work) > $i;$i++){
        $sql = "INSERT INTO work(service_id,description, priceFrom, priceTo) VALUES ('$lid','$work[$i]','$price[$i]','0')";
        $conn->query($sql);
    }


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


