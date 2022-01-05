<?php
require('partials/basefunc.php');
require('partials/dbconn.php');
sesh_start();

$imgpath = "../static/images/";
$query = "select * from mycart where phnum='".$_SESSION['phone']."'";
$query2 = "select * from profile where phnum='".$_SESSION['phone']."'";
$res = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($res);
$res2 = mysqli_query($conn, $query2);
$row2 = mysqli_fetch_assoc($res2);
$cartStr = json_decode($row['fitems']);
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
    <link rel="stylesheet" href="../css/style-r.css">
    <link rel="stylesheet" href="../css/custom-bootstrap.css">
    <script src="../js/index.js"></script>
</head>
<body>

<?php include("partials/header.php") ?>
<div id="set-cart" data-page='mycart' data-cart='<?php echo json_encode($cartStr)?>' data-logstat='<?php 
                                        if(isset($_SESSION['login']))
                                            echo "1"; 
                                        else 
                                            echo "0";
                                    ?>'>
</div>
<script src="../js/index.js"></script>
<?php 
    if($cartStr == null)
        echo "<div class='untouchable' onclick='alertCart()'>"; 
?>
<div id="parent-cart">
    <h3 class='u-text'>Your Items - </h3>
    <div id="fitems-roll">
        <?php
            $totalCart = 0;
            if(!empty($cartStr))
            {
                $concat = "IN(";
                for ($i = 0; $i < count($cartStr); $i++) {
                    
                    $concat = $concat.intval($cartStr[$i][0].$cartStr[$i][1]);
                    if($i!=(count($cartStr) - 1))
                    $concat = $concat.',';
                    else 
                    $concat = $concat.')';
                }   
                $query1 = "select * from fitems where srno ".$concat;
                $res1 = mysqli_query($conn, $query1);
                $num1 = mysqli_num_rows($res1);
                for($i=0;$i<$num1;$i++)
                {   
                    $row1 = mysqli_fetch_assoc($res1);
                    disp_fitem_cart($imgpath,$row1,chk_cart_items($row['fitems'],$row1['srno']));
                    $totalCart += $row1['fprice'] * (chk_cart_items($row['fitems'],$row1['srno']));
                }
            }
        ?>
    </div>
    <div id="total-amt">
            <h3>Cart Total - Rs. <?php echo $totalCart?></h3>
            <h3>Partner Fee - Rs. 33.33</h3>            
            <h3>Packaging and Delivery - Rs. 45.00</h3>    
            <hr>        
            <h3>Total Amount to be Paid - Rs. <?php echo ($totalCart + 78.33)?> </h3>
    </div>
    <form id="cart-offer" action="mycart.php">
        <input type="text" id="btn-cart-text" name="offer-id" id="offer-id" placeholder="Enter offer code">
        <input type="submit" id="btn-cart-offer" name="offer-submit" value='Apply' >
        <button name="offer-cancel">Cancel</button>
    </form>   

    <div id="pymt-mthd">
            <input  type='radio' name='group1' id="pay-ol" checked><h3 class='u-btn' onclick='checkRadio(this)'>Pay online via Razorpay</h3></input>
            <input  type='radio' name='group1' id="pay-cod"><h3 class='u-btn' onclick='checkRadio(this)'>Cash on Delivery (COD)</h3></input>
    </div>
    <div id="cart-exit">
            <button  onclick='orderClick(<?php echo $totalCart ?>)'>PLACE ORDER</button>
    </div>
    <div id="cart-add">
        <h3 class="u-txt">Delivery Address</h3>
        <p><?php echo $row2['add1'] ?></p>
    </div>
</div>
</div>

<?php include("partials/footer.php") ?>