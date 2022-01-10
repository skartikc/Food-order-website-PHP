<?php
    require('../partials/dbconn.php');
    $query0 = "DELETE from fitems WHERE srno=".$_POST['id'];
    $res0 = mysqli_query($conn, $query0);
    if(!$res0)
    {
        echo "cart not updated";
    }
    else
    {
        echo "cart updated successfully!";
    }
    sleep(2.5);
?>