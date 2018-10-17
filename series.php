<?php
    require_once 'dbconnection.php';
     
    if (isset($_SESSION['user_id'])) {
            
        echo    "<div class='infogrid'>
                <div class='info1'>Click on a box below to view the action figures for that series.</div>
                <div class='info2'>Add figures to your collection by selecting an action figure.</div>
                <div class='info3'>View your collection by clicking the My Collection link above.</div>
                </div>"; }
            
    else    { 
        echo   "<div class='infogrid'>
                <div class='info1'>Oohtini is a reference site that lists Star Wars action figures.</div>
                <div class='info2'>Click on a box below to view the action figures for that series.</div>
                <div class='info3'>Registered users can create their own action figure masterlist.</div>
                </div>";
            }    
    
    $query = "SELECT DISTINCT series FROM actionfigures";
    $result = $link->query($query);
    if (!$result) die($link->error);
    
    $rows = $result->num_rows;
    
    for ($j = 0 ; $j < $rows ; ++$j) {
        
            $result->data_seek($j);
            $row = $result->fetch_array(MYSQLI_ASSOC);
       
            $seriesname = $row['series'];    
            
            if (isset($_SESSION['user_id'])) {   
                
            $user = ($_SESSION['user_id']);    
            echo "<a class='seriesbox' href='figureview.php?series=$seriesname'>";    
            echo "<span class='data-return'>" .$row['series']. "<br>";
            echo "<img class='iconphoto' src='images/$seriesname.jpg'>"."<br>";
            
            $result5 = mysqli_query($link, "SELECT series FROM actionfigures WHERE series='$seriesname'");
            $num_rows = mysqli_num_rows($result5);
            $figures= $num_rows;
            
            $result6 = mysqli_query($link, "SELECT COUNT(reference)FROM actionfigures WHERE series='$seriesname'");
            $row = mysqli_fetch_row($result6);
            $variations= $row[0];
            
            echo "<span class='seriesdisplay5'>$figures Figures \n</span>"."<br>";
            echo "<span class='seriesdisplay5'>$variations Variations \n</span>"."<br>";
                        
            $result1 = mysqli_query($link, "SELECT series FROM masterlist WHERE ownorwant='own' and user='$user' and series='$seriesname'");
            $num_rows = mysqli_num_rows($result1);
            $own = $num_rows;
            
            $result1 = mysqli_query($link, "SELECT series FROM masterlist WHERE ownorwant='want' and user='$user' and series='$seriesname'");
            $num_rows = mysqli_num_rows($result1);
            $want = $num_rows;
            
            $total = $want + $own;
            
            if ($total > 0) {
            
            $total = $own / $total * 100;
            $total = round($total,0);
                
            echo "<span class='seriesdisplay'>own $own - \n  </span>"; 
            echo "<span class='seriesdisplay'>want $want - \n</span>";
            echo "<span class='seriesdisplay'>$total</span><span class='seriesdisplay'>%\n</span></span>"."</a>";
                
            } else {
                echo "<span class='seriesdisplay'>no figures added</span>"; 
            }
            } else {
            
            echo "<a href='figureview.php?series=$seriesname'>";    
            echo "<span class='data-return'>" .$row['series']. "<br>";
            echo "<img class='iconphoto' src='images/$seriesname.jpg'>"."<br>";
            
            $result5 = mysqli_query($link, "SELECT series FROM actionfigures WHERE series='$seriesname'");
            $num_rows = mysqli_num_rows($result5);
            $figures= $num_rows;
            
            $result6 = mysqli_query($link, "SELECT COUNT(reference)FROM actionfigures WHERE series='$seriesname'");
            $row = mysqli_fetch_row($result6);
            $variations= $row[0];
            
            echo "<span class='seriesdisplay5'>$figures Figures \n</span>"."<br>";
            echo "<span class='seriesdisplay5'>$variations Variations \n</span>"."<br>"."</a>";
            } 
    }    
    
?>
