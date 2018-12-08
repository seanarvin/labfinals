<?php
  require "includes/checklogin.php";
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>View Profile</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/freelancer.min.css" rel="stylesheet">
    <style>
      .container{
        margin-top: 15px;
      }
      .table td {
   text-align: center;   
}
    </style>
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
    
    <?php
    error_reporting( ~E_NOTICE );
	
    require_once 'includes/db.php';
    
    if(isset($_GET['view']) && !empty($_GET['view']))
    {
      $id = $_GET['view'];
      $stmt = $DB_con->prepare('SELECT *, TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) AS age FROM users WHERE user_id =:uid ');
      $stmt->execute(array(':uid'=>$id));
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      extract($row);
        echo '
      <div class="container" style="margin: 130px auto 15px auto; min-height: 71.4vh; max-height: auto; ">
      <div class="row">
          <div class="col-12">
              <div class="card">
                  <div class="card-body">
                      <div class="row">
                          <div class="col-12 col-lg-8 col-md-6">
                              <h2 class="mb-0 text-truncated">'.$row['firstname'].'  '.$row['middle_initial'].'  '.$row['lastname'].'</h2>
                              <p class="lead">'.$row['usertype'].' / '.$row['status'].'</p><hr>
                                   <div class="row">
                                      <div class="card-group col-md-12">
                                       <div class="col-md-3 text-right"><h5>Age:</h5>  </div>
                                       <div class="col-md-9"><h5>'.$row['age'].'</h5></div>
                                       </div>
                                      <div class="card-group col-md-12">
                                       <div class="col-md-3 text-right"><h5>Gender:</h5>  </div>
                                       <div class="col-md-9"><h5>'.$row['gender'].'</h5></div>
                                       </div>
                                       <div class="card-group col-md-12">
                                       <div class="col-md-3 text-right"><h5>Birthdate:</h5> </div>
                                       <div class="col-md-9"><h5>'.$row['birthdate'].'</h5></div>
                                       </div>
                                       <div class="card-group col-md-12">
                                       <div class="col-md-3 text-right"><h5>Address: </h5></div>
                                       <div class="col-md-9"><h5>'.$row['address'].' </h5></div>
                                       </div>
                                       <div class="card-group col-md-12">
                                       <div class="col-md-3 text-right"><h5>Contact No: </h5></div>
                                       <div class="col-md-9"><h5>'.$row['contact_no'].'</h5> </div>
                                       </div>
                                   </div>
                         </div>
                          <div class="col-12 col-lg-4 col-md-6 text-center">
                              <img src="images/'.$row['pic'].'" alt="" class="mx-auto border rounded-circle  img-fluid" style="max-width: 300px; max-height: 300px;min-width: 300px; min-height: 300px;">
                              <br>
                          </div>';
                    $connect = mysqli_connect("www.db.com", "root1", "", "db");  
                    $query = "select orders.transaction_id as 'id', date_start, date_end, sum(((timestampdiff(day,
                     transaction.date_start, transaction.date_end)-1)*products.product_rate)+products.product_price)
                      as 'Total Cost' from transaction inner join orders on transaction.id = orders.transaction_id 
                      inner join products on orders.product_id = products.product_id where orders.transaction_id =
                       transaction.orders and (transaction.retailer = $id or transaction.customer = $id) group by orders.transaction_id";  
                    $result = mysqli_query($connect, $query); 
echo '
                         <!--/col-->
                           <div id="order_table" class=" "style="margin-top: 15px; margin-left: auto; margin-right: auto;">  
                                 <table class="table table-striped table-bordered table-hover  text-center">  
                                     <tr>  
                                           <th width="20%">ID</th>  
                                           <th width="20%">Date Start</th>  
                                           <th width="20%">Date End</th>  
                                           <th width="20%">Amount</th>  
                                           <th width="20%">View</th> 
                                     </tr> ';
                                 while($row = mysqli_fetch_array($result))  
                                 {  
                                  echo' 
                                     <tr>  
                                           <td>'.$row["id"].'</td>  
                                           <td>'.$row["date_start"].'</td>  
                                           <td>'.$row["date_start"].'</td>
                                           <td>₱'.$row["Total Cost"].'</td>  
                                           <td><a href="viewtransaction.php?view='.$row['id'].'"> <button type="button" class="btn btn-dark">View Transaction</button></a></td>  
                                     </tr>  
                                 '; 
                                 }  
  
                                 echo '</table> 
                     </div>
                     <!--/row-->
                 </div>

                 <!--/card-block-->
             </div>
         </div>
     </div>
 
 </div>    </div>
      ';

    }else
	{
		header("Location: ../approve.deny.php");
    }
    
    ?>
    
    <div class="copyright py-4 text-center text-white">
      <div class="container">
        <small>Copyright &copy; SLU Webtech 2018</small>
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

     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh5U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>

</html>
