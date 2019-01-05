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
    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">-->
    <!--    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">-->
    <!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">-->
    <!-- CSS Files -->
    <link href="assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet"/>
</head>

<body class="">
<div class="wrapper">
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
                <li class="nav-item ">
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
                <li class="nav-item active">
                    <a class="nav-link " href="transactions.php">
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
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">Simple Table</h4>
                                <p class="card-category"> Here is a subtitle for this table</p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="example" width="100%">
                                        <thead class=" text-primary">
                                            <th>Service Provider</th>
                                            <th>Date/Time</th>
                                            <th>Category</th>
                                            <th>Work</th>
                                            <th>Specifics</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Note</th>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $ayd = $_SESSION['ayd'];
                                        $qu = "SELECT requests.note AS nt,spwork.price AS pr,specifics.specifics AS spe,services.service_name AS sn,requests.date_requested AS datee,requests.req_id AS ayyd,user.user_fname AS fname,user.user_lname AS lname,user.address AS address,user.contact_no AS num,user.email AS email,requests.status AS stat,work.description AS wo,services.service_name AS cat FROM requests JOIN user ON user.user_id = requests.client_id JOIN work on work.work_id = requests.work_id JOIN specifics on specifics.specifics_id = requests.specifics_id JOIN services on services.service_id = work.service_id JOIN spwork on spwork.work = work.work_id WHERE sp_id = '$ayd' ";
                                        $res = $conn->query($qu);

                                        if ($res->num_rows > 0) {
                                            while ($row = $res->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . strtoupper($row['fname'] . " " . $row['lname']) . "</td>";
                                                echo "<td>" . strtoupper($row['datee']) . "</td>";
                                                echo "<td>" . strtoupper($row['sn']) . "</td>";
                                                echo "<td>" . strtoupper($row['wo']) . "</td>";
                                                echo "<td>" . strtoupper($row['spe']) . "</td>";
                                                echo "<td>" . strtoupper($row['pr']) . "</td>";
                                                echo "<td>" . strtoupper($row['stat']) . "</td>";
                                                if($row['nt'] == ""){
                                                    echo "<td>N/A</td>";
                                                }else{
                                                    echo "<td>" . strtoupper($row['nt']) . "</td>";
                                                }


                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<td>No History</td>";
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
                                        <button type="button" class="btn btn-secondary btn-info" data-dismiss="modal">
                                            Close
                                        </button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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

<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>


</body>

</html>
