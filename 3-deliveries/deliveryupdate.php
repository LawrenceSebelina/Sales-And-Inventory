<?php
include('../server/connection.php');

if(isset($_POST['updatedata']))
    {
    $delivery_id = $_POST['delivery_id'];
    $update_fname = $_POST['update_fname'];
    $update_lname = $_POST['update_lname'];
    $update_contact = $_POST['update_contact'];
    $update_block = $_POST['update_block'];
    $update_lot = $_POST['update_lot'];
    $update_street = $_POST['update_street'];
    $update_barangay = $_POST['update_barangay'];
    $update_city = $_POST['update_city'];
    $update_province = $_POST['update_province'];
    $update_scheduledate = $_POST['update_scheduledate'];
    $update_scheduletime = $_POST['update_scheduletime'];
    $update_scheduletime2 = date('Y-m-d H:i:s', strtotime('-5 minutes', strtotime($_POST['update_scheduletime'])));
    $update_status = $_POST['update_status'];
   
        $query_update = "UPDATE delivery SET cust_fname='$update_fname', cust_lname='$update_lname', cust_block='$update_block', cust_lot='$update_lot', cust_street='$update_street', cust_barangay='$update_barangay', cust_city='$update_city', cust_province='$update_province', cust_others='$update_others', cust_contact='$update_contact', status='$update_status', date='$update_scheduledate', time='$update_scheduletime', fivem_time='$update_scheduletime2' WHERE delivery_id='$delivery_id'";
        $query_update_run = mysqli_query($connection, $query_update);
    
        if($query_update_run){
            mysqli_query($connection,"UPDATE delivery SET notif_status = 0 WHERE delivery_id='$delivery_id'");
            $username = $_SESSION['username'];
            $query1 = "INSERT INTO logs (username,purpose) VALUES('$username','Updated a delivery')";
            $insert = mysqli_query($connection,$query1);
            $_SESSION['status'] = "Updated Successfully";
            $_SESSION['statustext'] = " "; 
            $_SESSION['status_code'] = "success";
            header("location:monitor_deliveries.php");
        
        }else{
            $_SESSION['status'] = "Error";
            $_SESSION['statustext'] = " "; 
            $_SESSION['status_code'] = "error";
            header("location:monitor_deliveries.php");
        }
    }
    ?>
