<?php
include($_SERVER['DOCUMENT_ROOT'].'/drb/php/modules/smtp/PHPMailerAutoload.php'); // if error, then replace 'drb' with the name of your folder inside htdocs


function alertS($alrtmsg)
{
    echo "      
    <div class='alrt-s alrt'>
    <div class='alrt-text-s'>
    $alrtmsg
    </div>
    <button class='btn-cls-s' onclick='alrtCls()' onload='fadeIn()'><img class='btn-img' src='".$GLOBALS['imgpath']."icons/cancel-s.png'></button>
    </div>
    ";
}

function alertF($alrtmsg)
{
    echo "      
    <div class='alrt-f alrt'>
    <div class='alrt-text-f'>
    $alrtmsg
    </div>
    <button class='btn-cls-f' onclick='alrtCls()' onload='fadeIn()'><img class='btn-img' src='".$GLOBALS['imgpath']."icons/cancel-f.png'></button>
    </div>
    ";
    
}

function disp_order_table($row,$i){
   echo "<tr>
         <td>$i</td>
         <td>".$row['too']."</td>
         <td>Rs. ".$row['total']."</td>
         <td>";
    if($row['pymt']==1)
        echo "Paid Online";
    else 
        echo "COD";
    echo "</td>
          <td>";
    if($row['stat']==-1)
        echo "Processing";
    else if($row['stat']==0)
        echo "Preparing Food";
    else 
        echo "Completed";
    echo "</td>
         </tr>";
}

function disp_fitem_cart($imgpath,$row,$q){
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
                
                    <div class='item-price'> Rs. ".$row['fprice']."</div>
                
                <div class='vornv'>
                    <img src='";
    if($row['vegstat']==1)
        echo $imgpath.'icons/veg.png';
    else 
        echo $imgpath.'icons/non-veg.png';           
    echo "'alt='fitem-vornv'>
            </div>
            <div class='cart-qty'>
            <div class='arith-cont-cart'>
            <button class='btn-arith-lm' onclick='LTOminus(this, ".$row['srno'].")'>-</button>
            <button class= 'counter' >".$q."</button>
            <button class='btn-arith-rp' onclick='LTOplus(this, ".$row['srno'].")'>+</button>
            </div>
            </div>
            </div>
            </div>
            ";
}
function disp_fitem_explore($imgpath,$row,$i,$chkResto){
    echo "
            <div class='fitem-single'>
            <div class='fitem-single-pic'>
            <img src='".$imgpath.$row['fimg']."' alt='fitem'>
            </div>
            <div class='fitem-single-text'>
                <div>
                    <h3>".$row['fname']."</h3><h4>".$row['rname']."</h4>
                </div>
                <div>
                    <p>".$row['fdesc']."</p>
                </div>
                
                    <div class='item-price'> Rs. ".$row['fprice']."</div>
                
                <div class='vornv'>
                    <img src='";
    if($row['vegstat']==1)
        echo $imgpath.'icons/veg.png';
    else 
        echo $imgpath.'icons/non-veg.png';           
    echo "'alt='fitem-vornv'>
            </div>
            <div class='food-menu-add'>
            <div class='food-menu-add-text'>
                <button id='ATCBTN".$i."' class='ATCBtn' onclick='AddCartClick(".$i.", ".$row['srno'].", ".$chkResto.")'>Add to Cart</button>
                </div>
                <div class='arith-cont'>
                <button class='btn-arith-lm' onclick='LTOminus(this, ".$row['srno'].")'>-</button>
                <button class= 'counter' ></button>
                <button class='btn-arith-rp' onclick='LTOplus(this, ".$row['srno'].")'>+</button>
                </div>
                </div>
                </div>
                </div>  
                <script>
                AddCartPre(".$i.", ".$row['srno'].");
                
                </script>
            </div>
            </div>
            </div>
            ";
}

