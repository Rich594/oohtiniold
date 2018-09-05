<?php
    session_start();
    require_once 'dbconnection.php';
    
    $user = $_SESSION['user_id'];
      
    
    $result1 = mysqli_query($link, "SELECT masterlist.user,count(*) FROM masterlist WHERE masterlist.user='$user'");
    $row = mysqli_fetch_row($result1);
    $figuresOwned= $row[1];

    echo "$figuresOwned FIGURES OWNED\n";
?>

