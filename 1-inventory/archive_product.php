<?php
include('../server/connection.php');

if(isset($_POST['deletedata']))
    {
    $delete_id = $_POST['delete_id'];
    
    
    $query_delete = "UPDATE product SET product_status = 1 WHERE product_id='$delete_id'";
    $query_delete_run = mysqli_query($connection, $query_delete);

    if($query_delete_run){
        mysqli_query($connection,"UPDATE product SET product_arch_date = current_timestamp WHERE product_id = '$delete_id'");
        $username = $_SESSION['username'];
        $query1 = "INSERT INTO logs (username,purpose) VALUES('$username','Archived a product')";
        $insert = mysqli_query($connection,$query1);
        $_SESSION['status'] = "Archived Successfully"; 
        $_SESSION['statustext'] = " "; 
        $_SESSION['status_code'] = "success";
        header("location:manage_product.php");
    
    }else{
        $_SESSION['status'] = "Error";
        $_SESSION['statustext'] = " ";  
        $_SESSION['status_code'] = "error";
        header("location:manage_product.php");

    }

}
    ?>

