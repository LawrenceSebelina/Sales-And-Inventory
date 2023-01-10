<?php
include('../server/connection.php');

if(isset($_POST['deletefdata']))
    {
    $deletef_id = $_POST['deletef_id'];
    
    $query_deletef = "DELETE FROM users WHERE account_id='$deletef_id'";
    $query_deletef_run = mysqli_query($connection, $query_deletef);

    if($query_deletef_run){
        $username = $_SESSION['username'];
        $query1 = "INSERT INTO logs (username,purpose) VALUES('$username','Deleted an account')";
        $insert = mysqli_query($connection,$query1);
        $_SESSION['status'] = "Delete Account Forever Successfully";
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

