<?php
$query_delivery = "SELECT delivery_id FROM delivery ORDER BY delivery_id DESC";
$result_delivery = mysqli_query($connection,$query_delivery);
$row1 = mysqli_fetch_array($result_delivery);
$lastid1 = $row1['delivery_id'] ?? null;

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
?>
