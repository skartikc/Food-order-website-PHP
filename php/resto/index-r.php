<?php 
    require('../partials/basefunc.php');
    require("../partials/dbconn.php");
    sesh_start();
    $imgpath = "../../static/images/";
    $query = "select * from resto where id='".$_SESSION['resid']."'";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($result);
    //total orders
    $query1 = "select count(*) as 'TotOrd' from orders where rname='".$_SESSION['resid']."'";
    $result1 = mysqli_query($conn,$query1);
    $countTot = mysqli_fetch_assoc($result1);
    $countTot = $countTot['TotOrd'];
    //cancelled orders
    $query2 = "select count(*) as 'CanOrd' from orders where rname='".$_SESSION['resid']."' AND stat='-1'";
    $result2 = mysqli_query($conn,$query2);
    $countCan = mysqli_fetch_assoc($result2);
    $countCan = $countCan['CanOrd'];
    //completed orders
    $query3 = "select count(*) as 'ComOrd' from orders where rname='".$_SESSION['resid']."' AND stat='2'";
    $result3 = mysqli_query($conn,$query3);
    $countCom = mysqli_fetch_assoc($result3);
    $countCom = $countCom['ComOrd'];
    //active orders
    $countAct = 0;
    $countAct = $countTot - $countCan - $countCom;
    //revenue generated
    $query4 = "select sum(total) as ComTot from orders where rname='".$_SESSION['resid']."' AND stat='2'";
    $result4 = mysqli_query($conn,$query4);
    $Revenue = mysqli_fetch_assoc($result4);
    $Revenue = $Revenue['ComTot'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/bootstrap-iso.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/style-r.css">
    <link rel="stylesheet" href="../../css/custom-bootstrap.css">
    <script src="../../js/index.js"></script>
    <title>BitesBank - Your Restaurant</title>
</head>
<body>
    <?php include('../partials/header-r.php');
    if(isset($_SESSION['login']) && $_SESSION['login']==1)
            {   
                $_SESSION['login']=0;
                alertS('Success ! You have been logged in.');
            }
            if(isset($alrt) && $alrt==1)
                alertF('You have logged out successfully.');
        
    ?>
    <div class="order-panel-r text-center">
        <h1>Your Dashboard</h1><br>
        <div class="wrapper-r">
            <div class="wrapper-r-col text-center">
                <h1><?php echo $countAct?></h1>
                <br>
                Active Orders 
            </div>
            <div class="wrapper-r-col text-center">
                <h1><?php echo $countCom?></h1>
                <br>
                Completed Orders
            </div>
            <div class="wrapper-r-col text-center">
                <h1><?php echo $countCan?></h1>
                <br>
                Cancelled Orders
            </div>
            <div class="wrapper-r-col text-center">
                <h1><?php echo $countTot?></h1>
                <br>
                Total Orders
            </div>
            <div class="wrapper-r-col text-center">
                <h1><?php echo "Rs. ".$Revenue?></h1>
                <br>
                Total Revenue Generated
            </div>
        </div>
        <h3>Customize your own special page for your customers and get to be on the top of our Home Page. Subscribe now to get your own Feature Page !</h3>
    </div>

    <div class="profile-r">
        <form class="mt form-s-u" method="post">
            <p class="text-center">Your Restaurant Profile :</p>
            <div class="bootstrap-iso mt mb">   
                <label for="profnum" class="form-label">Restaurant Name : </label>
                <input type="text" class="form-control" id="profnum" placeholder="<?php echo $row['rname']?>" readonly>
                <span>(Contact Support to Change or Delete your Phone number)</span>
            </div>
            <div class="bootstrap-iso mt mb">
                <label for="exampleFormControlInput1" class="form-label">Owner on record : </label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="<?php echo $row['owner']?>" readonly>
            </div>
            <div class="bootstrap-iso mt mb">
                <label for="exampleFormControlTextarea1" class="form-label">Restaurant Address :</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" placeholder="<?php echo $row['radd']?>" readonly></textarea>
            </div>
            <div class="bootstrap-iso mt mb">
                <label class="text-red form-label">Feature Page : </label>
                <div class='d-flex'>
                    <div class="form-control">
                        <?php 
                            if($row['fpage']==1)
                                echo "Subscribed";
                            else
                                echo "Not Subscribed";
                        ?>
                    </div>
                    <?php
                        if(true)
                            echo'<div class="ml"><button class="btn btn-primary">Subscribe Now!</button></div>';
                        
                    ?>
                </div>
            </div> 
        </form>
    </div>
    </body>
</html>

    <!-- footer Section Starts Here -->
    <hr>
    <section class="footer-r">
        <div class="container text-center">
            <p id='recon-r'>All rights reserved. Designed By <a href="#">G-17</a></p>
        </div>
    </section>
    <!-- footer Section Ends Here -->
</body>
</html>