<?php
    include('server/connection.php');

    if (isset($_POST["get_data"]))
    {

        $idd = $_POST["id"];
 
        $sqll = "SELECT * FROM delivery WHERE delivery_id='$idd'";
        $resultt = mysqli_query($connection, $sqll);
        $roww = mysqli_fetch_object($resultt);
 
        echo json_encode($roww);
 
        exit();
    }
?>