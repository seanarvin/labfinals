<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ayos.ph</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="css/agency.min.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="home.php">Admin</a>
        <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="home.php">User Management</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="monitoring.php">Transaction Monitoring</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="approve.deny.php">User Registration</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead bg-primary text-white text-center">
      <div class="container">
        <h1 class="text-uppercase mb-0">User Management</h1>
        <hr class="star-light">
          <div class="form-group">
          <div class="input-group">
            <input type="text" name="search_text" id="search_text" placeholder="Search" class="form-control" />
          </div>
        </div>
      </div>
    </header>
        
    <div class="container pads" style="margin-top: 15px;">
        <div class="row">
            <div class="col-lg-4 col-sm-6 mb-3 ">
                <div class="text-center p-3 border border-warning rounded">
                    <div class="widgit_social_inner1">
                    </div>
                    <div class="text-ash">
                          <?php  
                            $connect = mysqli_connect("localhost", "root", "", "db");  
                            $query = "SELECT count(user_id) as 'total' FROM users where status !='pending' and usertype!='admin'";  
                            $result = mysqli_query($connect, $query);
                            while($row = mysqli_fetch_array($result)){
                              echo '<h4 class="mt-2 text_size">'.$row['total'].'</h4>';
                            }
                          ?>  
                        <p class="m-0 mt-2">Registered Users</p> 
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6 mb-3 ">
                <div class="text-center p-3 border border-success rounded">
                    <div class="widgit_social_inner1">
                    </div>
                    <div class="text-ash">
                          <?php  
                            $connect = mysqli_connect("localhost", "root", "", "db");  
                            $query = "SELECT count(user_id) as 'total' FROM users where status='active' and usertype!='admin'";  
                            $result = mysqli_query($connect, $query);
                            while($row = mysqli_fetch_array($result)){
                              echo '<h4 class="mt-2 text_size">'.$row['total'].'</h4>';
                            }
                          ?>  
                        <p class="m-0 mt-2">Active Members</p>
                    </div>
                </div>
            </div>
            
           
            <div class="col-lg-4 col-sm-6 mb-3 ">
                <div class="text-center p-3 border border-primary rounded">
                    <div class="widgit_social_inner1">
                        <i class="glyphicon glyphicon-user"></i>
                    </div>
                    <div class="text-ash">
                    <?php
                        $connect = mysqli_connect("localhost", "root", "", "db");  
                        $query = "SELECT count(user_id) as 'total' FROM users where status='deactivated' and usertype!='admin'";  
                        $result = mysqli_query($connect, $query);
                        while($row = mysqli_fetch_array($result)){
                          echo '<h4 class="mt-2 text_size">'.$row['total'].'</h4>';
                        }
                      ?> 
                        <p class="m-0 mt-2">Deactivated Members</p>
                    </div>
                </div>
            </div>
        </div>
      </div>


    <div id="result"></div>

    <div class="copyright py-4 text-center text-white">
      <div class="container">
        <small>Copyright &copy; Your Website 2018</small>
      </div>
    </div>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/freelancer.min.js"></script>

  </body>

</html>
<script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"includes/fetch-users.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }
 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});
</script>