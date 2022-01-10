<?php
    require('../partials/dbconn.php');
    $query0 = "UPDATE fitems SET fprice=".$_POST['np']." WHERE srno=".$_POST['id'];
    // echo $query0;
    $res0 = mysqli_query($conn, $query0);
    if(!$res0)
    {
        echo "cart not updated";
    }
    else
    {
        echo "cart updated successfully!";
    }
    sleep(1);
?>