<?php

    require_once 'dbconnection.php';
                
    $result1 = mysqli_query($link, "SELECT user FROM masterlist WHERE user='Bob' and ownorwant='own'");
    $num_rows = mysqli_num_rows($result1);

    echo "$num_rows FIGURES OWNED\n";
 
?>

