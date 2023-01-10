<?php
    include('../server/connection.php');

    if(isset($_POST['updatedata'])){

        $update_id = $_POST['update_id'];
        $update_pd = $_POST['update_pd'];
        $update_brand = $_POST['update_brand'];
        $update_unit = $_POST['update_unit'];
        $update_up = $_POST['update_up'];
        
        $query_update = "UPDATE product SET product_desc='$update_pd', brand='$update_brand', unit='$update_unit', unit_price='$update_up' WHERE product_id='$update_id'";
        $query_update_run = mysqli_query($connection, $query_update);


        if($query_update_run){
            $username = $_SESSION['username'];
            $query1 = "INSERT INTO logs (username,purpose) VALUES('$username','Updated a product information')";
            $insert = mysqli_query($connection,$query1);
            $_SESSION['status'] = "Updated Successfully";
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

