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
</head>
<body>
<?php include("partials/header.php") ?>
<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST")
        if(isset($_POST["phone"]))
        {
            $phone = $_POST["phone"];
            $pass = $_POST["password"];
            include('partials/dbconn.php');
            $query = "select * from login where phnum = '".$_POST['phone']."'";
            $result = mysqli_query($conn,$query);
            $num = mysqli_num_rows($result);
            if($num==1)
                $row = mysqli_fetch_assoc($result);
                if(isset($row) && $phone==$row["phnum"])
                {
                    if($pass==$row['pass'])
                    {
                        session_start();
                        $_SESSION['logstat']=true;
                        $_SESSION['phone']=$phone;
                        $_SESSION['login']=1;
                        header("location: index.php");
                    }
                    else
                    echo "<script>alert('The entered password is wrong')</script>";
                }
                else 
                    echo "<script>alert('The entered phone number is not registered.')</script>";
        }
    else if(isset($_POST["resid"]))
            {
                $id = $_POST["resid"];
                $pass = $_POST["respass"];
                include('partials/dbconn.php');
                $query = "select * from resto where id = '".$_POST['resid']."'";
                $result = mysqli_query($conn,$query);
                $num = mysqli_num_rows($result);
                if($num==1)
                    $row = mysqli_fetch_assoc($result);
                    if(isset($row) && $id==$row["id"])
                    {
                        if($pass==$row['pass'])
                        {
                            session_start();
                            $_SESSION['logstat']=true;
                            $_SESSION['resid']=$id;
                            $_SESSION['login']=1;
                            header("location: resto/index-r.php");
                        }
                        else
                        echo "<script>alert('The entered password is wrong')</script>";
                    }
                    else 
                        echo "<script>alert('The entered phone number is not registered.')</script>";
            }
?>
<div class="form-s">
    <div class="text-center container-2">
        Dont have an account yet?
        <a href='signup.php'><button class="mt btn btn-primary">Click here to Register</button></a>
    </div>
    <div class="log-form ulog">
        <h2>Login as a Customer</h2>
        <form action='login.php' class="bootstrap-iso" method="POST">
            <div class="mb mt">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="phone" name="phone" class="form-control" id="phone" aria-describedby="phoneHelp">
                <div id="phoneHelp" class="form-text">We'll never share your details with anyone else.</div>
            </div>
            <div class="mb mt">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <div class="mt form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Remember me</label>
            </div>
            <button type="submit" class="mb btn btn-primary">Submit</button>
        </form>
    </div>
    <div class="log-form rlog">
        <h2>Login as a Restaurant Owner</h2>
        <form action='login.php' class="bootstrap-iso" method="POST">
            <div class="mb mt">
                <label for="text" class="form-label">Restaurant ID</label>
                <input type="text" name="resid" class="form-control" id="resid" aria-describedby="phoneHelp">
            </div>
            <div class="mb mt">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="respass" class="form-control" id="respass">
            </div>
            <div class="mt form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck2">
                <label class="form-check-label" for="exampleCheck2">Remember me</label>
            </div>
            <button type="submit" class="mb btn btn-primary">Submit</button>
        </form>
    </div>
</div>


<?php include("partials/footer.php") ?>