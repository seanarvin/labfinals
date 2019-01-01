<?php
require 'backend/db.php';
session_start();

if (isset($_SESSION['full'])) {
    $ty = $_SESSION['userType'];
    if ($ty != "sp") {
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


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>
        Material Dashboard by Creative Tim
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet"/>
</head>

<body class="">
<div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
        <!--
          Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

          Tip 2: you can also add an image using data-image tag
      -->
        <div class="logo">
            <a href="dashboard.php" class="simple-text logo-normal">
                <?php
                echo strtoupper($_SESSION['userType']);
                ?>
            </a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="nav-item active">
                    <a class="nav-link" href="requests.php">
                        <i class="material-icons">dashboard</i>
                        <p>Requests</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="services.php">
                        <i class="material-icons">content_paste</i>
                        <p>Services</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="transactions.php">
                        <i class="material-icons">library_books</i>
                        <p>Transactions</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end">

                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#pablo">
                                <?php
                                echo $_SESSION['full']
                                ?>
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">person</i>
                                <p class="d-lg-none d-md-block">
                                    Account
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal">Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="backend/logout.php">Log out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="card">
                                    <div class="card-header card-header-tabs card-header-primary">
                                        <div class="nav-tabs-navigation">
                                            <div class="nav-tabs-wrapper">
                                                <span class="nav-tabs-title">Requests</span>
                                                <ul class="nav nav-tabs" data-tabs="tabs">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" href="#requests" data-toggle="tab">
                                                            <i class="material-icons">apps</i> Pending Requests
                                                            <div class="ripple-container"></div>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#active" data-toggle="tab">
                                                            <i class="material-icons">check</i> Ongoing Requests
                                                            <div class="ripple-container"></div>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#disabled" data-toggle="tab">
                                                            <i class="material-icons">close</i>
                                                            <div class="ripple-container"></div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="requests">
                                                <table class="table">
                                                    <thead>
                                                    <th><b>Name</b></th>
                                                    <th><b>Address</b></th>
                                                    <th><b>Number</b></th>
                                                    <th><b>Email</b></th>
                                                    <th><b>Type</b></th>
                                                    <th><b>Status</b></th>
                                                    <th class="text-center"><b>Actions</b></th>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $qu = "SELECT * FROM user WHERE type !='admin' AND status = 'pending'";
                                                    $res = $conn->query($qu);

                                                    if ($res->num_rows > 0) {
                                                        while ($row = $res->fetch_assoc()) {
                                                            echo "<tr>";
                                                            echo "<td>" . strtoupper($row['user_fname'] . " " . $row['user_lname']) . "</td>";
                                                            echo "<td>" . strtoupper($row['address']) . "</td>";
                                                            echo "<td>" . strtoupper($row['contact_no']) . "</td>";
                                                            echo "<td>" . strtoupper($row['email']) . "</td>";
                                                            echo "<td>" . strtoupper($row['type']) . "</td>";
                                                            echo "<td>" . strtoupper($row['status']) . "</td>";
                                                            echo "<td class='text-center'>" . "<a  rel='tooltip' title='Accept Request' href=" . 'backend/disableUser.php?num=' . $row['user_id'] . " " . " class='btn btn-primary btn-link btn-sm'><i class='material-icons'>check</i></a>" . "<a  rel='tooltip' title='Reject Request' href=" . 'backend/disableUser.php?num=' . $row['user_id'] . " " . " class='btn btn-primary btn-link btn-sm'><i class='material-icons'>close</i></a>" . "</td>";
                                                            echo "</tr>";
                                                        }
                                                    } else {
                                                        echo "<td>No account requests</td>";
                                                    }

                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="tab-pane" id="active">
                                                <table class="table">
                                                    <thead>
                                                    <th><b>Name</b></th>
                                                    <th><b>Address</b></th>
                                                    <th><b>Number</b></th>
                                                    <th><b>Email</b></th>
                                                    <th><b>Type</b></th>
                                                    <th><b>Status</b></th>
                                                    <th class="text-center"><b>Actions</b></th>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $qu = "SELECT * FROM user WHERE type !='admin' AND status = 'active'";
                                                    $res = $conn->query($qu);

                                                    if ($res->num_rows > 0) {
                                                        while ($row = $res->fetch_assoc()) {
                                                            echo "<tr>";
                                                            echo "<td>" . strtoupper($row['user_fname'] . " " . $row['user_lname']) . "</td>";
                                                            echo "<td>" . strtoupper($row['address']) . "</td>";
                                                            echo "<td>" . strtoupper($row['contact_no']) . "</td>";
                                                            echo "<td>" . strtoupper($row['email']) . "</td>";
                                                            echo "<td>" . strtoupper($row['type']) . "</td>";
                                                            echo "<td>" . strtoupper($row['status']) . "</td>";
                                                            echo "<td class='text-center'>" . "<a  rel='tooltip' title='Disable Account' href=" . 'backend/disableUser.php?num=' . $row['user_id'] . " " . " class='btn btn-primary btn-link btn-sm'><i class='material-icons'>close</i></a>" . "</td>";
                                                            echo "</tr>";
                                                        }
                                                    } else {
                                                        echo "<td>No active accounts</td>";
                                                    }

                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="tab-pane" id="disabled">
                                                <table class="table">
                                                    <thead>
                                                    <th><b>Name</b></th>
                                                    <th><b>Address</b></th>
                                                    <th><b>Number</b></th>
                                                    <th><b>Email</b></th>
                                                    <th><b>Type</b></th>
                                                    <th><b>Status</b></th>
                                                    <th class="text-center"><b>Actions</b></th>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $qu = "SELECT * FROM user WHERE type !='admin' AND status = 'disabled'";
                                                    $res = $conn->query($qu);


                                                    if ($res->num_rows > 0) {
                                                        while ($row = $res->fetch_assoc()) {
                                                            echo "<tr>";
                                                            echo "<td>" . strtoupper($row['user_fname'] . " " . $row['user_lname']) . "</td>";
                                                            echo "<td>" . strtoupper($row['address']) . "</td>";
                                                            echo "<td>" . strtoupper($row['contact_no']) . "</td>";
                                                            echo "<td>" . strtoupper($row['email']) . "</td>";
                                                            echo "<td>" . strtoupper($row['type']) . "</td>";
                                                            echo "<td>" . strtoupper($row['status']) . "</td>";
                                                            echo "<td class='text-center'>" . "<a  rel='tooltip' title='Enable Account' href=" . 'backend/enableUser.php?num=' . $row['user_id'] . " " . " class='btn btn-primary btn-link btn-sm'><i class='material-icons'>check</i></a>" . "</td>";
                                                            echo "</tr>";
                                                        }
                                                    } else {
                                                        echo "<td>No disabled accounts</td>";
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
            </div>
        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-body ">
                    <div class="card">
                        <div class="card-header card-header-primary text-center">
                            <h4 class="card-title">Edit Profile</h4>
                        </div>
                        <div class="card-body">


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Fist Name</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Last Name</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Adress</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Number</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Email</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Password</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Confirm Password</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="pull-right">
                                <button type="button" class="btn btn-secondary btn-info" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>


                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!--   Core JS Files   -->
<script src="assets/js/core/jquery.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap-material-design.min.js"></script>
<script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!-- Plugin for the momentJs  -->
<script src="assets/js/plugins/moment.min.js"></script>
<!--  Plugin for Sweet Alert -->
<script src="assets/js/plugins/sweetalert2.js"></script>
<!-- Forms Validations Plugin -->
<script src="assets/js/plugins/jquery.validate.min.js"></script>
<!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="assets/js/plugins/jquery.bootstrap-wizard.js"></script>
<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="assets/js/plugins/bootstrap-selectpicker.js"></script>
<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
<script src="assets/js/plugins/jquery.dataTables.min.js"></script>
<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="assets/js/plugins/bootstrap-tagsinput.js"></script>
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="assets/js/plugins/jasny-bootstrap.min.js"></script>
<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<script src="assets/js/plugins/fullcalendar.min.js"></script>
<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
<script src="assets/js/plugins/jquery-jvectormap.js"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="assets/js/plugins/nouislider.min.js"></script>
<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
<!-- Library for adding dinamically elements -->
<script src="assets/js/plugins/arrive.min.js"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Chartist JS -->
<script src="assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>


</body>

</html>
