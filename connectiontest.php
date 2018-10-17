<?php
$link = mysqli_connect("146.66.104.164", "oohtini5_rich", "SW594!!", "oohtini5_oohtini");

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;

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
    

mysqli_close($link);
?>

