<?php // Example 26-1: functions.php
  $dbhost  = 'localhost';    // Unlikely to require changing
  $dbname  = 'robinsnest';   // Modify these...
  $dbuser  = 'rich';   // ...variables according
  $dbpass  = '123';   // ...to your installation
  $appname = "Oohtini"; // ...and preference

  $link = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
  if ($link->connect_error) die($link->connect_error);
?>