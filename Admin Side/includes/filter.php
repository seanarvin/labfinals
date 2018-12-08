<?php  
 //filter.php  
 if(isset($_POST["from_date"], $_POST["to_date"]))  
 {  
      $connect = mysqli_connect("www.db.com", "root1", "", "db");  
      $output = '';  
      $query = "select orders.transaction_id as 'id', date_start, date_end, sum(((timestampdiff(day,
      transaction.date_start, transaction.date_end)-1)*products.product_rate)+products.product_price)
       as 'Total Cost' from transaction inner join orders on transaction.id = orders.transaction_id
        inner join products on orders.product_id = products.product_id where orders.transaction_id
         = transaction.orders AND date_end BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."'  
         group by orders.transaction_id 
      ";  
      $result = mysqli_query($connect, $query);  
      $output .= '  
           <table class="table table-striped table-bordered text-center">  
                <tr> 
                    <th width="20%">ID</th>  
                    <th width="20%">Date Start</th>  
                    <th width="20%">Date End</th>  
                    <th width="20%">Amount</th>  
                    <th width="20%">View</th>   
                </tr>  
      ';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <tr>  
                        <td>'.$row["id"].'</td>  
                        <td>'.$row["date_start"].'</td>  
                        <td>'.$row["date_end"].'</td> 
                        <td>₱ '.$row["Total Cost"].'</td> 
                        <td><a href="viewtransaction.php?view='.$row['id'].'"> <button type="button" class="btn btn-dark">View Transaction</button></a></td> 
                     </tr>  
                ';  
           }  
      }  
      else  
      {  
           $output .= '  
                <tr>  
                     <td colspan="5">No Order Found</td>  
                </tr>  
           ';  
      }  
      $output .= '</table>';  
      echo $output;  
 }  
 ?>