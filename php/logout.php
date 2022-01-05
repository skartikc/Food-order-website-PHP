<?php 
session_start();
$_SESSION['logout']=1;
header("location: index.php");
?>