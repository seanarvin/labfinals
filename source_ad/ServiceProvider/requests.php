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
        TrabaWHO
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
            <a href="requests.php" class="simple-text logo-normal">
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
                                                        <a class="nav-link" href="#ongoing" data-toggle="tab">
                                                            <i class="material-icons">check</i> Ongoing Requests
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
                                                    <th><b>Client</b></th>
                                                    <th><b>Date/Time</b></th>
                                                    <th><b>Category</b></th>
                                                    <th><b>Work</b></th>
                                                    <th><b>Address</b></th>
                                                    <th><b>Number</b></th>
                                                    <th><b>Specifics</b></th>
                                                    <th><b>Minimum Price</b></th>
                                                    <th class="text-center"><b>Actions</b></th>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $ayd = $_SESSION['ayd'];
                                                    $qu = "SELECT user.street AS stn,user.municipality AS mun,user.city AS ct,requests.req_id AS ayyd,user.user_fname AS fn,user_lname AS ln,requests.date AS d,requests.from AS f,requests.to as t,services.service_name AS sn,work.description AS wo,user.barangay AS bar,user.housenumber AS hn,user.contact_no AS num,requests.specifics AS spe,work.priceFrom AS pf,work.priceTo AS pt FROM requests 
                                                            JOIN work on requests.work_id = work.work_id JOIN services on work.service_id = services.service_id JOIN user on user.user_id = requests.client_id 
                                                            WHERE requests.sp_id = '$ayd' AND requests.status = 'pending'";
                                                    $res = $conn->query($qu);

                                                    if ($res->num_rows > 0) {
                                                        while ($row = $res->fetch_assoc()) {
                                                            echo "<tr>";
                                                            echo "<td>" . strtoupper($row['fn'] . " " . $row['ln']) . "</td>";
                                                            echo "<td>" . strtoupper($row['d']) .":". strtoupper($row['f']) . "-" . strtoupper($row['t']) . "</td>";
                                                            echo "<td>" . strtoupper($row['sn']) . "</td>";
                                                            echo "<td>" . strtoupper($row['wo']) . "</td>";
                                                            echo "<td>" . strtoupper($row['bar']) . "," . strtoupper($row['hn']) .  "," . strtoupper($row['stn']) . "," . strtoupper($row['mun']) . "," . strtoupper($row['ct']). "</td>";
                                                            echo "<td>" . strtoupper($row['num']) . "</td>";
                                                            echo "<td>" . strtoupper($row['spe']) . "</td>";
                                                            echo "<td>" . strtoupper($row['pf']) . "</td>";
                                                            echo "<td class='text-center'>" . "<a  rel='tooltip' title='Accept Request' href=" . 'backend/acceptJob.php?num=' . $row['ayyd'] . " " . " class='btn btn-primary btn-link btn-sm'><i class='material-icons'>check</i></a>" . "<a  rel='tooltip' title='Reject Request' href=" . 'backend/rejectJob.php?num=' . $row['ayyd'] . " " . " class='btn btn-primary btn-link btn-sm'><i class='material-icons'>close</i></a>" . "</td>";
                                                            echo "</tr>";
                                                        }
                                                    } else {
                                                        echo "<td>No requests</td>";
                                                    }

                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="tab-pane" id="ongoing">
                                                <table class="table">
                                                    <thead>
                                                    <th><b>Client</b></th>
                                                    <th><b>Date/Time</b></th>
                                                    <th><b>Category</b></th>
                                                    <th><b>Work</b></th>
                                                    <th><b>Address</b></th>
                                                    <th><b>Number</b></th>
                                                    <th><b>Specifics</b></th>
                                                    <th><b>Minimum Price</b></th>
                                                    <th class="text-center"><b>Actions</b></th>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $ayd = $_SESSION['ayd'];
                                                    $qu = "SELECT user.street AS stn,user.municipality AS mun,user.city AS ct,requests.req_id AS ayyd,user.user_fname AS fn,user_lname AS ln,requests.date AS d,requests.from AS f,requests.to as t,services.service_name AS sn,work.description AS wo,user.barangay AS bar,user.housenumber AS hn,user.contact_no AS num,requests.specifics AS spe,work.priceFrom AS pf,work.priceTo AS pt FROM requests 
                                                            JOIN work on requests.work_id = work.work_id JOIN services on work.service_id = services.service_id JOIN user on user.user_id = requests.client_id 
                                                            WHERE requests.sp_id = '$ayd' AND requests.status = 'ongoing'";
                                                    $res = $conn->query($qu);

                                                    if ($res->num_rows > 0) {
                                                        while ($row = $res->fetch_assoc()) {
                                                            echo "<tr>";
                                                            echo "<td>" . strtoupper($row['fn'] . " " . $row['ln']) . "</td>";
                                                            echo "<td>" . strtoupper($row['d']) .":". strtoupper($row['f']) . "-" . strtoupper($row['t']) . "</td>";
                                                            echo "<td>" . strtoupper($row['sn']) . "</td>";
                                                            echo "<td>" . strtoupper($row['wo']) . "</td>";
                                                            echo "<td>" . strtoupper($row['bar']) . "," . strtoupper($row['hn']) .  "," . strtoupper($row['stn']) . "," . strtoupper($row['mun']) . "," . strtoupper($row['ct']) . "</td>";
                                                            echo "<td>" . strtoupper($row['num']) . "</td>";
                                                            echo "<td>" . strtoupper($row['spe']) . "</td>";
                                                            echo "<td>" . strtoupper($row['pf']) .  "</td>";
                                                            echo "<td class='text-center'>" . "<a  rel='tooltip' title='Mark as Done' href=" . 'backend/completeJob.php?num=' . $row['ayyd'] . " " . " class='btn btn-primary btn-link btn-sm'><i class='material-icons'>check</i></a>" . "<a  rel='tooltip' title='Cancel Request' href='#' data-toggle='modal' data-id='" . $row['ayyd'] . "' data-target='#exampleModal1' class='btn btn-primary btn-link btn-sm'><i class='material-icons'>close</i></a>" . "</td>";
                                                            echo "</tr>";
                                                        }
                                                    } else {
                                                        echo "<td>No On-going requests</td>";
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
<div class="modal fade" id="exampleModal" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="backend/editProfile.php" method="post">
                <div class="modal-body ">
                    <div class="card">
                        <div class="card-header card-header-primary text-center">
                            <h4 class="card-title">Edit Profile</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="">Fist
                                            Name</label>

                                        <?php
                                        $ayd = $_SESSION['ayd'];
                                        $sql = "SELECT * FROM user WHERE user_id = '$ayd'";
                                        $res = $conn->query($sql);
                                        $r = $res->fetch_assoc();

                                        echo "<input type='text' name='fname' class='form-control' placeholder='" . $r['user_fname'] . "'>";

                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="">Last
                                            Name</label>
                                        <?php
                                        $ayd = $_SESSION['ayd'];
                                        $sql = "SELECT * FROM user WHERE user_id = '$ayd'";
                                        $res = $conn->query($sql);
                                        $r = $res->fetch_assoc();

                                        echo "<input type='text' name='lname' class='form-control' placeholder='" . $r['user_lname'] . "'>";

                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="">Street Num</label>
                                        <?php
                                        $ayd = $_SESSION['ayd'];
                                        $sql = "SELECT * FROM user WHERE user_id = '$ayd'";
                                        $res = $conn->query($sql);
                                        $r = $res->fetch_assoc();

                                        echo "<input type='text' name='street' class='form-control' placeholder='" . $r['street'] . "'>";

                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="">House Number</label>
                                        <?php
                                        $ayd = $_SESSION['ayd'];
                                        $sql = "SELECT * FROM user WHERE user_id = '$ayd'";
                                        $res = $conn->query($sql);
                                        $r = $res->fetch_assoc();

                                        echo "<input type='text' name='housenum' class='form-control' placeholder='" . $r['housenumber'] . "'>";

                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="">Barangay</label>
                                        <?php
                                        $ayd = $_SESSION['ayd'];
                                        $sql = "SELECT * FROM user WHERE user_id = '$ayd'";
                                        $res = $conn->query($sql);
                                        $r = $res->fetch_assoc();

                                        echo "<input type='text' name='bar' class='form-control' placeholder='" . $r['barangay'] . "'>";

                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="">Municipality</label>
                                        <?php
                                        $ayd = $_SESSION['ayd'];
                                        $sql = "SELECT * FROM user WHERE user_id = '$ayd'";
                                        $res = $conn->query($sql);
                                        $r = $res->fetch_assoc();

                                        echo "<input type='text' name='mun' class='form-control' placeholder='" . $r['municipality'] . "'>";

                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="">City</label>
                                        <?php
                                        $ayd = $_SESSION['ayd'];
                                        $sql = "SELECT * FROM user WHERE user_id = '$ayd'";
                                        $res = $conn->query($sql);
                                        $r = $res->fetch_assoc();

                                        echo "<input type='text' name='city' class='form-control' placeholder='" . $r['city'] . "'>";

                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="">Number</label>
                                        <?php
                                        $ayd = $_SESSION['ayd'];
                                        $sql = "SELECT * FROM user WHERE user_id = '$ayd'";
                                        $res = $conn->query($sql);
                                        $r = $res->fetch_assoc();

                                        echo "<input type='text' name='num' class='form-control' placeholder='" . $r['contact_no'] . "'>";

                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="">Email</label>
                                        <?php
                                        $ayd = $_SESSION['ayd'];
                                        $sql = "SELECT * FROM user WHERE user_id = '$ayd'";
                                        $res = $conn->query($sql);
                                        $r = $res->fetch_assoc();

                                        echo "<input type='text' name='email' class='form-control' placeholder='" . $r['email'] . "'>";

                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="">Password</label>
                                        <input type="password" class="form-control" name="pass" min="4">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="">Confirm
                                            Password</label>
                                        <input type="password" min="4"
                                               class="form-control" name="pass2">
                                    </div>
                                </div>
                            </div>
                            <div class="pull-right">
                                <button type="button"
                                        class="btn btn-secondary btn-info"
                                        data-dismiss="modal">Close
                                </button>
                                <button type="submit" id="us_id" value=""
                                        class="btn btn-primary">Save
                                    changes
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="backend/cancelJob.php" method="post">
                <div class="modal-body ">
                    <div class="card">
                        <div class="card-header card-header-primary text-center">
                            <h4 class="card-title">Reason for canceling</h4>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="">Reason for canceling</label>
                                    <input required name="note" type='text' class='form-control'>
                                </div>
                            </div>
                            <div class="pull-right">
                                <button type="button"
                                        class="btn btn-secondary btn-info"
                                        data-dismiss="modal">Close
                                </button>
                                <button id="req_id" name="ayd" value="" type="submit" class="btn btn-primary">Submit
                                </button>
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
<script src="assets/js/material-dashboard.js?v=2.1.1"
        type="text/javascript"></script>

<script>
    $(document).ready(function () {
        $('#exampleModal1').on("show.bs.modal", function (ev) {
            let id = $(ev.relatedTarget).data('id');
            $('#req_id').val(id);

        })
    });


</script>


</body>

</html>
