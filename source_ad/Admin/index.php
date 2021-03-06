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
                window.location.replace('../index.php');
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
    <title>TrabaWHO</title>
    <!-- Favicon -->
    <link href="./assets/img/brand/favicon.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="./assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="./assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="./assets/css/argon.css?v=1.0.0" rel="stylesheet">
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
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                   aria-expanded="false">
                    <i class="ni ni-bell-55"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right"
                     aria-labelledby="navbar-default_dropdown_1">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item dropdown">

                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class="dropdown-divider"></div>
                    <a href="#!" class="dropdown-item">
                        <i class="ni ni-user-run"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="index.php">
                            <img src="./assets/img/brand/blue.png">
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
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended"
                           placeholder="Search" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">
                        <i class="ni ni-tv-2 text-primary"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="users.php">
                        <i class="ni ni-single-02 text-yellow"></i> Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="transactions.php">
                        <i class="ni ni-bullet-list-67 text-red"></i> Transactions
                    </a>
                </li>

            </ul>
            <!-- Divider -->

        </div>
    </div>
</nav>
<!-- Main content -->
<div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="index.php">Dashboard</a>
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
            <div class="header-body">
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <a href="users.php" class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Pending Accounts</h5>
                                        <span class="h2 font-weight-bold mb-0">
                                              <?php
                                              $sql = "SELECT COUNT(user_id) FROM user WHERE status='pending'";
                                              $res = $conn->query($sql);
                                              $r = $res->fetch_row();

                                              if ($res->num_rows > 0) {
                                                  echo $r[0];
                                              } else {
                                                  echo "0";
                                              }

                                              ?>
                                            </span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                            <i class="fas fa-chart-pie"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-warning mr-2"></span>
                                </p>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <a href="users.php#sp" class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Service Provider</h5>
                                        <span class="h2 font-weight-bold mb-0">
                                              <?php
                                              $sql = "SELECT COUNT(user_id) FROM user WHERE type = 'sp' AND status='active'";
                                              $res = $conn->query($sql);
                                              $r = $res->fetch_row();

                                              if ($res->num_rows > 0) {
                                                  echo $r[0];
                                              } else {
                                                  echo "0";
                                              }

                                              ?>
                                            </span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                            <i class="fas fa-chart-bar"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-warning mr-2"></span>
                                </p>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <a href="users.php#cli" class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Clients</h5>
                                            <span class="h2 font-weight-bold mb-0">
                                              <?php
                                              $sql = "SELECT COUNT(user_id) FROM user WHERE type = 'client' AND status='active'";
                                              $res = $conn->query($sql);
                                              $r = $res->fetch_row();

                                              if ($res->num_rows > 0) {
                                                  echo $r[0];
                                              } else {
                                                  echo "0";
                                              }

                                              ?>
                                            </span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-warning mr-2"></span>
                                </p>
                            </a>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <a href="transactions.php" class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Transactions</h5>
                                        <span class="h2 font-weight-bold mb-0">
                                              <?php
                                              $sql = "SELECT COUNT(req_id) FROM requests WHERE status = 'ongoing' OR status = 'cancelled' OR status = 'completed'";
                                              $res = $conn->query($sql);
                                              $r = $res->fetch_row();

                                              if ($res->num_rows > 0) {
                                                  echo $r[0];
                                              } else {
                                                  echo "0";
                                              }

                                              ?>
                                            </span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                            <i class="fas fa-chart-pie"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-warning mr-2"></span>
                                </p>
                            </a>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <h3 class="mb-0 text-center">Pending Account Request</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Contact #</th>
                                <th scope="col">Email</th>
                                <th scope="col">Type</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql = "SELECT * FROM user WHERE type != 'admin' AND status = 'pending'";
                            $res = $conn->query($sql);

                            if ($res->num_rows > 0) {
                                while ($row = $res->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['user_fname'] . " " . $row['user_lname'] . "</td>";
                                    echo "<td>" . $row['barangay'] . "," . $row['housenumber'] .  "," . strtoupper($row['street']) . "," . strtoupper($row['municipality']) . "," . strtoupper($row['city']) . "</td>";
                                    echo "<td>" . $row['contact_no'] . "</td>";
                                    echo "<td>" . $row['email'] . "</td>";
                                    echo "<td>" . $row['type'] . "</td>";
                                    echo "<td>" . $row['status'] . "</td>";
                                    echo "<td>" . "<a  rel='tooltip' title='Accept Request' href=" . 'backend/acceptRequest.php?num=' . $row['user_id'] . " " . " class='btn btn-primary btn-link btn-sm'>Accept</a>" . "<a  rel='tooltip' title='Reject Request' href=" . 'backend/rejectRequest.php?num=' . $row['user_id'] . " " . " class='btn btn-primary btn-link btn-sm'>Reject</a>" . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td>No Requests</td></tr>";
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
        <!-- Footer -->

    </div>
</div>
<!-- Argon Scripts -->
<!-- Core -->
<script src="./assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="./assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- Optional JS -->
<script src="./assets/vendor/chart.js/dist/Chart.min.js"></script>
<script src="./assets/vendor/chart.js/dist/Chart.extension.js"></script>
<!-- Argon JS -->
<script src="./assets/js/argon.js?v=1.0.0"></script>
</body>

</html>