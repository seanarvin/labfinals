<?php
require 'db.php';
$a = $_GET['ayd'];
$sql = "SELECT work_id,description,priceFrom,priceTo FROM work where service_id = '$a'";
$res = $conn->query($sql);
$r = $res->fetch_all();
echo json_encode($r);