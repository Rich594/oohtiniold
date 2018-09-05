<?php // Example 26-9: starwars.php
    require 'header_user.php';
    require_once 'dbconnection.php';
    require_once 'functions.php';
?>

    <div class="bodygrid">
    <div><?php include 'mainleft.php'?></div>
    
<?php    
       echo '<div>';  

            echo    "<div class='infogrid'>
            <div class='info1'>Click on a box below to view the action figures and their variations for that series.</div>
            <div class='info2'>You can add new figures to your personal masterlist by selecting an individual action figure.</div>
            <div class='info3'>View and update your collection by clicking on the My Collection link above.</div>
            </div>"; 
        
    $user = ($_SESSION['user_id']);
            
    $query = "SELECT DISTINCT series FROM masterlist WHERE user='$user'";
    $result = $link->query($query);
    if (!$result) die($link->error);
    
    $rows = $result->num_rows;
    
    for ($j = 0 ; $j < $rows ; ++$j) {
        
            $result->data_seek($j);
            $row = $result->fetch_array(MYSQLI_ASSOC);
       
            $seriesname = $row['series'];    
            
            if (isset($_SESSION['user_id'])) {   
                
            echo "<a class='seriesbox' href='masterlistview.php?series=$seriesname&user=$user&ownorwant=All'>";    
            echo "<span class='data-return2'>" .$row['series']. "<br>";
            echo "<img class='iconphoto' src='images/$seriesname.jpg'>"."<br>";
            
            $result5 = mysqli_query($link, "SELECT series FROM actionfigures WHERE series='$seriesname'");
            $num_rows = mysqli_num_rows($result5);
            $figures= $num_rows;
            
            $result6 = mysqli_query($link, "SELECT SUM(variation)FROM allfigures WHERE series='$seriesname'");
            $row = mysqli_fetch_row($result6);
            $variations= $row[0];
                        
            $result1 = mysqli_query($link, "SELECT series FROM masterlist WHERE ownorwant='own' and user='$user' and series='$seriesname'");
            $num_rows = mysqli_num_rows($result1);
            $own = $num_rows;
            
            $result1 = mysqli_query($link, "SELECT series FROM masterlist WHERE ownorwant='want' and user='$user' and series='$seriesname'");
            $num_rows = mysqli_num_rows($result1);
            $want = $num_rows;
            
            $total = $want + $own;
            $total = $own / $total * 100;
            $total = round($total,0);
            
                echo "<span class='seriesdisplay2'>own</span><span class='seriesdisplay5'> $own - \n  </span>"; 
                echo "<span class='seriesdisplay5'>$want </span><span class='seriesdisplay2'>want </span> \n<br>";
                echo "<span class='seriesdisplay5'>$total</span><span class='seriesdisplay2'>%\n</span><br>";
                echo "<span class='seriesdisplay'>$figures Figures - \n</span>";
                echo "<span class='seriesdisplay'>$variations Variations \n</span></span></a>";
            } 
        }    
    
?>
</div>
                    
        <div><?php include 'mainright.php'?></div>
                  
     </div>
            
    </body>

</html>
