<?php
$query_product = "SELECT product_id FROM product ORDER BY product_id DESC";
$result_product = mysqli_query($connection,$query_product);
$row = mysqli_fetch_array($result_product);
$lastid = $row['product_id'] ?? null;

if(empty($lastid))
{
    $number = "PID-0000001";
}
else
{
    $idd = str_replace("PID-", "", $lastid);
    $id = str_pad($idd + 1, 7, 0, STR_PAD_LEFT);
    $number = 'PID-'.$id;
}
?>

