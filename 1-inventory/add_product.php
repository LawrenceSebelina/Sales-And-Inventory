<?php
include('../server/connection.php');

if(isset($_POST['insertdata']))
    {
    $product_id = $_POST['product_id'];
    $product_desc = $_POST['product_desc'];
    $brand = $_POST['brand'];
    $unit = $_POST['unit'];
    $unit_price = $_POST['unit_price'];
    
    $_SESSION['status'] = "Added Successfully";
    $_SESSION['statustext'] = " ";  
    $_SESSION['status_code'] = "success";
    header("location:manage_product.php");
    

    if(!$connection)
    {
        die("connection failed" . mysqli_connect_error());
    }
    else
    {
        $sql = "INSERT INTO product (product_id, product_desc, brand, unit, unit_price) VALUES ('".$product_id."','".$product_desc."','".$brand."','".$unit."','".$unit_price."') ";
        if(mysqli_query($connection,$sql))
        {
            $username = $_SESSION['username'];
            $query1 = "INSERT INTO logs (username,purpose) VALUES('$username','Added a new product')";
	 		$insert = mysqli_query($connection,$query1);
            $query = "SELECT product_id FROM product ORDER BY product_id DESC";
            $result = mysqli_query($connection,$query);
            $row = mysqli_fetch_array($result);
            $lastid = $row['product_id'];
 
            if(empty($lastid))
            {
                $number = "PID-0000001";
                $number2 = "SID-0000001";
            }
            else
            {
                $idd = str_replace("PID-", "", $lastid);
                $id = str_pad($idd + 1, 7, 0, STR_PAD_LEFT);
                $number = 'PID-'.$id;
                $number2 = 'SID-'.$id;
            }
        }
        else
        {
            $_SESSION['status'] = "Failed";
            $_SESSION['statustext'] = "Product Not Added!";  
            $_SESSION['status_code'] = "error";
            header("location:manage_product.php");
        }
    }
}
    ?>
