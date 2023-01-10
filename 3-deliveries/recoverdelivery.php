<?php
include('../server/connection.php');

if(isset($_POST['recoverdata']))
    {
    $recover_di = $_POST['recover_di'];

    $query_recover = "UPDATE delivery SET delivery_status = 0 WHERE delivery_id='$recover_di'";
    $query_recover_run = mysqli_query($connection, $query_recover);
    
    if($query_recover_run){
        mysqli_query($connection,"UPDATE delivery SET delivery_arch_date = current_timestamp WHERE delivery_id = '$recover_di'");
        $username = $_SESSION['username'];
        $query1 = "INSERT INTO logs (username,purpose) VALUES('$username','Recovered a delivery')";
        $insert = mysqli_query($connection,$query1);
        $_SESSION['status'] = "Recovered Successfully";
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

