<?php
require('../partials/dbconn.php');
session_start();
    $query = "UPDATE `mycart` SET `fitems` = '".$_POST['mycart']."' WHERE `mycart`.`phnum` = '".$_SESSION['phone']."'";
    $res = mysqli_query($conn, $query);
    sleep(1);
    if(!$res)
    {
        echo "cart not updated";
    }
    else
    {
        echo "cart updated successfully!";
    }

?>