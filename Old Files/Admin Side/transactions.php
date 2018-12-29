<?php
session_start();


if(!isset($_SESSION['username'])){
    $m = "Please Login first!";
    echo "
            <script type = 'text/javascript'>
                alert('$m');
                window.location.replace('../index.php');
            </script>
         ";
}

if($_SESSION['userType'] != 'Admin' ){
    $m = "Unauthorize Success!";
    echo "
                <script type = 'text/javascript'>
                    alert('$m');
                    window.location.replace('../index.php');
                </script>
             ";
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Paper Dashboard by Creative Tim</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />

    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">

</head>
<body>

<div class="wrapper">
	<div class="sidebar" data-background-color="white" data-active-color="danger">

    <!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="" class="simple-text"><strong>
                        <?php
                        echo $_SESSION['username'];

                        ?>
                    </strong></a>
            </div>

            <ul class="nav">
                <li >
                    <a href="dashboard.php">
                        <i class="ti-panel"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="users.php">
                        <i class="ti-view-list-alt"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="active">
                    <a href="transactions.php">
                        <i class="ti-bell"></i>
                        <p>Transactions</p>
                    </a>
                </li>
                <li class="active-pro">
                    <a href="logout.php">
                        <i class="ti-export"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-panel">
		<nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                </div>

            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header text-center">
                                <h2>Transactions</h2>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                    <th>Transaction ID</th>
                                    <th>Service Provider</th>
                                    <th>Client</th>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th>Rent Price</th>
                                    <th>License Plate</th>
                                    <th>Rent Start</th>
                                    <th>Rent End</th>
                                    <th>Status</th>
                                    </thead>
                                    <tbody>
                                    <?php
                                    require 'db.php';

                                    $sql = "SELECT rentStartdate,rentEnddate,clientID,trans_Id,firstname,brand,model,rent_Price,licensePlate,transaction.status AS a FROM transaction JOIN user ON transaction.spID = user.user_Id JOIN vehicle ON transaction.vehicleID = vehicle.vehicleID JOIN request ON transaction.requestID = request.requestID";
                                    $res = $conn->query($sql);
                                    while ($row = $res->fetch_assoc()){
                                        $sql = "SELECT firstname AS b FROM user WHERE user_Id = '" . $row['clientID'] ."'";
                                        $b = $conn->query($sql);
                                        $bb = $b->fetch_row();
                                        echo "<tr><td>" . $row['trans_Id']  ."</td>" .
                                            "<td>" . $row['firstname'] ."</td>" .
                                            "<td>" . $bb[0] ."</td>" .
                                            "<td>" . $row['brand']  ."</td>".
                                            "<td>" . $row['model']  ."</td>" .
                                            "<td>" . $row['rent_Price']  ."</td>" .
                                            "<td>" . $row['licensePlate']  ."</td>" .
                                            "<td>" . $row['rentStartdate']  ."</td>" .
                                            "<td>" . $row['rentEnddate']  ."</td>" .
                                            "<td>" . $row['a']  ."</td></tr>";

                                        }
                                    ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>




    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio.js"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
	<script src="assets/js/paper-dashboard.js"></script>

	<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>


</html>
