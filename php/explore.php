<?php 
    require('partials/basefunc.php');
    require("partials/dbconn.php");
    sesh_start();
    $imgpath = "../static/images/";
    if(isset($_SESSION['phone']))
    {
        $query = "select * from mycart where phnum='".$_SESSION['phone']."'";
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_assoc($result);
        $cartstr = json_decode($row['fitems']);
    }
    else
    {
        $cartstr=null;
    }
    $query1 = "select rname, id, rating from resto ORDER BY rating DESC";
    $result1 = mysqli_query($conn,$query1);
    $row1 = mysqli_fetch_assoc($result1);
    if($cartstr != null)
    {
        $query0 = "select * from fitems where srno=".$cartstr[0][0].$cartstr[0][1];
        $res0 = mysqli_query($conn, $query0);
        $row0 = mysqli_fetch_assoc($res0);  //row0 for chkResto (current item restaurant should match cart restaurant)
    }
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
    <link rel="stylesheet" href="../css/bootstrap-iso.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style-r.css">
    <link rel="stylesheet" href="../css/custom-bootstrap.css">
    <title>BitesBank - Explore</title>
</head>
<body>
    <?php include('partials/header.php'); ?>
    <div id="set-cart" data-cart='<?php echo json_encode($cartstr); ?>' 
                       data-logstat='<?php 
                                        if(isset($_SESSION['login']))
                                            echo "1"; 
                                        else 
                                            echo "0";
                                    ?>'>
    </div>
    <script src="../js/index.js"></script>
    <div id="container-e">
        <section class="main-search text-center">
            <div class="container">  
                <form action="explore.php" method="POST">
                    <input type="search" name="search" placeholder="Search for your Favourite Restaurant" required>
                    <input type="submit" id="btn-find" src='../images/search-icon.png' name="submit" value='Find'>
                </form>
                <button onclick='getLoc()' id='btn-near'><img src="../static/images/icons/nearme.png" alt="">Near me</button>
            </div>
        </section>  
        <section id="nearme">
            <div class="nearme-resto">
                <a href=""></a>
            </div>
            <div class="nearme-resto">
                <a href=""></a>
            </div>
            <div class="nearme-resto">
                <a href=""></a>
            </div>
            <div class="nearme-resto">
                <a href=""></a>
            </div>
        </section>
        <br>
        <h4 class='text-center'>Our Partnered Brands </h4> <hr>
        <div class="caro-paro">
            <div class="caro-cell cell-1">
                <img name='caro-img' src="../static/images/restos/mcd_belapur.jpg" alt="">
            </div>
            <div class="caro-arrow-l">
                <img name='caro-arrow' onclick='caroClickL(this)' src="../static/images/icons/arrow-l.png" alt="">
            </div>
            <div class="caro-cell cell-2">
                <img name='caro-img' src="../static/images/restos/kfc_seawoods.jpg" alt="">
            </div>
            <div class="caro-arrow-r">
                <img name='caro-arrow' onclick='caroClickR(this)' src="../static/images/icons/arrow-r.png" alt="">
            </div>
            <div class="caro-cell cell-3">
                <img name='caro-img' src="../static/images/restos/taco_seawoods.jpg" alt="">
            </div>
        </div>
        <hr>
        <br>
        <h4 class='text-center'>Top Reviewed Restaurants near You</h4>
        <div id="top-rev">
            <div class="top-rev">
                <img src="../static/images/restos/<?php echo $row1['id']?>.jpg" alt=""><br>
                <button class='btn-primary-blue'><?php echo $row1['rating']?>/5 Stars</button>
            </div>
            <?php $row1 = mysqli_fetch_assoc($result1); ?>
            <div class="top-rev">
                <img src="../static/images/restos/<?php echo $row1['id']?>.jpg" alt=""><br>
                <button class='btn-primary-blue'><?php echo $row1['rating']?>/5 Stars</button>
            </div>
            <?php $row1 = mysqli_fetch_assoc($result1);?>
            <div class="top-rev">
                <img src="../static/images/restos/<?php echo $row1['id']?>.jpg" alt=""><br>
                <button class='btn-primary-blue'><?php echo $row1['rating']?>/5 Stars</button>
            </div>
            <?php $row1 = mysqli_fetch_assoc($result1);?>
            <div class="top-rev">
                <img src="../static/images/restos/<?php echo $row1['id']?>.jpg" alt=""><br>
                <button class='btn-primary-blue'><?php echo $row1['rating']?>/5 Stars</button>
            </div>
        </div>
        <div class="top-part-more">
            <a class="btn-primary-blue">Click here for more</a>
        </div>
        <br>
        <hr>
        <br>
        <div id="categ">
            <form action="explore.php" method="POST">
                View by Categories -
                <select name='categ'>  
                    <option value="Burger">Burger</option>
                    <option value="Ice-cream">Ice-cream</option>
                    <option value="Chinese">Chinese</option>
                    <option value="Indian">Indian</option>
                </select>
                <button type="submit" class="btn-primary">Search</button>
            </form>
            <?php if($_SERVER['REQUEST_METHOD']=="POST")
                  {
                     $categ=$_POST['categ'];
                     $query2="select * from fitems where categ='$categ'";
                     $result2 = mysqli_query($conn, $query2);
                     $row2 = mysqli_fetch_assoc($result2);
                     for($i=0;$i<mysqli_num_rows($result2);$i++)
                     {
                        if(isset($_SESSION['phone']) && $cartstr != null)
                        {
                            if($row0['rname']==$row2['rname'])
                                $chkResto = 1;
                            else    
                                $chkResto = 0;
                        }
                        else 
                            $chkResto = 0;
                        disp_fitem_explore($imgpath,$row2,$i,$chkResto);
                        $row2 = mysqli_fetch_assoc($result2);
                     }                  
                  }?>
        </div>
    </div>

    <?php include('partials/footer.php') ?>