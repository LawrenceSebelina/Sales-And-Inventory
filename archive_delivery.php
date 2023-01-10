<?php
include('server/connection.php');

if(isset($_POST['deletedata']))
    {
    $delete_di = $_POST['delete_di'];

    $query_delete = "UPDATE delivery SET delivery_status = 1 WHERE delivery_id='$delete_di'";
    $query_delete_run = mysqli_query($connection, $query_delete);

    if($query_delete_run){
        mysqli_query($connection,"UPDATE delivery SET delivery_arch_date = current_timestamp WHERE delivery_id = '$delete_di'");
        $username = $_SESSION['username'];
        $query1 = "INSERT INTO logs (username,purpose) VALUES('$username','Archived a delivery')";
        $insert = mysqli_query($connection,$query1);
        $_SESSION['status'] = "Archived Successfully";
        $_SESSION['statustext'] = " "; 
        $_SESSION['status_code'] = "success";
        header("location:viewdelivery.php");

        //$username = $_SESSION['username'];
        //$query1 = "INSERT INTO logs (username,purpose) VALUES('$username','Archived a delivery')";
        //$insert = mysqli_query($connection,$query1);
        //mysqli_query($connection,"DELETE FROM delivery WHERE delivery_id='$delete_di'");
        //$_SESSION['status'] = "Archived Successfully";
        //$_SESSION['statustext'] = " "; 
        //$_SESSION['status_code'] = "success";
        //header("location:viewdelivery.php");
    
    }else{
        $_SESSION['status'] = "Error";
        $_SESSION['statustext'] = " "; 
        $_SESSION['status_code'] = "error";
        header("location:viewdelivery.php");

    }

}
    ?>

