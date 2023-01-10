<?php
 include('server/connection.php'); 

 if(isset($_POST['view'])){
 
 mysqli_query($connection,"UPDATE delivery SET status = 'Cancelled' WHERE DATE(`date`) < CURDATE()");
 
 if($_POST["view"] != '')
 {
    $update_query = "UPDATE delivery SET notif_status = 1 WHERE notif_status = 0";
    mysqli_query($connection, $update_query);
 }
 
 //mysqli_query($connection,"INSERT INTO notif_delivery (delivery_id, receipt_no, transaction_id, cust_fname, cust_lname, cust_block, cust_lot, cust_street, cust_barangay, cust_city, cust_province, cust_others, cust_contact, status, notif_status, date) SELECT delivery_id, receipt_no, transaction_id, cust_fname, cust_lname, cust_block, cust_lot, cust_street, cust_barangay, cust_city, cust_province, cust_others, cust_contact, status, notif_status, date FROM delivery WHERE notif_status = 1 AND DATE(`date`) = CURDATE() ORDER BY date DESC LIMIT 1");

 //$query = " SELECT * FROM delivery WHERE status = 'Pending' AND DATE(`date`) = CURDATE() ORDER BY time DESC LIMIT 5";
 $query = "SELECT * FROM delivery WHERE status = 'Pending' AND DATE(`date`) = CURDATE() ORDER BY time DESC";
 $result = mysqli_query($connection, $query);

 
 $output = '<span class="fw-bold">&nbsp&nbspNotifications</span>
 <hr>';
 if(mysqli_num_rows($result) > 0)
 {
  while($row = mysqli_fetch_array($result))
  {
    $output .= '
    
    <li>
    <a class="dropdown-item d-flex align-items-center" href="delivery_details.php?receipt_no='.$row["receipt_no"].'">
    <div class="mx-1">
        <div class="icon-circle">
            <i class="bi bi-truck text-white bg-success" style="padding:10px; border-radius: 50%;"></i>
        </div>
    </div>
    <div class="mx-2">
        <div class="small text-gray-500"><small><i>'.$row["date"].'</i></small> | <small><i>'.date('h:i A', strtotime($row["time"])).'</i></small><br/></div>
        '.$row['delivery_id'].'
    </div>
   </a>
   
   <div class="dropdown-divider"></div>
   </li>
    '
    ;
 
  }
 }
 else{
      $output .= '
      <li><span class="fw-bold text-center">No Notification Found</span></li>';
 }
 

 
 $status_query = "SELECT * FROM delivery WHERE notif_status = 0 AND DATE(`date`) = CURDATE() AND TIME(`time`) = CURTIME() ";
 $result_query = mysqli_query($connection, $status_query);
 $count = mysqli_num_rows($result_query);
 $data = array(
     'notification' => $output,
     'unseen_notification'  => $count
 );
 
 echo json_encode($data);
 
 }
 

?>


