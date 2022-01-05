<?php
require('../partials/dbconn.php');
session_start();
    $query0 = "SELECT * from fitems where srno='".$_POST['mycart'][2]."';";
    $res0 = mysqli_query($conn, $query0);
    $row0 = mysqli_fetch_assoc($res0);
    $rname = $row0['rname'];
    $query = "INSERT INTO `orders` (`phnum`, `rname`, `fitems`, `total`, `too`, `stat`, `pymt`) VALUES ('".$_SESSION['phone']."', '".$rname."', '".$_POST['mycart']."', '".$_POST['total']."', current_timestamp(), '-1', '".$_POST['pymtopt']."');";
    // echo $query;
    $res = mysqli_query($conn, $query);
    if(!$res)
    {
        echo "cart not updated";
    }
    else
    {
        echo "cart updated successfully!";
    }

?>