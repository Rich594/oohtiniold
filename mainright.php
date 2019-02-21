<?php

    require_once 'dbconnection.php';
    
    echo "<div class='leftTitle'>Commonest Figures</div>";
    
    $query2 = "SELECT actionfigures.figurename,count(*)FROM masterlist
    INNER JOIN actionfigures ON masterlist.figurepidm = actionfigures.figurepidm
    GROUP BY actionfigures.figurename ORDER BY COUNT(*) DESC LIMIT 5";
    $result2 = $link->query($query2);
    if (!$result2) die($link->error);
    
    $rows = $result2->num_rows;
    
    for ($j = 0 ; $j < $rows ; ++$j) {
        
            $result2->data_seek($j);
            $row = $result2->fetch_array(MYSQLI_ASSOC);
       
            $actionfigure = $row['figurename'];
            $count = $row['count(*)'];
            
             echo   "<div class='wrapper'>
                        <div class='leftmaingrid'>
                            
                            <div class='figure'>$count - <span class='series'>$actionfigure</span></div>   
                        </div>
                    </div>";
    }
    
    //echo "<div class='leftTitle'>Figure List Project</div>";
    
    
            
            // echo   "<div class='projectbox'>Star Wars<br> A New Hope</div>
            //         <div class='projectbox'>The Empire Strikes Back</div>
            //         <div class='projectbox'>Return of the Jedi</div>";
    
    echo "<br><div class='leftTitle'>Rarest Figures</div>";
    
    $query2 = "SELECT actionfigures.figurename,count(*)FROM masterlist
    INNER JOIN actionfigures ON masterlist.figurepidm = actionfigures.figurepidm
    GROUP BY actionfigures.figurename ORDER BY COUNT(*) ASC LIMIT 5";
    $result2 = $link->query($query2);
    if (!$result2) die($link->error);
    
    $rows = $result2->num_rows;
    
    for ($j = 0 ; $j < $rows ; ++$j) {
        
            $result2->data_seek($j);
            $row = $result2->fetch_array(MYSQLI_ASSOC);
       
            $actionfigure = $row['figurename'];
            $count = $row['count(*)'];
            
             echo   "<div class='wrapper'>
                        <div class='leftmaingrid'>
                            
                            <div class='figure'>$count - <span class='series'>$actionfigure</span></div>   
                        </div>
                    </div>";
    }
    
?>

