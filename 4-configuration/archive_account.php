<?php
include('../server/connection.php');

if(isset($_POST['deletedata']))
    {
    $delete_ai = $_POST['delete_ai'];

    $query_delete = "UPDATE users SET account_status = 1 WHERE account_id='$delete_ai'";
    $query_delete_run = mysqli_query($connection, $query_delete);

    if($query_delete_run){
        mysqli_query($connection,"UPDATE users SET account_arch_date = current_timestamp WHERE account_id='$delete_ai'");
        $username = $_SESSION['username'];
        $query1 = "INSERT INTO logs (username,purpose) VALUES('$username','Archived an account')";
        $insert = mysqli_query($connection,$query1);
        $_SESSION['status'] = "Archived Successfully";
        $_SESSION['statustext'] = " "; 
        $_SESSION['status_code'] = "success";
        header("location:manage_accounts.php");
    
    }else{
        $_SESSION['status'] = "Error";
        $_SESSION['statustext'] = " ";  
        $_SESSION['status_code'] = "error";
        header("location:manage_accounts.php");

    }

}
    ?>

