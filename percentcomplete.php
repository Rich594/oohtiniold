<?php

    require_once 'dbconnection.php';
                
    $query = "SELECT DISTINCT series FROM actionfigures";
    $result = $link->query($query);
    if (!$result) die($link->error);
    
            $result1 = mysqli_query($link, "SELECT series FROM masterlist WHERE user='Bob' and ownorwant='own'");
            $num_rows = mysqli_num_rows($result1);
            $own = $num_rows;
            
                        
            $result1 = mysqli_query($link, "SELECT series FROM masterlist WHERE user='Bob' and ownorwant='want'");
            $num_rows = mysqli_num_rows($result1);
            $want = $num_rows;
            
            $total = $want + $own;
            
            if ($total > 0) {
            
            $total = $own / $total * 100;
            $total = round($total,0);
                                        
                echo "$total%\n COMPLETE";
                
            } else {
                
                echo "0%\n COMPLETE";
                             
            }
            
                
?>

