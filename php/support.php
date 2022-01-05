<?php 
    session_start();
    require("partials/dbconn.php");
    require("partials/basefunc.php");
    $query = "select * from profile where phnum='".$_SESSION['phone']."'";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BitesBank - Help</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/bootstrap-iso.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/custom-bootstrap.css">
    <script src="../js/index.js"></script>
</head>
<body>
    <?php 
        include("partials/header.php"); 
        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            smtp_mailer($_POST['email'],$row['name'],$_POST['text'],date("l jS \of F Y h:i:s A"));
            alertS('Support Ticket Created. Please check your mail.');
        }
    ?>
    <section id='helpas'>
        <div id="helpas-txt">
            Tell us about your problem below.<br> The Bites Support Staff will get in touch with you via email.
        </div>
    </section>
    <div class="form-s-u">
        <form action='support.php' class="bootstrap-iso" method="POST">
            <div class="mt mb">   
                <label class="form-label">Phone Number : </label>
                <input type="text" class="form-control" placeholder="<?php echo $_SESSION['phone']?>" name="h-phnum" readonly>
                <span>(Contact Support to Change or Delete your Phone number)</span>
            </div>
            <div class="mt mb">   
                <label class="form-label">Your Name :</label>
                <input type="text" class="form-control" placeholder="<?php echo $row['name']?>" name="h-name" readonly>
                <span>(Go to the Profile Page to change your name)</span>
            </div>
            <div class="mb mt">
                <label for="email" class="form-label">Enter your email</label>
                <input type="email" name="email" class="form-control" id="email">
            </div>
            <div class="mb mt">
                <label for="text" class="form-label">Describe your problem to us</label><br>
                <textarea name="text" id='prob-txt' rows="7"></textarea>
            </div>
            <button id="subm-btn"type="submit" class="mb btn btn-primary">Submit</button>
        </form>
    </div>
<?php include("partials/footer.php"); ?>