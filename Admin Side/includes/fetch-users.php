<?php
$connect = mysqli_connect("www.db.com", "root1", "", "db");
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "select user_id, concat(firstname, ' ', middle_initial, ' ', lastname)as 'name', 
 usertype, status from users where   (firstname like '%".$search."%' OR lastname 
 like '%".$search."%' OR middle_initial like '%".$search."%' OR usertype like '%".$search."%') 
 and status != 'pending' and usertype!='admin' order by user_id asc";
}
else
{
 $query = "
 select user_id, concat(firstname, ' ', middle_initial, ' ', lastname)as 'name', usertype, status from users
 where status != 'pending' and usertype!='admin' order by user_id asc
 ";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
   echo '<div class="container">';
   echo     '<div class="row">';
   echo         '<div class="col-md-12" ng-show="filter_data > 0">';
   echo             '<table class="table table-striped table-bordered text-center" style="background-color: white; margin-top: 15px;">';
   echo                 '<thead>';
   echo                     '<th>ID</th>';
   echo                     '<th>Name</th>';
   echo                     '<th>Type</th>';
   echo                     '<th>Status</th>';
   echo                     '<th>View Profile</th>';
   echo                     '<th>Action</th>';
   echo                 '</thead>';
   echo                 '<tbody>';

 while($row = mysqli_fetch_array($result))
 {
    extract($row);
    echo                     '<tr>';
    echo                         '<td>'.$row["user_id"].'</td>';
    echo                         '<td class="text-justify">'.$row["name"].'</td>';
    echo                         '<td>'.$row["usertype"].'</td>';
    echo                         '<td>'.$row["status"].'</td>';
    echo                         '<td><a href="viewprofile.php?view='.$row["user_id"].'"><button type="button" class="btn btn-dark">View Profile</button></a></td>';
    echo                         '<td><a href="includes/action.php?change='.$row["user_id"].'&amp;stat='.$row["status"].'"><button type="button" class="btn btn-warning">Activate/Deactivate</button></a></td>';
    echo                     '</tr>';
                        
 }

}
else
{
 echo '<div class="container text-center" style="height: 218px;">Data Not Found</div>';
}

?>