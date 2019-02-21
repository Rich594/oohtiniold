<?php // Example 26-1: functions.php
  $dbhost  = 'localhost';    // LOCAL 'localhost' LIVE: 146.66.104.164
  $dbname  = 'robinsnest';   // LOCAL 'robinsnest' LIVE: oohtini5_oohtini
  $dbuser  = 'rich';   // LOCAL 'rich' LIVE:oohtini5_rich
  $dbpass  = '123';   // LOCAL '123' LIVE: SW594!!
  $appname = "Oohtini"; // ...and preference

  $link = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
  if ($link->connect_error) die($link->connect_error);
?>