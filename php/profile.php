<?php
        require('partials/basefunc.php');
        sesh_start();
        
        $imgpath = "../static/images/";
?>
<?php 
        include('partials/dbconn.php');
        $query = "select * from profile where phnum='".$_SESSION['phone']."'";
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_assoc($result);
        $query1 = "select * from orders where phnum='".$_SESSION['phone']."'";
        $result1 = mysqli_query($conn,$query1);
        $num1 = mysqli_num_rows($result1);
        $row1 = mysqli_fetch_assoc($result1);
        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            $query1="UPDATE profile SET add1 = '"; 
            $query2="UPDATE profile SET name = '";
            $updt1=1;
            $updt2=1;
            if($_POST['n-add']!="")
            {
                $query1=$query1.$_POST['n-add']."' WHERE phnum='".$row['phnum']."'";
                $result1=mysqli_query($conn,$query1);
                if(!$result1)
                    $updt1=0;
            }
            if($_POST['n-name']!="")
            {
                $query2=$query2.$_POST['n-name']."' WHERE phnum='".$row['phnum']."'";
                $result2=mysqli_query($conn,$query2);
                if(!$result2)
                    $updt2=0;
            }
            if($_POST['n-add']=="" && $_POST['n-name']=="")
                $troll=1;
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
    if(isset($updt1) || isset($updt2))
    {
        if($updt1==0 || $updt2==0)
            alertF('An error has occured. Please try again.');
        elseif(!isset($troll))
            alertS('Your Profile has been updated !');
        else
            alertF('Name and Address fields cannot be blank !');
    }
?>
<div class="main-prof">

    <div class="prof-menu">
    <button id='prof-btn1' class='prof-btn' onclick='hideOrders()'>Edit Profile</button>
    <button id='prof-btn2' class='prof-btn' onclick='hideProfile()'>Your Orders</button>
    </div>
    <div id="ord-prof">
        <table>
            <tr>
                <td><pre>   </pre></td>
                <td>Date & Time</td>
                <td>Amount</td>
                <td>Payment</td>
                <td>Order Status</td>
            </tr>
        </table>
        <table>
        <?php for($i=1;$i<=$num1;$i++)
                {
                    disp_order_table($row1,$i);
                    $row1 = mysqli_fetch_assoc($result1);
                }
        ?>
        </table>
    </div>
    <div id="edit-prof">
        
        <form action="profile.php" class="mt form-s-u" method="post">
            <p class="text-center">Your Current Profile :</p>
            <div class="bootstrap-iso mt mb">   
                <label for="profnum" class="form-label">Phone Number : </label>
                <input type="text" class="form-control" id="profnum" placeholder="<?php echo $_SESSION['phone']?>" name="n-phnum" readonly>
                <span>(Contact Support to Change or Delete your Phone number)</span>
            </div>
            <div class="bootstrap-iso mt mb">
                <label for="exampleFormControlInput1" class="form-label">Name : </label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="<?php echo $row['name']?>" name="n-name">
            </div>
            <div class="bootstrap-iso mt mb">
                <label for="exampleFormControlTextarea1" class="form-label">Delivery Address :</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" placeholder="<?php echo $row['add1']?>" name="n-add"></textarea>
            </div>
            <div class="bootstrap-iso mt mb">
                <label class="text-red form-label">Big Bites Subscription : </label>
                <div class='d-flex'>
                    <div class="form-control">
                        <?php 
                    if($row['sub']==1)
                    echo "Subscribed";
                    elseif($row['sub']==0)
                    echo "Not Subscribed";
                    ?>
            </div>
            <?php
                if($row['sub']==0)
                {
                    echo'<div class="ml"><button class="btn btn-primary">Subscribe Now!</button></div>';
                }
                ?>
        </div>
    </div>
    <div class="mt mb">
        <input type="submit" class="item-center btn btn-primary" value="Update">
    </div>    
</form>
</div>
</div>

<?php include("partials/footer.php") ?>