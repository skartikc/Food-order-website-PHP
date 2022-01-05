<?php
    include('../partials/basefunc.php');
    include('../partials/dbconn.php');
    sesh_start();
    $imgpath = "../../static/images/";
    $query = "select * from fitems where rname='".$_SESSION['resid']."'";
    $res = mysqli_query($conn, $query);
    $num = mysqli_num_rows($res);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BitesBank - Edit Menu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/bootstrap-iso.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/style-r.css">
    <link rel="stylesheet" href="../../css/custom-bootstrap.css">
</head>
<body>
    <?php include("../partials/header-r.php") ?>
    Restaurant Food Menu - <br>
    <hr>
    <?php
        for($i=0;$i<$num;$i++)
        {
            $row = mysqli_fetch_assoc($res);
            echo "
            <div class='fitem-single'>
                <div class='fitem-single-pic'>
                <img src='".$imgpath.$row['fimg']."' alt='fitem'>
                </div>
                <div class='fitem-single-text'>
                    <div>
                        <h3>".$row['fname']."</h3>
                    </div>
                    <div>
                        <p>".$row['fdesc']."</p>
                    </div>
                    <div>
                        <h2> Rs. ".$row['fprice']."</h2>
                    </div>
                    <div class='vornv'>
                        <img src='";
            if($row['vegstat']==1)
                echo $imgpath.'icons/veg.png';
            else 
                echo $imgpath.'icons/non-veg.png';           
            echo "'alt='fitem-vornv'>
                    </div>
                    <div class='fitem-actions'>
                        <button class='btn-primary-blue'>Edit Price</button>
                        <button class='btn-primary-blue'>Edit Name</button>
                        <button class='btn-primary-blue'>Veg/Non-veg</button>
                        <button class='btn-primary-blue'>Delete Item</button>
                    </div>
                </div>
            </div>
            <hr>";
        }
    ?>
<?php include("../partials/footer.php") ?>