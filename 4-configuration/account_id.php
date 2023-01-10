<?php
include_once('../server/connection.php');
$query = "SELECT account_id FROM users ORDER BY account_id DESC";
$result = mysqli_query($connection,$query);
$row = mysqli_fetch_array($result);
$lastid = $row['account_id'] ?? null;

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
?>
