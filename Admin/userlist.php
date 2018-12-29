<?php
session_start();

require 'backend/db.php';
if (isset($_SESSION['full'])) {
    $ty = $_SESSION['userType'];
    if ($ty != "admin") {
        $m = "Access Denied!";
        echo "
            <script type = 'text/javascript'>
                alert('$m');
                window.location.replace('../index.php');
            </script>
         ";
    }
} else {
    $m = "Please login first!";
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
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <title>Paper Dashboard by Creative Tim</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet"/>

    <!--  Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

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
                <a href="dashboard.php" class="simple-text">
                    <?php
                    echo $_SESSION['full']
                    ?>
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="dashboard.php">
                        <i class="ti-panel"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="active">
                    <a href="table.php">
                        <i class="ti-user"></i>
                        <p>User List</p>
                    </a>
                </li>
                <li>
                    <a href="services.php">
                        <i class="ti-view-list-alt"></i>
                        <p>Services</p>
                    </a>
                </li>
                <li>
                    <a href="notifications.html">
                        <i class="ti-bell"></i>
                        <p>Transactions</p>
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
                    <a class="navbar-brand" href="#">Table List</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-bell"></i>
                                <p>Account</p>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="user.html">Account Setting</a></li>
                                <li><a href="backend/logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            `
                            <div class="header">
                                <h4 class="title text-center">Active Users</h4>

                            </div>
                            <div class="">
                                <table class="table table-striped">
                                    <thead>
                                    <th>Name</th>
                                    <th>Number</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th></th>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $qu = "SELECT * FROM user WHERE type !='admin' AND status = 'active'";
                                    $res = $conn->query($qu);

                                    if ($res) {
                                        while ($row = $res->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . strtoupper($row['user_fname'] . " " . $row['user_lname']) . "</td>";
                                            echo "<td>" . $row['contact_no'] . "</td>";
                                            echo "<td>" . $row['type'] . "</td>";
                                            echo "<td>" . $row['status'] . "</td>";
                                            echo "<td class='text-center'>" . "<a href=" . '../php/admin/modal/disableAccount.php?num=' . $row['user_id'] . " " . " class='ti-arrow-down text-center' data-toggle='modal' data-target='#del_account'></a>" . "&nbsp; &nbsp; &nbsp; &nbsp;" . "<a href=" . '../php/admin/modal/disableAccount.php?num=' . $row['user_id'] . " " . " class='ti-pencil' data-toggle='modal' data-target='#del_account'></a>" . "</td>";
                                            echo "</tr>";
                                        }
                                    }

                                    ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title text-center">Disabled Users</h4>

                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <th>Name</th>
                                    <th>Number</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th></th>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $qu = "SELECT * FROM user WHERE type !='admin' AND status = 'disabled'";
                                    $res = $conn->query($qu);

                                    if ($res) {
                                        while ($row = $res->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . strtoupper($row['user_fname'] . " " . $row['user_lname']) . "</td>";
                                            echo "<td>" . $row['contact_no'] . "</td>";
                                            echo "<td>" . $row['type'] . "</td>";
                                            echo "<td>" . $row['status'] . "</td>";
                                            echo "<td class='text-center'>" . "<a href=" . '../php/admin/modal/disableAccount.php?num=' . $row['user_id'] . " " . " class='ti-arrow-down text-center' data-toggle='modal' data-target='#del_account'></a>" . "&nbsp; &nbsp; &nbsp; &nbsp;" . "<a href=" . '../php/admin/modal/disableAccount.php?num=' . $row['user_id'] . " " . " class='ti-pencil' data-toggle='modal' data-target='#del_account'></a>" . "</td>";
                                            echo "</tr>";
                                        }
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
<script src="assets/js/jquery.min.js" type="text/javascript"></script>
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


</html>
