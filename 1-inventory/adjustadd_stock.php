<?php
include('../server/connection.php');

if(isset($_POST['addstockdata']))
    {
    $adjust_id = $_POST['adjust_id'];
    $adjust_quantity = $_POST['adjust_quantity'];
    $adjustaddstock = $_POST['adjustaddstock'];
    $product_desc = $_POST['product_desc'];
    $action = $_POST['action'];
    $adjusted_by = $_POST['adjusted_by'];
    $reason = $_POST['reason'];
    
    

    $query_addstock = "UPDATE product SET quantity = $adjustaddstock + $adjust_quantity WHERE product_id = '$adjust_id'";
    $query_addstock_run = mysqli_query($connection, $query_addstock);

    if($query_addstock_run){

        mysqli_query($connection, "INSERT INTO adjust_stock (product_id, product_desc, adjusted, quantity, action, adjusted_by, reason) VALUES ('".$adjust_id."','".$product_desc."', '".$adjustaddstock."', '".$adjustaddstock + $adjust_quantity."','".$action."','".$adjusted_by."','".$reason."') ");
        $username = $_SESSION['username'];
        $query1 = "INSERT INTO logs (username,purpose) VALUES('$username','Adjust a product stock - Add')";
        $insert = mysqli_query($connection,$query1);
        $_SESSION['status'] = "Adjusted";
        $_SESSION['statustext'] = "Added Stock Successfully!";  
        $_SESSION['status_code'] = "success";
        header("location:adjust_stock.php");
    
    }else{
        $_SESSION['status'] = "Failed";
        $_SESSION['statustext'] = " ";  
        $_SESSION['status_code'] = "error";
        header("location:adjust_stock.php");

    }

}
    ?>
    
