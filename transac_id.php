<?php
$query_transac = "SELECT transaction_id FROM transaction_logs ORDER BY transaction_id DESC";
$result_transac = mysqli_query($connection,$query_transac);
$row2 = mysqli_fetch_array($result_transac);
$lastid = $row2['transaction_id'] ?? null;

if(empty($lastid))
{
    $number = "TID-0000001";
}
else
{
    $idd = str_replace("TID-", "", $lastid);
    $id = str_pad($idd + 1, 7, 0, STR_PAD_LEFT);
    $number = 'TID-'.$id;
}
?>