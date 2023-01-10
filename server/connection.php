<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "karesma_si";

    ini_set('display_errors',1);
    error_reporting(E_ALL);
    mysqli_report(MYSQLI_REPORT_ERROR | E_DEPRECATED);

    $connection = mysqli_connect($servername,$username,$password,$dbname);

    if($connection === false){
        die("ERROR: could not connect. " . mysqli_connect_error());

    }

    if(!isset($_SESSION)){
        session_start();	
    }

    if (isset($_POST['signout'])){
        $username = $_SESSION['username'];
        $insert	= "INSERT INTO logs (username, purpose) VALUES ('$username', 'Logout')";
        $logs = mysqli_query($connection, $insert);
        session_destroy();
        unset($_SESSION['username']);
        header('location: ../login.php');
    }
    
?>





