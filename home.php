<?php
$pagename = (isset($_GET['pagename']) ? $_GET['pagename'] : null);
?>

<html>
    
        <title>oohtini</title>
    
        <head>    
        
        </head>
        
            <body>
            
                <div class="bodygrid">  


                    <div><?php include 'mainleft.php'?></div>

                      <div>
                          <?php include "$pagename.php"?>
                      </div>

                    <div><?php include 'mainright.php'?></div>

                </div>
            
            </body>

</html>

