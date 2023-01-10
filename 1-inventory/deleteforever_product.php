<?php
include('../server/connection.php');

if(isset($_POST['deletefdata']))
    {
    $deletef_id = $_POST['deletef_id'];
    
    $query_deletef = "DELETE FROM product WHERE product_id='$deletef_id'";
    $query_deletef_run = mysqli_query($connection, $query_deletef);

    if($query_deletef_run){
        $username = $_SESSION['username'];
        $query1 = "INSERT INTO logs (username,purpose) VALUES('$username','Deleted a product')";
        $insert = mysqli_query($connection,$query1);
        $_SESSION['status'] = "Delete Product Forever Successfully"; 
        $_SESSION['status_code'] = "success";
        $_SESSION['statustext'] = " "; 
        header("location:manage_product.php");
    
    }else{
        $_SESSION['status'] = "Error";
        $_SESSION['statustext'] = " ";  
        $_SESSION['status_code'] = "error";
        header("location:manage_product.php");

    }

}
    ?>

