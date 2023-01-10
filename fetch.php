<?php
 include('server/connection.php'); 

 if(isset($_POST['view'])){
 //mysqli_query($connection,"UPDATE delivery SET status = 'Not delivered', notif_status = 1, reason = 'This delivery not delivered its scheduled time or the status is not updated yet.' WHERE DATE(`date`) = CURDATE() AND TIME(`time`) < CURTIME()");
 //mysqli_query($connection,"UPDATE delivery SET status = 'Cancelled', notif_status = 1, reason = 'This delivery is out of date based on its scheduled delivery date.' WHERE DATE(`date`) < CURDATE() AND status = 'Not delivered'");
 mysqli_query($connection,"UPDATE delivery SET status = 'Not delivered', notif_status = 1 WHERE DATE(`date`) = CURDATE() AND TIME_FORMAT(time, '%H:%i') < TIME_FORMAT(CURTIME(), '%H:%i')");
 mysqli_query($connection,"UPDATE delivery SET status = 'Not delivered', notif_status = 1 WHERE DATE(`date`) < CURDATE() AND status = 'Pending'");

 //$con = mysqli_connect("localhost", "root", "", "notif");
 //mysqli_query($connection,"UPDATE delivery SET status = 'Cancelled' AND notif_status = 1 AND reason = 'The delivery is out of date' WHERE DATE(`date`) < CURDATE()");
 //mysqli_query($connection,"UPDATE delivery SET status = 'Not delivered', notif_status = 1, reason = 'This delivery not delivered its scheduled time or the status is not updated yet.' WHERE DATE(`date`) = CURDATE() AND TIME(`time`) < CURTIME()");
 if($_POST["view"] != '')
 {
    $update_query = "UPDATE delivery SET notif_status = 1 WHERE notif_status = 0";
    mysqli_query($connection, $update_query);
 }
 //mysqli_query($connection, "INSERT INTO notif_delivery (delivery_id, receipt_no, transaction_id, cust_fname, cust_lname, cust_block, cust_lot, cust_street, cust_barangay, cust_city, cust_province, cust_others, cust_contact, status, notif_status, date, time, fivem_time) SELECT delivery_id, receipt_no, transaction_id, cust_fname, cust_lname, cust_block, cust_lot, cust_street, cust_barangay, cust_city, cust_province, cust_others, cust_contact, status, notif_status, date, time, fivem_time FROM delivery WHERE TIME(`fivem_time`) >= CURTIME()");
 //SELECT * FROM delivery WHERE DATE_FORMAT(time, '%H:%i') < CURTIME();
 //$query = " SELECT * FROM delivery WHERE status = 'Pending' AND DATE(`date`) = CURDATE() ORDER BY time DESC LIMIT 5";
 $query = "SELECT * FROM delivery WHERE DATE(`date`) = CURDATE() AND TIME(`fivem_time`) < CURTIME() AND notif_status = 1 ORDER BY time DESC";
 $result = mysqli_query($connection, $query);
 
 $output = '<span class="fw-bold">&nbsp&nbspNotifications</span>
 <hr>';
 if(mysqli_num_rows($result) > 0)
 {
  while($row = mysqli_fetch_array($result))
  {
    $output .= '
    
    <li style="width:300px;">
    <a class="dropdown-item d-flex align-items-center" href="delivery_notif_details.php?receipt_no='.$row["receipt_no"].'">
    <div class="mx-1">
        <div class="icon-circle">
            <i class="bi bi-truck text-white bg-success" style="padding:10px; border-radius: 50%;"></i>
        </div>
    </div>
    <div class="mx-4">
        <div class="small text-gray-500"><small><b>Upcoming delivery at</b></small>&nbsp<b><i>'.date('h:i A', strtotime($row["time"])).'</i></b><br/></div>
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
      <li style="width:300px;" class="text-center mb-3 mt-3"><span class="fw-bold">No Notification Found</span></li>';
 }
 
 $status_query = "SELECT * FROM delivery WHERE notif_status = 0 AND DATE(`date`) = CURDATE() AND TIME_FORMAT(fivem_time, '%H:%i') = TIME_FORMAT(CURTIME(), '%H:%i')";
 $result_query = mysqli_query($connection, $status_query);
 $count = mysqli_num_rows($result_query);
 $data = array(
     'notification' => $output,
     'unseen_notification'  => $count
 );
 
 echo json_encode($data);
 
 }
 

?>


