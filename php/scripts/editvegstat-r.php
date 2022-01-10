<?php
    require('../partials/dbconn.php');
    if($_POST['vs']=='true')
        $query0 = "UPDATE fitems SET vegstat='1' WHERE srno=".$_POST['id'];
    else if($_POST['vs']=='false')
        $query0 = "UPDATE fitems SET vegstat='0' WHERE srno=".$_POST['id'];
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