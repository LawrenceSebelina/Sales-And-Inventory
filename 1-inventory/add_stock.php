<?php
include('../server/connection.php');

if(isset($_POST['addstockdata']))
    {
    $stock_id = $_POST['stock_id'];
    $quantity = $_POST['quantity'];
    $addstock = $_POST['addstock'];

    $product_desc = $_POST['product_desc'];
    $action = $_POST['action'];
    $adjusted_by = $_POST['adjusted_by'];
    $reason = $_POST['reason'];
    
    $query_addstock = "UPDATE product SET quantity = $quantity + $addstock WHERE product_id = '$stock_id'";
    $query_addstock_run = mysqli_query($connection, $query_addstock);

    if($query_addstock_run){
        mysqli_query($connection, "INSERT INTO adjust_stock (product_id, product_desc, adjusted, quantity, action, adjusted_by, reason) VALUES ('".$stock_id."','".$product_desc."', '".$addstock."', '".$quantity + $addstock."','".$action."','".$adjusted_by."','".$reason."') ");
        mysqli_query($connection,"UPDATE product SET stock_date = current_timestamp WHERE product_id = '$stock_id'");
        $username = $_SESSION['username'];
        $query1 = "INSERT INTO logs (username,purpose) VALUES('$username','Added a new product stock')";
        $insert = mysqli_query($connection,$query1);
        $_SESSION['status'] = "New Product Stock Added Successfully";
        $_SESSION['statustext'] = " ";  
        $_SESSION['status_code'] = "success";
        header("location:manage_stock.php");
    
    }else{
        $_SESSION['status'] = "Failed";
        $_SESSION['statustext'] = " ";  
        $_SESSION['status_code'] = "error";
        header("location:manage_stock.php");

    }

}
    ?>
    
