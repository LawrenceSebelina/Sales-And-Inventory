<?php
include('../server/connection.php');

if(isset($_POST['minusstockdata']))
    {
    $stock_id2 = $_POST['stock_id2'];
    $quantity2 = $_POST['quantity2'];
    $minusstock = $_POST['minusstock'];

    $product_desc2 = $_POST['product_desc2'];
    $action2 = $_POST['action2'];
    $adjusted_by2 = $_POST['adjusted_by2'];
    $reason2 = $_POST['reason2'];
    
    if($minusstock <= $quantity2){
        $query_minusstock = "UPDATE product SET quantity = $quantity2 - $minusstock  WHERE product_id = '$stock_id2'";
        $query_minusstock_run = mysqli_query($connection, $query_minusstock);
    }if($query_minusstock_run){
        mysqli_query($connection, "INSERT INTO adjust_stock (product_id, product_desc, adjusted, quantity, action, adjusted_by, reason) VALUES ('".$stock_id2."','".$product_desc2."', '".$minusstock."', '".$quantity2 - $minusstock."','".$action2."','".$adjusted_by2."','".$reason2."') ");
        mysqli_query($connection,"UPDATE product SET stock_date = current_timestamp WHERE product_id = '$stock_id'");
        $username = $_SESSION['username'];
        $query1 = "INSERT INTO logs (username,purpose) VALUES('$username','Deducted product stock')";
        $insert = mysqli_query($connection,$query1);
        $_SESSION['status'] = "Stock Deducted Successfully";
        $_SESSION['statustext'] = " ";  
        $_SESSION['status_code'] = "success";
        header("location:manage_stock.php");
    }else{
        $_SESSION['status'] = "Failed";
        $_SESSION['statustext'] = "The inserted value is higher than the currenct stock";  
        $_SESSION['status_code'] = "error";
        header("location:manage_stock.php");

    }

}
    ?>
    
