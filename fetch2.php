<?php
 include('server/connection.php'); 
    //fetch.php;
    //$query = "SELECT * FROM delivery WHERE status = 'Pending' AND DATE(`date`) = CURDATE() AND notif_status = 0 ORDER BY date DESC";
    //orig $query = "SELECT * FROM delivery WHERE DATE(`date`) = CURDATE() AND TIME(`time`) = CURTIME()";
    //$query = "SELECT * FROM delivery WHERE DATE(`date`) = CURDATE() AND STR_TO_DATE(time, '%H:%i') >= DATE_SUB(NOW(), INTERVAL 5 MINUTE)";

    $query = "SELECT * FROM delivery WHERE notif_status = 0 AND DATE(`date`) = CURDATE() AND TIME_FORMAT(fivem_time, '%H:%i') = TIME_FORMAT(CURTIME(), '%H:%i')";
    $result = mysqli_query($connection, $query);

    //SELECT username, role, lastseen FROM database.accounts WHERE STR_TO_DATE(lastseen, '%Y-%m-%d %H:%i:%s') >= DATE_SUB(NOW(), INTERVAL 10 MINUTE) AND role='admin'
    
    $output = '';
    while($row = mysqli_fetch_array($result)){
    
    $output .= '

        <div class="modal-body alert" style="background: rgba(0, 0, 0, 0.5);">
        <h5 class="modal-title fw-bold text-white ms-1" id="exampleModalLabel">Upcoming Delivery<span><a href="#" class="close text-dark text-white ms-5 ps-2 h1" style="text-decoration: none; " data-bs-dismiss="alert" aria-label="Close">&times;</a></span></h5>

        <a href="delivery_notif_details.php?receipt_no='.$row["receipt_no"].'" class="close text-white d-flex align-items-center mt-2" style="text-decoration: none; font-size: 20px;">

            <div class="mx-1">
                <div class="icon-circle">
                    <i class="bi bi-truck text-white bg-success" style="padding:10px; border-radius: 50%;"></i>
                </div>
            </div>
                <audio autoplay>
                    <source src="images/notification_sound.ogg" type="audio/ogg">
                    <source src="images/notification_sound.mp3" type="audio/mpeg">
                </audio> 
            <div class="mx-2">
                <div class="small text-gray-500"><small><i>'.date('M d, Y', strtotime($row["date"])).'</i></small> | <small><i>'.date('h:i A', strtotime($row["time"])).'</i></small> <br/></div>
                '.$row['delivery_id'].'
            </div>
            
        </a>
        </div>
    ';   
    
    }

    //mysqli_query($connection,"UPDATE delivery SET notif_status = 1 WHERE status = 'Pending' AND DATE(`date`) = CURDATE() AND TIME(`fivem_time`) <= CURTIME() ");
    
    echo $output;

    //<audio autoplay>
        //<source src="images/notification_sound.ogg" type="audio/ogg">
        //<source src="images/notification_sound.mp3" type="audio/mpeg">
    //</audio> 
    
    //echo json_encode($output);
?>

<!-- <script> alert("Hello! I am an alert box!"); </script>
<script>alert('.date('F d, Y', strtotime($row["date"])).');</script>


        <div class ="alert bg-dark text-white alert_default">
    <span>Upcoming deliveries</span><a href="#" class="close text-white d-flex justify-content-end mb-2" style="text-decoration: none; font-size: 40px;" data-bs-dismiss="alert" aria-label="close">&times;</a>
    <a href="#" class="close text-white d-flex align-items-center mb-2" style="text-decoration: none; font-size: 20px;">
    <div class="mx-1">
        <div class="icon-circle">
            <i class="bi bi-truck text-white bg-warning" style="padding:10px; border-radius: 50%;"></i>
        </div>
    </div>
    <div class="mx-2">
        <div class="small text-gray-500"><small><i>'.date('F d, Y | h:i A', strtotime($row["date"])).'</i></small><br/></div>
        '.$row['delivery_id'].'
    </div>
   </a>
   
   </div>

   <script> alert("Hello! I am an alert box!"); </script>
-->