<?php
require 'backend/db.php';
session_start();

if (isset($_SESSION['full'])) {
    $ty = $_SESSION['userType'];
    if ($ty != "admin") {
        $m = "Access Denied!";
        echo "
            <script type = 'text/javascript'>
alert('$m');
window.location.replace('../../index.php');
</script>
";
    }
} else {
    $m = "Please login first!";
    echo "
  <script type = 'text/javascript'>
          alert('$m');
  window.location.replace(' ../../index.php');
        </script>
";
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Argon Dashboard - Free Dashboard for Bootstrap 4</title>
    <!-- Favicon -->
    <link href="assets/img/brand/favicon.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="assets/css/argon.css?v=1.0.0" rel="stylesheet">
</head>

<body>
<!-- Sidenav -->
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
                aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="index.php">
            <?php
            echo strtoupper($_SESSION['userType']);
            ?>
        </a>
        <!-- User -->

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="index.php">
                            <img src="assets/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                                data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                                aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">
                        <i class="ni ni-tv-2 text-primary"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="users.php">
                        <i class="ni ni-single-02 text-yellow"></i> Users
                    </a>
                </li>
                <li class="nav-item active ">
                    <a class="nav-link" href="transactions.php">
                        <i class="ni ni-bullet-list-67 text-red"></i> Transactions
                    </a>
                </li>

            </ul>

        </div>
    </div>
</nav>
<!-- Main content -->
<div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="users.php"></a>
            <!-- Form -->
            <!-- User -->
            <ul class="navbar-nav align-items-center d-none d-md-flex">
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">
                        <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <i class="ni ni-circle-08"></i>
                </span>
                            <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">
                      <?php
                      echo strtoupper($_SESSION['full']);
                      ?></span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">

                        <div class="dropdown-divider"></div>
                        <a href="backend/logout.php" class="dropdown-item">
                            <i class="ni ni-user-run"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">

        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
        <!-- Table -->
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <h3 class="mb-0 text-center">Transaction History</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="example" width="100%">
                            <thead class=" text-primary">
                            <th><b>SP</b></th>
                            <th><b>Client</b></th>
                            <th><b>Date/Time</b></th>
                            <th><b>Category</b></th>
                            <th><b>Work</b></th>
                            <th><b>Address</b></th>
                            <th><b>Number</b></th>
                            <th><b>Specifics</b></th>
                            <th><b>Minimum Price</b></th>
                            <th><b>Note</b></th>
                            <th><b>Status</b></th>
                            </thead>
                            <tbody>
                            <?php
                            $ayd = $_SESSION['ayd'];
                            $qu = "SELECT requests.sp_id AS spid,requests.status AS st,requests.note AS nt,requests.req_id AS ayyd,user.user_fname AS fn,user_lname AS ln,requests.date AS d,requests.from AS f,requests.to as t,services.service_name AS sn,work.description AS wo,user.barangay AS bar,user.housenumber AS hn,user.street AS stn,user.municipality AS mun,user.city AS ct,user.contact_no AS num,requests.specifics AS spe,work.priceFrom AS pf,work.priceTo AS pt FROM requests 
                                                JOIN work on requests.work_id = work.work_id JOIN services on work.service_id = services.service_id JOIN user on user.user_id = requests.client_id 
                                                    WHERE requests.status != 'pending'";
                            $res = $conn->query($qu);



                            if ($res->num_rows > 0) {
                                while ($row = $res->fetch_assoc()) {
                                    $spid = $row['spid'];

                                    $q = "SELECT user.user_fname AS fna,user.user_lname AS lna FROM requests JOIN user ON requests.sp_id = user_id WHERE user_id = '$spid'";
                                    $z = $conn->query($q);
                                    $zz = $z->fetch_row();
                                    $v = $zz[0];
                                    $vv = $zz[1];

                                    echo "<tr>";
                                    echo "<td>" . strtoupper($v . " " . $vv) . "</td>";
                                    echo "<td>" . strtoupper($row['fn'] . " " . $row['ln']) . "</td>";
                                    echo "<td>" . strtoupper($row['d']) .":". strtoupper($row['f']) . "-" . strtoupper($row['t']) . "</td>";
                                    echo "<td>" . strtoupper($row['sn']) . "</td>";
                                    echo "<td>" . strtoupper($row['wo']) . "</td>";
                                    echo "<td>" . strtoupper($row['bar']) . "," . strtoupper($row['hn']) . "," . strtoupper($row['stn']) . "," . strtoupper($row['mun']) . "," . strtoupper($row['ct']) ."</td>";
                                    echo "<td>" . strtoupper($row['num']) . "</td>";
                                    echo "<td>" . strtoupper($row['spe']) . "</td>";

                                    echo "<td>" . strtoupper($row['pf']) . "</td>";
                                    echo "<td>" . strtoupper($row['nt']) . "</td>";
                                    echo "<td>" . strtoupper($row['st']) . "</td>";

                                    echo "</tr>";
                                }
                            } else {
                                echo "<td>No Transactions</td>";
                            }

                            ?>

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav aria-label="...">

                        </nav>
                    </div>
                </div>
            </div>
        </div>


        <!-- Dark table -->

        <!-- Footer -->
        <footer class="footer">
            <div class="row align-items-center justify-content-xl-between">

            </div>
        </footer>
    </div>
</div>
<!-- Argon Scripts -->
<!-- Core -->
<script src="assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js" type="text/javascript"></script>


<!-- Argon JS -->
<script src="assets/js/argon.js?v=1.0.0"></script>


</body>

</html>