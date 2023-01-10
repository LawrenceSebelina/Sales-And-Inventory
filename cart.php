<?php include 'server/connection.php';

    if(isset($_POST['pid'])){

        $pid = $_POST['pid'];
        $pdesc = $_POST['pdesc'];
        $pbrand = $_POSt['pbrand'];
        $punit = $_POST['punit'];
        $pprice = $_POST['pprice'];
        $pqty = $_POST['pqty'];
        $qtynum = $_POST['qtynum'];

        $sql = "SELECT quantity FROM product WHERE product_id='$pid'";
        $result = mysqli_query($connection, $sql);
        $qty = mysqli_fetch_array($result);

        $newqty = $qty['quantity'] - $qtynum;

        $query = "UPDATE product SET quantity=$newqty WHERE product_id='$pid'";
        $insert = mysqli_query($connection,$query);
        
        $sql4 = "SELECT minusquantity FROM product WHERE product_id='$pid'";
        $result4 = mysqli_query($connection, $sql4);
        $qty4 = mysqli_fetch_array($result4);

        $newqty4 = $qty4['minusquantity'] + $qtynum;

        $query4 = "UPDATE product SET minusquantity=$newqty4 WHERE product_id='$pid'";
        $insert4 = mysqli_query($connection,$query4);
        //mysqli_query($connection,"UPDATE product SET minusquantity=$qtynum WHERE product_id='$pid'");

        //target.find(".quantityy").text(minusquantity);

        
       

    }



    if(isset($_POST['pidd'])){

        $pidd = $_POST['pidd'];
        $quantityadd = $_POST['quantityadd'];

        $sql2 = "SELECT quantity FROM product WHERE product_id='$pidd'";
        $result2 = mysqli_query($connection, $sql2);
        $qty2 = mysqli_fetch_array($result2);

        $newqty2 = $qty2['quantity'] + $quantityadd;

        $query2 = "UPDATE product SET quantity=$newqty2 WHERE product_id='$pidd'";
        $insert2 = mysqli_query($connection,$query2);


        $sql3 = "SELECT minusquantity FROM product WHERE product_id='$pidd'";
        $result3 = mysqli_query($connection, $sql3);
        $qty3 = mysqli_fetch_array($result3);

        $newqty3 = $qty3['minusquantity'] - $quantityadd;

        $query3 = "UPDATE product SET minusquantity=$newqty3 WHERE product_id='$pidd'";
        $insert3 = mysqli_query($connection,$query3);


        //target.find(".quantityy").text(minusquantity);

       

    }

    if(isset($_POST['piddd'])){

        $piddd= $_POST['piddd'];
        $quantitycancel = $_POST['quantitycancel'];

        //$sql6 = "SELECT minusquantity FROM product WHERE product_id='$piddd'";
        //$result6 = mysqli_query($connection, $sql6);
        //$qty6 = mysqli_fetch_array($result6);

        //$newqty5 = $qty5['quantity'] + $qty6['minusquantity'];

        for($num = 0; $num < count($piddd); $num++){
            $product_id = mysqli_real_escape_string($connection, $piddd[$num]);
            $qtyold = mysqli_real_escape_string($connection, $quantitycancel[$num]);

            $sql5 = "SELECT quantity FROM product WHERE product_id='$product_id'";
            $result5 = mysqli_query($connection, $sql5);
            $qty5 = mysqli_fetch_array($result5);

            $newqty5 = $qty5['quantity'] + $qtyold;

            $sql6 = "UPDATE product SET quantity=$newqty5 WHERE product_id='$product_id'";
            $result7 = mysqli_query($connection, $sql6);
        }

        for($num1 = 0; $num1 < count($piddd); $num1++){
            $product_id1 = mysqli_real_escape_string($connection, $piddd[$num1]);
            $qtyold1 = mysqli_real_escape_string($connection, $quantitycancel[$num1]);

            $sql7 = "SELECT minusquantity FROM product WHERE product_id='$product_id1'";
            $result6 = mysqli_query($connection, $sql7);
            $qty6 = mysqli_fetch_array($result6);

            $newqty6 = $qty6['minusquantity'] - $qtyold1;

            $sql8 = "UPDATE product SET minusquantity=$newqty6 WHERE product_id='$product_id1'";
            $result8 = mysqli_query($connection, $sql8);
        }


        //target.find(".quantityy").text(minusquantity);

       

    }


    if(isset($_POST['pidddd'])){

        $pidddd = $_POST['pidddd'];
        $quantityreload = $_POST['quantityreload'];

        for($num3 = 0; $num3 < count($pidddd); $num3++){
            $product_id2 = mysqli_real_escape_string($connection, $pidddd[$num3]);
            $qtyold2 = mysqli_real_escape_string($connection, $quantityreload[$num3]);

            $sql9 = "SELECT quantity FROM product WHERE product_id='$product_id2'";
            $result9 = mysqli_query($connection, $sql9);
            $qty7 = mysqli_fetch_array($result9);

            $newqty7 = $qty7['quantity'] + $qtyold2;

            $sql10 = "UPDATE product SET quantity=$newqty7 WHERE product_id='$product_id2'";
            $result10 = mysqli_query($connection, $sql10);
        };


        //target.find(".quantityy").text(minusquantity);

       

    }
?>

