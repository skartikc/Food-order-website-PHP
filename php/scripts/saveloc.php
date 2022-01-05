<?php
require('../partials/dbconn.php');
session_start();
    $query = "UPDATE `profile` SET `lat` = '".$_POST['lat']."', `lon` = '".$_POST['lon']."'  WHERE `profile`.`phnum` = '".$_SESSION['phone']."'";
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