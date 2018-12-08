<?php
session_start();
if(!isset($_SESSION["username"])){
    header("location:../home.php");
}
?>

<html>
<body>
Login Successful
</body>
</html>