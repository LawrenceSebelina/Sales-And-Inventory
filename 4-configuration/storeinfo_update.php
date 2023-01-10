<?php
include('../server/connection.php');

if(isset($_POST['updatedata']))
    {
    $store_id = $_POST['store_id'];
    $store_name = $_POST['store_name'];
    $store_block = $_POST['store_block'];
    $store_lot = $_POST['store_lot'];
    $store_street = $_POST['store_street'];
    $store_barangay = $_POST['store_barangay'];
    $store_city = $_POST['store_city'];
    $store_province = $_POST['store_province'];
    $store_zip = $_POST['store_zip'];
    $store_contact = $_POST['store_contact'];
   
        $query_update = "UPDATE store_info SET store_name='$store_name', store_block='$store_block', store_lot='$store_lot', store_street='$store_street', store_barangay='$store_barangay', store_city='$store_city', store_province='$store_province', store_zip='$store_zip', store_contact='$store_contact' WHERE store_id='$store_id'";
        $query_update_run = mysqli_query($connection, $query_update);

        if($query_update_run){
            $username = $_SESSION['username'];
            $query1 = "INSERT INTO logs (username,purpose) VALUES('$username','Update Store Information')";
            $insert = mysqli_query($connection,$query1);
            $_SESSION['status'] = "Updated Successfully"; 
            $_SESSION['status_code'] = "success";
            header("location:store_info.php");
        
        }else{
            $_SESSION['status'] = "Error"; 
            $_SESSION['status_code'] = "error";
            header("location:store_info.php");

        }
    }
    ?>
