<?php

    require_once 'dbconnection.php';
                
    $query = "SELECT DISTINCT series FROM actionfigures";
    $result = $link->query($query);
    if (!$result) die($link->error);
    
    $rows = $result->num_rows;
    
    for ($j = 0 ; $j < $rows ; ++$j) {
        
            $result->data_seek($j);
            $row = $result->fetch_array(MYSQLI_ASSOC);
       
            $seriesname = $row['series'];    
                       
            echo "<span class='data-return'>" .$row['series']."<br>";
            echo "<a href='figureview.php?series=$seriesname'><img class='iconphoto' src='images/$seriesname.jpg'></a>"."<br>";
 
            $result1 = mysqli_query($link, "SELECT series FROM masterlist WHERE ownorwant='own' and series='$seriesname'");
            $num_rows = mysqli_num_rows($result1);
            $own = $num_rows;
            
            echo "<span class='seriesdisplay'> $own \n  </span><span class='seriesdisplay1'>owned - </span>";
            
            $result1 = mysqli_query($link, "SELECT series FROM masterlist WHERE ownorwant='want' and series='$seriesname'");
            $num_rows = mysqli_num_rows($result1);
            $want = $num_rows;
            
            echo "<span class='seriesdisplay1'>want</span><span class='seriesdisplay'> $want \n</span>"."<br>";
            
            $total = $want + $own;
            
            if ($total > 0) {
            
            $total = $own / $total * 100;
            $total = round($total,0);
                                        
                echo "<span class='seriesdisplay2'>$total</span><span class='seriesdisplay4'>%\n</span></span>";
                
            } else {
                
                echo "</span>";
                             
            }
            
    }
?>
