<html>
    
        <title>oohtini</title>
    
         <head>    
        
        <link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Carter+One" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <link href="styles.css" rel="stylesheet" type="text/css"/>
    
        </head>
        
        <body>
            
                  <div class="headergrid">
                    
                    <div><a class="ex1" href='index.php?'><span class="title">oohtini</span></a><br><span class="tagline">Action Figure Collections</span></div>
                    <div></div>
                    <a class="links link1" href='masterlistview.php?ownorwant=own'><div><?php include 'figurecount.php'?></div></a>
                    <a class="links link2" href='masterlistview.php?ownorwant=want'><div><?php include 'figurecountwant.php'?></div></a>
                    <a class="links link3" href='index.php?'><div><?php include 'percentcomplete.php'?></div></a>
                    <a class="links link4" href='index.php?'><div> PROFILE</div></a>
                    <a class="links link5" href='index.php?'><div>LOG OUT</div></a>
              
                </div>  
            
              <div class="bodygrid">  
                
                
                  <div><?php include 'mainleft.php'?></div>
                
                    <div>

<?php // Example 26-9: starwars.php
    
    require_once 'dbconnection.php';
    require_once 'functions.php';

    $ownorwant = (isset($_GET['ownorwant']) ? $_GET['ownorwant'] : null);
    $seriesname = (isset($_GET['series']) ? $_GET['series'] : false);
    $ref = (isset($_GET['ref']) ? $_GET['ref'] : null);
    
    echo '<div class="topbar">';   
    echo '<div class="optionvalue">'; 
    
    echo "<form method='GET' action='masterlistview.php?'>
            <select name='series' class='form-control'>
            <option value=''>All</option>";

            $sql = mysqli_query($link, "SELECT DISTINCT series FROM masterlist WHERE user='Bob' AND ownorwant = '$ownorwant'");
            $row6 = mysqli_num_rows($sql);
            while ($row6 = mysqli_fetch_array($sql)){
            echo "<option value='". $row6['series'] ."'>" .$row6['series'] ."</option>" ;
            }
            echo "</select>
      
            <input type='submit' value='Submit'/>
            <input type='hidden' name='ownorwant' value='$ownorwant'>           

        </form>";
//$row6 = isset($_POST['series']) ? $_POST['series'] : null;

echo '</div>'; 
 echo '<div class="optionvalue2">'; 

//START PAGINATION 

$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);

if ($page <= 0) $page = 1;

$per_page = 10; // Set how many records to display per page.

$startpoint = ($page * $per_page) - $per_page;

$statement = "masterlist";

if(empty($seriesname)){
        $where = "ownorwant = '$ownorwant'";
        
                } else {
            
            $where = "ownorwant = '$ownorwant' AND masterlist.series = '$seriesname'";
        }

$results = mysqli_query($link,"SELECT masterlist.figurepidm, masterlist.ref, masterlist.reference, masterlist.series, actionfigures.figurename, masterlist.packaging, masterlist.accessories, masterlist.hanger, masterlist.ownorwant FROM {$statement} INNER JOIN actionfigures ON masterlist.figurepidm = actionfigures.figurepidm WHERE $where LIMIT {$startpoint} , {$per_page} ");

echo pagination($statement,$per_page,$page,$url='?ownorwant='.$ownorwant.'&series='.$seriesname.'&');

echo '</div>';
echo '</div>';
echo '<div class="clearfloat"></div>';

//FILTER FINISH    
    
    if ($ownorwant == "own") {
        $title = "Owned";
        $title2 = "Wanted";
        $title3 = "want";
    } else {
        $title = "Wanted";
        $title2 = "Owned";
        $title3 = "own";
}
     if(isset($_POST[$title2])){
          echo "<meta http-equiv='refresh' content='0'>";
          $ref = get_post($link, 'ref');
          $query = "UPDATE masterlist SET ownorwant='$title3' WHERE ref ='$ref'";
          $result = $link->query($query);
          if (!$result) echo "Change failed: $query<br>" .
          $link->error . "<br><br>";
    } else if (isset($_POST['delete'])){
          echo "<meta http-equiv='refresh' content='0'>";  
          $ref = get_post($link, 'ref');
          $query = "DELETE FROM masterlist WHERE ref='$ref'";
          $result = $link->query($query);
          if (!$result) echo "Delete failed: $query<br>" .
          $link->error . "<br><br>";
    }
  
