<?php
    include('../server/connection.php');

    if(isset($_POST['updatedata'])){

        $update_ai = $_POST['update_ai'];
        $update_ln = $_POST['update_ln'];
        $update_fn = $_POST['update_fn'];
        $update_un = $_POST['update_un'];
        $update_contact = $_POST['update_contact'];
        $update_position = $_POST['update_position'];
        
        $query_update = "UPDATE users SET firstname='$update_fn', lastname='$update_ln', contact='$update_contact', username='$update_un', position='$update_position' WHERE account_id='$update_ai'";
        $query_update_run = mysqli_query($connection, $query_update);


        if($query_update_run){
            $username = $_SESSION['username'];
            $query1 = "INSERT INTO logs (username,purpose) VALUES('$username','Updated an account information')";
            $insert = mysqli_query($connection,$query1);
            $_SESSION['status'] = "Updated Successfully";
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