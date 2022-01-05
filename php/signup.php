<?php
    require('partials/basefunc.php');
        sesh_start();
?>
<?php
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        include("partials/dbconn.php");
        if($_POST['password']==$_POST['cpassword'])
        {   
            if(strlen($_POST['phone'])!=10)
                echo "<script>alert('Please enter a valid phone number')</script>";
                
            else if(strlen($_POST['password'])<5)
                    echo "<script>alert('Please enter a password more than 5 characters')</script>";
                
            else
            {
                $query = "select * from login where phnum='".$_POST['phone']."'";
                $result = mysqli_query($conn,$query);
                $chk = mysqli_num_rows($result);
                if($chk==0)
                {   
                    $query2="INSERT INTO `login` (`srno`, `phnum`, `pass`) VALUES (NULL,'".$_POST['phone']."', '".$_POST['password']."')";
                    $result2 = mysqli_query($conn,$query2);
                    $chki=0;
                    $query3="INSERT INTO `profile` (`srno`, `phnum`, `name`, `add1`, `lat`, `lon`, `sub`) VALUES (NULL,'".$_POST['phone']."', '', '', '', '', 0)";
                    $result3 = mysqli_query($conn,$query3);
                    if(!$result3)
                        echo "account created but profile not created";
                    if(!$result2)
                        $chki=1;  
                }
                else
                    echo"<script>alert('The user already exists.')</script>";                  
            }
        }
        else 
            echo "<script>alert('The entered passwords do not match.')</script>";
            
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RajuHalwai</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/bootstrap-iso.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/custom-bootstrap.css">
    <script src="../js/index.js"></script>
</head>
<body>
<?php 
    include("partials/header.php");
    if(isset($chki) && $chki==0)
            {
                alertS('Your Account has been created successfully !');
            }
    else if(isset($chki) && $chki==1)  
            {
                alertF('An Error has occured. Please try again.');
            }
?>
<div class="form-s-u">
        <form action='signup.php' class="bootstrap-iso" method="POST">
            <p class='text-center mt mb'>Welcome to BitesBank. Please sign-up below!</p>
            <div class="mb mt">
                <label for="phone" class="form-label">Enter your phone number</label>
                <input type="phone" name="phone" class="form-control" id="phone" aria-describedby="phoneHelp">
            </div>
            <div class="mb mt">
                <label for="password" class="form-label">Enter your password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <div class="mb mt">
                <label for="password" class="form-label">Confirm your password</label>
                <input type="password" name="cpassword" class="form-control" id="cpassword">
            </div>
            <button id="subm-btn"type="submit" class="mb btn btn-primary">Submit</button>
        </form>        
</div>
<?php include("partials/footer.php") ?>