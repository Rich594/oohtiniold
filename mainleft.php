<?php

    require_once 'dbconnection.php';
                
    echo "<div class='leftTitle'>Newly Added Figures</div>";
    
    $query = "SELECT figurename, series FROM actionfigures ORDER BY figurepidm DESC LIMIT 5";
    $result = $link->query($query);
    if (!$result) die($link->error);
    
    $rows = $result->num_rows;
    
    for ($j = 0 ; $j < $rows ; ++$j) {
        
            $result->data_seek($j);
            $row = $result->fetch_array(MYSQLI_ASSOC);
       
            $figurename = $row['figurename'];
            $seriesname = $row['series'];  
            
             echo   "<div class='wrapper'>
                        <div class='leftmaingrid'>
                            <div class='figure'>$figurename</div>
                            <div class='series'>$seriesname</div>   
                        </div>
                    </div>";
    }
    
     echo "<br><div class='leftTitle'>Most Figures Owned</div>";
    
    $query3 = "SELECT masterlist.user,count(*), users.first_name FROM masterlist INNER JOIN users ON masterlist.user = users.user_id WHERE ownorwant = 'own' GROUP BY user ORDER BY COUNT(*) DESC LIMIT 5";
    $result3 = $link->query($query3);
    if (!$result3) die($link->error);
    
    $rows = $result3->num_rows;
    
    for ($j = 0 ; $j < $rows ; ++$j) {
        
            $result3->data_seek($j);
            $row = $result3->fetch_array(MYSQLI_ASSOC);
       
            $user = $row['first_name'];
            $count = $row['count(*)'];
            
             echo   "<div class='wrapper'>
                        <div class='leftmaingrid'>
                            
                            <div class='figure'>$count - <span class='series'>$user</span></div>   
                        </div>
                    </div>";
    }
    
    
  


    
?>
