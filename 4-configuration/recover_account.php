<?php
include('../server/connection.php');

if(isset($_POST['recoverdata']))
    {
    $recover_ai = $_POST['recover_ai'];

    $query_recover = "UPDATE users SET account_status = 0 WHERE account_id='$recover_ai'";
    $query_recover_run = mysqli_query($connection, $query_recover);

    if($query_recover_run){
        mysqli_query($connection,"UPDATE users SET account_arch_date = current_timestamp WHERE account_id='$recover_ai'");
        $username = $_SESSION['username'];
        $query1 = "INSERT INTO logs (username,purpose) VALUES('$username','Recovered an account')";
        $insert = mysqli_query($connection,$query1);
        $_SESSION['status'] = "Recovered Successfully";
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

