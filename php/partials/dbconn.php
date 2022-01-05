<?php
        $server = "localhost";
        $username = "root";
        $password = "";
        $conn = mysqli_connect($server,$username,$password);
        if(!$conn)
            {
                echo "Connection to Database Failed";
                echo "<br>";
            }
        mysqli_query($conn,"use bitesbank;");
?>