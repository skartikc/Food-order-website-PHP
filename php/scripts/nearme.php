<?php
    require('../partials/dbconn.php');
    $query = "SELECT
    rname, (
      6371 * acos (
        cos ( radians(".$_POST['lat'].") )
        * cos( radians( lat ) )
        * cos( radians( lon ) - radians(".$_POST['lon'].") )
        + sin ( radians(".$_POST['lat'].") )
        * sin( radians( lat ) )
      )
    ) AS distance
  FROM resto
  HAVING distance <= 4
  ORDER BY distance;";
    $res = mysqli_query($conn, $query);
    if(!$res)
    {
        echo "query not executed";
    }
    else
    {
        $num = mysqli_num_rows($res);
        $row = mysqli_fetch_assoc($res);
        for($i=0;$i<$num;$i++)
        {
            if($i==$num-1)
                echo '"'.$row['rname'].'"]';
            else if($i==0)
                echo '["'.$row['rname'].'", ';
            else 
                echo '"'.$row['rname'].'", '; 
            $row = mysqli_fetch_assoc($res);
        }
        
    }

?>