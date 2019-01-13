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


$sp_services = "SELECT id FROM `spservices` WHERE category = '$cat' and sp_id = '$ayd'";
$res = $conn->query($sp_services);

if($res->num_rows == 0){
    $sql = "INSERT INTO services(category) VALUES ('$cat')";
    $conn->query($sql);


}

$sp_services = "SELECT id FROM `spservices` WHERE category = '$cat' and sp_id = '$ayd'";
$res = $conn->query($sp_services);

if ($res->num_rows > 0) {
	$row = $res->fetch_assoc();
	$lid = $row["id"];
}else{
	$sql = "INSERT INTO spservices(category, sp_id) VALUES ('$cat','$ayd')";
	if($conn->query($sql)){
		$lid = $conn->insert_id;
	}else{
		var_dump($conn->error);
	}
}



$sql = "INSERT INTO spwork(work, spservice_id, price,status) VALUES ('$work','$lid','$price','enabled')";

if($conn->query($sql)){
	header('Location:../services.php');
}else {
	var_dump($conn->error);
}