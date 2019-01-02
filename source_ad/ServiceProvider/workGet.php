<?php
require 'backend/db.php';
$a = $_GET['ayd'];
$sql = "SELECT description,work_id FROM work where service_id = '$a'";
$res = $conn->query($sql);
$r = $res->fetch_all();
echo json_encode($r);