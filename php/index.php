<?php
    require('partials/basefunc.php');
    require('partials/dbconn.php');
    sesh_start_index();
    $imgpath = "../static/images/";
    $query = "select * from fitems";
    $res = mysqli_query($conn, $query);
    $num = mysqli_num_rows($res);   
    if(!isset($_COOKIE['LTO']))
    {
        $tempstr = calc_LTO($num);
        setcookie('LTO',$tempstr,time() + 86400);
        $rando = json_decode($tempstr);
    }
    if(isset($_SESSION['phone']))
    {
        $query3 = "select * from mycart where phnum=".$_SESSION['phone'];
        $res3 = mysqli_query($conn, $query3);
        $row3 = mysqli_fetch_assoc($res3);
        $cartstr = json_decode($row3['fitems']);
        if($cartstr != null)
        {
            $query0 = "select * from fitems where srno=".$cartstr[0][0].$cartstr[0][1];
            $res0 = mysqli_query($conn, $query0);
            $row0 = mysqli_fetch_assoc($res0); 
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BitesBank - Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/bootstrap-iso.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style-r.css">
    <link rel="stylesheet" href="../css/custom-bootstrap.css">
</head>
<body>
    <div id="set-cart" data-cart='<?php echo json_encode($cartstr); ?>' 
                       data-logstat='<?php 
                                        if(isset($_SESSION['login']))
                                            echo "1"; 
                                        else 
                                            echo "0";
                                    ?>'>
    </div>
    <script src="../js/index.js"></script>
    <?php 
        include("partials/header.php");
        if(isset($_SESSION['login']) && $_SESSION['login']==1)
                {   
                    $_SESSION['login']=0;
                    alertS('Success ! You have been logged in.');
                }
                if(isset($alrt) && $alrt==1)
                {   
                    alertF('You have logged out successfully.');
                }
    ?>

<!-- Centre Search Bar -->

    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.html" method="POST">
                <input type="search" name="search" placeholder="Search for your Favourite Restaurant" required>
                <input type="submit" src='../images/search-icon.png' name="submit" value='Find' id="btn-find">
            </form>

        </div>
    </section>

<!-- Centre Search Bar -->
    
<!-- Partner Resto Section -->

    <section class='categories'>
        
        <h2 class="text-center">Our Top Partnered Restaurants</h2>
        <div class="partner-container">
            
            <div class="box">
                <a href="category-foods.html">
                    <img src="../static/images/restos/kfc_seawoods.jpg" alt="Pizza" class="imgn img-curve">
                </a>
            </div>
            
            <div class="box">
                <a href="#">
                    <img src="../static/images/restos/taco_seawoods.jpg" alt="Momo" class="imgn img-curve">
                </a>
            </div>
            
            <div class="box">
                <a href="#">
                    <img src="../static/images/restos/mcd_belapur.jpg" alt="Burger" class="imgn img-curve">
                </a>
            </div>
            <div class="clearfix"></div>
        </div> 
        
    </section>

<!-- Partner Resto Section -->

<!-- Limited Time Offers -->

    <section class="food-menu">
                <h2 class="text-center">Limited Time Offers for Today</h2><br>
                <?php 
                    if(!isset($_SESSION['login']))
                    echo "<div class='untouchable' onclick='alertLogin()'>"; 
                ?>
                    <div id="container-3">

                        <?php 
 
                        if(isset($_COOKIE['LTO']))
                        {
                            $rando = json_decode($_COOKIE['LTO']);
                            $k=1;
                            for($i=0;$i<$num;$i++)
                            {
                                $row = mysqli_fetch_assoc($res);
                                if(isset($_SESSION['phone']) && $cartstr != null)
                                {
                                    if($row0['rname']==$row['rname'])
                                        $chkResto = 1;
                                    else    
                                        $chkResto = 0;
                                }
                                else 
                                    $chkResto = 0;
                                for($j=0;$j<6;$j++)
                                    if($i==$rando[$j])
                                    {
                                        disp_fitem_LTO($imgpath,$row,$k,$chkResto);
                                        $k++;
                                    }
                            }
                        }
                        ?>
                    </div>
                </div>
        <div class="clearfix"></div>
        <p class="text-center">
            <a href="#">See Everything, Choose Anything</a>
        </p>
        <br>
        <section class="socials">
            <div class="text-center">
                <ul>
                    <li>
                        <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                    </li>
                    <li>
                        <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                    </li>
                    <li>
                        <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                    </li>
                </ul>
            </div>
        </section>
    </section>
<!-- Limited Time Offers -->

<!-- Socials -->


<!-- Socials -->

<?php include('partials/footer.php') ?>