echo   "<div class='grid-container1'>
        <div class='masterheader'>Figures $title</div>
        <div class='masterheader'>Reference</div>
        <div class='masterheader'>Series</div>
        <div class='masterheader'></div>
        </div>
        ";

if (mysqli_num_rows($results) != 0) {
    
    while ($row = mysqli_fetch_array($results)) {
        
    $figurepidm = $row[0]; 
    if ($row[7] == "loose") {
      $figurepidm = $row[5] . $figurepidm;
    } else {
      $figurepidm = $row[5] . $figurepidm;
    }
    
     echo    "<form action='masterlistview.php?ownorwant=$ownorwant&series=$seriesname' method='POST'>";
        
        echo   "<div class='grid-container2'>
                            <div class='header1'>$row[4]</div>
                            <div class='header2'>$row[2]</div>
                            <div class='header4'>$row[3]</div>
                            <div class='header5'><span class='plusminus'>Show (+)</span></div>
                        </div>
                        <div class='grid-container3'>
                          <div class='field1'><img src='images/$figurepidm.jpg'></div>
                          <div class='field2 info'>Packaging:</div>
                          <div class='field3'>$row[5]</div>
                          <div class='field4 info'></div>
                          <div class='field5 info'></div>
                          <div class='field6 info'>Accessory:</div>
                          <div class='field7'>$row[6]</div>
                          <div class='field8'></div>
                          <div class='field9'></div>
                          <div class='field10 info'>Hanger:</div>
                          <div class='field11'>$row[7]</div>
                          <div class='field12'></div>
                          <div class='field13'></div>
                          <div class='field14 info'></div>
                          <div class='field15'></div>
                          <div class='field16'></div>
                          <div class='field17'></div>
                          <div class='field18 info'></div>
                          <div class='field19'></div>
                          <div class='field20'></div>
                          <div class='field21'></div>
                          <div class='field22 info'></div>
                          <div class='field23'></div>
                          <div class='field24'><input type='submit' name='$title2' value='Mark As $title2'></div>
                          <div class='field25'><input type='submit' name='delete' value='DELETE'></div>     

                    
            </div>";
        
                echo    "<input type='hidden' name='delete' value='yes'>";
                echo    "<input type='hidden' name='ref' value='$row[1]'>";
                echo "  </form>";  
    }
 
} else {
    
     echo "<br><br><br><br>No records are found.";
}
function get_post($link, $var)
        
{
    return $link->real_escape_string($_POST[$var]);
}
  
?>
</div>
                    
                  <div><?php include 'mainright.php'?></div>
                  
              </div>
            
    </body>

</html>
                        
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
  $(".grid-container3").hide();
    
    $(document).ready(function() {
  //toggle the component with class accordion_body
  $(".grid-container2").click(function() {
    if ($('.grid-container3').is(':visible')) {
      $(".grid-container3").slideUp(600)
      $(".plusminus").text('Show (+)');
    }
    if ($(this).next(".grid-container3").is(':visible')) {
      $(this).next(".grid-containe3").slideUp(600);
      $(".plusminus").text('Show (+)');
    } else {
      $(this).next(".grid-container3").slideDown(600);
      $(this).find(".plusminus").text('Hide (-)');
    }
  });
});

  $(".field11").each(function () {
        if ($(this).is(":empty")) {
            $(this).prev().empty();
        }
    });
 
   $(".field7").each(function () {
        if ($(this).is(":empty")) {
            $(this).prev().empty();
        }
    });
    
</script>