function disp_fitem_LTO($imgpath,$row,$i,$chkResto){
    echo "
            <div class='food-menu-box'>
            <div class='food-menu-img'>
                <img src='".$imgpath.$row['fimg']."' alt='LTO #' class='imgn img-curve'>
            </div>

            <div class='food-menu-desc'>
                <h4>".$row['fname']."</h4>
                <div class='vornv'>
                    <img src='  ";
                
    if($row['vegstat']==1)
        echo $imgpath."icons/veg.png";
    else 
        echo $imgpath."icons/non-veg.png";  
           
    echo "  'alt='fitem-vornv'>
            </div>
            <p class='food-price'>Rs. ".$row['fprice']."</p>
            <p class='food-detail'>".$row['fdesc']."
            </p>
            <br>
            
            <div class='food-menu-add'>
                <div class='food-menu-add-text'>
                    <button id='ATCBTN".$i."' class='ATCBtn' onclick='AddCartClick(".$i.", ".$row['srno'].", ".$chkResto.")'>Add to Cart</button>
                    </div>
                    <div class='arith-cont'>
                    <button class='btn-arith-lm' onclick='LTOminus(this, ".$row['srno'].")'>-</button>
                    <button class= 'counter' ></button>
                    <button class='btn-arith-rp' onclick='LTOplus(this, ".$row['srno'].")'>+</button>
                    </div>
                    </div>
                    </div>
                    </div>  
                    <script>
                    AddCartPre(".$i.", ".$row['srno'].");
                    
                    </script>";
}

function sesh_start()
{
    session_start();
    // if(!isset($_SESSION['logstat']) || $_SESSION['logstat']!=true)
    //      echo "Not Logged in";
    // else
    //      echo "Logged in as ".$_SESSION['phone'];
}

function sesh_start_index()
{
    session_start();
    if(isset($_SESSION['logout']) && $_SESSION['logout']==1)
    {
        session_unset();
        session_destroy();
        $GLOBALS['alrt']=1;
    }
    // if(!isset($_SESSION['logstat']) || $_SESSION['logstat']!=true)
    //      echo "Not Logged in";
    // else
    //      echo "Logged in as ".$_SESSION['phone'];
}

function calc_LTO($num){
    $rando = array();
    $chk=0;
    $count=0;
    for($i=0;$i<($num-1);$i++)
    {
        $temp=rand(0,($num-1));
        for($j=0;$j<$count;$j++)
        {
            if($rando[$j]==$temp)
            $chk=1;
        }
        if($chk!=1)
        {
            array_push($rando,$temp);
            $count++;
            if($count==6)
                break;
        }
        $chk=0;
        if($i==($num-2) && $count<6)
            $i=0;
    }
    return json_encode($rando);
}

function calc_cart_items($arrstr,$fid,$num){
    $arr = json_decode($arrstr);
    for($i=0;$i<count($arr);$i++)
    {
        $fidStr = $arr[$i][0].$arr[$i][1];
        $fidInt = (int)$fidStr;
        if($fidInt==$fid)
        {
            $arr[$i][(strlen($arr[$i])-1)]=$num;
            $chk=1;
        }
    }
    if(!isset($chk))
    {
        $arr[count($arr)] = $fid." ".$num;
    }
    return json_encode($arr);
}

function chk_cart_items($arrstr,$fid){
    $arr = json_decode($arrstr);
    for($i=0;$i<count($arr);$i++)
    {
        $fidStr = $arr[$i][0].$arr[$i][1];
        $fidInt = (int)$fidStr;
        if($fidInt==$fid)
        {
            $num = $arr[$i][(strlen($arr[$i])-1)];
            $chk=1;
            break;
        }
    }
    if(!isset($chk))
    {
        return -1;
    }
    return $num;
}

function smtp_mailer($to,$name,$prob,$edate){
	$mail = new PHPMailer(); 
	$mail->SMTPDebug  = 0;
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'tls'; 
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Username = "bitesbankhelp@gmail.com";
	$mail->Password = "bankbites2";
	$mail->SetFrom("bitesbankhelp@gmail.com");
	$mail->Subject = "RESPONSE TO YOUR QUERY AT BITESBANK.COM";
	$mail->Body = "Hello $name, Thank you for contacting BitesBank Helpdesk on $edate. Your current problem is - $prob . Tell us more about your problem and send us corresponding images to support your issue.";
	$mail->AddAddress($to);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		echo $mail->ErrorInfo;
	}else{
		return 'Sent';
	}
}
