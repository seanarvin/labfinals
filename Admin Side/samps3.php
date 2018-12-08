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
    <title>Monitoring</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>   
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> 


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
      .pads{
        margin-top: 15px;
      }
      .boxes{
        margin-bottom: 15px;
      }
      div.titles {
        font-size: 30px;
      }
      .masthead{
        height: 420px;
        margin-top: -85px;
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
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"  href="logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead bg-primary text-white text-center" >
      <div class="container">
        <h1 class="text-uppercase mb-0">Transaction Monitoring</h1>
        <hr class="star-light">
      </div>
    </header>
    <div class="container pads" >
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
                            $query = "SELECT count(id) as 'total' FROM transaction";  
                            $result = mysqli_query($connect, $query);
                            while($row = mysqli_fetch_array($result)){
                              echo '<h4 class="mt-2 text_size">'.$row['total'].'</h4>';
                            }
                          ?>  
                        <p class="m-0 mt-2">Transaction</p>
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
                        $query = "select (sum(((timestampdiff(day, transaction.date_start, transaction.date_end)-1)*products.product_rate)+products.product_price)*0.1) as 'Total Income' from transaction inner join orders on transaction.id = orders.transaction_id inner join products on orders.product_id = products.product_id where orders.transaction_id = transaction.orders
                        ";  
                        $result = mysqli_query($connect, $query);
                        while($row = mysqli_fetch_array($result)){
                          echo '<h4 class="mt-2 text_size">₱ '.$row['Total Income'].'</h4>';
                        }
                      ?> 
                        <p class="m-0 mt-2">Income</p>
                    </div>
                </div>
            </div>
        </div>
    <div id="result" style="min-height: 267px; max-height: auto;">

      <div class="container" style="margin-top: 15px;">
        <div class="row">
          <div class="col-md-12 ">
            <div class="row">
              <div class="col-md-4">
                <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" />
              </div>
              <div class="col-md-4">
                <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" />  
              </div>
              <div class="col-md-2">
                <input type="button" name="filter" id="filter" value="Filter" class="btn btn-info" />
                <input type="button" name="refresh" id="refresh" value="Refresh" class="btn btn-info" />  
              </div>
            </div>
          </div>
        </div>
      </div>
      

      <?php  
        $connect = mysqli_connect("localhost", "root", "", "db");  
        $query = "select distinct(retailer) as 'ID' from transaction";  
        $result = mysqli_query($connect, $query);  
      ?>  
          <div id="order_table" style="margin-top: 15px;">  
          <table>
          <th>
            <td>Name</td>
            <td>Number of transaction</td>
            <td>Start Date</td>
            <td>End Date</td>
            <td>Price</td>
          </th>
                <?php  
                while($row = mysqli_fetch_array($result))  
                {  

                  $query2 = "select concat(users.firstname, ' ', users.middle_initial, ' ', users.lastname) as 'Name', orders.transaction_id as 'id', date_start, date_end, sum(((timestampdiff(day,
                transaction.date_start, transaction.date_end)-1)*products.product_rate)+products.product_price)
                 as 'Total Cost', (select count(transaction.retailer) from transaction where retailer = '.$row[0].') as 'Number of transactions' from users inner join transaction on users.user_id = transaction.retailer inner join orders on transaction.id = orders.transaction_id
                  inner join products on orders.product_id = products.product_id where orders.transaction_id
                   = transaction.orders and transaction.retailer= '.$row[0].' group by Name";
                   $result2 = mysqli_query($connect, $query2);
                  $rows = mysqli_fetch_array($result2);
                  echo '<tr>
                      <td><?php echo $rows[0]?></td>
                      <td><?php echo $rows[1]?></td>
                      <td><?php echo $rows[2]?></td>
                      <td><?php echo $rows[3]?></td>
                      <td><?php echo $rows[4]?></td>
                    </tr>';
                ?>  
                    
                <?php  
                }  
                ?> 
                </table>
          </div>  
      </div>
      </div>
    </div>
    
    <div class="copyright py-4 text-center text-white">
      <div class="container">
        <small>Copyright &copy; SLU Webtech 2018</small>
      </div>
    </div>


  </body>

</html>

<script>  
      $(document).ready(function(){  
           $.datepicker.setDefaults({  
                dateFormat: 'yy-mm-dd'   
           });  
           $(function(){  
                $("#from_date").datepicker();  
                $("#to_date").datepicker();  
           });  
           $('#filter').click(function(){  
                var from_date = $('#from_date').val();  
                var to_date = $('#to_date').val();  
                if(from_date != '' && to_date != '')  
                {  
                     $.ajax({  
                          url:"includes/filter.php",  
                          method:"POST",  
                          data:{from_date:from_date, to_date:to_date},  
                          success:function(data)  
                          {  
                               $('#order_table').html(data);  
                          }  
                     });  
                }
                else  
                {  
                     alert("Please Select Date");  
                }  
           });
           $('#refresh').click(function(){
            window.location.href = "monitoring.php";
           });
      });  
 </script>