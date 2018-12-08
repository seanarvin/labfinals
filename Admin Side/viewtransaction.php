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
      $stmt = $DB_con->prepare('select * from transaction where id=:uid');
      $stmt->execute(array(':uid'=>$id));
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      extract($row);
        
         echo   '<div class="container" style="margin: 130px auto 15px auto;">';
         echo        '<div class="row" >';
         echo            '<div class="col-12" >';
         echo                '<div class="card">';
         echo                    '<div class="card-body">';
         echo                        '<div class="row">';
         echo                            '<div class="col-md-4" style=""> ';

            $connect = mysqli_connect("www.db.com", "root1", "", "db");  
            $query = "select concat(firstname,' ', middle_initial,' ', lastname) as 'retailer', pic, users.user_id from transaction inner JOIN users on transaction.retailer = users.user_id where transaction.id=$id; ";  
            $result = mysqli_query($connect, $query);
            while($rows = mysqli_fetch_array($result)){
              echo                                 '<img src="images/'.$rows['pic'].'" alt="" class="mx-auto border rounded-circle  img-fluid" style="max-width: 300px; max-height: 300px;min-width: 300px; min-height: 300px;">';
              echo                                 '<div class="row">';
              echo                                   '<div class="col-md-12 text-center" style="margin-top: 15px;">';
              echo                                      '<a href="viewprofile.php?view='.$rows["user_id"].'" class="card-title" style="font-size: 15px; color: white; text-decoration: none;">
                                                         <button class="btn btn-primary" style=" width: 325px;text-align: center;">';
              echo ''.$rows['retailer'].'';
            }

         echo                                           '</button></a>';
         echo                                       '<h5>Retailer</h5>';
         echo                                   '</div>';
         echo                                 '</div>';
         echo                               '</div>';
         echo                               '<div class="col-md-4 text-center" >';
         echo                                 '<br><br><h4>Transaction No: '.$row['id'].'</h4><br>';
         echo                                 '<br><h5>Date Start:<br> '.$row['date_start'].'</h5><br>';
         echo                                 '<h5>Date End: <br> '.$row['date_end'].'</h5>';
         echo                               '</div>'; 
         echo                               '<div class="col-md-4" style="">';
            $connect = mysqli_connect("www.db.com", "root1", "", "db");  
            $query = "select concat(firstname,' ', middle_initial,' ', lastname) as 'customer', pic, users.user_id from transaction inner JOIN users on transaction.customer = users.user_id where transaction.id=$id; ";  
            $result = mysqli_query($connect, $query);
            while($rowss = mysqli_fetch_array($result)){
              echo                                 '<img src="images/'.$rowss['pic'].'" alt="" class="mx-auto border rounded-circle  img-fluid" style="max-width: 300px; max-height: 300px;min-width: 200px; min-height: 300px;">';
              echo                                 '<div class="row">';
              echo                                   '<div class="col-md-12 text-center" style=" margin-top: 15px;">';
              echo                                      '<a href="viewprofile.php?view='.$rowss["user_id"].'" class="card-title" style="font-size: 15px; color: white; text-decoration: none;">
                                                         <button class="btn btn-primary" style="width: 325px; text-align: center;">';
              echo ''.$rowss['customer'].'';
            }
         echo                                           '</button></a>';
         echo                                       '<h5>Customer</h5>';
         echo                                   '</div>';
         echo                                 '</div>';
         echo                               '</div>';                           
         echo                           '<!--/col-->';
         echo                       '</div>';
         echo                       '<!--/row-->';
         echo                       '<div class="row" style="; height: 400px;">';
         echo                         '<div class="col-md-12" >';
         echo                           '<div id="accordion">
                                          <div class="card">
                                            <div class="card-header" id="headingOne">
                                              <h5 class="mb-0">
                                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style=" text-decoration: none;"> 
                                                   Transactions
                                                </button>
                                              </h5>
                                            </div>
                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                            <table class="table table-sm table-light">
                                            <thead>
                                              <tr>
                                                <th scope="col">Product ID</th>
                                                <th scope="col">Product Name</th>
                                                <th scope="col">Product Price</th>
                                                <th scope="col">Product Rate</th>
                                                <th scope="col">Day/s</th>
                                                <th scope="col">Total</th>
                                              </tr>
                                            </thead>
                                            ';
                            
    $connect = mysqli_connect("www.db.com", "root1", "", "db");  
    $query = "select orders.product_id, products.product_name, products.product_price, products.product_rate, (timestampdiff(day, transaction.date_start, transaction.date_end)-1) as 'day', ((((timestampdiff(day, transaction.date_start, transaction.date_end)-1))*products.product_rate)+products.product_price) as 'total' from products inner join orders on products.product_id = orders.product_id inner JOIN transaction on orders.transaction_id = transaction.orders where orders.transaction_id = $id order by product_id";  
    $result = mysqli_query($connect, $query);
      while($rowsss = mysqli_fetch_array($result,MYSQLI_NUM)){
      echo '<tr>
      
        <th scope="col">'.$rowsss[0].'</th>
        <th scope="col">'.$rowsss[1].'</th>
        <th scope="col">'.$rowsss[2].'</th>
        <th scope="col">'.$rowsss[3].'</th>
        <th scope="col">'.$rowsss[4].'</th>
        <th scope="col">'.$rowsss[5].'</th>
        <th scope="col"></th>
           </tr>';
    }
     echo                                   '
                                              <tr>
                                                <th scope="row"></th>
                                                <td colspan="3"></td>';
                                                echo '<td>Total:</td>';
                                                $connect = mysqli_connect("www.db.com", "root1", "", "db");  
                                                $query = "select sum((((timestampdiff(day, transaction.date_start, transaction.date_end)-1))*products.product_rate)+products.product_price) as 'total' from products inner join orders on products.product_id = orders.product_id inner JOIN transaction on orders.transaction_id = transaction.orders where orders.transaction_id = $id";  
                                                $result = mysqli_query($connect, $query);
                                                while($rowssss = mysqli_fetch_array($result,MYSQLI_NUM)){
                                                    echo '<td>'.$rowssss['0'].'</td>';
                                                }
                                                echo '
                                              </tr>
                                            </tbody>
                                          </table>
                                              <div class="card-body">
                                              </div>
                                            </div>
                                          </div>
                                        </div>';
         echo                           '';
         echo                         '</div>';
         echo                       '</div>';
         echo                   '</div>';
         echo                   '<!--/card-block-->';
         echo               '</div>';
         echo           '</div>';
         echo       '</div>';
         echo   '</div>';
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
