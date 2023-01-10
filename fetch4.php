<?php
//fetch.php;
include('server/connection.php'); 

$query = "SELECT * FROM delivery WHERE DATE(`mindate`) <= CURDATE()";
$result = mysqli_query($connection, $query);

$output = '';
while($row = mysqli_fetch_array($result)){
$output .= '
    <div class="alert alert_default">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <p>Firstname: <strong>'.$row['delivery_id'].'</strong><br>
        Lastname: <strong>'.$row['delivery_id'].'</strong></p>
    </div>
    ';
}
 
//mysqli_query($conn,"update `user` set seen_status='1' where seen_status='0'");
//SELECT TABLE_SCHEMA as karesma_si, SUM(ROUND(((DATA_LENGTH + INDEX_LENGTH) / 1024 / 1024), 2)) AS mb FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'karesma_si'
echo $output;
 
?>