<?php
        require('../partials/basefunc.php');
        sesh_start();
        $imgpath = "../../static/images/";
?>
<?php 
        include('../partials/dbconn.php');
        $query = "select * from resto where id='".$_SESSION['resid']."'";
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_assoc($result);
        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            $query1="UPDATE resto SET radd = '"; 
            $query2="UPDATE resto SET rname = '";
            $updt1=1;
            $updt2=1;
            if($_POST['n-add']!="")
            {
                $query1=$query1.$_POST['n-add']."' WHERE id='".$row['id']."'";
                $result1=mysqli_query($conn,$query1);
                if(!$result1)
                    $updt1=0;
            }
            if($_POST['n-name']!="")
            {
                $query2=$query2.$_POST['n-name']."' WHERE id='".$row['id']."'";
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/bootstrap-iso.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/style-r.css">
    <link rel="stylesheet" href="../../css/custom-bootstrap.css">
    <script src="../../js/index.js"></script>
</head>
<body>
<?php 
    include("../partials/header-r.php");
    if(isset($updt1) || isset($updt2))
    {
        if($updt1==0 || $updt2==0)
            alertF('An error has occured. Please try again.');
        elseif(!isset($troll))
            alertS('Your Restaurant Profile has been updated !');
        else
            alertF('Name and Address fields cannot be blank !');
    }
?>

<form action="profile-r.php" class="mt form-s-u" method="post">
    <p class="text-center">Your Current Restaurant Profile :</p>
    <div class="bootstrap-iso mt mb">   
        <label for="profnum" class="form-label">Owner on record : </label>
        <input type="text" class="form-control" id="profnum" placeholder="<?php echo $row['owner']?>" name="n-owner" readonly>
        <span>(Contact Support to Change or Delete the Owner on record)</span>
    </div>
    <div class="bootstrap-iso mt mb">
        <label for="exampleFormControlInput1" class="form-label">Restaurant Name : </label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="<?php echo $row['rname']?>" name="n-name">
    </div>
    <div class="bootstrap-iso mt mb">
        <label for="exampleFormControlTextarea1" class="form-label">Restaurant Address :</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" placeholder="<?php echo $row['radd']?>" name="n-add"></textarea>
    </div>
    <div class="bootstrap-iso mt mb">
        <label class="text-red form-label">Big Bites Subscription : </label>
        <div class='d-flex'>
            <div class="form-control">
                 <?php 
                    if($row['fpage']==1)
                        echo "Subscribed";
                    elseif($row['fpage']==0)
                        echo "Not Subscribed";
                 ?>
            </div>
            <?php
                if($row['fpage']==0)
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

<?php include("../partials/footer.php") ?>