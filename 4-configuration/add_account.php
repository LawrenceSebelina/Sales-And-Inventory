<?php
include_once('../server/connection.php');

if(isset($_POST['insertdata']))
    {
    $account_id = $_POST['account_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $contact = $_POST['contact'];
    $position = $_POST['position'];
    $username = $_POST['username'];
    $password = $_POST['password'];


    if(!$connection)
    {
        die("connection failed" . mysqli_connect_error());
    }
    $query = "SELECT username FROM users WHERE username='$username'";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0){

    $name_error = "Username already exists";
    $_SESSION['status'] = "Failed";
    $_SESSION['statustext'] = "Username already exists, Please try again!";  
    $_SESSION['status_code'] = "error";
    header("location:manage_accounts.php");
    }
    else
    {
        $password = md5($password);
        $sql = "INSERT INTO users (account_id, firstname, lastname, contact, position, username, password) VALUES ('".$account_id."','".$first_name."','".$last_name."','".$contact."','".$position."','".$username."','".$password."') ";
        if(mysqli_query($connection,$sql))
        {
            $username = $_SESSION['username'];
            $query1 = "INSERT INTO logs (username,purpose) VALUES('$username','Created a New Account')";
            $insert = mysqli_query($connection,$query1);
            $query = "SELECT account_id FROM users ORDER BY account_id DESC";
            $result = mysqli_query($connection,$query);
            $row = mysqli_fetch_array($result);
            $lastid = $row['account_id'];
 
            if(empty($lastid))
            {
                $number = "AID-0000001";
            }
            else
            {
                $idd = str_replace("AID-", "", $lastid);
                $id = str_pad($idd + 1, 7, 0, STR_PAD_LEFT);
                $number = 'AID-'.$id;
            }
            $_SESSION['status'] = "Added Successfully";
            $_SESSION['statustext'] = " "; 
            $_SESSION['status_code'] = "success";
            header("location:manage_accounts.php");
 
        }
        else
        {
            $_SESSION['status'] = "Failed";
            $_SESSION['statustext'] = "Account Not Added!"; 
            $_SESSION['status_code'] = "error";
            header("location:manage_accounts.php");
        }
    }
}
    ?>
