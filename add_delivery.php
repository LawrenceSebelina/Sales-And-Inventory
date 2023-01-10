<?php
include('server/connection.php');

if(isset($_POST['insertdata']))
    {
    $delivery_id = $_POST['delivery_id'];
    $transac_id = $_POST['transac_id'];
    $receipt_no = $_POST['receipt_no'];
    $cust_fname = $_POST['cust_fname'];
    $cust_lname = $_POST['cust_lname'];
    $cust_block = $_POST['cust_block'];
    $cust_lot = $_POST['cust_lot'];
    $cust_street = $_POST['cust_street'];
    $cust_barangay = $_POST['cust_barangay'];
    $cust_city = $_POST['cust_city'];
    $cust_province = $_POST['cust_province'];
    $cust_others = $_POST['cust_others'];
    $cust_contact = $_POST['cust_contact'];
    $status = $_POST['status'];
    $min = date("Y-m-d",strtotime($_POST['min']));

    //echo date("Y-m-d",strtotime($_POST['start_Date']));

    $time = $_POST['time'];
    //DATE_SUB($time - INTERVAL 5 MINUTE)
    //$time2 = DATE_SUB($time - INTERVAL 5 MINUTE);

    $time2 = date('Y-m-d H:i:s', strtotime('-5 minutes', strtotime($_POST['time'])));

    //date('Y-m-d H:i',strtotime('+1 hour +20 minutes',strtotime($start));

    
    $_SESSION['status'] = "Added Successfully";
    $_SESSION['statustext'] = " "; 
    $_SESSION['status_code'] = "success";
    header("location:pos.php");
    
    $check_transaction_id = mysqli_query($connection, "SELECT transaction_id FROM delivery where transaction_id = '$transac_id' ");

    if(!$connection)
    {
        die("connection failed" . mysqli_connect_error());
       
    }else if(mysqli_num_rows($check_transaction_id) > 0){
        $_SESSION['status'] = "Failed"; 
        $_SESSION['statustext'] = "You can't make another delivery for the same transaction!";  
        $_SESSION['status_code'] = "error";
        header("location:pos.php");
    }
    else
    {
        //,'".$time."','".DATE_SUB($time - INTERVAL 5 MINUTE)."'
        $sql = "INSERT INTO delivery (delivery_id, transaction_id, receipt_no, cust_fname, cust_lname, cust_block, cust_lot, cust_street, cust_barangay, cust_city, cust_province, cust_others, cust_contact, status, date, time, fivem_time) VALUES ('".$delivery_id."','".$transac_id."','".$receipt_no."','".$cust_fname."','".$cust_lname."','".$cust_block."','".$cust_lot."','".$cust_street."','".$cust_barangay."','".$cust_city."','".$cust_province."','".$cust_others."','".$cust_contact."','".$status."','".$min."','".$time."','".$time2."') ";
        if(mysqli_query($connection,$sql))
        {
            $username = $_SESSION['username'];
            $query1 = "INSERT INTO logs (username,purpose) VALUES('$username','Added a new delivery')";
            $insert = mysqli_query($connection,$query1);
            $query_delivery = "SELECT delivery_id FROM delivery ORDER BY delivery_id DESC";
            $result_delivery = mysqli_query($connection,$query_delivery);
            $row1 = mysqli_fetch_array($result_delivery);
            $lastid1 = $row1['delivery_id'];            
 
            if(empty($lastid1))
            {
                $number1 = "DN-0000001";
            }
            else
            {
                $idd1 = str_replace("DN-", "", $lastid1);
                $id1 = str_pad($idd1 + 1, 7, 0, STR_PAD_LEFT);
                $number1 = 'DN-'.$id1;
            }
 
        }
        else
        {
            $_SESSION['status'] = "Failed"; 
            $_SESSION['statustext'] = "Delivery Not Added"; 
            $_SESSION['status_code'] = "error";
            header("location:pos.php");
        }
    }
}
    ?>
