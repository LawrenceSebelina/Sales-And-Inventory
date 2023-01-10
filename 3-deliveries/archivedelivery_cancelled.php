<?php
include('../server/connection.php');

if(isset($_POST['deletedata']))
    {
    $delete_di = $_POST['delete_di'];
    $reason = $_POST['reason'];
    
    $query_delete = "UPDATE delivery SET delivery_status = 1, reason = '$reason' WHERE delivery_id='$delete_di'";
    $query_delete_run = mysqli_query($connection, $query_delete);

    if($query_delete_run){
        mysqli_query($connection,"UPDATE delivery SET delivery_arch_date = current_timestamp WHERE delivery_id = '$delete_di'");
        //mysqli_query($connection,"INSERT INTO delivery (reason) VALUES ('$reason') WHERE delivery_id = '$delete_di'");
        $username = $_SESSION['username'];
        $query1 = "INSERT INTO logs (username,purpose) VALUES('$username','Archived a delivery')";
        $insert = mysqli_query($connection,$query1);
        $_SESSION['status'] = "Archived Successfully";
        $_SESSION['statustext'] = " "; 
        $_SESSION['status_code'] = "success";
        header("location:monitor_deliveries_cancelled.php");
    
    }else{
        $_SESSION['status'] = "Error";
        $_SESSION['statustext'] = " "; 
        $_SESSION['status_code'] = "error";
        header("location:monitor_deliveries_cancelled.php");

    }

}
    ?>

