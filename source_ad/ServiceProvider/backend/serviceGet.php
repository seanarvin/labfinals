<?php
require 'db.php';
session_start();
$ayd = $_SESSION['ayd'];
$category = $_GET['category'];

$sql = "SELECT * FROM `services` WHERE sp_id = '$ayd' AND status ='active' AND LOWER(service_name)=LOWER('$category')";


$res = $conn->query($sql);
$valid = true;

if($res->num_rows > 0 ){
	$valid = false;
}

echo json_encode($valid);